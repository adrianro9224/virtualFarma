<?php
Class Product_json_model extends CI_Model{
	
	/**
	 * Constructor function, instantiate the CI_model
	 */
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Insert a row of a type product_json 
	 * @param Json string $products_json
	 * @return NULL
	 */
	public function insert_product_json( $products_json ) {
		$data = array(
				"products" => $products_json,
                "status" => 0
				);
		
		$this->db->insert('product_json', $data);
		
		if( $this->db->affected_rows() == 1 )
			return  $this->db->insert_id();
		
		return NULL;
		
	}
	
	/**
	 * Get a json of products
	 * @return NULL
	 */
	public function get_json_products() {
		
		$this->db->where('status', 1);
		
		$query = $this->db->get('product_json');
		
		if ($query->num_rows() == 1)
			return $query->row()->products;

		return NULL;
	}
}