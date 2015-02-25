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
		
		$shippingdata = null;
		
		if( isset($session_data['account_id']) ){
			$data['user_logged'] = true;
			
			$account = $this->get_account( $session_data['account_id'] );
			
			$address = $this->address->get_all_address( $session_data['account_id'] );
			$data['address'] = $address;
			
			
			if ( isset($account) && isset($address) ) {
				
				if (	(isset($account->first_name)) 
						&& (isset($account->second_name)) 
						&& (isset($account->last_name))
						&& (isset($account->surname))
						&& (isset($account->surname))
						&& (isset($account->identification_number))
						&& (isset($account->phone))
						&& (isset($account->mobile))
						&& (isset($account->email))
						&& (isset($address->address_line))
						&& (isset($address->neighborhood))
						
					) {
						die('a');
						$shippingdata = new stdClass();
						
						$shippingdata->names = $account->first_name . ' ' . $account->second_name;
						$shippingdata->last_names = $account->last_name . ' ' . $account->surname;
						$shippingdata->email = $account->email;
						$shippingdata->identification_number = $account->identification_number;
						$shippingdata->address_line1 = $address->address_line;
						$shippingdata->neighborhood = $address->neighborhood;
						$shippingdata->phone = $account->phone;
						$shippingdata->mobile = $account->mobile;
						
				}
			}
			
			$data['shippingdata'] = $shippingdata;
			
		}else {
			$notifications['warning'][] = "Por favor registrate ó inicia sesión para continuar con tu compra";
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