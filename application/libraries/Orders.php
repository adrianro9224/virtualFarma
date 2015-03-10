<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders {
	
	
	public function save_order( $order ) {
		$CI =& get_instance();
		
		$CI->load->model('order_model');
		$CI->load->model('recipient_model');
		
		$recipient_id = $CI->recipient_model->insert_recipient( $order->shippingData );
		
		die($recipient_id);
	}
}
