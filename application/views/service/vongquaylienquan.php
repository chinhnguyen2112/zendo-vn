<?php
error_reporting(0);
setcookie('luotquay_free', ($_SESSION['user']['luotquay_free'] < 0) ? 0 : $_SESSION['user']['luotquay_free'], time() + 86400, '/');
setcookie('luotquay', ($_SESSION['user']['luotquay'] < 0) ? 0 : $_SESSION['user']['luotquay'], time() + 86400, '/');
setcookie('luotquay9k', ($_SESSION['user']['luotquay9k'] < 0) ? 0 : $_SESSION['user']['luotquay9k'], time() + 86400, '/');
setcookie('luotquay20k', ($_SESSION['user']['luotquay20k'] < 0) ? 0 : $_SESSION['user']['luotquay20k'], time() + 86400, '/');
setcookie('url_301', '/vong-quay-lien-quan/', time() + 86400, '/');
$id = $_SESSION['user']['id'];

$day_new = date('d-m-Y', $luotquay_free['created_at'] + 86400);
$day = date('d-m-Y', $luotquay_free['created_at']);
$tgian = 86400 - (time() - $luotquay_free['created_at']);
date_default_timezone_set("UTC");
$h = date('H', $tgian);
$i = date('i', $tgian);
$s = date('s', $tgian);
?>
<div id="main">
    <div class="content">
        <div class="div_close">
            <span class="close_page" onclick=" window.location.href = '/';">trang chủ</span>
            <span class="close_page" onclick=" khodo()">Kho đồ</span>
            <span class="close_page" onclick=" login_vq()"><?= (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) ? 'Đăng xuất' : 'Đăng nhập' ?></span>
        </div>
        <div class="title_box">
            <div class="title_box_container">
                <span onclick="show_popup(1)" class="span_list_btn">HƯỚNG DẪN</span>
                <span onclick="show_popup(2)" class="span_list_btn">PHẦN THƯỞNG</span>
                <span onclick="show_popup(3)" class="span_list_btn">LỊCH SỬ QUAY</span>
                <span onclick="show_popup(4)" class="span_list_btn">NHIỆM VỤ</span>
            </div>
        </div>
        <div class="choose_spin_tablet">
            <select name="" id="change_type">
                <option value="luotquay_free">Vòng quay nhiệm vụ</option>
                <option value="luotquay">Vòng quay nick liên quân</option>
                <option value="luotquay9k">Vòng quay quân huy</option>
                <option value="luotquay20k">Vòng quay trang phục</option>
            </select>
        </div>
        <div class="box_spin">
            <div class="box-left">
                <div class="header-title">
                    <div class="get-free-spin" onclick="show_popup(5)">
                        <div class="nav_noti_add ">
                            <span>1</span>
                        </div>
                        <img  src="<?= site_main() ?>images/vqlq/gift.svg" alt="gift">
                        <div class="text">
                            <p>
                                <span class="span_them_luot">NHẬN LƯỢT</span>
                            </p>
                            <p>
                                <span class="span_them_luot">QUAY MIỄN PHÍ</span>
                            </p>
                        </div>
                    </div>
                    <!-- <div class="headphone-icon" data-id="1">
                        <img src="<?= site_main() ?>images/vqlq/headphone.svg" alt="headphone">
                        <img class="mute_audio" src="<?= site_main() ?>images/vqlq/line.svg" alt="muted">
                    </div> -->
                    <audio id="hi">
                        <source src="<?= site_main() ?>images/vqlq/Untitled.mp3" type="audio/mp3">
                    </audio>
                    <div class="buy-turn-tablet">
                        <div class="buy-turn">
                            <span class="buy_luot" onclick="show_popup(6)">MUA THÊM LƯỢT QUAY</span>
                        </div>
                    </div>
                    <div class="list_box_vp vp_1">
                        <div class="box_vip_1">
                            <img  src="<?= site_main() ?>images/vqlq/vp_acc.png" alt="tay cầm chơi game" style="margin-top: 32%;">
                            <!-- <p>Acc V.I.P</p> -->
                        </div>
                        <div class="box_vip_2">
                            <img  src="<?= site_main() ?>images/vqlq/vp_qh.png" alt="bao tay chơi game" style="margin-top: 40%; margin-left:21%">
                            <!-- <p>1000</p> -->
                        </div>
                        <div class="box_vip_3">
                            <img  src="<?= site_main() ?>images/vqlq/vp_skin.png" alt="tai nge chơi game" style="margin-top: 32%;">
                            <!-- <p>Acc thường</p> -->
                        </div>
                    </div>

                </div>
                <!-- rotation box -->
                <div class="rotation_box">
                    <div class="spin-img">
                        <img class="img_spin_img " src="<?= site_main() ?>images/vqlq/vq_random.png" alt="rotation">
                        <div class="muiten_quay">
                            <img class="img_muiten " src="<?= site_main() ?>images/vqlq/muiten.png" alt="Mũi tên">
                        </div>
                        <img src="<?= site_main() ?>images/vqlq/center_vq.png" class="img_rank_center " alt="vòng quay">
                    </div>
                    <div class="text-spin">
                        <div class="box_count_turn">
                            <img class="" src="<?= site_main() ?>images/vqlq/count_turn.png" alt="lượt quay">
                            <span class="span_count_play">Lượt: <?= (isset($_SESSION['user']) && $_SESSION['user']['luotquay_free'] >= 0) ? $_SESSION['user']['luotquay_free'] : '0' ?></span>
                        </div>
                        <div disabled class=" spin-btn " data-id="1">
                            <span disabled>Bắt đầu</span>
                        </div>
                    </div>
                </div>
                <!-- end rotation -->
            </div>
            <div class="box-right">
                <div class="choose_spin">
                    <div class="game-board">
                        <p>CHỌN THỂ LOẠI VÒNG QUAY MAY MẮN</p>
                        <li class="li_type_lq backg-orange" data-type="luotquay_free"><span class="span_type_lq">Vòng quay nhiệm vụ</span></li>
                        <li class="li_type_lq" data-type="luotquay"><span class="span_type_lq">Vòng quay nick liên quân</span></li>
                        <li class="li_type_lq" data-type="luotquay9k"><span class="span_type_lq">Vòng quay quân huy</span></li>
                        <li class="li_type_lq" data-type="luotquay20k"><span class="span_type_lq">Vòng quay trang phục</span></li>
                        <li style=" background: none;box-shadow: none; margin: 0.5vh 0; height: 4.3vh;list-style-type: none;"><span class="span_type_lq"></span></li>
                        <li style=" background: none;box-shadow: none; margin: 0.5vh 0; height: 4.3vh;list-style-type: none;"><span class="span_type_lq"></span></li>
                    </div>
                    <div class="buy-turn" onclick="show_popup(6)">
                        <span class="buy_luot">MUA THÊM LƯỢT QUAY</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- thông báo trúng thưởng -->
    <div class="box_noti_gif popup_happy">
        <div class="body_gif" style="background: url(<?= site_main() ?>images/vqlq/img_bgr_tb.png);background-size: 100% 100%; position:relative;width:600px">
            <div class="body_noti_gif" style="background: unset;">
                <div class="body_gif_nav">
                    <div class="div_img_noti" style=" display:block;min-height: 220px;">
                        <div class="box_this_gif">
                            <img class="img_gif_this " style="margin-top: 30px;width: 25%;" src="" alt="phần thưởng">
                        </div>
                    </div>
                    <div class="box_text_noti_gif" style="display: flex;justify-content: center;align-items: center;min-height: 127px;">
                        <div class="type_gif" style="width:100%">
                            <p class="happy_gif" style="margin: 20px auto 25px auto;line-height:unset;width:90%"><span style="font-size: 17px;">Chúc mừng </span><span style="color:#fff;" class="spn_text">bạn nhận được 1 skin bậc A </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <img style="width:50px; position:absolute;top:-10px;right:-1px" class="" src="<?= site_main() ?>images/vqlq/dong_tb.png" onclick="$('.popup_happy').hide();" alt="đóng">
        </div>
    </div>
    <!-- popup lịch sử quay -->
    <div class="box_noti_gif popup_hisory">
        <div class="body_gif history_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">LỊCH SỬ QUAY</span>
            </div>
            <div class="body_noti_gif body_history_gif">
                <table class="table_his">
                    <thead class="thead_his">
                        <tr>
                            <td class="td_stt">STT</td>
                            <td>Loại vòng quay</td>
                            <td>Giải thưởng</td>
                            <td>Ngày chơi</td>
                        </tr>
                    </thead>
                    <tbody class="tbody_his">
                    </tbody>
                </table>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$(this).parents('.box_noti_gif').hide();">Đóng</span>
            </div>
        </div>
    </div>
    <!-- thông báo nhận lượt quay free -->
    <div class="box_noti_gif popup_free">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">Thông báo</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <div class="box_text_noti_gif">
                        <div class="div_img_noti">
                            <div class="box_left_img">
                                <div class="box_img_free">
                                    <img class="img-small" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                                </div>
                                <div class="box_img_free">
                                    <img class="img_big" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                                </div>
                            </div>
                            <div class="box_left_img">
                                <div class="box_img_free">
                                    <img class="img_big" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                                </div>
                                <div class="box_img_free">
                                    <img class="img-small" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                                </div>
                            </div>
                        </div>
                        <div class="type_gif">
                            <p class="happy_gif">XIN CHÚC MỪNG</p>
                            <p class="detail_gif">Bạn đã nhận được 1 lượt quay tại "Vòng quay acc ngon"</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_free').hide();">Đóng</span>
            </div>
        </div>
    </div>
    <!-- Hướng dẫn -->
    <div class="box_noti_gif popup_huong_dan">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">HƯỚNG DẪN</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <div class="box_text_noti">
                        <p class="cac_buoc">Bước 1: <span>Đăng ký tài khoản.</span></p>
                        <p class="text_cacbuoc">- Tại Zendo có hai cách đăng ký tài khoản đó là: Facebook và Tên đăng nhập.</p>
                        <p class="cac_buoc">Bước 2: <span>Tham gia chơi vòng quay may mắn.</span></p>
                        <p class="text_cacbuoc">- Sau khi đã có tài khoản game, tại trang chủ của Zendo bạn chọn “Mini game => Liên quân mobile” để chơi vòng quay may mắn.</p>
                        <p class="cac_buoc">Bước 3: <span>Chọn thể loại vòng quay.</span></p>
                        <p class="text_cacbuoc">- Nhấn quay và đợi kết quả. Các phần quà bạn nhận được sẽ có trong lịch sử quay và kho đồ.</p>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_huong_dan').hide();">Đóng</span>
            </div>
        </div>
    </div>
    <!-- Phần thưởng -->
    <div class="box_noti_gif popup_quy_tac">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">PHẦN THƯỞNG</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <div class="box_text_noti">
                        <p class="cac_buoc">Phần thưởng:</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Acc Liên quân từ 8-50 tướng.</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">50-1000 quân huy</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">50 Zen.</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Voucher giảm 100.000đ khi mua acc từ 500.000đ.</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Skin bậc A - bậc SS.</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Phiếu phần thưởng.</p>
                        <p class="nav_nav_cac_buoc"><img class="img_box_uudai"  src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Mảnh ghép skin.</p>
                        <p class="cac_buoc">Cách quy đổi:</p>
                        <p class="nav_cac_buoc">Phiếu phần thưởng:</p>
                        <p class="nav_nav_cac_buoc" style="margin-left: 30px;">Vòng quay:</p>
                        <p class="nav_nav_text_cac_buoc">50 phiếu = 1 vòng quay nhiệm vụ.</p>
                        <p class="nav_nav_text_cac_buoc">100 phiếu = 2 vòng quay nhiệm vụ.</p>
                        <p class="nav_nav_text_cac_buoc">150 phiếu = 3 vòng quay nhiệm vụ.</p>
                        <p class="nav_nav_cac_buoc" style="margin-left: 30px;">Skin: </p>
                        <p class="nav_nav_text_cac_buoc">200 phiếu = skin bậc A.</p>
                        <p class="nav_nav_text_cac_buoc">300 phiếu = skin bậc S.</p>
                        <p class="nav_nav_text_cac_buoc">500 phiếu = skin bậc S+.</p>
                        <p class="nav_nav_text_cac_buoc">1000 phiếu = skin bậc SS.</p>
                        <p class="nav_nav_cac_buoc" style="margin-left: 30px;">Zen: </p>
                        <p class="nav_nav_text_cac_buoc">1 phiếu = 3 Zen.</p>
                        <p class="nav_nav_cac_buoc" style="margin-left: 30px;">Phiếu cày rank: </p>
                        <p class="nav_nav_text_cac_buoc">200 phiếu = phiếu cày rank 80.000đ.</p>
                        <p class="nav_nav_text_cac_buoc">400 phiếu = phiếu cày rank 170.000đ.</p>
                        <p class="nav_nav_text_cac_buoc">500 phiếu = phiếu cày rank 230.000đ.</p>
                        <p class="nav_cac_buoc">Mảnh ghép skin:</p>
                        <p class="nav_nav_text_cac_buoc">200 mảnh = 1 skin A.</p>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_quy_tac').hide();">Đóng</span>
            </div>
        </div>
    </div>
    <!-- Nhiệm vụ -->
    <div class="box_noti_gif popup_nhiem_vu">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">NHIỆM VỤ</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <div class="box_text_noti">
                        <p><img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Giới thiệu 1 bạn chơi mới nhận ngay 1 lượt quay vòng quay nhiệm vụ.</span></p>
                        <p><img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Đăng kí ngay kênh <a target="_blank" href="https://www.youtube.com/channel/UCGPEASI3zLBeuAlaDZVP_gw/featured">Zendo Shop</a> của Zendo để nhận ngay 4 lượt quay nhiệm vụ.</p>
                        <p><img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Khi mua acc từ 200.000đ được tặng 1 lượt quay tự chọn.</p>
                        <p><img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">Tích điểm sau mỗi lần mua acc, đủ 20 điểm khách hàng sẽ được tặng 1 lượt quay tự chọn.</p>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_nhiem_vu').hide();">Đóng</span>
            </div>
        </div>
    </div>

    <div style="display: none;" class="popup_buy_spin">
        <div class="body_buy_spin">
            <img onclick="$('.popup_buy_spin').hide();" class="close_buy_spin"  src="<?= site_main() ?>images/vqlq/dong_tb.png" alt="close_popup">
            <div class="buy_spin_container">
                <div class="title_buy_spin">
                    <span class="text_buy_spin">MUA THÊM LƯỢT QUAY</span>
                </div>
                <div class="box_buy_spin">
                    <div class="left_box">
                        <img class="" src="<?= site_main() ?>images/vqlq/vq_random.png" alt="popup">
                        <span>VÒNG QUAY NHIỆM VỤ</span>
                    </div>
                    <div class="right_box">
                        <div class="div_select sl_luotquay_free">
                            <p id="luotquay_free" class="text_buy_free">Lượt quay nhiệm vụ chỉ được nhận từ nhiệm vụ hoặc kiện</p>
                        </div>
                        <div class="div_select sl_luotquay" data-id="luotquay">
                            <select class="select_spin" name="" id="luotquay">
                                <option value="1"><span>1 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.000đ/150 Zen</option>
                                <option value="3"><span>3 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;28.000đ/420 Zen</option>
                                <option value="5"><span>5 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;44.000đ/660 Zen</option>
                                <option value="8"><span>8 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;73.000đ/1.095 Zen</option>
                                <option value="10"><span>10 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;91.000đ/1.365 Zen</option>
                            </select>
                        </div>
                        <div class="div_select sl_luotquay_9k" data-id="luotquay_9k">
                            <select class="select_spin" name="" id="luotquay9k">
                                <option value="1"><span>1 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.000đ</option>
                                <option value="3"><span>3 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;28.000đ</option>
                                <option value="5"><span>5 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;44.000đ</option>
                                <option value="8"><span>8 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;73.000đ</option>
                                <option value="10"><span>10 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;91.000đ</option>
                            </select>
                        </div>
                        <div class="div_select sl_luotquay_20k" data-id="luotquay_20k">
                            <select class="select_spin" name="" id="luotquay20k">
                                <option value="1"><span>1 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.000đ</option>
                                <option value="3"><span>3 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;28.000đ</option>
                                <option value="5"><span>5 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;44.000đ</option>
                                <option value="8"><span>8 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;73.000đ</option>
                                <option value="10"><span>10 lượt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;91.000đ</option>
                            </select>
                        </div>
                        <input type="text" id="type_buy" value="" hidden>
                        <input type="text" id="count_buy" value="1" hidden>
                        <input type="text" id="val_buy" value="10000" hidden>
                        <div class="buy_spin_btn">
                            <div class="buy_by_vnd">
                                <p class="">Mua bằng tiền mặt</p>
                            </div>
                            <div class="buy_by_zen">
                                <p class="">Mua bằng Zen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  loading....-->
    <div class="box_noti_gif popup_load">
        <div class="body_gif loading_body">
            <img src="<?= site_main() ?>images/vqlq/load.gif" alt="loading...">
        </div>
    </div>
    <!-- thông báo mua lượt quay thành công -->
    <div class="box_noti_gif popup_sucess">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">THÀNH CÔNG</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <div class="div_img_noti">
                        <div class="box_left_img">
                            <div class="box_img_free">
                                <img class="img-small" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                            </div>
                            <div class="box_img_free">
                                <img class="img_big" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                            </div>
                        </div>
                        <div class="box_left_img">
                            <div class="box_img_free">
                                <img class="img_big" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                            </div>
                            <div class="box_img_free">
                                <img class="img-small" src="<?= site_main() ?>images/vqlq/star.svg" alt="chúc mừng">
                            </div>
                        </div>
                    </div>
                    <div class="box_text_noti_gif">
                        <div class="type_gif">
                            <p class="happy_gif">Mua Lượt quay hành công</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_sucess').hide();">Đóng</span>
            </div>
        </div>
    </div>
    <!-- thông báo thất bại -->
    <div class="box_noti_gif popup_error">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">THẤT BẠI</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <img class="img_error" src="<?= site_main() ?>images/vqlq/error.svg" alt="lỗi">
                    <div class="box_text_noti_gif">
                        <div class="type_gif">
                            <p class="happy_gif">Bạn chưa đăng nhập. Vui lòng đăng nhập!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_error').hide();">Đóng</span>
                <span class="span_close_gif btn_lg" style="background: #e67300 " onclick="window.location.href = '/dang-nhap/'">Đăng nhập</span>
            </div>
        </div>
    </div>
    <!-- thông báo thất bại -->
    <div class="box_noti_gif popup_confirm">
        <div class="body_gif">
            <div class="title_noti_gif">
                <span class="noti_title_gif">THẤT BẠI</span>
            </div>
            <div class="body_noti_gif">
                <div class="body_gif_nav">
                    <img class="img_error " src="<?= site_main() ?>images/vqlq/error.svg" alt="lỗi">
                    <div class="box_text_noti_gif">
                        <div class="type_gif">
                            <p class="happy_gif">Bạn chưa đăng nhập. Vui lòng đăng nhập!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_close_gif">
                <span class="span_close_gif" onclick="$('.popup_confirm').hide();">Đóng</span>
                <span class="span_close_gif btn_lg" style="background: #e67300 " onclick="buy_now(1)">Xác nhận</span>
            </div>
        </div>
    </div>

    <!-- thông báo nhận lượt quay free -->
    <div class="box_noti_gif popup_play">

    </div>
</div>
<style>
    .slick-track {
        width: max-content !important;
    }

    .select2-search--dropdown {
        display: none !important;
    }

    .select2-selection__clear {
        display: none !important;
    }

    .select2-container--default .select2-selection--single {
        background: unset !important;
        text-align: center;
        border: none !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        font-weight: 500 !important;
        color: #fff !important;
        padding: 0px !important;
        font-size: 15px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: #e67300;
    }

    .select2-results__option {
        padding-left: 18px !important;
        font-size: 15px;
    }

    .ft_bot_edit {
        display: none !important;
    }

    @media only screen and (max-width: 1024px) {
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-weight: 500 !important;
            color: #fff !important;
            padding: 0px !important;
            font-size: 24px;
        }
        .select2-container {
            font-size: 24px;
        }
    }

    @media only screen and (max-width: 560px) {
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 17px;
        }
        .select2-container {
            font-size: 17px;
        }
    }

    @media only screen and (max-width: 560px) {
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 14px;
        }
        .select2-container {
            font-size: 14px;
        }
    }
</style>



<script>
    var h_old = <?= $h ?>;
    var i_old = <?= $i ?>;
    var s_old = <?= $s ?>;
    var id = '<?= $id ?>';    var tgian = '<?= $tgian ?>';

</script>