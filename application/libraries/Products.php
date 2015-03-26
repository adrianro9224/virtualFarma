<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Products {
	
	
	public function save_products() {
		$CI =& get_instance();
		//ini_set( 'open_basedir' , '/var/www/html/Projects/virtualFarma.com.co/' );
		
		$CI->load->model('product_model');
		$CI->load->model('product_json_model');
		$CI->load->model('category_model');
		
		$categories = $CI->category_model->all_categories();
		
		//$handle = fopen("ftp://user:password@example.com/somefile.txt", "w");
		$handle = fopen(__ROOT__FILES__ . "csv/preciosmnd.csv", 'r');
		
		if( $handle !== FALSE ) {
			$products = array();
				
			$category_id = 1;
				
			while ( ($data = fgetcsv($handle, 130, '|')) !== FALSE ){
				$current_row = new stdClass();
		
				if( (count($data)) >= 6 ){
						
					if ($category_id > 4 )
						$category_id = 0;
						
					$current_row->PLU = utf8_encode($data[0]);
					$current_row->barcode = utf8_encode($data[1]);
					$current_row->name = utf8_encode($data[2]);
					$current_row->category_id = utf8_encode($category_id); //WTF ?
					$current_row->presentation = utf8_encode($data[3]);
					$current_row->description = utf8_encode($data[3]);
					$current_row->stock = utf8_encode($data[4]);
					$current_row->price = utf8_encode($data[5]);
						
					$products[] = $current_row;
						
					$category_id++;
				}
			}
			fclose( $handle );
			
			$num_of_products = count( $products );
			
			$CI->db->trans_start();
			
			//$product_ids = $CI->product_model->create_products_from_csv( $products );
			$products_json_id = $CI->product_json_model->insert_product_json( json_encode($products) );
			
			$CI->db->trans_complete();
			
			if ($CI->db->trans_status() === FALSE)
				return false;
			
			$result = new stdClass();
			
			$result->status = json_last_error();
		//	$result->product_ids = $product_ids;
			$result->products_json_id = $products_json_id;
			
			return $result;
			
				
		}
	}
	
	public function load_all_products() {
		$CI =& get_instance();
		
		$CI->load->model('product_json_model');
		
		$json_string_of_products = $CI->product_json_model->get_json_products();
		
		if ( isset($json_string_of_products) )
			return $json_string_of_products;
		
		return NULL;
	}
	
}