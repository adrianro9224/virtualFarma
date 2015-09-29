<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Recipients {


    public function get_recipient_by_phone( $client_phone_number ) {

        $CI =& get_instance();

        $CI->load->model("recipient_model");

        $recipient = $CI->recipient_model->get_last_by_phone( $client_phone_number );

        return $recipient;
    }



}