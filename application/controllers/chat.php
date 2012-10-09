<?php
class Chat extends CI_Controller {
	
	var $user;
	function Chat() {
		parent::__construct();
		$this->load->model('chat_model');
		$this->load->library('session');
	}
	
	function index() {
		$this->session->set_userdata('name', 'ajay');
		$data['title'] = 'Epic Chat';
		$data['description'] = '';
		$data['keywords'] = 'Epic, Chat';
		$data['head'] = 'The Epic Chat';
		$data['results'] = '';
		$image_array = get_clickable_smileys(base_url() . 'smileys/', 'chatTextArea');
		$col_array = $this->table->make_columns($image_array, 23);
		$data['smiley_table'] = $this->table->generate($col_array);
		$this->load->view('chat/index', $data);
	}
	
	function getUser() {
		if(isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			echo json_encode($user);
		}
		else {
			$user = "''";
			echo json_encode($user);
		}
	}
	function setUser() {
		$user = $this->input->post('user');
		$set_session = array(
		'user' => $user,
		'stat' => 1
		);
		$_SESSION['user'] = $user;
		$this->chat_model->setOnline($set_session);
	}
	
	function showOnline() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->getOnline();
		foreach ($result->result() as $row) {
			$res[$count] = array('user' => $row->user);
			$count++;
		}
		echo json_encode($res);
	}
	
	function addMessage() {
		$sender = $this->input->post('sender');
		$reciever = $this->input->post('reciever');
		$message = $this->input->post('message');
		$this->chat_model->_addMessage($sender, $reciever, $message);
	}
	
	function messages() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->getChatMessage('Jaideep', 'Archit');
		foreach ($result->result() as $row) {
			$row->message = parse_smileys($row->message, base_url() . 'smileys/');
			$row->message = str_replace('\\', "", $row->message);
			$res[$count] = array('sender' => $row->sender, 'timestamp' => $row->sent_at, 'message' => $row->message);
			$count++;
		}
		echo json_encode($res);
		
	}
	
	function initMessages() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->initGetChatMessage('Jaideep', 'Archit');
		foreach ($result->result() as $row) {
			$row->message = parse_smileys($row->message, base_url() . 'smileys/');
			$row->message = str_replace('\\', "", $row->message);
			$res[$count] = array('sender' => $row->sender, 'timestamp' => $row->sent_at, 'message' => $row->message);
			$count++;
		}
		
		echo json_encode($res);
	}
}
?>