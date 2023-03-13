<?php error_reporting(1);  ?>
<div id="items_bag">

    <div class="items_bag">

        <h2>KHO VẬT PHẨM</h2>

        <div class="main_items_bag">

            <div class="search_item">

                <p>Tìm kiếm một vật phẩm cụ thể</p>

                <div class="search_item_input">

                    <div onclick="search_item()" class="search_item_img">

                        <img src="<?= site_main() ?>images/cayrank/icon_search.svg" alt="search_icon">

                    </div>

                    <input class="inp_search_item" type="text" name="" placeholder="Gõ tên vật phẩm bạn muốn tìm..." id="search_item">

                </div>

            </div>



            <div class="box_items_bag">

                <div class="list_items_container">

                    <div class="list_items_bag">

                        <p class="not_item" style="display: none;">Không có vật phẩm nào</p>

                        <?php foreach ($count as $key => $val) {

                            if ($val['count_item'] > 0) { ?>

                                <div onclick="click_img(this)" class="item_bag <?php if ($key == 0) {

                                                                                    echo 'border_item';
                                                                                } ?>" data-type="<?= $val['type_item'] ?>" data-zen="<?= $val['zen'] ?>" data-des="<?= $val['des'] ?>" data-value_use="<?= $val['value_use'] ?>" data-count="<?= $val['count_item'] ?> " data-count_qh="<?= $count_1['val_item'] ?> ">

                                    <span class="quantity" data-count="<?php if ($val['count_item'] > 0) {

                                                                            if ($val['type_item'] == 1) {

                                                                                echo ($count_1['val_item'] - $count_vp['count_vp']);
                                                                            } else {

                                                                                echo $val['count_item'];
                                                                            }
                                                                        } ?>"><?php if ($val['count_item'] > 1) {

                                                                                    if ($val['type_item'] == 1) {

                                                                                        echo ($count_1['val_item'] - $count_vp['count_vp']);
                                                                                    } else {

                                                                                        echo $val['count_item'];
                                                                                    }
                                                                                }

                                                                                if ($val['count_item'] == 1 && $val['type_item'] == 1) {

                                                                                    echo (($count_1['val_item'] - $count_vp['count_vp']) == 1) ? "" : $count_1['val_item'] - $count_vp['count_vp'];
                                                                                }

                                                                                ?></span>

                                    <img class="img_item" data-name="<?= $val['name'] ?>" data-id="<?= $val['id_gift'] ?>" src="<?= site_main() ?><?= $val['image'] ?>" alt="item_img">

                                </div>

                        <?php   }
                        } ?>

                    </div>

                </div>
                <div class="des_item des_none">

                    <?php if (isset($_SESSION['user']['username'])) { ?>
                        <div class="img_des_item">
                            <img class="des_img_item" src="<?= site_main() ?><?php if (count((array)$count) > 0) {

                                                                                    echo $count[0]['image'];
                                                                                } else {

                                                                                    echo 'images/khodo/lq_img.png';
                                                                                } ?>" alt="item_img">

                        </div>



                        <span class="item_name"><?php if ($count[0]['type_item'] == 1) {

                                                    echo ($count_1['val_item'] - $count_vp['count_vp']) . ' quân huy';
                                                } else {

                                                    echo $count[0]['name'];
                                                } ?></span>



                        <div class="level_item">

                            <img src="<?= site_main() ?>images/khodo/lq_img_small.png" alt="game_icon">



                            <div class="text_level_item">

                                <p>Liên Quân Mobile</p>

                                <span class="type_item"></span>

                            </div>

                        </div>
                        <div class="text_des_item">

                            <p class="des"><?= (isset($count[0]['des']))? $count[0]['des'] : '' ?></p>
                        </div>
                        <div class="send_item" style="<?php if (count((array)$count) <= 0) {

                                                            echo 'display: none;';
                                                        } else {

                                                            echo '';
                                                        } ?>">

                            <p class="sell_item_btn">BÁN (<span class="zen_item"><?php echo number_format($count[0]['zen']); ?></span> Zen)</p>

                            <p class="send_item_btn">RÚT VẬT PHẨM</p>

                        </div>



                    <?php } ?>





                </div>



            </div>



        </div>



    </div>

</div>



<div class="des_items_popup des_popup_none">

    <div class="des_item">

        <div class="close_des_popup">

            <img src="<?= site_main() ?>images/khodo/close-circle.svg" alt="close-btn">

        </div>

        <div class="img_des_item">

            <img class="des_img_item" src="<?= site_main() ?><?php echo $count[0]['image']; ?>" alt="item_img">

        </div>



        <span class="item_name_popup"><?php echo $count[0]['name']; ?></span>

        <div class="level_item">

            <img src="<?= site_main() ?>images/khodo/lq_img_small.png" alt="game_icon">



            <div class="text_level_item">

                <p>Liên Quân Mobile</p>

            </div>

        </div>



        <div class="text_des_item">

            <p class="des"></p>



        </div>



        <div class="send_item">

            <p class="sell_item_btn">BÁN (<span class="zen_item"><?php echo number_format($count[0]['zen']); ?></span>

                Zen)</p>

            <p class="send_item_btn">RÚT VẬT PHẨM</p>

        </div>





    </div>



</div>



<!-- popup thong bao chung -->

<div class=" popup_notice_chung popup_lienhe popup_notice_none">

    <div class="content_popup">

        <div class="title_popup">THÀNH CÔNG</div>

        <div class="body_pupup">

            <p>Bây giờ bạn hãy liên hệ fanpage để cập nhật về đơn hàng</p>

        </div>

        <div class="close_popup_gt">

            <a href="https://www.facebook.com/Zendoshopvn/">LIÊN HỆ FANPAGE</a>

            <p class="close_notice_btn close_popup_lienhe">ĐÓNG LẠI</p>

        </div>

    </div>

</div>



<div class="popup_notice_chung popup_sell_item popup_notice_none">

    <div class="content_popup">

        <div class="title_popup">BÁN VẬT PHẨM</div>

        <div class="body_pupup">

            <p>Nhập số lượng mà bạn muốn bán</p>

            <div class="buttons_added">

                <input class="minus is-form" type="button" value="-">

                <input aria-label="quantity" class="input-qty input_qty_ban" max="999" min="1" name="" type="number" value="1">

                <input class="plus is-form" type="button" value="+">

            </div>

        </div>

        <div class="close_popup_gt">

            <p class="confirm_notice_btn confirm_sell_item">BÁN</p>

            <p class="close_notice_btn close_popup_sell">ĐÓNG</p>

        </div>

    </div>

</div>



<div class="popup_notice_chung popup_count_amount popup_notice_none">

    <div class="content_popup">

        <div class="title_popup">THẤT BẠI</div>

        <div class="body_pupup">

            <p>Số lượng vật phẩm không không phù hợp!</p>

        </div>

        <div class="close_popup_gt">

            <p class="close_notice_btn close_count_amount">ĐÓNG</p>

        </div>

    </div>

</div>



<div class="popup_notice_chung popup_disable_item popup_notice_none">

    <div class="content_popup">

        <div class="title_popup">THẤT BẠI</div>

        <div class="body_pupup">

            <p>Vật phẩm này không thể rút!</p>

        </div>

        <div class="close_popup_gt">

            <p class="close_notice_btn close_disable_item">ĐÓNG</p>

        </div>

    </div>

</div>



<div class="popup_notice_chung popup_rut_vp popup_notice_none">

    <div class="content_popup">

        <div class="title_popup">RÚT VẬT PHẨM</div>

        <div class="body_pupup">

            <p>Nhập số lượng mà bạn muốn rút</p>

            <p class="notice_value_use"></p>

            <div class="buttons_added">

                <input class="minus is-form" type="button" value="-">

                <input aria-label="quantity" class="input-qty input_qty_rut" max="999" min="1" name="" type="number" value="1">

                <input class="plus is-form" type="button" value="+">

            </div>

        </div>

        <div class="close_popup_gt">

            <p class="confirm_notice_btn confirm_rut_vp">RÚT</p>

            <p class="close_notice_btn close_rut_vp">ĐÓNG</p>

        </div>

    </div>

</div>



<script>
    var count_qh = '<?php echo $count_1['val_item'] - $count_vp['count_vp'] ?>'
</script>