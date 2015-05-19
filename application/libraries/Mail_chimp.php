<?php
class Mail_chimp {
	
	protected  $config = array(
			'apikey' => '25cf24ce4b8a6c383ef627f271fcd4d8-us10', // Insert your api key
			'secure' => FALSE   // Optional (defaults to FALSE)
	);
	
	public function send_register_email( $account ){
		
		$list_id = 'e7d9615355';
		$language = 'es_ES';
		
		$CI =& get_instance();
		
		$CI->load->library('MCAPI', $this->config, 'mail_chimp');
		
		
		$merge_vars = array('FNAME' => $account->first_name,
							'LNAME' => $account->last_name,
							'MC_LANGUAGE' => $language 
		);
		
		if($CI->mail_chimp->listSubscribe( $list_id, $account->email, $merge_vars, $email_type='html', $double_optin=true, $update_existing=false, $replace_interests=true, $send_welcome=true)) {
			return TRUE;
		}
		
		return FALSE;
		
	} 
	
	
	
} 