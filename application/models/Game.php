<?php
class Game extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function get_game_limit($where, $like = '', $start = 0, $limit = '')
    {
        $this->db->select('*');
        if ($where != '') {
            $this->db->where($where);
        }
        if ($like != '') {
            $this->db->like('username', $like);
        }
        if ($limit > 1) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('game_bq')->result_array();
    }
    public function get_xsmb($where)
    {
        $this->db->select('ve_so.*,name');
        $this->db->join('accounts', 'accounts.id = ve_so.id_user');
        if ($where != '') {
            $this->db->where($where);
        }
        return $this->db->get('ve_so')->result_array();
    }
    public function get_history_random($id)
    {
        $this->db->select('history_gift.*,name,gift.type as gift_type,zen');
        $this->db->join('gift', 'gift.id = history_gift.id_gift');
        $this->db->where([
            'history_gift.id_user' => $id,
            'type_use' => 0
        ]);
        $this->db->order_by('history_gift.id', 'DESC');
        return $this->db->get('history_gift')->result_array();
    }
    public function search_list($where, $like, $start, $limit)
    {
        $this->db->select('*');
        $this->db->where($where);
        if ($like != '') {
            $this->db->group_start();
            $this->db->like('id_post', $like);;
            $this->db->or_like('username', $like);
            $this->db->group_end();
        }
        $this->db->order_by('id_post', 'DESC');
        if ($limit > 0) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get('posts')->result_array();
    }
    public function search_money($where)
    {
        $this->db->select_sum('price_atm');
        $this->db->where($where);
        $this->db->group_by('user_id');
        return $this->db->get('posts')->row_array();
    }
}
