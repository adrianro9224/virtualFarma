<?php

Class Categories {
	
	
	public function save_categories( $categories_to_save ) {
		$CI =& get_instance();
		
		$CI->load->model('category_model');
		
		$result = $CI->category_model->insert_categories( $categories_to_save );
		
		return $result;
	}
}