<?

if ( $text = trim($_POST['text']) )
{
	$channel_id = (int)$_POST['channel_id'];
	$id = post_peer::instance()->insert($text, $channel_id, $_SESSION['user_id']);
	channel_post_peer::instance()->insert($id, $channel_id);
}