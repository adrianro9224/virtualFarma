<?php

Class Categories {
	
	
	public function save_categories( $categories_to_save ) {
		$CI =& get_instance();
		
		$CI->load->model('category_model');
		
		$result = $CI->category_model->insert_categories( $categories_to_save );
		
		return $result;
	}
	
	public function load_categories() {
		
		$CI =& get_instance();
		
		$CI->load->model('category_model');
		
		$result = $CI->category_model->all_categories();
		
		return $result;
		
	}
	
	public function index_categories_by_code_line( $categories_to_index ) {

		
		foreach ( $categories_to_index as $category ) {
			
			$categories_to_index[$category->code_line] = $category; 
			
		}
		
		return $categories_to_index;
	}
}