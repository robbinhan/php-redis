<?

class channel_user_peer extends redis_list_peer
{
	private static $instance;

	/**
	 * @return channel_user_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}

	public function insert( $channel_id, $user_id )
	{
		parent::insert($channel_id, array('id' => $user_id), false);
	}

	public function delete( $channel_id, $user_id )
	{
		parent::delete($channel_id, array('id' => $user_id));
	}
}