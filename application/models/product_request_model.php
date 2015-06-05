<?php
Class Product_request_model extends CI_Model{


    /*
     *Constructor
     */
    function __construct() {
        parent::__construct();
    }


    public function insert( $product_request_info ) {
        var_dump(setlocale(LC_ALL, 'es_ES'));

        $format = "Y-m-d H:i:s";

        $data = array(
            'name' => $product_request_info['product_name'],
            'lab' => $product_request_info['product_lab'],
            'presentation' => $product_request_info['product_presentation'],
            'date' =>  date($format)
        );


        $this->db->insert('product_request', $data);

        if ( $this->db->affected_rows() == 1 )
            return $this->db->insert_id();

        return NULL;

    }

}
