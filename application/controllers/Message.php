<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Message extends CI_controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Messagemodel');
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('func_helper');
		$this->load->library('Globals');
		$this->load->helper('images');
		$this->load->library('upload');
	}
	public function index()
	{
		if (check_login()) {
			$data['data'] = $this->Messagemodel->ownerDetails();
			$this->load->view('chat/message/message', $data);
		} else {
			$this->load->view('chat/error/error');
		}
	}
	public function ownerDetails()
	{
		$res = $this->Messagemodel->ownerDetails();
		print_r(json_encode($res));
	}
	public function allUser()
	{
		$data['data'] = $this->Messagemodel->allUser();
		// var_dump($data['data']);
		// die;
		$data['last_msg'] = array();
		$data['data_kol'] = array();
		$this->load->helper('url');
		if (!is_array($data['data'])) {
			echo "<p class='text-center'>No user available.</p>";
		} else {
			$count = count($data['data']);
			for ($i = 0; $i < $count; $i++) {
				$unique_id = $data['data'][$i]['id'];
				$msg = $this->Messagemodel->getLastMessage($unique_id);
				if ($msg != null) {
					for ($j = 0; $j < count($msg); $j++) {

						$time = explode(" ", $msg[0]['time']); //00:00:00.0000
						$time = explode(".", $time[1]); //00:00:00
						$time = explode(":", $time[0]); //00 00 00
						if ((int)$time[0] == 12) {
							$time = $time[0] . ":" . $time[1] . " PM";
						} elseif ((int)$time[0] > 12) {
							$time = ($time[0] - 12) . ":" . $time[1] . " PM";
						} else {
							$time = $time[0] . ":" . $time[1] . " AM";
						}

						array_push($data['last_msg'], array(
							'message' => $msg[0]['message'],
							'sender_id' => $msg[0]['sender_message_id'],
							'receiver_id' => $msg[0]['receiver_message_id'],
							'time' => $time //00:00
						));
					}
					// if ($i < 20) {
					array_push($data['data_kol'],  $data['data'][$i]);
					// }
				}
			}
			$data['data'] = $data['data_kol'];
			$this->load->view('chat/message/sampleDataShow', $data);
		}
	}
	public function getIndividual()
	{
		$returnVal = $this->Messagemodel->getIndividual($this->input->post('data'));
		print_r(json_encode($returnVal, true));
	}
	public function setNoMessage()
	{
		$data['image'] = $this->input->post('image');
		$data['name'] = $this->input->post('name');
		$this->load->view('chat/message/notmessageyet', $data);
	}
	public function sendMessage()
	{
		if (isset($_POST['data']) && isset($_SESSION['user']['id'])) {
			$jsonDecode = json_decode($_POST['data'], true);
			$uniq = $_SESSION['user']['id'];
			$arr = array(
				'time' => $jsonDecode['datetime'],
				'sender_message_id' => $uniq,
				'receiver_message_id' => $jsonDecode['uniq'],
				'message' => $jsonDecode['message'],
			);
			$this->Messagemodel->sentMessage($arr);
		}
	}
	public function getMessage()
	{
		if (isset($_POST['data']) && isset($_SESSION['user']['id'])) {
			$data['data'] = $this->Messagemodel->getmessage($this->input->post('data'));
			$data['image'] = $this->input->post('image');
			$this->load->view('chat/message/sampleMessageShow', $data);
		}
	}
	public function updateBio()
	{
		if ($_POST) {
			$this->Messagemodel->updateBio($_POST);
		}
	}
	public function blockUser()
	{
		if (isset($_POST['time']) && isset($_POST['uniq'])) {
			$arr = array(
				'blocked_from' => $_SESSION['user']['id'],
				'blocked_to' => $this->input->post('uniq'),
				'time' => $this->input->post('time')
			);
			$this->Messagemodel->blockUser($arr);
			return 1;
		}
	}
	public function getBlockUserData()
	{
		if (isset($_POST['uniq'])) {
			$res = $this->Messagemodel->getBlockUserData($this->input->post('uniq'), $_SESSION['user']['id']);
			print_r(json_encode($res));
		}
	}
	public function unBlockUser()
	{
		if (isset($_POST['uniq'])) {
			$from = $_SESSION['user']['id'];
			$to = $this->input->post('uniq');
			$this->Messagemodel->unBlockUser($from, $to);
		}
	}
}
