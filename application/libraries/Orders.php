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
				if ( isset($order_id) )
					log_message('debug', 'order created!');
			}
			
		$CI->db->trans_complete();

		if ($CI->db->trans_status() === false) {
			return false;
		}
		
		return true;
		
	}
	
	public function orders_for_USER_account( $account_id ) {
		
		$CI =& get_instance();
		
		$CI->load->model('order_model');
		
		$orders_by_id = $CI->order_model->get_by_USER_id( $account_id);
		
		return $orders_by_id;
	}
	
	public function orders_for_FARMACY_account( $account_farmacy_id ) {
	
		$CI =& get_instance();
	
		$CI->load->model('order_model');
	
		$orders_by_id = $CI->order_model->get_by_FARMACY_id( $account_farmacy_id );
	
		return $orders_by_id;
	}
	
	public function update_order_by_id( $order_id, $new_status, $date ) {
		
		$CI =& get_instance();
		
		$CI->load->model('order_model');
		
		$order_update_completed = $CI->order_model->update_order_status_by_id( $order_id, $new_status, $date );
		
		return $order_update_completed;
	}

    public function get_order_by_id( $order_id ) {

        $CI =& get_instance();

        $CI->load->model('order_model');

        $order = $CI->order_model->get_by_id( $order_id );

        //$order->products = json_decode($order->products);

        return $order;
    }
}
