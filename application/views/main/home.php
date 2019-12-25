<div class="container-fluid">
    <p style="text-align: center"></p>

    <?
    if ($news) {
        ?>
        <div class="">


            <div class="top_line_news">
                <div class="row">

                    <div class="col-md-1"></div>

                    <div class="col-sm-5">
                        <div class="top_news_list">
                            <p class="title"><img src="/public/images/fire1.png">TOP за 24 часа</p>

                            <div class="list">
                                <?
                                $i = 0;
                                foreach ($news as $key => $value) {
                                    ?>
                                    <div class="one_news">
                                        <div class="row">
                                            <div class="col-sm-12"><p class="news_name"><?= $value['title'] ?></p></div>
                                            <div class="col-sm-12 news_hide"><?= $value['description'] ?></div>
                                            <div class="col-sm-12">
                                                <div class="news_date">
                                                    <a target="_blank" href="<?=$source[$value['source']]['link'];?>" class="source_name"><img src="<?=$source[$value['source']]['img']?>"><?=$source[$value['source']]['name'];?></a>
                                                    <p class="pub_date"><?= date("h:h", $value['pubDate']); ?>
                                                    <?= date("d/m", $value['pubDate']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                    if ($i == 3) {
                                        break;
                                    }
                                    $i++;
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="top_news_list">
                            <p class="title"><img src="/public/images/fire1.png">TOP за неделю</p>

                            <div class="list">
                                <?
                                $i = 0;
                                foreach ($news as $key => $value) {
                                    ?>
                                    <div class="one_news">
                                        <div class="row">
                                            <div class="col-sm-12"><p class="news_name"><?= $value['title'] ?></p></div>
                                            <div class="col-sm-12 news_hide"><?= $value['description'] ?></div>
                                            <div class="col-sm-12">
                                                <div class="news_date">
                                                    <a target="_blank" href="<?=$source[$value['source']]['link'];?>" class="source_name"><img src="<?=$source[$value['source']]['img']?>"><?=$source[$value['source']]['name'];?></a>
                                                    <p class="pub_date"><?= date("h:h", $value['pubDate']); ?>
                                                        <?= date("d/m", $value['pubDate']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                    if ($i == 3) {
                                        break;
                                    }
                                    $i++;
                                } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="all_news">

                <div class="row">
                    <div class="col-md-1">
                    </div>

                    <div class="col-md-10">
                        <div class="white_block">
                            <?
                            $i = 0;
                            foreach ($news as $key => $value) {
                                ?>
                                <div class="one_news">
                                    <div class="row">
                                        <div class="col-sm-4"><?= $value['title'] ?></div>
                                        <div class="col-sm-6"><?= $value['description'] ?></div>
                                        <div class="col-sm-2">
                                            <?= date("h:h", $value['pubDate']); ?>
                                            <?= date("d/m/Y", $value['pubDate']); ?></div>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
    }
    ?>

</div>