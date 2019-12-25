<?php

namespace application\models;

use application\core\Model;

class Category extends Model
{

    public function get_category_news($category)
    {
        $news = $this->db->getAll("SELECT `id`, `title`, `link`, `description`, `img`, `source`, `parse_type`,  `category`, `pubDate` FROM ?n WHERE category=?s", 'news', $category);
        return $news;
    }
}