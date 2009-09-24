<?

class user_peer extends redis_peer
{
	private static $instance;

	public function insert( $data )
	{
		$data['ts'] = time();

		$id = parent::insert($data);

		$this->get_connection()->set($this->name_space . 'nickname' . $data['nickname'], $id);
		return $id;
	}

	public function get_by_nickname( $nickname )
	{
		if ( $id = $this->get_connection()->get($this->name_space . 'nickname' . $nickname) )
		{
			return $this->get_by_id($id);
		}
	}

	/**
	 * @return user_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}
}