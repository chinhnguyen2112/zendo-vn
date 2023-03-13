<?php
class Messagemodel extends CI_model
{
	public function ownerDetails()
	{
		if (check_login()) {
			$this->db->select('id,name,phone,time,address,avatar,user_type');
			$this->db->where('id', $_SESSION['user']['id']);
			$res = $this->db->get('accounts')->result_array();
			return $res;
		}
	}
	public function allUser()
	{
		if (check_login()) {
			$mysession = $_SESSION['user']['id'];
			$this->db->select('id,name,phone,time,address,avatar,user_type');
			if (!is_playdoul()) {
				$this->db->where('user_type', 2);
			}
			$this->db->where('id != ', $mysession);
			$data = $this->db->get('accounts');
			if ($data->num_rows() > 0) {
				return $data->result_array();
			} else {
				return false;
			}
		}
	}
	public function list_user($where)
	{
		if (check_login()) {
			$this->db->select('id,name,phone,time,address,avatar,user_type');
			$this->db->where($where);
			$data = $this->db->get('accounts');
			if ($data->num_rows() > 0) {
				return $data->result_array();
				// echo $this->db->last_query();
			} else {
				return false;
			}
		}
	}
	public function get_user($where)
	{
		if (check_login()) {
			$this->db->select('id,name,phone,time,address,avatar,user_type');
			$this->db->where($where);
			$data = $this->db->get('accounts');
			if ($data->num_rows() > 0) {
				return $data->row_array();
				// echo $this->db->last_query();
			} else {
				return false;
			}
		}
	}
	public function logoutUser($status, $date)
	{
		if (check_login()) {
			$currentSession = $_SESSION['user']['id'];
			$this->db->query("UPDATE user SET user_status = '$status' , last_logout = '$date' WHERE 
			id = '$currentSession'");
		}
	}
	public function sentMessage($data)
	{
		return $this->db->insert('user_messages', $data);
		// echo $this->db->last_query();
	}
	public function getmessage($data)
	{
		$this->db->select('*');
		$session_id = $_SESSION['user']['id'];
		$where = "sender_message_id = '$session_id' AND receiver_message_id = '$data' OR 
		sender_message_id = '$data' AND receiver_message_id = '$session_id'";
		$this->db->where($where);
		// $this->db->order_by('time', 'ASC');
		$result = $this->db->get('user_messages')->result_array();
		return $result;
	}
	public function group_mess()
	{
		$session_id = $_SESSION['user']['id'];
		$where = "sender_message_id = '$session_id' OR receiver_message_id = '$session_id'";
		$this->db->select('MAX(id),receiver_message_id,sender_message_id')->where($where)->order_by('MAX(id)', 'DESC')->group_by('receiver_message_id,sender_message_id');
		$result = $this->db->get('user_messages')->result_array();
		// echo $this->db->last_query();
		return $result;
	}
	public function getLastMessage($data)
	{
		$this->db->select('*');
		$session_id = $_SESSION['user']['id'];
		$where = "sender_message_id = '$session_id' AND receiver_message_id = '$data' OR 
		sender_message_id = '$data' AND receiver_message_id = '$session_id'";
		$this->db->where($where);
		$this->db->order_by('time', 'DESC');
		$result = $this->db->get('user_messages', 1)->row_array();
		return $result;
	}
	public function getIndividual($id)
	{
		$this->db->select('id,name,phone,time,address,avatar,user_type');
		$this->db->where('id', $id);
		$res = $this->db->get('accounts')->row_array();
		return $res;
	}
	public function updateBio($data)
	{
		if (check_login()) {
			$session_id = $_SESSION['user']['id'];
			// $bio = $data['bio'];
			// $dob = $data['dob'];
			$address = $data['address'];
			$phone = $data['phone'];

			return $this->db->query("UPDATE user SET  address = '$address', phone = '$phone' WHERE id = '$session_id'");
			// $this->db->query("UPDATE user SET bio = '$bio', dob = '$dob', address = '$address', phone = '$phone' WHERE id = '$session_id'");
			// return $data;
		}
	}
	public function blockUser($arr)
	{
		return $this->db->insert('block_user', $arr);
		// echo $this->db->last_query();
	}
	public function unBlockUser($val1, $val2)
	{
		return $this->db->query("DELETE FROM block_user WHERE blocked_from = '$val1' AND blocked_to = '$val2'");
	}
	public function getBlockUserData($val1, $val2)
	{
		$this->db->select('*');
		$where = "blocked_from = '$val1' AND blocked_to = '$val2' OR blocked_from = '$val2' AND blocked_to = '$val1'";
		$this->db->where($where);
		$res = $this->db->get('block_user')->result_array();

		return $res;
	}
}
