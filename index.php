<?php
require_once 'core/DB.php';
require_once 'core/Model.php';
require_once 'models/Order.php';

use core\DB;
use models\Order;

$db = new DB('localhost', 'cms', 'mycms', '_dppc*QaU3m@gC](');

$GLOBALS['db'] = $db;

use core\Core;

spl_autoload_register(static function ($className) {
    $path = "./" . $className . ".php";
    $path = str_replace('\\', '/', $path);
    if (is_file($path)) {
        include_once($path);
        return;
    }
});

$route = '';
if (isset($_GET['route']))
    $route = $_GET['route'];


$core = Core::get();
$core->run($route);
$core->done();
