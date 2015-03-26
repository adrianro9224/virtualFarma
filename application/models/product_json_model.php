<?php
Class Product_json_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}
	
	public function insert_product_json( $products_json ) {
		$data = array(
				"products" => $products_json
				);
		
		$this->db->insert('product_json', $data);
		
		if( $this->db->affected_rows() == 1 )
			return  $this->db->insert_id();
		
		return NULL;
		
	}
}