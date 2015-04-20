<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library( array('account_types', 'products') );
	}
	
	public function index($page = 'home') {
		
		
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
//    		phpinfo();
//    		die();
  		
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['notifications'] = $this->session->flashdata('notifications');
		
		$data['user_logged'] = false;
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		$categories = $this->get_categories();
		
		$data['categories'] = $categories;
		
		if( isset($session_data[$account_types[1] . '_id']) ){
			$data['user_logged'] = true;
		}
		
		$this->load->view('pages/' . $page, $data);
		
	}
	
	public function show_product_for_search() {
		
		$json_string_of_products = $this->products->load_all_products();
			
		if( isset($json_string_of_products) ){
			echo $json_string_of_products;
		}else
			echo 'NULL';
		
	}
} 