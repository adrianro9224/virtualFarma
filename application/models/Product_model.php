<?php
class Product_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_by_category_id($category_id) {
		
		$this->db->where('category_id', $category_id);
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		
		return null;
	}
}