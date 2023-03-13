<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
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
        $this->load->library('pagination311');
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
        $tam = $_SERVER['REQUEST_URI'];

        if ($tam != '/dang-nhap/' && $tam != '/dang-ky/' && $tam != '/xac-thuc-tai-khoan/') {
            setcookie('url_301', $tam, time() + 86400, '/');
        }
    }
    public function veso()
    {
        $data['list_js'] = [
            'service/veso.js'
        ];
        $data['list_css'] = [
            'sanacc/ve_so.css'
        ];
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $where = [
                'id_user' => $_SESSION['user']['id']
            ];
            $data['lichsu'] = $this->Post->get_list_order($where, 'id', 've_so');
        } else {
            $data['lichsu'] = [];
        }
        $data['content'] = '/service/veso';
        $data['index'] = 1;
        $data['meta_title'] = 'Vé số may mắn';
        $this->load->view('index', $data);
    }
    public function xsmb()
    {
        if (check_login()) {
            $data['list_js'] = [
                'service/xsmb.js'
            ];
            if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
                $where = [
                    'id_user' => $_SESSION['user']['id']
                ];
                $data['lichsu'] = $this->Post->get_list_order($where, 'id', 've_so');
            } else {
                $data['lichsu'] = [];
            }
            $data['content'] = '/service/xsmb';
            $data['xsmb'] = 1;
            $this->load->view('index', $data);
        } else {
            redirect('/');
        }
    }
    public function vongquaylienquan()
    {
        $data['list_js'] = [
            'select2.min.js',
            'keyframes.js',
            'zendo/js_vqlq.js'
        ];
        $data['list_css'] = [
            'select2.min.css',
            'sanacc/css_vq_new.css'
        ];
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $where = [
                'user_id' => $_SESSION['user']['id']
            ];
            $data['luotquay_free'] = $this->Account->get_luot_quay_free($where);
        } else {
            $data['luotquay_free'] = [];
        }
        $data['content'] = '/service/vongquaylienquan';
        $data['index'] = 1;
        $data['meta_title'] = 'Vòng quay liên quân';
        $this->load->view('index', $data);
    }
    public function vongquayfreefire()
    {
        $data['list_js'] = [
            'select2.min.js',
            'keyframes.js',
            'zendo/js_vqff.js'
        ];
        $data['list_css'] = [
            'select2.min.css',
            'sanacc/css_vq_freefire.css'
        ];
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $where = [
                'user_id' => $_SESSION['user']['id']
            ];
            $data['luotquay_free'] = $this->Account->get_luot_quay_free($where);
        } else {
            $data['luotquay_free'] = [];
        }
        $data['content'] = '/service/vongquayfreefire';
        $data['index'] = 1;
        $data['meta_title'] = 'Vòng quay Free Fire';
        $this->load->view('index', $data);
    }
    public function ban_the()
    {
        $data['list_js'] = [
            'service/ban_the.js'
        ];
        $data['list_css'] = [
            'sanacc/css_card_garena.css'
        ];

        $data['content'] = '/service/ban_the';
        $data['index'] = 1;
        $data['meta_title'] = 'Bán thẻ chiết khấu cao';
        $this->load->view('index', $data);
    }
    public function diem_danh()
    {
        if (check_login()) {
            $data['list_js'] = [
                'service/diem_danh.js'
            ];
            $data['list_css'] = [
                'sanacc/diemdanh.css'
            ];
            $time_first = strtotime(date('Y-m-01'));
            $time_last = strtotime(date('Y-m-t'));
            $id_user = $_SESSION['user']['id'];
            $sql = "SELECT id FROM diemdanh  WHERE id_user = $id_user AND  created_at BETWEEN $time_first AND $time_last ";
            $row = $this->Account->query_sql_num($sql);
            if ($row == 0) {
                $row = 1;
            }
            //
            $sql2 = "SELECT * FROM diemdanh  WHERE id_user = $id_user  ORDER BY id DESC";
            $row2 = $this->Account->query_sql_num($sql2);
            $check = 0;
            if ($row2 > 0) {
                $check_his = $this->Account->query_sql_row($sql2);
                if (date('m', $check_his['created_at']) < date('m', time()) || date('y', $check_his['created_at']) < date('y', time())) {
                    $check = 2;
                } else {
                    if (date('d-m-Y', $check_his['created_at']) < date('d-m-Y', time())) {
                        $check = 1;
                    } else {
                        $check = 0;
                    }
                }
            } else {
                $check = 2;
            }
            if ($check == 1) {
                $row = $row + 1;
            }
            $data['row'] = $row;
            $data['check'] = $check;
            $data['content'] = '/service/diem_danh';
            $data['index'] = 1;
            $data['meta_title'] = 'Điểm danh hàng ngày';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }
    public function nv_hang_ngay()
    {
        if (check_login()) {
            $id_user = $_SESSION['user']['id'];
            $data['list_js'] = [
                'service/nv_trafic.js'
            ];
            $data['list_css'] = [
                'sanacc/nv-trafic.css'
            ];
            $sql = "SELECT login_zen.*,type,des FROM `login_zen` INNER JOIN link_trafic ON link_trafic.id = login_zen.id_trafic  WHERE id_user = $id_user  ORDER BY login_zen.id DESC LIMIT 1";
            $data['check_his'] = $this->Account->query_sql_row($sql);
            $data['content'] = '/service/nv_hang_ngay';
            $data['index'] = 1;
            $data['meta_title'] = 'Nhiệm vụ mỗi ngày';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }
    public function nap_the()
    {
        if (check_login()) {
            $id_user = $_SESSION['user']['id'];
            $data['list_js'] = [
                'service/napthe.js'
            ];
            $data['list_css'] = [
                'sanacc/cash.css'
            ];
            $sql = "SELECT login_zen.*,type,des FROM `login_zen` INNER JOIN link_trafic ON link_trafic.id = login_zen.id_trafic  WHERE id_user = $id_user  ORDER BY login_zen.id DESC LIMIT 1";
            $data['check_his'] = $this->Account->query_sql_row($sql);
            $data['content'] = '/service/nap_the';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }
    public function blog()
    {
        $data['list_js'] = [
            'blog/blog.js'
        ];
        $data['list_css'] = [
            'sanacc/blog.css'
        ];

        $data['row'] = $this->Post->get_list('', 'baiviet');

        $data['count_category'] = $this->Post->get_list('', 'chuyenmuc');
        $data['content'] = '/blog/blog';
        $data['index'] = 1;
        $data['meta_title'] = 'Blog tin tức';
        $this->load->view('index', $data);
    }
}
