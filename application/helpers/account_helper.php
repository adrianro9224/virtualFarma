<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('_password_account_sal')) {
	
	function _password_account_sal( $account_password_md5, $user_email ){
		
		$email_array = explode( '@', $user_email );
		$fisrt_piece = $email_array[0];
		$encryption_vars = str_split( $fisrt_piece );
		$ascii_values = 0;
		
		foreach ( $encryption_vars as $var ) {
			$ascii_values += ord($var);
		}
		
		$password_encrypted = $account_password_md5 . $ascii_values; 
		
		return $password_encrypted;
	}
}

if ( !function_exists('_password_account_h2o')) {

	function _password_account_h2o( $account_password_md5_with_sal, $user_email ){
		
		$email_array = explode( '@', $user_email );
		$fisrt_piece = $email_array[0];
		$encryption_vars = str_split( $fisrt_piece );
		$ascii_values = 0;
		
		foreach ( $encryption_vars as $var ) {
			$ascii_values += ord($var);
		}
		
		$password_decrypted = str_replace( $ascii_values, "", $account_password_md5_with_sal);//for decrypt, change: mixed $search , mixed $replace
		
		return $password_decrypted;
	}
}
