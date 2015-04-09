<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		$this->load->library('roots');
	}
	
	public function create_categories( $identification_number, $password ) {
		$this->roots->validate_root_identity( $identification_number, $password );
			
		//call funtion for read from csv the categories and save this
		
	}
	
}