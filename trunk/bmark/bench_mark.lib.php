<?

class bench_mark
{
	private static $checkpoint;

	public static function start()
	{
		self::$checkpoint = microtime(true);
	}

	public static function get()
	{
		$spent = microtime(true) - self::$checkpoint;
		return round($checkpoint, 2);
	}
}