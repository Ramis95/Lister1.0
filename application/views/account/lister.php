
<div class="container">
    <p style="text-align: center"><?=$text['header']?></p>

    <?
        if($news)
        {
            ?>
            <p style="text-align: center"><b><?=$text['pg_title']?></b></p>

            <div class="row">

                <?

                    $i = 0;
                    foreach ($news as $key => $value)
                    {?>
                            <div class="col-sm-3">Название: <?=$value['title']?></div>
                            <div class="col-sm-8"><?=$value['description']?></div>
                            <div class="col-sm-1">Дата: <?=$value['pubDate']?></div>
                    <?}?>
                </div>
        <?}
    ?>

</div>