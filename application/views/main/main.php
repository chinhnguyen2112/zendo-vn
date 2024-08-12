<div class="home_boby">

    <div class="content_body">

        <div class="z_content ">

            <div class="z_slider">

                <div class="list_banner">
                    <div class=" show_slick ">
                        <div class="banner_home_2">
                            <img class="img_banner " src="<?= site_main() ?>images/banner_home.png" alt="banner">
                            <a href="https://zendo.vn/doi-acc-cu-len-doi-acc-moi/" target="_blank" class="a_banner">
                                <p class="span_banner">Xem thêm</p>
                            </a>
                        </div>
                        <div class="banner_home">
                            <img class="img_banner " src="<?= site_main() ?>images/banner_home_20.png" alt="banner">
                        </div>
                    </div>

                </div>

                <div class="slide-show dis-flex">
                    <div class=" show_slick_2 ">
                        <div class="box_slide_nav">
                            <a href="/diem-danh-nhan-qua/">
                                <img src="<?= site_main() ?>images/home/easter-sale.png" alt="điểm danh nhận quà">
                            </a>
                        </div>
                        <div class="box_slide_nav">
                            <a href="/ve-so-may-man/">
                                <img src="<?= site_main() ?>images/home/winter-sale.png" alt="vé số may mắn">
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="z_maxwith">

                <div class="z_main_content">
                    <div class="box-dmnb commom-row">
                        <div class="entry-content-danhmuc ">
                            <div class="item-cont" onclick="$('.popup_no_click').show();">
                                <div class="item-left">
                                    <img src="<?= site_main() ?>images/home/purchase.png" alt="purchase">
                                </div>
                                <div class="item-right">
                                    <p class="font-dam font_clor_w">Làm việc</p>
                                </div>
                            </div>
                            <div class="item-cont" onclick="$('.popup_no_click').show();">
                                <div class="item-left">
                                    <img src="<?= site_main() ?>images/home/dashboard.png" alt="Dashboard">
                                </div>
                                <div class="item-right">
                                    <p class="font-dam font_clor_w">Giải tri</p>
                                </div>
                            </div>
                            <div class="item-cont" onclick="$('.popup_no_click').show();">
                                <div class="item-left">
                                    <img src="<?= site_main() ?>images/home/vesting.png" alt="Vesting">
                                </div>
                                <div class="item-right">
                                    <p class="font-dam font_clor_w">Học tập</p>
                                </div>
                            </div>
                            <div class="item-cont" onclick="$('.popup_no_click').show();">
                                <div class="item-left">
                                    <img src="<?= site_main() ?>images/home/staking.png" alt="staking">
                                </div>
                                <div class="item-right">
                                    <p class="font-dam font_clor_w">Spotify</p>
                                </div>
                            </div>
                            <div class="item-cont" onclick="$('.popup_no_click').show();">
                                <div class="item-left">
                                    <img src="<?= site_main() ?>images/home/ranking1.png" alt="Ranking">
                                </div>
                                <div class="item-right">
                                    <p class="font-dam font_clor_w">Wallet</p>
                                </div>
                            </div>
                            <div class="item-cont" onclick="$('.popup_no_click').show();">
                                <div class="item-left">
                                    <img src="<?= site_main() ?>images/home/referral.png" alt="Refferal">
                                </div>
                                <div class="item-right">
                                    <p class="font-dam font_clor_w">Youtube</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-acc-vip commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dash_shopacc_vip"></div>
                                <h2 class="font_size32 font_clor_w">TUẦN LỄ GIẢM GIÁ</h2>
                                <img src="<?= site_main() ?>images/home/triangle.png" alt="ảnh tiêu đề">
                            </div>
                        </div>
                        <div class="ds_acc">
                            <div class="entry-content">
                                <?php foreach ($acc_lq as $key => $val) {
                                    if ($val['user_id'] > 0) {
                                        $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$val['user_id']}'");
                                        $url_img = site_post($source_url['source']);
                                    } else {
                                        $url_img = site_main();
                                    } ?>
                                    <div class="box__list_danhmuc box__list_danhmuc_edit">
                                        <a href="/tai-khoan-<?= $val['id_post'] ?>/">
                                            <img src="<?= $url_img ?>assets/files/thumb/<?= $val['id_post'] ?>.jpg" alt="chi tiết acc" class="image-thumnail">
                                            <div class="tag"><img src="<?= site_main() ?>images/tag/tag_vip.png" /></div>


                                            <div class="box_detail_danhmuc box_detail_danhmuc_edit">
                                                <p class="count_acc count_acc_edit">
                                                    <span>Mã số: <span class="num_count"><?= $val['id_post'] ?></span> </span>
                                                    <span>Giá: <span class="num_count"><?= number_format($val['price']) ?></span> </span>
                                                </p>
                                                <ul>
                                                    <li class="li_ac"><?= $val['champs_count'] ?> tướng</li>
                                                    <li class="li_ac"><?= $val['skins_count'] ?> trang phục</li>
                                                    <li class="li_ac">Rank <?= get_string_rank($val['rank']) ?></li>
                                                    <li class="li_ac">Ngọc <?php echo $val['ip_count']; ?> </li>
                                                </ul>
                                            </div>
                                            <div class="box_price_danhmuc">
                                                <span><?= number_format($val['price']) ?>đ</span>
                                            </div>
                                            <p><span class="btn_buy">MUA NGAY</span></p>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="btn-xem-them">
                            <a href="/shop-lien-quan/">Xem thêm</a>
                        </div>
                    </div>
                    <div class="box-game-bq commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dash_gamebq"></div>
                                <h2 class="font_size32 font_clor_w">GAME BẢN QUYỀN</h2>
                                <img src="<?= site_main() ?>images/home/gamebq.png" alt="ảnh tiêu đề">
                            </div>
                        </div>
                        <div class="entry-content-3 font_18">
                            <?php foreach ($game_bq as $val) { ?>


                                <a class="box-game-bq-item  font_clor_w" href="/<?= $val['alias'] ?>/">
                                    <div class="thumb-bq">
                                        <img src="/<?= $val['image'] ?>" alt="thumb game bản quyền">
                                    </div>
                                    <p><?= $val['name'] ?></p>
                                    <span><?= number_format($val['price']) ?>đ</span>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="btn-xem-them" onclick="window.location.href='/game-ban-quyen/' ">
                            <a href="/game-ban-quyen/">Xem thêm</a>
                        </div>
                    </div>
                    <div class="box-game-bq commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dash_gamebq"></div>
                                <h2 class="font_size32 font_clor_w">PHẦN MỀM BẢN QUYỀN</h2>
                                <img src="<?= site_main() ?>images/home/gamebq.png" alt="ảnh tiêu đề">
                            </div>
                        </div>
                        <div class="entry-content-3 font_18">
                            <?php foreach ($phanmem_bq as $val) { ?>


                                <a class="box-game-bq-item  font_clor_w" href="/<?= $val['alias'] ?>/">
                                    <div class="thumb-bq">
                                        <img src="/<?= $val['image'] ?>" alt="thumb game bản quyền">
                                    </div>
                                    <p><?= $val['name'] ?></p>
                                    <span><?= number_format($val['price']) ?>đ</span>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="btn-xem-them" onclick="window.location.href='/phan-mem-ban-quyen/' ">
                            <p><a href="/phan-mem-ban-quyen/">Xem thêm</a></p>
                        </div>
                    </div>
                    <div class="box-shopacc commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dash_shopacc"></div>
                                <h2 class="font_size32 font_clor_w">SHOP TÀI KHOẢN GAME</h2>
                                <img src="<?= site_main() ?>images/home/shopacc.png" alt="ảnh tiêu đề">
                            </div>
                        </div>
                        <div class="list_vqmm_edit list_box_ct list_vqmm">
                            <div class="box_vqmm">
                                <a href='/shop-lien-quan/'>
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_lq.png" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_lq.png" alt="shop game liên quân mobile"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href='/shop-free-fire/'>
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_ff.jpg" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_ff.png" alt="shop game free fire"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href='/shop-pubg-mobile/'>
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_pubg.jpg" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_pubg.png" alt="shop game pubg mobile"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href='/shop-lien-minh-huyen-thoai/'>
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_lmht.jpg" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_lmht.png" alt="shop game liên minh huyền thoại"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href='/shop-fifa-online/'>
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_lmht.jpg" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_fifa.png" alt="shop game fifa"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href="/shop-lien-minh-toc-chien/">
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_dota.jpg" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_lmtc.png" alt="shop game liên minh tốc chiến"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href="/shop-dot-kich/">
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_csgo.jpg" alt="vòng quay may mắn">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_cf.png" alt="shop game cf"></p>
                                </a>
                            </div>
                            <div class="box_vqmm">
                                <a href="/shop-valorant/">
                                    <img class="img_bgr_vx " src="<?= site_main() ?>images/home/img_list_valorant.jpg" alt="valorant">
                                    <p class="p_img"><img class="img_this_vx " src="<?= site_main() ?>images/home/logo_valorant.png" alt="shop game valorant"></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-thanh-toan dis-flex commom-row">
                        <div class="item-tt1 mb-d-flex">
                            <p class="font_clor_w font_size32 line-hei48">Giảm giá hấp dẫn khi thanh toán bằng ATM và MOMO  </p>
                        </div>
                        <div class="box-nh dis-flex">
                            <div class="item-momo item-tt-cont">
                                <div class="font_clor_w">
                                    <img src="<?= site_main() ?>images/home/momo.png" alt="thanh toán momo">
                                    <p>Giảm đến 25%</p>
                                </div>
                            </div>
                            <div class="item-tpbank item-tt-cont">
                                <div class="font_clor_w">
                                    <img src="<?= site_main() ?>images/home/tech.png" alt="thanh toán tech">
                                    <p>Giảm đến 25%</p>
                                </div>
                            </div>
                            <div class="item-tpbank item-tt-cont">
                                <div class="font_clor_w">
                                    <img src="<?= site_main() ?>images/home/tpbank.png" alt="thanh toán tpbank">
                                    <p>Giảm đến 25%</p>
                                </div>
                            </div>
                            <div class="item-bidv item-tt-cont">
                                <div class="font_clor_w">
                                    <img src="<?= site_main() ?>images/home/bidv.png" alt="thanh toán bidv">
                                    <p>Giảm đến 25%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-chuyen-dong commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dash_cdong"></div>
                                <h2 class="font_size32 font_clor_w">CHUYỂN ĐỘNG GAME</h2>
                                <img src="<?= site_main() ?>images/home/chuyendonggame.png" alt="ảnh tiêu đề">
                            </div>
                        </div>
                        <div class="entry-content-3_2">
                            <?php foreach ($blog_gerena as $val) {  ?>
                                <a href="/<?= $val['alias'] ?>/" class="font_clor_w commom-cd images_w100">
                                    <img class="img_blog_main" src="<?php if ($val['image'] != null) {
                                                                        echo $val['image'];
                                                                    } else {
                                                                        echo '/assets/user/chuyenmuc/garena-blog.png';
                                                                    } ?>" alt="chuyển động game">
                                    <p class="font_clor_w entry-title p_title_game" style="margin:16px 0;"><?= $val['title'] ?></p>
                                    <p class="data-posted font_clor_brown p_title_game"><?= $val['meta_des'] ?></p>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>