<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {
	/**
	 * Controller contructor
	 */
	function __construct() {
		parent::__construct();
		$this->load->library( array('form_validation', 'account_types'));
		$this->load->model( 'message_model' );
	}
	
	/**
	 * mark a message like a readed
	 * @param unknown $message_id
	 */
	public function mark_as_read( $message_id, $account_id_view ) {
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if( isset( $message_id ) ) {
			
			if( isset($session_data[$account_types[1] . '_id']) ) {
				$account_id_insession = $session_data[$account_types[1] . '_id'];
			
				if( $account_id_view == $account_id_insession ) {
						
					$result = $this->message_model->update_message_to_readed( $message_id );
				}
			}
		}
		
		
	}
	
	/**
	 * mark a message like "deleted" 
	 * @param unknown $message_id
	 */
	public function mark_as_delete( $message_id, $account_id_view, $type_of_delete ) {
		
		// false if delete from sent messages, true in other case
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if( isset($message_id) ) {
			
			if( isset($session_data[$account_types[1] . '_id']) ) {
				$account_id_insession = $session_data[$account_types[1] . '_id'];
				
				if( $account_id_view == $account_id_insession ) {
					
					$result = $this->message_model->delete( $message_id, $type_of_delete );
				}
			}
		}
	}
	
	/**
	 * send a message if this isset()
	 */
	public function send_message() {
		
		$message = $this->input->post();

		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		$acccount_id = $session_data[$account_types[1] . '_id'];
		
		$notifications = array();
		
		if(!isset($acccount_id)) {
			redirect("/");
		}
		
		$validation_reponse = $this->_validate_send_message_form();
		
		if($validation_reponse) {
			
			$account = $this->get_account( $acccount_id );
			$account_email = $account->email;
			
			$message['accountEmail'] = $account_email;
			
			$message_id = $this->message_model->insert_message($message);
			
			if(isset($message_id)) {
				$notifications['success'] = "Su mensáje a sido enviado!";
			}else {
				$notifications['warning'] = "Su mensáje no se a enviado, por favor intentelo de nuevo";
			}
			
			$this->session->set_flashdata('notifications', $notifications );
						
			redirect("account/log_in", "refresh");
		}else {
			$notifications['danger'] = validation_errors();
			$this->session->set_flashdata('notifications', $notifications );
			
			$current_url = current_url();
			
			redirect($current_url, "refresh");
		}
		
	}
	
	/**
	 * apply the validations 
	 * @return boolean
	 */
	
	private function _validate_send_message_form() {
		
		$this->form_validation->set_rules('to', 'To', 'required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'required|max_length[1024]|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
			return false;
		
		return true;
	}
}