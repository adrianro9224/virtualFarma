<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	/**
	 * Controller contructor
	 */
	function __construct(){
		parent::__construct();
		
		$this->load->model('account_model');
		$this->load->helper(array('form', 'account_helper'));
		$this->load->library('form_validation');
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
				
				$validation_response = $this->_validate_admin_log_in_form();
				
				if ( $validation_response ) {
										
					$admin_account = $this->account_model->get_admin_account_by_identification_number( $admin_login_form['adminUsername'] );
					
					if ( isset($admin_account) ) {
						
						$password_decrypted = _password_account_h2o( $admin_account->password, $admin_account->email );
						
						if ( $password_decrypted == $admin_login_form['adminUserPassword'] ) {
							
							unset( $admin_account->password );
							
							switch ( $admin_account->account_type_id ) {
								case 1:
									$this->_admin_do_login('admin', $admin_account, $data);
									$this->load->view('admin/control_panel', $data);
								break;
								case 2:
									//user
								break;
								case 3:
									//add function admin_do_login
									$this->_admin_do_login('seller', $admin_account, $data);
									$this->load->view('seller/index', $data);
								break;
								case 4:
									//root
								break;
							}
						}
						
					}
					
				}
				
			}
		} 
		
	}
	
	private function _admin_do_login( $type_of_admin, &$data, $admin_account ) {
		
		$this->session->set_userdata( $type_of_admin . 'id', function ( $type_of_admin, $admin_account, &$data ) {
			switch ( $type_of_admin ) {
				case 'admin':
					$data[ $type_of_admin . 'account' ] = $admin_account;
					$data[ $type_of_admin . 'logged' ] = true;
					return $admin_account->identification_number;
				break;
				case 'seller':
					$data[ $type_of_admin . 'account' ] = $admin_account;
					$data[ $type_of_admin . 'logged' ] = true;
					return $admin_account->identification_number;
				break;
				case 'root':
					$data[ $type_of_admin . 'account' ] = $admin_account;
					$data[ $type_of_admin . 'logged' ] = true;
					return $admin_account->identification_number;
				break;
			}
		});
	} 
	
	/**
	 * Custom form admin_log_in valilation
	 * @return True if is success the validation false in other case
	 */
	private function _validate_admin_log_in_form() {
	
		$this->form_validation->set_rules('adminUsername', 'adminName', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('AdminUserPassword', 'adminPassword', 'required|max_length[64]|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
			return false;
	
		return true;
	
	}
}