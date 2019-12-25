<?php

namespace application\core;

use application\core\View;

abstract class Controller
{

    public $route;
    public $view;
    public $model;

    public $user; //Возможно переделать
    public $config;
    public $lang_text;

//    public $error = []; хз зачем здесь это, нужно проверить

    public function __construct($route)
    {
        $this->user = $_SESSION['account'];
        $this->config = $this->get_config();
        $this->route = $route;

        $this->lang_text = $this->get_lang_file();//Подключение языкового файла, возможно переделать



        $this->view = new View($route, $this->user, $this->lang_text, $this->config); //Создаем объект класса View, передаем параметры $route, $lang и $user

        $this->check_acl(); //Проверяем, есть ли у данного пользователя доступ к старнице
        $this->model = $this->load_model($route['controller'], $this->lang_text);





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

//        vd($this->route['acl']);
//        vd($user_role);
//        die();

        if($this->route['acl']) {
            if (!$this->route['acl'][$user_role]) {
                $this->view->redirect('');
            }
        }
    }

    public function load_model($controller, $lang_text)
    {
        $path = 'application\models\\' . ucfirst($controller);

        if (class_exists($path))
        {
            return new $path($lang_text);
        }
        else
        {
//            View::errorCode(404); // Пока закомментировал, может это вообще не нужно
        }
    }

    public function get_config()
    {
        $configs = [                        //Дефолтные настройки
                'lang' => 'ru',             //Язык системы
                'alert' => '0'              //Уведомления, вкл/выкл
            ];

        if($_SESSION['account'])
        {
            //Брать из базы и сохранить в сессии
            if($_SESSION['config']['lang'] == 'en')
            {
                $configs['lang'] = 'en';
            }
            else
            {
                $configs['lang'] = 'ru';
            }
        }
        elseif (isset($_SESSION['config']))
        {
            $configs = [ //Дефолтные настройик
                'lang' => $_SESSION['config']['lang'],      //Язык системы
//                'alert' => '0'                            //Уведомления, вкл/выкл
            ];
        }

        return $configs;

    }

    public function get_lang_file(){

        $all_lang_arr = [];
        $common_lang_file = $_SERVER['DOCUMENT_ROOT'] . '/application/language/' . $this->config['lang'] . '/common_lang_file.php';
        $path = $_SERVER['DOCUMENT_ROOT'] . '/application/language/' . $this->config['lang'] . '/' . $this->route['controller'] . '.php';

        if(file_exists($common_lang_file))
        {
            $all_lang_arr = include $common_lang_file;  //Общие элементы на сайте (кнопки, маски и т.д.)
        }

        if(file_exists($path))
        {
            $all_lang_arr = include $path;              //Языковые файлы которые относятся только к определенно контроллеру


        }

        return $all_lang_arr;

    }

}