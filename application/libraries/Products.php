<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Products {
	

    public function get_home_products() {

        $CI =& get_instance();
		$CI->load->model('product_model');

        $products = $CI->product_model->get_by_category_id( 1 );

        $first_products_ids = array('5', '7', '43289');

        $first_products = array();

        if ( isset($products) ) {

            foreach( $products as $key=>$product ) {

                if ( $product->id == $first_products_ids[0] ) {
                    $first_products[] = $product;
                    unset($products[$key]);
                }

                if ( $product->id == $first_products_ids[1] ) {
                    $first_products[] = $product;
                    unset($products[$key]);
                }

                if ( $product->id == $first_products_ids[2] ) {
                    $first_products[] = $product;
                    unset($products[$key]);
                }

            }

            $sortedProducts = array();

            foreach( $first_products as $product ) {
                $sortedProducts[] = $product;
            }

            foreach( $products as $product ) {
                $sortedProducts[] = $product;
            }

            $num_of_poducts = count($sortedProducts);

            unset($sortedProducts[$num_of_poducts - 1]);
        }

        return $sortedProducts;

    }

    public function save_product_request( $product_request_to_save, $account_id ) {

        $CI =& get_instance();

        $CI->load->model( 'product_request_model' );

        $insert_id = $CI->product_request_model->insert( $product_request_to_save, $account_id );

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

	public function read_vehicles() {
		$CI =& get_instance();
		//ini_set( 'open_basedir' , '/var/www/html/Projects/virtualFarma.com.co/' );
		
		// $CI->load->model('product_model');
		// $CI->load->model('product_json_model');
		$CI->load->model('tym_vehicle_model');
		
		//$categories = $CI->category_model->all_categories();
		
		//$handle = fopen("ftp://user:password@example.com/somefile.txt", "w");
		$handle = fopen(__ROOT__FILES__ . "csv/Tablas_finalescsv.csv", 'r');
		
		if( $handle !== FALSE ) {
			$vehicles = array();
				
// 			$category_id = 1;

			$count_aux = 0;
				
			while ( ($data = fgetcsv($handle, 150, ',')) !== FALSE  ){
				$current_row = new stdClass();

				//var_dump($data);
				if ( ($count_aux >= 2) && (count($data) >= 5) ) {
					//die();
					$current_row->type = utf8_encode(trim($data[0]));
					$current_row->brand = utf8_encode(trim($data[1]));
					$current_row->model = utf8_encode(trim($data[2]));
					$current_row->pcd = utf8_encode(trim($data[3]));
					$current_row->year = utf8_encode(trim($data[4]));
				}
						
					$vehicles[] = $current_row;
						
// 					$category_id++;
				
				$count_aux++;
			}
			fclose( $handle );
			
			return $vehicles;
				
		}
	}

	public function save_vechicles( $to_save ) {

		$CI =& get_instance();
		$CI->load->model('tym_vehicle_model');

		$rin_types = $CI->tym_vehicle_model->get_rin_types();

		//var_dump($rin_types);

		//var_dump($to_save);

		//var_dump($this->_search_rin_types( $rin_types, $to_save ));
		$result = $CI->tym_vehicle_model->insert_vehicles( $this->_search_rin_types( $rin_types, $to_save ) );

	  	return $result;
	}
	
	private function _search_rin_types( $rin_types, $types_and_inch ) {

		$rines = array();

		$data = $types_and_inch;

		$i =0;

		foreach ($rin_types as $key1 => $value1) {

			$current_rin = new stdClass();

			foreach ($types_and_inch as $key2 => $value2) {
				
				if( $key2 == $value1->brand ) {
					
					$data[$value1->brand]['id'] = $value1->id;

				}
				//(var_dump($rines));
			}
		}

		return $data;
	}

	public function create_json_of_products( $products ) {
		
		//$CI =& get_instance();

		$products_encoded = json_encode($products) ;
		
		$result = new stdClass();
			
		$result->code_status = json_last_error();
		$result->products_in_json = $products_encoded;
		
		return $result;
	}
	
	public function save_json_of_products( $products ) {
		$CI =& get_instance();

        $CI->load->model('product_json_model');

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
		//$CI =& get_instance();
	
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


    public function read_copidrogas_products() {

        $handle = fopen(__ROOT__FILES__ . "csv/Copidrogas_products.csv", 'r');

        if( $handle !== FALSE ) {
            $result = new stdClass();
            //$result->categories = array();
            $result->copidrogas_products = array();

            while ( ($data = fgetcsv($handle, 150, ',')) !== FALSE ){
           //     $category = new stdClass();
                $copidrogas_product = new stdClass();

                if( (count($data)) >= 10 ){

                    //$category->code_line = utf8_encode(trim($data[6]));
                    //$category->name =  utf8_encode(ucfirst( strtolower(trim(str_replace('/', '-',$data[7]))) ) );

                    //$copidrogas_product->name = utf8_encode( ucfirst(strtolower(trim(str_replace(' ', '',$data[2])))) );

                    $copidrogas_product->name = ucfirst(utf8_encode( strtolower(trim(($data[2]))) ));
                    $copidrogas_product->price = (trim($data[4]) < trim($data[5])) ? trim($data[5]): trim($data[4]);
                    $copidrogas_product->presentation = trim($data[3]);
                    $copidrogas_product->description = trim($data[3]);
                    $copidrogas_product->lab = trim($data[7]);
                    $copidrogas_product->stock = ($copidrogas_product->price > 0 ) ? 1 : 0;
                    $copidrogas_product->tax = (trim($data[6]) == "0.16") ? 1 : 0;

                   // $result->categories[$category->code_line] = $category;
                    $result->copidrogas_products[] = $copidrogas_product;
                }
            }
            fclose( $handle );
        }

        return $result;

    }

    public function read_master_products() {

        $handle = fopen(__ROOT__FILES__ . "csv/MaestroGaleriasJunio302015.csv", 'r');

        if( $handle !== FALSE ) {
            $result = new stdClass();
            //$result->categories = array();
            $result->pos_products = array();

            while ( ($data = fgetcsv($handle, 250, ',')) !== FALSE ){
                //     $category = new stdClass();
                $master_product = new stdClass();

                if( (count($data)) >= 10 ){

                    //$category->code_line = utf8_encode(trim($data[6]));
                    //$category->name =  utf8_encode(ucfirst( strtolower(trim(str_replace('/', '-',$data[7]))) ) );

                    //$copidrogas_product->name = utf8_encode( ucfirst(strtolower(trim(str_replace(' ', '',$data[2])))) );
                    $master_product->PLU = utf8_encode( strtolower(trim(str_replace('/', '-',(str_replace(' ', '',$data[0])))) ));
                    $master_product->barcode = utf8_encode( strtolower(trim(str_replace('/', '-',(str_replace(' ', '',$data[1])))) ));
                    $master_product->name = utf8_encode( strtolower(trim($data[2])) );
                    $master_product->presentation = utf8_encode( strtolower(trim($data[3])) );
                    $master_product->description = utf8_encode( strtolower(trim($data[3])) );
                    $master_product->tax = (trim($data[12]) == "16") ? 1 : 0;
                    $master_product->price = (trim($data[12]));
                    $master_product->stock = (trim($data[12]) == "0") ? 0 : 1;
                    $master_product->lab = utf8_encode( trim($data[5]) );

                    // $result->categories[$category->code_line] = $category;
                    $result->pos_products[$master_product->PLU] = $master_product;
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