<?php
Class Pathologies {

    public function get_all_pathologies() {
        $CI =& get_instance();

        $CI->load->model('pathology_model');

        $pathologies = $CI->pathology_model->get_all();

        if ( isset($pathologies) )
            return $pathologies;

        return NULL;


    }


}