<?php
/**
 * Created by PhpStorm.
 * User: irami
 * Date: 24.08.2019
 * Time: 18:00
 */

namespace application\models;

use application\core\Model;

class Account extends Model
{

    public function validate($input, $post) {

        $lang_text = $this->lang_text;
        $all_error = [];

        $rules = [

            'first_name' => [
//                'pattern' => '#^[a-zA-Zа-Я]{2,15}$#',
                'pattern' => '/^[A-Za-zА-Яа-я ]{2,13}$/u',
                'message' => $lang_text['error_firstname'],
            ],
            'last_name' => [
                'pattern' => '/^[A-Za-zА-Яа-я ]{2,13}$/u',
                'message' => $lang_text['error_lastname'],
            ],
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => $lang_text['error_email'],
            ],
            'login' => [
                'pattern' => '#^[a-zA-Z0-9]{3,15}$#',
                'message' => $lang_text['error_login'],
            ],
            'password' => [
                'pattern' => '#^[a-z0-9]{5,30}$#',
                'message' => $lang_text['error_password'],
            ],
        ];


        foreach ($input as $val)
        {
            if ((!isset($post[$val]) || !preg_match($rules[$val]['pattern'], $post[$val])) && isset($rules[$val])) //Проверка по регулярным выражениям
            {
                $all_error[$val] = $rules[$val]['message'];

            }

            if($val == 'email')
            {
                $email = str_valid($post['email']);
                $duplicate = $this->db->getRow("SELECT `id` FROM ?n WHERE UPPER(email) = UPPER(?s)", 'users', $email);

                if($duplicate) //Проверка есть ли дубликат у email
                {
                    $all_error['email'] = $lang_text['error_email_repeat'];
                }
            }

            if($val == 'login_repeat') //проверка, нужно ли проверять логин на дубликат
            {
                $login = str_valid($post['login']);
                $duplicate = $this->db->getRow("SELECT `id` FROM ?n WHERE UPPER(login) = UPPER(?s)", 'users', $login);

                if($duplicate) //Проверка есть ли дубликат у логина
                {
                    $all_error['login'] = $lang_text['error_login_repeat'];
                }
            }
        }


        if(!empty($all_error))
        {
            $this->error = $all_error;
            return false;
        }
        else
        {
            return true;
        }
    }

    public function login($login, $password)
    {
        $secrit_str = 'lis secret';

        $password = md5( $secrit_str . md5(str_valid($password)));
        $data = $this->db->getRow('SELECT id, login FROM ?n WHERE login = ?s AND password = ?s', 'users', $login, $password);
        return $data;
    }

    public function registration($data)
    {
        $secrit_str = 'lis secret';

        $first_name = mb_ucfirst($data['first_name'], 'UTF-8');
        $last_name = mb_ucfirst(str_valid($data['last_name']), 'UTF-8');
        $login = str_valid($data['login']);
        $email = str_valid($data['email']);
        $password = md5( $secrit_str . md5(str_valid($data['password'])));

        $this->db->query("INSERT INTO ?n (first_name, last_name, login, email, password, avatar, last_log_in) VALUES (?s, ?s, ?s, ?s, ?s, ?s, ?s)", 'users', $first_name, $last_name, $login, $email, $password, $data['avatar'], time());

    }


}