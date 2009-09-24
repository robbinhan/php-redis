<?

if ( $id = (int)$_POST['id'] )
{
	$data = channel_peer::instance()->get_by_id($id);
	user_channel_peer::instance()->insert($_SESSION['user_id'], $id);

	echo json_encode( $data );
}

exit;