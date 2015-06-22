<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts {
	
	public function get_pathologies( $account_id ) {
		$CI =& get_instance();
		
		$CI->load->model("account_model");
		
		$pathologies = $CI->account_model->get_pathologies_by_id( $account_id );
		
		return $pathologies;
		
	}
	
	public function generate_pathologies_dropdown_items_ids( $categories_pathologies ) {
		$ids = array();
		
		foreach ( $categories_pathologies as $pathology ) {
			$ids[lcfirst(str_replace(' ', '_', $pathology->name))] = $pathology;
		}
		
		return $ids;
	}

    public function save_points ( $number_of_points, $account_id ) {

        $CI =& get_instance();
        $CI->load->model("account_model");

        $account_with_points = $CI->account_model->get_points( $account_id );

        if ( isset($account_with_points->points) )
            $points_to_save = $account_with_points->points + $number_of_points;
        else
            $points_to_save = $number_of_points;

        $result = $CI->account_model->update_points( $points_to_save, $account_id );

        return $result;
    }

    public function redeem_points( $pointsDoRedeem, $account_id ) {

        $CI =& get_instance();
        $CI->load->model("account_model");

        $account_with_points = $CI->account_model->get_points( $account_id );

        $points_to_save = $account_with_points->points - $pointsDoRedeem;

        $result = $CI->account_model->update_points( $points_to_save, $account_id );

        return $result;

    }

    public function search_account_by_identification_number( $identification_number_to_search ) {

        $CI =& get_instance();
        $CI->load->model("account_model");

        $account = $CI->account_model->get_by_identification_number( $identification_number_to_search );

        return $account;

    }
	
}