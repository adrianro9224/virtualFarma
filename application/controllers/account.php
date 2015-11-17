<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {
	
	/**
	 * Account controller constructor 
	 */
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'account_helper'));
		
		$this->load->library(array('form_validation', 'messages', 'accounts', 'addresses', 'account_types', 'orders', 'mandrill_lib', 'pathologies'));
		$this->load->model('account_model');// add second param for add a "alias" ex: $this->load->model('Account', 'user')
	}
	
	/**
	 * Show the account home view
	 * @param string $page
	 */
	public function index($page = 'account') {
		
		$data['notifications'] = $this->session->flashdata('notifications');
		$categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();

        $data['active_ingredients'] = $active_ingredients;

        $data['categories'] = $categories;
		
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['user_logged'] = false;

        if ( isset($_COOKIE['shoppingcart']) ){

            $shoppingcart = json_decode($_COOKIE['shoppingcart']);
            $data['shoppingcart'] = $shoppingcart;

        }
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if( isset($session_data[$account_types[1] . '_id']) ) {
			
			$account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);
			
			if( isset($account) ) {
				$data['user_logged'] = true;
				
			}else {
				$notifications['warning'] = "Oops! algo a sucedido, el administrador ya a sido notificado";
				$data['notifications'] = $notifications;
			}
		}
		

		
		$breadcrumb = new stdClass();
		
		$breadcrumb->title = "Registro";
		
		$breadcrumb_item = new stdClass();
		
		$breadcrumb_item->name = "Registro";
		$breadcrumb_item->url = "/account";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['register'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		
		$this->load->view('pages/' . $page, $data);
		
	}
	
	/**
	 * Create  a Account if the data are accepted or redirect to account View 
	 */
	public function sign_up() {
		
		$sign_up_form = $this->input->post();
		
		$notifications = array();
		
		$session_data = $this->session->all_userdata();
        $categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();

        $data['active_ingredients'] = $active_ingredients;
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if(isset($session_data[$account_types[1] . '_id'])) {
			redirect("account/log_in", "refresh");
		}
		
		$validation_response = $this->_validate_sign_up_form();
		
		$data['title'] = "Mi cuenta";
		$data['user_logged'] = false;
        $data['categories'] = $categories;
		
		// breadcrumb start
		$breadcrumb = new stdClass();
		
		$breadcrumb->title = "Mi cuenta";
		
		$breadcrumb_item = new stdClass();
		
		$breadcrumb_item->name = "Mi cuenta";
		$breadcrumb_item->url = "/account";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['register'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		//breadcrumb over
		
		
		if ($validation_response) {
			
			$userEmail = $sign_up_form['userEmail'];

			//check if exist a account registered with this email
			$account = $this->account_model->get_account_by_email($userEmail);
			
			if( isset($account) ){
				
				$message = "Ya existe una cuenta registrada con este email.";
				
				if ( isset($account->fb_id) )
					$message = "Ya existe una cuenta registrada con Facebook, inicia sesión con este.";
					
				$notifications['warning'] = $message;
				$this->session->set_flashdata('notifications', $notifications);
				redirect('/account');
			}
			
			$user_password_encrypted = _password_account_sal( md5( $sign_up_form['userPassword'] ), $userEmail);
			$sign_up_form['userPassword'] = $user_password_encrypted;
			
			$insert_id = $this->account_model->insert_account($sign_up_form);// successfully applied your rules without any of them failing.
			
			if( isset($insert_id) ){
				// do _log_in
				
				$account = $this->account_model->get_account_by_id($insert_id);

                if( isset($account->points) )
                    $data['points'] = $account->points;

                $pathologies = new stdClass();

                $messages = $this->messages->get_every_messages($account->email);
                $account_pathologies = $this->accounts->get_pathologies( $insert_id );

                $account_pathologies_dropdown_items_ids = $this->accounts->generate_pathologies_dropdown_items_ids( $categories );
                $pathologies->dropdown_items_ids = $account_pathologies_dropdown_items_ids;

                if( isset($messages) ) {
                    $messages_sorted = $this->messages->sort_messages($messages, $account->email);
                    $data['messages'] = $messages_sorted;
                }

                $address = $this->addresses->get_sign_up_address( $account->id );

                $data['address'] = $address;

                if( isset($account_pathologies) ) {
                    $pathologies->account_pathologies = $account_pathologies;

                }else {
                    $pathologies->account_pathologies = null;
                }

                $data['pathologies'] = $pathologies;


				$this->_do_login( $account , $data, $account_types);
				
				$notifications['success'][] = "Tu cuenta a sido creada con éxito, te hemos obsequiado <strong>1000 puntos</strong> que podrás redimir cuando quieras, bienvenido a VirtualFarma!";
				
				$data['notifications'] = $notifications;
				
				if( isset($_COOKIE['shoppingcart']) ) {
						
					$notifications['success'][] = "Los productos en tu carrito de compras están seguros :)!";
					$this->session->set_flashdata("notifications" ,$notifications);
						
					redirect("/checkout");
				}

                //if ( $account->email == "adrian.romero9224@gmail.com" || $account->email == "tuto13@gmail.com" || $account->email == "tuto13@yahoo.com" ) {
                $this->mandrill_lib->send_register_email( $account );
                //}

				$this->load->view('pages/account-panel', $data); // admin account panel
			}else {
				// level('error', 'debug')
				log_message('error', 'insert account not working');
				
				$notifications['danger'] = "Un evento inesperádo, el administrador de la página será notificádo :(";
				
				$this->session->set_flashdata('notifications', $notifications );
				
				redirect("/account");
			}
			
		}else {
			$notifications['danger'] = validation_errors();
			
			//print_r($notifications);//check this
			$this->session->set_flashdata('notifications', $notifications );
			
			//add redirect to account index and show errors
			redirect("/account");//you have problems
		}
		
	}
	
	private function _do_login( $account, &$data, $account_types ) {
		
		$account_id = $account->id;
		$this->session->set_userdata( $account_types[1] . '_id', $account_id );
		
		$data['user_logged_account'] = $account;
		$data['user_logged'] = true;
		
	}
	
	public function log_in() {
		
		$log_in_form = $this->input->post();
		
		$notifications = array();
		
		$data['messages'] = null;
		$data['pathologies'] = null;
		
		$data['title'] = "Mi cuenta";
		
		$categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();

        $data['active_ingredients'] = $active_ingredients;
		
		$data['categories'] = $categories;
		
		
		$data['user_logged'] = false;
		// breadcrumb start
		$breadcrumb = new stdClass();
		
		$breadcrumb->title = "Mi cuenta";
		
		$breadcrumb_item = new stdClass();
		
		$breadcrumb_item->name = "Mi cuenta";
		$breadcrumb_item->url = "/account";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['register'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		//breadcrumb over
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if( isset($session_data[$account_types[1] . '_id']) ){
			$data['user_logged'] = true;
				
			$notifications = $this->session->flashdata('notifications');
			$data['notifications'] = $notifications;
				
			$account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);
				
			if(isset($account)){
				$pathologies = new stdClass();
				
				$messages = $this->messages->get_every_messages($account->email);
				$account_pathologies = $this->accounts->get_pathologies( $session_data[$account_types[1] . '_id'] );

                $pathologies_DB = $this->pathologies->get_all_pathologies();

				$account_pathologies_dropdown_items_ids = $this->accounts->generate_pathologies_dropdown_items_ids( $categories );
				$pathologies->dropdown_items_ids = $account_pathologies_dropdown_items_ids;
				 
				if( isset($messages) ) {
					$messages_sorted = $this->messages->sort_messages($messages, $account->email);
					$data['messages'] = $messages_sorted;
				}
								
				if( isset($account_pathologies) ) {
					$pathologies->account_pathologies = $account_pathologies;
					
				}else {
					$pathologies->account_pathologies = null;
				}
				
				$data['pathologies'] = $pathologies;
				
				$address = $this->addresses->get_sign_up_address( $account->id );
				
				if( isset($_COOKIE['shoppingcart']) ) {
					$data['shoppingcart'] = json_decode($_COOKIE['shoppingcart']);
				}
				
				$orders = $this->orders->orders_for_USER_account( $account->id );
				
				if ( isset($orders) ) {

					foreach ( $orders as $key => $order ) {
						$orders[$key]->products = json_decode( $order->products );
					}
					
					$data['orders'] = $orders;
				}

                if( isset($account->points) )
                    $data['points'] = $account->points;

				$data['address'] = $address;
				
				$data['user_logged_account'] = $account;
					
				$this->load->view('pages/account-panel', $data);
			}else {
				$notifications['warning'] = "Por favor inicie sesión!";
				$this->session->set_flashdata('notificatons', $notifications);
				
				redirect('/account');
			}
				
				
		}else {
			if( $log_in_form ) {
				$validation_response = $this->_validate_log_in_form($log_in_form);
			
				if($validation_response) {
						
					$userEmail = $log_in_form['userEmail'];
					$account = $this->account_model->get_account_by_email($userEmail);
						
					if( isset($account) ) {
						
						$pathologies = new stdClass();
						
						$messages = $this->messages->get_every_messages( $account->email );
						
						if( $messages ) {
							$messages_sorted = $this->messages->sort_messages($messages, $account->email);
							$data['messages'] = $messages_sorted;
						}
						
						$account_pathologies = $this->accounts->get_pathologies( $account->id );
						
						$account_pathologies_dropdown_items_ids = $this->accounts->generate_pathologies_dropdown_items_ids( $categories );
						$pathologies->dropdown_items_ids = $account_pathologies_dropdown_items_ids;
						
						if( isset($account_pathologies) ) {
							$pathologies->account_pathologies = $account_pathologies;
								
						}else {
							$pathologies->account_pathologies = null;
						}
						
						$data['pathologies'] = $pathologies;
						
						$address = $this->addresses->get_sign_up_address( $account->id );
						
						$data['address'] = $address;
						
						$account_password_decrypted = _password_account_h2o( $account->password, $userEmail);
						$user_password = md5( $log_in_form['userPassword'] );
						
						if( $account_password_decrypted === $user_password ) {
							
							$orders = $this->orders->orders_for_USER_account( $account->id );
							
							if ( isset($orders) ) {

								foreach ( $orders as $key => $order ) {
									$orders[$key]->products = json_decode( $order->products );
								}
									
								$data['orders'] = $orders;
							}

                            if( isset($account->points) )
                                $data['points'] = $account->points;
								
							$this->_do_login( $account, $data, $account_types );

							if( isset($_COOKIE['shoppingcart']) ) {

                                $shoppingcart = json_decode( $_COOKIE['shoppingcart'] );

                                $data['shoppingcart'] = $shoppingcart;

								$notifications['success'][] = "Los productos en tu carrito de compras están seguros :)!";
								$this->session->set_flashdata("notifications" ,$notifications);
								if ( $shoppingcart->subtotal < $shoppingcart->minimumOrderValue ) {

                                    $notifications['info'] = "Continua con tus compras, estos son nuestros productos!";
                                    $this->session->set_flashdata('notifications', $notifications );

                                    redirect("/product/show_product_by_category/nuestros_productos");

                                }else {

                                    $notifications['info'] = "Puedes finalizar tu compra!";
                                    $this->session->set_flashdata('notifications', $notifications );

                                    redirect("/checkout");
                                }
							}
							
							$this->load->view('pages/account-panel', $data);
								
						}else {
							$notifications['danger'] = "El email o password no coinciden!";
							$this->session->set_flashdata('notifications', $notifications );
								
							redirect("/account");
						}
					}else {
						$notifications['warning'] = "No existe un usuario registrado con este email";
						$this->session->set_flashdata('notifications', $notifications );
			
						redirect("/account");
					}
				}
			}else{
				redirect("/");
			}
				
		}
		

		
	}
	
	/**
	 * Delete the account_id of the session for terminate the log_in
	 */
	public function log_out() {
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		$this->session->unset_userdata( $account_types[1] . '_id');
		redirect("/");
	}
	
	/**
	 * update the account with the new data
	 * @param String $account_id
	 */
	public function update_account( $account_id ) {
		
		$notifications = array();
		
		$update_account_form = $this->input->post();
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if(isset($session_data[$account_types[1] . '_id'])) {
			if($session_data[$account_types[1] . '_id'] == $account_id) {
				
				$validation_response = $this->_validate_update_account_form($update_account_form);
				
				if($validation_response) {
					$address = new stdClass();
					
					$address->line1 = $update_account_form['userAddressLine1'];
					$address->neighborhood = $update_account_form['userNeighborhood'];
					$address->from = "ACCOUNT_SING_UP";
					
					$address_registered_status = $this->addresses->write_account_sign_up_address( $address, $account_id );
					
					$result = $this->account_model->update_account($update_account_form, $account_id);
					
					if( isset($result) || isset($address_registered_status) ) {
						$notifications['success'] = "Tu cuenta a sido actualizada con exito!";
					}else{
						$notifications['warning'] = "No se realizaron los cambios!";
					}
				}else{
					$notifications['danger'] = validation_errors();
				}
						
				$this->session->set_flashdata('notifications', $notifications);
				redirect("/account/log_in");
				
			}else {
				$this->session->unset_userdata($account_types[1] . '_id');
				
				$notifications['info'] = "La sesion a expirado";
				
				$this->session->set_flashdata('notifications', $notifications);
				
				redirect("/");
			}	
		}else{
			redirect("/");
		}
		
		
	}
	
	
	public function facebook_login() {
		$post = file_get_contents("php://input");
		
		$user = json_decode($post)->data;

		$data = array();
		
		//create funtion for "sign_up facebook", add to the 'account' schema the property "sing_in acroos facebook flag"
		if ( isset($user->public_profile->email) ) {
			
			$session_data = $this->session->all_userdata();
			
			if( !isset($session_data['account_types']) ) {
				$account_types = $this->account_types->get_account_types();
				$this->session->set_userdata('account_types', $account_types);
			}else{
				$account_types = $session_data['account_types'];
				$data['account_types'] = $session_data['account_types'];
			}
			
			$account = $this->account_model->get_account_by_email( $user->public_profile->email );
			
			if ( isset($account) ) {
				
				if ( !isset($account->fb_id) ) {
					$updated =  $this->account_model->update_fb_id( $account->id, $user->id );

					if ( $updated ) {
						$this->_do_login($account, $data, $account_types);
						echo 'just_logued';
					}
					
				}
			}else {
				
				$insert_id = $this->account_model->insert_fb_account( $user->public_profile );
				
				if ( isset($insert_id) ) {
					$account = $this->account_model->get_account_by_id( $insert_id );
					if ( isset($account) )
						$this->_do_login($account, $data, $account_types);
					
					echo 'sign_up'; 
				}
				
			} 
			
		} 
	}

	/**
	 * Custom form log_in valilation
	 * @return result true if the validation is clean, false in a other case
	 */
	private function _validate_log_in_form() {
	
		$this->form_validation->set_rules('userEmail', 'UserEmail', 'required|xss_clean');
		$this->form_validation->set_rules('userPassword', 'UserPassword', 'required|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
			return false;
	
		return true;
	
	}
	
	/**
	 * Custom form sign_up valilation
	 * @return result true if the validation is clean, false in a other case
	 */
	private function _validate_sign_up_form() {
		
		$this->form_validation->set_rules('userFirstName', 'UserFirstName', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('userLastName', 'UserLastName', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('userEmail', 'UserEmail', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('userPassword', 'UserPassword', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('termsAndConditions', 'TermsAndConditions', 'required|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
			return false;
		
		return true;
		
	}
	
	/**
	 * Custom form edit_account valilation
	 * @return result of form validation
	 */
	private function _validate_update_account_form() {
	
		$this->form_validation->set_rules('userFirstName', 'UserFirstName', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('userSecondName', 'UserSecondName', 'max_length[64]|xss_clean');
		$this->form_validation->set_rules('userAddressLine1', 'UserAddressLine1', 'max_length[64]|xss_clean');
		$this->form_validation->set_rules('userNeighborhood', 'UserNeighborhood', 'max_length[64]|xss_clean');
		$this->form_validation->set_rules('userLastName', 'UserLastName', 'max_length[64]|xss_clean');
		$this->form_validation->set_rules('userSurname', 'UserSurname', 'max_length[64]|xss_clean');
		$this->form_validation->set_rules('userEmail', 'UserEmail', 'required|max_length[64]|xss_clean');
		$this->form_validation->set_rules('userId', 'UserEmail', 'max_length[64]|xss_clean');
		$this->form_validation->set_rules('userGender', 'UserGender', 'trim|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
			return false;
	
		return true;
	
	}

}