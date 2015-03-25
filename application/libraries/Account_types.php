<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Account_types {
	
	public function get_account_types() {
		$CI =& get_instance();
		
		$CI->load->model('account_type_model');
		
		$account_types = $CI->account_type_model->get_all_account_types();
			
		if ( isset($account_types) )
			return $account_types;
		else 
			return NULL; 
		
	} 
} 