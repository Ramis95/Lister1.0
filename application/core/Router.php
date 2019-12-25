<?php

namespace application\core;

use application\core\View;
use application\lib\Db;

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
        $action = $this->params['action'] . 'Action';

        if(class_exists($path))
        {
            if(method_exists($path, $action))
            {

                $controller = new $path($this->params);

                if($this->params['controller'] == 'category')
                {
                    $controller->category = $this->params['category'];
                }
                $controller->$action();
            }
            else
            {
                echo 'win1';
                View::errorCode(404);
            }
        }
        else
        {
            echo 'win2';
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

        //Сделать так чтобы если нет icl то делать всем доступ
        //Возможно переделать. Если поиск страниц в бд будет работать долго, то лучше сделать кэш

        $db_route_list = get_db_pages();
        $route_list = array_merge($route_list, $db_route_list);

        foreach ($route_list as $key => $value)
        {
            if($key == $this->routes)
            {
                $this->params['controller'] = $value['controller'];
                $this->params['action'] = $value['action'];
                $this->params['acl'] = $value['acl'];

                if($this->params['controller'] == 'category')
                {
                    $this->params['category'] = $value['category_id'];
                }

            }
        }


    }


}



