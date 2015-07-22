<?php
 Class Pathology_model extends CI_Model {

     function __construct() {
         parent::__construct();
     }

     public function insert_pathologies( $pathologies ) {

         $num_of_pathologies_to_save = count( $pathologies );
         $insert_ids = array();

         foreach ($pathologies as $pathology ) {

             $data = array(
                 'name' => $pathology->name
             );

             $this->db->insert('pathology', $data);

             if ($this->db->affected_rows() == 1 )
                 $insert_ids[] = $this->db->insert_id();



         }

         if ( $num_of_pathologies_to_save == count($insert_ids) ) {
             return true;
         }

         return false;

     }

     public function get_all() {

         $query = $this->db->get('pathology');

         if ( $query->num_rows > 0 )
             return $query->result();

         return NULL;

     }

     public function get_by_id( $id_to_search ) {


         $this->db->where( 'id', $id_to_search );
         $query = $this->db->get('pathology');

         if ( $query->num_rows > 0 )
             return $query->result();

         return NULL;


     }
 }