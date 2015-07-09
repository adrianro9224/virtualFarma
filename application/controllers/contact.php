<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Contact extends MY_Controller {


    function __construct(){
        parent::__construct();
        //$this->load->model('pathology_model');
        $this->load->library(array('form_validation', 'mandrill_lib', 'account_types'));
    }

    public function index($page = 'contact') {


        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }
//    		phpinfo();
//    		die();

        $data['title'] = "Contacto"; // Capitalize the first letter
        $data['notifications'] = $this->session->flashdata('notifications');

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

        $categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();


        $breadcrumb = new stdClass();

        $breadcrumb->title = "Contactanos";

        $breadcrumb_item = new stdClass();

        $breadcrumb_item->name = "productos";
        $breadcrumb_item->url = "/product/show_products_by_category/nuestros_productos";
        $breadcrumb_item->active = true;

        $breadcrumb_list['register'] = $breadcrumb_item;

        $breadcrumb->items = $breadcrumb_list;

        $data['breadcrumb'] = $breadcrumb;

        $data['active_ingredients'] = $active_ingredients;
        $data['categories'] = $categories;

        if( isset($session_data[$account_types[1] . '_id']) ){
            $data['user_logged'] = true;
        }


        $this->load->view('pages/' . $page, $data);

    }


    public function send_pqrs() {

        $form = $this->input->post();

        $validation_response = $this->_validate_pqrs_form();

        if( $validation_response ) {
            $notifications['warning'] = "Hemos recibido tu comentario, pronto estaremos en contacto!";
            $this->session->set_flashdata('notifications', $notifications );

            $this->mandrill_lib->send_pqrs( $form );
        }else {
            $notifications['warning'] = "Por favor intentalo de nuevo!";
            $this->session->set_flashdata('notifications', $notifications );
        }

        redirect('/contact');
    }


    /**
     * Custom form log_in valilation
     * @return result true if the validation is clean, false in a other case
     */
    private function _validate_pqrs_form() {

        $this->form_validation->set_rules('name', 'The name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'UserPassword', 'required|xss_clean');
        $this->form_validation->set_rules('pqrs', 'UserPassword', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE)
            return false;

        return true;

    }


}