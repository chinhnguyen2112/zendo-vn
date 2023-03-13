<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Blogs extends CI_Controller
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

    public function blog()
    {
        if(this_source() !='zendo'){
            redirect('https://zendo.vn/'.$tam);
        }
        $data['list_js'] = [
            'blog/blog.js'
        ];
        $data['list_css'] = [
            'sanacc/blog.css'
        ];


        $data['row'] = $this->Account->check_data(['1' => 1], 'baiviet');

        $data['count_category'] = $this->Post->get_list('', 'chuyenmuc');
        $data['content'] = '/blog/blog';
        $data['index'] = 1;
        $data['meta_title'] = 'Blog tin tức';
        $this->load->view('index', $data);
    }

    public function chuyenmuc()
    {
        $data['uri_tam_1'] = $uri_tam_1 =  str_replace('/', '', $_SERVER['REQUEST_URI']);
        $data['uri_tam'] = $uri_tam = $uri_tam_1 . '/';
        // game bản quyền
        $sql_uri_game = "SELECT * FROM game_bq WHERE alias = '$uri_tam_1'";
        $get_id_game = $this->Account->query_sql_row($sql_uri_game);
        // chuyên mục
        $sql_uri = "SELECT * FROM chuyenmuc WHERE alias = '$uri_tam'";
        $get_id = $this->Account->query_sql_row($sql_uri);
        if ($get_id != null) {
            if(this_source() !='zendo'){
                redirect('https://zendo.vn/'.$_SERVER['REQUEST_URI']);
            }
            $data['id'] = $id = $get_id['id'];
            $data['name'] = $get_id['name'];
            $data['alias'] = $get_id['alias'];
            $sql_count = "SELECT * FROM baiviet WHERE chuyenmuc = $id";
            $row = $this->Account->query_sql_num($sql_count);


            $sql_category = "SELECT * FROM chuyenmuc";
            $count_category = $this->Account->query_sql($sql_category);
            $title = $get_id['title'];
            $data['list_js'] = [
                'blog/chuyenmuc.js'
            ];
            $data['list_css'] = [
                'sanacc/blog.css'
            ];


            $data['row'] = $row;
            $data['meta_title'] = $title;
            $data['img_head'] = 'https://zendo.vn/'.$get_id['image'];
            $data['count_category'] = $count_category;
            $data['content'] = '/blog/chuyenmuc';
        } elseif ($get_id_game != null) {
            $title = $get_id_game['name'] . ' - Game bản quyền - Zendo Shop ';
            $url = str_replace('/', '', $_SERVER['REQUEST_URI']);
            $sql_get_data = "SELECT * FROM game_bq WHERE alias = '{$url}'  LIMIT 1";
            if ($this->Account->query_sql_num($sql_get_data) < 1) {
                redirect('/');
            }
            $data['info'] = $this->Account->query_sql_row($sql_get_data);
            $data['list_js'] = [
                'blog/chi_tiet_game_bq.js'
            ];
            $data['list_css'] = [
                'sanacc/reset.css',
                'sanacc/css_detail_game.css'
            ];
            $data['content'] = '/blog/chi_tiet_game_bq';
            $data['meta_title'] = $title;
            $data['img_head'] = 'https://zendo.vn/'.$get_id_game['image'];
        } else {
            if(this_source() !='zendo'){
                redirect('https://zendo.vn/'.$_SERVER['REQUEST_URI']);
            }
            $data['blog'] = $blog =  $this->Account->query_sql_row("SELECT * FROM baiviet WHERE alias = '$uri_tam_1' LIMIT 1");
            if (count((array)$blog) == 0) {
                redirect('/');
            } else {
                $title = $blog['title'];
                $meta_keyword = $blog['meta_key'];
                $img_head = 'https://zendo.vn' . $blog['image'];
                $data_seo = $blog;

                $sql_chuyenmuc = "SELECT name,alias FROM chuyenmuc WHERE id = '{$blog['chuyenmuc']}' ";
                $data['chuyenmuc'] = $this->Account->query_sql_row($sql_chuyenmuc);
                $data['list_js'] = [
                    'blog/chi_tiet_blog.js'
                ];
                $data['list_css'] = [
                    'sanacc/chi_tiet_blog.css'
                ];
                $data['content'] = '/blog/chi_tiet_blog';
                $data['meta_title'] = $title;
                $data['meta_keyword'] = $meta_keyword;
                $data['img_head'] = $img_head;
            }
        }


        $data['index'] = 1;
        $this->load->view('index', $data);
    }
}
