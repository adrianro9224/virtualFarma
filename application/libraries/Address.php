<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address {

	public function write_account_sign_up_address( $new_address, $account_id ) {
		$CI =& get_instance();

		$CI->load->model("address_model");
		
		$insert_id = $CI->address_model->insert_address( $new_address, $account_id );

		return $insert_id;

	}
	
	public function get_all_address( $account_id ) {
		$CI =& get_instance();
		
		$CI->load->model("address_model");
		
		$address = $CI->address_model->get_all_address_by_id( $account_id );

		/*
		$address_categorized = new stdClass();
		$address_categorized->account_sing_up = null;
		$address_categorized->account = array();
		*/
		
		if( isset($address) ) {
		/*
			foreach ($address as $row) {
				
				if( $row->from == "ACCOUNT_SING_UP") 
					$address_categorized->account_sing_up = $row;
				else 
					$address_categorized->account[] = $row;
				
			}*/
            return $address;
		}
		return NUll;
		
	}

}