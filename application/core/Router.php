<?php

namespace application\core;

use application\core\View;

class Router
{

    protected $routes = '';
    protected $params = [];

    public function __construct()
    {
        $this->get_url();
        $this->add_params();
    }

    public function run()
    {
        $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
        $action = $this->params['action'];

        if(class_exists($path))
        {
            if(method_exists($path, $this->params['action']))
            {
                $controller = new $path($this->params);
                $controller->$action();
            }
            else
            {
                View::errorCode(404);
            }
        }
        else
        {
            View::errorCode(404);
        }
    }

    public function get_url()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = preg_replace("/\/\/+/","/", $url); //Убираем лишние слэши
        $url = trim($url, "/"); // Убираем слэши в начале и в конце

        $this->routes = $url;
    }

    public function add_params()
    {
        $route_list = include 'application/config/routes.php';

        foreach ($route_list as $key => $value)
        {
            if($key == $this->routes)
            {
                $this->params['controller'] = $value['controller'];
                $this->params['action'] = $value['action'];
                $this->params['acl'] = $value['acl'];
            }
        }
    }


}



