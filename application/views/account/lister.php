
<div class="container">
    <p style="text-align: center"><?=$text['header']?></p>

    <?
        if($users)
        {
            ?>
            <p style="text-align: center"><b><?=$text['list_name']?></b></p>

            <div class="row">
                    <?
                    $i = 0;
                    foreach ($users as $key => $value)
                    {?>
                            <div class="col-sm-4"><?=$value['id']?></div>
                            <div class="col-sm-8"><?=$value['name']?></div>
                    <?}?>
                </div>
        <?}
    ?>

</div>