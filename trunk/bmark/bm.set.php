<?

require_once dirname(__FILE__) . '/../lib/redis.php';
require_once dirname(__FILE__) . '/../lib/redis.pool.php';
require_once dirname(__FILE__) . '/../lib/redis_set.peer.php';
require_once dirname(__FILE__) . '/bench_mark.lib.php';

# Config
redis_pool::add_servers( array('master' => array('127.0.0.1', 6379)) );
class mock_set_peer extends redis_set_peer
{}

# Benchmark

$p = new mock_set_peer();

bench_mark::start();

$p->clear('some_set');
$p->add('some_set', 1, 'Adding/removing');
$p->add('some_set', 2);

echo bench_mark::get();