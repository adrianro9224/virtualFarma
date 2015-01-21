<?php
class Message_model extends CI_Model {
	
	/**
	 * instance the Model
	 */
	function __construct() {
		//call the Model constructor		
		parent::__construct();
	}
	
	/**
	 * Insert a message in DB
	 * @param Array $message_data
	 * @return NULL
	 */
	public function insert_message($message_data) {
		
		$date_format = 'Y-m-d H:i:s'; //(the MySQL DATETIME format)
		
		$data = array(
				'recipient' => $message_data['to'],
				'sender' => $message_data['accountEmail'],
				'content' => $message_data['content'],
				'date_of_mailing' => date($date_format),
				'recipient_status' => 'SENT',
				'sender_status' => 'SENT'
		);
		
		$this->db->insert('message', $data);
		
		if($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		
		return NULL;
	}
	
	/**
	 * Update the  message->status with the $message_id to "READED"
	 * @param unknown $message_id
	 * @return boolean|NULL
	 */
	public function update_message_to_readed( $message_id ) {
		
		$this->db->set('recipient_status', "READED" );
		$this->db->set('sender_status', "READED" );
		
		$this->db->where('id', $message_id);
		
		$this->db->update('message');
		
		if($this->db->affected_rows() > 0) {
			return true;
		}
		
		return NULL;
	}
	
	/**
	 * Update the  message->status with the $message_id to "DELETED"
	 * @param unknown $message_id
	 * @return boolean|NULL
	 */
	public function delete( $message_id, $type_of_delete ) {
		
		if( $type_of_delete ) {
			$type_of_status = "recipient_status"; 
		}else {
			$type_of_status = "sender_status";
		}
		
		$this->db->set($type_of_status, "DELETED" );
		
		$this->db->where('id', $message_id);
		
		$this->db->update('message');
		
		if($this->db->affected_rows() > 0) {
			return true;
		}
		
		return NULL;
	}
	
	/**
	 * Get every messages of this email like recipient
	 * @param unknown $account_email
	 * @return unknown|NULL
	 */
	public function get_by_email($account_email) {
		
		$this->db->where('recipient', $account_email);
		$this->db->or_where('sender', $account_email);
		
		$query = $this->db->get('message');
		
		if($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		
		return NULL;
	}
}