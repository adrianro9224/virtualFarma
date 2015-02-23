<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {
	
	/**
	 * Call to CI_controller constructor
	 */
	function __construct() {
		parent::__construct();
		$this->load->library('address');
	}
	
	
	public function index( $page = 'checkout' ) {
		
		$data['title'] = ucfirst($page); // Capitalize the first letter
		
		$data['notifications'] = $this->session->flashdata('notifications');
		
		$data['user_logged'] = false;
		
		
		$breadcrumb = new stdClass();
		
		$breadcrumb->title = "Resumen de compra";
		
		$breadcrumb_item = new stdClass();
		
		$breadcrumb_item->name = "Resumen de compra";
		$breadcrumb_item->url = "/product/show_products_by_category/category_1";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['ckeckout'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		
		$session_data = $this->session->all_userdata();
		

		$categories = $this->get_categories();
		
		$data['categories'] = $categories;
		
		if( isset($session_data['account_id']) ){
			$data['user_logged'] = true;
			
			$address = $this->address->get_all_address( $session_data['account_id'] );
			$data['address'] = $address;
						
		}else {
			$notifications['warning'][] = "Por favor inicia sesión para continuar con tu compra";
			$this->session->set_flashdata('notifications', $notifications);
			redirect("/account");
		}
		
		
		$this->load->view("pages/" . $page, $data);
	}
	
	public function save_spc() {
		$data = file_get_contents("php://input");
		
		$shopping_cart_token = json_decode($data);
		
		$this->session->set_userdata('shoppingcart', $shopping_cart_token->data);
		
	}
}