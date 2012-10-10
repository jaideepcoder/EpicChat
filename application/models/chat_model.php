<?php

class Chat_model extends CI_Model {
	
	function setOnline($array) {
		$this->db->insert('online', $array);
	}
	
	function getOnline() {
		$this->db->select('user');
		$this->db->distinct();
		$result = $this->db->get_where('online', array('stat' => 1));
		return $result;
	}
	
	function getChatMessage($sender, $reciever) {
		$where = "sender = '" . $reciever . "'AND reciever = '" . $sender . "' AND recd=0";
		$this->db->where($where);
		$result = $this->db->get('chat');
		$this->db->where($where);
		$this->db->update('chat', array('recd' => 1));
		return $result;
	}
	
	function initGetChatMessage($sender, $reciever) {
		$result = $this->db->get_where('chat', array('sender' => $sender, 'reciever' => $reciever, 'recd' => 1));
		return $result;
	}
	
	function _addMessage($sender, $reciever, $message) {
		$data = array(
			'sender' => $sender,
			'reciever' => $reciever,
			'message' => $message,
			'recd' => 0
		);
		$this->db->insert('chat', $data);
	}
	
	function thisMessage($sender, $reciever, $message) {
		$result = $this->db->get_where('chat', array('sender' => $sender, 'reciever' => $reciever, 'message' => $message));
		return $result;
	}
	
	function unsetUser($user) {
		$this->db->where('user', $user);
		$this->db->update('online', array('stat' => 0));
		//$this->db->delete('online', array('user' => $user));
	}
}
