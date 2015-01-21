<?php

define('__ROOT__TEMPLATES__', dirname(dirname(__FILE__)) . '/views/templates/');

class MY_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
 		$this->load->model('account_model');
	}
	
	
	public function get_account( $user_logged_account_id ) {
		
		$result = $this->account_model->get_account_by_id( $user_logged_account_id );
		
		return $result;
		
	}
	
	public function get_categories() {
		$categories = $this->category_model->all_categories();
		
		return $categories;
	}
	
}