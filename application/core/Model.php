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
    static $category_list;

    public function __construct($lang_text)
    {
        $this->lang_text = $lang_text;
        $this->db = new Db();
        Model::$category_list = $this->get_categories();
    }

    public function get_categories()
    {
        $result = $this->db->getAll("SELECT `id`, `name`, `eng_name`, `url` FROM ?n", 'categories');
        return $result;
    }


}