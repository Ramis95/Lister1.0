<?php
/**
 * Created by PhpStorm.
 * User: irami
 * Date: 01.06.2019
 * Time: 22:43
 */



include 'application/lib/dev.php';


use application\core\Router;
use application\cron\Parser;


spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');

    if (file_exists($path)) {
        require $path;
    }
});


if(strpos($_SERVER['REQUEST_URI'], 'cron') !== false) { // Временно


    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2); // Убираем get из адреса

    $url_arr = explode('/', $uri_parts[0]);

    $object = new Parser();
    $object->$url_arr[2]();

}
else
{

    session_start();

    $router = new Router();
    $router->run();
}






