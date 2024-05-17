<?php
use core\Core;
spl_autoload_register(static function($className) {
    $path = "./" . $className . ".php";
    $path = str_replace('\\', '/', $path);
    if (is_file($path)) {
        include_once($path);
        return;
    }    
});

$route = '';
if(isset($_GET['route']))
    $route = $_GET['route'];


$core = Core::get();
$core->run($route);
$core->done();