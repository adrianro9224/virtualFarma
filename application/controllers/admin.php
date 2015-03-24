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
	
	public function admin_login() {
		
		$admin_login_form = $this->input->post();
		
		$session_data = $this->session->all_userdata();
		
		if ( isset($session_data['admin_account_id']) ) {
			
		} else {
			if ( $admin_login_form ) {
				
			}
		} 
		
	}
	
	/**
	 * Custom form admin_log_in valilation
	 * @return result of form validation
	 */
	private function _validate_admin_log_in_form() {
	
		$this->form_validation->set_rules('adminUsername', 'admninName', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('AdminUserPassword', 'admonPassword', 'required|max_length[64]|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
			return false;
	
		return true;
	
	}
}