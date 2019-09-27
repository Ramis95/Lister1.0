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

function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}