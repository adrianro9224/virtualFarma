<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Roots {
	
	public function validate_root_identity( $identification_number, $password, $account_types ) {
		
		$CI =& get_instance();
		
		$CI->load->model('account_model');
		
		$admin_account = $CI->account_model->get_admin_account_by_identification_number( $identification_number );
		$account_types = get_account_types();
		
		if ( isset($admin_account) ){
			
			$CI->load->helper('account_helper');
			
			$password_from_user_encrypted = $CI->account_helper->_password_account_sal( md5($password), $admin_account->email );
			
			if ( $password_from_user_encrypted == $admin_account->password ){
				if ( $admin_account->account_type_id == 4 )
					return true;
			}
			
		}
		
		return false;
		
	}
	
}