<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Error_ctr extends CI_Controller

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


        $this->load->model('Account_model');
        $this->load->model('Job_model');
        $this->load->model('Same');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('func_helper');
        $this->load->library('pagination311');
    }
    public function type_error($id = '')
    {
        if ($_SESSION['UserInfo']['admin'] == 1 || $_SESSION['UserInfo']['admin'] == 3) {
            if ($id > 0) {
                $where = [
                    'id' => $id
                ];
                $data =  $this->Same->get_table($where, 'error');
            }
            $data['content'] = '/errors/type_error';
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function error($id = '')
    {
        if ($_SESSION['UserInfo']['admin'] == 1 || $_SESSION['UserInfo']['admin'] == 3) {
            if ($id > 0) {
                $where = [
                    'id' => $id
                ];
                $data =  $this->Same->get_table($where, 'error');
            }
            $wheres = [
                'parent' => 0
            ];
            $data['list_parent'] =  $this->Same->get_table_error($wheres);
            $data['content'] = '/errors/error';
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function add_error()
    {
        $name = $this->input->post('name');
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $data = [
            'name' =>  $name,
            'created_at' => time(),
        ];
        if ($type == 0) {
            $data['parent'] = $this->input->post('type_error');
        }
        if ($id > 0) {
            $where = [
                'name' => $name,
                'id !=' => $id
            ];
            $check = $this->Same->check_this($where, 'error');
        } else {
            $check = $this->Same->check('name', $name, 'error');
        }
        if ($check > 0) {
            $response = [
                'status' => 0,
                'msg' => 'Lỗi này đã tồn tại!'
            ];
        } else {
            if ($id > 0) {
                $add = $this->Same->update('id', $id, $data, 'error');
            } else {
                $add = $this->Same->add_data($data, 'error');
            }
            if ($add > 0) {

                $response = [
                    'status' => 1,
                    'msg' => ($id > 0) ? 'Cập nhật thành công' : 'Thêm mới thành công'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Thất bại'
                ];
            }
        }

        echo json_encode($response);
    }
    public function list_error()
    {
        if ($_SESSION['UserInfo']['admin'] == 1 || $_SESSION['UserInfo']['admin'] == 3) {
            $key = $this->input->get('keyword');
            $type = $this->input->get('type');
            $page = $this->uri->segment(2);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            $like = "";
            if ($key != '') {
                $like = $key;
            }
            if ($type > 0) {
                $where = [
                    'parent'  => $type
                ];
            } else {
                $where = [
                    'parent >'  => 0
                ];
            }
            $count = $this->Same->get_table_error($where, $like);
            $error = $this->Same->get_table_error($where, $like, $start, $limit);
            pagination('/danh-sach-loi', count($count), $limit);

            $data['error'] =  $error;
            $data['content'] = '/errors/list_error';
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function list_type_error()
    {
        if ($_SESSION['UserInfo']['admin'] == 1 || $_SESSION['UserInfo']['admin'] == 3) {
            $key = $this->input->get('keyword');
            $page = $this->uri->segment(2);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            $like = "";
            if ($key != '') {
                $like = $key;
            }
            $where = [
                'parent' => 0
            ];
            $count = $this->Same->get_table_error($where, $like);
            $error = $this->Same->get_table_error($where, $like, $start, $limit);
            pagination('/danh-sach-loai-loi', count($count), $limit);

            $data['error'] =  $error;
            $data['content'] = '/errors/list_type_error';
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }


    public function del_error()
    {
        $id = $this->input->post('id');


        if ($id > 0) {
            $where = [
                'id' => $id,
            ];
            $delete = $this->Same->delete($where, 'error');
            if ($delete) {
                $response = [
                    'status' => 1,
                    'msg' => 'Xóa thành công!'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Thất bại'
                ];
            };
        } else {
            $response = [
                'status' => 0,
                'msg' => 'Thất bại'
            ];
        }


        echo json_encode($response);
    }
    public function all_error()
    {
        $result['error'] =    $this->Job_model->get_error_search();
        echo json_encode($result);
    }
    public function check_error()
    {
        $key = $this->input->post('key');
        $check = $this->Same->check('id', $key, 'error');
        if ($check > 0) {
            $error =  $this->Same->get_table(['id' => $key], 'error');
            $response = [
                'status' => 1,
                'id' => $error['id'],
                'name' => $error['name']
            ];
        } else {
            $response = [
                'status' => 0,
                'msg' => 'Không tồn tại lỗi này!'
            ];
        }
        echo json_encode($response);
    }
    public function ajax_error()
    {
        $list = $this->input->post('list');
        $id_job = $this->input->post('job');
        $text = $this->input->post('text');
        $data = [
            'status' => 6,
        ];
        $update = $this->Same->update('id', $id_job, $data, 'job');


        $data_error = [
            'id_job' => $id_job,
            'id_user' => $_SESSION['UserInfo']['id'],
            'text' => $text,
            'error' => $list,
            'created_at' => time(),
            'updated_at' => time()
        ];
        $add = $this->Same->add_data($data_error, 'feedback');
        if ($add > 0) {
            $response = [
                'status' => 1,
                'msg' => 'Đã gửi yêu cầu sửa!'
            ];
        } else {
            $response = [
                'status' => 0,
                'msg' => 'Thất bại'
            ];
        }
        echo json_encode($response);
    }
    public function get_feedback()
    {
        $id_job = $this->input->post('id_job');


        $feedback =  $this->Job_model->get_feedback(['id_job' => $id_job]);
        $get_user =  $this->Same->get_table(['id' => $feedback['id_user']], 'user');
        $name = $get_user['name'];
        if ($get_user['admin'] == 1) {
            $vtri = 'Admin';
        } elseif ($get_user['admin'] == 3) {
            $vtri = 'Nhân viên nội bộ';
        } elseif ($get_user['admin'] == 4) {
            $vtri = 'Khách hàng';
        }
        $error = explode(',', $feedback['error']);
        $html = '';
        foreach ($error as $key => $val) {
            $get_error =  $this->Same->get_table(['id' => $val], 'error');
            $html .= '<div class="this_error"><span>' . $get_error['name'] . '</span></div>';
        }
        $response = [
            'status' => 1,
            'html' => $html,
            'feedback' => $feedback['text'],
            'name' => $name,
            'vtri' => $vtri,
            'msg' => 'Đã gửi yêu cầu sửa!'
        ];


        echo json_encode($response);
    }
    public function his_error($id)
    {
        if ($_SESSION['UserInfo']['admin'] == 0 || $_SESSION['UserInfo']['admin'] == 2) {
            if ($_SESSION['UserInfo']['id'] != $id) {
                header('Location: /');
            }
        }
        $key = $this->input->get('keyword');
        $project = $this->input->get('project');
        $duyet = $this->input->get('duyet');
        $type = $this->input->get('type');
        $errors = $this->input->get('error');
        $page = $this->uri->segment(3);
        if ($page < 1 || $page == '') {
            $page = 1;
        }
        $limit = 2;
        $start = $limit * ($page - 1);
        $like = "";
        $list = [];
        $where = [];
        if ($key != '') {
            $like = $key;
        }
        if ($project > 0) {
            $where['job.project'] = $project;
        }
        if ($duyet > 0) {
            $where['feedback.id_user'] = $duyet;
        }
        if ($type > 0) {
            $wheres = [
                'parent' => $type
            ];
            $list  =  $this->Same->get_table_error($wheres);
        }
        $count = $this->Account_model->get_error_user($id, $where, $list, $errors, $like);
        $feedback = $this->Account_model->get_error_user($id, $where, $list, $errors, $like, $start, $limit);
        pagination('/lich-su-loi/' . $id, count($count), $limit, 3);



        foreach ($feedback as $key => $val) {
            $error = explode(',', $val['error']);
            $array = [];
            foreach ($error as $key1 => $val1) {
                $get_error =  $this->Same->get_table(['id' => $val1], 'error');
                array_push($array, $get_error['name']);
            }
            $feedback[$key]['list_er'] = $array;
        }
        $data['feedback'] = $feedback;
        $data['id_u_list'] = $id;
        $data['content'] = '/errors/his_error';
        $this->load->view('index', $data);
    }
    public function list_feedback()
    {
        $key = $this->input->get('keyword');
        $project = $this->input->get('project');
        $duyet = $this->input->get('duyet');
        $user = $this->input->get('user');
        $type = $this->input->get('type');
        $errors = $this->input->get('error');
        $page = $this->uri->segment(2);
        if ($page < 1 || $page == '') {
            $page = 1;
        }
        $limit = 20;
        $start = $limit * ($page - 1);
        $like = "";
        $list = [];
        $where = [];
        if ($key != '') {
            $like = $key;
        }
        if ($project > 0) {
            $where['job.project'] = $project;
        }
        if ($duyet > 0) {
            $where['feedback.id_user'] = $duyet;
        }
        if ($user > 0) {
            $where['job.user_apply'] = $user;
        }
        if ($type > 0) {
            $wheres = [
                'parent' => $type
            ];
            $list  =  $this->Same->get_table_error($wheres);
        }
        $count = $this->Account_model->get_error_user('', $where, $list, $errors, $like);
        $feedback = $this->Account_model->get_error_user('', $where, $list, $errors, $like, $start, $limit);
        pagination('/thong-ke-loi', count($count), $limit);

        // $feedback =  $this->Account_model->get_error_user();


        foreach ($feedback as $key => $val) {
            $error = explode(',', $val['error']);
            $array = [];
            foreach ($error as $key1 => $val1) {
                $get_error =  $this->Same->get_table(['id' => $val1], 'error');
                array_push($array, $get_error['name']);
            }
            $feedback[$key]['list_er'] = $array;
            $get_user =  $this->Same->get_table(['id' => $val['user_apply']], 'user');
            $feedback[$key]['email'] = $get_user['email'];
            $feedback[$key]['name_apply'] = $get_user['name'];
        }
        $data['feedback'] = $feedback;
        $data['content'] = '/errors/thongkeloi';
        $this->load->view('index', $data);
    }
    public function get_error()
    {
        $error_id = $this->input->post('id');
        if ($error_id > 0) {
            $where = [
                'parent' => $error_id
            ];
            $error =  $this->Same->get_table_error($where);
        } else {
            $error = [];
        }

        echo json_encode($error);
    }
}
