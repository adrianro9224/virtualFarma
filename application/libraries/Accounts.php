<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts {
	
	public function get_pathologies( $account_id ) {
		$CI =& get_instance();
		
		$CI->load->model("account_model");
		
		$pathologies = $CI->account_model->get_pathologies_by_id( $account_id );
		
		return $pathologies;
		
	}
	
	public function generate_pathologies_dropdown_items_ids( $categories_pathologies ) {
		$ids = array();
		
		foreach ( $categories_pathologies as $pathology ) {
			$ids[lcfirst(str_replace(' ', '_', $pathology->name))] = $pathology;
		}
		
		return $ids;
	}
	
}