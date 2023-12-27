<?php
$allow = array(
    "118.70.80.165", "1.55.6.69", "14.160.25.44", '27.72.98.197', '58.186.91.102', '171.229.168.212'
);  //allowed IPs

// if (!in_array($_SERVER['REMOTE_ADDR'], $allow) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $allow)) {

// 	header("HTTP/1.1 301 Moved Permanently");
//     header("Location: https://zendo.vn");
//     exit();
// }

$CI = &get_instance();
$sql_category = "SELECT * FROM chuyenmuc ORDER BY `created_at` ASC ";
$menu_cate = $CI->Account->query_sql($sql_category);
?>
<div class="header">
    <div class="box_header">
        <div class="header_logo">
            <a href="/"><img src="<?= site_main(); ?>images/logo.png" class="header_logo_pc " alt="Logo sanacc"></a>
        </div>
        <div class="list_header">
            <div class="search_header box_btn_header_pc">
                <input type="text" id="search_header" class="input_search_header" placeholder="Tìm kiếm sản phẩm...">
                <img src="<?= site_main(); ?>images/header/search-normal.svg" alt="tìm kiếm">
            </div>
            <div class="list_nav_header">
                <span class="text_box_header hide_mb"><a href="/message/"><img src="/images/chat.svg" alt="tin nhắn"> Tin nhắn</a></span>
                <?php if (check_login()) { ?>
                    <div class="header_btn data_mb box_btn_header_pc">
                        <img class="img_avatar_user" src="<?php if (isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] !== "") {
                                                                echo '/' . $_SESSION['user']['avatar'];
                                                            } else {
                                                                echo site_main() . 'images/avt.png';
                                                            } ?>">
                        <span class="list_data_u">
                            <p>VNĐ: <?= number_format($_SESSION['user']['cash']) ?>đ </p>
                            <p class="total_zen">Zen: <?= number_format($_SESSION['user']['zen']) ?> </p>
                        </span>
                        <div class="menu_con">
                            <p class="menu_p"><span><a href="/quan-ly-tai-khoan/"><span class="menu_span">Quản lý tài khoản</span></a></span></p>
                            <p class="menu_p"><span><a href="/lich-su-choi/"><span class="menu_span">Lịch sử chơi</span></a></span></p>
                            <p class="menu_p"><span><a href="/lich-su-mua-hang/"><span class="menu_span">Lịch sử mua hàng</span></a></span></p>
                            <p class="menu_p"><span><a href="/kho-do/"><span class="menu_span">Kho đồ</span></a></span></p>
                            <?php if (is_user_seller() || is_admin()) { ?>
                                <p class="menu_p"><span><a href="/dang-ban-acc/"><span class="menu_span">Đăng bán ACC</span></a></span></p>
                                <p class="menu_p"><span><a href="/danh-sach-tai-khoan/"><span class="menu_span">Danh sách ACC bán</span></a></span></p>
                            <?php } ?>
                            <p class="menu_p"><span><a href="/logout/"><span class="menu_span">Đăng xuất</span></a></span></p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="box_btn_header box_btn_header_pc">
                        <span class="text_login"><a href="/dang-ky/">Đăng ký</a></span>
                    </div>
                    <div class="box_btn_header box_btn_header_pc">
                        <span class="text_login"><a href="/dang-nhap/">Đăng nhập</a></span>
                    </div>
                    <!-- <span class="text_login header_btn"><a class="header_btn_2">Người bán</a></span> -->
                <?php } ?>
                <div class="menu_mb header_logo_tablet  box_btn_header_mb " onclick="$('.header_list_tablet').show(100)">
                    <img src="<?= site_main(); ?>images/header/menu_con.png" alt="menu">
                </div>
            </div>
        </div>
    </div>
    <div class="box_header box_list_menu header_list_pc">
        <div class="list_menu">
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/home.png" alt="trang chủ">
                <span><a href="/">Trang chủ</a></span>
            </div>
            <div class="box_menu ">
                <img src="<?= site_main(); ?>images/header/Vector.png" alt="Cửa hàng">
                <span>Cửa hàng</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
                <div class="menu_con">
                    <p><span><a href="/shop-lien-quan/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_lq.png" alt="game liên quân mobile"><span class="menu_span">Liên Quân Mobile</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-free-fire/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_ff.png" alt="game liên quân mobile"><span class="menu_span">Free Fire</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-lien-minh-huyen-thoai/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_lmht.png" alt="game liên quân mobile"><span class="menu_span">Liên Minh Huyền Thoại</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-pubg-mobile/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_pubg.png" alt="game liên quân mobile"><span class="menu_span">PUBG Mobile</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-fifa-online/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_fo4.png" alt="game liên quân mobile"><span class="menu_span">Fifa Online 4</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-lien-minh-toc-chien/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_lmtc.png" alt="game liên quân mobile"><span class="menu_span">Liên minh tốc chiến</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-dot-kich/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_cf.png" alt="game liên quân mobile"><span class="menu_span">Đột kích</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/shop-valorant/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_valorant.png" alt="game liên quân mobile"><span class="menu_span">Valorant</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                </div>
            </div>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/game.png" alt="mini game">
                <span>Giải trí</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
                <div class="menu_con">
                    <p><span><a href="/danh-sach-idol/"><span class="menu_span">Thuê Playdoul</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/ve-so-may-man/"><span class="menu_span">Vé số may mắn</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/vong-quay-lien-quan/"><span class="menu_span">Vòng quay Liên Quân</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                </div>
            </div>
            <div class="box_menu">
                <a href="/blog/"><img src="<?= site_main(); ?>images/header/note.png" alt="tin tức"></a>
                <span><a href="/blog/">Tin tức</a></span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
                <div class="menu_con">
                    <?php
                    if (isset($menu_cate) && count($menu_cate) > 0) {
                        foreach ($menu_cate as $key => $val) {
                    ?>
                            <p><span><a href="/<?= $val['alias'] ?>"><span class="menu_span"><?= $val['name'] ?></span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/category-2.png" alt="dịch vụ">
                <span>Dịch vụ</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
                <div class="menu_con">
                    <p><span><a href="/the-game-garena/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/garena.png" alt="game liên quân mobile"><span class="menu_span">Mua thẻ</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                </div>
            </div>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/crown.svg" alt="giải trí">
                <span>Nhiệm vụ</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
                <div class="menu_con">
                    <p><span><a href="/diem-danh-nhan-qua/"><span class="menu_span">Điểm danh</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                    <p><span><a href="/nhiem-vu-moi-ngay/"><span class="menu_span">Nhiệm vụ mỗi ngày</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                </div>
            </div>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/card-pos.png" alt="nạp thẻ">
                <span><a href="/nap-the/">Nạp thẻ</a></span>
            </div>
        </div>
    </div>
    <div class="box_header box_list_menu header_list_tablet">
        <div class="box_logo_mb box_btn_header_mb">
            <img src="<?= site_main(); ?>images/logo.png" class="header_logo_pc header_logo_mb  " alt="Logo">
            <img src="<?= site_main(); ?>images/header/close.png" class="close_menu_mb header_logo_mb  " alt="Logo" onclick="$('.header_list_tablet').hide(100)">
        </div>

        <div class="search_header search_header_mb box_btn_header_mb">
            <input type="text" id="search_header" class="input_search_header" placeholder="Tìm kiếm sản phẩm...">
            <img src="<?= site_main(); ?>images/header/search-normal.svg" alt="tìm kiếm">
        </div>
        <div class="list_menu">
            <?php if (check_login()) { ?>
                <div class="header_btn data_mb" onclick="click_menu_con(this,1)">
                    <img class="img_avatar_user" src="<?php if (isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] !== "") {
                                                            echo '/' . $_SESSION['user']['avatar'];
                                                        } else {
                                                            echo site_main() . 'images/avt.png';
                                                        } ?>">

                    <span class="list_data_u">
                        <p>VNĐ: <?= number_format($_SESSION['user']['cash']) ?>đ </p>
                        <p class="total_zen">Zen: <?= number_format($_SESSION['user']['zen']) ?></p>
                    </span>
                </div>
                <div class="menu_con">
                    <p class="menu_p"><span><a href="/quan-ly-tai-khoan/"><span class="menu_span">Quản lý tài khoản</span></a></span></p>
                    <p class="menu_p"><span><a href="/lich-su-choi/"><span class="menu_span">Lịch sử chơi</span></a></span></p>
                    <p class="menu_p"><span><a href="/lich-su-mua-hang/"><span class="menu_span">Lịch sử mua hàng</span></a></span></p>
                    <p class="menu_p"><span><a href="/kho-do/"><span class="menu_span">Kho đồ</span></a></span></p>
                    <?php if (is_user_seller() || is_admin()) { ?>
                        <p class="menu_p"><span><a href="/dang-ban-acc/"><span class="menu_span">Đăng bán ACC</span></a></span></p>
                        <p class="menu_p"><span><a href="/danh-sach-tai-khoan/"><span class="menu_span">Danh sách ACC bán</span></a></span></p>
                    <?php }
                    ?>
                    <p class="menu_p"><span><a href="/logout/"><span class="menu_span">Đăng xuất</span></a></span></p>
                </div>
            <?php } else { ?>
                <div class="list_btn_header box_btn_header_mb header_btn">
                    <div class="box_btn_header ">
                        <!-- <span class="text_login"><a>Đăng ký</a></span> -->
                        <span class="text_login"><a href="/dang-ky/">Đăng ký</a></span>
                    </div>
                    <div class="box_btn_header ">
                        <span class="text_login"><a href="/dang-nhap/">Đăng nhập</a></span>
                    </div>
                </div>
            <?php } ?>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/chat.svg" alt="tin nhắn">
                <span><a href="/message/">Tin nhắn</a></span>
            </div>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/home.png" alt="trang chủ">
                <span><a href="/">Trang chủ</a></span>
            </div>
            <div class="box_menu " onclick="click_menu_con(this,1)">
                <img src="<?= site_main(); ?>images/header/Vector.png" alt="Cửa hàng">
                <span>Cửa hàng</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
            </div>

            <div class="menu_con">
                <p><span><a href="/shop-lien-quan/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_lq.png" alt="game liên quân mobile"><span class="menu_span">Liên Quân Mobile</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-free-fire/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_ff.png" alt="game liên quân mobile"><span class="menu_span">Free Fire</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-lien-minh-huyen-thoai/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_lmht.png" alt="game liên quân mobile"><span class="menu_span">Liên Minh Huyền Thoại</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-pubg-mobile/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_pubg.png" alt="game liên quân mobile"><span class="menu_span">PUBG Mobile</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-fifa-online/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_fo4.png" alt="game liên quân mobile"><span class="menu_span">Fifa Online 4</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-lien-minh-toc-chien/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_lmtc.png" alt="game liên quân mobile"><span class="menu_span">Liên minh tốc chiến</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-dot-kich/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_cf.png" alt="game liên quân mobile"><span class="menu_span">Đột kích</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/shop-valorant/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/icon_valorant.png" alt="game liên quân mobile"><span class="menu_span">Valorant</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
            </div>
            <div class="box_menu" onclick="click_menu_con(this,1)">
                <img src="<?= site_main(); ?>images/header/game.png" alt="mini game">
                <span>Giải trí</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
            </div>
            <div class="menu_con">
                <p><span><a href="/danh-sach-idol/"><span class="menu_span">Thuê Playdoul</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/ve-so-may-man/"><span class="menu_span">Vé số may mắn</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/vong-quay-lien-quan/"><span class="menu_span">Vòng quay Liên Quân</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
            </div>
            <div class="box_menu" onclick="click_menu_con(this,1)">
                <a href="/blog/"><img src="<?= site_main(); ?>images/header/note.png" alt="tin tức"></a>
                <span><a href="/blog/">Tin tức</a></span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
            </div>
            <div class="menu_con">
                <?php
                if (isset($menu_cate) && count($menu_cate) > 0) {
                    foreach ($menu_cate as $key => $val) {
                ?>
                        <p><span><a href="/<?= $val['alias'] ?>"><span class="menu_span"><?= $val['name'] ?></span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <?php }
                } ?>
            </div>
            <div class="box_menu" onclick="click_menu_con(this,1)">
                <img src="<?= site_main(); ?>images/header/category-2.png" alt="dịch vụ">
                <span>Dịch vụ</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
            </div>
            <div class="menu_con">
                <p><span><a href="/the-game-garena/"><img class="img_icon_game " src="<?= site_main(); ?>images/home/garena.png" alt="game liên quân mobile"><span class="menu_span">Mua thẻ Garena</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
            </div>
            <div class="box_menu" onclick="click_menu_con(this,1)">
                <img src="<?= site_main(); ?>images/header/crown.svg" alt="giải trí">
                <span>Nhiệm vụ</span>
                <img class="img_down box_btn_header_mb" src="<?= site_main(); ?>images/home/arrow-bottom.png" alt="xem thêm">
            </div>
            <div class="menu_con">
                <p><span><a href="/diem-danh-nhan-qua/"><span class="menu_span">Điểm danh</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
                <p><span><a href="/nhiem-vu-moi-ngay/"><span class="menu_span">Nhiệm vụ môi ngày</span><img class="img_goto_link " src="<?= site_main(); ?>images/home/arrow-right.svg" alt="đi tới"></a></span></p>
            </div>
            <div class="box_menu">
                <img src="<?= site_main(); ?>images/header/card-pos.png" alt="nạp thẻ">
                <span><a href="/nap-the/">Nạp thẻ</a></span>
            </div>
        </div>
    </div>
</div>