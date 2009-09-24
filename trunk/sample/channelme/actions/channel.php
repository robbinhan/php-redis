<?

$channel = channel_peer::instance()->get_by_id( (int)$_GET['id'] );
$posts = channel_post_peer::instance()->get_list($channel['id'], null, 20);

$is_mine = user_channel_peer::instance()->is_my_channel($_SESSION['user_id'], $channel['id']);