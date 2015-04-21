<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
	
	/**
	 * Controller constructor 
	 */
	function __construct() {
		parent::__construct();
		$this->load->model( array('product_model', 'account_model') );// add second param for add a "alias" ex: $this->load->model('Account', 'user')
 		$this->load->library( array('products', 'account_types', 'roots', 'categories'));
	}
	
	public function show_products_by_category($category_name) {
		
		$breadcrumb = new stdClass();
		
		$data['user_logged'] = false;
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $session_data['account_types'];
		}
		
		if( isset($session_data[$account_types[1] . '_id']) ){

			$account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);
			
			if( isset($account) ) {
				$data['account_id'] = $session_data[$account_types[1] . '_id'];
				$data['user_logged'] = true;
			}
		}
		
		
		$breadcrumb = new stdClass();
		
		$breadcrumb->title = "Productos";
		
		$breadcrumb_item = new stdClass();
		
		$breadcrumb_item->name = "productos";
		$breadcrumb_item->url = "/product/show_products_by_category/category_1";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['register'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		
		$category_id = NULL;
		$products_by_category_id = NULL;
		$notifications = array();

		$categories = $this->get_categories();
		
		
		$data['categories'] = $categories;
		
		if( isset($category_name) && !empty($category_name) ) {
			
			foreach ( $categories as $category ) {
					
				if( $category->name == ucfirst( str_replace('_', ' ', $category_name ) ) )
					$category_id = $category->id;
			}
			
			
			//get products by categories
			if( isset($category_id) ) {
					
				$data['category_name'] = $category_name;
				$data['title'] = 'Categoria ' . str_replace('_', ' ', $category_name);
				
				$products_by_category_id = $this->product_model->get_by_category_id($category_id);
				
				if( isset($products_by_category_id) ) {
					//calculate product discounts
					$products_with_discount = $this->_calculate_product_discount($products_by_category_id);
					
					$num_of_products = count( $products_with_discount );
					
					$test = str_replace(":", "dPoS", 
							str_replace("]", "cEnd", 
							str_replace(",", "coInit", 
							str_replace("\"", "cDInit", 
							str_replace("}", "llEnd", 
							str_replace("{", "llInit", 
									str_replace("[", "cInit", 
											json_encode($products_with_discount))))))));
					
					$data['products_by_category_id'] = $products_with_discount;
					$data['test'] = $test;
				}else {
					$notifications['warning'] = "No existen productos con esta categoría";
					$this->session->set_flashdata('notifications', $notifications );
					redirect('/');
				}
			}else {
				$notifications['warning'][] = "No existe esta categoría";
				$notifications['warning'][] = $category_name;
				$this->session->set_flashdata('notifications', $notifications );
				redirect('/');
			}
			
		}else {
			redirect('/');
		} 
		
		$this->load->view('pages/category', $data);
	}
	
	public function convert_csv_files_to_products( $identification_number = NULL, $password = NULL ) {
		if ( $this->input->is_cli_request() ) {
		}
		//security
		if ( isset($identification_number )&& isset($password) ) {
			$access_permited = $this->roots->validate_root_identity( $identification_number, $password );
				
			//call funtion for read from csv the categories and save this
			if ($access_permited) {
				
				echo "reading categories...";
				print "\n";
				$result = $this->products->read_categories_and_potential_products();
				
				if ( isset($result->categories) && isset($result->potential_products) ) {

					echo "reading products...";
					print "\n";
					$products = $this->products->read_products();
					

					echo "saving categories in the DB ...";
					print "\n";
					
					$categories_saved = $this->categories->save_categories( $result->categories );
					
					if ( isset($products)  && $categories_saved ){
						
						echo "Getting categories";
						$categories = $this->categories->load_categories();
						
						if ( isset($categories) ){

							echo "Indexing categories";
							
							$indexed_by_code_line_categories = $this->categories->index_categories_by_code_line( $categories );
							
							//associate products
							echo "associating products....";
							print "\n";
							
							foreach ( $products as $product ) {
								
	// 							foreach ( $result->potential_products as $potential_product ) {
									
									if ( array_key_exists(str_replace(" ", "", $product->name), $result->potential_products) )
										$product->category_id = $indexed_by_code_line_categories[$result->potential_products[str_replace(" ", "", $product->name)]->code_line]->id;
									else 
										$product->category_id = NULL;
	// 							}
								
							}
							
							echo "Products to save: " . count($products);
							print "\n";
							
							//var_dump($products);
							// saving in the db 
							 
							$this->db->trans_start();
							
							echo "saving products in the DB ...";
							print "\n";
							
							$products_saved = $this->product_model->create_products_from_csv( $products );
							
							if ( $products_saved && $categories_saved ){
								
								log_message('debug', 'products created' );
								echo "products saved in DB :)";
								print "\n";
								echo "Creating the JSON of products..";
								print "\n";
								
								$result = $this->products->create_json_of_products( $products );
								
								switch( $result->code_status ) {
									case JSON_ERROR_NONE:
										echo ' - Sin errores';
										echo "Saving JSON of products in product_json tabla...";
										
										$json_saved = $this->products->save_json_of_products( $result->products_in_json );
										
										if ( $json_saved ) 
											echo "JSON of Products saved :D.";
										else 
											echo "JSON no saved";
										
										break;
									case JSON_ERROR_DEPTH:
										echo ' - Excedido tamaño máximo de la pila';
										break;
									case JSON_ERROR_STATE_MISMATCH:
										echo ' - Desbordamiento de buffer o los modos no coinciden';
										break;
									case JSON_ERROR_CTRL_CHAR:
										echo ' - Encontrado carácter de control no esperado';
										break;
									case JSON_ERROR_SYNTAX:
										echo ' - Error de sintaxis, JSON mal formado';
										break;
									case JSON_ERROR_UTF8:
										echo ' - Caracteres UTF-8 malformados, posiblemente están mal codificados';
										break;
									default:
										echo ' - Error desconocido';
										break;
								}
												
								
							}else {
								log_message('error', 'products no created' );
								echo "products not saved in DB :(";
								print "\n";
							}
							
							$this->db->trans_complete();
								
							if ($this->db->trans_status() === FALSE)
								return false;
						}else
							echo "problem getting the categories";
							
						
					}else {
						echo "Problems completing the second process(reading products)";
						print "\n";
					}
					
				}else {
					echo "Problems completing the first process(reading categories and potential products)";
					print "\n";
				}
				
			} else
				show_404();
		
		}else
			show_404();
	}
	
	/**
	 * Calculate the discount of all products
	 * @param unknown $products
	 * @return Array[object] the products with your discounts
	 */
	private function _calculate_product_discount(&$products) {
		
		foreach ( $products as $product ) {
			
			$discount = NULL;
			
			$product->has_discount = false;
			
			if( isset($product->discount) ) {
				
				$product->has_discount = true;
				$discount = bcdiv($product->price, $product->discount); 
				$product->old_price = $product->price;
				$product->new_price = bcsub($product->price, $discount, 4);
				
			}
		}
		
		return $products;
	}
}