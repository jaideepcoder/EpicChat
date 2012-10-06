<?php
class Chat extends CI_Controller {
	
	var $user;
	function Chat() {
		parent::__construct();
		$this->load->model('chat_model');
		$this->load->library('session');
		$user='';
	}
	
	function index() {
		$data['title'] = 'Epic Chat';
		$data['description'] = '';
		$data['keywords'] = 'Epic, Chat';
		$data['head'] = 'Chat';
		$data['results'] = '';
		$image_array = get_clickable_smileys(base_url() . 'smileys/', 'chatTextArea');
		$col_array = $this->table->make_columns($image_array, 23);
		$data['smiley_table'] = $this->table->generate($col_array);
		$this->load->view('chat/index', $data);
		
	}
	
	function setUser() {
		$user = $this->input->post('user');
		$set_session = array(
		'user' => $user,
		'stat' => 1
		);
		$this->session->set_userdata($set_session);
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
		$this->chat_model->_addMessage($sender);
	}
	
	function messages() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->getChatMessage('Jaideep', 'Archit');
		foreach ($result->result() as $row) {
			$res[$count] = array('sender' => $row->sender, 'receiver' => $row->reciever, 'message' => $row->message);
			$count++;
		}
		echo json_encode($res);
		
	}
	
	function initMessages() {
		$count = 0;
		$res = array();
		$result = $this->chat_model->initGetChatMessage('Jaideep', 'Archit');
		foreach ($result->result() as $row) {
			$res[$count] = array('sender' => $row->sender, 'receiver' => $row->reciever, 'message' => $row->message);
			$count++;
		}
		echo json_encode($res);
	}
	
	function checkSession() {
		if($this->session->user_data('session_id') == 1) {
			$output = array('stat' => 1);
			echo json_encode($output);
		}
		else {
			echo 1;
		}
	}
	
}
?>