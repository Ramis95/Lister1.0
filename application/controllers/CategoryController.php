<?php

namespace application\controllers;

use application\core\Controller;

Class CategoryController extends Controller
{

    public $category_inf = [];

    public function __construct($route)
    {
        parent::__construct($route);
    }

    function __set($name, $value)
    {
        $this->category_inf[$name] = $value;
    }

    function __get($name)
    {
        return $this->category_inf[$name];
    }

    public function show_categoryAction()
    {
        $category = $this->category;
        $result['news'] = $this->model->get_category_news($category);
        $this->view->render('title', $result);
    }

}