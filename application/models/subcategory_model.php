<?php
Class Subcategory_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_by_category_id( $category_id ) {

        $this->db->where('category_id', $category_id);

        $query = $this->db->get('sub_category');

        if( $query->num_rows() > 0 ) {
            return $query->result();
        }

        return NULL;

    }

}