<?php
/**
 * Created by PhpStorm.
 * User: irami
 * Date: 16.08.2019
 * Time: 21:48
 */

namespace application\core;

use application\lib\Db;

abstract class Model
{

    public $db;

    public function __construct()
    {
        $this->db = new Db();
    }

}