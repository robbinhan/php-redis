<?

$nickname = trim(strtolower($_POST['nickname']));
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ( !$nickname || !$password || !$password_confirm )
{
	echo json_encode(array('error' => 'All fields are required'));
	exit;
}
else if ( $password != $password_confirm )
{
	echo json_encode(array('error' => 'Passwords do not match'));
	exit;
}
else
{
	$u = user_peer::instance();
	if ( $u->get_by_nickname($nickname) )
	{
		echo json_encode(array('error' => 'Nickname used already'));
		exit;
	}

	$id = $u->insert( array( 'nickname' => $nickname, 'password' => md5($password) ) );
	$_SESSION['user_id'] = $id;
	
	echo json_encode($id);
	exit;
}