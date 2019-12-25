<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function get_all_news()
    {
        $news = $this->db->getAll("SELECT `id`, `title`, `link`, `description`, `img`, `source`, `parse_type`,  `category`, `pubDate` FROM ?n", 'news'); //Добавить проверку на содержание на странице

        return $news;
    }

    public function get_all_source()
    {
        $result = [];
        $sources = $this->db->getAll("SELECT `id`, `name`, `link`, `img` FROM ?n", 'sources');

        foreach ($sources as $key => $value)
        {
            $result[$value['id']] = $value;
        }

        return $result;
    }

}