
<script src="<?= site_main() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= site_main(); ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= site_main(); ?>assets/js/sweetalert.min.js"></script>
<script src="<?= site_main(); ?>assets/js/core/js.cookie.min.js"></script>
<script src="<?= site_main(); ?>assets/js/main.js"></script>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

function get()
{
    if (isset($_GET['ngay']) && isset($_GET['thang']) && isset($_GET['nam'])) {
        if ($_GET['thang'] <= 12 && $_GET['thang'] >= 1 && $_GET['nam'] <= date('Y')) {
            if ($_GET['thang'] == 1 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 2 && $_GET['ngay'] <= 29 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 3 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 4 && $_GET['ngay'] <= 30 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 5 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 6 && $_GET['ngay'] <= 30 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 7 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 8 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 9 && $_GET['ngay'] <= 30 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 10 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 11 && $_GET['ngay'] <= 30 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } elseif ($_GET['thang'] == 12 && $_GET['ngay'] <= 31 && $_GET['ngay'] >= 1) {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . $_GET['ngay'] . "-" . $_GET['thang'] . "-" . $_GET['nam']);
                return $url;
            } else {
                $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . date('d') . "-" . date('m') . "-" . date('Y'));
                return $url;
            }
        } else {
            $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . date('d') . "-" . date('m') . "-" . date('Y'));
            return $url;
        }
    } else {
        $url = curl("https://xoso.me/embedded/kq-mienbac?ngay_quay=" . date('d') . "-" . date('m') . "-" . date('Y'));
        return $url;
    }
}
function curl($url)
{
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Expect:'
    ));
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}

$url = get();
echo $url;
if (preg_match('#Mã nhúng XSMB ngày (.+?),#is', $url, $UserXvn_XYZ_123)) {
    echo '{"createdby":"quyetpaylak",date":"' . $UserXvn_XYZ_123[1] . '",';
    echo '"gdb":';
    if (preg_match('#Đặc biệt</td><td colspan="12" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_)) {
        echo '"' . $UserXvn_XYZ_[1] . '",';
    } else {
        echo '"null",';
    }

    echo '"gnhat":"';

    if (preg_match('#Giải nhất</td><td colspan="12" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_)) {
        echo $UserXvn_XYZ_[1] . '",';
    } else {
        echo '"null",';
    }
    if (preg_match('#Giải nhì </td><td colspan="6" class="number"><b>(.+?)</b></td>#is', $url, $UserXvn_XYZ_)) {
        echo '"gnhi1":"' . $UserXvn_XYZ_[1] . '",';

        if (preg_match('#Giải nhì </td><td colspan="6" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="6" class="number"><b class="">(.+?)</b>#is', $url, $UserXvn_XYZ_2)) {

            echo '"gnhi2":"' . $UserXvn_XYZ_2[1] . '",';
        } else {
            echo '"gnhi2":"null"';
        }
    } else {
        echo '"gnhi1":"null","gnhi2":"null"';
    }
    if (preg_match('#Giải ba</td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_)) {
        echo '"gba1":"' . $UserXvn_XYZ_[1] . '",';
        if (preg_match('#Giải ba</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b class="">(.+?)</b>#is', $url, $UserXvn_XYZ_2)) {
            echo '"gba2":"' . $UserXvn_XYZ_2[1] . '",';
            if (preg_match('#Giải ba</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b class="">(.+?)</b>#is', $url, $UserXvn_XYZ_3)) {
                echo '"gba3":"' . $UserXvn_XYZ_3[1] . '",';
                if (preg_match('#Giải ba</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_3[1] . '</b></td></tr>
<tr class="bg_ef"><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_4)) {
                    echo '"gba4":"' . $UserXvn_XYZ_4[1] . '",';
                    if (preg_match('#Giải ba</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_3[1] . '</b></td></tr>
<tr class="bg_ef"><td class="number" colspan="4"><b>' . $UserXvn_XYZ_4[1] . '</b></td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_5)) {
                        echo '"gba5":"' . $UserXvn_XYZ_5[1] . '",';
                        if (preg_match('#Giải ba</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b class="">' . $UserXvn_XYZ_3[1] . '</b></td></tr>
<tr class="bg_ef"><td class="number" colspan="4"><b>' . $UserXvn_XYZ_4[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_5[1] . '</b></td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_6)) {
                            echo '"gba6":"' . $UserXvn_XYZ_6[1] . '",';
                        } else {
                            echo '"gba6":"null",';
                        }
                    } else {
                        echo '"gba5":"null","gba6" :"null",';
                    }
                } else {
                    echo '"gba4":"null","gba5" :"null","gba6":"null",';
                }
            } else {
                echo '"gba3":"null","gba4" :"null","gba5":"null","gba6":"null",';
            }
        } else {
            echo '"gba2":"null","gba3" :"null","gba4":"null","gba5":"null","gba6":"null",';
        }
    } else {
        echo '"gba1":"null","gba2":"null","gba3":"null","gba4":"null","gba5":"null","gba6":"null",';
    }




    if (preg_match('#Giải tư</td><td colspan="3" class="number"><b>(.+?)</b></td>#is', $url, $UserXvn_XYZ_)) {
        echo '"gtu1":"' . $UserXvn_XYZ_[1] . '",';
        if (preg_match('#Giải tư</td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="3" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_2)) {
            echo '"gtu2":"' . $UserXvn_XYZ_2[1] . '",';
            if (preg_match('#Giải tư</td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td colspan="3" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_3)) {
                echo '"gtu3":"' . $UserXvn_XYZ_3[1] . '",';
                if (preg_match('#Giải tư</td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_3[1] . '</b></td><td colspan="3" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_4)) {
                    echo '"gtu4":"' . $UserXvn_XYZ_4[1] . '",';
                } else {
                    echo '"gtu4":"null",';
                }
            } else {
                echo '"gtu3":"null","gtu4":"null",';
            }
        } else {
            echo '"gtu2":"null","gtu3":"null","gtu4":"null",';
        }
    } else {
        echo '"gtu1":"null","gtu2":"null","gtu3":"null","gtu4":"null",';
    }



    if (preg_match('#Giải năm</td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_)) {
        echo '"gnam1":"' . $UserXvn_XYZ_[1] . '",';
        if (preg_match('#Giải năm</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_2)) {
            echo '"gnam2":"' . $UserXvn_XYZ_2[1] . '",';
            if (preg_match('#Giải năm</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_3)) {
                echo '"gnam3":"' . $UserXvn_XYZ_3[1] . '",';
                if (preg_match('#Giải năm</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_3[1] . '</b></td></tr>
<tr class="bg_ef"><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_4)) {
                    echo '"gnam4":"' . $UserXvn_XYZ_4[1] . '",';
                    if (preg_match('#Giải năm</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_3[1] . '</b></td></tr>
<tr class="bg_ef"><td class="number" colspan="4"><b>' . $UserXvn_XYZ_4[1] . '</b></td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_5)) {
                        echo '"gnam5":"' . $UserXvn_XYZ_5[1] . '",';
                        if (preg_match('#Giải năm</td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_3[1] . '</b></td></tr>
<tr class="bg_ef"><td class="number" colspan="4"><b>' . $UserXvn_XYZ_4[1] . '</b></td><td class="number" colspan="4"><b>' . $UserXvn_XYZ_5[1] . '</b></td><td class="number" colspan="4"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_6)) {
                            echo '"gnam6":"' . $UserXvn_XYZ_6[1] . '",';
                        } else {
                            echo '"gnam6":"null",';
                        }
                    } else {
                        echo '"gnam5":"null","gnam6":"null",';
                    }
                } else {
                    echo '"gnam4":"null","gnam5":"null","gnam6":"null",';
                }
            } else {
                echo '"gnam3":"null","gnam4":"null","gnam5":"null","gnam6":"null",';
            }
        } else {
            echo '"gnam2":"null","gnam3":"null","gnam4":"null","gnam5":"null","gnam6":"null",';
        }
    } else {
        echo '"gnam1":"null","gnam2":"null","gnam3":"null","gnam4":"null","gnam5":"null","gnam6":"null",';
    }



    if (preg_match('#Giải sáu</td><td colspan="4" class="number"><b>(.+?)</b></td>#is', $url, $UserXvn_XYZ_)) {
        echo '"gsau1":"' . $UserXvn_XYZ_[1] . '",';
        if (preg_match('#Giải sáu</td><td colspan="4" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="4" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_2)) {
            echo '"gsau2":"' . $UserXvn_XYZ_2[1] . '",';
            if (preg_match('#Giải sáu</td><td colspan="4" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="4" class="number"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td colspan="4" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_3)) {
                echo '"gsau3":"' . $UserXvn_XYZ_3[1] . '",';
            } else {
                echo '"gsau2":"null';
            }
        } else {
            echo '"gsau3":"null","gsau2":"null';
        }
    } else {
        echo '"gsau1":"null","gsau3":"null","gsau2":"null';
    }





    if (preg_match('#Giải bảy</td><td colspan="3" class="number"><b>(.+?)</b></td>#is', $url, $UserXvn_XYZ_)) {
        echo '"gbay1":"' . $UserXvn_XYZ_[1] . '",';
        if (preg_match('#Giải bảy</td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="3" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_2)) {
            echo '"gbay2":"' . $UserXvn_XYZ_2[1] . '",';
            if (preg_match('#Giải bảy</td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td colspan="3" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_3)) {
                echo '"gbay3":"' . $UserXvn_XYZ_3[1] . '",';
                if (preg_match('#Giải bảy</td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_[1] . '</b></td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_2[1] . '</b></td><td colspan="3" class="number"><b>' . $UserXvn_XYZ_3[1] . '</b></td><td colspan="3" class="number"><b>(.+?)</b>#is', $url, $UserXvn_XYZ_4)) {
                    echo '"gbay4":"' . $UserXvn_XYZ_4[1] . '"}';
                } else {
                    echo '"gbay4":"null"';
                }
            } else {
                echo '"gbay3":"null","gbay4":"null"';
            }
        } else {
            echo '"gbay2":"null","gbay3":"null","gbay4":"null"';
        }
    } else {
        echo '"gbay1":"null","gbay2":"null","gbay3":"null","gbay4":"null"';
    }
}
?>
<div class="box_check_xsmb">
    <p class="title_xsmb">KHÁCH HÀNG TRÚNG THƯỞNG (12 Người)</p>
    <div class="box_table_user_trung">
        <table class="table_user_trung">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">STT</th>
                    <th>ID</th>
                    <th>User</th>
                    <th>Số</th>
                    <th>Đặt cược (Zen)</th>
                    <th>Số nháy</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1572</td>
                    <td>00</td>
                    <td>20</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box_btn_xsmb">
        <span onclick="tra_thuong()">Trả thưởng</span>
    </div>
</div>
<style>
    .z_footer,
    .header,
    .ft_bot_edit {
        display: none;
    }

    body {
        color: unset;
    }

    .checkbox+.checkbox,
    .radio+.radio,
    .checkbox,
    .radio {
        margin: unset;
    }

    .box_check_xsmb {
        padding: 20px;
        text-align: center;
        /* background: #fb9b34; */
        margin-top: 25px;
    }

    .title_xsmb {
        font-size: 23px;
        line-height: 51px;
        font-weight: 600;
        background: #fff2bc;
    }

    .box_btn_xsmb {
        margin-top: 20px;
    }

    .box_btn_xsmb span {
        padding: 8px 20px;
        background: #fb9b34;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        color: #fff;
    }

    @media only screen and (max-width: 540px) {
        .title_xsmb {
            font-size: 13px;
        }

        .box_table_user_trung {
            overflow: auto;
        }

        table.table_user_trung {
            min-width: 600px;
        }
    }
</style>
