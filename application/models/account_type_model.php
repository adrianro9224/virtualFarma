<?php
Class Account_type_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function get_all_account_types() {
		
		$this->db->select('type');
		$query = $this->db->get('account_type');
		
		if($query->num_rows() > 0) {
			$result = $query->result();
			
			foreach ( $result as $row ) {
				$account_type[] = $row->type;	
			}
			
			return $account_type;
		}
		
		return NULL;
	} 
	
}