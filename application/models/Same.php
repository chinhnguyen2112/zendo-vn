<?php



class Same extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function add_data($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    function check($key, $val, $table)
    {
        $this->db->select('id');
        $this->db->where($key, $val);
        return $this->db->get($table)->num_rows();
    }
    function check_this($where, $table)
    {
        $this->db->select('id');
        $this->db->where($where);
        return $this->db->get($table)->num_rows();
    }
    function update($key, $val, $data, $table)
    {
        $this->db->where($key, $val);
        return  $this->db->update($table, $data);
    }
    function update_apply($where, $data, $table)
    {
        $this->db->where($where);
        return  $this->db->update($table, $data);
    }
    function get_table($where, $table)
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
            return $this->db->get($table)->row_array();
        } else {
            return $this->db->get($table)->result_array();
        }
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }
    function update_set($val, $id)
    {
        $this->db->set('cash', 'cash' + (int)$val);
        $this->db->where('id', $id);
        return $this->db->update('user');
    }
    function get_by($where, $table, $like = '', $start = '', $limit = '')
    {
        $this->db->select('*');
        $this->db->where($where);
        if ($like != '') {
            $this->db->like('name', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get($table)->result_array();
    }
    function get_cash_out()
    {
        $this->db->select('cash_out.*,user.name as name_u,name_bank,name_branch,bank.name as name_b,number_bank');
        $this->db->join('user', 'user.name =  cash_out.id_user');
        $this->db->join('bank', 'bank.id_user =  cash_out.id_user');
        return $this->db->get('cash_out')->result_array();
    }
    function get_thongke_all($where)
    {
        $this->db->select('SUM(money) as sum_money,id_user,name');
        $this->db->join('user', 'user.id =  history_money.id_user');
        $this->db->where('history_money.type', 1);
        $this->db->where($where);
        $this->db->group_by("id_user"); // Produces: GROUP BY title
        $this->db->order_by('sum_money', 'DESC');
        $this->db->limit(30);
        return $this->db->get('history_money')->result_array();
    }
    function all_top($where)
    {
        $this->db->select('SUM(money) as sum_money,id_user');
        $this->db->where('type', 1);
        $this->db->where($where);
        $this->db->group_by("id_user"); // Produces: GROUP BY title
        $this->db->order_by('sum_money', 'DESC');
        return $this->db->get('history_money')->result_array();
    }
    function get_table_project($where)
    {
        $this->db->select('*');
        $this->db->where($where);
        return $this->db->get('job')->result_array();
    }
    function get_table_project_doing($project)
    {
        $this->db->select('*');
        $this->db->where([
            'status !=' => 0,
        ]);
        $this->db->where([
            'status !=' => 5,
            'project' => $project,
        ]);
        return $this->db->get('job')->result_array();
    }
    function get_table_error($where, $like = '', $start = '', $limit = '')
    {
        $this->db->select('*');
        $this->db->where($where);
        if ($like != '') {
            $this->db->like('name', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('error')->result_array();
    }
    function get_user()
    {
        $this->db->select('*');
        $this->db->or_where([
            'admin' => 0
        ]);
        $this->db->or_where([
            'admin' => 2
        ]);
        return $this->db->get('user')->result_array();
    }
    function get_nv()
    {
        $this->db->select('*');
        $this->db->or_where([
            'admin' => 1
        ]);
        $this->db->or_where([
            'admin' => 3
        ]);
        $this->db->or_where([
            'admin' => 4
        ]);
        return $this->db->get('user')->result_array();
    }
}
