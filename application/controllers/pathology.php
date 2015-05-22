<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pathology extends MY_Controller {
	
	
	function __construct(){
		parent::__construct();
		$this->load->model('pathology_model');
		$this->load->library('roots');
	}
	
	public function create_pathologies( $identification_number = NULL, $password = NULL ) {
		
		if ( isset($identification_number )&& isset($password) ) {
			$access_permited = $this->roots->validate_root_identity( $identification_number, $password );
			
			
			
		}
		
	}
	
	
	
	
}