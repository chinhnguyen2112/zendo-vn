<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Manager extends CI_Controller

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

    public function kho_do()

    {

        if (check_login()) {

            $data['list_js'] = [

                'manager/khodo.js'

            ];

            $data['list_css'] = [

                'sanacc/khodo.css'

            ];

            // lấy database từ lịch sử quay

            $id = $_SESSION['user']['id'];

            $sql = "SELECT history_gift.*, gift.name, gift.image, gift.type_item, gift.zen, gift.des, gift.value_use, COUNT(*) as count_item

            FROM history_gift

            INNER JOIN gift

            ON history_gift.id_gift=gift.id

            WHERE id_user = '$id' AND gift.type_item != 0 AND gift.type_item != 5 AND gift.type_item != 12 AND history_gift.type = 0 GROUP BY  type_item";

            $count = $this->Account->query_sql($sql);



            // count số lượng quân huy

            $sql_count = "SELECT SUM(value) as val_item

            FROM history_gift

            INNER JOIN gift

            ON history_gift.id_gift=gift.id

            WHERE id_user = '$id' AND gift.type_item = 1  GROUP BY  type_item";

            $count_1 = $this->Account->query_sql_row($sql_count);



            // lấy số lượng quân huy rút hoặc bán từ bảng history vật phẩm

            $sql_vp = "SELECT SUM(history_vp.count) as count_vp

            FROM history_vp

            INNER JOIN gift

            ON history_vp.id_item=gift.id

            WHERE id_user = '$id' AND gift.type_item = 1  GROUP BY  type_item";

            $count_vp = $this->Account->query_sql_row($sql_vp);





            // trừ số lượng rút hoặc bán quân huy

            foreach ($count as $key => $val) {

                if ($val['type_item'] == 1 && ($count_1['val_item'] - $count_vp['count_vp']) <= 0) {
                    array_splice($count, $key, 1);
                }
            }

            $data['count'] = $count;
            $data['count_1'] = $count_1;

            $data['count_vp'] = $count_vp;

            $data['content'] = '/manager/kho_do';

            $this->load->view('index', $data);
        } else {

            redirect('/dang-nhap/');
        }
    }

    public function quan_ly()

    {

        if (check_login()) {
            if (is_playdoul()) {
                $data['list_js'] = [
                    'select2.min.js',
                    'kol/info_kol.js'
                ];
                $data['list_css'] = [
                    'select2.min.css',
                    'kol/info_kol.css'
                ];
                $user_name = $_SESSION['user']['username'];
                $id_user = $_SESSION['user']['id'];

                $sql_kol = "SELECT * FROM kol WHERE id_user = '$id_user'";
                $data['kol'] = $this->Account->query_sql_row($sql_kol);
                $data['content'] = '/kol/info_kol';
            } else {
                $data['list_js'] = [
                    'manager/manager.js'
                ];
                $data['list_css'] = [
                    'sanacc/css_quanly.css'
                ];
                $user_name = $_SESSION['user']['username'];
                $id_user = $_SESSION['user']['id'];
                $sql = "SELECT * FROM history_buy WHERE username LIKE '$user_name'";
                $data['count'] = $this->Account->query_sql_num($sql);

                $sql_cart = "SELECT * FROM giohang WHERE id_user = '$id_user'";
                $data['row'] = $this->Account->query_sql_num($sql_cart);
                $data['content'] = '/manager/manager';
            }
            $this->load->view('index', $data);
        } else {
            redirect('/dang-nhap/');
        }
    }

    public function ls_mua_hang()

    {

        if (check_login()) {

            $data['list_js'] = [

                'manager/ls_mua_hang.js'

            ];

            $data['list_css'] = [

                'bootstrap.min.css',

                'sanacc/cash.css'

            ];

            $data['content'] = '/manager/ls_mua_hang';

            $this->load->view('index', $data);
        } else {

            redirect('/dang-nhap/');
        }
    }

    public function gio_hang()

    {

        if (check_login()) {

            $data['list_js'] = [

                'manager/gio_hang.js'

            ];

            $data['list_css'] = [

                'sanacc/giohang.css',

                'sanacc/css_addzend_acc.css'

            ];

            $id_user = $_SESSION['user']['id'];

            $sql = "SELECT giohang.*, posts.price, posts.id_post FROM giohang INNER JOIN posts ON giohang.id_account = posts.id_post WHERE id_user = $id_user ORDER BY id DESC";
            $data['count'] = $this->Account->query_sql($sql);

            $data['row'] =  $this->Account->query_sql_num($sql);

            $data['count_price'] =  $this->Account->query_sql_row($sql, 1);

            $data['content'] = '/manager/gio_hang';

            $this->load->view('index', $data);
        } else {

            redirect('/dang-nhap/');
        }
    }
}
