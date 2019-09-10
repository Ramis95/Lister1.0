<?php

namespace application\core;

class View
{

    public $route;
    public $layout = 'default';
    public $lang_text;
    public $config;

    private $user;

    public function __construct($route, $user, $lang_text, $config)
    {
        $this->route = $route;
        $this->user = $user;
        $this->config = $config;
        $this->lang_text = $lang_text;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public static function errorCode($code)
    {
        http_response_code($code); //Устанавливает код ошибки
        $path = 'application/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function render($title, $vars = [])
    {
        $vars['text'] = $this->lang_text;
        $vars['config'] = $this->config;
        extract($vars); //Достаем переменные из массива
        $template = 'application/views/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';

        $user = $this->user;//Информация о авторизованном пользователе

        if(file_exists($template))
        {
            ob_start();
            require $template;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        }
        else
        {
            View::errorCode(404);
        }
    }

    public function redirect($url)
    {
        header('location: /'.$url);
        exit;
    }

    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }

}