<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 22/07/2015
 * Time: 13:10
 */

class User_pathology_model extends CI_Model{

    /**
     * model constructor
     */
    function __construct(){
        parent::__construct();
    }

    /**
     * insert a row of type user_pathology
     * @param $info
     * @return insert_id
     */
    public function insert( $info ) {

        $data = array(
            'account_id' => $info->account_id,
            'pathology_id' => $info->pathology_id
        );

        $this->db->insert('user_pathology', $data);

        if( $this->db->affected_rows() > 0 ) {
            return $this->db->insert_id();
        }

        return NULL;

    }

    public function get_by_account_id_and_pathology_id( $pathology_id, $account_id ) {

        $this->db->where( 'account_id', $account_id );
        $this->db->where( 'pathology_id', $pathology_id );

        $query = $this->db->get('user_pathology');

        if ( $query->num_rows > 0 )
            return $query->row();

        return NULL;
    }

}