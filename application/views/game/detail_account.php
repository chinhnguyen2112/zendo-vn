<?php
$CI = &get_instance();
$type_account = 1; // 1 là liên quân
if ($game['type_account'] == 'Free Fire') {
    $type_account = 2;
} elseif ($game['type_account'] == 'Liên Minh Huyền Thoại') {
    $type_account = 3;
} elseif ($game['type_account'] == 'Tốc Chiến') {
    $type_account = 4;
} elseif ($game['type_account'] == 'Pubg') {
    $type_account = 5;
} elseif ($game['type_account'] == 'Fifa') {
    $type_account = 6;
} elseif ($game['type_account'] == 'CF') {
    $type_account = 7;
} elseif ($game['type_account'] == 'Valorant') {
    $type_account = 8;
}
$check_page = $game['check_page'];
$sql_av = "SELECT * FROM setting_random  WHERE id ='$check_page'";
$where = [
    'id' => $check_page
];
$data_av = $CI->Post->get_id($where, 'setting_random');
$source_user = $CI->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$game['user_id']}'");
?>
<div class="content">
    <div class="content_child">
        <div class="breadcrump">
            <a class="home_ic" href="/">
                <img src="<?= site_main() ?>images/detail/ic_home.svg" alt="breadcums">
            </a>
            <img src="<?= site_main() ?>images/detail/ic_next_home.svg" class="ic_next" alt="next icon">
            <span class="text_bread"><?php if ($type_account == 1) {
                                            echo "Shop acc liên quân";
                                        } else if ($type_account == 2) {
                                            echo "Shop acc free fire";
                                        } else if ($type_account == 3) {
                                            echo "Shop acc liên minh huyền thoại";
                                        } else if ($type_account == 4) {
                                            echo "Shop acc liên minh tốc chiến";
                                        } else if ($type_account == 5) {
                                            echo "Shop acc pubg mobile";
                                        } else if ($type_account == 6) {
                                            echo "Shop acc fifa online 4";
                                        } else if ($type_account == 7) {
                                            echo "Shop acc đột kích";
                                        } else if ($type_account == 8) {
                                            echo "Shop acc valorant";
                                        }      ?></span>
            <img src="<?= site_main() ?>images/detail/ic_next_home.svg" class="ic_next" alt="next icon">
            <span class="text_bread">Mã số: <?= $game['id_post']; ?></span>
        </div>
        <h1 class="h1">Mã số: #<?= $game['id_post']; ?></h1>
        <div class="detail_acc">
            <div class="detail_acc_left">
                <h2 class="h2">Mã số #<?= $game['id_post']; ?></h2>
                <div class="content_detail_left">
                    <div class="img_left">
                        <?php if ($check_page < 14) { ?>
                            <img src="<?= site_main() . $data_av['avatar']; ?>" alt="rank">
                            <?php } else {
                            if ($type_account == 6 || $type_account == 7 || $type_account == 8) { ?>
                                <img class="nen_rank " style="opacity: 1;" src="<?= ($game['user_id'] > 0) ? site_post($source_user['source']) : site_main()  ?>assets/files/thumb/<?= $game['id_post'] ?>.jpg" alt="chi tiết acc">
                            <?php } else { ?>
                                <img class="nen_rank" src="<?= site_main() ?>images/detail/img_list_vq.png" alt="rank">
                                <div class="ab_detail">
                                    <img class="img_rank" src="<?php
                                                                if ($type_account == 1) {
                                                                    echo get_icon_rank($game['rank']);
                                                                } else if ($type_account == 2) {
                                                                    echo get_icon_rank($game['rank'], 'FF');
                                                                } else if ($type_account == 3) {
                                                                    echo get_icon_rank($game['rank'], 'LMHT');
                                                                } else if ($type_account == 4) {
                                                                    echo get_icon_rank($game['rank'], 'LMTC');
                                                                } else if ($type_account == 5) {
                                                                    echo get_icon_rank($game['rank'], 'PUBG');
                                                                }  ?>">
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="child_right_detail">
                        <ul class="child_right_detail_ul">
                            <?php if ($type_account == 7 || $type_account == 8) { ?>
                                <li class="child_right_detail_li">
                                    <div class="left">
                                        <img src="<?= site_main() ?>images/detail/note.svg" alt="note">
                                        <label>Ghi chú</label>
                                    </div>
                                    <p class="p_green p_right"><?php echo ($game['note']); ?></p>
                                </li>
                            <?php } else { ?>
                                <li class="child_right_detail_li">
                                    <div class="left">
                                        <img src="<?= site_main() ?>images/detail/champ.svg" alt="champ">
                                        <label><?php if ($type_account == 1 || $type_account == 4) {
                                                    echo "Tướng";
                                                } else if ($type_account == 2 || $type_account == 5) {
                                                    echo "Đăng ký";
                                                } else if ($type_account == 3) {
                                                    echo "Server";
                                                } else if ($type_account == 6) {
                                                    echo "GTĐH";
                                                }  ?></label>
                                    </div>
                                    <p class="p_right"><?php if ($type_account == 1 || $type_account == 4) {
                                                            echo number_format($game["champs_count"], 0, '.', '.') . ' tướng';
                                                        } else if ($type_account == 2) {
                                                            echo source_signup($game['source']);
                                                        } else if ($type_account == 3) {
                                                            echo source_signup($game['source'], 'LMHT');
                                                        } else if ($type_account == 5) {
                                                            echo source_signup($game['source'], 'PUBG');
                                                        } else if ($type_account == 6) {
                                                            echo $game['skins'];
                                                        }  ?> </p>
                                </li>
                                <?php if ($type_account == 3) { ?>
                                    <li class="child_right_detail_li">
                                        <div class="left">
                                            <img src="<?= site_main() ?>images/detail/champ.svg" alt="champ">
                                            <label>Tướng</label>
                                        </div>
                                        <p class="p_right"><?= number_format($game["champs_count"], 0, '.', '.') . ' tướng'; ?> </p>
                                    </li>
                                <?php } elseif ($type_account == 5) { ?>
                                    <li class="child_right_detail_li">
                                        <div class="left">
                                            <img src="<?= site_main() ?>images/detail/champ.svg" alt="champ">
                                            <label>Skin súng</label>
                                        </div>
                                        <p class="p_right"><?= number_format($game["champs_count"], 0, '.', '.'); ?> </p>
                                    </li>
                                    <li class="child_right_detail_li">
                                        <div class="left">
                                            <img src="<?= site_main() ?>images/detail/champ.svg" alt="champ">
                                            <label>Trang phục</label>
                                        </div>
                                        <p class="p_right"><?= number_format($game["skins_count"], 0, '.', '.'); ?> </p>
                                    </li>
                                <?php } ?>
                                <li class="child_right_detail_li">
                                    <div class="left">
                                        <img src="<?= site_main() ?>images/detail/skin.svg" alt="skin">
                                        <label><?php if ($type_account == 1 || $type_account == 3 || $type_account == 4) {
                                                    echo "Trang phục";
                                                } else if ($type_account == 6) {
                                                    echo "BP";
                                                } else {
                                                    echo "Pet";
                                                } ?></label>
                                    </div>
                                    <p class="p_right">
                                        <?php if ($type_account == 1 || $type_account == 3 || $type_account == 4) {
                                            echo number_format($game["skins_count"], 0, '.', '.'); ?> trang phục
                                        <?php } else if ($type_account == 6) {
                                            echo $game['champs'];
                                        } else {
                                            echo ($game['pet'] == 1) ? 'Có' : 'Không';
                                        } ?></p>
                                </li>
                                <?php if ($type_account != 6) { ?>
                                    <li class="child_right_detail_li">
                                        <div class="left">
                                            <img src="<?= site_main() ?>images/detail/rank.svg" alt="rank">
                                            <label>Rank</label>
                                        </div>
                                        <p class="p_right"><?php if ($type_account == 1) {
                                                                echo get_string_rank($game['rank']);
                                                            } else if ($type_account == 2) {
                                                                echo str_replace('Cao Thủ', 'Huyền Thoại', get_string_rank($game['rank']));
                                                            } else if ($type_account == 3) {
                                                                echo str_replace('Khung', '', get_string_frame($game['rank']));
                                                            } else if ($type_account == 4) {
                                                                echo get_string_rank($game['rank'], 'LMTC');
                                                            } else if ($type_account == 5) {
                                                                echo get_string_rank($game['rank'], 'PUBG');
                                                            }  ?></p>
                                    </li>
                                <?php }
                                if ($type_account == 2) { ?>
                                    <li class="child_right_detail_li">
                                        <div class="left">
                                            <img src="<?= site_main() ?>images/detail/rank.svg" alt="rank">
                                            <label>Thẻ vô cực</label>
                                        </div>
                                        <p class="p_right"><?php if ($game['card_infinity'] == 1) {
                                                                echo "Có";
                                                            } else {
                                                                echo "Không";
                                                            } ?></p>
                                    </li>
                                <?php } ?>
                                <li class="child_right_detail_li">
                                    <div class="left">
                                        <img src="<?= site_main() ?>images/detail/note.svg" alt="note">
                                        <label>Ghi chú</label>
                                    </div>
                                    <p class="p_green p_right"><?php echo ($game['note']); ?></p>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="detail_acc_right">
                <div class="right_uudai">
                    <div class="div_uudai">
                        <div class="box_title_uudai">
                            <img class="img_icon_uudai" src="<?= site_main() ?>images/detail/gift.png" alt="ưu đãi">
                            <span class="span_text_uudai">Ưu đãi</span>
                        </div>
                        <div class="list_uudai">
                            <div class="box_uudai">
                                <img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">
                                <p class="p_box_uudai">Thu cũ đổi mới <span class="span_box_uudai" style="cursor: pointer;" onclick="window.location.href = '/doi-acc-cu-len-doi-acc-moi/'">(Xem chi tiết).</span></p>
                            </div>
                            <div class="box_uudai">
                                <img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">
                                <p class="p_box_uudai">Ưu đãi <span class="span_box_uudai">20%</span> thanh toán qua <span class="span_box_uudai">ATM/MOMO.</span></p>
                            </div>
                            <div class="box_uudai">
                                <img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">
                                <p class="p_box_uudai">Nhận thêm <span class="span_box_uudai">5</span> vòng quay quân huy cho đơn hàng <span class="span_box_uudai">500.000đ.</span></p>
                            </div>
                            <div class="box_uudai">
                                <img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">
                                <p class="p_box_uudai">Nhập mã <span class="span_box_uudai">Zendo Shop</span> giảm đến <span class="span_box_uudai">200.000đ</span> cho đơn hàng <span class="span_box_uudai">1.000.000đ.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right_detail_ul">
                    <div class="box_top_right_detail">
                        <div class="right_detail_li right_detail_li_first ">
                            <p class="money"><?php echo number_format($game["price"], 0, '.', '.'); ?> VNĐ</p>
                            <p class="p_green">Thanh toán bằng thẻ cào</p>
                        </div>
                        <div class="right_detail_li">
                            <p class="money money_atm"><?php echo number_format($game["price_atm"], 0, '.', '.'); ?> VNĐ</p>
                            <p class="p_green">Thanh toán bằng MOMO/ATM</p>
                        </div>
                    </div>
                    <div class="right_detail_li right_detail_li_buy">
                        <button onclick="test_cart(<?php echo ($game['id_post']); ?>)"> Mua ngay</button>
                    </div>
                    <div class="right_detail_li right_detail_li_type">
                        <img src="<?= site_main() ?>images/detail/atm_banking.png" alt="atm">
                        <img src="<?= site_main() ?>images/detail/visa.png" alt="visa">
                        <img src="<?= site_main() ?>images/detail/paypal.png" alt="paypal">
                        <img src="<?= site_main() ?>images/detail/momo.png" alt="momo">
                    </div>
                </div>
            </div>
        </div>
        <div class="change_content">
            <ul class="change_content_ul">
                <li class="change_content_li active" data-active="1">HÌNH ẢNH</li>
                <?php if ($type_account == 1) { ?>
                    <li class="change_content_li" data-active="2">TƯỚNG</li>
                    <li class="change_content_li" data-active="3">TRANG PHỤC</li>
                <?php } ?>
            </ul>
            <div class="main_change">
                <div class="description">
                    <?php if ($check_page < 14) { ?>
                        <img src="/<?= $data_av['avatar'] ?>" />
                        <?php }
                    $where_img = [
                        'id_acc' => $game['id_post']
                    ];
                    $arr_album = $CI->Post->get_list($where_img, 'thumb_acc');
                    if ($arr_album) {
                        foreach ($arr_album as $img) { ?>
                            <img src="<?= ($game['user_id'] > 0) ? site_post($source_user['source']) : site_main()  ?><?= $img['img'] ?>" />
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="champ" style="display:none;">
                    <?php if ($game['type_account'] == 'Liên Quân Mobile') :
                        $image = explode("|", $game['champs']);
                        foreach ($image as $row) : ?>
                            <?php $champs1 = explode('-', $row); ?>
                            <div class="detail_champ">
                                <img src="<?= site_main() ?>assets/data/8/champ/<?= $champs1[0] ?>.jpg" alt="<?= $champs1[1] ?>">
                                <p class="name_champ"><?= $champs1[1] ?></p>
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>
                <div class="skin" style="display:none">
                    <?php if ($game['type_account'] == 'Liên Quân Mobile') :
                        $image2 = explode("|", $game['skins']);
                        foreach ($image2 as $row) :
                            $skins1 = explode('-', $row); ?>
                            <div class="detail_skin">
                                <img src="<?= site_main() ?>assets/data/8/skins/img_skill/<?= $skins1[0] ?>.png" alt="<?= $skins1[1] ?>">
                                <div class="name_skin">
                                    <p><?= $skins1[1] ?></p>
                                    <p></p>
                                </div>
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="" name="" id="id_voucher" value="" hidden>
<input type="" name="" id="val_voucher" value="" hidden>
<script>
    var id_user = '<?= (isset($_SESSION['user'])) ? $_SESSION['user']['id'] : '' ?>';
    function setCookies(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    setCookies('id_acc', <?= $game['id_post'] ?>, 1);
</script>