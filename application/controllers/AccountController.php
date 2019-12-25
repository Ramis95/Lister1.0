<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function loginAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['login', 'password'], $_POST))
            {
                $this->view->message('error', $this->model->error);
            }

            $user_data = $this->model->login($_POST['login'], $_POST['password']);

            if($user_data)
            {
                $_SESSION['account'] = $user_data;
                $this->view->location('');
            }
            else
            {
                $not_found['not_found'] = 'Пользователь не найден';
                $this->view->message('user_not_found', $not_found);
            }


        }
        $this->view->render('Вход');
    }

    public function logoutAction() {
        unset($_SESSION['account']);
        $this->view->location('');
    }

    public function registerAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['first_name', 'last_name', 'login_repeat', 'email', 'login', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->registration($_POST);
            $user_data = $this->model->login($_POST['login'], $_POST['password']);

            if($user_data)
            {
                $_SESSION['account'] = $user_data;
                $this->view->location('account/lister');
            }
            else
            {
                $this->view->message('403', 'Пользователь не найден');
            }


        }
        $this->view->render('Вход');
    }
}