<?php
class Product_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all() {
		
		$this->db->select('id, PLU, barcode, name, category_id, presentation, stock, tax, price, discount' );
		
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		}
		
		return NULL;
	}
	
	public function get_by_category_id($category_id) {
		
		$this->db->where('category_id', $category_id);
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		
		return null;
	}
	
	public function create_products_from_csv( $list_products ) {
		$product_ids = array();
		
		$num_of_products_to_save = count($list_products);
		
		foreach ($list_products as $product ) {
			$data = array(
					"PLU" => $product->PLU,
					"barcode" => $product->barcode,
					"name" => $product->name,
					"category_id" => $product->category_id,
					"presentation" => $product->presentation,
					"description" => $product->presentation,
					"stock" => $product->stock,
					"price" => $product->price
					
			);
			
			$this->db->insert("product", $data);
			
			if( $this->db->affected_rows() == 1 )
				$product_ids[] = $this->db->insert_id();
		}
		
		if ( $num_of_products_to_save == count($product_ids) )
			return true;
		
		return false;
		
	}
	
	public function get_by_name( $pattern_to_search ) {
		
		$this->db->like('name', $pattern_to_search);
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		
		return NULL;
		
	}
}