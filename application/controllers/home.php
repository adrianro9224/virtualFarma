<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
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
		
		$categories = $this->get_categories();
		
		$data['categories'] = $categories;
		
		if( isset($session_data['account_id']) ){
			$data['user_logged'] = true;
		}
		
		$this->load->view('pages/' . $page, $data);
		
	}
} 