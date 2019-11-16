<!DOCTYPE html>
<html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <![endif]-->
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <link rel="stylesheet" type="text/css" href="/public/libs/css/bootstrap.css">
    <link rel="stylesheet" href="/public/libs/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/public/css/fonts/CeraPro/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="/public/css/main.css">


    <script src="/public/libs/js/jquery.js"></script>
    <script src="/public/libs/js/popper.js"></script>
    <script src="/public/libs/js/bootstrap.js"></script>
    <script src="/public/libs/js/bootstrap-select.min.js"></script>
    <!--    <link href="/public/image/icon/favicon.png" rel="shortcut icon">-->
</head>
<body>

<main>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1 header_grey">
                <div class="row">
                    <div class="header">

                        <a href="/" class="header_logo_block">
                            Название сайта
                        </a>

                        <div class="header_button">

                            <div class="choose_lang_block">

                                <? $this_lang = $config['lang']; ?>

                                <? $current_url = $this->route['controller'] . '/' . $this->route['action']; ?>

                                <form action="/config/lang" method="POST" type="ajax" class="">
                                    <input type="hidden" name="current_url" value="<?= $current_url ?>">
                                    <select class="select_send_ajax selectpicker" name="new_lang">
                                        <option <?= $this_lang == 'ru' ? 'selected disabled' : 'value="ru"' ?>>Руc
                                        </option>
                                        <option <?= $this_lang == 'en' ? 'selected disabled' : 'value="en"' ?>>Eng
                                        </option>
                                    </select>
                                </form>
                            </div>

                            <? if (isset($user['id'])) { ?>
                                <div class="our_button">
                                    <a class="btn btn-primary log_out"><?= $text['logout'] ?></a>
                                </div>
                            <? } else { ?>
                                <div>
                                    <a class="btn btn-info" href="/account/login"><?= $text['login'] ?></a>
                                </div>
                                <div>
                                    <a class="btn btn-warning" href="/account/register"><?= $text['register'] ?></a>
                                </div>
                            <? } ?>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-11">
                <div class="row">
                    <div class="page_content">
                        <p class="page_content_title"><?= $text['header'] ?></p>
                        <?
                        if (isset($content)) {
                            echo $content; //Вывод основного контента на стр.

                        } else {

                            echo 'Нет контента';

                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="/public/js/main.js"></script>

</body>
</html>