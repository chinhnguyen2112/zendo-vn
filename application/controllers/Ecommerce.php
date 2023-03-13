<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ecommerce extends CI_Controller

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

    public function dang_ban()
    {
        if (check_login() && is_user_seller()) {
            $data['list_css'] = [
                'main/css_home_new.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css'
            ];
            $data['content'] = '/ecommerce/dang_ban';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function lienquan()
    {
        if (check_login() && (is_user_seller() || is_admin_vip())) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'select2.min.js',
                'ecommerce/post_lienquan.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'select2.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_lienquan';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function freefire()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_freefire.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_freefire';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function pubg()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_pubg.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_pubg';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function tocchien()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_tc.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_tc';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function lmht()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_lmht.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_lmht';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function fifa()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_fifa.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_fifa';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function cf()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_cf.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_cf';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function valorant()
    {
        if (check_login() && is_user_seller()) {
            $id = $this->input->get('edit');
            if ($id > 0) {
                $where = [
                    'id_post' => $id,
                    'user_id' => $_SESSION['user']['id'],
                    'phe_duyet !=' => 1,
                    'status' => 0,
                    'trang_thai_xoa' => 2
                ];
                if (is_admin_vip()) {
                    $where = [
                        'id_post' => $id,
                    ];
                }
                $acc = $this->Account->check_data($where, 'posts');
                $data['acc'] = $this->Post->get_id($where, 'posts');
                $data['type_action'] = 'update';
                if ($acc != 1) {
                    redirect('/');
                }
            }
            $data['list_js'] = [
                'ecommerce/post_valorant.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
                'ecommerce/post_lienquan.css'
            ];
            $data['content'] = '/ecommerce/post_valorant';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function list_acc()
    {
        if (this_source() == 'zendo'  || (check_login() && is_user_seller())) {
            $data['list_js'] = [
                'ecommerce/list_acc.js'
            ];
            $data['list_css'] = [
                'bootstrap.min.css',
                'sanacc/e_commerce.css',
                'sanacc/css_quanly.css',
            ];
            $loai_game = $this->input->get('game');
            if ($loai_game == 1) {
                $type_account = 'Liên Quân Mobile';
            } elseif ($loai_game == 2) {
                $type_account = 'Free Fire';
            } elseif ($loai_game == 3) {
                $type_account = 'Pubg';
            } elseif ($loai_game == 4) {
                $type_account = 'Liên Minh Huyền Thoại';
            } elseif ($loai_game == 5) {
                $type_account = 'Fifa';
            } elseif ($loai_game == 6) {
                $type_account = 'Tốc Chiến';
            } elseif ($loai_game == 7) {
                $type_account = 'CF';
            } elseif ($loai_game == 8) {
                $type_account = 'Valorant';
            } else {
                $type_account = 'Liên Quân Mobile';
                $loai_game = 1;
            }
            $where_list = [
                'type_account' => $type_account,
                'trang_thai_xoa' => 2,
                'user_id' => $_SESSION['user']['id']
            ];
            if (is_admin_vip() || this_source() == 'verestino') { // phải admin zendo hay không
                unset($where_list['user_id']);
                $where_list['user_id >'] = 0;
            }
            $sort = $this->input->get('sort');
            if ($sort == 4) {
                $where_list['status'] = 1;
            } else if ($sort != '') {
                $where_list['phe_duyet'] = $sort;
            }
            $search_game = $this->input->get('search');
            $page = $this->uri->segment(2);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            $count = $this->Game->search_list($where_list, $search_game, 0, 0);
            pagination('/danh-sach-tai-khoan', count($count), $limit);

            $list_acc = $this->Game->search_list($where_list, $search_game, $start, $limit);

            $data['list_acc'] = $list_acc;
            $data['count_lq'] =  $this->countAccgame('Liên Quân Mobile', $where_list, $search_game);
            $data['count_ff'] =  $this->countAccgame('Free Fire', $where_list, $search_game);
            $data['count_pubg'] =  $this->countAccgame('Pubg', $where_list, $search_game);
            $data['count_lmht'] =  $this->countAccgame('Liên Minh Huyền Thoại', $where_list, $search_game);
            $data['count_fifa'] =  $this->countAccgame('Fifa', $where_list, $search_game);
            $data['count_tc'] =  $this->countAccgame('Tốc Chiến', $where_list, $search_game);
            $data['count_cf'] =  $this->countAccgame('CF', $where_list, $search_game);
            $data['count_valorant'] =  $this->countAccgame('Valorant', $where_list, $search_game);
            // doanh thu
            $where_money = [
                'status' => 1,
                'user_id' => $_SESSION['user']['id']
            ];
            $count_money = $this->Game->search_money($where_money);
            $data['count_money'] =  $count_money['price_atm'];
            $data['loai_game'] = 1;
            $data['content'] = '/ecommerce/list_acc';
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    function countAccgame($type_account, $where_list, $search_game)
    {
        $where_list['type_account'] = $type_account;
        $count = $this->Game->search_list($where_list, $search_game, 0, 0);

        return count($count);
    }
}
