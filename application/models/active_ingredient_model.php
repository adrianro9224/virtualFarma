<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 9/06/15
 * Time: 01:44 AM
 */
Class Active_ingredient_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }


    public function get_all() {

        $this->db->order_by('name', 'asc');
        $query = $this->db->get('active_ingredient');

        if($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return NULL;

    }

    public function insert_from_array ( $active_ingredients ) {

        $insert_info = array();

        foreach ( $active_ingredients as $ingredient ) {

            $current_result = new stdClass();
            $data = array(
                'name' => $ingredient
            );

            $current_result->name = $ingredient;

            $this->db->insert('active_ingredient', $data);

            if( $this->db->affected_rows() == 1 ) {
                $current_result->insert_id = $this->db->insert_id();
                $insert_info[] = $current_result;
            }

        }

        return $insert_info;

    }

    public function update_by_ids ( $to_replace ) {

        $cont = 0;
        foreach ( $to_replace as $item ) {

            $this->db->set('name', ucfirst(str_replace('\'', '', $item->name)));
            $this->db->where('id', $item->id);

            $this->db->update('active_ingredient');

            $cont++;
        }

        return $cont == count($to_replace);
    }
}
