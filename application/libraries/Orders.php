<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders {
	
	
	public function save_order( $order, $account_id ) {
		usleep(65250);
		$CI =& get_instance();
		
		$CI->load->model('order_model');
		$CI->load->model('recipient_model');
		
		$CI->db->trans_start();
		
			$recipient_id = $CI->recipient_model->insert_recipient( $order->shippingData );
			
			if ( isset($recipient_id) ) {
				log_message('debug', 'recipient created!'); 
				$order_id = $CI->order_model->insert_order( $order, $recipient_id, $account_id );
			}
			
		$CI->db->trans_complete();

		if ($CI->db->trans_status() === FALSE) {
			log_message('error', 'order no created' );
		}
		
	}
}
