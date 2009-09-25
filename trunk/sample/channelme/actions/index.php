<?

if ( $user_id )
{
	$list = user_post_peer::instance()->get_list($user_id);
}

if ( !$list )
{
	$list = channel_post_peer::instance()->get_list(0, null, 50);
}