<?php
class Agreement_model extends CI_Model {
    /**
     * instance the Model
     */
    function __construct() {
        //call the Model constructor
        parent::__construct();
    }

    /**
     * @param $agreement_code
     * @return the founded agreement data or null in another case
     */
    public function get_agreement_by_code( $agreement_code ) {

        $this->db->where( 'code', $agreement_code );

        $query = $this->db->get('agreement');

        if( $query->num_rows() > 0 ) {
            return $query->row();
        }

        return NULL;

    }

} 