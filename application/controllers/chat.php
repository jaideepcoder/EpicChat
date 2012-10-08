<?php
class Chat extends CI_Controller {
	
	var $user;
	function Chat() {
		parent::__construct();
		$this->load->model('chat_model');
		//$this->load->library('session');
		$user='';
	}
	
	function index() {
		session_start();
		$data['title'] = 'Epic Chat';
		$data['description'] = '';
		$data['keywords'] = 'Epic, Chat';
		$data['head'] = 'The Epic Chat';
		$data['results'] = '';
		$image_array = get_clickable_smileys(base_url() . 'smileys/', 'chatTextArea');
		$col_array = $this->table->make_columns($image_array, 23);
		$data['smiley_table'] = $this->table->generate($col_array);
		
		if(isset($_SESSION['user'])) {
			$data['user'] = $_SESSION['user'];
			$data['state'] = 1;
			echo $_SESSION['user'];
		}
		else {
			$data['user'] = "";
			$data['state'] = 0;
		}
		$this->load->view('chat/index', $data);
		
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
		$sender = 'Jaideep';
		$reciever = 'Archit';
		$message = $this->input->post('message');
		$this->chat_model->_addMessage($sender, $reciever, $message);
	}
	
	function messages() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->getChatMessage('Jaideep', 'Archit');
		foreach ($result->result() as $row) {
			$res[$count] = array('sender' => $row->sender, 'reciever' => $row->reciever, 'message' => $row->message);
			$count++;
		}
		echo json_encode($res);
		
	}
	
	function initMessages() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->initGetChatMessage('Jaideep', 'Archit');
		foreach ($result->result() as $row) {
			$res[$count] = array('sender' => $row->sender, 'reciever' => $row->reciever, 'message' => $row->message);
			$count++;
		}
		echo json_encode($res);
	}
	
	function checkSession() {
		if(session_is_registered($user)) {
			$output = array('stat' => 1);
			echo json_encode($output);
		}
		else {
			
		}
	}
	
	function closeSession() {
		session_unset();
	}
	
}
?>