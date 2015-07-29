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
        $this->load->model(array('account_model', 'user_pathology_model', 'pathology_model'));
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

                $exitsPathology = $this->_check_if_exist( $pathology_info_to_save->pathologyId );

                if ( $exitsPathology ) {
                    //check if the user has the pathology registered
                    $pathology_registered = $this->_check_if_pathology_registered( $pathology_info_to_save->pathologyId, $account->id );

                    $result = NULL;

                    if ( $pathology_registered )
                        $result = "EXISTING";
                    else {

                        $row_data = new stdClass();

                        $row_data->account_id = $account->id;
                        $row_data->pathology_id = $pathology_info_to_save->pathologyId;

                        $registered = $this->user_pathology_model->insert( $row_data );

                        if ( isset($registered) )
                            $result = "REGISTERED";

                    }

                    echo $result;
                }
            }
        }

    }

    /**
     *
     */
    public function remove_pathology() {

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
                $pathology_info_to_remove = json_decode( $post );

                $exitsPathology = $this->_check_if_exist( $pathology_info_to_remove->pathologyId );

                if ( $exitsPathology ) {
                    //check if the user has the pathology registered
                    $pathology_registered = $this->_check_if_pathology_registered( $pathology_info_to_remove->pathologyId, $account->id );

                    $result = NULL;

                    if ( $pathology_registered ) {
                        $row_data = new stdClass();

                        $row_data->account_id = $account->id;
                        $row_data->pathology_id = $pathology_info_to_remove->pathologyId;

                        $deleted = $this->user_pathology_model->delete_by_pathology_id( $row_data );

                        if ($deleted)
                            $result = "REMOVED";
                        else
                            $result = "ERROR";

                    }else {
                            $result = "NO_REGISTERED";
                    }

                    echo $result;
                }
            }
        }

    }

    public function get_all_pathologies() {

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }


        if( isset($session_data[$account_types[1] . '_id']) ) {

            $account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);

            if (isset($account)) {
                $data['account_id'] = $session_data[$account_types[1] . '_id'];
                $user_pathologies = $this->user_pathology_model->get_all_by_account_id( $account->id );

                if( isset($user_pathologies) ){
                    $json_of_user_pathologies = json_encode( $user_pathologies );
                    $json_error = json_last_error();

                    if ( $json_error != JSON_ERROR_NONE )
                        echo 'JSON_ERROR';
                    else
                        echo $json_of_user_pathologies;
                }else
                    echo "EMPTY";

            }
        }

    }

    private function _check_if_pathology_registered( $account_id, $pathology_id ) {

        $result = $this->user_pathology_model->get_by_account_id_and_pathology_id( $account_id, $pathology_id );

        return $this->_if_isset_valifation( $result );

    }

    private function _check_if_exist( $pathology_id ) {

        $result = $this->pathology_model->get_by_id( $pathology_id );

        return $this->_if_isset_valifation( $result );

    }

    private function _if_isset_valifation( $what_ever_result ) {

        if( isset($what_ever_result) )
            return true;
        else
            return false;

    }

}