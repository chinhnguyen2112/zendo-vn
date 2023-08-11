<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SendController extends CI_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper(array('form', 'url', 'func_helper'));
        $this->load->library(['session', 'form_validation']);
        $this->load->model('Messagemodel');
        $this->load->database();
        $this->db = $this->load->database('default', TRUE);
    }
    public function index()
    {
        if (check_login()) {
            $data = array();
            $allmsgs = $this->db->select('*')->from('user_messages')->get()->result_array();
            $data['allMsgs'] = $allmsgs;
            $data['data'] = $this->Messagemodel->allUser();
            $this->load->view('chat/message/message', $data);
        } else {
            $this->load->view('chat/error/error');
        }
    }
    public function send()
    {

        $uniq = $_SESSION['user']['id'];
        $arr = [
            'time' => date('Y-m-d H:i:s'),
            'sender_message_id' => $uniq,
            'receiver_message_id' => $this->input->post('uniq'),
            'message' => $this->input->post('message'),
        ];
        $this->Messagemodel->sentMessage($arr);
        echo json_encode($arr);
    }
    public function alluser()
    {
        $html = '';
        $groub_by_mess = $this->Messagemodel->group_mess();
        if (!is_array($groub_by_mess)) {
            $html .= "<p class='text-center'>No user available.</p>";
        } else {
            $arr = [];
            foreach ($groub_by_mess as $key => $val) {
                if ($val['sender_message_id'] == $_SESSION['user']['id']) {
                    $check_arr = $val['receiver_message_id'];
                } else {
                    $check_arr = $val['sender_message_id'];
                }
                if (!in_array($check_arr, $arr)) {
                    array_push($arr, $check_arr);
                    $where_user =  'id != ' . $_SESSION['user']['id'] . ' AND (  id ="' .  $val['sender_message_id'] . '" OR id = "' . $val['receiver_message_id'] . '" )';
                    $get_user = $this->Messagemodel->get_user($where_user);
                    if ($get_user != null) {
                        $unique_id = $get_user['id'];
                        $msg = $this->Messagemodel->getLastMessage($unique_id);
                        if ($msg != null) {
                            $time = explode(" ", $msg['time']); //00:00:00.0000
                            $time = explode(".", $time[1]); //00:00:00
                            $time = explode(":", $time[0]); //00 00 00
                            if ((int)$time[0] == 12) {
                                $time = $time[0] . ":" . $time[1] . " PM";
                            } elseif ((int)$time[0] > 12) {
                                $time = ($time[0] - 12) . ":" . $time[1] . " PM";
                            } else {
                                $time = $time[0] . ":" . $time[1] . " AM";
                            }
                            $output = "";
                            if ($get_user['id'] == $msg['sender_message_id']) {
                                $output = $msg['message'];
                            } else {

                                $output = "You : " . $msg['message'];
                            }
                            if (strlen($output) > 20) {
                                $output =  substr($output, 0, 20) . "...";
                            }
                            $name = "No name";
                            if ($get_user['name'] != '') {
                                $name = $get_user['name'];
                            }
                            $image = '/images/avt.png';
                            $url = getimagesize(base_url() . $get_user['avatar']);
                            if (is_array($url)) {
                                $image = base_url() . $get_user['avatar'];
                            }
                            $html .= '<div class="innerBox" onclick="show_mess(this)">
                            <div class="user px-3 py-2">
                                <div id="avtar_and_details" class="">
                                    <div id="user_avtar">
                                        <img data-type="' . $get_user['user_type'] . '" src="' . $image . '" alt="avatar" >
                                        <div id="online"></div>
                                        <input type="hidden" name="hdn" id="hidden_id" value="' . $get_user['id'] . '">
                                        <input type="hidden" name="type_user" id="type_user" value="' . $get_user['user_type'] . '">
                                    </div>
                                    <div id="user_details" class="px-2">
                                        <h6 class="m-0" data-type="' . $get_user['user_type'] . '" id="name">' . $name . '</h6>
                                        <p class="m-0" id="title">' . $output . '</p>
                                    </div>
                                </div>
                                <div>
                                    <p id="time">' . $time . '</p>
                                </div>
                            </div>
                        </div>';
                        }
                    } else {
                        $html = "<p class='text-center'>No user available.</p>";
                    }
                }
            }
            echo $html;
        }
    }
    public function getMessage()
    {
        $id = $this->input->post('id');
        $data['data'] = $this->Messagemodel->getmessage($id);
        $data['user_chat'] = $this->Messagemodel->getIndividual($id);
        if ($this->input->post('image') != '') {
            $data['image'] = $this->input->post('image');
        } else {
            $url = getimagesize(base_url() . $data['user_chat']['avatar']);
            if (is_array($url)) {
                $data['image'] = '/' . $data['user_chat']['avatar'];
            } else {
                $data['image'] = '/images/avt.png';
            }
        }
        $this->load->view('chat/message/sampleMessageShow', $data);
    }
    public function get_user_mess()
    {
        $id = $this->input->post('id');
        if ($id != $_SESSION['user']['id']) {
            $user = $this->Messagemodel->getIndividual($id);
            // if ($user['user_type'] == 2) {
            $url = getimagesize(base_url() . $user['avatar']);
            if (is_array($url)) {
                $img = '/' . $user['avatar'];
            } else {
                $img = '/images/avt.png';
            }
            $response = [
                'status' => 1,
                'image' => $img,
                'id' => $user['id'],
                'name' => ($user['name'] != '') ? $user['name'] : 'No name',
                'type' => $user['user_type']
            ];
            // } else {
            //     $response = [
            //         'status' => 0,
            //     ];
            // }
        } else {
            $response = [
                'status' => 0,
            ];
        }
        echo json_encode($response);
    }
    public function blockUser()
    {
        if (isset($_POST['uniq'])) {
            $arr = array(
                'blocked_from' => $_SESSION['user']['id'],
                'blocked_to' => $this->input->post('uniq'),
                'time' => date('Y-m-d H:i:s')
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
    public function unblockUser()
    {
        if (isset($_POST['uniq'])) {
            $from = $_SESSION['user']['id'];
            $to = $this->input->post('uniq');
            $this->Messagemodel->unBlockUser($from, $to);
        }
    }
}
