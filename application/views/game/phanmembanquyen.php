<div class="home_boby">
    <div class="content_body">
        <div class="z_content ">
            <div class="z_maxwith">
                <div class="z_main_content">
                    <div class="box-game-bq commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dash_gamebq"></div>
                                <h2 class="font_size32 font_clor_w">PHẦN MỀM BẢN QUYỀN</h2>
                                <img src="<?= site_main() ?>images/home/gamebq.png" alt="ảnh tiêu đề">
                            </div>
                        </div>
                        <div class="entry-content-3 font_18">
                            <?php foreach ($game_bq as $val) { ?>

                                <a class="box-game-bq-item  font_clor_w" href="/<?= $val['alias'] ?>/">
                                    <div class="thumb-bq">
                                        <img src="<?= site_main().$val['image'] ?>" alt="thumb game bản quyền">
                                    </div>
                                    <p><?= $val['name'] ?></p>
                                    <span><?= number_format($val['price']) ?>đ</span>
                                </a>
                            <?php } ?>
                        
                        </div>
                        <!-- <div class="btn-xem-them">
                            <a href="#">Xem thêm</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>