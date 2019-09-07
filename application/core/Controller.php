<?php

namespace application\core;

use application\core\View;

abstract class Controller
{

    public $route;
    public $view;
    public $model;

    public $user; //Возможно переделать

    public function __construct($route)
    {
        $this->user = $_SESSION['account'];

        $this->route = $route;
        $this->view = new View($route, $this->user); //Создаем объект класса View, передаем параметры $route и $user
        $this->check_acl(); //Проверяем, есть ли у данного пользователя доступ к старнице
        $this->model = $this->load_model($route['controller']);

    }

    protected function check_acl()
    {

        $user_role = 'guest';

        if(isset($_SESSION['account']['id']))
        {

            if(isset($_SESSION['account']['group_id']) && $_SESSION['account']['group_id'] == 5)//Статус админ
            {
                $user_role = 'admin';
            }
            else
            {
                $user_role = 'authorize';
            }
        }

        if(!$this->route['acl'][$user_role])
        {
            $this->view->redirect('');
        }
    }

    public function load_model($controller)
    {
        $path = 'application\models\\' . ucfirst($controller);

        if (class_exists($path))
        {
            return new $path();
        }
        else
        {
            View::errorCode(404);
        }
    }



}