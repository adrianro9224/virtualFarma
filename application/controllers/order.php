<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {
	
	/**
	 * Controller contructor
	 */
	function __construct(){
		parent::__construct();
		
		$this->load->model('order_model');
		//$this->load->helper(array('form', 'account_helper'));
		$this->load->library( array( 'account_types', 'orders', 'accounts', 'mandrill_lib') );
		
	}

	public function test() {

		$this->input->is_cli_request();
		echo "Holaaa mundoo".PHP_EOL;
	}

	public function send_email_for_sended_orders( $root_id ) {

		if ( $root_id == "1069741091" ){

			$date_format = 'Y-m-d';
			$date_format_complete = 'Y-m-d H:i:s';

			$today = date( $date_format, $_SERVER['REQUEST_TIME'] );
			$yerterday = date( $date_format, strtotime($today . ' -1 day') );
			$tomorrow = date( $date_format, strtotime($today . ' +1 day') );
			$scheduled_to = $tomorrow .' 06:00:00';

			//$scheduled_to_test = date( $date_format_complete, strtotime($today . ' +5 minutes') );
			//echo $today;
			//echo $yerterday;

			//echo $scheduled_to_test;

			//$orders = $this->order_model->get_orders_by_date( $yerterday );

			//var_dump($orders);
			//print_r($orders);

			
			
			$accounts = array();
			$accounts[0]['email'] = "tuto13@gmail.com";
			$accounts[0]['name'] = "Carlos";
			$accounts[0]['type'] = "to";

			$accounts[1]['email'] = "adrianro9224@hotmail.com";
			$accounts[1]['name'] = "Adrian2";
			$accounts[1]['type'] = "to";
			
			//print_r($accounts);
			//if ( count($orders) > 0 ){
				//$accounts = $this->_construct_to_for_mandrill( $orders );

				print_r($accounts);

			//$send_at_format = '20120-06-01 08:15:01';

				$this->mandrill_lib->send_thanks_email( $accounts[0], $accounts );
			//}
		}

	}

	private function _construct_to_for_mandrill( $orders ) {

		$list_of_to = array();

		foreach ($orders as $key => $order) {
			
			$list_of_to[$key]['email'] = $order->email;
			$list_of_to[$key]['name'] = $order->first_name;
			$list_of_to[$key]['type'] = "to";

		}

		return $list_of_to;

	}

}
