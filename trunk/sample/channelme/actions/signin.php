<?

$nickname = trim(strtolower($_POST['nickname']));
$password = $_POST['password'];

if ( !$nickname || !$password )
{
	echo json_encode(array('error' => 'All fields are required'));
	exit;
}
else if ( !$user = user_peer::instance()->get_by_nickname($nickname) )
{
	echo json_encode(array('error' => 'Nope... Try again'));
	exit;
}
else if ( md5($password) != $user['password'] )
{
	echo json_encode(array('error' => 'Nope... Try again'));
	exit;
}
else
{
	$_SESSION['user_id'] = $user['id'];

	echo json_encode(array());
	exit;
}