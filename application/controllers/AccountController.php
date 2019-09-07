<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function lister()
    {
        $result['users'] = $this->model->show_who_winner();

        $this->view->render('Что-то', $result);
    }

    public function login()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['login', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->login($_POST['login']);
            $this->view->location('account/lister');
        }
        $this->view->render('Вход');
    }

    public function logout() {
        unset($_SESSION['account']);
        $this->view->location('/account/lister');
    }

}