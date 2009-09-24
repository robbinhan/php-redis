<?

class user_channel_peer extends redis_list_peer
{
	private static $instance;

	/**
	 * @return user_channel_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}

	public function insert( $user_id, $channel_id )
	{
		parent::insert($user_id, array('id' => $channel_id));
	}

	public function get_list( $user_id )
	{
		return parent::get_list($user_id);
	}

	public function is_my_channel( $user_id, $channel_id )
	{
		$list = $this->get_list($user_id);
		foreach ( $list as $data )
		{
			if ( $data['id'] == $channel_id ) return true;
		}

		return false;
	}
}