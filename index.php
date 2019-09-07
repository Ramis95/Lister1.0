<?php
/**
 * Created by PhpStorm.
 * User: irami
 * Date: 01.06.2019
 * Time: 22:43
 */


include 'application/lib/dev.php';

use application\core\Router;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');

    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router();
$router->run();






