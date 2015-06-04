<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Products {
	

    public function save_product_request( $product_request_to_save ) {

        $CI =& get_instance();

        $CI->load->model( 'product_request_model' );

        $insert_id = $CI->product_request_model->insert( $product_request_to_save );

        if ( isset($insert_id) )
            return true;

        return false;

    }

	public function read_products() {
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
				
// 			$category_id = 1;
				
			while ( ($data = fgetcsv($handle, 130, '|')) !== FALSE ){
				$current_row = new stdClass();
		
				if( (count($data)) >= 6 ){
						
// 					if ($category_id > 4 )
// 						$category_id = 0;
						
					$current_row->PLU = utf8_encode(trim($data[0]));
					$current_row->barcode = utf8_encode(trim($data[1]));
					$current_row->name =  utf8_encode( ucfirst( strtolower( trim( str_replace('/', '-', $data[2]))) ));
				//	$current_row->category_id = utf8_encode($category_id); //WTF ?
					$current_row->presentation = utf8_encode(trim($data[3]));
					$current_row->description = utf8_encode(trim($data[3]));
					$current_row->stock = utf8_encode(trim($data[4]));
					$current_row->price = utf8_encode(trim($data[5]));
						
					$products[] = $current_row;
						
// 					$category_id++;
				}
			}
			fclose( $handle );
			
			return $products;
				
		}
	}
	
	public function create_json_of_products( $products ) {
		
		$CI =& get_instance();
		
		$products_encoded = json_encode($products) ;
		
		$result = new stdClass();
			
		$result->code_status = json_last_error();
		$result->products_in_json = $products_encoded;
		
		return $result;
	}
	
	public function save_json_of_products( $products ) {
		$CI =& get_instance();
		
		$insert_id = $CI->product_json_model->insert_product_json( $products );
		
		if ( isset($insert_id) ) 
			return TRUE;
		
		return FALSE;
		
	}
	
	public function load_all_products() {
		$CI =& get_instance();
		
		$CI->load->model('product_json_model');
		
		$json_string_of_products = $CI->product_json_model->get_json_products();
		
		if ( isset($json_string_of_products) )
			return $json_string_of_products;
		
		return NULL;
	}
	
	public function read_categories_and_potential_products() {
		$CI =& get_instance();
	
		$handle = fopen(__ROOT__FILES__ . "csv/MundofarmaMarzo24de2015.csv", 'r');
	
		if( $handle !== FALSE ) {
			$result = new stdClass();
			$result->categories = array();
			$result->potential_products = array();
	
			while ( ($data = fgetcsv($handle, 199, ',')) !== FALSE ){
				$category = new stdClass();
				$potential_product = new stdClass();
	
				if( (count($data)) >= 8 ){
						
					$category->code_line = utf8_encode(trim($data[6]));
					$category->name =  utf8_encode(ucfirst( strtolower(trim(str_replace('/', '-',$data[7]))) ) );
					
					$potential_product->name = utf8_encode( ucfirst(strtolower(trim(str_replace('/', '-',$data[0])))) );
					$potential_product->code_line = $category->code_line;
	
					$result->categories[$category->code_line] = $category;
					$result->potential_products[str_replace(" ", "", $potential_product->name)] = $potential_product; 
				}
			}
			fclose( $handle );
		}
	
		return $result;
	}
	
	public function search_products_in_vademecum() {
		//load all products in DB
		
		//read vademecum 'general' and compare
		//read vademecum 'cronicos' and compare
		//read vademecum 'solidario' and compare
		
		
	}
	
}