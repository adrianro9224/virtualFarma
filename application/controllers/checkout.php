<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {
	
	/**
	 * Call to CI_controller constructor
	 */
	function __construct() {
		parent::__construct();
		$this->load->library('address');
		$this->load->model("Payment_method_model");
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
		$data['shoppingcart'] = null;
		
		if( isset($session_data['account_id']) ){
			$data['user_logged'] = true;
			
			$address = $this->address->get_all_address( $session_data['account_id'] );
			$account_data = $this->get_account($session_data['account_id']);
			$payment_methods = $this->Payment_method_model->get_enabled_payment_methods();
			
			if ( isset($payment_methods) )
				$data['payment_methods'] = $payment_methods;
			
			if ( isset($address->account_sing_up) && isset($account_data)){
				$shipping_data = $this->_check_if_shipping_data_completed($account_data, $address->account_sing_up);
				
				$data['shipping_data'] = null;
				
				if( isset($shipping_data) )
					$data['shipping_data'] = $shipping_data;
					
				
			}//create else with info for complete the account info
			
		}else {
			$notifications['warning'][] = "Por favor regístrate ó inicia sesión para continuar con tu compra";
			$this->session->set_flashdata('notifications', $notifications);
			redirect("/account");
		}
		
		
		$this->load->view("pages/" . $page, $data);
	}
	
	private function _check_if_shipping_data_completed($account_data, $addres_sign_up) {
		$shipping_data = null;
		if ( isset($account_data->first_name) 
				&& isset($account_data->second_name) 
				&& isset($account_data->last_name) 
				&& isset($account_data->surname) 
				&& isset($account_data->email) 
				&& isset($account_data->identification_number)
				&& isset($account_data->phone)
				&& isset($account_data->mobile)
				&& isset($addres_sign_up->address_line)
				&& isset($addres_sign_up->neighborhood)
			) {
			$shipping_data = new stdClass();
			
			$shipping_data->names = $account_data->first_name . ' ' . $account_data->second_name;
			$shipping_data->last_names = $account_data->last_name . ' ' . $account_data->surname;
			$shipping_data->email = $account_data->email;
			$shipping_data->identification_number = $account_data->identification_number;
			$shipping_data->address_line1 = $addres_sign_up->address_line;
			$shipping_data->neighborhood = $addres_sign_up->neighborhood;
			$shipping_data->phone = $account_data->phone;
			$shipping_data->mobile  = $account_data->mobile;
			
		}
		
		return $shipping_data;
	}
	
	public function save_spc() {
		$data = file_get_contents("php://input");
		
		$shopping_cart_token = json_decode($data);
		
		$this->session->set_userdata('shoppingcart', $shopping_cart_token->data);
		
	}
}