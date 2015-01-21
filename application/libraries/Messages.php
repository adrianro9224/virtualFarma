<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages  {
	
	
	public function sort_messages( $all_user_messages, $user_email ) {
		
		$messages_sorted = new stdClass();
		
		$deleted_status = "DELETED";
		 
		$messages_sorted->sent = null;
		$messages_sorted->received = null;
		
		foreach ( $all_user_messages as $message ){
				
			if( ($message->recipient == $user_email) && ($message->recipient_status != $deleted_status) )
				$messages_sorted->received[] = $message;
			
			if( ($message->sender == $user_email) && ($message->sender_status != $deleted_status) ) {
				$messages_sorted->sent[] = $message;
			}
		}
		
		if( !isset($messages_sorted->sent) && !isset($messages_sorted->received) ) {
			return null;
		}
		
		return $messages_sorted;
	}
	
	
	public function get_every_messages( $user_email ) {
		//Assigning by reference allows you to use the original CodeIgniter object rather than creating a copy of it.
		$CI =& get_instance();
		
		$CI->load->model('message_model');
		
		$every_messages = $CI->message_model->get_by_email( $user_email );
		
		return $every_messages;
	}
	
	
}