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
				'send_date' => $order_data->date,
				'value' => $order_data->shoppingcart->total,
				'tax' => $order_data->shoppingcart->tax,
				'payment_method_id' => $order_data->paymentMethod->selectedPaymentMethod,
				'products' => json_encode( $order_data->shoppingcart->products ),
				'shipping_charge' => $order_data->shoppingcart->shippingCharge,
				'recipient_id' => $recipient_id,
				'account_id' => $account_id,
				'status' => 'RECEIVED',
                'nearby_id' => $order_data->shippingData->FarmacyNearbyId,
				'farmacy_id' => 1,
				'from_app' => $order_data->from
		);
		
		$this->db->insert( 'order', $data );
		
		if ( $this->db->affected_rows() == 1 )
			return $this->db->insert_id();
		
		return NULL;
		
	}
	
	
	public function get_by_USER_id( $account_id ) {
		
		$this->db->where( 'account_id', $account_id );
		$this->db->order_by('send_date', 'desc');
		
		$query = $this->db->get('order');
		
		if ( $query->num_rows() > 0 ) 
			return $query->result();
		
		return NULL;
		
	}
	
	public function get_by_FARMACY_id( $account_farmacy_id ) {
		
		$this->db->select('*');
		$this->db->from('order');
		
		$this->db->join( 'recipient', 'recipient.id = order.recipient_id' );
		
		$this->db->where( 'farmacy_id', $account_farmacy_id );
		
		$this->db->order_by('send_date', 'desc');
		
		$query = $this->db->get();
		
		if ( $query->num_rows() > 0 )
			return $query->result();
		
		return NULL;
		
	}
	
	/**
	 * Update the status of a order by id
	 * @param unknown $order_id
	 * @param unknown $new_status
	 * @return boolean
	 */
	public function update_order_status_by_id( $order_id, $new_status, $date ) {
		
		if ( $new_status == 'SENDED' ) 
			$this->db->set( 'shipping_date', $date );
		
		if ( $new_status == 'DECLINED' )
			$this->db->set( 'declined_date', $date );
		
		$this->db->set( 'status', $new_status );
		
		$this->db->where( 'id', $order_id );
		$this->db->update('order');
		
		if( $this->db->affected_rows() == 1 )
			return true;
		
		return false;
		
	}
	
}