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
	}
}