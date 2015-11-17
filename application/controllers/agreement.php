<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 14/10/2015
 * Time: 14:33
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agreement extends MY_Controller {

    /**
     * Call to CI_controller constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library( array('account_types', 'agreements') );
        //$this->load->model( 'agreement' );
    }


    public function use_agreement_code() {

        $post = file_get_contents("php://input");

        $info = json_decode( $post );

        $result = new stdClass();

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
        }


        if( isset($session_data[$account_types[1] . '_id']) ) {

            $account_id = $session_data[$account_types[1] . '_id'];

            //var_dump($account_id);
            //var_dump($info);

            //create agreements library
            $result = $this->agreements->search_products_for_use_agreement_code( $info );

        }else {
            $result->status = 'SESSION_EXPIRED';
        }

        $result = json_encode( $result );

        if( json_last_error() == 0 ) {
            echo $result;
        }else{
            $result->status = "ENCODING_ERROR";
            $result->data = json_last_error();
            echo json_encode($result);
        }


    }

}