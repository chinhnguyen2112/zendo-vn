<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Post');
        $this->load->model('Game');
        $this->load->model('Job');
        $this->load->model('Account');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('facebook');
        $this->load->helper('url');
        $this->load->helper('func_helper');
        $this->load->helper('pagination');
        $this->load->library('Globals');
        $this->load->library('pagination311');
        $this->db = $this->load->database('default', TRUE);
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $where_g = [
                'id' => $_SESSION['user']['id'],
                'block' => 0
            ];
            $check_user_g = $this->Account->get_detail_user($where_g);
            $_SESSION['user'] = $check_user_g;
            if ($check_user_g['active'] != 1 && $_SERVER['REQUEST_URI'] != '/active') {
                redirect('/xac-thuc-tai-khoan/');
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['user']);
        redirect('/');
    }
    public function register_sell()
    {
        // $email = $this->input->post('email');
        // $name = $this->input->post('name');
        // $phone = $this->input->post('phone');
        // $pass = md5($this->input->post('pass'));
        // $date_check = date('H:i:s', time());
        // $where_rgt = [
        //     'username' => $name,
        //     'email' => $email,
        //     'phone' => $phone
        // ];
        // $check_register = $this->Account->check_register($where_rgt);
        // if ($check_register > 0) {
        //     $response = [
        //         'status' => 0,
        //         'mess' => 'Tên tài khoản, email hoặc số điện thoại đã được sử dụng, vui lòng kiểm tra lại.'
        //     ];
        // } else {
        //     $code = rand(100000, 999999);
        //     $count = 1; // nếu không vào khung giờ vàng tặng 1 lượt
        //     if (($date_check >= '11:00:00' && $date_check < '12:00:00') || ($date_check > '20:00:00' && $date_check < '21:00:00')) { // check đăng ký có vào khung giờ vàng hay không
        //         $count = 3; // nếu vào khung giờ vàng tặng 3 lượt quay

        //     }
        //     $date = date('Y-m-d H-i-s', time());
        //     $data_insert = [
        //         'username' => $name,
        //         'password' => $pass,
        //         'email' => $email,
        //         'code' => $code,
        //         'phone' => $phone,
        //         'time' => $date,
        //         'user_type' => 1
        //     ];
        //     if (this_source() != 'zendo') {
        //         $data_insert['source'] = this_source();
        //     }
        //     $insert = $this->Account->insert($data_insert, 'accounts');
        //     if ($insert > 0) {
        //         $free_insert = [
        //             'user_id' => $insert,
        //             'count' => $count,
        //             'created_at' => time()
        //         ];
        //         $insert_free = $this->Account->insert($free_insert, 'history_luotquay_free');
        //         $where = [
        //             'id' => $insert
        //         ];
        //         $get_user = $this->Account->get_detail_user($where);
        //         $this->session->set_userdata('user', $get_user);
        //         $body_email = file_get_contents('https://zendo.vn/email_tmp/dangky.html');
        //         $body_email = str_replace('%name%', $name, $body_email);
        //         $body_email = str_replace('%email%', $email, $body_email);
        //         $body_email = str_replace('%code%', $code, $body_email);
        //         $send_mail = sendEmail($email, $name, 'Email thông báo đăng ký thành công tài khoản', $body_email);
        //         if ($send_mail) {
        //             $response = [
        //                 'status' => 1,
        //                 'mess' => 'Đăng ký thành công.'
        //             ];
        //         }
        //     }
        // }
        $response = [
            'status' => 0,
            'mess' => 'Chức năng này dừng hoạt động'
        ];
        echo json_encode($response);
    }
    public function register_user()
    {
        // $email = $this->input->post('email');
        // $name = $this->input->post('name');
        // $pass = md5($this->input->post('pass'));
        // $date_check = date('H:i:s', time());
        // $where_rgt = [
        //     'username' => $name,
        //     'email' => $email
        // ];
        // $check_register = $this->Account->check_register($where_rgt);
        // if ($check_register > 0) {
        //     $response = [
        //         'status' => 0,
        //         'mess' => 'Tên tài khoản hoặc email  đã được sử dụng, vui lòng kiểm tra lại.'
        //     ];
        // } else {
        //     $code = rand(100000, 999999);
        //     $count = 1; // nếu không vào khung giờ vàng tặng 1 lượt
        //     if (($date_check >= '11:00:00' && $date_check < '12:00:00') || ($date_check > '20:00:00' && $date_check < '21:00:00')) { // check đăng ký có vào khung giờ vàng hay không
        //         $count = 3; // nếu vào khung giờ vàng tặng 3 lượt quay

        //     }
        //     $date = date('Y-m-d H-i-s', time());
        //     $data_insert = [
        //         'username' => $name,
        //         'password' => $pass,
        //         'email' => $email,
        //         'code' => $code,
        //         'time' => $date
        //     ];
        //     if (this_source() != 'zendo') {
        //         $data_insert['source'] = this_source();
        //     }
        //     $insert = $this->Account->insert($data_insert, 'accounts');
        //     if ($insert > 0) {
        //         $free_insert = [
        //             'user_id' => $insert,
        //             'count' => $count,
        //             'created_at' => time()
        //         ];
        //         $insert_free = $this->Account->insert($free_insert, 'history_luotquay_free');
        //         $where = [
        //             'id' => $insert
        //         ];
        //         $get_user = $this->Account->get_detail_user($where);
        //         $this->session->set_userdata('user', $get_user);
        //         $body_email = file_get_contents('https://zendo.vn/email_tmp/dangky.html');
        //         $body_email = str_replace('%name%', $name, $body_email);
        //         $body_email = str_replace('%email%', $email, $body_email);
        //         $body_email = str_replace('%code%', $code, $body_email);
        //         // echo $body_email;die;
        //         $send_mail = sendEmail($email, $name, 'Email thông báo đăng ký thành công tài khoản', $body_email);
        //         if ($send_mail) {
        //             $response = [
        //                 'status' => 1,
        //                 'mess' => 'Đăng ký thành công.'
        //             ];
        //         }
        //     }
        // }
        // echo json_encode($response);
        $response = [
            'status' => 0,
            'mess' => 'Chức năng này dừng hoạt động'
        ];
        echo json_encode($response);
    }
    public function login()
    {
        // $date_check = date('H:i:s', time());
        // $str_time = time();
        // $name = $this->input->post('name');
        // $pass = md5($this->input->post('pass'));
        // $type = $this->input->post('type');
        // $where = [
        //     'username' => $name,
        //     'password' => $pass,
        //     'block' => 0
        // ];
        // if (this_source() != 'zendo') {
        //     $where['source'] = this_source();
        // } else {
        //     $where['source IS NULL'] = null;
        // }
        // // var_dump($where);
        // $check_user = $this->Account->get_detail_user($where);
        // if (isset($check_user['id']) &&  $check_user['id'] > 0) {
        //     if ($check_user['active'] == 1) {
        //         // nếu đăng nhập vào giờ vàng
        //         $id = $check_user['id'];
        //         $event = 0;
        //         $where_free = [
        //             'user_id' => $id,
        //             'count' => 3
        //         ];
        //         $check_his = $this->Account->get_luot_quay_free($where_free);
        //         if ($date_check >= '11:00:00' && $date_check < '19:00:00') { // nếu đang vào khung giờ vàng đâu tiên
        //             if (count($check_his) > 0) { // nếu đã có data
        //                 $event = 0;
        //                 if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) { // nếu hôm nay chưa nhận
        //                     $event = 1; //  
        //                 } elseif (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) { // nếu hôm nay đã nhận
        //                     if (date('H:i:s', $check_his['created_at']) < '19:00:00' && date('H:i:s', $check_his['created_at']) >= '11:00:00') { // nếu hôm nay đã nhận khung giờ vàng thứ nhất
        //                         $event = 0; // 
        //                     } else { // nếu chưa nhận vào khung giờ vàng đầu tiên
        //                     }
        //                 }
        //             } else { // nếu chưa có data
        //                 $event = 1;
        //             }
        //         } elseif ($date_check >= '20:00:00' && $date_check < '21:00:00') { // nếu đang vào khung giờ vàng thứ 2
        //             if (count($check_his) > 0) { // nếu đã có data
        //                 $event = 0;
        //                 if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) { // nếu hôm nay chưa nhận
        //                     $event = 1; //  
        //                 } elseif (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) { // nếu hôm nay đã nhận
        //                     if (date('H:i:s', $check_his['created_at']) < '21:00:00' && date('H:i:s', $check_his['created_at']) >= '20:00:00') { // nếu hôm nay đã nhận khung giờ vàng thứ hai
        //                         $event = 0; // 
        //                     } else { // nếu chưa nhận vào khung giờ vàng  thứ 2
        //                         $event = 1; // 
        //                     }
        //                 }
        //             } else { // nếu chưa có data
        //                 $event = 1;
        //             }
        //         }
        //         if ($event == 1) {
        //             $data_insert = [
        //                 'user_id' => $id,
        //                 'count' => 3,
        //                 'created_at' => time()
        //             ];
        //             $insert_free = $this->Account->insert($data_insert, 'history_luotquay_free');
        //             if ($insert_free > 0) {
        //                 $luot_quay_new =   $check_user['luotquay_free'] + 3;
        //                 $where_update = [
        //                     'id' => $id
        //                 ];
        //                 $data_update = [
        //                     'luotquay_free' => $luot_quay_new
        //                 ];
        //                 $check_user['luotquay_free'] = $luot_quay_new;
        //                 $update_free = $this->Account->update($where_update, $data_update, 'accounts');
        //             }
        //         }
        //         $_SESSION['user'] = $check_user;
        //         $this->check_login($id);
        //         $response = [
        //             'status' => 1,
        //             'mess' => 'Đăng nhập thành công.'
        //         ];
        //     } else {
        //         $_SESSION['user'] = $check_user; //lưu session id fb
        //         $body_email = file_get_contents('https://zendo.vn/email_tmp/dangky.html');
        //         $body_email = str_replace('%name%', $check_user['username'], $body_email);
        //         $body_email = str_replace('%email%', $check_user['email'], $body_email);
        //         $body_email = str_replace('%code%', $check_user['code'], $body_email);
        //         sendEmail($check_user['email'], $check_user['username'], 'Email thông báo đăng ký thành công tài khoản', $body_email);
        //         $response = [
        //             'status' => 2,
        //             'mess' => 'Tài khoản chưa xác thực. Chúng tôi đã gửi mã xác thực qua email đăng ký của bạn. Vui lòng kiểm tra hộp thử để có mã xác thực.'
        //         ];
        //     }
        // } else {
        //     $response = [
        //         'status' => 0,
        //         'mess' => 'Sai tài khoản hoặc mật khẩu.'
        //     ];
        // }
        // echo json_encode($response);
        $response = [
            'status' => 0,
            'mess' => 'Chức năng này dừng hoạt động'
        ];
        echo json_encode($response);
    }
    public function login_fb()
    {
        // $id_user = 0;
        // $date_check = date('H:i:s', time());
        // // Authenticate user with facebook 
        // if ($this->facebook->is_authenticated()) {
        //     // Get user info from facebook 
        //     $fbUser = $this->facebook->request('get', '/me?fields=id,name,email');
        //     // Preparing data for database insertion 
        //     $userData['oauth_provider'] = 'facebook';
        //     $userData['oauth_uid']    = !empty($fbUser['id']) ? $fbUser['id'] : '';;
        //     $userData['name']    = !empty($fbUser['name']) ? $fbUser['name'] : '';
        //     $userData['email']        = !empty($fbUser['email']) ? $fbUser['email'] : '';
        //     // var_dump($userData);die;
        //     // Insert or update user data to the database 
        //     $userID = $this->Account->check_data(['username' => $userData['oauth_uid']], 'accounts');
        //     // Check user data insert or update status 
        //     if ($userID > 0) {
        //         $data_user = $this->Account->get_by_id(['username' => $userData['oauth_uid']], 'accounts');
        //         $id_user = $data_user['id'];
        //     } else {
        //         $data_insert = [
        //             'username' => $userData['oauth_uid'],
        //             'name' =>  $userData['name'],
        //             'email' => $userData['email'],
        //             'active' => 1,
        //             'time' => date('Y-m-d H:i:s')
        //         ];
        //         if (this_source() != 'zendo') {
        //             $data_insert['source'] = this_source();
        //         }
        //         $insert = $this->Account->insert($data_insert, 'accounts');
        //         if ($insert > 0) {
        //             $id_user = $insert;
        //             $data_user = $this->Account->get_by_id(['id' => $insert], 'accounts');
        //         }
        //     }
        //     if ($id_user > 0) {
        //         // nếu đăng nhập vào giờ vàng
        //         $id = $id_user;
        //         $event = 0;
        //         $where_free = [
        //             'user_id' => $id,
        //             'count' => 3
        //         ];
        //         $check_his = $this->Account->get_luot_quay_free($where_free);
        //         if ($date_check >= '11:00:00' && $date_check < '19:00:00') { // nếu đang vào khung giờ vàng đâu tiên
        //             if (count((array)$check_his) > 0) { // nếu đã có data
        //                 $event = 0;
        //                 if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) { // nếu hôm nay chưa nhận
        //                     $event = 1; //  
        //                 } elseif (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) { // nếu hôm nay đã nhận
        //                     if (date('H:i:s', $check_his['created_at']) < '19:00:00' && date('H:i:s', $check_his['created_at']) >= '11:00:00') { // nếu hôm nay đã nhận khung giờ vàng thứ nhất
        //                         $event = 0; // 
        //                     } else { // nếu chưa nhận vào khung giờ vàng đầu tiên

        //                     }
        //                 }
        //             } else { // nếu chưa có data
        //                 $event = 1;
        //             }
        //         } elseif ($date_check >= '20:00:00' && $date_check < '21:00:00') { // nếu đang vào khung giờ vàng thứ 2
        //             if (count($check_his) > 0) { // nếu đã có data
        //                 $event = 0;
        //                 if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) { // nếu hôm nay chưa nhận
        //                     $event = 1; //  

        //                 } elseif (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) { // nếu hôm nay đã nhận
        //                     if (date('H:i:s', $check_his['created_at']) < '21:00:00' && date('H:i:s', $check_his['created_at']) >= '20:00:00') { // nếu hôm nay đã nhận khung giờ vàng thứ hai
        //                         $event = 0; // 
        //                     } else { // nếu chưa nhận vào khung giờ vàng  thứ 2
        //                         $event = 1; // 
        //                     }
        //                 }
        //             } else { // nếu chưa có data
        //                 $event = 1;
        //             }
        //         }
        //         if ($event == 1) {
        //             $data_insert = [
        //                 'user_id' => $id,
        //                 'count' => 3,
        //                 'created_at' => time()
        //             ];
        //             $insert_free = $this->Account->insert($data_insert, 'history_luotquay_free');
        //             if ($insert_free > 0) {
        //                 $luot_quay_new =   $data_user['luotquay_free'] + 3;
        //                 $where_update = [
        //                     'id' => $id
        //                 ];
        //                 $data_update = [
        //                     'luotquay_free' => $luot_quay_new
        //                 ];
        //                 $check_user['luotquay_free'] = $luot_quay_new;
        //                 $update_free = $this->Account->update($where_update, $data_update, 'accounts');
        //             }
        //         }
        //         $data_user = $this->Account->get_by_id(['id' => $id_user], 'accounts');
        //         $this->check_login($id);
        //     }
        //     $this->session->set_userdata('user', $data_user);
        //     redirect('/');
        // } else {
        //     redirect('/');
        // }
        redirect('/');
    }
    public function check_login($id)
    {
        // $where = [
        //     'id' => $id
        // ];
        // $check_user = $this->Account->get_detail_user($where);
        // if (isset($check_user['id']) &&  $check_user['id'] > 0) {
        //     // tặng zen
        //     $time_day = strtotime(date('Y-m-d'));
        //     $str_time = time();
        //     $where_login = [
        //         'id_user' => $id,
        //         'created_at >=' => $time_day
        //     ];
        //     $check_login = $this->Account->check_data($where_login, 'login_zen');
        //     if ($check_login < 1) { // nếu chưa đăng nhập
        //         $zen_check = 100;
        //         //check xem nhiệm vụ lần trước có hoàn thành hay không
        //         $where_nv = [
        //             'id_user' => $id,
        //         ];
        //         $check_nv = $this->Account->get_nv_old($where_nv);
        //         if ($check_nv['status'] == 1) {
        //             if ($check_nv['type'] == 0 && $check_user['luotquay'] > 0) {
        //                 $luotquay = $check_user['luotquay'] - 1;
        //                 $data_update = [
        //                     'luotquay' => $luotquay
        //                 ];
        //                 $where_update = [
        //                     'id' => $id
        //                 ];
        //                 $update_free = $this->Account->update($where_update, $data_update, 'accounts'); // trừ lượt quay acc
        //             }
        //             if ($check_nv['type'] == 1 && $check_user['luotquay9k'] > 0) {
        //                 $luotquay = $check_user['luotquay9k'] - 1;
        //                 $data_update = [
        //                     'luotquay9k' => $luotquay
        //                 ];
        //                 $where_update = [
        //                     'id' => $id
        //                 ];
        //                 $update_free = $this->Account->update($where_update, $data_update, 'accounts'); // trừ lượt quay quân huy
        //             }
        //             if ($check_nv['type'] == 2) {
        //                 $zen_check = 150;
        //             }
        //         }
        //         // add nhiệm vụ trafic
        //         $where_get_nv = [
        //             'status' => 1
        //         ];
        //         $check_trafic = $this->Account->get_rand_id($where_get_nv, 'id', 'link_trafic');
        //         $id_trafic = $check_trafic['id'];
        //         if (isset($check_nv['status']) && $check_nv['status'] == 0 && $check_nv['status_nv'] == 1) {
        //             $id_trafic = $check_nv['id_trafic'];
        //         }
        //         $data_insert = [
        //             'id_user' => $id,
        //             'id_trafic' => $id_trafic,
        //             'created_at' => time()
        //         ];
        //         $insert_login = $this->Account->insert($data_insert, 'login_zen');
        //         if ($check_user['zen'] <= $zen_check) {
        //             $data_update_zen = [
        //                 'zen' => 100
        //             ];
        //             $where_update_zen = [
        //                 'id' => $id
        //             ];
        //             $update_free = $this->Account->update($where_update_zen, $data_update_zen, 'accounts'); // tặng zen
        //         }
        //     }
        // }
    }
    public function active()
    {
        $code = $this->input->post('code');
        if (strlen($code) == 6) {
            $id = $_SESSION['user']['id'];
            $where = [
                'id' => $id,
                'code' => $code
            ];
            $check = $this->Account->check_data($where, 'accounts');
            if ($check > 0) {

                $data_update = [
                    'active' => 1
                ];
                $where_update = [
                    'id' => $id
                ];
                $update = $this->Account->update($where_update, $data_update, 'accounts');
                if ($update) {
                    $this->check_login($id);
                    $response = [
                        'status' => 1,
                        'mess' => 'Xác thực thành công!'
                    ];
                }
            } else {
                $response = [
                    'status' => 0,
                    'mess' => 'Mã xác thực không đúng vui lòng kiểm tra lại email !'
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'mess' => 'Mã code không hợp lệ'
            ];
        }
        echo json_encode($response);
    }
    public function re_active()
    {
        $code = rand(100000, 999999);
        $id = $_SESSION['user']['id'];
        $data_update = [
            'code' => $code
        ];
        $where_update = [
            'id' => $id
        ];
        $update = $this->Account->update($where_update, $data_update, 'accounts');
        if ($update) {
            $body_email = file_get_contents('https://zendo.vn/email_tmp/dangky.html');
            $body_email = str_replace('%name%', $_SESSION['user']['username'], $body_email);
            $body_email = str_replace('%email%', $_SESSION['user']['email'], $body_email);
            $body_email = str_replace('%code%', $code, $body_email);
            sendEmail($_SESSION['user']['email'], $_SESSION['user']['username'], 'Email thông báo đăng ký thành công tài khoản', $body_email);
            $response = [
                'status' => 1,
                'mess' => 'Xác thực thành công!'
            ];
        }

        echo json_encode($response);
    }
    public function get_list_lq()
    {
        $page = $this->input->post('page');
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $ngoc = $this->input->post('ngoc');
        $rank = str_replace('.', '', $this->input->post('int_5'));
        $order = $this->input->post('order');
        /* Xử lý tìm kiếm skin */
        $list_skin =  trim($this->input->post('longtext_1'));
        $arr_skin = explode(',', $list_skin);
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Liên Quân Mobile' AND trang_thai_xoa != 1 ";
        // echo $sql;
        if (isset($_SESSION['user'])) {
        } else {
            $sql .= " AND type_post != 4   ";
        }

        if ($arr_skin != '') {
            foreach ($arr_skin as $value) {
                if ($value != "") {
                    $sql .= " AND ( ";
                    $value = trim($value);
                    $sql .= " skins LIKE '%$value%' ";
                    $sql .= " ) ";
                }
            }
        }
        if ($ngoc == 1) {
            $sql .= " AND ip_count != '90' ";
        } else if ($ngoc > 1) {
            $sql .= " AND ip_count = '" . $ngoc . "' ";
        }
        // echo $sql;
        /* Xử lý tìm kiếm champ */
        $list_champs =  trim($this->input->post('longtext_2'));
        $arr_champs = explode(',', $list_champs);
        if ($arr_champs != '') {
            foreach ($arr_champs as $value2) {
                if ($value2 != "") {
                    $sql .= " AND ( ";
                    $value2 = trim($value2);
                    $sql .= " champs LIKE '%$value2%' ";
                    $sql .= " ) ";
                }
            }
        }
        if ($rank == -1) {
            $rank = 0;
        }
        if ($rank > 1) {
            $sql .= " AND rank = $rank ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($ms > 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Liên Quân Mobile' AND trang_thai_xoa != 1  AND id_post = '" . $ms . "'  ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">' . $data_post['champs_count'] . ' tướng</li>
                                    <li class="li_ac">' . $data_post['skins_count'] . ' trang phục</li>
                                    <li class="li_ac">Rank ' . get_string_rank($data_post['rank']) . '</li>
                                    <li class="li_ac">Ngọc ' . $data_post['ip_count'] . ' </li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_freefire()
    {
        $page = $this->input->post('page');
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $rank = str_replace('.', '', $this->input->post('rank'));
        $order = $this->input->post('order');
        $source_signup =   $this->input->post('source_signup');
        $card_infinity =  $this->input->post('card_infinity');
        $pet = $this->input->post('pet');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Free Fire' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($source_signup > 0) { // nếu chọn nguồn đăng ký là facebook
            $source_signup = $source_signup - 1;
            $sql .= " AND source = $source_signup ";
        }
        if ($card_infinity != "") { // nếu chọn thẻ vô cực
            $sql .= " AND card_infinity = $card_infinity ";
        }
        if ($pet > 0) {
            $pet = $pet - 1;
            $sql .= " AND pet = $pet ";
        }
        if ($rank > 1) {
            $sql .= " AND rank = $rank ";
        }
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Free Fire' AND trang_thai_xoa != 1  AND id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);
        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $check_pet = ($data_post['pet'] == 1) ? 'Có' : 'Không';
                $check_card = ($data_post['card_infinity'] == 1) ? 'Có' : 'Không';
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">Đăng ký: ' . source_signup($data_post['source']) . '</li>
                                    <li class="li_ac">Pet: ' . $check_pet . '</li>
                                    <li class="li_ac">Rank ' . str_replace('Cao Thủ', 'Huyền Thoại', get_string_rank($data_post['rank'])) . '</li>
                                    <li class="li_ac">Thẻ vô cực: ' . $check_card . ' </li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_lmht()
    {
        $page = $this->input->post('page');
        /* $_POST */
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $rank = str_replace('.', '', $this->input->post('rank'));
        $order = $this->input->post('order');
        $source_signup =   $this->input->post('source_signup');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Liên Minh Huyền Thoại' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($source_signup > 0) { // nếu chọn nguồn đăng ký là facebook
            $source_signup = $source_signup - 1;
            $sql .= " AND source = $source_signup ";
        }
        if ($rank > 1) {
            $sql .= " AND rank = $rank ";
        }
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Liên Minh Huyền Thoại' AND AND trang_thai_xoa != 1  id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">Server: ' . source_signup($data_post['source'], 'LMHT') . '</li>
                                    <li class="li_ac">Tướng: ' . $data_post['champs_count'] . '</li>
                                    <li class="li_ac">Trang phục ' . $data_post['skins_count'] . '</li>
                                    <li class="li_ac">Rank: ' . str_replace('Khung ', '', get_string_frame($data_post['rank'])) . ' </li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_pubg()
    {
        $page = $this->input->post('page');
        /* $_POST */
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $rank = str_replace('.', '', $this->input->post('rank'));
        $order = $this->input->post('order');
        $source_signup =   $this->input->post('source_signup');
        $pet = $this->input->post('pet');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Pubg' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($source_signup > 0) { // nếu chọn nguồn đăng ký là facebook
            $sql .= " AND source = $source_signup ";
        }
        if ($rank > 1) {
            $sql .= " AND rank = $rank ";
        }
        if ($pet > 0) {
            $pet = $pet - 1;
            $sql .= " AND pet = $pet ";
        }
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Pubg' AND AND trang_thai_xoa != 1  id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $check_pet = ($data_post['pet'] == 1) ? 'Có' : 'Không';
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">Đăng ký: ' . source_signup($data_post['source'], 'PUBG') . '</li>
                                    <li class="li_ac">Pet: ' . $check_pet . '</li>
                                    <li class="li_ac">Rank: ' . get_string_rank($data_post['rank'], 'PUBG') . '</li>
                                    <li class="li_ac">Skin súng: ' . $data_post['champs_count'] . ' </li>
                                    <li class="li_ac">Trang phục: ' . $data_post['skins_count'] . ' </li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_fifa()
    {
        $page = $this->input->post('page');
        /* $_POST */
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $order = $this->input->post('order');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Fifa' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Fifa' AND trang_thai_xoa != 1  AND id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">GTĐH: ' . $data_post['skins'] . '</li>
                                    <li class="li_ac">BP: ' . $data_post['champs'] . '</li>
                                    <li class="li_ac">Ghi chú: ' . $data_post['note'] . '</li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_lmtc()
    {
        $page = $this->input->post('page');
        /* $_POST */
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $rank = str_replace('.', '', $this->input->post('rank'));
        $order = $this->input->post('order');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Tốc Chiến' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($rank > 1) {
            $sql .= " AND rank = $rank ";
        }
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Tốc Chiến' AND trang_thai_xoa != 1  AND id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">Tướng: ' . $data_post['champs_count'] . '</li>
                                    <li class="li_ac">Trang phục ' . $data_post['skins_count'] . '</li>
                                    <li class="li_ac">Rank: ' . get_string_rank($data_post['rank'], 'LMTC') . ' </li>
                                    <li class="li_ac">Ghi chú: ' . $data_post['note'] . '</li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_cf()
    {
        $page = $this->input->post('page');
        /* $_POST */
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $order = $this->input->post('order');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'CF' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'CF' AND trang_thai_xoa != 1  AND id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">Ghi chú: ' . $data_post['note'] . '</li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function get_list_valorant()
    {
        $page = $this->input->post('page');
        /* $_POST */
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $ms = $this->input->post('ms');
        $order = $this->input->post('order');
        $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Valorant' AND trang_thai_xoa != 1  ";
        if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1373 || $_SESSION['user']['id'] == 1572)) {
        } else {
            $sql .= " AND type_post != 4 ";
        }
        $sql .= " AND price BETWEEN $min_price AND $max_price ";
        if ($ms != 0) {
            $sql = "SELECT * FROM posts WHERE status = 0 AND type_account = 'Valorant' AND trang_thai_xoa != 1  AND id_post = '" . $ms . "' ";
        }
        $total_record = $this->db->query($sql)->num_rows(); // đếm hàng
        // config phân trang
        $so_lg = $total_record . ' kết quả';
        $config_page = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "15",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config_page);

        if ($order == 1) {
            $sql .= " ORDER BY price ASC ";
        } else if ($order == 2) {
            $sql .= " ORDER BY price DESC ";
        } else {
            $sql .= " ORDER BY id_post DESC ";
        }
        $sql .= " LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]} ";
        if ($total_record > 0) {
            $list_acc =  $this->db->query($sql)->result_array();
            $html = '';
            foreach ($list_acc as $key => $data_post) {
                if ($data_post['user_id'] > 0) {
                    $source_url = $this->Account->query_sql_row("SELECT source FROM accounts  WHERE id ='{$data_post['user_id']}'");
                    $url_img = site_post($source_url['source']);
                } else {
                    $url_img = site_main();
                }
                $id_acc = $data_post['id_post'];
                $sql_get_pre = "SELECT * FROM pre_order WHERE status = '0' AND id_post = $id_acc";
                $tag = '';
                if ($this->db->query($sql_get_pre)->num_rows() < 1) {
                    if ($data_post['type_post'] == '0') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_ads.png" /></div>';
                    } elseif ($data_post['type_post'] == '2') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag.png" /></div>';
                    } elseif ($data_post['type_post'] == '1') {
                        $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_vip.png" /></div>';
                    }
                } else {
                    $tag = '<div class="tag"><img src="' . site_main() . 'images/tag/tag_coc.png" /></div>';
                }
                $html .= '
                    <div class="box__list_danhmuc"><a href="/tai-khoan-' . $data_post['id_post'] . '/">
                            <img src="' . $url_img . 'assets/files/thumb/' . $data_post['id_post'] . '.jpg" alt="chi tiết acc">
                           ' . $tag . '
                            <div class="box_detail_danhmuc">
                                <p class="count_acc">
                                    <span>Mã số: <span class="num_count">' . $data_post['id_post'] . '</span> </span>
                                    <span>Giá: <span class="num_count">' . number_format($data_post["price"], 0, '.', '.') . 'đ</span> </span>
                                </p>
                                <ul>
                                    <li class="li_ac">Ghi chú: ' . $data_post['note'] . '</li>
                                </ul>
                            </div>
                            <div class="box_price_danhmuc">
                                <span>' . number_format($data_post["price"], 0, '.', '.') . 'đ</span>
                            </div>
                            <p><span class="btn_buy">MUA NGAY</span></p>
                        </a>
                    </div>';
            }
            $html .= '<div></div>' .  $paging->html_site() . '<div></div><p class="tam_count" style="display:none">' . $so_lg . '</p>';
        } else {
            $html = '<div></div><p style="color:#FFF;width: 100%;float:none;text-align:center;font-size:20px;text-transform: uppercase;margin:0;">Không có tài khoản phù hợp với điều kiện tìm kiếm
            <p><div></div>';
        }
        echo $html;
    }
    public function post_veso()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $id_user = $_SESSION['user']['id'];
            $time_check = strtotime(date('Y-m-d 18:00:00'));
            if ($id_user == "") {
                $response = [
                    'status' => 2,
                    'mess' => 'Vui lòng đăng nhập để thực hiện thao tác!'
                ];
            } else {
                $number_vs = $this->input->post("number");
                $zen = $this->input->post("zen");
                if ($number_vs == 0) {
                    $number_vs = '00';
                }
                if ($number_vs <= 99) {
                    if ($zen >= 20) {
                        if ($_SESSION['user']['zen'] >= $zen) {
                            $status = 0;
                            if (time() >= $time_check) {
                                $status = 2;
                            }
                            $data_insert = [
                                'id_user' => $id_user,
                                'number' => $number_vs,
                                'zen' => $zen,
                                'created_at' => time(),
                                'status' => $status
                            ];
                            $insert = $this->Account->insert($data_insert, 've_so');
                            $zen_new = $_SESSION['user']['zen'] - $zen;
                            $data_update = [
                                'zen' => $zen_new
                            ];
                            $where_update = [
                                'id' => $id_user
                            ];
                            $update = $this->Account->update($where_update, $data_update, 'accounts');
                            $response = [
                                'status' => 1,
                                'mess' => 'Đặt cược thành công!'
                            ];
                        } else {
                            $response = [
                                'status' => 0,
                                'mess' => 'Bạn không có đủ Zen để cược!'
                            ];
                        }
                    } else {

                        $response = [
                            'status' => 0,
                            'mess' => 'Tối hiểu cược 20 Zen'
                        ];
                    }
                } else {
                    $response = [
                        'status' => 0,
                        'mess' => 'Con số may mắn phải từ 0 đến 99'
                    ];
                }
            }
        } else {
            $response = [
                'status' => 2,
                'mess' => 'Chưa đăng nhập'
            ];
        }
        echo json_encode($response);
    }
    public function get_xsmb()
    {

        $arr = $this->input->post('arr'); // mảng kết qủa xsmb
        $array_kq = array_count_values($arr);
        $day_now = strtotime(date('Y-m-d'));
        $day_next = strtotime(date('Y-m-d 18:00:00'));
        $where = [
            'status' => 0,
            'created_at >=' =>  $day_now,
            'created_at <' => $day_next
        ];

        $html = '';
        $i = 0;
        $list_id = '';
        $total_record = $this->Game->get_xsmb($where);

        foreach ($total_record as $key => $val) {
            if (array_key_exists($val['number'], $array_kq)) {
                $cnt = ',';
                if ($i == 0) {
                    $cnt = '';
                }
                $list_id .= $cnt . $val['id'] . '-' . $array_kq[$val['number']];
                // echo $list_id,'/';
                $html .= '<tr>
            <td class="text-center">' . ++$i . '</td>
            <td>' . $val['id_user'] . '</td>
            <td>' . $val['name'] . '</td>
            <td>' . $val['number'] . '</td>
            <td>' . $val['zen'] . '</td>
            <td>' . $array_kq[$val['number']] . '</td>
        </tr>';
            }
        }
        $html .= '<input type="hidden" name="" id="list_id_trung" value="' . $list_id . '">
                    <input type="hidden" name="" id="number_user_trung" value="' . $i . '">';
        // die;
        echo $html;
    }
    public function check_xsmb()
    {
        if (this_source() == 'zendo' && is_admin_vip()) {
            $list_id = $this->input->post("list_id"); // mảng kết qủa xsmb
            $day_now = strtotime(date('Y-m-d'));
            $day_next = $day_now + 86400;
            $where_update_2 = [
                'created_at >=' =>  $day_now,
                'created_at <' => $day_next
            ];
            $data_update_2 = [
                'status' => 2
            ];
            $update_free = $this->Account->update($where_update_2, $data_update_2, 've_so'); // chuyển tất cả về trựot
            if ($list_id != '') {
                $arr_id = explode(',', $list_id);
                foreach ($arr_id as $val) {
                    $list_new = explode('-', $val);
                    $where_update_1 = [
                        'id' =>  $list_new[0],
                    ];
                    $data_update_1 = [
                        'status' => 1
                    ];
                    $update_1 = $this->Account->update($where_update_1, $data_update_1, 've_so'); // tặng zen

                    $total_record = $this->Post->get_id($where_update_1, 've_so');
                    $where_u = [
                        'id' => $total_record['id_user']
                    ];
                    $get_user = $this->Post->get_id($where_u, 'accounts');
                    $zen = (int)$get_user['zen'] + round((int)$list_new[1] * (int)$total_record['zen'] * 3.4);
                    $data_update_zen = [
                        'zen' => (int)$zen
                    ];
                    // var_dump([
                    //     'user_zen' =>(int)$get_user['zen'],
                    //     'list_new' => (int)$list_new[1],
                    //     'total' => (int)$total_record['zen']

                    // ]);
                    // echo $zen ;
                    $update_zen = $this->Account->update($where_u, $data_update_zen, 'accounts'); // tặng zen
                }
                $response = [
                    'status' => 1,
                    'msg' => 'Trao giải thành công'
                ];
            } else {

                $response = [
                    'status' => 0,
                    'msg' => 'Không có tài khoản nào trúng thưởng'
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'msg' => 'Khoong phải là admin'
            ];
        }

        echo json_encode($response);
    }
    public function random_lucky()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {

            $type_play = $_COOKIE['this_play'];
            $id = $_SESSION['user']['id'];
            $where = [
                'id' => $id
            ];
            $data_count = $this->Post->get_id($where, 'accounts');
            if ($data_count[$type_play] < 1) {
                $mess = [
                    'status' => 2,
                ];
            } else {
                $random = rand(1, 1000);
                $date_check = date('H:i:s', time());
                $where_his = [
                    'id_user' => $id,
                    'type >' => 1
                ];
                $event = 0;
                $check_his = $this->Account->get_by_id($where_his, 'history_gift');
                if ($type_play == 'luotquay_free') {
                    $event = 1; // quay được acc vào hôm trước hoặc chưa quay được
                }
                if ($check_his > 0) {
                    if (date('d-m-Y', $check_his['created_at']) == date('d-m-Y', time())) {
                        $event = 0; // quay được acc vào hôm nay rồi
                    }
                }
                // check xem còn acc free hay không
                $where_free = [
                    'type_account' => 'Liên Quân Free',
                    'status' => 0
                ];
                $check_acc_free = $this->Account->check_data($where_free, 'posts');
                if ($check_acc_free < 1) {
                    $event = 0;
                }
                /// nếu quay free vào khung giờ vàng và  quay được acc vào hôm trước hoặc chưa quay được
                if ($event == 1 && $type_play == 'luotquay_free' && (($date_check >= '11:00:00' && $date_check < '12:00:00') || ($date_check >= '20:00:00' && $date_check < '21:00:00'))) {
                    $random = rand(1, 20);
                    if ($random > 2) { // nếu quay không trúng acc thì random các phần thưởng khác
                        $random = rand(3, 1000);
                    }
                } elseif ($event == 0 && $type_play == 'luotquay_free') {
                    $random = rand(3, 1000);
                }
                $where_gift = [
                    'type' => $type_play,
                    'vip >' => 0
                ];
                $arr_gift = $this->Post->get_list_asc($where_gift, 'vip', 'gift');
                $tam = 0;
                $count = count($arr_gift);
                $i = 0;
                $type_gift = 0;
                foreach ($arr_gift as $key => $val) {
                    if ($random > $tam && $random <= $tam + $val['vip'] * 10) {

                        if ($val['type_item'] != 12) { // nếu = 12 là thêm lượt quay nên không trừ lượt quay
                            $where_update = [
                                'id' =>  $id,
                            ];
                            $update = $this->Account->update_set($where_update, $type_play, 1, '-', 'accounts'); // trừ lượt quay
                        }
                        if ($val['type_item'] == 0) {
                            $update = $this->Account->update_set($where_update, 'zen', $val['zen'], '+', 'accounts'); // cộng zen
                        } else if ($val['type_item'] == 5) {
                            if ($event == 1  && $type_play == 'luotquay_free') {
                                $where_rand = [
                                    'type_account' => 'Liên Quân Free',
                                    'status' => 0
                                ];
                                $acc_active = $this->Account->get_rand_id($where_rand, 'id_post', 'posts');
                            } else {
                                $where_rand = [
                                    'price' => $val['value'],
                                    'status' => 0
                                ];
                                $acc_active = $this->Account->get_rand_like_id($where_rand, 'id_post', 1, 'posts');
                            }
                            $type_gift = $acc_active['id_post'];
                            $where_update_post = [
                                'id_post' => $type_gift
                            ];
                            $data_update_post = [
                                'status' => 2
                            ];
                            $update = $this->Account->update($where_update_post, $data_update_post, 'posts'); // status
                        }
                        $vip = $val['id'];
                        $data_insert_gift = [
                            'id_user' => $id,
                            'id_gift' => $vip,
                            'created_at' => time(),
                            'type' => $type_gift
                        ];
                        $insert_his = $this->Account->insert($data_insert_gift, 'history_gift');
                        $mess = [
                            'status' => 1,
                            'stt' => $val['stt'],
                            'img_vip' => $val['image'],
                            'name' => $val['name'],
                            'random' => $random,
                            'type_gift' => $val['type_item'],
                            'vip' => $val['vip']
                        ];
                    }
                    $i++;
                    $tam +=  $val['vip'] * 10;
                }
            }
        } else {
            $mess = [
                'status' => 0,
            ];
        }

        echo json_encode($mess);
    }
    public function nhan_luot_quay()
    {
        $id = $_SESSION['user']['id'];
        $where_free = [
            'user_id' => $id
        ];
        $history_luotquay_free = $this->Account->get_luot_quay_free($where_free);
        if ($history_luotquay_free == '') {
            $data = [
                'user_id' => $id,
                'created_at' => time()
            ];
            $insert = $this->Account->insert($data, 'history_luotquay_free');
            $where_u = [
                'id' => $id
            ];
            $update = $this->Account->update_set($where_u, 'luotquay_free', 1, '+', 'accounts');
            $mess = [
                'status' => 1,
            ];
        } elseif ($history_luotquay_free != '' && $history_luotquay_free['created_at'] + 86400 <= time()) {
            $data = [
                'user_id' => $id,
                'created_at' => time()
            ];
            $insert = $this->Account->insert($data, 'history_luotquay_free');
            $where_u = [
                'id' => $id
            ];
            $update = $this->Account->update_set($where_u, 'luotquay_free', 1, '+', 'accounts');
            $mess = [
                'status' => 1,
            ];
        } else {
            $mess = [
                'status' => 0,
            ];
        }
        echo json_encode($mess);
    }
    public function mua_luot_quay()
    {
        if (check_login() && !is_user_seller()) {
            $id = $_SESSION['user']['id'];
            $username = $_SESSION['user']['username'];
            $name = $_SESSION['user']['name'];
            $type_buy = $this->input->post('val');
            $price = $this->input->post('price');
            $count = $this->input->post('count');
            $type_mua = $this->input->post('type_buy');
            $date = date('Y-m-d H-i-s', time());
            //giá lượt quay
            if ($count == 1) {
                $price = 10000;
            } else if ($count == 3) {
                $price = 28000;
            } else if ($count == 5) {
                $price = 44000;
            } else if ($count == 8) {
                $price = 73000;
            } else if ($count == 10) {
                $price = 91000;
            }
            if ($type_mua == 1) {
                if ($price > $_SESSION['user']['cash']) {
                    $mess = [
                        'status' => 0,
                    ];
                } else {
                    $where_u = [
                        'id' => $id
                    ];
                    $update = $this->Account->update_set($where_u, $type_buy, $count, '+', 'accounts');
                    $update_cash = $this->Account->update_set($where_u, 'cash', $price, '-', 'accounts');
                    $data = [
                        'username' => $username,
                        'name' => $name,
                        'id_post' => $count,
                        'price' => $price,
                        'time' => $date,
                        'code' => $type_buy,
                        'type' => 1
                    ];
                    $insert = $this->Account->insert($data, 'history_buy');
                    $mess = [
                        'status' => 1,
                    ];
                }
            } else {
                $price = ($price / 200) + ($price / 100);
                if ($price > $_SESSION['user']['zen']) {
                    $mess = [
                        'status' => 0,
                    ];
                } else {
                    $where_u = [
                        'id' => $id
                    ];
                    $update = $this->Account->update_set($where_u, $type_buy, $count, '+', 'accounts');
                    $update_cash = $this->Account->update_set($where_u, 'zen', $price, '-', 'accounts');
                    $mess = [
                        'status' => 1,
                    ];
                }
            }
        } else {
            $mess = [
                'status' => 2,
                'msg' => 'Tài khoản của bạn là tài khoản bán acc. Vui lòng đăng nhập tài khoản mua acc để tiếp tục!'
            ];
        }
        echo json_encode($mess);
    }
    public function lich_su_quay()
    {
        $id = $_SESSION['user']['id'];
        $list_his = $this->Game->get_history_random($id);
        $html = "";
        foreach ($list_his as $key => $val) {
            if ($val['gift_type'] == 'luotquay') {
                $type =   " Vòng quay siêu phẩm";
            } else if ($val['gift_type'] == 'luotquay9k') {
                $type =   " Vòng quay quân huy";
            } else if ($val['gift_type'] == 'luotquay20k') {
                $type =   " Vòng quay trang phục";
            } else if ($val['gift_type'] == 'luotquay_free') {
                $type =   " Vòng quay nhiệm vụ";
            }
            $btn = "";
            if ($val['type'] > 1) {
                $where = [
                    'id_post' => $val['type']
                ];
                $acc_active = $this->Post->get_id($where, 'posts');
                if ($acc_active['status'] == 2) {
                    $btn = '<span onclick="buy_acc(0,' . $val['type'] . ',' . $val['id_gift'] . ',this)">Bán lại</span><span style="background:#e67300" onclick="buy_acc(1,' . $val['type'] . ',' . $val['id_gift'] . ',this)">Nhận acc</span>';
                    $val['name'] = '<a target="_blank" href="/tai-khoan-' . $val['type'] . '.html">Tài khoản mã số #' . $val['type'] . '</a>';
                } else {
                    $val['name'] = 'Tài khoản:' . $acc_active['username'] . ' | Mật khẩu: ' . $acc_active['password'];
                }
            }
            $html .= '<tr>
            <td class="td_stt">' . $key++ . '</td>
            <td>' . $type . '</td>
            <td data-val="' . $val['zen'] . '">' . $val['name'] . $btn . '</td>
            <td>' . date('d-m-Y H:i:s', $val['created_at']) . '</td>
        </tr>';
        }
        $mess = [
            'status' => 1,
            'html' => $html
        ];
        echo json_encode($mess);
    }
    public function nhan_acc_random()
    {
        $id = $_SESSION['user']['id'];
        $type_buy = $this->input->post('type_buy');
        $id_acc = $this->input->post('id_acc');
        $id_gift = $this->input->post('id_gift');
        $where_sl = [
            'type' => $id_acc,
            'id_user' => $id
        ];
        $count = $this->Account->check_data($where_sl, 'history_gift');
        if ($count > 0) {
            if ($type_buy == 0) {
                $where_update_post = [
                    'id_post' => $id_acc
                ];
                $data_update_post = [
                    'status' => 0
                ];
                $update = $this->Account->update($where_update_post, $data_update_post, 'posts'); // status
                if ($update) {

                    $where_zen = [
                        'id' => $id_gift
                    ];
                    $gift_buy = $this->Post->get_id($where_zen, 'gift');
                    $where_u = [
                        'id' => $id
                    ];
                    $update_u = $this->Account->update_set($where_u, 'zen', $gift_buy['zen'], '+', 'accounts'); // cộng zen
                    $where_update_his = [
                        'type' => $id_acc,
                        'id_user' => $id
                    ];
                    $data_update_his = [
                        'type_use' => 1
                    ];
                    $update_his = $this->Account->update($where_update_his, $data_update_his, 'history_gift'); // đổi thành trạng thái đã bán zen
                    $mess = [
                        'status' => 1,
                        'mess' => 'Bán lại thành công, tài khoản của bạn được cộng ' . $gift_buy['zen'] . ' zen',
                    ];
                }
            } else {
                $where_update_post = [
                    'id_post' => $id_acc
                ];
                $data_update_post = [
                    'status' => 1
                ];
                $update_post = $this->Account->update($where_update_post, $data_update_post, 'posts'); //  status
                $where = [
                    'id_post' => $id_acc
                ];
                $gift_this = $this->Post->get_id($where, 'posts');
                $mess = [
                    'status' => 2,
                    'mess' => 'Nhận acc thành công!',
                    'text' => 'Tài khoản:' . $gift_this['username'] . ' | Mật khẩu: ' . $gift_this['password'],
                ];
            }
        } else {
            $mess = [
                'status' => 0,
            ];
        }
        echo json_encode($mess);
    }
    public function tim_kiem_kho_do()
    {
        $name = $this->input->post('name');
        $id = $_SESSION['user']['id'];

        $sql_count = "SELECT SUM(value) as val_item
        FROM history_gift
        INNER JOIN gift
        ON history_gift.id_gift=gift.id
        WHERE id_user = '$id' AND gift.type_item = 1  GROUP BY  type_item";
        $count_1 = $this->Account->query_sql_row($sql_count);

        $sql_vp = "SELECT SUM(history_vp.count) as count_vp
        FROM history_vp
        INNER JOIN gift
        ON history_vp.id_item=gift.id
        WHERE id_user = '$id' AND gift.type_item = 1  GROUP BY  type_item";
        $count_vp = $this->Account->query_sql_row($sql_vp);

        $sql = "SELECT history_gift.*, gift.name, gift.image, gift.type_item, gift.zen, gift.des, gift.value_use, COUNT(*) as count_item
            FROM history_gift
            INNER JOIN gift
            ON history_gift.id_gift=gift.id
            WHERE id_user = '$id' AND history_gift.type = 0 AND gift.type_item !=0 AND name LIKE '%$name%' GROUP BY type_item";

        $count = $this->Account->query_sql($sql);
        if (count($count) > 0) {
            $html = '';
            // trừ số lượng rút hoặc bán quân huy
            foreach ($count as $key => $val) { // xóa item quân huy khi số lượng bằng 0
                if ($val['type_item'] == 1 && ($count_1['val_item'] - $count_vp['count_vp']) <= 0) {
                    array_splice($count, $key, 1);
                }
            }
            foreach ($count as $key => $val) {
                if ($key == 0) {
                    $class  = 'border_item';
                } else {
                    $class = "";
                }
                if ($val['count_item'] > 1) {
                    $count_item = $val['count_item'];
                } else {
                    $count_item = "";
                }
                if ($val['type_item'] != 0 && $val['type_item'] != 5 && $val['type_item'] != 12) {
                    if ($val['type_item'] == 1) {

                        $html .= '<div  onclick="click_img(this)" class="item_bag  ' . $class . '" data-type="' . $val['type_item'] . '" data-zen="' . $val['zen'] . '" data-des="' . $val['des'] . '" data-value_use="' . $val['value_use'] . '" data-count="' . $val['count_item'] . '" data-count_qh="' . $count_1['val_item'] . '">
                            <span class="quantity">' . ($count_1['val_item'] - $count_vp['count_vp']) . '</span>
                            <img class="img_item" data-name="' . $val['name'] . '" data-id="' . $val['id_gift'] . '" src="' . site_main() . $val['image'] . '" alt="item_img">
                        </div>';
                    } else {

                        $html .= '<div  onclick="click_img(this)" class="item_bag  ' . $class . '" data-type="' . $val['type_item'] . '" data-zen="' . $val['zen'] . '" data-des="' . $val['des'] . '" data-value_use="' . $val['value_use'] . '" data-count="' . $val['count_item'] . '" data-count_qh="' . $count_1['val_item'] . '">
                    <span class="quantity">' . $count_item . '</span>
                    <img class="img_item" data-name="' . $val['name'] . '" data-id="' . $val['id_gift'] . '" src="' . site_main() . $val['image'] . '" alt="item_img">
                </div>';
                    }
                }
            }
            $response = [
                'status' => 1,
                'html' => $html,
                'name' => $count[0]['name'], // trả về thông tin vật phẩm đầu tiên, hiển thị bên cột phải khi tìm kiếm
                'qhuy' => ($count_1['val_item'] - $count_vp['count_vp']),
                'des' => $count[0]['des'],
                'zen' => $count[0]['zen'],
                'image' => $count[0]['image'],
                'type_item' => $count[0]['type_item']
            ];
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }
    public function rut_vat_pham()
    {
        $type_item = $this->input->post('type_item');
        $id = $_SESSION['user']['id'];
        $id_item = $this->input->post('id_item');
        $count_item = $this->input->post('count_item');
        $qty = $this->input->post('qty');
        $last_count = $count_item - $qty;
        $where_zen = [
            'type_item' => $type_item
        ];
        $get_zen = $this->Post->get_list($where_zen, 'gift');
        if ($type_item != 1) {
            $html_where = "";
            foreach ($get_zen as $key => $val) {
                if ($key == 0) {
                    $cn = "";
                } else {
                    $cn =  " OR ";
                }
                $html_where .= ' ' . $cn . ' id_gift = ' . $val['id'] . ' ';
            }
            $sql_his_gift = "SELECT * FROM  history_gift WHERE id_user = '$id' AND type = 0 AND ($html_where)";
            $data_his_gift  =  $this->Account->query_sql($sql_his_gift);
            foreach ($data_his_gift as $key => $val) {
                if ($key < $qty) {
                    $where_update_his = [
                        'id' => $val['id'],
                        'id_user' => $id
                    ];
                    $data_update_his = [
                        'type' => 1
                    ];
                    $update_his = $this->Account->update($where_update_his, $data_update_his, 'history_gift'); // đổi thành trạng thái đã bán zen
                }
            }
        }
        // luu lich su rut
        $data_insert = [
            'id_user' => $id,
            'id_item' => $id_item,
            'count' => $qty,
            'created_at' => time(),
            'updated_at' => time(),
            'type' => 0
        ];
        $insert = $this->Account->insert($data_insert, 'history_vp');
        if ($insert > 0) {
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!',
                'last_count' => $last_count,
            ];
        }
        echo json_encode($response);
    }
    public function ban_vat_pham()
    {
        $type_item = $this->input->post('type_item');
        $id = $_SESSION['user']['id'];
        $count_item = $this->input->post('count_item');
        $zen_total = $_SESSION['user']['zen'];
        $qty = $this->input->post('qty');
        $last_count = $count_item - $qty;
        //lấy giá zen của vật phẩm
        $id_item = $this->input->post('id');
        $where_zen = [
            'id' => $id_item
        ];
        $get_zen = $this->Post->get_id($where_zen, 'gift');
        $zen = $get_zen['zen'];
        $sell = $zen_total + ($zen * $qty);
        $price = $zen * $qty;
        if ($type_item == 1) { // nếu là quân huy
            $sql_count = "SELECT SUM(value) as val_item
            FROM history_gift
            INNER JOIN gift
            ON history_gift.id_gift=gift.id
            WHERE id_user = '$id' AND gift.type_item = 1  GROUP BY  type_item";
            $count_1 =  $this->Account->query_sql_row($sql_count); // đến số lượng quân huy quay được


            $sql_vp = "SELECT SUM(history_vp.count) as count_vp
            FROM history_vp
            INNER JOIN gift
            ON history_vp.id_item=gift.id
            WHERE id_user = '$id' AND gift.type_item = 1  GROUP BY  type_item";
            $count_vp =  $this->Account->query_sql_row($sql_vp);  // đến số lượng quân huy đã bán hoặc rút
            $count_sl = ($count_1['val_item'] - $count_vp['count_vp']); // đây là lấy hiệu số còn lại sau khi bán hoặc rút
        } else { // nếu không là quân huy
            $sql = "SELECT history_gift.id
            FROM history_gift
            INNER JOIN gift
            ON history_gift.id_gift=gift.id
            WHERE id_user = '$id' AND gift.type_item = $type_item AND history_gift.type = 0";
            $count =  $this->Account->query_sql($sql);
            $count_sl =  count($count);
        }
        if ($qty <=  $count_sl) { // nếu số lượng nhập vào nhỏ hơn số lượng hiện có
            //luu lich su ban
            $data_insert = [
                'id_user' => $id,
                'id_item' => $id_item,
                'count' => $qty,
                'price' => $price,
                'created_at' => time(),
                'updated_at' => time(),
                'type' => 1
            ];
            $insert = $this->Account->insert($data_insert, 'history_vp');
            // update zen
            $where_update_zen = [
                'id' => $id
            ];
            $data_update_zen = [
                'zen' => $sell
            ];
            $update_zen = $this->Account->update($where_update_zen, $data_update_zen, 'accounts'); // đổi thành trạng thái đã bán zen
            // update so luong sau khi ban
            if ($type_item != 1) {
                $where_gift = [
                    'id' => $id_item
                ];
                $data_gift = $this->Post->get_list($where_gift, 'gift');
                $html_where = "";
                foreach ($data_gift as $key => $val) {
                    if ($key == 0) {
                        $cn = "";
                    } else {
                        $cn =  " OR ";
                    }
                    $html_where .= ' ' . $cn . ' id_gift = ' . $val['id'] . ' ';
                }
                $sql_his_gift = "SELECT * FROM  history_gift WHERE id_user = '$id' AND type = 0 AND ($html_where)";
                $data_his_gift  =  $this->Account->query_sql($sql_his_gift);
                foreach ($data_his_gift as $key => $val) {
                    if ($key < $qty) {
                        $where_update_his = [
                            'id' => $val['id'],
                            'id_user' => $id
                        ];
                        $data_update_his = [
                            'type' => 1
                        ];
                        $update_his = $this->Account->update($where_update_his, $data_update_his, 'history_gift'); // đổi thành trạng thái đã bán zen
                    }
                }
            }
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!',
                'last_count' => $last_count,
                'zen' => $sell,
            ];
        } else {
            $response = [
                'status' => 0,
                'mess' => 'Số lượng không phù hợp!',

            ];
        }
        echo json_encode($response);
    }
    public function diem_danh()
    {
        if (check_login()) {
            $id_user = $_SESSION['user']['id'];
            $check = 0;
            $sql = "SELECT * FROM diemdanh  WHERE id_user = $id_user  ORDER BY id DESC";
            $row = $this->Account->query_sql_num($sql);
            if ($row > 0) {
                $check_his = $this->Account->query_sql_row($sql);
                if (date('m', $check_his['created_at']) < date('m', time()) || date('y', $check_his['created_at']) < date('y', time())) {
                    $check = 1;
                } else {
                    if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) {
                        $check = 1;
                    } else {
                        $check = 0;
                    }
                }
            } else {
                $check = 1;
            }
            if ($check == 1) {
                $data_insert = [
                    'id_user' => $id_user,
                    'created_at' => time()
                ];
                $this->Account->insert($data_insert, 'diemdanh'); // insert vào bảng lượt quay free

                $where_update = [
                    'id' => $id_user
                ];
                $update_u = $this->Account->update_set($where_update, 'point', 5, '+', 'accounts'); // cộng zen
                $response = [
                    'status' => 1,
                    'mess' => 'Điểm danh thành công!'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'mess' => 'Hôm nay bạn đã điểm danh. Vui lòng quay lại vào ngày mai!'
                ];
            }
            echo json_encode($response);
        } else {
            redirect('/dang-nhap/');
        }
    }
    public function nv_trafic()
    {
        if (check_login()) {
            $id_user = $_SESSION['user']['id'];
            $giftcode = $this->input->post('giftcode');
            if ($giftcode != '') {
                $sql = "SELECT login_zen.*,type FROM `login_zen` INNER JOIN link_trafic ON link_trafic.id = login_zen.id_trafic  WHERE id_user = $id_user  ORDER BY login_zen.id DESC LIMIT 1";
                $check_his = $this->Account->query_sql_row($sql);
                if ($check_his['status'] == 1) {
                    $response = [
                        'status' => 0,
                        'mess' => 'Bạn đã hoàn thành nhiệm vụ hôm nay rồi. Vui lòng quay lại vào ngày mai để nhận nhiệm vụ mới!'
                    ];
                } else {
                    $day_check = $check_his['id_trafic'] . '-' . date('d');
                    $code_check = md5($day_check);
                    if ($giftcode == $code_check) {
                        $where_update_login = [
                            'id' => $check_his['id']
                        ];
                        $data_update_login = [
                            'status' => 1
                        ];
                        $update_login = $this->Account->update($where_update_login, $data_update_login, 'login_zen');
                        if ($check_his['type'] == 0) {
                            $type_update = 'luotquay';
                            $num  = 1;
                            $text = 'Xin chúc mừng. Phần thưởng của bạn là 1 lượt quay vòng quay nick liên quân!';
                        } elseif ($check_his['type'] == 1) {
                            $type_update = 'luotquay9k';
                            $num  = 1;
                            $text = 'Xin chúc mừng. Phần thưởng của bạn là 1 lượt quay vòng quay quân huy!';
                        } else {
                            $type_update = 'zen';
                            $num  = 50;
                            $text = 'Xin chúc mừng. Phần thưởng của bạn là 50 Zen!';
                        }
                        $where_u = [
                            'id' => $id_user
                        ];
                        $update_u = $this->Account->update_set($where_u, $type_update, $num, '+', 'accounts'); // cộng zen
                        $response = [
                            'status' => 1,
                            'mess' => $text,
                            'type' => $check_his['type']
                        ];
                    } else {
                        $response = [
                            'status' => 0,
                            'mess' => 'Mã phần thưởng không đúng. Vui lòng làm theo hướng dẫn để có mã phần thưởng'
                        ];
                    }
                }
            } else {
                $response = [
                    'status' => 0,
                    'mess' => 'Vui lòng nhập mã phần thưởng'
                ];
            }
        } else {

            $response = [
                'status' => 2,
                'mess' => 'Vui lòng đăng nhập để thực hiện thao tác!'
            ];
        }
        echo json_encode($response);
    }
    public function card()
    {
        $iduser = $_SESSION['user']['username'];
        $name = addslashes($_SESSION['user']['name']);
        function curl($url, $post = false, $ref = '', $cookie = false, $follow = false, $cookies = false, $header = true, $headers = false)
        {
            $ch = curl_init($url);
            if ($ref != '') {
                curl_setopt($ch, CURLOPT_REFERER, $ref);
            }
            if ($cookie) {
                curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            }
            if ($cookies) {
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
            }
            if ($post) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_POST, 1);
            }
            if ($follow) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            if ($header)     curl_setopt($ch, CURLOPT_HEADER, 1);
            if ($headers)        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);

            //curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            $result[0] = curl_exec($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $result[1] = substr($result[0], $header_size);
            curl_close($ch);
            return $result;
        }
        function curl1($url, $post = false, $ref = '', $cookie = false, $cookies = false, $header = true, $headers = false, $follow = false)
        {
            $ch = curl_init($url);
            if ($ref != '') {
                curl_setopt($ch, CURLOPT_REFERER, $ref);
            }
            if ($cookie) {
                curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            }
            if ($cookies) {
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
            }
            if ($post) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_POST, 1);
            }
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);

            //curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            $result[0] = curl_exec($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $result[1] = substr($result[0], $header_size);
            curl_close($ch);
            return $result;
        }


        function getcookie($content)
        {
            preg_match_all('/Set-Cookie: (.*);/U', $content, $temp);
            $cookie = $temp[1];
            $cookies = "";
            $a = array();
            foreach ($cookie as $c) {
                $pos = strpos($c, "=");
                $key = substr($c, 0, $pos);
                $val = substr($c, $pos + 1);
                $a[$key] = $val;
            }
            foreach ($a as $b => $c) {
                $cookies .= "{$b}={$c};";
            }
            return $cookies;
        }
        function number_in_string($string)
        {
            try {
                if (!is_string($string))
                    throw new Exception("Error : Param Type");
                preg_match_all("/\d+/", $string, $matches);
                // Return the all coincidences
                return $matches[0];
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        function card_type($stt)
        {
            switch ($stt) {
                case "Vinaphone":
                    $text = "VNP";
                    break;
                case "Mobifone":
                    $text = "VMS";
                    break;
                case "Viettel":
                    $text = "VTT";
                    break;
                case "Gate":
                    $text = "Gate";
                    break;
                default:
                    // code...
                    break;
            }
            return $text;
        }





        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 1) {


            if (!$_POST['type']) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Chưa chọn loại nhà mạng"));
            } elseif (!$_POST['code']) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Chưa nhập mã thẻ"));
            } elseif ($this->input->post('menhgia') == "chuachon") {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Vui lòng chọn mệnh giá thẻ"));
            } elseif (!$_POST['serial']) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Chưa nhập mã seri"));
            } else if ($this->input->post('type') == "Viettel" && (strlen($this->input->post('serial')) != 11 && strlen($this->input->post('serial')) != 14)) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Độ dài không hợp lệ, Seri thẻ Viettel phải có độ dài 11 hoặc 14"));
            } else if ($this->input->post('type') == "Viettel" && (strlen($this->input->post('code')) != 13 && strlen($this->input->post('code')) != 15)) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Độ dài không hợp lệ , Mã thẻ Viettel phải có độ dài 13 hoặc 15"));
            } else if ($this->input->post('type') == "Mobifone" && (strlen($this->input->post('code')) != 12)) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Độ dài không hợp lệ, Mã thẻ Mobifone phải có độ dài là 12"));
            } else if ($this->input->post('type') == "Vinaphone" && (strlen($this->input->post('code')) != 14)) {
                echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Độ dài không hợp lệ , Mã thẻ Vinaphone phải có độ dài là 14"));
            } else {


                function remove_n($num)
                {
                    return preg_replace('/[^0-9]/', '', $num);
                }

                function curl_post($url, $data)
                {
                    $dataPost = '';

                    if (is_array($data))
                        $dataPost = http_build_query($data);
                    else
                        $dataPost = $data;

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
                    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    curl_setopt($ch, CURLOPT_REFERER, $actual_link);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    return $result;
                }


                function xss_clean($data)
                {
                    // Fix &entity\n;
                    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
                    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
                    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
                    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

                    // Remove any attribute starting with "on" or xmlns
                    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

                    // Remove javascript: and vbscript: protocols
                    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
                    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
                    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

                    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
                    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
                    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
                    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

                    // Remove namespaced elements (we do not need them)
                    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

                    do {
                        // Remove really unwanted tags
                        $old_data = $data;
                        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
                    } while ($old_data !== $data);

                    // we are done...
                    return $data;
                }


                $TxtSeri = xss_clean($this->input->post('serial'));

                $TxtCard  = xss_clean($this->input->post('type'));
                $menhgia  = xss_clean($this->input->post('menhgia'));
                $TxtMaThe = xss_clean($this->input->post('code'));

                $count = $this->Account->query_sql_num("SELECT * FROM history_card WHERE seri = '{$TxtSeri}' AND code = '{$TxtMaThe}' LIMIT 1");
                if ($count == 0) {
                    $partner_id = '3437753661'; //tes
                    $partner_key = 'b4a4eef850f4cb9c85e9a3a3a54ec154';
                    $info_card = 0;
                    if ($info_card == 10000) {
                        $vnd = 10000;
                    } elseif ($info_card == 20000) {
                        $vnd = 20000;
                    } elseif ($info_card == 30000) {
                        $vnd = 30000;
                    } elseif ($info_card == 50000) {
                        $vnd = 50000;
                    } elseif ($info_card == 100000) {
                        $vnd = 100000;
                    } elseif ($info_card == 200000) {
                        $vnd = 200000;
                    } elseif ($info_card == 300000) {
                        $vnd = 300000;
                    } elseif ($info_card == 500000) {
                        $vnd = 500000;
                    } elseif ($info_card == 1000000) {
                        $vnd = 1000000;
                    } else {
                        $vnd = 0;
                    }


                    $telco = $TxtCard;
                    $amount = $menhgia;
                    $serial = $TxtSeri;
                    $code = $TxtMaThe;
                    $request_id = rand(100000000, 999999999);  /// Cái này có thể mà mã order của bạn, nếu không có thì để nguyên ko cần động vào.
                    // $sign = md5($partner_id.$partner_key.$telco.$code.$serial.$amount.$request_id);
                    $dataPost = array();
                    $dataPost['request_id'] = $request_id;
                    $dataPost['code'] = $code;
                    $dataPost['partner_id'] = $partner_id;
                    $dataPost['serial'] = $serial;
                    $dataPost['telco'] = $telco;
                    $dataPost['command'] = 'charging';

                    // $dataPost = array(
                    // 	'request_id' => $request_id,
                    // 	'partner_id' => $partner_id,
                    // 	'code' => $code,
                    // 	'serial' => $serial,
                    // 	'telco' => $telco,
                    //   	'command' => 'charging'
                    // );
                    ksort($dataPost);
                    $sign = $partner_key;
                    foreach ($dataPost as $item) {
                        $sign .= $item;
                    }
                    $mysign = md5($sign);
                    $dataPost['amount'] = $amount;
                    $dataPost['sign'] = $mysign;

                    $data = http_build_query($dataPost);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://naptudong.com/chargingws/v2");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    curl_setopt($ch, CURLOPT_REFERER, $actual_link);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    $obj = json_decode($result);
                    //$post = curl_post('http://api.naptudong.com/chargingws/v2', $dataPost);
                    //$obj = json_decode($post);

                    if ($obj->status == 99) {
                        $now = getdate();
                        $data_insert = [
                            'username' => $iduser,
                            'seri' => $TxtSeri,
                            'code' => $TxtMaThe,
                            'name' => $name,
                            'menhgia' => $menhgia,
                            'type_card' => $TxtCard,
                            'count_card' => $vnd,
                            'time' => date("Y-m-d H:i:s")
                        ];
                        $insert = $this->Account->insert($data_insert, 'history_card'); // lịch sử
                        echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => " Thẻ đang được xử lý ( thời gian xử lý 2 đến 5 phút ), Quý khách sẽ được cộng tiền ngay khi thẻ xử lý xong. Trân trọng !."));
                    } else if ($obj->status == 3) {
                        echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => ' Sai seri hoặc mã thẻ, vui lòng nhập lại'));
                    } else {
                        echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => $obj->message));
                    }
                } else {
                    $err = isset($msg) ? $msg : 'Thẻ bị trùng, vui lòng nhập thẻ khác';
                    echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => 'Thẻ bị trùng, vui lòng nhập thẻ khác'));
                }
            }
        } else {
            echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => "Bạn chưa đăng nhập"));
        }
    }
    public function callback()
    {
        $partner_id = '3437753661'; //API key, lấy từ website thesieure.vn thay vào trong cặp dấu '
        $partner_key = 'b4a4eef850f4cb9c85e9a3a3a54ec154'; //API secret lấy từ website thesieure.vn thay vào trong cặp dấu '
        if (isset($_POST)) {

            if ($this->input->post('callback_sign') != '') {

                /// Đoạn này lưu log lại để test, chạy thực bỏ đoạn này đi nhé

                $myfile = fopen("log.txt", "w") or die("Unable to open file!");
                $txt = $this->input->post('callback_sign') . "|" . $this->input->post('status') . "|" . $this->input->post('message') . "\n";
                fwrite($myfile, $txt);
                fclose($myfile);

                $row = $this->Account->query_sql_row("SELECT * FROM `history_card` WHERE `status` = '1' AND `seri` = '" . $this->input->post('serial') . "' AND `code` = '" . $this->input->post('code') . "'");

                $callback_sign = md5($partner_key . $this->input->post('code') . $this->input->post('serial'));
                if ($this->input->post('callback_sign') == $callback_sign) { //Xác thực API, tránh kẻ lạ gửi dữ liệu ảo.
                    if ($this->input->post('status') != '') {

                        if ($this->input->post('status') == 1) {

                            $luotquay = 0;
                            if ($this->input->post('value') >= 20000) {
                                $luotquay = 1;
                            }
                            $point_add = $this->input->post('value') / 1000;
                            $where_u = [
                                'username' => $row['username']
                            ];
                            $update_1 = $this->Account->update_set($where_u, 'cash', $this->input->post('value'), '+', 'accounts'); // cộng tiền
                            $update_2 = $this->Account->update_set($where_u, 'luotquay_free', $luotquay, '+', 'accounts'); // lượt quay
                            $update_3 = $this->Account->update_set($where_u, 'point', $point_add, '+', 'accounts'); // point
                            $where_update = [
                                'id' => $row['id']
                            ];
                            $data_update = [
                                'status' => 5
                            ];
                            $update = $this->Account->update($where_update, $data_update, 'history_card'); // ĐÃ CỘNG TIỀN
                            //1 ==> thẻ đúng



                        } else {
                            $where_update = [
                                'id' => $row['id']
                            ];
                            $data_update = [
                                'status' => 2
                            ];
                            $update = $this->Account->update($where_update, $data_update, 'history_card'); // thẻ sai
                        }
                    }
                }
            }
        }
    }
    public function history_card()
    {
        if (check_login()) {
            $iduser = $_SESSION['user']['username'];
            $page = $this->input->post("page2");
            $total_record = $this->Account->query_sql_num("SELECT * FROM history_card WHERE username = '{$iduser}' LIMIT 1");
            // config phân trang
            $config = array(
                "current_page" => $page,
                "total_record" => $total_record,
                "limit" => "10",
                "range" => "5",
                "link_first" => "",
                "link_full" => "?page2={page}"
            );

            $paging = new Pagination;
            $paging->init($config);
            $sql_get_list_buy = "SELECT * FROM `history_card` WHERE username = '{$iduser}' ORDER BY `time` DESC LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]}";
            // Nếu có 
            if ($total_record > 0) {
                $html = '<table class="table_cash">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Loại thẻ</th>
                            <th>Mã thẻ</th>
                            <th>Tình Trạng Thẻ</th>
                            <th>Mệnh giá</th>
                        </tr>
                    </thead>
                    <tbody>';
                $i = 1;

                foreach ($this->Account->query_sql($sql_get_list_buy) as $key => $data_card) {
                    if ($data_card['status'] == 5) {
                        $status_text = 'Đã cộng tiền';
                    } elseif ($data_card['status'] == 2) {
                        $status_text = 'Sai mã thẻ hoặc seri, vui lòng kiểm tra lại';
                    } else {
                        $status_text = 'Vui lòng đợi 2 đến 5 phú để xử lý thẻ';
                    }
                    $html .= '<tr>
                                <td class="text-center">' . $i . '</td>
                                <td>' . $data_card['type_card'] . '</td>
                                <td>' . $data_card['code'] . '</td>
                                <td>' . $status_text . '</td>
                                <td>' . number_format($data_card['menhgia']) . 'đ</td>
                                </tr>';



                    $i++;
                }
                $html .= '</tbody>

                </table>';
                $html .= $paging->html_card(); // page
            } else {
                $html = '<p class="content-mini content-mini-full bg-info text-white">Bạn chưa có giao dịch nào</p>';
            }
        }
        echo $html;
    }
    public function blog()
    {
        $page = $this->input->post("page");
        $total_record = $this->Account->query_sql_num("SELECT * FROM baiviet  ORDER BY id DESC ");
        // config phân trang
        $config = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "8",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config);
        $sql = "SELECT * FROM baiviet   ORDER BY id DESC LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]}";

        $blog = $this->Account->query_sql($sql);
        $html = '';
        foreach ($blog as $key => $val) {

            $chuyenmuc = $this->Account->query_sql_row("SELECT * FROM chuyenmuc  WHERE id = {$val['chuyenmuc']} ");
            if ($val['image'] != null) {
                $image = $val['image'];
            } else {
                $image = $chuyenmuc['image'];
            }

            $html .= '<a href="/' . $val['alias'] . '/" target="blank">
            <div class="box_blog">
                <div class="thumb_log">
                    <img src="' . site_main() . ltrim($image, "/") . '" alt="blog-img">
                </div>
                <div class="title_blog">
                    <p>' . $val['title'] . '</p>
                </div>
                <div class="des_blog">
                    <p>' . $val['meta_title'] . '</p>
                </div>
            </div>
        </a>';
        }
        $html .= $paging->html_blog(); // page
        echo $html;
    }
    public function load_chuyenmuc()
    {
        $page = $this->input->post("page");
        $uri = $this->input->post("uri_tam");

        $sql_uri = "SELECT id,image FROM chuyenmuc WHERE alias = '$uri'";
        $get_id = $this->Account->query_sql_row($sql_uri);
        $id = $get_id['id'];
        $total_record = $this->Account->query_sql_num("SELECT * FROM baiviet  WHERE chuyenmuc = $id  ORDER BY id DESC ");
        // config phân trang
        $config = array(
            "current_page" => $page,
            "total_record" => $total_record,
            "limit" => "8",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );
        $paging = new Pagination;
        $paging->init($config);
        $sql = "SELECT * FROM baiviet WHERE chuyenmuc = $id ORDER BY id DESC LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]}";
        $html = '';
        foreach ($this->Account->query_sql($sql) as $key => $val) {
            if ($val['image'] != null) {
                $image = $val['image'];
            } else {
                $image = $get_id['image'];
            }
            $html .= '<a href="/' . $val['alias'] . '/" target="blank">
            <div class="box_blog">
                <div class="thumb_log">
                    <img src="' . site_main() . ltrim($image, "/") . '" alt="blog-img">
                </div>
                <div class="title_blog">
                    <p>' . $val['title'] . '</p>
                </div>
                <div class="des_blog">
                    <p>' . $val['meta_title'] . '</p>
                </div>
            </div>
        </a>';
        }

        $html .= $paging->html_blog(); // page
        echo $html;
    }
    public function doi_zen()
    {
        if (check_login()) {
            $zen = $this->input->post('zen');
            $cash = $zen * 100;
            $date = time();
            if ($zen >= 1) {
                if ($cash > $_SESSION['user']['cash']) {
                    $response = [
                        'status' => 0,
                        'mess' => 'Tài khoản của bạn không đủ để thực hiện. Vui lòng nạp thêm tiền để thực hiện thao tác này!',
                    ];
                } else {
                    $where_u = [
                        'id' => $_SESSION['user']['id']
                    ];
                    $update_u = $this->Account->update_set($where_u, 'cash', $cash, '-', 'accounts'); //  point
                    if (($_SESSION['user']['cash'] - $cash) >= 0) {
                        $update_zen = $this->Account->update_set($where_u, 'zen', $zen, '+', 'accounts'); // Cộng zen
                        $data_insert = [
                            'id_user' => $_SESSION['user']['id'],
                            'zen' => $zen,
                            'created_at' => time()
                        ];
                        $insert = $this->Account->insert($data_insert, 'change_zen');
                        $response = [
                            'status' => 1,
                            'mess' => 'Đổi Zen thành công!',
                        ];
                    } else {
                        $response = [
                            'status' => 0,
                            'mess' => 'Tài khoản của bạn không đủ để thực hiện. Vui lòng nạp thêm tiền để thực hiện thao tác này!',
                        ];
                    }
                }
            } else {
                $response = [
                    'status' => 2,
                    'mess' => 'Số Zen không hợp lệ!',
                ];
            }
            echo json_encode($response);
        } else {
            redirect('/');
        }
    }
    public function ma_gioi_thieu()
    {
        if (check_login()) {
            $code = $this->input->post('code');
            $id = $_SESSION['user']['id'];
            if ($code == $_SESSION['user']['username']) {
                $response = [
                    'status' => 0,
                    'mess' => 'Bạn không được nhập mã giới thiệu của chính bạn!. Vui lòng mời bạn bè đăng ký tài khoản tại Zendo Shop để có mã giới thiệu!',
                ];
            } else {
                $check_2 = "SELECT * FROM code_introduce  WHERE id_user = $id AND type = 0";
                $where_check = [
                    'id_user' => $id,
                    'type' => 0
                ];
                $count_code = $this->Account->check_data($where_check, 'code_introduce');
                if ($count_code < 4) {
                    // check người nhập đã nhập mã này chưa
                    $where_code = [
                        'code_introduce' => $code,
                        'id_user' => $id
                    ];
                    $count_in_code = $this->Account->check_data($where_code, 'code_introduce');
                    // check mã giới thiệu được dùng bao nhiêu lần rồi 
                    $where_code_2 = [
                        'code_introduce' => $code
                    ];
                    $count_in_code_2 = $this->Account->check_data($where_code_2, 'code_introduce');
                    //
                    $where_check_code = [
                        'username' => $code,
                        'active' => 1
                    ];
                    if (this_source() == 'zendo') {
                        $where_check_code['source IS NOT NULL'] = null;
                    } else {
                        $where_check_code['source'] = this_source();
                    }
                    $check_code = $this->Account->check_data($where_check_code, 'accounts');
                    if ($count_in_code == 0 && $count_in_code_2 <= 3 && $check_code > 0) {
                        $data_insert = [
                            'id_user' => $id,
                            'code_introduce' => $code,
                            'created_at' => time(),
                            'type' => 1
                        ];
                        $insert_code = $this->Account->insert($data_insert, 'code_introduce');
                        $where_u = [
                            'id' => $id
                        ];
                        $update_u = $this->Account->update_set($where_u, 'luotquay_free', 1, '+', 'accounts'); // lượt quay
                        $update_point_u = $this->Account->update_set($where_u, 'point', 10, '+', 'accounts'); //  point
                        $where_y = [
                            'username' => $code
                        ];
                        $update_point_y = $this->Account->update_set($where_y, 'point', 10, '+', 'accounts'); // cộng point cho người được nhập
                        $response = [
                            'status' => 1,
                            'mess' => 'Bạn được cộng 1 lượt quay vòng quay nhiệm vụ',
                        ];
                    } else {
                        $data_insert = [
                            'id_user' => $id,
                            'code_introduce' => $code,
                            'created_at' => time(),
                            'type' => 0
                        ];
                        $insert_code = $this->Account->insert($data_insert, 'code_introduce');
                        $response = [
                            'status' => 2,
                            'mess' => 'Mã giới thiệu sai. Bạn còn ' . (4 - $count_code) . ' lần nhập sai!',
                        ];
                    }
                } elseif ($count_code == 4) {
                    $sql_check = "SELECT * FROM code_introduce  WHERE code_introduce ='$code'";
                    $count_in_code = $this->Account->query_sql_num($sql_check);
                    $sql_check_code = "SELECT * FROM accounts  WHERE username ='$code'";
                    $check_code = $this->Account->query_sql_num($sql_check_code);
                    if ($count_in_code == 0  && $check_code > 0) {
                        $data_insert = [
                            'id_user' => $id,
                            'code_introduce' => $code,
                            'created_at' => time(),
                            'type' => 1
                        ];
                        $insert_code = $this->Account->insert($data_insert, 'code_introduce');
                        $where_u = [
                            'id' => $id
                        ];
                        $update_u = $this->Account->update_set($where_u, 'luotquay_free', 1, '+', 'accounts'); // lượt quay
                        $update_point_u = $this->Account->update_set($where_u, 'point', 10, '+', 'accounts'); //  point
                        $where_y = [
                            'username' => $code
                        ];
                        $update_point_y = $this->Account->update_set($where_y, 'point', 10, '+', 'accounts'); // cộng point cho người được nhập
                        $response = [
                            'status' => 1,
                            'mess' => 'Bạn được cộng 1 lượt quay vòng quay nhiệm vụ',
                        ];
                    } else {
                        $data_insert = [
                            'id_user' => $id,
                            'code_introduce' => $code,
                            'created_at' => time(),
                            'type' => 0
                        ];
                        $insert_code = $this->Account->insert($data_insert, 'code_introduce');
                        $response = [
                            'status' => 2,
                            'mess' => 'Mã giới thiệu sai. Tính năng này đã bị khóa trên tài khoản cửa bạn. Liên hệ Fanpage để mở khóa!',
                        ];
                    }
                } else {
                    $response = [
                        'status' => 3,
                        'mess' => 'Tính năng này đã bị khóa trên tài khoản của bạn. Liên hệ Fanpage để mở khóa!',
                    ];
                }
            }
            echo json_encode($response);
        } else {
            redirect('/');
        }
    }
    public function doi_mk()
    {
        if (check_login()) {
            $oldpass = md5($this->input->post('oldpass'));
            $newpass = md5($this->input->post('newpass'));
            $id = $_SESSION['user']['id'];
            if ($oldpass == $_SESSION['user']['password']) {
                $where_update = [
                    'id' => $id
                ];
                $data_update = [
                    'password' => $newpass
                ];
                $update = $this->Account->update($where_update, $data_update, 'accounts'); // đổi mật khẩu
                $response = [
                    'status' => 1,
                    'mess' => 'Cập nhật thành công!',
                ];
            } else {
                $response = [
                    'status' => 0,
                    'mess' => 'Sai mật khẩu',
                ];
            }
            echo json_encode($response);
        } else {
            redirect('/');
        }
    }
    public function doi_thong_tin()
    {
        if (check_login()) {
            $id = $_SESSION['user']['id'];
            $fullname = $this->input->post('fullname');
            $email = $this->input->post('email');
            $phonenumber = $this->input->post('phonenumber');
            $birthday = strtotime($this->input->post('birthday'));
            $address = $this->input->post('address');
            $sex = $this->input->post('sex');

            // $url_img = $_SESSION['user']['avatar'];

            // if (isset($_FILES['file'])   && $_FILES['file']['name'] !== "") {
            //     $path = '../user/'; // patch lưu file
            //     $tmp_name = $_FILES["file"]["tmp_name"];
            //     $name = $names = str_replace('php', '', $_FILES["file"]["name"]);
            //     $temp            = explode('.', $name);
            //     if (count($temp) > 2) {
            //         $response = [
            //             'status' => 0,
            //             'mess' => 'Vui lòng đổi lại tên ảnh',
            //             'url' => $url_img
            //         ];
            //     } else {
            //         $name = 'user_' . $id . '.jpg';
            //         resize_image_upload($_FILES["file"]["tmp_name"], $names, $name, 200, 200, 100, $type = "index", $path);
            //         $url_img = 'assets/user/' . $name;
            //     }
            // }
            $where_update = [
                'id' => $id
            ];
            $data_update = [
                'name' => $fullname,
                'email' => $email,
                'phone' => $phonenumber,
                'birthday' => $birthday,
                'address' => $address,
                'sex' => $sex
            ];
            $update = $this->Account->update($where_update, $data_update, 'accounts'); // đổi mật khẩu
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!'
                // 'url' => $url_img
            ];
            echo json_encode($response);
        } else {
            redirect('/');
        }
    }
    public function ls_mua()
    {
        if (check_login()) {

            $iduser = $_SESSION['user']['username'];
            $page = $this->input->post("page");

            // ECHO "SELECT * FROM history_buy WHERE username = '{$iduser}' AND type = 0 LIMIT 1";die;
            $total_record = $this->Account->query_sql_num("SELECT * FROM history_buy WHERE username = '{$iduser}' AND type = 0 LIMIT 1");
            // config phân trang
            $config = array(
                "current_page" => $page,
                "total_record" => $total_record,
                "limit" => "10",
                "range" => "5",
                "link_first" => "",
                "link_full" => "?page={page}"
            );

            $paging = new Pagination;
            $paging->init($config);
            $sql_get_list_buy = "SELECT * FROM `history_buy` WHERE username = '{$iduser}' AND type = 0 ORDER BY `time` DESC LIMIT {$paging->getConfig()["start"]}, {$paging->getConfig()["limit"]}";

            // Nếu có 
            if ($total_record) {
                $html = '<table class="table_cash">
        <thead>
            <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th>Mã tài khoản</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Giá tiền</th>
                <th>Thời gian</th>
                <th>Mã 2fa</th>
                <th>Token</th>
            </tr>
        </thead>
        <tbody>';
                $i = 1;
                foreach ($this->Account->query_sql($sql_get_list_buy) as $key => $data_buy) {
                    $info = $this->Account->query_sql_row("SELECT * FROM posts WHERE id_post = '" . $data_buy['id_post'] . "' LIMIT 1");
                    if ($info['password'] == 'admin') {
                        $text = $text2 = 'Liên hệ admin để nhận acc';
                    } else {
                        $text = $info['username'];
                        $text2 = $info['password'];
                    }
                    $html .= '<tr>
                    <td class="text-center">' . $i . '</td>
                    <td>' . $info['type_account'] . '#' . $data_buy['id_post'] . '</td>
                    <td>' . $text . '</td>
                    <td>' . $text2 . '</td>
                    <td>' . number_format($data_buy['price'], 0, '.', '.') . 'đ</td>
                    <td>' . $data_buy['time'] . '</td>
                    <td>' . $info['2fa'] . '</td>
                    <td>' . $info['token'] . '</td>
                </tr>';



                    $i++;
                }
                $html .= '</tbody>

     </table>';

                $html .= $paging->html_buy(); // page
            } else {
                $html = '<p class="content-mini content-mini-full bg-info text-white">Bạn chưa có giao dịch nào</p>';
            }
            echo $html;
        }
    }
    public function them_gio_hang()
    {
        if (check_login()) {
            $id = $this->input->post('id');
            $id_user = $_SESSION['user']['id'];
            $sql_id = "SELECT id_account FROM giohang WHERE id_account = $id AND id_user = $id_user";
            $row = $this->Account->query_sql_num($sql_id);
            if (is_user_seller()) {
                echo json_encode(array('status' => "3", 'title' => "Thất bại", 'message' => "Tài khoản của bạn là tài khoản bán acc. Vui lòng đăng nhập tài khoản mua acc để tiếp tục!"));
            } else {
                if ($id_user != "") {
                    if ($row <= 0) {
                        $data_insert = [
                            'id_user' => $id_user,
                            'id_account' => $id,
                            'created_at' => time(),
                            'updated_at' => time()
                        ];
                        $insert = $this->Account->insert($data_insert, 'giohang');

                        echo json_encode(array('status' => "1", 'title' => "Thành công", 'message' => "Tài khoản này đã được thêm vào giỏ hàng!"));
                    } else {
                        echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Tài khoản này đã có trong giỏ hàng!"));
                    }
                } else {
                    echo json_encode(array('status' => "2", 'title' => "Thất bại", 'message' => "Bạn chưa đăng nhập!"));
                }
            }
        } else {
            echo json_encode(array('status' => "2", 'title' => "Thất bại", 'message' => "Bạn chưa đăng nhập!"));
        }
    }
    public function xoa_gio_hang()
    {
        $id_cart = $id = $this->input->post('id_cart');
        $where = [
            'id' => $id_cart
        ];
        $delete = $this->Account->delete($where, 'giohang');
        echo json_encode(array('status' => "1", 'title' => "Thành công", 'message' => "Tài khoản đã bị xóa khỏi giỏ hàng!"));
    }
    public function show_voucher()
    {
        if (check_login()) {
            $id_user = $_SESSION['user']['id'];
            $last_price = $this->input->post('last_price');

            // Đổ ra voucher
            $sql_his_gift = "SELECT history_gift.*, gift.value, gift.value_use, gift.image, gift.name FROM history_gift INNER JOIN gift ON history_gift.id_gift = gift.id WHERE id_user = $id_user AND gift.type_item = 2 AND gift.value_use <= '$last_price' AND history_gift.type = 0";
            $his_gift = $this->Account->query_sql($sql_his_gift);
            $html = '';
            foreach ($his_gift as $key => $val) {
                $html .= '<div class="box_text_noti_gif">
            <input type="checkbox" class="check_voucher"  onclick="check_voucher(this)" name="" id="">
            <div class="box_voucher" style="width:100%  !important" data-id="' . $val['id'] . '" data-name="' . $val['name'] . '" data-value="' . $val['value'] . '" onclick="choose_voucher(this)">
                <img class="img_voucher_3" src="/' . $val['image'] . '" alt="mã giảm giá">
                <p>' . $val['name'] . '</p>
            </div>
        </div>';
            };

            echo json_encode(array('status' => "1", 'html' => $html));
        } else {
            echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Bạn chưa đăng nhập!"));
        }
    }
    public function nhap_voucher()
    {
        if (check_login()) {
            $discount = $this->input->post('discount');
            $sql_discount = "SELECT * FROM discount WHERE name LIKE '$discount' AND type_discount = 0";
            $info_discount = $this->Account->query_sql_row($sql_discount);
            $text_discount = $info_discount['name'];
            $amount = $info_discount['amount'];

            if ($amount > 0 || $amount == "") {
                if ($text_discount == $discount) {
                    echo json_encode(array('status' => "1", 'title' => "Thành công", 'message' => "Áp dụng mã thành công", 'val_use' => $info_discount['value_use'], 'val' => $info_discount['value']));
                } else {
                    echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Mã giảm giá không đúng. Vui lòng kiểm tra lại!"));
                }
            } else {
                echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Mã giảm giá đã hết!"));
            }
        } else {
            echo json_encode(array('status' => "2", 'title' => "Thất bại", 'message' => "Bạn chưa đăng nhập!"));
        }
    }
    public function mua_acc()
    {
        if (check_login() && !is_user_seller()) {
            $id_account = $this->input->post('id_account');
            $discount = $this->input->post('discount');
            $id_voucher = $this->input->post('id_voucher');
            $type = $this->input->post('type');
            $thanhtoan = $this->input->post('thanhtoan');
            if ($thanhtoan == 1) {
                $thanhtoan = 1;
                $type_check = $_SESSION['user']['cash'];
                $type_set = 'cash';
            } elseif ($thanhtoan == 2) {
                $thanhtoan = 100;
                $type_check = $_SESSION['user']['zen'];
                $type_set = 'zen';
            }
            $arr_id_account = explode(',', $id_account);
            $val_check = 0;
            $last_price = 0;
            $check_discount = 1;
            $val_use_discount = 0;
            $val_discount = 0;
            $text_discount = '';

            foreach ($arr_id_account as $key => $val) {
                $sql_check_data = "SELECT * FROM posts WHERE id_post = '{$val}' AND `status` = '0' LIMIT 1";
                $info_check = $this->Account->query_sql_num($sql_check_data);
                $info_price = $this->Account->query_sql_row($sql_check_data);
                $last_price  += ($info_price['price'] / $thanhtoan);
                if ($info_check <= 0) {
                    $val_check = 1;
                }
            }
            // giảm giá theo đặc quyền vip
            if ($_SESSION['user']['point'] >= 100 && $_SESSION['user']['point'] < 500) {
                $last_price = $last_price - ($last_price / 100);
            } elseif ($_SESSION['user']['point'] >= 500 && $_SESSION['user']['point'] < 1000) {
                $last_price = $last_price - ($last_price * 0.02);
            } elseif ($_SESSION['user']['point'] >= 1000 && $_SESSION['user']['point'] < 2000) {
                $last_price = $last_price - ($last_price * 0.03);
            } elseif ($_SESSION['user']['point'] >= 2000 && $_SESSION['user']['point'] < 3000) {
                $last_price = $last_price - ($last_price * 0.04);
            } elseif ($_SESSION['user']['point'] >= 3000 && $_SESSION['user']['point'] < 4500) {
                $last_price = $last_price - ($last_price * 0.05);
            } elseif ($_SESSION['user']['point'] >= 4500 && $_SESSION['user']['point'] < 6000) {
                $last_price = $last_price - ($last_price * 0.06);
            } elseif ($_SESSION['user']['point'] >= 6000 && $_SESSION['user']['point'] < 8000) {
                $last_price = $last_price - ($last_price * 0.07);
            } elseif ($_SESSION['user']['point'] >= 8000 && $_SESSION['user']['point'] < 10000) {
                $last_price = $last_price - ($last_price * 0.08);
            } elseif ($_SESSION['user']['point'] >= 10000) {
                $last_price = $last_price - ($last_price * 0.1);
            }


            if ($type == 1) {
                $id_voucher = "";
                if ($discount != '') {
                    $sql_discount = "SELECT * FROM discount WHERE name LIKE '$discount' AND type_discount = 0";
                    $info_discount = $this->Account->query_sql_row($sql_discount);
                    $val_discount = ($info_discount['value'] / $thanhtoan);
                    $val_use_discount =  ($info_discount['value_use'] / $thanhtoan);
                    $check_discount = count(($info_discount));
                    $text_discount = $info_discount['name'];
                    $amount = $info_discount['amount'];
                }

                if ($check_discount <= 0 ||  $text_discount != $discount) {
                    echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Mã giảm giá không đúng. Vui lòng kiểm tra lại!"));
                } else {

                    if ($val_check == 1) {
                        echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Có thao tác bất thường. Vui lòng kiểm tra lại!"));
                    } else {
                        if ($val_use_discount <= $last_price) {
                            $last_price = $last_price - $val_discount;
                            if ($amount != "" && $amount > 0) {
                                $last_amount = $amount - 1;
                            }
                        } else {
                            echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Mã giảm giá áp dụng cho đơn hàng từ " . number_format($val_use_discount) . " VNĐ"));
                        }
                    }
                }
            } else if ($type == 2) {
                $discount = "";
                if ($id_voucher != '') {
                    $sql_voucher = "SELECT history_gift.*, gift.value, gift.value_use FROM history_gift INNER JOIN gift ON history_gift.id_gift = gift.id WHERE history_gift.id = '$id_voucher' AND history_gift.type = 0";
                    $info_voucher = $this->Account->query_sql_row($sql_voucher);
                    $val_voucher = ($info_voucher['value'] / $thanhtoan);
                    $val_use_voucher =  ($info_voucher['value_use'] / $thanhtoan);
                    $check_voucher = count(($info_voucher));
                }
                if ($check_voucher <= 0) {
                    echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Voucher không tồn tại!"));
                } else {

                    if ($val_check == 1) {
                        echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Có thao tác bất thường. Vui lòng kiểm tra lại!"));
                    } else {
                        if ($val_use_voucher <= $last_price) {
                            $last_price = $last_price - $val_voucher;
                        } else {
                            echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Mã giảm giá áp dụng cho đơn hàng từ " . number_format($val_use_voucher) . " VNĐ"));
                        }
                    }
                }
            } else {
            }

            if ($last_price > $type_check) {
                echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Tài khoản không đủ để thực hiện chức năng này!"));
            } else if ($last_price == 0) {
                echo json_encode(array('status' => "0", 'title' => "Thất bại", 'message' => "Bạn chưa chọn tài khoản!"));
            } else {
                $where_u = [
                    'username' => $_SESSION['user']['username']
                ];
                $update_u = $this->Account->update_set($where_u, $type_set, $last_price, '-', 'accounts'); // trừ tiền

                foreach ($arr_id_account as $key => $val) {
                    $sql_get_data = "SELECT * FROM posts WHERE id_post = '{$val}' AND `status` = '0' LIMIT 1";
                    $info = $this->Account->query_sql_row($sql_get_data);
                    $price = $info['price'];
                    if ($info['user_id'] > 0) { // nếu acc là acc ng bán
                        $where_user = [
                            'id' => $info['user_id']
                        ];
                        $price_user = (int)$price * 0.75;
                        $update_user = $this->Account->update_set($where_user, 'cash', $price_user, '+', 'accounts'); // cộng tiền cho ng bán
                    }
                    if ($last_price >= 500000) {
                        $update_luot_quay = $this->Account->update_set($where_u, 'luotquay9k', 5, '+', 'accounts'); // tặng lượt quay
                    }
                    $where_update_acc = [
                        'id_post' => $val
                    ];
                    $data_update_acc = [
                        'status' => 1
                    ];
                    $update_acc = $this->Account->update($where_update_acc, $data_update_acc, 'posts'); //  status
                    $data_insert_his = [
                        'username' => $_SESSION['user']['username'],
                        'id_post' => $val,
                        'price' => $price,
                        'time' => date("Y-m-d H:i:s")
                    ];
                    $insert_his = $this->Account->insert($data_insert_his, 'history_buy'); // lịch sử
                    $where_update_v = [
                        'id' => $id_voucher
                    ];
                    $data_update_v = [
                        'type' => 1
                    ];
                    $update_v = $this->Account->update($where_update_v, $data_update_v, 'history_gift'); // bỏ voucher
                    $where_del = [
                        'id_account' => $val
                    ];
                    $delete = $this->Account->delete($where_del, 'giohang'); // xóa giỏ hàng
                    $where_update_d = [
                        'name LIKE' => $discount,
                        'type_discount' => 0
                    ];
                    if ($type == 1) {
                        $data_update_d = [
                            'amount' => $last_amount
                        ];
                        $update_d = $this->Account->update($where_update_d, $data_update_d, 'discount'); // trừ số lượng mã giảm gía 
                    }
                    //xóa ảnh
                    $arr_delete = array();
                    $avatar = glob("assets/files/thumb/" . $val . ".*");
                    if ($avatar != null) {
                        $arr_delete[] = $avatar[0];
                        $gem = glob("assets/files/gem/" . $val . "-*");
                        foreach ($gem as $link_gem) {
                            $arr_delete[] = $link_gem;
                        }
                    }
                    $post = glob("assets/files/post/" . $val . "-*");
                    if ($info['user_id'] > 0) {
                        $post = glob("assets/files/post_tmdt/" . $val . "-*");
                    }
                    if ($post != null) {
                        foreach ($post as $link_post) {
                            $arr_delete[] = $link_post;
                        }
                        foreach ($arr_delete as $link) {
                            @unlink($link);
                        }
                    }
                }
                echo json_encode(array('status' => "success", 'link' => "/lich-su-mua-hang/", 'title' => "Thành công", 'message' => "Giao dịch thành công"));
            }
        } else {
            echo json_encode(array('status' => "2",  'message' => "Tài khoản của bạn là tài khoản bán acc. Vui lòng đăng nhập tài khoản mua acc để tiếp tục!"));
        }
    }
    public function sitemap()
    {
        if ($_GET['type'] == 'home') {
            $sql = "SELECT * FROM sitemap";
            $sitemap = $this->Account->query_sql($sql);
            $doc = new DOMDocument("1.0", "utf-8");
            $doc->formatOutput = true;
            $doc->appendChild($doc->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="https://zendo.vn/assets/css/sanacc/css_sitemap.xsl"'));
            $r = $doc->createElement("sitemapindex");
            $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
            $doc->appendChild($r);

            foreach ($sitemap as $key => $val) {
                $url = $doc->createElement("sitemap");
                $name = $doc->createElement("loc");
                $name->appendChild(
                    $doc->createTextNode('https://zendo.vn/' . $val['name'])
                );
                $url->appendChild($name);
                $lastmod = $doc->createElement("lastmod");
                $lastmod->appendChild(
                    $doc->createTextNode($val['time'] . 'T17:28:31+07:00')
                );
                $url->appendChild($lastmod);
                $r->appendChild($url);
            }
            $doc->save("sitemap.xml");
            if (isset($_COOKIE['url_sitemap']) && $_COOKIE['url_sitemap'] != "") {
                redirect($_COOKIE['url_sitemap']); // Trở về trang index
            }
        } else if ($_GET['type'] == 'blog') {

            $sql = "SELECT id,alias,updated_at FROM baiviet ORDER BY id ASC";
            $blog = $this->Account->query_sql($sql);
            $count = count($blog);
            $page = ceil($count / 200);
            for ($i = 1; $i <= $page; $i++) {
                $check_page = ($i - 1) * 200;
                $sql_limit = "SELECT id,alias,updated_at FROM baiviet ORDER BY id ASC LIMIT {$check_page}, 200";
                $blog_limit = $this->Account->query_sql($sql_limit);
                $doc = new DOMDocument("1.0", "utf-8");
                $doc->formatOutput = true;
                $r = $doc->createElement("urlset");
                $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
                $doc->appendChild($r);
                foreach ($blog_limit as $val) {
                    $url = $doc->createElement("url");
                    $name = $doc->createElement("loc");
                    $name->appendChild(
                        $doc->createTextNode('https://zendo.vn/' . $val['alias'] . '/')
                    );
                    $url->appendChild($name);
                    $changefreq = $doc->createElement("changefreq");
                    $changefreq->appendChild(
                        $doc->createTextNode('daily')
                    );
                    $url->appendChild($changefreq);
                    $lastmod = $doc->createElement("lastmod");
                    $lastmod->appendChild(
                        $doc->createTextNode(date('Y-m-d', $val['updated_at']) . 'T07:24:06+00:00')
                    );
                    $url->appendChild($lastmod);
                    $priority = $doc->createElement("priority");
                    $priority->appendChild(
                        $doc->createTextNode('0.8')
                    );
                    $url->appendChild($priority);
                    $r->appendChild($url);
                }
                $name = ($i == 1) ? '' : $i - 1;
                $name_file = 'blog' . $name . ".xml";
                $date = date('Y-m-d', time());
                if ($i >= 2) {
                    $sql_check = "SELECT * FROM sitemap  WHERE name = '$name_file' ";
                    $row = $this->Account->query_sql_num($sql_check);
                    if ($row > 0) {

                        $where_update = [
                            'name' => $name_file
                        ];
                        $data_update = [
                            'time' => time()
                        ];
                        $update_free = $this->Account->update($where_update, $data_update, 'sitemap');
                    } else {
                        $data_insert = [
                            'name' => $name_file,
                            'time' => time()
                        ];
                        $insert = $this->Account->insert($data_insert, 'sitemap');
                    }
                }
                $doc->save('blog' . $name . ".xml");
            }
            redirect('/sitemap/?type=home'); // Trở về trang index
        } else if ($_GET['type'] == 'account') {
            $sql = "SELECT id_post,date_posted FROM posts ORDER BY id_post ASC ";
            $blog = $this->Account->query_sql($sql);
            $count = count($blog);
            $page = ceil($count / 200);
            for ($i = 1; $i <= $page; $i++) {
                $check_page = ($i - 1) * 200;
                $sql_limit = "SELECT id_post,date_posted FROM posts ORDER BY id_post ASC LIMIT {$check_page}, 200";
                $blog_limit = $this->Account->query_sql($sql_limit);
                $doc = new DOMDocument("1.0", "utf-8");
                $doc->formatOutput = true;
                $r = $doc->createElement("urlset");
                $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
                $doc->appendChild($r);
                foreach ($blog_limit as $val) {
                    $url = $doc->createElement("url");
                    $name = $doc->createElement("loc");
                    $name->appendChild(
                        $doc->createTextNode('https://zendo.vn/tai-khoan-' . $val['id_post'] . '/')
                    );
                    $url->appendChild($name);
                    $changefreq = $doc->createElement("changefreq");
                    $changefreq->appendChild(
                        $doc->createTextNode('daily')
                    );
                    $url->appendChild($changefreq);
                    $lastmod = $doc->createElement("lastmod");
                    $lastmod->appendChild(
                        $doc->createTextNode(substr($val['date_posted'], 0, 10) . 'T07:24:06+00:00')
                    );
                    $url->appendChild($lastmod);
                    $priority = $doc->createElement("priority");
                    $priority->appendChild(
                        $doc->createTextNode('0.5')
                    );
                    $url->appendChild($priority);
                    $r->appendChild($url);
                }
                $name = ($i == 1) ? '' : $i - 1;
                $name_file = 'account' . $name . ".xml";
                $date = date('Y-m-d', time());
                if ($i >= 2) {
                    $sql_check = "SELECT * FROM sitemap  WHERE name = '$name_file' ";
                    $row = $this->Account->query_sql_num($sql_check);
                    if ($row > 0) {

                        $where_update = [
                            'name' => $name_file
                        ];
                        $data_update = [
                            'time' => time()
                        ];
                        $update_free = $this->Account->update($where_update, $data_update, 'sitemap');
                    } else {
                        $data_insert = [
                            'name' => $name_file,
                            'time' => time()
                        ];
                        $insert = $this->Account->insert($data_insert, 'sitemap');
                    }
                }
                $doc->save('account' . $name . ".xml");
            }
            redirect('/sitemap/?type=home'); // Trở về trang index
        } else if ($_GET['type'] == 'chuyenmuc') {
            $sql = "SELECT id,updated_at,alias FROM chuyenmuc ORDER BY updated_at ASC ";
            $chuyenmuc = $this->Account->query_sql($sql);
            $count = count($chuyenmuc);
            $page = ceil($count / 200);
            for ($i = 1; $i <= $page; $i++) {
                $check_page = ($i - 1) * 200;
                $sql_limit = "SELECT id,updated_at,alias FROM chuyenmuc ORDER BY updated_at ASC LIMIT {$check_page}, 200";
                $blog_limit = $this->Account->query_sql($sql_limit);
                $doc = new DOMDocument("1.0", "utf-8");
                $doc->formatOutput = true;
                $r = $doc->createElement("urlset");
                $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.8");
                $doc->appendChild($r);
                foreach ($blog_limit as $val) {
                    $url = $doc->createElement("url");
                    $name = $doc->createElement("loc");
                    $name->appendChild(
                        $doc->createTextNode('https://zendo.vn/' . $val['alias'])
                    );
                    $url->appendChild($name);
                    $changefreq = $doc->createElement("changefreq");
                    $changefreq->appendChild(
                        $doc->createTextNode('daily')
                    );
                    $url->appendChild($changefreq);
                    $lastmod = $doc->createElement("lastmod");
                    $lastmod->appendChild(
                        $doc->createTextNode(date('Y-m-d', $val['updated_at']) . 'T07:24:06+00:00')
                    );
                    $url->appendChild($lastmod);
                    $priority = $doc->createElement("priority");
                    $priority->appendChild(
                        $doc->createTextNode('0.8')
                    );
                    $url->appendChild($priority);
                    $r->appendChild($url);
                }
                $name = ($i == 1) ? '' : $i - 1;
                $name_file = 'chuyenmuc' . $name . ".xml";
                $date = date('Y-m-d', time());
                if ($i >= 2) {
                    $sql_check = "SELECT * FROM sitemap  WHERE name = '$name_file' ";
                    $row = $this->Account->query_sql_num($sql_check);
                    if ($row > 0) {

                        $where_update = [
                            'name' => $name_file
                        ];
                        $data_update = [
                            'time' => time()
                        ];
                        $update_free = $this->Account->update($where_update, $data_update, 'sitemap');
                    } else {
                        $data_insert = [
                            'name' => $name_file,
                            'time' => time()
                        ];
                        $insert = $this->Account->insert($data_insert, 'sitemap');
                    }
                }
                $doc->save('chuyenmuc' . $name . ".xml");
            }
            redirect('/sitemap/?type=home'); // Trở về trang index
        } else if ($_GET['type'] == 'game') {
            $sql = "SELECT id,updated_at,alias FROM game_bq ORDER BY updated_at ASC ";
            $chuyenmuc = $this->Account->query_sql($sql);
            $count = count($chuyenmuc);
            $page = ceil($count / 200);
            for ($i = 1; $i <= $page; $i++) {
                $check_page = ($i - 1) * 200;
                $sql_limit = "SELECT id,updated_at,alias FROM game_bq ORDER BY updated_at ASC LIMIT {$check_page}, 200";
                $blog_limit = $this->Account->query_sql($sql_limit);
                $doc = new DOMDocument("1.0", "utf-8");
                $doc->formatOutput = true;
                $r = $doc->createElement("urlset");
                $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.8");
                $doc->appendChild($r);
                foreach ($blog_limit as $val) {
                    $url = $doc->createElement("url");
                    $name = $doc->createElement("loc");
                    $name->appendChild(
                        $doc->createTextNode('https://zendo.vn/' . $val['alias'] . '/')
                    );
                    $url->appendChild($name);
                    $changefreq = $doc->createElement("changefreq");
                    $changefreq->appendChild(
                        $doc->createTextNode('daily')
                    );
                    $url->appendChild($changefreq);
                    $lastmod = $doc->createElement("lastmod");
                    $lastmod->appendChild(
                        $doc->createTextNode(date('Y-m-d', $val['updated_at']) . 'T07:24:06+00:00')
                    );
                    $url->appendChild($lastmod);
                    $priority = $doc->createElement("priority");
                    $priority->appendChild(
                        $doc->createTextNode('0.5')
                    );
                    $url->appendChild($priority);
                    $r->appendChild($url);
                }
                $name = ($i == 1) ? '' : $i - 1;
                $name_file = 'game' . $name . ".xml";
                $date = date('Y-m-d', time());
                if ($i >= 2) {
                    $sql_check = "SELECT * FROM sitemap  WHERE name = '$name_file' ";
                    $row = $this->Account->query_sql_num($sql_check);
                    if ($row > 0) {

                        $where_update = [
                            'name' => $name_file
                        ];
                        $data_update = [
                            'time' => time()
                        ];
                        $update_free = $this->Account->update($where_update, $data_update, 'sitemap');
                    } else {
                        $data_insert = [
                            'name' => $name_file,
                            'time' => time()
                        ];
                        $insert = $this->Account->insert($data_insert, 'sitemap');
                    }
                }
                $doc->save('game' . $name . ".xml");
            }
            redirect('/sitemap/?type=home'); // Trở về trang index
        }
    }
}
