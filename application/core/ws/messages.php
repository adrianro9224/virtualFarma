<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Messages {
	
	/**
	 * Controller contructor
	 */
	function __construct() {
		parent::__construct();
		$this->load->model( 'message_model' );
	}
	
	function get_user_messages() {
		
		$get_var = $this->get();
		
		var_dump($get_var);
		die();
	}
}