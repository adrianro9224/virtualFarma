<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	/**
	 * Controller contructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	public function index( $page = "admin" ) {
		$data['title'] = $page;
		
		$this->load->view($page . '/index', $data );
	}
}