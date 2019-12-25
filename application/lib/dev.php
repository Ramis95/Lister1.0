<?php


include 'application/lib/Db.php';
use application\lib\Db;

$new_db = new Db();

function vd($str)
{
    echo '<pre>';
        var_dump($str);
    echo '</pre>';
}

function str_valid($str)//Фильтрацие строки
{
    return strip_tags(htmlspecialchars(addslashes($str)));
}

function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

function get_db_pages() //Моя функция
{
    $result = [];
    global $new_db;

    $new_result = $new_db->getAll("SELECT `id`, `url` FROM ?n", 'categories'); //Берем категории из бд
    $category_route_list = [];
    if($new_result)
    {
        foreach ($new_result as $key => $value)
        {
            $category_route_list[$value['url']] = ['controller'=> 'category', 'action'=> 'show_category', 'category_id' => $value['id']];
        }
    }

    $result = array_merge($result, $category_route_list);
    return $result;
}
