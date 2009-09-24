<?

class php_redis
{
	private $host;
	private $port;
	private $handle;

	/**
	 *
	 * @param string $host
	 * @param int $port
	 */
	public function  __construct( $host = '127.0.0.1', $port = 6379 )
	{
		$this->host = $host;
		$this->port = $port;
	}

	/**
	 * Ping server
	 *
	 * @param int $server_index Index of the server
	 */
	public function ping( $server_index )
	{
		return $this->execute_command($this->get_connection( $server_index ), 'PING');
	}

	# === Scalar operations ===

	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public function set( $key, $value )
	{
		$value = is_numeric($value) ? $value : serialize($value);
		$cmd = array("SET {$key} " . strlen($value), $value);

		$response = $this->execute_command( $cmd );
		return $this->get_error($response);
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get( $key )
	{
		$response = $this->execute_command( "GET {$key}" );
		if ( $this->get_error($response) )
		{
			return;
		}

		$length = (int)substr($response, 1);
		if ( $length > 0 )
		{
			$value = $this->get_response();
			return is_numeric($value) ? $value : unserialize($value);
		}
	}

	/**
	 * @param string $key
	 */
	public function delete( $key )
	{
		return $this->execute_command( "DEL {$key}" );
	}

	/**
	 * @param string $key
	 * @return boolean
	 */
	public function exists( $key )
	{
		return $this->execute_command( "EXISTS {$key}" ) == ':1';
	}

	/**
	 *
	 * @param string $key
	 * @param int $by
	 */
	public function inc( $key, $by = 1 )
	{
		$response = $this->execute_command( "INCRBY {$key} {$by}" );
		return substr($response, 1);
	}

	/**
	 *
	 * @param string $key
	 * @param int $by
	 */
	public function dec( $key, $by = 1 )
	{
		$response = $this->execute_command( "DECRBY {$key} {$by}" );
		return substr($response, 1);
	}

	# === List operations ===
	public function prepend( $key, $value )
	{
		$value = is_numeric($value) ? $value : serialize($value);
		$cmd = array("LPUSH {$key} " . strlen($value), $value);

		$response = $this->execute_command( $cmd );
		return $this->get_error($response);
	}

	public function append( $key, $value )
	{
		$value = is_numeric($value) ? $value : serialize($value);
		$cmd = array("RPUSH {$key} " . strlen($value), $value);

		$response = $this->execute_command( $cmd );
		return $this->get_error($response);
	}

	public function get_list($key, $limit, $offset = 0)
	{
		$limit--;
		$start = $offset;
		$end = $start + $limit;

		$response = $this->execute_command( "LRANGE {$key} {$start} {$end}" );
		if ( $this->get_error($response) )
		{
			return;
		}

		$count = (int)substr($response, 1);
		$list = array();
		for ( $i = 0; $i < $count; $i++ )
		{
			$length = substr($this->get_response(), 1);
			$value = $this->get_response();
			$list[] = is_numeric($value) ? $value : unserialize($value);
		}

		return $list;
	}

	# === Middle tier ===

	/**
	 * Init connection
	 */
	private function get_connection()
	{
		if ( !$this->handle )
		{
			if ( !$sock = fsockopen($this->host, $this->port, $errno, $errstr) )
			{
				return false;
			}

			$this->handle = $sock;
		}

		return $this->handle;
    }

	private function execute_command( $commands )
	{
		$this->get_connection();
		if ( !$this->handle ) return false;

		if ( is_array($commands) )
		{
			$commands = implode("\r\n", $commands);
		}

		$command .= $commands . "\r\n";

		for ( $written = 0; $written < strlen($command); $written += $fwrite )
		{
			if ( !$fwrite = fwrite($this->handle, substr($command, $written)) )
			{
				return false;
			}
		}

		return $this->get_response();
	}

	private function get_response()
	{
		if ( !$this->handle ) return false;
		return trim(fgets($this->handle), "\r\n ");
	}

	private function get_error( $response )
	{
		if ( strpos($response, '-ERR') === 0 )
		{
			return substr($response, 5);
		}

		return false;
	}
}