<?

# System load
require_once dirname(__FILE__) . '/../../../lib/redis.php';
require_once dirname(__FILE__) . '/../../../lib/redis.pool.php';
require_once dirname(__FILE__) . '/../../../lib/redis.peer.php';

# App load
require_once dirname(__FILE__) . '/../lib/model/user.peer.php';
require_once dirname(__FILE__) . '/../config/app.php';

# Redis init
redis_pool::add_servers($redis_pool);

# Session init
session_start();
$user_id = $_SESSION['user_id'];

# Execute action
if ( $action = $_GET['action'] )
{
	$action = preg_replace('/[^a-z]/', '', $action);
	include dirname(__FILE__) . '/../actions/' . $action . '.php';
}

# Render
if ( $action )
{
	include dirname(__FILE__) . '/../views/' . $action . '.php';
}
else
{
	include dirname(__FILE__) . '/../views/layout.php';
}