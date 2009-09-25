<?

if ( $id = (int)$_POST['id'] )
{
	user_channel_peer::instance()->delete($_SESSION['user_id'], $id);

	echo json_encode( $data );
}

exit;