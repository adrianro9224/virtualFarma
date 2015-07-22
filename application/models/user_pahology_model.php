<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 22/07/2015
 * Time: 13:10
 */

class User_pahology_model extends CI_Model{

    /**
     * model constructor
     */
    function __construct(){
        parent::__construct();
    }

    public function insert( $info ) {

        $data = array(
            'account_id' => $info->acount_id,
            'pathology_id' => $info->pathology_id
        );

        $this->db->insert('user_pathology', $data);

        if($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }

        return NULL;

    }

}