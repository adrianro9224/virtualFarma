<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 9/06/15
 * Time: 02:48 AM
 */

Class Active_ingredients {

    public function get_all_active_ingredients() {

        $CI =& get_instance();

        $CI->load->model('active_ingredient_model');

        $result = $CI->active_ingredient_model->get_all();

        if( isset($result) )
            return $result;

        return false;

    }

}