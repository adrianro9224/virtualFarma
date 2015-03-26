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
		$this->load->library( array('form_validation', 'account_types', 'products') );
		
	}
	
	public function index( $page = "admin" ) {
		$data['title'] = $page;
		
		$this->load->view($page . '/index', $data );
	}
	
	public function admin_login() {
		
		$admin_login_form = $this->input->post();
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if ( isset($session_data['seller_id']) ) {
			echo 'asdasd';
		} else {
			if ( $admin_login_form ) {
				
				$validation_response = $this->_validate_admin_log_in_form();
				
				if ( $validation_response ) {
										
					$admin_account = $this->account_model->get_admin_account_by_identification_number( $admin_login_form['adminUsername'] );
					
					if ( isset($admin_account) ) {
						
						$password_decrypted_from_db = _password_account_h2o( $admin_account->password, $admin_account->email );
						
						$admin_user_password = md5($admin_login_form['adminUserPassword']);
						
						if ( $password_decrypted_from_db ==  $admin_user_password ) {
							
							unset( $admin_account->password );
							
							switch ( $admin_account->account_type_id ) {
								case 1:
									//admin
									$this->_admin_do_login($account_types[0], $admin_account, $data);
									$this->load->view('admin/control_panel', $data);
								break;
								case 2:
									//user
								break;
								case 3:
									//seller
									$data['title'] = 'Ventas';
									$data['type_of_admin'] = $account_types[2];
									
									$this->_admin_do_login( $account_types[2], $admin_account, $data );
									$this->load->view('admin/seller/index', $data);
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
	
	public function all_products() {
		$session_data = $this->session->all_userdata();
		
		if ( isset($session_data['account_types']) ) 
			$account_types = $session_data['account_types'];
		else
			$account_types = $this->account_types->get_account_types();
		
		if ( isset($session_data[$account_types[0] . '_id']) || isset($session_data[$account_types[2] . '_id']) ){
			$json_string_of_products = $this->products->load_all_products();
			
			if( isset($json_string_of_products) ){
				echo $json_string_of_products;
			}else
				echo 'NULL';
				
		}else{
			echo 'NULL';
		}
			
	}
	
	private function _admin_do_login( $type_of_admin, $admin_account, &$data = array()) {
		
		$this->session->set_userdata( $type_of_admin . '_id', $admin_account->identification_number);
		
		$data[ $type_of_admin . '_account' ] = $admin_account;
		$data[ $type_of_admin . '_logged' ] = true;
	} 
	
	/**
	 * Custom form admin_log_in valilation
	 * @return True if is success the validation false in other case
	 */
	private function _validate_admin_log_in_form() {
	
		$this->form_validation->set_rules('adminUsername', 'adminName', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('adminUserPassword', 'adminPassword', 'required|max_length[64]|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
			return false;
	
		return true;
	
	}
}