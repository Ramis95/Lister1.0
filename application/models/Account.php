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
    public function show_who_winner()
    {
        $user_list = $this->db->getAll("SELECT * FROM ?n",'users');

        return $user_list;
    }

    public function validate($input, $post) {
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail адрес указан неверно',
            ],
            'login' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Логин указан неверно (разрешены только латинские буквы и цифры от 3 до 15 символов',
            ],
            'ref' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Логин пригласившего указан неверно',
            ],
            'wallet' => [
                'pattern' => '#^[A-z0-9]{3,15}$#',
                'message' => 'Кошелек Perfect Money указан неверно',
            ],
            'password' => [
                'pattern' => '#^[a-z0-9]{3,30}$#',
                'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 3 до 30 символов',

            ],
        ];
        foreach ($input as $val) {
            if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }
        return true;
    }

    public function login($login) {
        $data = $this->db->getRow('SELECT id,name FROM ?n WHERE name = ?s', 'users', $login);
        $_SESSION['account'] = $data;
    }


}