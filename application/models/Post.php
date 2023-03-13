<?php



class Post extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function get_acc_limit($where, $order = '', $like = '', $start = 0, $limit = '')
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        if ($like != '') {
            $this->db->like('username', $like);
        }
        if ($order != '') {
            $this->db->order_by($order);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('posts')->result_array();
    }
    public function get_id($where, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        return $this->db->get($table)->row_array();
    }
    public function get_list($where, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        return $this->db->get($table)->result_array();
    }
    public function get_list_order($where, $order, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by($order, 'DESC');
        return $this->db->get($table)->result_array();
    }
    public function get_id_asc($where, $var, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by($var, 'ASC');
        return $this->db->get($table)->row_array();
    }
    public function get_list_asc($where, $var, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by($var, 'ASC');
        return $this->db->get($table)->result_array();
    }
}
