<?

/**
 * List peer used for filtered list functionality
 */
class redis_list_peer
{
	protected $name_space;

	public function  __construct()
	{
		$this->name_space = get_class($this);
	}

	/**
	 * @return php_redis
	 */
	public function get_connection()
	{
		return redis_pool::get('master');
	}

	public function insert( $pk, $params, $at_bottom = true )
	{
		if ( $at_bottom )
		{
			$this->get_connection()->append($this->name_space . $pk, $params);
		}
		else
		{
			$this->get_connection()->prepend($this->name_space . $pk, $params);
		}
	}

	public function clear( $pk )
	{
		$this->get_connection()->delete($this->name_space . $pk);
	}

	public function truncate( $pk, $limit, $offset )
	{
		# $this->get_connection()->truncate($this->name_space . $pk, $limit, $offset);
	}

	public function get_list( $pk, $params = array(), $limit = null, $offset = 0 )
	{
		if ( !$limit )
		{
			$limit = $this->get_connection()->get_list_length($this->name_space . $pk);
		}

		if ( $params )
		{
			return $this->get_connection()->get_filtered_list($this->name_space . $pk, $params, $limit, $offset);
		}

		return $this->get_connection()->get_list($this->name_space . $pk, $limit, $offset);
	}
}