<?

class channel_post_peer extends redis_list_peer
{
	private static $instance;

	/**
	 * @return channel_post_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}

	public function insert( $post_id, $channel_id )
	{
		parent::insert($channel_id, array('id' => $post_id), false);
		$this->truncate($channel_id, 100);

		parent::insert(0, array('id' => $post_id), false);
		$this->truncate(0, 100);

		$users = channel_user_peer::instance()->get_list($channel_id);
		foreach ( $users as $data )
		{
			$user_id = $data['id'];
			user_post_peer::instance()->insert($user_id, $post_id);
		}
	}
}