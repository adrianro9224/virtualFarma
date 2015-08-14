<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {
	
	/**
	 * Call to CI_controller constructor
	 */
	function __construct() {
		parent::__construct();
		$this->load->library( array('addresses', 'orders', 'account_types', 'accounts', 'mandrill_lib') );
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
			
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		$categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();

        $data['active_ingredients'] = $active_ingredients;
		$data['categories'] = $categories;
		$data['shoppingcart'] = null;
		
		if( isset($session_data[$account_types[1] . '_id']) ){
			$data['user_logged'] = true;
			
			//$address = $this->addresses->get_sign_up_address( $session_data[$account_types[1]. '_id'] ); all addresses are called from angular controller

			$account_data = $this->get_account($session_data[$account_types[1] . '_id']);

            if ( isset($account_data->points) )
                $data['points'] = $account_data->points;

			$payment_methods = $this->Payment_method_model->get_enabled_payment_methods();
			
			if ( isset($payment_methods) )
            $data['payment_methods'] = $payment_methods;

            $shipping_data = $this->_check_if_shipping_data_completed( $account_data );

            $data['shipping_data'] = null;

            if( isset($shipping_data) )
                $data['shipping_data'] = $shipping_data;
					
			//create else with info for complete the account info
			
		}else {
			$notifications['info'][] = "Por favor regístrate ó inicia sesión para continuar con tu compra";
			$this->session->set_flashdata('notifications', $notifications);
			redirect("/account");
		}
		
		
		$this->load->view("pages/" . $page, $data);
	}
	
	private function _check_if_shipping_data_completed( $account_data ) {

        $shipping_data = null;
        $shipping_data = new stdClass();

        if ( isset($account_data->first_name) )
            $shipping_data->names = $account_data->first_name;

        if ( isset($account_data->second_name) )
            $shipping_data->names = $shipping_data->names . ' ' . $account_data->second_name;

        if ( isset($account_data->last_name) )
            $shipping_data->last_names = $account_data->last_name;

        if ( isset($account_data->surname) )
            $shipping_data->last_names = $shipping_data->last_names . ' ' . $account_data->surname;

        if ( isset($account_data->email) )
            $shipping_data->email = $account_data->email;

        if ( isset($account_data->identification_number) )
            $shipping_data->identification_number = $account_data->identification_number;

        if ( isset($account_data->phone) )
            $shipping_data->phone = $account_data->phone;

        if ( isset($account_data->mobile) )
            $shipping_data->mobile  = $account_data->mobile;

		return $shipping_data;
	}
	
	
	public function create_order() {
		//add sleep
		$post = file_get_contents("php://input");
		
		$order = json_decode( $post );
		$format = 'Y-m-d H:i:s';
		$order->data->date = date($format, strtotime($order->data->date));

		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if ( isset($session_data[$account_types[1] . '_id']) || isset($session_data[$account_types[2] . '_id']) ) {
			
			$account_id = NULL;
			
			if ( isset($session_data[$account_types[1] . '_id']) )
				$account_id = $session_data[$account_types[1] . '_id'];
			
			if ( isset($session_data[$account_types[2] . '_id']) )
				$account_id = $session_data[$account_types[2] . '_id'];
			
			$result = $this->orders->save_order( $order->data, $account_id );

            //redeem points
            if ( $order->data->shoppingcart->hasDiscount ) {
                $redeemed = $this->accounts->redeem_points($order->data->shoppingcart->pointsDoDiscount, $account_id);

                if ( $redeemed )
                    $saved = $this->accounts->save_points( $order->data->points, $account_id );

                if ( $result && $saved && $redeemed ) {
                    echo 'true';
                }else {
                    echo 'false';
                }
            }else {
                $saved = $this->accounts->save_points( $order->data->points, $account_id );

                if ($result && $saved) {

                    if( $order->data->from != 'CALL_CENTER') {

                        $account = $this->get_account( $account_id );
                        //if( $account->email == "adrian.romero9224@gmail.com") {
                        $this->mandrill_lib->send_order_sended( $order->data, $account );
                        //}

                    }

                    echo 'true';
                }else {
                    echo 'false';
                }
            }

		} else 
			redirect('/account');
		
		
	}
	
	
}