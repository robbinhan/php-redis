<?

class post_peer extends redis_peer
{
	private static $instance;

	/**
	 * @return post_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}

	public function insert( $text, $channel_id, $user_id )
	{
		$data = array(
			'text' => $text,
			'channel_id' => $channel_id,
			'user_id' => $user_id,
			'ts' => time()
		);

		return parent::insert($data);
	}
}