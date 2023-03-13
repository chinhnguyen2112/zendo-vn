<?php



class Job_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function get_all_job($where, $like = '', $start = '', $limit = '')
    {
        $this->db->select('job.*,name');
        $this->db->join('user', 'user.id = job.id_user');
        if ($where != '') {
            $this->db->where($where);
        }
        if ($like != '') {
            $this->db->like('keyword', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('job')->result_array();
    }
    function check_apply($where, $table)
    {
        $this->db->select('id');
        $this->db->where($where);
        return $this->db->get($table)->num_rows();
    }
    function get_apply($id, $where = '', $like = '', $start = '', $limit = '')
    {
        $this->db->select('job.*, apply_job.created_at as created_apply');
        $this->db->join('job', 'job.id = apply_job.id_job');
        $this->db->where([
            'apply_job.id_user' => $id,
            'apply_job.status' => 0
        ]);
        if ($where != '') {
            $this->db->where($where);
        }
        if ($like != '') {
            $this->db->like('keyword', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('apply_job')->result_array();
    }
    function get_all_apply($id = '', $apply = "", $where = '', $like = '', $start = '', $limit = '')
    {
        $this->db->select('job.*, apply_job.created_at as created_apply,user.name,apply_job.status as status_apply,apply_job.id_user as user_id');
        $this->db->join('job', 'job.id = apply_job.id_job');
        if ($apply != "") {
            $this->db->join('user', 'user.id = apply_job.id_user');
            $this->db->where([
                'job.status <' => 4,
                'job.status !=' => 1,
                'job.status !=' => 2,
                'apply_job.status !=' => 1,
            ]);
            if ($where != '') {
                $this->db->where($where);
            }
            if($_SESSION['UserInfo']['admin'] == 1){
                $this->db->group_start();
                $this->db->or_where('apply_job.status', 0);
                $this->db->or_where('apply_job.status', 2);
                $this->db->group_end();
            }
        } else if ($apply == "") {
            $this->db->join('user', 'user.id = job.id_user');
        }
        if ($id != "") {
            $this->db->where([
                'job.id_user' => $id,
            ]);
        }
        if ($like != '') {
            $this->db->like('keyword', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('created_apply', "DESC");
        return $this->db->get('apply_job')->result_array();
    }
    function get_apply_kh($project, $like = '', $start = '', $limit = '')
    {
        $this->db->select('job.*, apply_job.created_at as created_apply,name,apply_job.status as status_apply,apply_job.id_user as user_id');
        $this->db->join('job', 'job.id = apply_job.id_job');
        $this->db->join('user', 'user.id = job.id_user');
        $this->db->where([
            'apply_job.status' => 3,
            'job.project' => $project,
        ]);
        if ($like != '') {
            $this->db->like('keyword', $like);
        }
        $this->db->order_by('created_apply', "DESC");
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('apply_job')->result_array();
    }
    function get_job_kh($project, $like = '', $start = '', $limit = '')
    {
        $this->db->select('job.*, apply_job.created_at as created_apply,name,apply_job.status as status_apply,apply_job.id_user as user_id');
        $this->db->join('job', 'job.id = apply_job.id_job');
        $this->db->join('user', 'user.id = job.id_user');
        $this->db->where([
            'apply_job.status' => 4,
            'job.project' => $project,
            'job.status' => 5,
        ]);
        if ($like != '') {
            $this->db->like('keyword', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('created_apply', "DESC");
        return $this->db->get('apply_job')->result_array();
    }
    public function get_error_search()
    {
        $this->db->select(['id', 'name']);
        return $this->db->get('error')->result_array();
    }
    public function get_feedback($where)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->order_by('created_at', "DESC");
        $this->db->limit(1);
        return $this->db->get('feedback')->row_array();
    }
}
