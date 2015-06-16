<?php
Class Product_request_model extends CI_Model{


    /*
     *Constructor
     */
    function __construct() {
        parent::__construct();
    }


    public function insert( $product_request_info, $account_id ) {
        //var_dump(setlocale(LC_ALL, 'es_ES'));

        $format = "Y-m-d H:i:s";

        $data = array(
            'name' => $product_request_info['productName'],
            'lab' => $product_request_info['productLab'],
            'presentation' => $product_request_info['productPresentation'],
            'date' =>  $product_request_info['date_of_product_request'],//date from client
            'account_id' => $account_id
        );

//        die( var_dump($data) );

        $this->db->insert('product_request', $data);

        if ( $this->db->affected_rows() == 1 )
            return $this->db->insert_id();

        return NULL;

    }

}
