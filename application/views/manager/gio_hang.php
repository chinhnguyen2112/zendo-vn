<?php $CI = &get_instance();  ?>

<div id="main_cart">

    <div class="main_cart">
        <span class="tit_cart">THÔNG TIN GIỎ HÀNG</span>
        <div class="body_cart">
            <div class="box_body_cart">
                <!-- box left -->
                <div class="box_left_cart">
                    <div class="left_cart_container">
                        <div class="tit_left_cart">
                            <span>CHI TIẾT GIỎ HÀNG</span>
                        </div>
                        <?php
                        foreach ($count as $key => $val) {
                            $id_account = $val['id_account'];
                            $sql_echo_account = "SELECT * FROM posts WHERE id_post = $id_account";
                            $echo_account = $CI->Account->query_sql_row($sql_echo_account);
                            $source_user = $CI->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$echo_account['user_id']}'"); 
                            $status = $echo_account['status'];
                            if ($status == 0) { ?>
                                <div class="items_cart">
                                    <div class="info_order">
                                        <div class="action_cart">
                                            <input type="checkbox" <?php if (isset($_COOKIE['id_acc']) && $val['id_account'] == $_COOKIE['id_acc']) {
                                                                        echo 'checked';
                                                                    } ?> name="choose_order" class="choose_order" data-id="<?= $val['id_account'] ?>" data-price="<?= $val['price'] ?>">
                                        </div>
                                        <img class="avata_acc" src="<?= ($echo_account['user_id'] > 0) ? site_post($source_user['source']) : site_main() ?><?= get_thumb($val['id_post']); ?>" />
                                        <div class="des_order" style="cursor: pointer;">
                                            <p class="ma_acc" data-id_post="<?= $val['id_post'] ?>">Mã số tài khoản: #<?= $val['id_account'] ?> </p>
                                            <div class="detail_order">
                                                <a href="/tai-khoan-<?= $val['id_account'] ?>/" target="blank">Chi tiết acc</a>
                                                <img src="<?= site_main() ?>images/cayrank/export.svg" alt="export_icon">
                                            </div>
                                            <div class="info_price info_price_mobile">
                                                <p>Giá tiền : <span><?= number_format($val['price']) ?> VNĐ</span></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="info_price">
                                        <div class="text_money">
                                            <p>Giá tiền: <?= number_format($val['price']) ?> VNĐ</p>


                                        </div>
                                        <img style="cursor: pointer;" class="delete_cart delete_cart_pc" onclick="delete_cart(this)" data-id_cart="<?= $val['id'] ?>" src="<?= site_main() ?>images/cayrank/trash.svg" alt="trash_btn">
                                    </div>
                                </div>


                        <?php
                            }
                        }
                        ?>
                    </div>


                </div>
                <!-- end box left -->


                <!-- box right -->
                <div class="box_right_cart">
                    <div class="box_right_container">
                        <div class="header_right_cart">
                            <p>THÔNG TIN THANH TOÁN</p>
                            <div class="logo_zendo">
                                <img src="<?= site_main() ?>images/logo.png" alt="logo_zendo">
                            </div>
                        </div>


                        <div class="body_right_cart">
                            <div class="right_cart_box">
                                <div class="right_detail_li voucher_append voucher_right_cart">
                                    <div class="box_voucher" onclick="show_popup()">
                                        <img class="img_voucher" src="<?= site_main() ?>images/detail/voucher_1.png" alt="Mã giảm giá">
                                        <span class="span_voucher">Chọn Voucher</span>
                                    </div>
                                    <p class="text_choose_voucher"></span></p>
                                    <div class="box_voucher_2">
                                        <input type="text" class="inp_voucher" placeholder="Nhập mã giảm giá" value="">
                                        <div class="span_voucher_2" onclick="apdung_voucher()">
                                            <span class="">Áp dụng</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row_info_price">
                                    <div class="row_detail">
                                        <span>Vật phẩm trong giỏ</span>
                                        <span><?= $row ?></span>
                                    </div>


                                    <div class="row_detail">
                                        <span>Tổng chi phí</span>
                                        <span class="total_price">0 VNĐ</span>
                                    </div>


                                    <div class="row_detail">
                                        <span>Tổng giảm giá</span>
                                        <span class="discount">0 VNĐ</span>
                                    </div>
                                </div>


                                <div class="row_detail row_detail_last">
                                    <span>Tổng thanh toán</span>
                                    <div class="last_price_cont">
                                        <span class="last_price last_price_new">0 VNĐ</span>
                                        <span class="last_price_zend">0 ZEN</span>
                                    </div>
                                </div>
                            </div>


                        </div>




                        <div class="footer_right_cart">
                            <div class="pay_cart_btn">
                                <span>THANH TOÁN TIỀN MẶT</span>
                            </div>
                            <div class="gh_dash" style="margin:15px 0;">
                            </div>
                             <div class="pay_cart_btn_zend">
                                <span>THANH TOÁN BẰNG ZEN</span>
                            </div>
                            <div class="list_social">
                                <img src="<?= site_main() ?>images/detail/atm_banking.png" alt="img_social">
                                <img src="<?= site_main() ?>images/detail/visa.png" alt="img_social">
                                <img src="<?= site_main() ?>images/detail/paypal.png" alt="img_social">
                                <img src="<?= site_main() ?>images/detail/momo.png" alt="img_social">
                            </div>
                            <div class="see_more">
                                <a href="/shop-lien-quan/" target="blank">Xem thêm sản phẩm</a>
                                <!-- <img src="" alt="arrow_left"> -->
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end box right -->


            </div>
        </div>

    </div>

</div>



<!-- thông báo chọn voucher -->

<div class="box_noti_gif popup_voucher" style="display: none;">

    <div class="body_gif">
        <div class="title_noti_gif">
            <span class="noti_title_gif">Chọn voucher</span>
        </div>
        <div class="body_noti_gif">
            <div class="body_gif_nav">




            </div>
        </div>
        <div class="box_close_gif">
            <span class="span_close_gif" onclick="$('.popup_voucher').hide();">Đóng</span>
            <span class="span_close_gif btn_lg" style="background: #e67300 " onclick="append_voucher()">Áp dụng</span>
        </div>

    </div>

</div>



<input type="" name="" id="id_voucher" value="" hidden>

<input type="" name="" id="val_voucher" value="" hidden>

<script>

  var id_user = '<?= $_SESSION['user']['id'] ?>';

      var cash = '<?= $_SESSION['user']['cash'] ?>';

</script>