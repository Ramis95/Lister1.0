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
    public $lang_text;

    public function __construct($lang_text)
    {
        $this->lang_text = $lang_text;
        $this->db = new Db();
    }

}