<?php

function vd($str)
{
    echo '<pre>';
        var_dump($str);
    echo '</pre>';
}

function str_valid($str)
{
    return strip_tags(htmlspecialchars(addslashes($str)));
}