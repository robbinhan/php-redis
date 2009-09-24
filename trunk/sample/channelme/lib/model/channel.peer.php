<?

class channel_peer extends redis_peer
{
	private static $instance;

	/**
	 * @return channel_peer
	 */
	public static function instance()
	{
		return self::$instance ? self::$instance : self::$instance = new self;
	}

	public function insert( $title )
	{
		$data['title'] = $title;
		$data['ts'] = time();
		
		return parent::insert($data);
	}
}