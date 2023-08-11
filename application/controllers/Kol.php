<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kol extends CI_Controller

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
        $this->load->library('Globals');
        $this->load->helper('pagination');
        $this->load->library('pagination311');
        $this->load->helper('images');
        $this->load->library('upload');
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $where_g = [
                'id' => $_SESSION['user']['id'],
                'block' => 0
            ];
            $check_user_g = $this->Account->get_detail_user($where_g);
            $_SESSION['user'] = $check_user_g;
            if ($check_user_g['active'] != 1) {
                redirect('/xac-thuc-tai-khoan/');
            }
        }
        // if (!is_playdoul()) {


        //     redirect('/');
        // }

    }

    public function upload_avatar_kol()

    {
        $id = $_SESSION['user']['id'];
        if (!is_dir('upload/kol/' . $id . '/avatar')) {
            mkdir('upload/kol/' . $id . '/avatar', 0755, TRUE);
        }
        if (isset($_FILES['file']) && $_FILES['file'] !== null && $_FILES['file']['name'] !== '') {
            $filedata         = $_FILES['file']['tmp_name'];
            $name_img = $id . '-avatar-' . date("YmdHis", time());
            $imguser = $name_img . '.jpg';
            $config['file_name'] = $imguser;
            $config['upload_path'] = 'upload/kol/' . $id . '/avatar';
            $config['allowed_types'] = 'jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                $status_data_1 = 0;
            } else {
                $imageThumb = new Image($filedata);
                $imageThumb->resize(260, 260, 'crop');
                $imageThumb->save($name_img, $config['upload_path'], 'jpg');
                $where_update = [
                    'id' => $id
                ];
                $data_update = [
                    'avatar' => $config['upload_path'] . '/' . $imguser
                ];
                $update = $this->Account->update($where_update, $data_update, 'accounts');
                if ($update) {
                    $response = [
                        'status' => 1,
                        'mess' => 'Cập nhật thành công!',
                        'image' => '/' . $config['upload_path'] . '/' . $imguser
                    ];
                } else {
                    $response = [
                        'status' => 0,
                    ];
                }
            }
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }

    public function update_info_kol()

    {
        $id = $_SESSION['user']['id'];
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $where_update = [
            'id' => $id
        ];
        $data_update = [
            'name' => $name,
            'phone' => $phone,
        ];
        if (check_login() && $_SESSION['user']['email'] == '') {
            $data_update['email'] = $email;
        }
        if ($sex > 0) {
            $data_update['sex'] = $sex;
        }
        $update = $this->Account->update($where_update, $data_update, 'accounts');
        if ($update) {
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!'
            ];
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }

    public function update_social_kol()

    {
        $id = $_SESSION['user']['id'];
        $facebook = $this->input->post('facebook');
        $youtube = $this->input->post('youtube');
        $tiktok = $this->input->post('tiktok');
        $instagram = $this->input->post('insta');
        $where_update = [
            'id_user' => $id
        ];
        $data_update = [
            'facebook' => $facebook,
            'youtube' => $youtube,
            'tiktok' => $tiktok,
            'instagram' => $instagram,
            'updated_at' => time()
        ];
        $update = $this->Account->update($where_update, $data_update, 'kol');
        if ($update) {
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!'
            ];
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }

    public function update_introduce_kol()

    {
        $id = $_SESSION['user']['id'];
        $des = $this->input->post('des');
        $where_update = [
            'id_user' => $id
        ];
        $data_update = [
            'des' => $des,
            'updated_at' => time()
        ];
        $update = $this->Account->update($where_update, $data_update, 'kol');
        if ($update) {
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!'
            ];
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }

    public function upload_img_kol()

    {
        $id = $_SESSION['user']['id'];
        $list_name         = '';
        $status_data = 1;
        $count_files     = count($_FILES['list_images']['name']);
        if (!is_dir('upload/kol/' . $id . '/' . date("Y", time()) . '/' . date("m", time()) . '/' . date("d", time()))) {
            mkdir('upload/kol/' . $id . '/' . date("Y", time()) . "/" . date("m", time()) . "/" . date("d", time()), 0755, TRUE);
        }
        for ($i = 0; $i < $count_files; $i++) {
            $_FILES['data']['name'] = $_FILES['list_images']['name'][$i];
            $_FILES['data']['type'] = $_FILES['list_images']['type'][$i];
            $_FILES['data']['tmp_name'] = $filedata = $_FILES['list_images']['tmp_name'][$i];
            $_FILES['data']['error'] = $_FILES['list_images']['error'][$i];
            $_FILES['data']['size'] = $_FILES['list_images']['size'][$i];
            $name_img = $id . '-' . date("YmdHis", time()) . rand(10000, 99999);
            $imguser = $name_img . '.jpg';
            $imguser_full = $name_img . '_full';
            $config['file_name'] = $imguser;
            // $config['max_width']            = 768;
            $config['upload_path'] = 'upload/kol/' . $id . '/' . date("Y", time()) . "/" . date("m", time()) . "/" . date("d", time());
            $config['allowed_types'] = 'jpg|png';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $con = '';
            if ($i > 0) {
                $con = ',';
            }
            $list_name .= $con . 'upload/kol/' . $id . '/' . date("Y", time()) . "/" . date("m", time()) . "/" . date("d", time()) . "/" . $imguser;
            if (!$this->upload->do_upload('data')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                $status_data = 0;
                break;
            } else {
                $imageThumb = new Image($filedata);
                $imageThumb->resize(768, 1000);
                $imageThumb->save($imguser_full, $config['upload_path'], 'jpg');
                $imageThumb->resize(260, 260, 'crop');
                $imageThumb->save($name_img, $config['upload_path'], 'jpg');
            }
        }
        if ($status_data == 1) {
            $data_kol = $this->Account->get_by_id(['id_user' => $id], 'kol');
            if ($data_kol['list_img'] != '') {
                $list_img =  $data_kol['list_img'] . ',' . $list_name;
            } else {
                $list_img =  $list_name;
            }
            $arr_img = explode(',', $list_img);
            if (count($arr_img) > 10) {
                foreach ($arr_img as $val) {
                    unlink($val);
                }
                $response = [
                    'status' => 0,
                ];
            } else {
                $where_update = [
                    'id_user' => $id
                ];
                $data_update = [
                    'list_img' => $list_img,
                    'updated_at' => time()
                ];
                $update = $this->Account->update($where_update, $data_update, 'kol');
                if ($update) {
                    $response = [
                        'status' => 1,
                        'mess' => 'Cập nhật thành công!'
                    ];
                } else {
                    $response = [
                        'status' => 0,
                    ];
                }
            }
        } else {
            $response = [
                'status' => 0,
            ];
            $list_img = explode(',', $list_name);
            foreach ($list_img as $val) {
                unlink($val);
            }
        }
        echo json_encode($response);
    }

    public function delete_img_kol()

    {
        $vtri = $this->input->post('vtri');
        $id = $_SESSION['user']['id'];
        $data_kol = $this->Account->get_by_id(['id_user' => $id], 'kol');
        $list_img = $data_kol['list_img'];
        $arr_img = explode(',', $list_img);
        unlink($arr_img[$vtri]);
        unset($arr_img[$vtri]);
        $where_update = [
            'id_user' => $id
        ];
        $data_update = [
            'list_img' => implode(',', $arr_img),
            'updated_at' => time()
        ];
        $update = $this->Account->update($where_update, $data_update, 'kol');
        $response = [
            'status' => 1,
            'message' => "Xóa thành công",
        ];
        echo json_encode($response);
    }

    public function update_data_kol()

    {
        $id = $_SESSION['user']['id'];
        $intro = $this->input->post('intro');
        $price = $this->input->post('price');
        $cate = $this->input->post('cate');
        $where_update = [
            'id_user' => $id
        ];
        $data_update = [
            'price' => $price,
            'cate' => implode(',', $cate),
            'text_intro' => $intro
        ];
        $update = $this->Account->update($where_update, $data_update, 'kol');
        if ($update) {
            $response = [
                'status' => 1,
                'mess' => 'Cập nhật thành công!'
            ];
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }

    public function thue_kol()

    {
        if (check_login()) {
            $id = $_SESSION['user']['id'];
            $amount = $this->input->post('amount');
            $id_kol = $this->input->post('id_kol');
            $data_kol = $this->Account->get_by_id(['id_user' => $id_kol], 'kol');
            $kol = $this->Account->get_by_id(['id' => $id_kol, 'user_type' => 2], 'accounts');
            if ($data_kol != null && $kol != null) {
                $price = $data_kol['price'];
                $money = $amount * $price;
                $check_amount =  $this->Account->get_by_id(['id' => $id, 'cash >=' => $money], 'accounts');
                if ($check_amount != null) {
                    $new_cash = $check_amount['cash'] - $money;
                    if ($new_cash >= 0) {
                        $where_update = [
                            'id' => $id
                        ];
                        $data_update = [
                            'cash' => $new_cash,
                        ];
                        $update = $this->Account->update($where_update, $data_update, 'accounts');
                        if ($update) {
                            $data_insert = [
                                'id_kol' => $id_kol,
                                'id_user' => $id,
                                'hours' => $amount,
                                'price' => $price,
                                'status' => 0,
                                'created_at' => time(),
                                'updated_at' => time(),
                            ];
                            $insert = $this->Account->insert($data_insert, 'thue_kol');
                            if ($insert > 0) {
                                $response = [
                                    'status' => 1,
                                    'mess' => "thuê thành công"
                                ];
                            } else {
                                $data_update = [
                                    'cash' => $check_amount['cash'],
                                ];
                                $update_new = $this->Account->update($where_update, $data_update, 'accounts');
                                $response = [
                                    'status' => 0,
                                    'mess' => "Thuê thất bại"
                                ];
                            }
                        } else {
                            $response = [
                                'status' => 0,
                                'mess' => "Thuê thất bại"
                            ];
                        }
                    } else {
                        $response = [
                            'status' => 2,
                            'mess' => "Không đủ tiền"
                        ];
                    }
                } else {
                    $response = [
                        'status' => 2,
                        'mess' => "Không đủ tiền"
                    ];
                }
            } else {
                $response = [
                    'status' => 3,
                    'mess' => "KOL không tồn tại"
                ];
            }
        } else {
            $response = [
                'status' => 4,
                'mess' => "Chưa đăng nhập"
            ];
        }
        echo json_encode($response);
    }

    public function change_status_thue()

    {
        $id_status = $this->input->post("id_status");
        $type = $this->input->post("type");
        $id = $_SESSION['user']['id'];
        $kol =  $this->Account->get_by_id(['id' => $id, 'user_type' => 2], 'accounts');
        $thue_kol =  $this->Account->get_by_id(['id' => $id_status, 'id_kol' => $id, 'status' => 0], 'thue_kol');
        if ($type == 1 || $type == 2) {
            $where_update = [
                'id' => $id_status,
                'id_kol' => $id,
                'status' => 0
            ];
            $data_update = [
                'status' => $type,
            ];
            $update = $this->Account->update($where_update, $data_update, 'thue_kol');
            if ($update) {
                if ($type == 1) {
                    $where_update = [
                        'id' =>  $thue_kol['id_kol']
                    ];
                    $data_update = [
                        'cash' => $kol['cash'] + ($thue_kol['price'] * $thue_kol['hours'])
                    ];
                } else {
                    $user_thue =  $this->Account->get_by_id(['id' => $thue_kol['id_user']], 'accounts');
                    $where_update = [
                        'id' =>  $thue_kol['id_user']
                    ];
                    $data_update = [
                        'cash' => $user_thue['cash'] + ($thue_kol['price'] * $thue_kol['hours'])
                    ];
                }
                $update_new = $this->Account->update($where_update, $data_update, 'accounts');
                $response = [
                    'status' => 1,
                    'mess' => "Thành công"
                ];
            } else {
                $response = [
                    'status' => 0,
                    'mess' => "Thất bại"
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'mess' => "Thất bại"
            ];
        }
        echo json_encode($response);
    }
    public function add_friend()
    {
        $id_friend = $this->input->post("id");
        $type = $this->input->post("type");
        $id = $_SESSION['user']['id'];
        $friend =  $this->Account->query_sql_row("SELECT * FROM friend WHERE  (id_user = $id AND id_friend = $id_friend) OR ( id_user = $id_friend AND id_friend = $id) ");
        if ($type == 'add') {
            if ($friend == null) {
                $data_insert = [
                    'id_user' => $id,
                    'id_friend' => $id_friend,
                    'type' => 0,
                    'created_at' => time(),
                ];
                $insert = $this->Account->insert($data_insert, 'friend');
                if ($insert > 0) {
                    $response = [
                        'status' => 1,
                        'mess' => "Thêm bạn bè thành công!"
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'mess' => "Thất bại"
                    ];
                }
            } else {
                $response = [
                    'status' => 2,
                    'mess' => "đã tồn tại"
                ];
            }
        } else {
            if ($friend != null) {
                $where_del = [
                    'id' => $friend['id'],
                ];
                $insert = $this->Account->delete($where_del, 'friend');
                if ($insert > 0) {
                    $response = [
                        'status' => 1,
                        'mess' => "Đã xóa bạn bè"
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'mess' => "Thất bại"
                    ];
                }
            } else {
                $response = [
                    'status' => 2,
                    'mess' => "đã tồn tại"
                ];
            }
        }
        echo json_encode($response);
    }

    // public function list_kol()

    // {

    // if (is_playdoul()) {

    // $data['list_js'] = [

    //     'select2.min.js',

    //     'kol/list_kol.js'

    // ];

    // $data['list_css'] = [

    //     'select2.min.css',

    //     'kol/list_kol.css'

    // ];

    // $data['content'] = '/kol/list_kol';

    // $this->load->view('index', $data);

    // } else {

    //     redirect('/');

    // }

    // }

}
