<?php
Class Subcategories {

    public function get_subcategories_by_category_id( $category_id ) {

        $CI =& get_instance();

        $CI->load->model('subcategory_model');

        $subcategories = $CI->subcategory_model->get_by_category_id( $category_id );

        return $subcategories;

    }

}