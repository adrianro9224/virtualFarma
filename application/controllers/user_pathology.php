<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 22/07/2015
 * Time: 11:09
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_pathology extends MY_Controller {

    /**
     * Class constructor
     */
    function __construct() {
        parent::__construct();

        $this->load->library(array('account_types'));
        $this->load->model(array('account_model', 'user_pathology_model'));
    }


    /**
     *
     */
    public function add_pathology() {


        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }


        if( isset($session_data[$account_types[1] . '_id']) ){

            $account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);

            if( isset($account) ) {
                $data['account_id'] = $session_data[$account_types[1] . '_id'];

                $post = file_get_contents("php://input");
                $pathology_info_to_save = json_decode( $post );

                $exitsPathology = $this->_check_if_exist( $post->pathologyId );
                echo var_dump($pathology_info_to_save);

            }
        }

    }

    private function _check_if_exist( $pathology_id ) {


        $result = $this->pathology_model->get_by_id( $pathology_id );

        if( isset($result) )
            return true;
        else
            return false;

    }

}