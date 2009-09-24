<?

class post_helper
{
	public static function body( $text )
	{
		$text = preg_replace('/(http:\/\/[^ ]+\.(jpg|png|gif))/', '<img src="$1" width="430" />', $text);

		return $text;
	}
}