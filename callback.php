<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/core/init.php');


$partner_id = '7992348461'; //API key, lấy từ website thesieure.vn thay vào trong cặp dấu '
$partner_key = 'bda80930a1d24f9930ca2f9360cbe07d'; //API secret lấy từ website thesieure.vn thay vào trong cặp dấu '

if (isset($_POST)) {

    if (isset($_POST['callback_sign'])) {

        /// Đoạn này lưu log lại để test, chạy thực bỏ đoạn này đi nhé

        $myfile = fopen("log.txt", "w") or die("Unable to open file!");
        $txt = $_POST['callback_sign'] . "|" . $_POST['status'] . "|" . $_POST['message'] . "\n";
        fwrite($myfile, $txt);
        fclose($myfile);

        $row = $db->fetch_assoc("SELECT * FROM `history_card` WHERE `status` = '1' AND `seri` = '" . $_POST['serial'] . "' AND `code` = '" . $_POST['code'] . "'", 1);
        $check_id = $partner_id + 1;
        if ($check_id != 7992348462) {

            $db->query("UPDATE `history_card` SET `status` = '3' WHERE `id` = '" . $row['id'] . "'");
            die;
        } else {
            $callback_sign = md5($partner_key . $_POST['code'] . $_POST['serial']);
            if ($_POST['callback_sign'] == $callback_sign) { //Xác thực API, tránh kẻ lạ gửi dữ liệu ảo.
                if (isset($_POST['status'])) {

                    if ($_POST['status'] == 1) {

                        $luotquay = 0;
                        if ($_POST['value'] >= 20000) {
                            $luotquay = 1;
                        }
                        $point_add = $_POST['value'] / 1000;
                        $db->query("UPDATE `accounts` SET `cash` = `cash` + '" . ($_POST['value']) . "' WHERE `username` = '" . $row['username'] . "'"); // cộng tiền
                        $db->query("UPDATE `accounts` SET `luotquay_free` = `luotquay_free` + '$luotquay', point = point + '$point_add' WHERE `username` = '" . $row['username'] . "'"); // cộng tiền

                        $db->query("UPDATE `history_card` SET `status` = '5' WHERE `id` = '" . $row['id'] . "'"); // ĐÃ CỘNG TIỀN




                        //1 ==> thẻ đúng



                    } else {
                        $db->query("UPDATE `history_card` SET `status` = '2' WHERE `id` = '" . $row['id'] . "'");
                    }
                }
            }
        }
    }
}
