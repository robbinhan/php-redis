<?

if ( $user_id )
{
	$list = user_post_peer::instance()->get_list($user_id);
}
else
{
	$list = array();
}