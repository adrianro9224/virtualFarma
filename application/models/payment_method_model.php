<?php
class Payment_method_model extends CI_Model {
	
	/**
	 * Payment_method_model constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Get every payment methods enabled
	 */
	public function get_enabled_payment_methods() {
		
		$this->db->where("status", 1);
		$query = $this->db->get('payment_method');
		
		if( $query->num_rows() > 0 ){
			return $query->result();
		}
		
		return NULL;
	}
	
}