<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agreements {

    public function search_products_for_use_agreement_code( $info ) {

        $CI =& get_instance();
        $result = new stdClass();

        $CI->load->model('agreement_model');

        $agreement = $CI->agreement_model->get_agreement_by_code( $info->code );

        if( isset($agreement) ){

            $agreement_id = $agreement->id;
            $products_ids_from_shoppingcart = $info->productIds;

            $CI->load->model('product_agreement_model');

            $products_by_agreement = $CI->product_agreement_model->get_by_product_ids( $products_ids_from_shoppingcart, $agreement_id );

            if( isset($products_by_agreement) ) {
                $result->status = "PRODUCT_AGREEMENT_FOUNDED";
                $result->data = $products_by_agreement;
            }else {
                $result->status = "PRODUCT_AGREEMENT_NOT_FOUND";
            }
        }else{
            $result->status = "CODE_NOT_FOUND";
        }

        return $result;
    }

}