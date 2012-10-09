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
		$result = $this->db->get_where('chat', array('sender' => $sender, 'reciever' => $reciever, 'recd' => 0));
		$this->db->where(array('sender' => $sender, 'reciever' => $reciever, 'recd' => 0));
		$this->db->update('chat', array('recd' => 1));
		return $result;
	}
	
	function initGetChatMessage($sender, $reciever) {
		$result = $this->db->get_where('chat', array('sender' => $sender, 'reciever' => $reciever, 'recd' => 1));
		return $result;
	}
	
	function _addMessage($sender, $reciever, $message) {
		$data = array(
			'sender' => 'Jaideep',
			'reciever' => 'Archit',
			'message' => $message,
			'recd' => 0
		);
		$this->db->insert('chat', $data);
	}
}
