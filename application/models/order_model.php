<?php
class Order_model extends CI_Model {
	
	/**
	 *CI_model constructor 
	 */
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * insert a new row of type order
	 * @param unknown $order_data
	 * @param unknown $recipient_id
	 * @param unknown $account_id
	 * @return NULL or the insert id
	 */
	public function insert_order( $order_data, $recipient_id, $account_id ) {
		
		$data = array(
				'value' => $order_data->shoppingcart->total,
				'tax' => $order_data->shoppingcart->tax,
				'payment_method_id' => $order_data->paymentMethod->selectedPaymentMethod,
				'products' => json_encode( $order_data->shoppingcart->products ),
				'shipping_charge' => $order_data->shoppingcart->shippingCharge,
				'recipient_id' => $recipient_id,
				'account_id' => $account_id,
				'status' => 'RECEIVED'
		);
		
		$this->db->insert( 'order', $data );
		
		if ( $this->db->affected_rows() == 1 )
			return $this->db->insert_id();
		
		return NULL;
		
	}
	
	/**
	 * Update the status of a order
	 * @param unknown $order_id
	 * @param unknown $new_status
	 * @return boolean
	 */
	public function update_order_status( $order_id, $new_status ) {
		
		$this->db->set( 'status', $new_status );
		
		$this->db->where( 'id', $order_id );
		$this->db->update('order');
		
		if( $this->db->affected_rows() == 1 )
			return true;
		
		return false;
	}
}