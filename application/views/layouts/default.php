<!DOCTYPE html>
<html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="/public/libs/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/public/css/main.css">
    <script src="/public/libs/js/jquery.js"></script>
    <script src="/public/libs/js/popper.js"></script>
    <script src="/public/libs/js/bootstrap.js"></script>



<!--    <link href="/public/image/icon/favicon.png" rel="shortcut icon">-->
</head>

    <body>

    <main>

        <div class="header">

            <pre>
                <?vd($config);?>
            </pre>

            <div class="container">
                <div class="row">
                    <?if(isset($user['id'])){?>
                        <div class="our_button">
                            <button class="btn btn-primary log_out"><?=$text['logout']?></button>
                        </div>
                    <?}else{?>
                        <a class="btn btn-info" href="/account/login"><?=$text['login']?></a>
                    <?}?>


                </div>
            </div>

        </div>


        <?
        if (isset($content)) {
            echo $content; //Вывод основного контента на стр.

        } else {

            echo 'Нет контента';

        } ?>
    </main>

    <script src="/public/js/main.js"></script>

    </body>
</html>