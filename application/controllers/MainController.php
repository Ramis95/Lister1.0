<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{

    public function __construct($route)
    {

        parent::__construct($route);

    }

    public function homeAction()
    {
        $result['news'] = $this->model->get_all_news();
        $result['source'] = $this->model->get_all_source();

        $this->view->render('Что-то', $result);
    }


}