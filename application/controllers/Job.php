<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Job extends CI_Controller

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
        $this->load->model('Same');
        $this->load->model('Job_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('func_helper');
        $this->load->library('pagination311');
    }
    public function add_job($id = "")
    {
        if ($id > 0) {
            $where = [
                'id' => $id,
            ];
            $job = $this->Same->get_table($where, 'job');
            if ($job != null) {
                $data = $job;
            } else {
                header('Location: /');
            }
        }
        $data['list_project'] = $this->Same->get_table('', 'project');
        $data['list_user'] = $this->Same->get_user();
        $data['content'] = '/job/add_job';
        $this->load->view('index', $data);
    }
    public function ajax_add_job()
    {
        $id = $_SESSION['UserInfo']['id'];
        $data['keyword'] = $this->input->post('keyword');
        $data['volume_search'] = $this->input->post('volume_search');
        $data['count_text'] = $this->input->post('count_text');
        $data['writing_direction'] = $this->input->post('writing_direction');
        $data['media'] = $this->input->post('media');
        $data['price'] = $this->input->post('price');
        $data['project'] = $this->input->post('project');
        $data['outline'] = $this->input->post('outline');
        $data['url_des'] = $this->input->post('url_des');
        $data['cate'] = $this->input->post('cate');
        $data['type'] = $this->input->post('type');
        $data['deadline'] = strtotime($this->input->post('deadline'));
        $user_apply = $this->input->post('user_apply');
        $data['updated_at'] = time();
        $id_job = $this->input->post('id_job');
        if ($id_job == 0) { // thêm công việc
            $where = [
                'keyword' => $this->input->post('keyword'),
                'project' => $this->input->post('project')
            ];
            $check = $this->Same->check_this($where, 'job');
            if ($check > 0) {
                $response = [
                    'status' => 0,
                    'msg' => 'Dự án này đã có key này. Vui lòng kiểm tra lại!'
                ];
            } else {
                $data['id_user'] = $id;
                $data['created_at'] = time();
                $add = $this->Same->add_data($data, 'job');
                if ($add > 0) {
                    $response = [
                        'status' => 1,
                        'msg' => 'Thêm công việc thành công!'
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'msg' => 'thất bại!'
                    ];
                }
            }
        } else if ($id_job > 0) { // sửa công việc
            $wheres = [
                'keyword' => $this->input->post('keyword'),
                'project' => $this->input->post('project'),
                'id !=' => $id_job
            ];
            $check = $this->Same->check_this($wheres, 'job');
            if ($check > 0) {
                $response = [
                    'status' => 0,
                    'msg' => 'Dự án này đã có key này. Vui lòng kiểm tra lại!'
                ];
            } else {
                if ($user_apply > 0) {
                    $data['user_apply'] = $user_apply;
                    $data['status'] = 1;
                    $data2 = [
                        'id_job' => $id_job,
                        'id_user' => $user_apply,
                        'created_at' => time(),
                        'status' => 1
                    ];
                    $add_apply = $this->Same->add_data($data2, 'apply_job');
                }
                $where = [
                    'id' => $id_job,
                ];
                $job = $this->Same->get_table($where, 'job');
                if ($job != null) {
                    $update = $this->Same->update('id', $id_job, $data, 'job');
                    if ($update) {
                        $response = [
                            'status' => 1,
                            'msg' => 'Cập thật thành công!'
                        ];
                    } else {
                        $response = [
                            'status' => 0,
                            'msg' => 'Thất bại'
                        ];
                    }
                } else {
                    header('Location: /');
                }
            }
        }
        echo json_encode($response);
    }
    public function delete_job()
    {
        $type = $this->input->post('type');
        if ($type == 'id') {
            $id_job = $this->input->post('id');
            $where_del = [
                'id' => $id_job,
            ];
            $delete = $this->Same->delete($where_del, 'job');
        } else {
            $list_id = $this->input->post('list_id');
            foreach (explode(',', $list_id) as $val) {
                $where_del = [
                    'id' => $val,
                ];
                $delete = $this->Same->delete($where_del, 'job');
            }
        }
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
        }
        echo json_encode($response);
    }
    public function list_job()
    {
        $id = $_SESSION['UserInfo']['id'];
        if ($_SESSION['UserInfo']['admin'] == 0 || $_SESSION['UserInfo']['admin'] == 2) { // nếu là CTV
            $key = $this->input->get('keyword');
            $project = $this->input->get('project');
            $date = $this->input->get('date');
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
            if ($project > 0) {
                $where['job.project'] = $project;
            }
            if ($date == 2) {
                $where['deadline >'] = time();
            }
            if ($date == 1) {
                $where['deadline <'] = time();
            }
            $where['status'] = 0;
            var_dump($like);
            $count = $this->Job_model->get_all_job($where, $like);
            $all_job = $this->Job_model->get_all_job($where, $like, $start, $limit);
            pagination('/danh-sach-cong-viec', count($count), $limit);
            $my_job  = [];
            $data['content'] = '/account/list_job';
        } else { // admin và nv
            $key = $this->input->get('keyword');
            $project = $this->input->get('project');
            $status = $this->input->get('status');
            $u_apply = $this->input->get('user');
            $date = $this->input->get('date');
            $cate = $this->input->get('cate');
            $created = strtotime($this->input->get('created'));
            $page = $this->uri->segment(2);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            $like = "";
            $where = [];
            if ($key != '') {
                $like = $key;
            }
            if ($project > 0) {
                $where['job.project'] = $project;
            }
            if ($cate > 0) {
                $where['job.cate'] = $cate;
            }
            if ($u_apply > 0) {
                $where['user_apply'] = $u_apply;
            }
            if ($date == 2) {
                $where['deadline >'] = time();
            }
            if ($date == 1) {
                $where['deadline <'] = time();
            }
            if ($created > 0) {
                $where['job.created_at <'] = $created + 86400;
                $where['job.created_at >'] = $created;
            }
            if ($status > 0) {
                $where['job.status'] = $status;
            }
            if ($status == 8) {
                $where['job.status'] = 0;
            }

            $count = $this->Job_model->get_all_job($where, $like);
            $all_job = $this->Job_model->get_all_job($where, $like, $start, $limit);
            pagination('/danh-sach-cong-viec', count($count), $limit);
            $my_job  = [];
            $data['content'] = '/job/list_job';
        }
        $data['all_job'] = $all_job;
        $data['my_job'] = $my_job;
        $this->load->view('index', $data);
    }
    public function cv_duoc_nhan()
    {
        $key = $this->input->get('keyword');
        $project = $this->input->get('project');
        $status = $this->input->get('status');
        $u_apply = $this->input->get('user');
        $date = $this->input->get('date');
        $cate = $this->input->get('cate');
        $created = strtotime($this->input->get('created'));
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
        if ($project > 0) {
            $where['job.project'] = $project;
        }
        if ($cate > 0) {
            $where['job.cate'] = $cate;
        }
        if ($u_apply > 0) {
            $where['user_apply'] = $u_apply;
        }
        if ($date == 2) {
            $where['deadline >'] = time();
        }
        if ($date == 1) {
            $where['deadline <'] = time();
        }
        if ($status > 0) {
            $where['job.status'] = $status;
        } else {
            $where['job.status >'] = 0;
        }

        if ($created > 0) {
            $where['job.created_at <'] = $created + 86400;
            $where['job.created_at >'] = $created;
        }
        $count = $this->Job_model->get_all_job($where, $like);
        $my_job = $this->Job_model->get_all_job($where, $like, $start, $limit);
        pagination('/cong-viec-da-co-nguoi-nhan', count($count), $limit);

        $data['my_job'] = $my_job;
        $data['content'] = '/job/cv_da_nhan';
        $this->load->view('index', $data);
    }
    public function cv_chua_nhan()
    {
        $key = $this->input->get('keyword');
        $project = $this->input->get('project');
        $date = $this->input->get('date');
        $cate = $this->input->get('cate');
        $created = strtotime($this->input->get('created'));
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
        if ($project > 0) {
            $where['job.project'] = $project;
        }
        if ($cate > 0) {
            $where['job.cate'] = $cate;
        }
        if ($date == 2) {
            $where['deadline >'] = time();
        }
        if ($date == 1) {
            $where['deadline <'] = time();
        }

        if ($created > 0) {
            $where['job.created_at <'] = $created + 86400;
            $where['job.created_at >'] = $created;
        }
        $where['status'] = 0;
        $count = $this->Job_model->get_all_job($where, $like);
        $chua = $this->Job_model->get_all_job($where, $like, $start, $limit);
        pagination('/cong-viec-chua-co-nguoi-nhan', count($count), $limit);
        $data['chua'] = $chua;
        $data['content'] = '/job/cv_chua_nhan';
        $this->load->view('index', $data);
    }
    public function ctv_de_xuat()
    {
        $key = $this->input->get('keyword');
        $project = $this->input->get('project');
        $status = $this->input->get('status');
        $u_apply = $this->input->get('user');
        $date = $this->input->get('date');
        $page = $this->uri->segment(2);
        if ($page < 1 || $page == '') {
            $page = 1;
        }
        $limit = 20;
        $start = $limit * ($page - 1);
        $like = "";
        $where = [];
        if ($key != '') {
            $like = $key;
        }
        if ($project > 0) {
            $where['job.project'] = $project;
        }
        if ($u_apply > 0) {
            $where['apply_job.id_user'] = $u_apply;
        }
        if ($date == 2) {
            $where['deadline >'] = time();
        }
        if ($date == 1) {
            $where['deadline <'] = time();
        }
        if ($status > 0) {
            $where['apply_job.status'] = $status - 1;
        }
        $count = $this->Job_model->get_all_apply('', 1, $where, $like);
        $apply_job = $this->Job_model->get_all_apply('', 1, $where, $like, $start, $limit);
        pagination('/cong-viec-da-nhan', count($count), $limit);

        // $apply_job = $this->Job_model->get_all_apply('', 1);
        $data['apply_job'] = $apply_job;
        $data['content'] = '/job/de_xuat';
        $this->load->view('index', $data);
    }
    public function list_job_apply()
    {
        $id = $_SESSION['UserInfo']['id'];
        if ($_SESSION['UserInfo']['admin'] == 0 || $_SESSION['UserInfo']['admin'] == 2) { // nếu là CTV
            $key = $this->input->get('keyword');
            $project = $this->input->get('project');
            $status = $this->input->get('status');
            $u_apply = $this->input->get('user');
            $date = $this->input->get('date');
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
            if ($project > 0) {
                $where['job.project'] = $project;
            }
            if ($u_apply > 0) {
                $where['user_apply'] = $u_apply;
            }
            if ($date == 2) {
                $where['deadline >'] = time();
            }
            if ($date == 1) {
                $where['deadline <'] = time();
            }
            if ($status > 0) {
                $where['job.status'] = $status;
            } else {
                $where['job.status >'] = 0;
            }
            $where['user_apply'] = $id;
            $count = $this->Job_model->get_all_job($where, $like);
            $my_job = $this->Job_model->get_all_job($where, $like, $start, $limit);
            pagination('/cong-viec-da-nhan', count($count), $limit);
            $data['content'] = '/account/list_job_apply';
            $data['my_job'] = $my_job;
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function list_job_check()
    {
        $id = $_SESSION['UserInfo']['id'];
        if ($_SESSION['UserInfo']['admin'] == 0 || $_SESSION['UserInfo']['admin'] == 2) { // nếu là CTV
            $key = $this->input->get('keyword');
            $project = $this->input->get('project');
            $date = $this->input->get('date');
            $page = $this->uri->segment(2);
            if ($page < 1 || $page == '') {
                $page = 1;
            }
            $limit = 20;
            $start = $limit * ($page - 1);
            $like = "";
            $where = [];
            if ($key != '') {
                $like = $key;
            }
            if ($project > 0) {
                $where['job.project'] = $project;
            }
            if ($date == 2) {
                $where['deadline >'] = time();
            }
            if ($date == 1) {
                $where['deadline <'] = time();
            }
            $count = $this->Job_model->get_apply($id, $where, $like);
            $apply_job = $this->Job_model->get_apply($id, $where, $like, $start, $limit);
            pagination('/cong-viec-da-de-xuat', count($count), $limit);

            $data['content'] = '/account/list_job_check';
            // $apply_job = $this->Job_model->get_apply($id);
            $data['apply_job'] = $apply_job;
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function import()
    {
        $data['content'] = '/job/import_job';
        $this->load->view('index', $data);
    }
    public function import_job()
    {
        error_reporting(0);
        require_once(APPPATH . 'libraries/PHPExcel.php');
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $check = 0;
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $keyword = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $writing_direction = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $volume_search = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $count_text = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $outline = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $media = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $price = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $project = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $date = strtotime(str_replace('/', '-', $worksheet->getCellByColumnAndRow(8, $row)->getValue()));
                    $url = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $cate = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $type = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    if (strtolower($type) == 'post') {
                        $type = 1;
                    } elseif (strtolower($type) == 'page') {
                        $type = 2;
                    } elseif (strtolower($type) == 'category') {
                        $type = 3;
                    } elseif (strtolower($type) == 'dịch vụ') {
                        $type = 4;
                    } else {
                        $check = 3;
                    }

                    $get_pro = $this->Same->get_table(['name' => $project], 'project');
                    if ($get_pro != null) {
                        $project = $get_pro['id'];
                    } else {
                        $check = 1;
                    }

                    $get_cate = $this->Same->get_table(['name' => $cate], 'danhmuc');
                    if ($get_cate != null) {
                        $cate = $get_cate['id'];
                    } else {
                        $check = 2;
                    }
                    $data[] = array(
                        'id_user' => $_SESSION['UserInfo']['id'],
                        'keyword' => $keyword,
                        'writing_direction' => $writing_direction,
                        'count_text' => $count_text,
                        'outline' => $outline,
                        'volume_search' => $volume_search,
                        'media' => $media,
                        'price' => $price,
                        'project' => $project,
                        'deadline' => $date,
                        'created_at' => time(),
                        'updated_at' => time(),
                        'url_des' => $url,
                        'cate' => $cate,
                        'type' => $type
                    );
                }
            }
            if ($check == 1) {
                $response = [
                    'status' => 0,
                    'msg' => 'Có dự án không tồn tại. Vui lòng kiểm tra lại'
                ];
            } else if ($check == 2) {
                $response = [
                    'status' => 0,
                    'msg' => 'Có danh mục không tồn tại. Vui lòng kiểm tra lại'
                ];
            } else if ($check == 3) {
                $response = [
                    'status' => 0,
                    'msg' => 'Dạng bài viết không hợp lệ. Vui lòng chọn dạng post, page, category hoặc dịch vụ'
                ];
            } else {
                $wheres = [
                    'keyword' => $keyword,
                    'project' => $project
                ];
                $check_trung = $this->Same->check_this($wheres, 'job');
                if ($check_trung > 0) {
                    $response = [
                        'status' => 0,
                        'msg' => 'Có dự án bị trùng key. Vui lòng kiểm tra lại!'
                    ];
                } else {
                    foreach ($data as $val) {
                        $add = $this->Same->add_data($val, 'job');
                    }
                    $response = [
                        'status' => 1,
                        'msg' => 'Thêm thành công!'
                    ];
                }
            }
            echo json_encode($response);
        }
    }
    public function apply_job()
    {
        $id_job = $this->input->post('id');
        $id = $_SESSION['UserInfo']['id'];
        $type = $this->input->post('type');
        $data = [
            'id_job' => $id_job,
            'id_user' => $id
        ];
        if ($type == 'add') {
            $check = $this->Job_model->check_apply($data, 'apply_job');
            if ($check > 0) {
                $response = [
                    'status' => 0,
                    'msg' => 'Bạn đã đền xuất nhận công việc này rồi!'
                ];
            } else {


                $data['created_at'] = time();
                $data['status'] = 0;
                $add = $this->Same->add_data($data, 'apply_job');
                if ($add > 0) {
                    $response = [
                        'status' => 1,
                        'msg' => 'Lời đề xuất đã được gửi đến amdin!'
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'msg' => 'thất bại!'
                    ];
                }
            }
        } elseif ($type == 'del') {
            $delete = $this->Same->delete($data, 'apply_job');
            if ($delete > 0) {
                $response = [
                    'status' => 1,
                    'msg' => 'Lời đề xuất đã được hủy bỏ!'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'thất bại!'
                ];
            }
        }
        echo json_encode($response);
    }
    public function check_apply()
    {
        $id_job = $this->input->post('id_job');
        $id_user = $this->input->post('id_user');
        $type = $this->input->post('type');
        if ($type == 0 || $type == 4) { // chấp nhận ứng tuyển // 4 là set ctv
            $where = [
                'id' => $id_job,
            ];
            $check = $this->Same->get_table($where, 'job');
            if ($check['user_apply'] > 1 && $type == 0) {
                $response = [
                    'status' => 0,
                    'msg' => 'Công việc này đã có người nhận rồi!'
                ];
            } else {
                $data = [
                    'status' => 2,
                    'user_apply' => $id_user,
                ];
                $update = $this->Same->update('id', $id_job, $data, 'job');
                if ($update) {
                    if ($type == 4) {

                        $data2 = [
                            'id_job' => $id_job,
                            'id_user' => $id_user,
                            'created_at' => time(),
                            'status' => 1
                        ];
                        $add_apply = $this->Same->add_data($data2, 'apply_job');
                    } else {
                        $where_apply = [
                            'id_job' => $id_job,
                            'id_user' => $id_user,
                        ];
                        $data_applys = [
                            'status' => 1,
                        ];
                        $update_applys = $this->Same->update_apply($where_apply, $data_applys, 'apply_job');
                    }
                    $where_del = [
                        'id_job' => $id_job,
                        'id_user != ' => $id_user
                    ];
                    $delete = $this->Same->delete($where_del, 'apply_job');
                    $response = [
                        'status' => 1,
                        'msg' => 'Cập thật thành công!'
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'msg' => 'Thất bại'
                    ];
                }
            }
        } else if ($type == 1) { // Xóa đề xuất ứng tuyển
            $where = [
                'id' => $id_job,
            ];
            $check = $this->Same->get_table($where, 'job');
            if ($check['user_apply'] > 1) {
                $response = [
                    'status' => 0,
                    'msg' => 'Công việc này đã có người nhận rồi!'
                ];
            } else {
                $where_del = [
                    'id_job' => $id_job,
                    'id_user' => $id_user
                ];
                $delete = $this->Same->delete($where_del, 'apply_job');
                if ($delete) {
                    $response = [
                        'status' => 1,
                        'msg' => 'Đã từ chối!'
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'msg' => 'Thất bại!'
                    ];
                }
            }
        } else if ($type == 2) { // Bài đã đạt yêu cầu

            $amount = $this->input->post('amount');
            if ($amount > 0) {
                $where_del = [
                    'id_job' => $id_job,
                    'id_user' => $id_user
                ];
                $data_apply = [
                    'status' => 3,
                ];
                $update_apply = $this->Same->update_apply($where_del, $data_apply, 'apply_job');
                if ($update_apply) {
                    $data = [
                        'status' => 4,                       'amount_text' => $amount
                    ];
                    $update = $this->Same->update('id', $id_job, $data, 'job');
                    $response = ['status' => 1,                       'msg' => 'Bài viết đã hoàn thành!'];
                } else {
                    $response = [
                        'status' => 0,
                        'msg' => 'Thất bại!'
                    ];
                }
            }
        } else if ($type == 3) { // Duyệt k qua khách hàng

            $amount = $this->input->post('amount');
            $id = $_SESSION['UserInfo']['id'];

            if ($amount > 0) {
                $data_job = [
                    'status' => 5,
                    'amount_text' => $amount
                ];
                $update_job = $this->Same->update('id', $id_job, $data_job, 'job');
                $datas = [
                    'status' => 4,
                ];
                $update = $this->Same->update('id_job', $id_job, $datas, 'apply_job');
                $where = [
                    'id' => $id_job,
                ];
                $get_user = $this->Same->get_table(['id' => $id_user], 'user');
                $get_job = $this->Same->get_table($where, 'job');
                $money = ($get_job['amount_text'] / 1000) * $get_job['price'];
                $cash = $money + $get_user['cash'];
                // echo $cash;
                // die;
                $data_cash = [
                    'cash' => $cash
                ];
                $update = $this->Same->update('id', $id_user, $data_cash, 'user'); //  cộng tiền
                $data_add = [
                    'id_user' => $id_user,
                    'id_check' => $id,
                    'created_at' => time(),
                    'type' => 1,
                    'money' => $money
                ];
                $add = $this->Same->add_data($data_add, 'history_money'); // thêm vào bảng lich sử cộng trừ tiền
                $response = [
                    'status' => 1,
                    'msg' => 'Bài viết đã hoàn thành!'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Số từ không hợp lệ'
                ];
            }
        }
        echo json_encode($response);
    }
    public function change_status()
    {
        $id_job = $this->input->post('id_job');
        $id = $_SESSION['UserInfo']['id'];
        $type = $this->input->post('type');
        if ($type == 2 || $type == 6) { // chuyển qua đang viết
            $data = [
                'id' => $id_job,
                'user_apply' => $id
            ];
            $check = $this->Job_model->check_apply($data, 'job');
            if ($check > 0) {
                $status = $type + 1;
                $data_up['updated_at'] = time();
                $data_up['status'] = $status;
                if ($type == 2) {
                    $data_up['link'] = $this->input->post('inp_link');
                    $data_up['amount_text'] = $this->input->post('count_amount');
                }
                $update = $this->Same->update('id', $id_job, $data_up, 'job');
                if ($update) {
                    if ($type == 2) {
                        $data_add['id_job'] = $id_job;
                        $data_add['id_user'] = $id;
                        $data_update['created_at'] = time();
                        $data_update['status'] = 2;
                        $up_apply = $this->Same->update('id_job', $id_job, $data_update, 'apply_job');
                    }
                    $response = [
                        'status' => 1,
                        'msg' => ($status == 2) ? 'Chuyển trạng thái thành công!' : 'Chuyển trạng thái thành công! Vui lòng liện hệ admin để được duyệt bài sớm nhất'
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'msg' => 'thất bại!'
                    ];
                }
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Dây không phải công việc của bạn!'
                ];
            }
        }
        echo json_encode($response);
    }
    public function success_job()
    {
        $id_job = $this->input->post('id_job');
        $id_user = $this->input->post('id_user');
        $id = $_SESSION['UserInfo']['id'];
        $data_job = [
            'status' => 5,
        ];
        $update_job = $this->Same->update('id', $id_job, $data_job, 'job');
        $data = [
            'status' => 4,
        ];
        $update = $this->Same->update('id_job', $id_job, $data, 'apply_job');
        $where = [
            'id' => $id_job,
        ];
        $get_user = $this->Same->get_table(['id' => $id_user], 'user');
        $get_job = $this->Same->get_table($where, 'job');
        $money = ($get_job['amount'] / 1000) * $get_job['price'];
        $cash = $money + $get_user['cash'];
        // echo $cash;
        // die;
        $data_cash = [
            'cash' => $cash
        ];
        $update = $this->Same->update('id', $id_user, $data_cash, 'user'); //  cộng tiền
        $data_add = [
            'id_user' => $id_user,
            'id_check' => $id,
            'created_at' => time(),
            'type' => 1,
            'money' => $money
        ];
        $add = $this->Same->add_data($data_add, 'history_money'); // thêm vào bảng lich sử cộng trừ tiền
        $response = [
            'status' => 1,
            'msg' => 'Bài viết đã hoàn thành!'
        ];


        echo json_encode($response);
    }
    public function cv_hoan_thanh()
    {

        $id = $_SESSION['UserInfo']['id'];
        if ($_SESSION['UserInfo']['admin'] == 4) {
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
            $wheres = [
                'id' => $id
            ];
            $user = $this->Same->get_table($wheres, 'user');
            $count = $this->Job_model->get_job_kh($user['project'], $like);
            $my_job = $this->Job_model->get_job_kh($user['project'], $like, $start, $limit);
            pagination('/cong-viec-da-hoan-thanh', count($count), $limit);
            $data['my_job'] = $my_job;




            $data['content'] = '/job/list_job_kh';
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function cv_can_kh_duyet()
    {

        $id = $_SESSION['UserInfo']['id'];
        if ($_SESSION['UserInfo']['admin'] == 4) {
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
            $wheres = [
                'id' => $id
            ];
            $user = $this->Same->get_table($wheres, 'user');
            $count = $this->Job_model->get_apply_kh($user['project'], $like);
            $apply_job = $this->Job_model->get_apply_kh($user['project'], $like, $start, $limit);
            pagination('/cong-viec-da-hoan-thanh', count($count), $limit);
            $data['apply_job'] = $apply_job;
            $data['content'] = '/job/cv_can_kh_duyet';
            $this->load->view('index', $data);
        } else {
            header('Location: /');
        }
    }
    public function danhmuc()
    {
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
            '1' => 1
        ];
        $count = $this->Same->get_by($where, 'danhmuc', $like);
        $danhmuc = $this->Same->get_by($where, 'danhmuc', $like, $start, $limit);
        pagination('/danh-muc', count($count), $limit);
        $data['danhmuc'] =  $danhmuc;
        $data['content'] = '/job/ds_danhmuc';
        $this->load->view('index', $data);
    }
    public function add_danhmuc($id = '')
    {
        if ($id > 0) {
            $where = [
                'id' => $id
            ];
            $data = $this->Same->get_table($where, 'danhmuc');
        }
        $data['content'] = '/job/add_danhmuc';
        $this->load->view('index', $data);
    }
    public function ajax_danhmuc($id = '')
    {
        $name = $this->input->post('name');
        $id = $this->input->post('id');
        $data = [
            'name' =>  $name,
            'created_at' => time(),
        ];
        if ($id > 0) {
            $where = [
                'name' => $name,
                'id !=' => $id
            ];
            $check = $this->Same->check_this($where, 'danhmuc');
        } else {
            $check = $this->Same->check('name', $name, 'danhmuc');
        }
        if ($check > 0) {
            $response = [
                'status' => 0,
                'msg' => 'Danh mục này đã tồn tại!'
            ];
        } else {
            if ($id > 0) {
                $add = $this->Same->update('id', $id, $data, 'danhmuc');
            } else {
                $add = $this->Same->add_data($data, 'danhmuc');
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
    public function delete_danhmuc()
    {
        $id = $this->input->post('id');


        if ($id > 0) {
            $where = [
                'id' => $id,
            ];
            $delete = $this->Same->delete($where, 'danhmuc');
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
    public function ajax_detail()
    {
        $id_job = $this->input->post('id');
        $where = [
            'job.id' => $id_job,
        ];
        $all_job = $this->Job_model->get_all_job($where);

        $response = [
            'status' => 0,
            'mes' => 'Thất bại'
        ];
        if ($all_job != null) {
            $job = $all_job[0];
            $where_pro = [
                'id' => $job['project'],
            ];
            $this_project = $this->Same->get_table($where_pro, 'project');
            $where_danhmuc = [
                'id' => $job['cate'],
            ];
            $this_cate = $this->Same->get_table($where_danhmuc, 'danhmuc');
            $cate = ($this_cate == null) ? "Không có" : $this_cate['name'] ;
            if ($job['type'] == 1) {
                $theloai =  'Post';
            } else if ($job['type'] == 2) {
                $theloai =  'Page';
            } else if ($job['type'] == 3) {
                $theloai =  'Category';
            } else if ($job['type'] == 4) {
                $theloai =  'Dịch vụ';
            } else {
                $theloai =  'null';
            }
            if ($job['status'] == 0) {
                $status = 'Chưa ai nhận';
            } elseif ($job['status'] == 1 || $job['status'] == 2) {
                $status = "Đang viết";
            } elseif ($job['status'] == 3) {
                $status = "chờ duyệt";
            } elseif ($job['status'] == 4) {
                $status = "Đang bàn giao cho khách";
            } elseif ($job['status'] == 5) {
                $status = "Hoàn thành";
            } elseif ($job['status'] == 6) {
                $status = "Yêu cầu sửa lại";
            } elseif ($job['status'] == 7) {
                $status = "Đang sửa";
            }
            if ($job['deadline'] < time()) {
                $deadline =  '<span class="delete_job"> Đã hết hạn ' . date('d-m-Y', $job['deadline']) . '</span>';
            } else {
                $deadline =  date('d-m-Y', $job['deadline']);
            }
            $html = '<p class="text_detail keyword"><span class="name_detail">Key Word: </span><span class="des_detail">' . $job['keyword'] . '</span></p>';
            $html .= '<p class="text_detail duan"><span class="name_detail">Dự án: </span><span class="des_detail">' .$this_project['name'] . '</span></p>';
            $html .= '<p class="text_detail danhmuc"><span class="name_detail">Danh mục: </span><span class="des_detail">' .$cate. '</span></p>';
            $html .= '<p class="text_detail theloai"><span class="name_detail">Thể loại: </span><span class="des_detail">' . $theloai . '</span></p>';
            $html .= '<p class="text_detail trangthai"><span class="name_detail">Trạng thái: </span><span class="des_detail">' . $status . '</span></p>';
            $html .= '<p class="text_detail nguoidang"><span class="name_detail">Người đăng: </span><span class="des_detail">' . $job['name'] . '</span></p>';
            $html .= '<p class="text_detail deadline"><span class="name_detail">Ngày đăng: </span><span class="des_detail">' . date('d-m-Y',$job['created_at']) . '</span></p>';
            $html .= '<p class="text_detail deadline"><span class="name_detail">Ngày hết hạn: </span><span class="des_detail">' . $deadline . '</span></p>';
            $html .= '<p class="text_detail gia"><span class="name_detail">Giá (1000 từ): </span><span class="des_detail">' . $job['price'] . '</span></p>';
            $html .= '<p class="text_detail volume"><span class="name_detail">Lượng tìm kiếm: </span><span class="des_detail">' . $job['volume_search'] . '</span></p>';
            $html .= '<p class="text_detail volume"><span class="name_detail">Số từ dự kiến: </span><span class="des_detail">' . $job['count_text'] . '</span></p>';
            $html .= '<p class="text_detail volume"><span class="name_detail">Số từ đã viết: </span><span class="des_detail">' . $job['amount_text'] . '</span></p>';
            $html .= '<p class="text_detail huongviet"><span class="name_detail">Hướng viết: </span><span class="des_detail">' . $job['writing_direction'] . '</span></p>';
            $html .= '<p class="text_detail outline"><span class="name_detail">Outline: </span><span class="des_detail"><a href="' . $job['outline'] . '" target="_blank">
            ' . $job['outline']. '
            </a></span></p>';
            $html .= '<p class="text_detail media"><span class="name_detail">Media: </span><span class="des_detail">' . $job['media'] . '</span></p>';
            $html .= '<p class="text_detail url_des"><span class="name_detail">Mô tả: </span><span class="des_detail"><a href="' . $job['url_des'] . '" target="_blank">
            ' . $job['url_des'] . '
            </a></span></p>';
            $response = [
                'status' => 1,
                'html' => $html
            ];
        }
        echo json_encode($response);
    }
}
