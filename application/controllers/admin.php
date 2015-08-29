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
		$this->load->library( array('form_validation', 'account_types', 'products', 'orders', 'accounts', 'addresses', 'mandrill_lib') );
		
	}
	
	public function index( $page = "admin" ) {
		$data['title'] = $page;
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if ( isset($session_data[$account_types[0] . '_id']) || isset($session_data[$account_types[2] . '_id']) || isset($session_data[$account_types[3] . '_id']) || isset($session_data[$account_types[4] . '_id']) )
			redirect('/admin/admin_login');
		
		$this->load->view($page . '/index', $data );
		
	}
	
	public function admin_login() {
		
		$admin_login_form = $this->input->post();
		
		$notifications = NULL;
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if ( isset($session_data[$account_types[0] . '_id']) || isset($session_data[$account_types[2] . '_id']) || isset($session_data[$account_types[3] . '_id']) || isset($session_data[$account_types[4] . '_id']) ) {
			
			$admin_id = $this->_search_admin_id_in_session($session_data, $account_types);
				
			
			$admin_account = $this->account_model->get_admin_account_by_id( $admin_id );
			
			$this->_choose_admin_account( $admin_account, $account_types, $notifications );
			
		} else {
			if ( $admin_login_form ) {
				
				$validation_response = $this->_validate_admin_log_in_form();
				
				if ( $validation_response ) {
										
					$admin_account = $this->account_model->get_admin_account_by_identification_number( $admin_login_form['adminUsername'] );
					
					if ( isset($admin_account) ) {
						
						$password_decrypted_from_db = _password_account_h2o( $admin_account->password, $admin_account->email );
						
						$admin_user_password = md5($admin_login_form['adminUserPassword']);
						
						if ( $password_decrypted_from_db ==  $admin_user_password ) {
							//call switch
							$this->_choose_admin_account( $admin_account, $account_types, $notifications );
						}
						
					}
					
				}
			}else{
				redirect('/admin');
			}
		} 
		
	}

    public function search_client() {

        $post = $this->input->post();

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $session_data['account_types'];
        }

        if ( isset($session_data[$account_types[0] . '_id']) || isset($session_data[$account_types[2] . '_id']) || isset($session_data[$account_types[3] . '_id']) || isset($session_data[$account_types[4] . '_id']) ) {

            $admin_id = $this->_search_admin_id_in_session($session_data, $account_types);

            $admin_account = $this->account_model->get_admin_account_by_id($admin_id);

            if ($post) {

                $client_identification_number = $post['clientId'];

                $account = $this->accounts->search_account_by_identification_number($client_identification_number);

                if ( isset($account) ){

                    $data['client_account'] = $account;

                    $address = $this->address->get_all_address( $account->id );;

                    if ( isset($address) )
                        $data['address'] = $address;

                    if ( isset($account->points) )
                        $data['points'] = $account->points;

                    $notifications['success'] = "Cliente encontrádo!!";

                    $this->_choose_admin_account($admin_account, $account_types, $notifications, $data);
                }else {
                    $notifications['danger'] = "El cliente no existe!!";
                    $this->_choose_admin_account($admin_account, $account_types, $notifications);
                }

            } else {
                redirect('/admin');
            }
        }else{
            redirect('/admin');
        }
    }
	
	private function _choose_admin_account( $admin_account, $account_types, &$notifications, $data = null ) {
		
		unset( $admin_account->password );
		$data['account_types'] = $account_types;
		
		switch ( $admin_account->account_type_id ) {
			case 1:
				//admin

				$data['title'] = 'Administrador';
				$data['type_of_admin'] = $account_types[0];
                $this->_admin_do_login($account_types[0], $admin_account, $account_types, $data);
				
				$this->load->view('admin/control_panel', $data);
				break;
			case 2:
				//user
				$notifications['warning'] = "No tienes permisos para acceder :P";
				$this->session->set_flashdata('notifications', $notifications);
				redirect('/');
				break;
			case 3:
				//seller
				$data['title'] = 'Ventas';
				$data['type_of_admin'] = $account_types[2];

                if( isset($notifications) )
                    $data['notifications'] = $notifications;

				$this->_admin_do_login( $account_types[2], $admin_account, $account_types, $data );
				$this->load->view('admin/seller/index', $data);
				break;
			case 4:
				//root
				$data['title'] = 'ROOT';
				$data['type_of_admin'] = $account_types[3];
				break;
			case 5:
				//farmacy
				$data['title'] = 'Farmacia';
				$data['type_of_admin'] = $account_types[4];
				
				$orders = $this->orders->orders_for_FARMACY_account( $admin_account->farmacy_id );
				
				$data['orders'] = NULL;
				
				if( isset($orders) ){
					$data['orders'] = $orders;
                    $data['numOfordersWithoutSend'] = $this->count_orders_without_send( $orders );
				}
				
				$this->_admin_do_login( $account_types[4], $admin_account, $account_types, $data );
				$this->load->view('admin/farmacy/index', $data);
				break;
		}
	}

    private function count_orders_without_send( $orders ) {

        $num_of_orders_without = 0;

        foreach( $orders as $order ) {
            if( $order->status == 'RECEIVED' )
                $num_of_orders_without++;
        }

        return $num_of_orders_without;

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
	
	private function _search_admin_id_in_session( $session_data, $account_types ) {
		
		foreach ( $session_data as $key=>$data ) {
			foreach ($account_types as $type){
				if( $key == ($type . '_id') )
					return $data;
			}
		}
		
	}
	
	public function _delete_others_account_id_in_session( $account_for_put_in_session, $account_types ) {
		$user_data = $this->session->all_userdata();
		
		$types_to_unset = array();
		
		foreach ( $account_types as $type ) {
			if ( $type != $account_for_put_in_session )
				$types_to_unset[] = $type;
		}
		
		foreach ( $types_to_unset as $type ) {
			if ( isset($user_data[$type . '_id']) )
				$this->session->unset_userdata($user_data[$type . '_id']);
		}
		
	}
	
	public function change_order_status() {
		
		$post = file_get_contents("php://input");
		
		$orderInfo = json_decode( $post );
		$format = 'Y-m-d H:i:s';
		$orderInfo->data->date = date($format, strtotime($orderInfo->data->date));
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if ( isset($session_data[$account_types[4] . '_id']) ) {
			
			$order_updated = $this->orders->update_order_by_id( $orderInfo->data->orderId, $orderInfo->data->newOrderStatus, $orderInfo->data->date);
			
			if ( $order_updated ) {

                if ( $orderInfo->data->newOrderStatus == "SENDED" ) {

                    $order = $this->orders->get_order_by_id( $orderInfo->data->orderId );

                    $account = $this->account_model->get_account_by_id( $order->account_id );

                    if ( isset($account) && isset($order) ) {
                        if ( $account->account_type_id == 2 ) {
                            $this->mandrill_lib->send_order_confirmed( $order, $account, $orderInfo->data->date );
                        }
                    }
                }

				echo 'true';
			}else {
				echo 'false';
			}
			
		}
		
	}

	public function video_presentacion () {

		$data['title'] = "Presentacion";
		
		
		$this->load->view('admin/video_presentacion', $data);
	}
	
	/**
	 * Delete the account_id of the session for terminate the log_in
	 */
	public function log_out() {
	
		$this->session->sess_destroy();
		
		redirect("/admin");
	}
	
	
	private function _admin_do_login( $type_of_admin, $admin_account, $account_types, &$data = array()) {
		//add that delete other session id of other account if, exist just one
		$this->_delete_others_account_id_in_session( $type_of_admin, $account_types );
		
		$this->session->set_userdata( $type_of_admin . '_id' , $admin_account->id );
		
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