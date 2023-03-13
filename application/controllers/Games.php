<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Games extends CI_Controller
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
    }

    public function shoplienquan()
    {
        $data['list_js'] = [
            'select2.min.js',
            'game/shoplienquan.js'
        ];
        $data['list_css'] = [
            'select2.min.css',
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shoplienquan';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Liên Quân - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shopfreefire()
    {
        $data['list_js'] = [
            'game/shopfreefire.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shopfreefire';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Free Fire - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shoplmht()
    {
        $data['list_js'] = [
            'game/shoplmht.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shoplmht';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Liên Minh Huyền Thoại - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shoppubg()
    {
        $data['list_js'] = [
            'game/shoppubg.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shoppubg';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Pubg Mobile - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shopfifa()
    {
        $data['list_js'] = [
            'game/shopfifa.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shopfifa';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Fifa - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shoplmtc()
    {
        $data['list_js'] = [
            'game/shoplmtc.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shoplmtc';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Liên Minh Tốc Chiến - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shopcf()
    {
        $data['list_js'] = [
            'game/shopcf.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shopcf';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc CF - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function shopvalorant()
    {
        $data['list_js'] = [
            'game/shopvalorant.js'
        ];
        $data['list_css'] = [
            'sanacc/css_list.css'
        ];

        $data['content'] = '/game/shopvalorant';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop acc Valorant - Uy tín - Chất lượng';
        $this->load->view('index', $data);
    }
    public function detail_account($id)
    {
        $data['list_js'] = [
            'select2.min.js',
            'game/detail_account.js'
        ];
        $data['list_css'] = [
            'sanacc/reset.css',
            'sanacc/css_detail_acc.css'
        ];
        $where = [
            'id_post' => $id,
            'status' => 0,
            'price !=' => 0,
            'trang_thai_xoa != ' => 1
        ];
        $data['game'] = $this->Post->get_id($where, 'posts');
        if ($data['game'] != null) {
            if ($data['game']['type_post'] == 4 && !is_admin_vip()) {
                if (!check_login()  || $_SESSION['user']['id'] != $data['game']['user_id'] || !is_user_seller()) {
                    redirect('/');
                }
            }
        } else {
            redirect('/');
        }
        $data['content'] = '/game/detail_account';
        $data['index'] = 1;
        $data['meta_title'] = 'Chi tiết tài khoản #' . $id;
        $this->load->view('index', $data);
    }
    public function phanmembanquyen()
    {
        $data['list_css'] = [
            'sanacc/game_bq.css'
        ];
        $where = [
            'type' => 0
        ];
        $data['game_bq'] = $this->Post->get_list_order($where, 'id', 'game_bq');
        $data['content'] = '/game/phanmembanquyen';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop phần mềm bản quyền';
        $this->load->view('index', $data);
    }
    public function gamebanquyen()
    {
        $data['list_css'] = [
            'sanacc/game_bq.css'
        ];
        $where = [
            'type' => 1
        ];
        $data['game_bq'] = $this->Post->get_list_order($where, 'id', 'game_bq');
        $data['content'] = '/game/gamebanquyen';
        $data['index'] = 1;
        $data['meta_title'] = 'Shop game bản quyền';
        $this->load->view('index', $data);
    }
}
