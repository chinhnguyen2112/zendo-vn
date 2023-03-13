<?php

// Require database & thông tin chung
require_once 'core/init.php';

$fb = new Facebook\Facebook([
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v2.4',
    'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : $default_access_token
]);
$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    //echo 'Graph returned an error: ' . $e->getMessage();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
if (isset($accessToken)) { // đã lấy được token, đăng nhập thành công

    $_SESSION['facebook_access_token'] = (string) $accessToken; // lưu token vào session
    // Lưu session
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
    //$getname = $response->getGraphUser()['name'];
    $name = trim(addslashes(htmlspecialchars($response->getGraphUser()['name'])));
    $email = $response->getGraphUser()['email'];
    $iduser = $response->getGraphUser()['id'];

    // echo $iduser;
    //kiểm tra người dùng có trong hệ thống
    $date_check = date('H:i:s', time());
    $str_time = time();
    if ($db->num_rows("SELECT username FROM accounts WHERE username = '$iduser'") < 1) {
    // echo $iduser;
        // echo 1; die;
        // Thực thi tạo người dùng
        //check có phải đăng ký vào khung giờ vàng hay không
        $date_check = date('H:i:s', time());
        $count = 1; // nếu không phải tặng 1 lượt quay
        if (($date_check >= '11:00:00' && $date_check < '12:00:00') || ($date_check >= '20:00:00' && $date_check < '21:00:00')) {
            $count = 3; // nếu khung giờ vàng tặng 3 lượt quay
        }
        // echo "INSERT INTO `accounts` (username,name,email,cash,luotquay_free,point,admin,block,time) VALUES ('$iduser','$name','$email',0,'$count,0,0,0,'$date_current')";
        $db->query("INSERT INTO `accounts` (username,name,email,active,cash,luotquay_free,point,admin,block,time) VALUES ('$iduser','$name','$email',1,0,'$count',0,0,0,'$date_current')");
    } else {
        // nếu đăng nhập vào giờ vàng
        $data_u = $db->fetch_assoc("SELECT id FROM accounts WHERE username = '$iduser'", 1);
        $id = $data_u['id'];
        $event = 0;
        $sql_his = "SELECT created_at,count FROM `history_luotquay_free`  WHERE `user_id` = $id AND `count` = 3 ORDER BY id DESC";
        $check_his = $db->fetch_assoc($sql_his, 1);
        if ($date_check >= '11:00:00' && $date_check < '12:00:00') { // nếu đang vào khung giờ vàng đâu tiên
            if (count((array)$check_his) > 0) { // nếu đã có data
                $event = 0;
                if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) { // nếu hôm nay chưa nhận
                    $event = 1; //  
                } elseif (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) { // nếu hôm nay đã nhận

                    if (date('H:i:s', $check_his['created_at']) < '12:00:00' && date('H:i:s', $check_his['created_at']) >= '11:00:00') { // nếu hôm nay đã nhận khung giờ vàng thứ nhất
                        $event = 0; // 
                    } else { // nếu chưa nhận vào khung giờ vàng đầu tiên
                        $event = 1; // 
                    }
                }
            } else { // nếu chưa có data
                $event = 1;
            }
        } elseif ($date_check >= '20:00:00' && $date_check < '22:00:00') { // nếu đang vào khung giờ vàng thứ 2
            if (count((array)$check_his) > 0) { // nếu đã có data
                $event = 0;
                if (strtotime(date('d-m-Y', $check_his['created_at'])) < strtotime(date('d-m-Y', time()))) { // nếu hôm nay chưa nhận
                    $event = 1; //  
                } elseif (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) { // nếu hôm nay đã nhận

                    if (date('H:i:s', $check_his['created_at']) >= '20:00:00' && date('H:i:s', $check_his['created_at']) < '22:00:00') { // nếu hôm nay đã nhận khung giờ vàng thứ hai
                        $event = 0; // 
                    } else { // nếu chưa nhận vào khung giờ vàng  thứ 2
                        $event = 1; // 
                    }
                }
            } else { // nếu chưa có data
                $event = 1;
            }
        }
        if ($event == 1) {

            $sql_add_free = "INSERT INTO `history_luotquay_free`(`user_id`, `count`, `created_at`) VALUES ('$id',3, '$str_time')";
            $db->query($sql_add_free); // insert vào bảng lượt quay free
            $db->query("UPDATE `accounts` SET   `luotquay_free` = `luotquay_free` + '3'  WHERE `username` = '$iduser'");
        }
    }
    $session->send($iduser); //lưu session id fb
    $db->close(); // Giải phóng

} elseif ($helper->getError()) {
    // The user denied the request
}
// die;
if (isset($_COOKIE['url_301']) && $_COOKIE['url_301'] != "") {

    setcookie('url_301', '', time() + 86400, '/');
    new Redirect($_COOKIE['url_301']);
} else {
    new Redirect($_DOMAIN); // về trang chủ
}
