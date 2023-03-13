<?php
class Job extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function get_job_limit($where, $like = '', $start = 0, $limit = '')
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        if ($like != '') {
            $this->db->like('keyword', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('baiviet')->result_array();
    }

}
