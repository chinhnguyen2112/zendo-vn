<?php
class Account extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function get_user_limit($where, $order = '', $like = '', $start = 0, $limit = '')
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
        return $this->db->get('accounts')->result_array();
    }
    public function get_detail_user($where)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        return $this->db->get('accounts')->row_array();
        // echo $this->db->last_query();
    }
    public function check_register($where)
    {
        $this->db->select('*');
        foreach ($where as $key => $val) {
            $this->db->or_where($key, $val);
        }
        return $this->db->get('accounts')->num_rows();
    }
    public function get_luot_quay_free($where)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('history_luotquay_free')->row_array();
    }
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    function update($where, $data, $table)
    {
        $this->db->where($where);
        return  $this->db->update($table, $data);
    }
    public function delete($where, $table)
    {
        return $this->db->delete($table, $where);
    }
    public function update_set($where, $var, $val, $tt, $table)
    {
        $this->db->set($var, $var . $tt . $val, FALSE);
        $this->db->where($where);
        return $this->db->update($table);
        //   echo $this->db->last_query();
    }
    public function check_data($where, $table)
    {
        $this->db->select('*');
        $this->db->where($where);
        return $this->db->get($table)->num_rows();
    }
    public function get_by_id($where, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get($table)->row_array();
        // echo $this->db->last_query();
    }
    public function get_nv_old($where)
    {
        $this->db->select('login_zen.*,login_zen.status as status_nv,type');
        $this->db->join('link_trafic', 'link_trafic.id = login_zen.id_trafic');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by('login_zen.id', 'DESC');
        return $this->db->get('login_zen')->row_array();
    }
    public function get_rand_id($where, $rand, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by($rand, 'RANDOM');
        return $this->db->get($table)->row_array();
    }
    public function get_rand_like_id($where, $rand, $like, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        if ($like == 1) {
            $this->db->like('type_account', 'Liên Quân');
        }
        $this->db->order_by($rand, 'RANDOM');
        return $this->db->get($table)->row_array();
    }
    public function get_kol_or($where, $start, $limit)
    {
        $this->db->select('thue_kol.*,name');
        $this->db->join('accounts', 'accounts.id = thue_kol.id_user');
        if ($where != '') {
            $this->db->or_where($where);
        }
        $this->db->order_by('thue_kol.id', 'DESC');
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('thue_kol')->result_array();
        // echo $this->db->last_query();
    }
    public function get_playdoul($where, $start, $limit)
    {
        $this->db->select('thue_kol.*,name');
        $this->db->join('accounts', 'accounts.id = thue_kol.id_kol');
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->order_by('thue_kol.id', 'DESC');
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('thue_kol')->result_array();
    }
    public function query_sql($sql)
    {
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function query_sql_row($sql)
    {
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function query_sql_num($sql)
    {
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}
