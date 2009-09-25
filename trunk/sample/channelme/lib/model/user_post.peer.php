<?

class user_post_peer extends redis_list_peer
{
	private static $instance;

	/**
	 * @return user_post_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}

	public function insert( $user_id, $post_id )
	{
		parent::insert($user_id, array('id' => $post_id), false);
		$this->truncate($user_id, 100);
	}
}