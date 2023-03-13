<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller

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
        $this->load->library('pagination311');
        $this->load->helper('url');
        $this->load->helper('func_helper');
        $this->load->library('Globals');
        $this->load->helper('images');
        $this->load->library('upload');
        $this->db = $this->load->database('default', TRUE);
        if (!is_admin()) {

            redirect('/');
        }
    }
    public function admin()
    {

        $data['content'] = '/admin/main';
        $this->load->view('admin/index', $data);
    }
    public function his_acc()
    {
        $id_post = $this->input->get("id_post");
        $username = $this->input->get("username");
        $start_date = $this->input->get("start_date");
        $end_date = $this->input->get("end_date");
        $source = $this->input->get("source");
        $html_sql = '';

        if (this_source() != 'zendo') {
            $site_name = this_source();
            $html_sql = " AND source LIKE '%$site_name%'  ";
        } else {
            if ($source != '' && $source != 'zendo') {
                $html_sql .= " AND source = '$source' ";
            } else if ($source == 'zendo') {
                $html_sql .= " AND source IS NULL ";
            }
        }
        // echo $start_date;die;
        if ($start_date != '') {
            $html_sql .= " AND history_buy.time >= '$start_date' ";
        }
        if ($end_date != '') {
            $html_sql .= " AND history_buy.time < '$end_date' ";
        }
        if ($id_post > 0) {
            $html_sql .= "AND history_buy.id_post = '$id_post' ";
        }
        if (!empty($username)) {
            $html_sql .= "AND history_buy.name LIKE '%$username%' ";
        }
        $total_record = $this->Account->query_sql_num("SELECT history_buy.* FROM history_buy  INNER JOIN accounts ON accounts.username = history_buy.username   WHERE history_buy.id != '0'  $html_sql ");
        $page = $this->uri->segment(3);
        if ($page < 1 || $page == '') {
            $page = 1;
        }
        $limit = 20;
        $start = $limit * ($page - 1);
        pagination('/admin/his_acc', $total_record, $limit, 3);

        $sql_get_list_buy = "SELECT history_buy.*, source,accounts.id as id_u FROM `history_buy` INNER JOIN accounts ON accounts.username = history_buy.username WHERE history_buy.id != '0' $html_sql ORDER BY `time` DESC LIMIT $start, $limit";
        $data['list'] = $this->Account->query_sql($sql_get_list_buy);
        $data['content'] = '/admin/his_acc';
        $this->load->view('admin/index', $data);
    }
    public function his_card()
    {
        $html_sql = '';
        if (this_source() != 'zendo') {
            $site_name = this_source();
            $html_sql = " AND source LIKE '%$site_name%'  ";
        }
        $total_record = $this->Account->query_sql_num("SELECT history_card.* FROM history_card  INNER JOIN accounts ON accounts.username = history_card.username   WHERE history_card.id != '0'  $html_sql ");
        $page = $this->uri->segment(3);
        if ($page < 1 || $page == '') {
            $page = 1;
        }
        $limit = 20;
        $start = $limit * ($page - 1);
        pagination('/admin/his_card', $total_record, $limit, 3);

        $sql_get_list_buy = "SELECT history_card.*, source,accounts.id as id_u FROM `history_card` INNER JOIN accounts ON accounts.username = history_card.username WHERE history_card.id != '0' $html_sql ORDER BY `time` DESC LIMIT $start, $limit";
        $data['list'] = $this->Account->query_sql($sql_get_list_buy);
        $data['content'] = '/admin/his_card';
        $this->load->view('admin/index', $data);
    }
    public function member()
    {
        $idus = $this->input->get("idus");
        $username = $this->input->get("username");
        $html_sql = '';

        if (this_source() != 'zendo') {
            $site_name = this_source();
            $html_sql = " AND source LIKE '%$site_name%'  ";
        }
        // echo $start_date;die;
        if ($username != '') {
            $html_sql .= " AND name LIKE '%$username%' ";
        }
        if ($idus != '') {
            $html_sql .= " AND( id LIKE '%$idus%' OR id LIKE '%$idus%' ) ";
        }
        $total_record = $this->Account->query_sql_num("SELECT 8 FROM accounts  WHERE id != '0'  $html_sql ");
        $page = $this->uri->segment(3);
        if ($page < 1 || $page == '') {
            $page = 1;
        }
        $limit = 20;
        $start = $limit * ($page - 1);
        pagination('/admin/member', $total_record, $limit, 3);
        $sql_get_list_buy = "SELECT * FROM `accounts` WHERE id != '0' $html_sql ORDER BY `id` DESC LIMIT $start, $limit";
        $data['list'] = $this->Account->query_sql($sql_get_list_buy);
        $data['content'] = '/admin/member';
        $this->load->view('admin/index', $data);
    }
    public function traffic()
    {
        if (is_admin_vip()) {
            $total_record = $this->Account->query_sql_num("SELECT * FROM  link_trafic ");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/traffic', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT * FROM  link_trafic  ORDER BY  status DESC,id desc LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['content'] = '/admin/traffic';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function add_traffic()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  link_trafic  WHERE id = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['content'] = '/admin/add_traffic';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_traffic()
    {
        if (is_admin_vip()) {
            $id = $this->input->post('id');
            $keyword = $this->input->post('keyword');
            $type = $this->input->post('type');
            $des = $this->input->post('des');
            $status = $this->input->post('status');
            $data = [
                'keyword' => $keyword,
                'type' => $type,
                'status' => $status,
                'des' => $des,
                'created_at' => time()
            ];
            if ($id > 0) {
                $where_update = [
                    'id' => $id
                ];
                $update = $this->Account->update($where_update, $data, 'link_trafic');
                if ($update) {
                    $status = 1;
                }
            } else {
                $insert = $this->Account->insert($data, 'link_trafic');
                if ($insert > 0) {
                    $status = 1;
                }
            }
            if ($status == 1) {
                $msg = [
                    'status' => 1,
                    'msg' => 'Thêm thành công'
                ];
            } else {
                $msg = [
                    'status' => 0,
                    'msg' => 'Thất bại rồi'
                ];
            }
        } else {
            $msg = [
                'status' => 0,
                'msg' => 'Không có quyền'
            ];
        }
        echo json_encode($msg);
    }
    public function game_bq()
    {
        if (is_admin_vip()) {
            $total_record = $this->Account->query_sql_num("SELECT * FROM `game_bq`");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/game_bq', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT * FROM `game_bq`  ORDER BY `id` DESC LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['content'] = '/admin/game_bq';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function add_game_bq()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  game_bq  WHERE id = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['content'] = '/admin/add_game_bq';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_game_bq()
    {
        if (is_admin_vip()) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $types = $this->input->post('type');
            $note = $this->input->post('note');
            $alias = $this->input->post('url');
            $des = $this->input->post('des');
            $data = [
                'name' => $name,
                'alias' => $alias,
                'price' => $price,
                'des' => $des,
                'note' => $note,
                'type' => $types,
                'updated_at' => time(),
            ];
            if (isset($_FILES['image']) && $_FILES['image'] !== null && $_FILES['image']['name'] !== '') {
                $filename         = $_FILES['image']['name'];
                $filedata         = $_FILES['image']['tmp_name'];
                $temp            = explode('.', $filename);
                $thumb_path        = 'assets/img_game/' . $alias . '.jpg';

                $imguser = $alias . '.jpg';
                $config['file_name'] = $imguser;
                $config['upload_path'] = 'assets/img_game';
                $config['allowed_types'] = 'jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $imageThumb = new Image($filedata);
                    $imageThumb->resize(375, 300, 'crop');
                    $imageThumb->save($alias, $config['upload_path'], 'jpg');
                    $data['image'] = $thumb_path;
                }
            }
            if ($id > 0) {
                $where_update = [
                    'id' => $id
                ];
                $update = $this->Account->update($where_update, $data, 'game_bq');
                if ($update) {
                    $status = 1;
                }
            } else {
                $data['created_at'] = time();
                $insert = $this->Account->insert($data, 'game_bq');
                if ($insert > 0) {
                    $status = 1;
                }
            }
            if ($status == 1) {

                setcookie('url_sitemap', '/admin/game_bq/', time() + 86400, '/');
                $msg = [
                    'status' => 1,
                    'msg' => 'Thêm thành công'
                ];
            } else {
                $msg = [
                    'status' => 0,
                    'msg' => 'Thất bại rồi'
                ];
            }
        } else {
            $msg = [
                'status' => 0,
                'msg' => 'Không có quyền'
            ];
        }
        echo json_encode($msg);
    }
    public function ve_so()
    {
        if (is_admin_vip()) {
            $id = $this->input->get("id");
            $number = $this->input->get("number");
            $status = $this->input->get("status");
            $day = $this->input->get("day");
            $status = $status - 1;
            $where = '';
            if ($id > 0) {
                $where .= ' AND id_user = ' . $id;
            }
            if ($number > 0) {
                $where .= ' AND number = ' . $number;
            }
            if ($status >= 0) {
                $where .= ' AND status = ' . $status;
            }
            if ($day > 0) {
                $day_now = strtotime($day);
                $day_next = $day_now + 86400;
                $where .= ' AND created_at >= ' . $day_now . ' AND created_at <= ' . $day_next;
            }
            $data['id'] = $id;
            $data['number'] = $number;
            $data['status'] = $status;
            $data['day'] = $day;
            $total_record = $this->Account->query_sql_num("SELECT ve_so.*,name FROM ve_so  INNER JOIN accounts ON accounts.id = ve_so.id_user   WHERE ve_so.id != '0' $where");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/ve_so', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT ve_so.*,name FROM ve_so  INNER JOIN accounts ON accounts.id = ve_so.id_user   WHERE ve_so.id != '0' $where  ORDER BY `id` DESC LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['content'] = '/admin/ve_so';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ds_acc()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            $name = $this->input->get('name');
            $where = '';
            if ($id > 0) {
                $where .= " AND id_post = $id ";
            }
            if ($name != '') {
                $where .= " AND username like '%$name%' ";
            }
            $data['id'] = $id;
            $data['name'] = $name;
            $total_record = $this->Account->query_sql_num("SELECT * FROM  posts WHERE 1 = 1 $where ");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/ds_acc', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT * FROM  posts WHERE 1 = 1 $where ORDER BY  id_post desc LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['content'] = '/admin/ds_acc';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_lq()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_lq';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_lmht()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_lmht';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_lmtc()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_lmtc';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_freefire()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_freefire';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_pubg()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_pubg';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_cf()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_cf';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_fifa()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_fifa';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function post_valorant()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  posts  WHERE id_post = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/post_valorant';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_post_acc()
    {
        if (is_admin_vip()) {
            $id_user = $_SESSION['user']['id'];
            $username        = $this->input->post('username');
            $password        =  $this->input->post('password');
            $note            =  $this->input->post('note');
            $id_post         =  $this->input->post('id_post');
            $skins_count     =  $this->input->post('skins_count');
            $skins           =  $this->input->post('skins');
            $champs_count    =  $this->input->post('champs_count');
            $champs          =  $this->input->post('champs');
            $rank            =  $this->input->post('rank');
            $frame           =  $this->input->post('frame');
            $ip_count        =  $this->input->post('ip_count');
            $type_account    =  $this->input->post('type_account');
            $pet             =  $this->input->post('pet');
            $code_2fa        =  $this->input->post('code_2fa');
            $price       =  $this->input->post('price');
            $price_atm           = ceil($price * 0.8);
            $type_action     =  $this->input->post('type_action');
            $source          =  $this->input->post('source');
            $type_post       = $this->input->post('type_post');
            $total_champs = count($_FILES["gem"]["name"]);

            $data_main = [
                'price' => $price,
                'price_atm' => $price_atm,
                'username' => $username,
                'password' => $password,
                'user_id' => 0,
                'date_posted' => date("Y-m-d H:i:s"),
                'ngay_chinh_sua' => time(),
                'note' => $note,
                'type_account' => $type_account,
                'type_post' => $type_post
            ];
            if ($type_account == 'Liên Quân Mobile') {
                //Liên quân :
                if ($this->input->post('champs') != '') {
                    $ten = array(

                        '35' => '35-Toro',
                        '9' => '9-Gildur',
                        '13' => '13-Kahlii',
                        '20' => '20-Mganga',
                        '15' => '15-Krixi',
                        '21' => '21-Mina',
                        '36' => '36-Triệu Vân',
                        '37' => '37-Valhein',
                        '38' => '38-Veera',
                        '33' => '33-Taara',
                        '17' => '17-Lữ Bố',
                        '44' => '44-Zuka',
                        '39' => '39-Violet',
                        '40' => '40-Yorn',

                        '1' => '1-Aleister',
                        '2' => '2-Alice',
                        '3' => '3-Azzen Ka',
                        '4' => '4-Butterfly',
                        '5' => '5-Chaugnar',
                        '6' => '6-Cresht',
                        '7' => '7-Điêu Thuyền',
                        '8' => '8-Fennik',
                        '10' => '10-Grakk',
                        '11' => '11-Ilumia',
                        '12' => '12-Jinna',
                        '14' => '14-Kriknak',
                        '16' => '16-Lauriel',

                        '18' => '18-Lumburr',
                        '19' => '19-Maloch',
                        '22' => '22-Arthur',
                        '23' => '23-Nakroth',
                        '24' => '24-Natalya',
                        '25' => '25-Ngộ Không',
                        '26' => '26-Omega',
                        '27' => '27-Ormarr',
                        '28' => '28-Payna',
                        '29' => '29-Preyta',
                        '30' => '30-Raz',
                        '31' => '31-Skud',
                        '32' => '32-Slimz',
                        '34' => '34-Thane',

                        '41' => '41-Zephys',
                        '42' => '42-batman',
                        '43' => '43-Airi',
                        '45' => '45-Ignis',
                        '46' => '46-Murad',
                        '47' => '47-Zill',
                        '48' => '48-Arduin',
                        '49' => '49-Joker',
                        '50' => '50-Ryoma',
                        '51' => '51-Astrid',
                        '52' => '52-Tel Annas',
                        '53' => '53-Superman',
                        '54' => '54-Wonder Woman',
                        '55' => '55-Xeniel',
                        '56' => '56-Kil Groth',
                        '57' => '57-Moren',
                        '58' => '58-TeeMee',
                        '59' => '59-Lindis',
                        '60' => '60-Omen',
                        '61' => '61-Tulen',
                        '62' => '62-Liliana',
                        '63' => '63-Max',
                        '64' => '64-The Flash',
                        '65' => '65-Wisp',
                        '66' => '66-Arum',
                        '67' => '67-Rourke',
                        '68' => '68-Marja',
                        '69' => '69-Roxie',
                        '70' => '70-Baldum',
                        '71' => '71-Annette',
                        '72' => '72-Amily',
                        '73' => '73-Ybneth',
                        '74' => '74-Elsu',
                        '75' => '75-Quillen',
                        '76' => '76-Sephera',
                        '77' => '77-Richter',
                        '78' => '78-Florentino',
                        '79' => '79-DArcy',
                        '80' => '80-Wiro',
                        '82' => '82-Veres',
                        '83' => '83-Hayate',
                        '84' => '84-Capheny',
                        '85' => '85-Errol',
                        '86' => '86-Yena',
                        '87' => '87-Enzo',
                        '88' => '88-Zip',
                        '89' => '89-Qi',
                        '90' => '90-Celica',
                        '91' => '91-Volkath',
                        '92' => '92-Krizzix',
                        '93' => "93-Eland`orr",
                        '94' => '94-Ishar',
                        '95' => '95-Dirak',
                        '96' => '96-Keera',
                        '97' => '97-Ata',
                        '98' => '98-Paine',
                        '99' => '99-Laville',
                        '100' => '100-Rouie',
                        '101' => '101-Zata',
                        '102' => '102-Allain',
                        '103' => '103-Thorne',
                        '104' => '104-Sinestrea',
                        '105' => '105-Dextra',
                        '106' => '106-Lorion',
                        '107' => '107-Bright',
                        '108' => '108-IGGY',
                        '109' => '109-AOI',
                        '110' => '110-Aya',
                        '111' => '111-Tachi',
                        '112' => '112-Yue',
                    );
                    $champs_arr = [];
                    foreach ($champs as $key => $value) {
                        foreach ($ten as $key2 => $value2) {
                            if ($value == $key2) {
                                $champs_arr[] = $value2;
                                break;
                            }
                        }
                    }
                    $champs_str = implode('|', $champs_arr);
                } else {
                    $champs_str = "";
                }

                if ($this->input->post('skins')) {
                    $ten2 = [
                        "0- không có", "1- Valhein hoàng tử quạ", "2- Valhein vũ khí tối thượng", "3- Valhein đại công tước", "4- Valhein quang vinh", "5- Valhein số 7 thần sầu", "6- Valhein khiêu chiến", "7- Valhein cá mập nghiêm túc", "8- Valhein hoàng tử băng", "9- Valhein thần tài", "10- Thane kẻ hủy diệt", "11- Thane quang vinh", "12- Thane mật vụ", "13- Veera cô giáo hắc ám", "14- Veera góa phụ giả kim", "15- Veera nàng dơi tuyết", "16- Veera y tá bạo loạn", "17- Veera thiên nga đen", "18- Veera vũ hội bóng đêm", "19- Lữ bố tiệc bãi biển", "20- Lữ bố nam vương", "21- Lữ bố long kỵ sĩ", "22- Lữ bố kỵ sĩ âm phủ", "23- Lữ bố đặc nhiệm swat", "24- Lữ bố tư lệnh robot", "25- Lữ bố hỏa long chiến thần", "26- Lữ bố ichigo kurosaki", "27- Lữ bố thần ngọc", "28- Mina tiệc bánh kẹo", "29- Mina kẹo hay ghẹo", "30- Mina lưỡi hái hoàng kim", "31- Mina đào tạo siêu sao", "32- Mina chị đại lắm chiêu", "33- Mina tiểu thư đoạt hồn", "34- Krixi công chúa bướm", "35- Krixi xứ sở thần tiên", "36- Krixi tiệc bãi biển", "37- Krixi cô tiên thỏ", "38- Krixi phó văn nghệ", "39- Krixi tiểu yêu nữ", "40- Krixi nữ hoàng thiên nga", "41- Krixi thần thoại hy lạp", "42- Krixi thủy thủ", "43- Krixi terrible tornado", "44- Mganga hề cung đình", "45- Mganga tiệc bánh kẹo", "46- Mganga pháp sư mèo", "47- Triệu vân đoạt mệnh thương", "48- Triệu vân quý công tử", "49- Triệu vân dũng sĩ đồ long", "50- Triệu vân quang vinh", "51- Triệu vân chiến tướng mùa đông", "52- Triệu vân kỵ sĩ tận thế", "53- Triệu vân cẩm y vệ: hỏa long", "54- Omega người máy xanh", "55- Omega cỗ máy siêu tốc", "56- Kahlii cô dâu hắc ám", "57- Kahlii quaàng khăn đỏ", "58- Kahlii kim cô giáo chủ", "59- Kahlii siêu đầu bếp", "60- Kahlii vũ hội bóng đêm", "61- Zephys oán linh", "62- Zephys hiệp sĩ bí ngô", "63- Zephys dung nham", "64- Zephys siêu việt", "65- Zephys phi thương", "66- Zephys tư lệnh viễn chinh", "67- Zephys hắc vô thường", "68- Điêu thuyền nữ vương anh đào", "69- Điêu thuyền tiệc bãi biển", "70- Điêu thuyền nữ y tá", "71- Điêu thuyền wave", "72- Điêu thuyền hoa hậu", "73- Điêu thuyền phù thủy bí ngô", "74- Điêu thuyền vũ điệu nghê thường", "75- Điêu thuyền tà linh pháp trượng", "76- Điêu thuyền mèo công nghệ", "77- Điêu thuyền thần ngọc", "78- Chaugnar ác mộng sinh hóa", "79- Chaugnar quang vinh", "80- Violet nữ hoàng pháo hoa", "81- Violet nữ đặc cảnh", "82- Violet phi công trẻ", "83- Violet mèo siêu quậy", "84- Violet tiệc bãi biển", "85- Violet phó học tập", "86- Violet thứ nguyên vệ thần", "87- Violet phá hoa neon", "88- Violet đặc dị", "89- Violet vợ người ta", "90- Violet tay súng siêu phàm", "91- Violet huy chương vàng", "92- Violet huyết ma thần", "93- Violet lam tước", "94- Violet thần long tỷ tỷ", "95- Butterfly xuân nữ ngổ ngáo", "96- Butterfly thủy thủ", "97- Butterfly teen nữ công nghệ", "98- Butterfly nữ quái nổi loạn", "99- Butterfly quận chúa đế chế", "100- Butterfly đông êm đềm", "101- Butterfly phượng cửu thiên", "102- Butterfly cẩm y vệ: chu tước", "103- Butterfly asuna tia chớp", "104- Butterfly stacia", "105- Ormarr cựu chiến binh", "106- Ormarr thông thỏa thích", "107- Ormarr giáo viên thể hình", "108- Azzen`Ka linh hồn lữ khách", "109- Azzen`Ka kẹo hay ghẹo", "110- Azzen`Ka quỷ diện lãng khách", "111- Alice nhà chiêm tinh", "112- Alice bé gấu tuyết", "113- Alice xứ sở thần tiên", "114- Alice dạ hội", "115- Alice tiểu quỷ bí ngô", "116- Alice bé du xuân", "117- Alice tiểu tiên tử", "118- Gildur tiệc bãi biển", "119- Gildur phượt thủ", "120- Gildur đại gia học viện", "121- Gildur đại võ sư", "122- Gildur thuyền trưởng râu bạc", "123- Yorn cung thủ bóng đêm", "124- Yorn thế tử nguyệt tộc", "125- Yorn đặc nhiệm swat", "126- Yorn phá vân tiễn", "127- Yorn long thần soái", "128- Yorn nam thần giáng sinh", "129- Yorn soái ca học đường", "130- Yorn thần thoại hy lạp", "131- Toro đặc cảnh nypd", "132- Toro trung phong cắm", "133- Toro thần thoại hy lạp", "134- Taara đại tù trưởng", "135- Taara hỏa ngọc nữ đế", "136- Taara tiệc bãi biển", "137- Taara hồng môn đường chủ", "138- Taara tư lệnh hải âu", "139- Nakroth chiến binh hỏa ngục", "140- Nakroth quân đoàn địa ngục", "141- Nakroth bboy công nghệ", "142- Nakroth khiêu chiến", "143- Nakroth quán quân", "144- Nakroth lôi quang sứ", "145- Nakroth tiệc bãi biển", "146- Nakroth thứ nguyên vệ thần", "147- Nakroth siêu việt", "148- Grakk thuyền trưởng râu đỏ", "149- Grakk khô lâu đại tướng", "150- Grakk chàng gấu tuyết", "151- Grakk mèo thần tài", "152- Grakk sumo", "153- Grakk tiệc bãi biển", "154- Aleister thiếu niên hắc ám", "155- Aleister quang vinh", "156- Aleister quỷ soái nguyệt tộc", "157- Aleister siêu sao bóng rổ", "158- Aleister âm dương sư", "159- Fennik nhà thám hiểm", "160- Fennik tiệc bánh kẹo", "161- Fennik tuần lộ láu lỉnh", "162- Fennik phi hành gia", "163- Fennik tay đua f1", "164- Lumburr dung nham", "165- Lumburr cự thần viễn cổ", "166- Natalya nghệ nhân lân", "167- Natalya quý cô thủy tề", "168- Natalya phó nháy nhí nhảnh", "169- Natalya quà quái quỷ", "170- Natalya nghiệp hỏa yêu hậu", "171- Natalya băng tâm thần nữ", "172- Natalya nữ quái công nghệ", "173- Cresht thợ sửa cáp", "174- Cresht cá cắn cáp", "175- Cresht đại sư sushi", "176- Jinna đại tư tế", "177- Jinna dạ xoa vương", "178- Jinna hỏa nhãn ma vương", "179- Payna cảnh vệ rừng", "180- Payna nghìn lẻ một đêm", "181- Maloch ác ma địa ngục", "182- Maloch tiệc hóa trang", "183- Maloch samurai tử sĩ", "184- Maloch đại tướng rô bốt", "185- Maloch ông kẹ bí ngô", "186- Maloch ác nhân vô tuyến", "187- Maloch vũ hội bóng đêm", "188- Ngộ Không đạo tặc", "189- Ngộ Không hỏa nhãn kim tinh", "190- Ngộ Không siêu việt", "191- Ngộ Không ngộ khá trẩu", "192- Ngộ Không siêu việt 2.0", "193- Ngộ Không đặc vụ băng hầu", "194- Ngộ Không nhóc tì bá đạo", "195- Ngộ Không tề thiên ma hầu", "196- Kriknak bọ cánh bạc", "197- Kriknak yêu trùng cổ mộ", "198- Kriknak st.l 162", "199- Kriknak bọ cánh cam", "200- Arthur hoàng kim cốt", "201- Arthur lãnh chúa xương", "202- Arthur si tình kiếm", "203- Arthur siêu sao cricket", "204- Arthur đặc cảnh băng lôi", "205- Arthur hiệp sĩ trăng khuyết", "206- Arthur siêu việt", "207- Slimz thỏ thợ mỏ", "208- Slimz chú thỏ ngọc", "209- Slimz xứ sở thần tiên", "210- Slimz thỏ nhồi bông", "211- Ilumia nữ chúa tuyết", "212- Ilumia thần mặt trời", "213- Ilumia hồng hoa hậu", "214- Ilumia thiên nữ áo dài", "215- Ilumia nữ hoàng khí giới", "216- Preyta không tặc", "217- Preyta băng hỏa long sư", "218- Preyta phi cơ f1", "219- Skud sơn tặc", "220- Skud quang vinh", "221- Skud tà linh ma tướng", "222- Raz đại tù trưởng", "223- Raz băng quyền quán quân", "224- Raz chiến thân muay thái", "225- Raz siêu việt", "226- Raz siêu cấp tin tặc", "227- Raz saitama cosplay", "228- Lauriel đọa lạc thiên sứ", "229- Lauriel hỏa phượng hoàng", "230- Lauriel phù thủy bí ngô", "231- Lauriel thánh quang sứ", "232- Lauriel hoa khôi giáng sinh", "233- Lauriel lạc thần", "234- Lauriel tinh vân sứ", "235- Lauriel tiệc bãi biển", "236- Lauriel thiên sứ công nghệ", "237- Batman đôi cánh đại dương", "238- Batman dơi địa ngục", "239- Airi thích khách", "240- Airi ninja xanh lá", "241- Airi quái xế công nghệ", "242- Airi cấm vệ nguyệt tộc", "243- Airi kiemono", "244- Airi bạch kiemono", "245- Airi phó kiếm đạo", "246- Airi tiệc bãi biển", "247- Airi mỵ hồ", "248- Airi đặc công tử điệp", "249- Airi bích hải thánh nữ", "250- Airi lễ hội mùa xuân", "251- Zuka đại phú ông", "252- Zuka giáo sư sừng sỏ", "253- Zuka phát tài", "254- Zuka gấu nhồi bông", "255- Zuka diệt nguyệt nguyên soái", "256- Zuka đầu bếp hoàng cung", "257- Zuka mãnh hổ", "258- Ignis hỏa thuật sư", "259- Ignis quang vinh", "260- Ignis bắc băng vương", "261- Ignis thầy tế mặt trời", "262- Murad thợ săn tiền thưởng", "263- Murad mtp thần tượng học đường", "264- Murad đồ thần đao", "265- Murad siêu việt", "266- Murad thiên tài sân cỏ", "267- Murad điệp viên anubis", "268- Murad đặc dị", "269- Murad siêu việt 2.0", "270- Murad chí tôn thần kiếm", "271- Murad dược sĩ tình yêu", "272- Murad byakuya kuchiki", "273- Zill lốc địa ngục", "274- Zill dung nham", "275- Zill cựu thần thiên hà", "276- Zill diệt nguyệt tử sĩ", "277- Zill thần mộng mị", "278- Arduin cận vệ hoàng gia", "279- Arduin quang vinh", "280- Arduin tà linh hiệp sĩ", "281- Arduin chiến binh cổ đại", "282- Joker trò đùa tử vong", "283- Joker vua hề", "284- Ryoma thợ săn tiền thưởng", "285- Ryoma đại tướng nguyệt tộc", "286- Ryoma thanh long bang chủ", "287- Ryoma samurai huyền thoại", "288- Ryoma dạ hội", "289- Ryoma chiến binh cyborg", "290- Ryoma ultraman", "291- Ryoma đặc nhiệm giáng sinh", "292- Astrid bạch kiếm tiểu thư", "293- Astrid siêu sao bóng chày", "294- Astrid tổ trưởng học đường", "295- Astrid thần thoại hy lạp", "296- Tel`Annas cảnh vệ rừng", "297- Tel`Annas giám thị thân thiện", "298- Tel`Annas chung tình tiễn", "299- Tel`Annas thánh nữ mật hội", "300- Tel`Annas thần sứ F.e.e x1", "301- Tel`Annas cẩm y vệ: phi ưng", "302- Tel`Annas dạ hội", "303- Tel`Annas thứ nguyên vệ thần", "304- Tel`Annas công chúa mộng mơ", "305- Tel`Annas vũ khúc yêu hồ", "306- Tel`Annas tân niên vệ thần", "307- Superman chúa tể công lý", "308- Superman bất công lý", "309- Wonder Woman thế chiến", "310- Xeniel thiên sứ hủy diệt", "311- Xeniel trung vệ thép", "312- Xeniel kim sí điểu", "313- Xeniel tổng lãnh tinh hệ", "314- Xeniel thần thoại hy lạp", "315- Kil`Groth cảnh vệ biển", "316- Kil`Groth quang vinh", "317- Moren anh thợ điện", "318- Moren lính cứu hỏa", "319- TeeMee xiếc cung đình", "320- TeeMee tay đua siêu tốc", "321- TeeMee thần thoại hy lạp", "322- Lindis thám tử tư", "323- Lindis quang thánh tiễn", "324- Lindis quang vinh", "325- Lindis nữ vương pháo hoa", "326- Lindis dạ tiệc", "327- Lindis đồng phục shihakusho", "328- Omen sĩ quan viễn chinh", "329- Omen ám tử đao", "330- Omen quỷ nguyệt tướng", "331- Omen đao phủ tận thế", "332- Omen chiến binh trăng khuyết", "333- Omen thuyền trưởng hải tặc", "334- Omen nhạc sĩ huyền thoại", "335- Tulen nhà thám hiểm", "336- Tulen tân thần thiên hà", "337- Tulen phù thủy kiến tạo", "338- Tulen đông êm đềm", "339- Tulen phó kỷ luật", "340- Tulen tân thần hoàng kim", "341- Tulen chí tôn kiếm thiên", "342- Tulen dạ hội", "343- Tulen thần sứ stl79", "344- Tulen hỏa long thần tộc", "345- Tulen tân niên vệ thần", "346- Liliana hồ quý phi", "347- Liliana thần tượng âm nhạc", "348- Liliana nguyệt mị ly", "349- Liliana tiểu thơ anh đào", "350- Liliana tân nguyệt mị ly", "351- Liliana nữ thần f1", "352- Liliana thủy thủ hồ ly", "353- Liliana wave", "354- Max hiệp sĩ nhí", "355- Max găng tay vàng", "356- Max quang vinh", "357- Max thần đồng sinh hóa", "358- Max thần thoại hy lạp", "359- The Flash tia chớp tương lai", "360- Wisp hải tặc nhí", "361- Wisp thỏ siêu quậy", "362- Wisp ếch nhồi bông", "363- Wisp máy phát quà", "364- Arum thú vệ cổ mộ", "365- Arum vũ khúc long hổ", "366- Arum linh tượng vu nữ", "367- Arum vũ khúc thần sứ", "368- Arum thỏ may mắn", "369- Arum nữ hoàng gấu xám", "370- Arum quản lý tài năng", "371- Rourke pháo thủ tuộc neo", "372- Rourke biệt đội siêu hùng", "373- Rourke cuồng tặc", "374- Marja linh xà tư tế", "375- Marja hỏa ngọc nữ vương", "376- Roxie thám tử tập sự", "377- Roxie kèn ái tình", "378- Roxie hầu gái", "379- Roxie tiệc bánh kẹo", "380- Baldum chú thợ ống nước", "381- Baldum liệt hỏa dung nham", "382- Baldum thần thoại hy lạp", "383- Baldum thế giới kẹo ngọt", "384- Annette nữ quản ga", "385- Annette xứ sở thần tiên", "386- Annette thần tượng âm nhạc", "387- Annette tiệc bãi biển", "388- Annette vân mộng tiên tử", "389- Annette nữ sinh trung học", "390- Amily đặc ảnh nypd", "391- Amily đặc công nhện đỏ", "392- Amily thư ký", "393- Amily thỏ may mắn", "394- Amily võ thần thiên hà", "395- Amily amily quang vinh", "396- Y`bneth hạt trưởng kiểm lâm", "397- Y`bneth chiến binh lục bảo", "398- Elsu cảnh vệ thảo nguyên", "399- Elsu mafia", "400- Elsu guitar tình ái", "401- Elsu chiến binh bóng tối", "402- Elsu sứ giả tận thế", "403- Elsu tuyết ưng", "404- Richter bá tước", "405- Richter thống soái kháng chiến", "406- Richter dạ hội", "407- Richter thần kiếm susanoo", "408- Quillen trưởng ngoại khoa", "409- Quillen đặc công mãng xà", "410- Quillen thống soái đế chế", "411- Quillen huyết thủ nguyệt tộc", "412- Quillen sao đỏ học đường", "413- Quillen tà linh ma đao", "414- Quillen hoàng kim soái vương", "415- Quillen nghịch thiên long đế", "416- Sephera quý tiểu thư", "417- Sephera chiêm tinh gia", "418- Sephera thần tượng âm nhạc", "419- Sephera phi vụ thế kỷ", "420- Sephera thần thoại hy lạp", "421- Florentino vũ kiếm sư", "422- Florentino giám sát tinh hệ", "423- Florentino kiếm sĩ olympic", "424- Florentino thần thoại hy lạp", "425- Florentino seven", "426- Florentino tà long kiếm sĩ", "427- Veres đạo tặc", "428- Veres gián điệp tinh hệ", "429- Veres thần thoại hy lạp", "430- Veres chị đại học đường", "431- Veres thủy thần kiều diễm", "432- D`arcy nam tước", "433- D`arcy đô đốc tinh hệ", "434- D`arcy pháp sư hỏa long", "435- Hayate bạch ảnh", "436- Hayate chiến binh trăng khuyết", "437- Hayate ngân lang", "438- Hayate tử thần vũ trụ", "439- Hayate quỷ diện", "440- Hayate kim ưng sát thủ", "441- Hayate bạch vô thường", "442- Capheny hầu gái", "443- Capheny thần tượng âm nhạc", "444- Capheny toán hóa sinh", "445- Capheny kimono", "446- Capheny siêu cấp tin tặc", "447- Capheny harley quinn", "448- Errol vượt ngục", "449- Errol diệt nguyệt tiên phong", "450- Errol genos", "451- Yena khuyên bạc", "452- Yena thỏ may mắn", "453- Yena chiến binh nguyệt tộc", "454- Yena hoạt náo viên", "455- Yena nữ hoàng thể thao", "456- Yena dạ nguyệt thánh nữ", "457- Yena giảng viên tình ái", "458- Yena wave", "459- Enzo phẩm chất quý tộc", "460- Enzo chiến binh trăng khuyết", "461- Enzo thần thoại hy lạp", "462- Enzo hồng hạc thị vệ", "463- Zip gà siêu quậy", "464- Zip tiểu đệ hổ báo", "465- Qi tiểu long", "466- Qi đặc vụ cáo tuyết", "467- Qi quán quân", "468- Qi thiếu nữ pháo hoa", "469- Celica nữ cao bồi", "470- Volkath dạ huyết tộc", "471- Volkath ma kỵ tử sĩ", "472- Volkath xung thiên thần tướng", "473- Volkath tư lệnh viễn chinh", "474- Krizzix cún siêu quậy", "475- Krizzix đội đặc nhiệm", "476- Eland`orr soái tặc", "477- Eland`orr pphi vụ thế kỷ", "478- Eland`orr học viện carano", "479- Eland`orr siêu thám tử", "480- Ishar giấc mơ ngọt ngào", "481- Ishar tiểu thư kẹo ngọt", "482- Ishar tiểu thư gấu trúc", "483- Ishar lễ hội ma quái", "484- Dirak cảnh vệ bầu trời", "485- Dirak pháp sư trăng khuyết", "486- Dirak quý tộc norman", "487- Dirak ông bầu showbiz", "488- Keera y tá lạ", "489- Keera học viện karano", "490- Keera sát thủ bí ngô", "491- Keera thủy thủ", "492- Keera tiệc bãi biển", "493- Ata tân thủy thủ", "494- Ata cao bồi", "495- Ata quang vinh", "496- Paine khúc nhạc tử vong", "497- Paine phi vụ thế kỷ", "498- Paine công tước máu", "499- Laville tay đua đường phố", "500- Laville tay súng diệt thần", "501- Laville tay súng vô địch", "502- Laville xạ thần tinh vệ", "503- Laville kim quy thần vương", "504- Rouie sứ giả vũ trụ", "505- Rouie tuần lộc đáng yêu", "506- Zata tư lệnh viễn chinh", "507- Zata sứ giả tinh hệ", "508- Zata thần mặt trời", "509- Allain hắc kiếm sĩ kirito", "510- Allain kirito", "511- Allain thần mặt trời", "512- Thorne cận vệ hoàng gia", "513- Thorne giả kim thuật sư", "514- Sinestrea giấc mơ trưa", "515- Sinestrea tiểu thư băng giá", "516- Sinestrea wave", "517- Dextra chiến binh quyến rũ", "518- Dextra quận chúa tuyết", "519- Dextra quý cô tuổi dần", "520- Lorion chiến giáp hắc ám", "521- Bright soái ca thánh điện", "522- Bright khiêu chiến", "523- Bright toshiro hitsugaya", "524- AOI sát thủ đô thị", "525- AOI hoàng kim công chúa", "526- IGGY tiểu hoàng đế", "527- tachi lãng khách", "528- aya hoạt náo viên", "529- YUE tiểu công chúa ",
                    ];

                    $skins_arr = [];
                    foreach ($skins as $key => $value) {
                        foreach ($ten2 as $key2 => $value2) {
                            if ($value == $key2) {
                                $skins_arr[] = $value2;
                                break;
                            }
                        }
                    }
                    $skins_str = implode('|', $skins_arr);
                } else {
                    $skins_str = "";
                }
                $data_game = [

                    'rank' => $rank,
                    'champs' => $champs_str,
                    'champs_count' => $champs_count,
                    'skins' => $skins_str,
                    'skins_count' => $skins_count,
                    'check_page' => 14,
                    'ip_count' => $ip_count
                ];
            } else  if ($type_account == 'Free Fire') {
                //free fire :
                $data_game = [
                    'rank' => $rank,
                    'pet' => $pet,
                    '2fa' => $code_2fa,
                    'source' => $source,
                    'check_page' => 15
                ];
            } else  if ($type_account == 'Pubg') {
                //Pubg mobile :
                $data_game = [
                    'skins_count' => $skins_count,
                    'skins' => $skins,
                    'champs_count' => $champs_count,
                    'champs' => $champs,
                    'rank' => $rank,
                    'pet' => $pet,
                    'source' => $source,
                    'check_page' => 22
                ];
            } else  if ($type_account == 'Liên Minh Huyền Thoại') {
                // echo 1;die;
                //Liên Minh Huyền Thoại :
                if ($source == 0) {
                    $check_page = 18;
                } else if ($source == 1) {
                    $check_page = 19;
                } else if ($source == 2) {
                    $check_page = 20;
                } else if ($source == 3) {
                    $check_page = 21;
                }
                $data_game = [
                    'skins_count' => $skins_count,
                    'champs_count' => $champs_count,
                    'rank' => $rank,
                    'frame' => $frame,
                    'source' => $source,
                    'check_page' => $check_page
                ];
            } else  if ($type_account == 'Fifa') {
                //Fifa:
                $data_game = [
                    'skins' => $skins,
                    'champs' => $champs,
                    'source' => $source,
                    'check_page' => 23
                ];
            } else  if ($type_account == 'Tốc Chiến') {
                //Tốc Chiến:
                $data_game = [
                    'rank' => $rank,
                    'skins_count' => $skins_count,
                    'skins' => $skins,
                    'champs_count' => $champs_count,
                    'ip_count' => $ip_count,
                    'champs' => $champs,
                    'source' => $source,
                    'check_page' => 16
                ];
            } else  if ($type_account == 'CF') {
                //Tốc Chiến:
                $data_game = [
                    'source' => $source,
                    'check_page' => 22
                ];
            } else  if ($type_account == 'Valorant') {
                //Valorant:
                $data_game = [
                    'source' => $source,
                    'check_page' => 22
                ];
            }
            $data_insert = array_merge($data_main, $data_game);

            if ($id_post > 0) {
                unset($data_insert['date_posted']);
                $where_update = [
                    'id_post' => $id_post
                ];
                $update = $this->Account->update($where_update, $data_insert, 'posts');
            } else {
                $id_post = $this->Account->insert($data_insert, 'posts');
            }
            if ($id_post > 0) {
                $status_data_1 = 1;
                if (isset($_FILES['thumb']) && $_FILES['thumb'] !== null && $_FILES['thumb']['name'] !== '') {
                    $filename         = $_FILES['thumb']['name'];
                    $filedata         = $_FILES['thumb']['tmp_name'];
                    $temp            = explode('.', $filename);
                    // $imageThumb 	= new Image($filedata);    
                    $thumb_path        = 'assets/files/thumb/' . $id_post . '.jpg';

                    $imguser = $id_post . '.jpg';
                    $config['file_name'] = $imguser;
                    $config['upload_path'] = 'assets/files/thumb';
                    $config['allowed_types'] = 'jpg|png';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('thumb')) {
                        $error = array('error' => $this->upload->display_errors());
                        $status_data_1 = 0;
                    } else {
                        $imageThumb = new Image($filedata);
                        $imageThumb->resize(375, 200, 'crop');
                        $imageThumb->save($id_post, $config['upload_path'], 'jpg');
                    }
                }
                $status_data = 1;
                if (isset($_FILES['gem']) && $_FILES['gem']['name'] != "" && $total_champs > 1) {
                    $where = [
                        'id_acc' => $id_post
                    ];
                    $detele = $this->Account->delete($where, 'thumb_acc');
                    for ($i = 0; $i < $total_champs; $i++) {

                        $_FILES['data']['name'] = $_FILES['gem']['name'][$i];
                        $_FILES['data']['type'] = $_FILES['gem']['type'][$i];
                        $_FILES['data']['tmp_name'] =  $filedata = $_FILES['gem']['tmp_name'][$i];
                        $_FILES['data']['error'] = $_FILES['gem']['error'][$i];
                        $_FILES['data']['size'] = $_FILES['gem']['size'][$i];

                        $imguser = $id_post . '-' . ($i + 1) . '.jpg';
                        $config['file_name'] = $imguser;
                        $config['upload_path'] = 'assets/files/post';
                        $config['allowed_types'] = 'jpg|png';
                        $config['overwrite'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('data')) {
                            $error = array('error' => $this->upload->display_errors());
                            $status_data = 0;
                            break;
                        } else {
                            $imageThumb = new Image($filedata);
                            $imageThumb->resize(700, 70000);
                            $imageThumb->save($id_post . '-' . ($i + 1), $config['upload_path'], 'jpg');
                            $data_insert = [
                                'id_acc' => $id_post,
                                'img' => 'assets/files/post/' . $id_post . '-' . ($i + 1) . '.jpg'
                            ];
                            $insert = $this->Account->insert($data_insert, 'thumb_acc');
                        }
                    }
                }
                if ($status_data == 1 && $status_data_1 == 1) {

                    setcookie('url_sitemap', '/admin/ds_acc/', time() + 86400, '/');
                    $msg = [
                        'status' => 1,
                        'msg' => 'Đăng acc thành công. Vui lòng liên hệ admin để được duyệt nhanh nhất!'
                    ];
                } else {
                    if ($type_action != 'update') {
                        $where = [
                            'id_post' => $id_post
                        ];
                        $detele_acc = $this->Account->delete($where, 'posts');
                    }
                    $where = [
                        'id_acc' => $id_post
                    ];
                    $detele_img = $this->Account->delete($where, 'thumb_acc');
                    $msg = [
                        'status' => 0,
                        'msg' => 'Lỗi tải ảnh. Vui lòng thử lại!'
                    ];
                }
            }

            echo json_encode($msg);
        }
    }
    public function post_lq_random()
    {
        if (is_admin_vip()) {

            $data['content'] = '/admin/post_lq_random';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_post_ld_random()
    {
        $list_acc = $this->input->post('list_acc');

        $result = explode("\n", $list_acc);
        foreach ($result as $key => $value) {

            $array_list = explode('|', $value);
            $username = $array_list[0];
            $password = $array_list[1];
            $type_account = $this->input->post('type_account');
            if ($type_account == "Liên Quân Free") {
                $price = 0;
                $check_page = 0;
            } else if ($type_account == "Liên Quân Mobile Random 9k") {
                $price = 9000;
                $check_page = 1;
            } else if ($type_account == "Liên Quân Mobile Random 20k") {
                $price = 20000;
                $check_page = 2;
            } else if ($type_account == "Liên Quân Mobile Random 50k") {
                $price = 50000;
                $check_page = 3;
            } else if ($type_account == "Liên Quân Mobile Random 100k") {
                $price = 100000;
                $check_page = 4;
            } else if ($type_account == "Liên Quân Mobile Random 200k") {
                $price = 200000;
                $check_page = 5;
            } else if ($type_account == "Liên Quân Mobile Random 500k") {
                $price = 500000;
                $check_page = 6;
            }
            $price_atm = $price * 0.8;
            if (empty($username) || empty($type_account)) {
                break;
            }
            $data = [
                'username' => $username,
                'password' => $password,
                'price' => $price,
                'price_atm' => $price_atm,
                'type_account' => $type_account,
                'check_page' => $check_page,
                'date_posted' => date('Y-m-d H:i:s'),
                'status' => 0

            ];
            $insert = $this->Account->insert($data, 'posts');
        }
        $msg = [
            'status' => 1,
            'msg' => 'Thành công'
        ];
        echo json_encode($msg);
    }
    public function ls_quay()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            $name = $this->input->get('name');
            $sql = '';
            if ($id > 0) {

                $sql .= " AND id_user = '$id' ";
            }
            if ($name != '') {
                $sql .= " AND name LIKE '%$name%'";
            }
            $total_record = $this->Account->query_sql_num("SELECT history_gift.*,name, gift.type as gift_type,zen FROM history_gift INNER JOIN gift ON history_gift.id_gift = gift.id WHERE 1=1    $sql  ORDER BY history_gift.id DESC");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/ls_quay', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT history_gift.*,name, gift.type as gift_type,zen FROM history_gift INNER JOIN gift ON history_gift.id_gift = gift.id WHERE 1=1    $sql  ORDER BY history_gift.id DESC LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['id'] = $id;
            $data['name'] = $name;
            $data['content'] = '/admin/ls_quay';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function gift()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            $name = $this->input->get('name');
            $sql = '';
            if ($id > 0) {

                $sql .= " AND id = '$id' ";
            }
            if ($name != '') {
                $sql .= " AND name LIKE '%$name%'";
            }
            $total_record = $this->Account->query_sql_num("SELECT * FROM gift WHERE 1=1    $sql  ORDER BY id DESC");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/ls_quay', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT * FROM gift WHERE 1=1    $sql  ORDER BY id DESC LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['id'] = $id;
            $data['name'] = $name;
            $data['content'] = '/admin/ds_gift';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function add_gift()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  gift  WHERE id = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/add_gift';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_add_gift()
    {
        if (is_admin_vip()) {
            $id = $this->input->post('id');
            $name_gift = $this->input->post('name');
            $type = $this->input->post('type');
            $vip = $this->input->post('vip');
            $stt = $this->input->post('stt');
            $zen = $this->input->post('zen');
            $value = $this->input->post('value');
            $value_use = $this->input->post('value_use');
            $type_item = $this->input->post('type_item');
            $des = $this->input->post('des');
            $data = [
                'name' => $name_gift,
                'type' => $type,
                'vip' => $vip,
                'stt' => $stt,
                'type_item' => $type_item,
                'value' => $value,
                'value_use' => $value_use,
                'zen' => $zen,
                'des' => $des
            ];
            if (isset($_FILES['image']) && $_FILES['image']['name'] !== "") {
                $filename         = $_FILES['image']['name'];
                $filedata         = $_FILES['image']['tmp_name'];
                $temp            = explode('.', $filename);
                // $imageThumb 	= new Image($filedata);    
                $thumb_path        = 'assets/img_gift/' . time() . '.jpg';

                $imguser = time() . '.jpg';
                $config['file_name'] = $imguser;
                $config['upload_path'] = 'assets/img_gift';
                $config['allowed_types'] = 'jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $status_data_1 = 0;
                } else {
                    $imageThumb = new Image($filedata);
                    $imageThumb->resize(135, 135, 'crop');
                    $imageThumb->save(time(), $config['upload_path'], 'jpg');
                    $data['image'] = $thumb_path;
                }
            }
            if ($id > 0) {
                $where_update = [
                    'id' => $id
                ];
                $update = $this->Account->update($where_update, $data, 'gift');
            } else {
                $insert = $this->Account->insert($data, 'gift');
            }
            $msg = [
                'status' => 1,
                'msg' => 'thành công'
            ];
        } else {
            $msg = [
                'status' => 0,
                'msg' => 'thất bại'
            ];
        }
        echo json_encode($msg);
    }
    public function ds_blog()
    {
        if (is_admin_vip()) {
            $type = $this->input->get('cate');
            $sql = '';
            if ($type > 0) {

                $sql .= " AND chuyenmuc = '$type' ";
            }
            $total_record = $this->Account->query_sql_num("SELECT * FROM baiviet  WHERE 1=1    $sql  ORDER BY id DESC");
            $page = $this->uri->segment(3);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            pagination('/admin/ds_blog', $total_record, $limit, 3);

            $sql_get_list_buy = "SELECT * FROM baiviet WHERE 1=1    $sql  ORDER BY id DESC LIMIT $start, $limit";
            $data['list'] = $this->Account->query_sql($sql_get_list_buy);
            $data['cate'] = $type;
            $data['content'] = '/admin/ds_blog';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function add_blog()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  baiviet  WHERE id = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/add_blog';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_add_blog()
    {
        if (is_admin_vip()) {
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $alias = $this->input->post('alias');
            $category = $this->input->post('category');
            $sapo = $this->input->post('sapo');
            $content = $this->input->post('content');
            if ($this->input->post('meta_title') == '') {
                $meta_title = $meta_key = $meta_des = $title;
            } else {
                $meta_title = $this->input->post('meta_title');
                $meta_key     = $this->input->post('meta_key');
                $meta_des     = $this->input->post('meta_des');
            }
            if ($alias == '') {
                $alias = vn_str_filter($title);
            } else {
                $alias = vn_str_filter($alias);
            }
            $data_in = [
                'title' => $title,
                'alias' => $alias,
                'chuyenmuc' => $category,
                'sapo' => $sapo,
                'content' => $content,
                'status' => 1,
                'meta_title' => $meta_title,
                'meta_key' => $meta_key,
                'meta_des' => $meta_des,
                'updated_at' => time()
            ];
            if (isset($_FILES['image']) && $_FILES['image']['name'] !== "") {
                $filename         = $_FILES['image']['name'];
                $filedata         = $_FILES['image']['tmp_name'];
                $temp            = explode('.', $filename);
                // $imageThumb 	= new Image($filedata);    
                $thumb_path        = 'assets/img_blog/' . $alias . '.jpg';

                $imguser = $alias . '.jpg';
                $config['file_name'] = $imguser;
                $config['upload_path'] = 'assets/img_blog';
                $config['allowed_types'] = 'jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $imageThumb = new Image($filedata);
                    $imageThumb->resize(375, 200, 'crop');
                    $imageThumb->save($alias, $config['upload_path'], 'jpg');
                    $data_in['image'] = $thumb_path;
                }
            }
            if ($id > 0) {
                $where_update = [
                    'id' => $id
                ];
                $update = $this->Account->update($where_update, $data_in, 'baiviet');
            } else {
                $data_in['created_at'] = time();
                $insert = $this->Account->insert($data_in, 'baiviet');
            }

            setcookie('url_sitemap', '/' . $alias . '/', time() + 86400, '/');
            $msg = [
                'status' => 1,
                'msg' => 'thành công'
            ];
        } else {
            $msg = [
                'status' => 0,
                'msg' => 'thất bại'
            ];
        }
        echo json_encode($msg);
    }
    public function ds_cate()
    { {
            if (is_admin_vip()) {

                $total_record = $this->Account->query_sql_num("SELECT * FROM chuyenmuc    ORDER BY id DESC");
                $page = $this->uri->segment(3);
                if ($page < 1 || $page == '') {
                    $page = 1;
                }
                $limit = 20;
                $start = $limit * ($page - 1);
                pagination('/admin/ds_cate', $total_record, $limit, 3);

                $sql_get_list_buy = "SELECT * FROM chuyenmuc  ORDER BY id DESC LIMIT $start, $limit";
                $data['list'] = $this->Account->query_sql($sql_get_list_buy);
                $data['content'] = '/admin/ds_cate';
                $this->load->view('admin/index', $data);
            } else {
                redirect('/');
            }
        }
    }
    public function add_cate()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  chuyenmuc  WHERE id = $id";
                $data['list'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['id'] = $id;
            }
            $data['id'] = $id;
            $data['content'] = '/admin/add_cate';
            $this->load->view('admin/index', $data);
        } else {
            redirect('/');
        }
    }
    public function ajax_add_cate()
    {
        if (is_admin_vip()) {
            $id = $this->input->post('id');
            $name_category = $this->input->post('name_category');
            $alias = $this->input->post('alias');
            $title = $this->input->post('title');
            $data_in = [
                'name' => $name_category,
                'alias' => $alias,
                'title' => $title,
                'updated_at' => time()
            ];
            if (isset($_FILES['image']) && $_FILES['image']['name'] !== "") {
                $filename         = $_FILES['image']['name'];
                $filedata         = $_FILES['image']['tmp_name'];
                $temp            = explode('.', $filename);
                // $imageThumb 	= new Image($filedata);    
                $thumb_path        = 'assets/user/chuyenmuc/' . time() . '.jpg';

                $imguser = time() . '.jpg';
                $config['file_name'] = $imguser;
                $config['upload_path'] = 'assets/user/chuyenmuc';
                $config['allowed_types'] = 'jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $imageThumb = new Image($filedata);
                    $imageThumb->resize(375, 200, 'crop');
                    $imageThumb->save(time(), $config['upload_path'], 'jpg');
                    $data_in['image'] = $thumb_path;
                }
            }

            if ($id > 0) {
                $where_update = [
                    'id' => $id
                ];
                $update = $this->Account->update($where_update, $data_in, 'chuyenmuc');
            } else {
                $data_in['created_at'] = time();
                $insert = $this->Account->insert($data_in, 'chuyenmuc');
            }
            $msg = [
                'status' => 1,
                'msg' => 'thành công'
            ];
        } else {
            $msg = [
                'status' => 0,
                'msg' => 'thất bại'
            ];
        }
        echo json_encode($msg);
    }
    public function edit_user()
    {
        if (is_admin_vip()) {
            $id = $this->input->get('id');
            if ($id > 0) {
                $sql_get_list_buy = "SELECT * FROM  accounts  WHERE id = $id";
                $data['account'] = $this->Account->query_sql_row($sql_get_list_buy);
                $data['content'] = '/admin/edit_user';
                $data['id'] = $id;
                $this->load->view('admin/index', $data);
            } else {
                redirect('/');
            }
        } else {
            redirect('/');
        }
    }
    public function ajax_edit_user()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $pas = $this->input->post('pass');
        $cash = $this->input->post('cash');
        $zen = $this->input->post('zen');
        $admin = $this->input->post('admin');
        if ($id > 0) {
            $data = [
                'name' => $name,
                'cash' => $cash,
                'zen' => $zen
            ];
            if ($pas != '') {
                $data['password'] = $pas;
            }
            if ($admin == 2) {
                $data['admin'] = 0;
                $data['user_type'] = 1;
            } else if ($admin == 3) {
                $data['admin'] = 0;
                $data['user_type'] = 2;
            } else {
                $data['admin'] = $admin;
                $data['user_type'] = 0;
            }
            $where_update = [
                'id' => $id
            ];
            $update = $this->Account->update($where_update, $data, 'accounts');
            if ($update) {
                if ($admin == 3) {
                    $data_kol['created_at'] = time();
                    $data_kol['updated_at'] = time();
                    $data_kol['id_user'] = $id;
                    $insert = $this->Account->insert($data_kol, 'kol');
                }
                $msg = [
                    'status' => 1,
                    'msg' => 'Cập nhật thành công'
                ];
            } else {
                $msg = [
                    'status' => 0,
                    'msg' => 'Cập nhật bại'
                ];
            }
        } else {
            $msg = [
                'status' => 0,
                'msg' => 'Không có user chỉ định'
            ];
        }
        echo json_encode($msg);
    }
    public function excel_acc_buy()
    {
        $id_post = $this->input->get("id_post");
        $username = $this->input->get("username");
        $start_date = $this->input->get("start_date");
        $end_date = $this->input->get("end_date");
        $source = $this->input->get("source");
        $html_sql = '';

        if (this_source() != 'zendo') {
            $site_name = this_source();
            $html_sql = " AND source LIKE '%$site_name%'  ";
        } else {
            if ($source != '' && $source != 'zendo') {
                $html_sql .= " AND source = '$source' ";
            } else if ($source == 'zendo') {
                $html_sql .= " AND source IS NULL ";
            }
        }
        // echo $start_date;die;
        if ($start_date != '') {
            $html_sql .= " AND history_buy.time >= '$start_date' ";
        }
        if ($end_date != '') {
            $html_sql .= " AND history_buy.time < '$end_date' ";
        }
        if ($id_post > 0) {
            $html_sql .= "AND history_buy.id_post = '$id_post' ";
        }
        if (!empty($username)) {
            $html_sql .= "AND history_buy.name LIKE '%$username%' ";
        }
        $total_record = $this->Account->query_sql("SELECT history_buy.*, source  FROM history_buy  INNER JOIN accounts ON accounts.username = history_buy.username   WHERE history_buy.id != '0'  $html_sql ");
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=giao-dich-$source.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo '<table border="1px solid black">';
        echo '<tr>';
        echo '<td><strong> STT </strong></td>';
        echo '<td><strong> Mã số / Số lượng </strong></td>';
        echo '<td><strong> Tài khoản / loại lượt quay </strong></td>';
        echo '<td><strong> Người mua </strong></td>';
        echo '<td><strong> Giá </strong></td>';
        echo '<td><strong> Thời gian </strong></td>';
        echo '<td><strong> Web </strong></td>';
        echo '</tr>';
        foreach ($total_record as $key => $item) {
            $info = $this->Account->query_sql_row("SELECT * FROM posts WHERE id_post = '" . $item['id_post'] . "' LIMIT 1");
            if ($item['type'] == 1) {
                if ($item['code'] == 'luotquay') {
                    $type = 'Lượt quay acc';
                } else if ($item['code'] == 'luotquay9k') {
                    $type = 'Lượt quay quân huy';
                } else if ($item['code'] == 'luotquay20k') {
                    $type = 'Lượt quay skin';
                }
            } else {
                $type = $info['username'] . '/' . $info['password'];
            }

            echo '<tr>';
            echo '<td>' . ++$key . '</td>';
            echo '<td>' . $item['id_post'] . '</td>';
            echo '<td>' . $type . '</td>';
            echo '<td>' . $item['name'] . '</td>';
            echo '<td>' . $item['price'] . '</td>';
            echo '<td>' . $item['time'] . '</td>';
            echo '<td>' . $item['source'] . '</td>';

            echo '</tr>';
        }
        echo '</table>';
    }
}
