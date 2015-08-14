<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 12/08/2015
 * Time: 11:21
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends MY_Controller {

    /**
     * Call to CI_controller constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library( array('addresses', 'account_types') );
    }

    public function create_address() {
        $post = file_get_contents("php://input");

        $info = json_decode( $post );

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
        }


        if( isset($session_data[$account_types[1] . '_id']) ) {

            $account_id = $session_data[$account_types[1] . '_id'];

            $info->data->from = 'ACCOUNT';

            $inserted = $this->addresses->write_account_sign_up_address( $info->data, $account_id );

            if ( isset($inserted) )
                echo 'SAVED';
            else
                echo 'RETRY';

        }else {
            echo 'SESSION_EXPIRED';
        }

    }

    public function update_address() {

        $post = file_get_contents("php://input");

        $info = json_decode( $post );

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
        }


        if( isset($session_data[$account_types[1] . '_id']) ) {

            $account_id = $session_data[$account_types[1] . '_id'];

            $updated = $this->addresses->change_address( $info->data, $account_id );

            if ( isset($updated) )
                echo 'UPDATED';
            else
                echo 'RETRY';

        }else {
            echo 'SESSION_EXPIRED';
        }


    }

    public function delete_address() {

        $post = file_get_contents("php://input");

        $info = json_decode( $post );

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
        }


        if( isset($session_data[$account_types[1] . '_id']) ) {

            $account_id = $session_data[$account_types[1] . '_id'];

            $deleted = $this->addresses->remove_address( $info->data, $account_id );

            if ( isset($deleted) )
                echo 'DELETED';
            else
                echo 'RETRY';

        }else {
            echo 'SESSION_EXPIRED';
        }


    }

    public function get_all() {

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }

        $result = new stdClass();

        if( isset($session_data[$account_types[1] . '_id']) ) {

            $account_id = $session_data[$account_types[1] . '_id'];
            $addresses = $this->addresses->get_every_addresses( $account_id );

            if ( isset($addresses) ) {

                $json_of_addresses = json_encode( $addresses );

                $result->json_error = json_last_error();

                if ( $result->json_error == "JSON_ERROR_NONE" ){

                    $result->addresses = $json_of_addresses;
                    $result->status = "CHARGED";

                    $response = $this->convert_response_to_json( $result );

                    if ( $response->error == "JSON_ERROR_NONE" )
                        echo $response->json_result;

                }
            } else {
                $result->status = "EMPTY";
                $response = $this->convert_response_to_json( $result );

                echo $response->json_result;
            }
        }else {
            $result->status = "SESSION_EXPIRED";
            $response = $this->convert_response_to_json( $result );

            echo $response->json_result;
        }
    }

    private function convert_response_to_json( $result ) {

        $response = new stdClass();

        $json_result = json_encode($result);
        $error = json_last_error();

        $response->json_result = $json_result;
        $response->error = $error;

        return $response;

    }

}