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
}