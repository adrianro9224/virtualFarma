<?php
//site general views files
define("__ROOT__TEMPLATES__", dirname(dirname(__FILE__)) . "/views/templates/");
define("__ROOT__FILES__", dirname(dirname(dirname(__FILE__))) . "/assets/files_unsecured/");

//admin views
define("__ROOT__ADMIN__TEMPLATES__", dirname(dirname(__FILE__)) . "/views/admin/templates/");

//admin-admin views
define("__ROOT__ADMIN-ADMIN__", dirname(dirname(__FILE__)) . "/views/admin/admin-admin/");
define("__ROOT__ADMIN-ADMIN__TEMPLATES", dirname(dirname(__FILE__)) . "/views/admin/admin-admin/templates/");
//seller views
define("__ROOT__SELLER__", dirname(dirname(__FILE__)) . "/views/admin/seller/");
define("__ROOT__SELLER__TEMPLATES", dirname(dirname(__FILE__)) . "/views/admin/seller/templates/");

//farmacy views
define("__ROOT__FARMACY__", dirname(dirname(__FILE__)) . "/views/admin/farmacy/");
define("__ROOT__FARMACY__TEMPLATES", dirname(dirname(__FILE__)) . "/views/admin/farmacy/templates/");

//Facebook SDK
//define('FACEBOOK_SDK_V4_SRC_DIR', '/public/facebook-sdk/facebook-php-sdk-v4-4.0-dev/src/Facebook/');


class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
 		$this->load->model('account_model');
 		$this->load->library(array('categories'));
	}
	
	
	public function get_account( $user_logged_account_id ) {
		
		$result = $this->account_model->get_account_by_id( $user_logged_account_id );
		
		return $result;
		
	}
	
	public function get_categories() {
		$categories = $this->category_model->all_categories();
		
		return $categories;
	}
	
}