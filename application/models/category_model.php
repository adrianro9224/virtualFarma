<?php
class Category_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	/**
	 *  get all categories in the table Category
	 * @return unknown|boolean all categories if this exist
	 */
	public function all_categories() {
		//The second and third parameters enable you to set a limit and offset clause:
		//$query = $this->db->get('mytable', 10, 20);
		$query = $this->db->get('category');
		
		if($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		
		return NULL;
	}
	
	public function insert_categories( $categories_to_save ) {
		
		$category_insert_ids = array();
		
		$num_of_categories_to_save = count($categories_to_save);
		
		foreach ($categories_to_save as $category ) {
			$data = array(
					"name" => $category->name,
					"code_line" => $category->code_line
			);
				
			$this->db->insert("category", $data);
				
			if( $this->db->affected_rows() == 1 )
				$category_insert_ids[] = $this->db->insert_id();
		}
		
		if ( $num_of_categories_to_save == count($category_insert_ids) )
			return true;
		
		return false;
		
		
	}
}