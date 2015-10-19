<?php
class product_agreement_model extends CI_Model {
    /**
     * instance the Model
     */
    function __construct() {
        //call the Model constructor
        parent::__construct();
    }

    /**
     * @param $product_ids_from_shoppingcart
     * @param $agreement_id
     * @return the founded product_agreements data or null in another case
     */
    public function get_by_product_ids( $product_ids_from_shoppingcart, $agreement_id ) {

        $this->db->select( 'product_id, discount' );
        $this->db->where_in( 'product_id', $product_ids_from_shoppingcart );
        $this->db->where( 'agreement_id', $agreement_id );

        $query = $this->db->get('product_agreement');

        if( $query->num_rows() > 0 ) {
            return $query->result();
        }

        return NULL;

    }

} 