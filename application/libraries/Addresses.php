<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addresses {

	public function write_account_sign_up_address( $new_address, $account_id ) {
		$CI =& get_instance();

		$CI->load->model("address_model");
		
		$insert_id = $CI->address_model->insert_address( $new_address, $account_id );

		return $insert_id;

	}
	
	public function get_sign_up_address( $account_id ) {
		$CI =& get_instance();
		
		$CI->load->model("address_model");
		
		$address = $CI->address_model->get_sign_up_address_by_id( $account_id );
		
		if( isset($address) )
            return $address;

		return NUll;
		
	}

    public function change_address( $new_address, $account_id ) {
        $CI =& get_instance();

        $CI->load->model("address_model");

        $result = $CI->address_model->update_address_by_account_id( $new_address, $account_id );

        return $result;

    }

    public function remove_address( $address_id, $account_id ) {
        $CI =& get_instance();

        $CI->load->model("address_model");

        $result = $CI->address_model->delete_address_by_id( $address_id, $account_id );

        return $result;

    }

    public function get_every_addresses( $account_id ) {

        $CI =& get_instance();

        $CI->load->model("address_model");

        $addresses = $CI->address_model->get_every_addresses_by_id( $account_id );

        if( isset($addresses) )
            return $addresses;

        return NUll;

    }

}