<?php

//acl - access control list

return
[
    '' =>
        [
          'controller' => 'main',
          'action' =>  'index'
        ],

    'account/register' =>
        [
            'controller' => 'account',
            'action' => 'register',
            'acl' => [
                'guest' => true,
                'authorize' => false,
                'admin' => false
            ]
        ],

    'account/login' =>
        [
            'controller' => 'account',
            'action' => 'login',
            'acl' => [
                'guest' => true,
                'authorize' => false,
                'admin' => false
            ]
        ],

    'account/logout' =>
        [
            'controller' => 'account',
            'action' => 'logout',
            'acl' => [
                'guest' => false,
                'authorize' => true,
                'admin' => true
            ]
        ],

    'account/lister' =>
        [
            'controller' => 'account',
            'action' => 'lister',
            'acl' => [
                'guest' => true,
                'authorize' => true,
                'admin' => true
            ]
        ],

    'config/lang' =>
        [
            'controller' => 'config',
            'action' => 'choose_lang',
            'acl' => [
                'guest' => true,
                'authorize' => true,
                'admin' => true
            ]
        ],




];

