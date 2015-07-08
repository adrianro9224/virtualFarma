<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Contact extends MY_Controller {


    function __construct(){
        parent::__construct();
       // $this->load->model('pathology_model');
        //$this->load->library('roots');
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

        $breadcrumb->title = "Productos";

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

        $notifications['warning'] = "Hemos recibido tu inquietud, pronto estaremos en contacto!";
        $this->session->set_flashdata('notifications', $notifications );
        redirect('/contact');
    }


}