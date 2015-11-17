<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
	
	/**
	 * Controller constructor 
	 */
	function __construct() {
		parent::__construct();
		$this->load->model( array('product_model', 'account_model') );// add second param for add a "alias" ex: $this->load->model('Account', 'user')
 		$this->load->library( array('products', 'account_types', 'roots', 'categories' , 'form_validation', 'subcategories') );
	}
	
	public function show_products_by_category( $category_name, $from_items = 0 ){
		
		$breadcrumb = new stdClass();
		
		$data['user_logged'] = false;
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $account_types;
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
		$breadcrumb_item->url = "/product/show_products_by_category/nuestros_productos";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['register'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		
		$category_id = NULL;
		$products_by_category_id = NULL;
		$notifications = array();

		$categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();


        $data['active_ingredients'] = $active_ingredients;


        $data['categories'] = $categories;
		
		if( isset($category_name) && !empty($category_name) ) {

			$breadcrumb->sub_title = ucfirst(str_replace('-', ' ', str_replace('_', ' ', $category_name)));


            foreach ( $categories as $category ) {

                if( $category->name == ucfirst( str_replace('_', ' ', $category_name ) ) )
                    $category_id = $category->id;
            }

			//get products by categories
			if( isset($category_id) ) {
					
				$data['category_name'] = $category_name;
				$data['title'] = 'Categoria ' . str_replace('_', ' ', $category_name);

                if ( $category_name == "sex_shop" ) {

                    $subcategories = $this->subcategories->get_subcategories_by_category_id($category_id);
                    $data['subcategories'] = $subcategories;
                }


                $products_by_category_id = $this->product_model->get_by_category_id($category_id);

				if( isset($products_by_category_id) ) {
					//calculate product discounts
					$products_with_discount = $this->_calculate_product_discount($products_by_category_id);
					
					$base_url = base_url() . "/product/show_products_by_category/" . $category_name . '/';
					$uri_segment = 4;

					/*$products_encoded = str_replace(":", "dPoS", 
							str_replace("]", "cEnd", 
							str_replace(",", "coInit", 
							str_replace("\"", "cDInit", 
							str_replace("}", "llEnd", 
							str_replace("{", "llInit", 
									str_replace("[", "cInit", 
											json_encode($products_with_discount))))))));*/
					$this->_do_pagination( $base_url, $uri_segment, $products_with_discount, $data, $from_items );
					
					//$data['products_encoded'] = $products_encoded;
				}else {
					$notifications['warning'] = "No existen productos con esta categoría";
					$this->session->set_flashdata('notifications', $notifications );
					redirect('/');
				}
			}else {
				$notifications['warning'][] = "No existe esta categoría " . $category_name;
				$this->session->set_flashdata('notifications', $notifications );
				redirect('/');
			}
			
		}else {
			redirect('/');
		} 
		$this->load->view('pages/category', $data);
	}


    public function show_products_by_sub_category_id( $category_name, $subcategory_id, $from_items = 0 ){

        $data['user_logged'] = false;

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
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
        $breadcrumb_item->url = "/product/show_products_by_category/sex_shop";
        $breadcrumb_item->active = true;

        $breadcrumb_list['register'] = $breadcrumb_item;

        $breadcrumb->items = $breadcrumb_list;

        $data['breadcrumb'] = $breadcrumb;

        $category_id = NULL;
        $products_by_category_id = NULL;
        $notifications = array();

        $categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();


        $data['active_ingredients'] = $active_ingredients;


        $data['categories'] = $categories;

        if( isset($category_name) && !empty($category_name) ) {

            $breadcrumb->sub_title = ucfirst(str_replace('-', ' ', str_replace('_', ' ', $category_name)));
            $category_id = 290;

            //get products by categories
            if( isset($subcategory_id) ) {

                $data['category_name'] = $category_name;
                $data['title'] = 'Categoria ' . str_replace('_', ' ', $category_name);


                $subcategories = $this->subcategories->get_subcategories_by_category_id($category_id);
                $data['subcategories'] = $subcategories;

                $products_by_category_id = $this->product_model->get_by_subcategory_id( $subcategory_id );

                if( isset($products_by_category_id) ) {
                    //calculate product discounts
                    $products_with_discount = $this->_calculate_product_discount($products_by_category_id);

                    $base_url = base_url() . "/product/show_products_by_sub_category_id/" . $category_name . '/' . $subcategory_id;
                    $uri_segment = 5;

                    /*$products_encoded = str_replace(":", "dPoS",
                            str_replace("]", "cEnd",
                            str_replace(",", "coInit",
                            str_replace("\"", "cDInit",
                            str_replace("}", "llEnd",
                            str_replace("{", "llInit",
                                    str_replace("[", "cInit",
                                            json_encode($products_with_discount))))))));*/
                    $this->_do_pagination( $base_url, $uri_segment, $products_with_discount, $data, $from_items );

                    //$data['products_encoded'] = $products_encoded;
                }else {
                    $notifications['warning'] = "No existen productos con esta categoría";
                    $this->session->set_flashdata('notifications', $notifications );
                    redirect('/');
                }
            }else {
                $notifications['warning'][] = "No existe esta categoría " . $category_name;
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
			if ( $access_permited ) {
				
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
								
								$products_from_db = $this->product_model->get_all();
								
								$result = $this->products->create_json_of_products( $products_from_db );
								
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

    public function generate_json_of_products_for_seller_module( $id_admin = null ) {


        if ( isset($id_admin) && $id_admin == '1069741091' ) {

            $products_from_db = $this->product_model->get_all();

            $result = $this->products->create_json_of_products($products_from_db);

            switch ($result->code_status) {
                case JSON_ERROR_NONE:
                    echo ' - Sin errores';
                    echo "Saving JSON of products in product_json tabla...";

                    $json_saved = $this->products->save_json_of_products($result->products_in_json);

                    if ($json_saved)
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
        }



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
				$product->new_price = bcsub($product->price, $discount);
				
			}
		}

        return $products;
	}
	
	private function _do_pagination( $base_url, $uri_segment , $products_with_discount, &$data, $from_items ) {
		$this->load->library('pagination');
		$num_of_products = count($products_with_discount); 
		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $num_of_products;
		$config['per_page'] = 5;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['first_link'] = 'Priméra';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Última';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		//$config['use_page_numbers'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		if ( $num_of_products > $config['per_page'] ) {
			
			$products_to_show = array_slice( $products_with_discount, $from_items, $config['per_page'] );
			
			$data['products_by_category_id'] = $products_to_show;
			
		}else {
			$data['products_by_category_id'] = $products_with_discount;
		}
		
		
	}

    public function show_product_by_id( $product_id ) {

        //$product_info_to_search = $this->input->post( NULL, TRUE );


        $data['title'] = "Resultados";

        $data['user_logged'] = false;

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }

        if( isset($session_data[$account_types[1] . '_id']) ){

            $account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);

            if( isset($account) ) {
                $data['account_id'] = $session_data[$account_types[1] . '_id'];
                $data['user_logged'] = true;
            }
        }


        $breadcrumb = new stdClass();

        $breadcrumb->title = "Producto";

        $breadcrumb_item = new stdClass();

        $breadcrumb_item->name = "productos";
        $breadcrumb_item->url = "/product/show_products_by_category/nuestros_productos";
        $breadcrumb_item->active = true;

        $breadcrumb_list['register'] = $breadcrumb_item;

        $breadcrumb->items = $breadcrumb_list;

        $data['breadcrumb'] = $breadcrumb;

        $category_id = NULL;
        $products_by_category_id = NULL;
        $notifications = array();

        $categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();


        $data['active_ingredients'] = $active_ingredients;


        $data['categories'] = $categories;

        if ( !empty($product_id) ) {

            $data['string_to_search'] = $product_id;

            //$breadcrumb->sub_title = $product_info_to_search['productName'];

            $products = $this->product_model->get_by_product_id($product_id);

            //echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            if (isset($products)) {

                if (isset($products[0]->active_ingredient))
                    $related_products_by_active_ingredient = $this->product_model->get_by_active_ingredient($products[0]->active_ingredient);
                else
                    $related_products_by_active_ingredient = NULL;

                if (isset($related_products_by_active_ingredient))
                    $data['related_products'] = (count($related_products_by_active_ingredient) > 12) ? array_slice($related_products_by_active_ingredient, 0, 11) : $related_products_by_active_ingredient;

                $this->_calculate_product_discount($products);

                //$notifications['warning'] = "Productos encontrádos!!";

                $data['products_by_category_id'] = $products;

                $this->session->set_flashdata('notifications', $notifications);

                $this->load->view('pages/category', $data);
            } else {
                $this->_show_products_page_not_found($notifications, $data);
            }

        }else{
            redirect('/');
        }


    }

	public function all_products_for_search_input() {
		
		$products = $this->product_model->get_all_just_names_and_presentation();

        if ( isset($products) ) {
            $json_string_of_products = json_encode( $products );

            if( isset($json_string_of_products) ){
                echo $json_string_of_products;
            }else
                echo 'NULL';
        }
	}
	
	public function search_product( $product_info = NULL, $from_items = 0 ) {
		
		
		$product_info_to_search = $this->input->post( NULL, TRUE );
		
		
		$data['title'] = "Resultados";
		
		$data['user_logged'] = false;
		
		$session_data = $this->session->all_userdata();
		
		if( !isset($session_data['account_types']) ) {
			$account_types = $this->account_types->get_account_types();
			$this->session->set_userdata('account_types', $account_types);
		}else{
			$account_types = $session_data['account_types'];
			$data['account_types'] = $account_types;
		}
		
		if( isset($session_data[$account_types[1] . '_id']) ){
		
			$account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);
				
			if( isset($account) ) {
				$data['account_id'] = $session_data[$account_types[1] . '_id'];
				$data['user_logged'] = true;
			}
		}
		
		
		$breadcrumb = new stdClass();
		
		$breadcrumb->title = "Resultados para";
		
		$breadcrumb_item = new stdClass();
		
		$breadcrumb_item->name = "productos";
		$breadcrumb_item->url = "/product/show_products_by_category/nuestros_productos";
		$breadcrumb_item->active = true;
		
		$breadcrumb_list['register'] = $breadcrumb_item;
		
		$breadcrumb->items = $breadcrumb_list;
		
		$data['breadcrumb'] = $breadcrumb;
		
		$category_id = NULL;
		$products_by_category_id = NULL;
		$notifications = array();
		
		$categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();


        $data['active_ingredients'] = $active_ingredients;


        $data['categories'] = $categories;
		
		if ( !empty($product_info_to_search) ) {

			$validation_response = $this->_validate_search_product_form();
			
			if ( $validation_response ) {

                $data['string_to_search'] = $product_info_to_search['productName'];

				$breadcrumb->sub_title = $product_info_to_search['productName'];
				
				$products = $this->product_model->get_by_name( $product_info_to_search['productName'] );

				//echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				
				if ( isset($products) ) {

                    if( isset($products[0]->active_ingredient) )
                        $related_products_by_active_ingredient = $this->product_model->get_by_active_ingredient( $products[0]->active_ingredient );
                    else
                        $related_products_by_active_ingredient = NULL;

                    if ( isset($related_products_by_active_ingredient) )
                        $data['related_products'] = ( count($related_products_by_active_ingredient) > 12 ) ? array_slice($related_products_by_active_ingredient, 0, 11): $related_products_by_active_ingredient;

					$this->_calculate_product_discount( $products );
					
					$base_url = $base_url = base_url() . "/product/search_product/" . str_replace( ' ', '_', trim($product_info_to_search['productName'])) . '/';
					$uri_segment = 4;
					
					$this->_do_pagination($base_url, $uri_segment, $products, $data, $from_items);
					
					$notifications['warning'] = "Productos encontrádos!!";
					$this->session->set_flashdata('notifications', $notifications );
					
					$this->load->view('pages/category', $data);
				}else {
                    $this->_show_products_page_not_found( $notifications, $data );
				}
				
			}else {
				redirect('/');
				
			}
		}else {
			if ( isset( $product_info ) ) {
				
				$breadcrumb->sub_title = $product_info;
				
				$products = $this->product_model->get_by_name( str_replace('_', ' ', $product_info) );
				//echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				
				if ( isset($products) ) {
						
					$this->_calculate_product_discount( $products );

                    if( isset($products[0]->active_ingredient) )
                        $related_products_by_active_ingredient = $this->product_model->get_by_active_ingredient( $products[0]->active_ingredient );
                    else
                        $related_products_by_active_ingredient = NULL;

                    if ( isset($related_products_by_active_ingredient) )
                        $data['related_products'] = $related_products_by_active_ingredient;
						
					$base_url = $base_url = base_url() . "/product/search_product/" . str_replace( ' ', '_', trim($product_info)) . '/';
					$uri_segment = 4;
						
					$this->_do_pagination($base_url, $uri_segment, $products, $data, $from_items);
						
					$this->load->view('pages/category', $data);
				}else {
					$this->_show_products_page_not_found( $notifications, $data );
				}
				
			}
		}
		
		
		
	}

    public function request_product() {

        //$product_info_to_request = $this->input->post( NULL, TRUE ); // the two parameters returns all POST items with XSS filter

        $data['title'] = "Solicitar producto";

        $data['user_logged'] = false;

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }

        if( isset($session_data[$account_types[1] . '_id']) ){

            $account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);

            if( isset($account) ) {
                $data['account'] = $account;
                $data['account_id'] = $session_data[$account_types[1] . '_id'];
                $data['user_logged'] = true;
            }
        }



        $breadcrumb = new stdClass();

        $breadcrumb->title = "Solicitud de producto";

        $breadcrumb_item = new stdClass();

        $breadcrumb_item->name = "productos";
        $breadcrumb_item->url = "/product/show_products_by_category/nuestros_productos";
        $breadcrumb_item->active = true;

        $breadcrumb_list['register'] = $breadcrumb_item;

        $breadcrumb->items = $breadcrumb_list;

        $data['breadcrumb'] = $breadcrumb;

        $category_id = NULL;
        $products_by_category_id = NULL;

        $notifications = $this->session->flashdata('notifications');

        $aux_data = $this->session->flashdata('data');

        if ( isset($aux_data)&& !empty($aux_data['string_to_search']) ) {
            $data['string_to_search'] = $aux_data['string_to_search'];


            $categories = $this->get_categories();

            $data['categories'] = $categories;
            $active_ingredients = $this->get_active_ingredients();
            $data['active_ingredients'] = $active_ingredients;


            if ($data['user_logged'])
                $notifications['info'] = "Como has iniciado sesión puedes disfrutar de este, uno de nuestros servicios especialmente creados para tí";
            else
                $notifications['danger'] = "Para poder solicitar productos debes estar registrádo y haber iniciado sesión, hazlo dando click <a href='/account'>aquí</a>";

            //$this->session->set_flashdata('notifications', $notifications );
            $data['notifications'] = $notifications;

            $data['string_to_search'] =

            $this->load->view('pages/request_products', $data);
        }else{
            redirect('/');
        }
    }

    public function send_product_request(){

        $product_request_info = $this->input->post( NULL, TRUE );

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }

        if( $product_request_info ){

            if( isset($session_data[$account_types[1] . '_id']) ){

                $account_id = $session_data[$account_types[1] . '_id'];

                $validation_response = $this->_validate_product_request_form();

                if ( $validation_response ) {

                    $product_request_saved = $this->products->save_product_request( $product_request_info, $account_id );

                    if( $product_request_saved ) {

                        $notifications['primary'][] = "La información de tu producto a sido recibída, pronto estaremos comunicandonos contigo para confirmar tu solícitud :)";

                    }else{
                        $notifications['danger'][] = "Ocurrio un problema con tu solicitud, por favor intentalo de nuevo :'(";
                    }

                    $this->session->set_flashdata('notifications', $notifications);
                    redirect('/product/request_product');

                }else {

                    $notifications['danger'][] = "Ocurrio un problema con tu solicitud, por favor intentalo de nuevo :'(";

                    $this->session->set_flashdata('notifications', $notifications);
                    redirect('/product/request_product');
                }
            }else {

                $notifications['danger'][] = "Tu Session a expirado :,(";

                $this->session->set_flashdata('notifications', $notifications);
                redirect('/product/request_product');

            }

        }

    }

    private function _show_products_page_not_found( &$notifications, &$data ) {

        $notifications['info'] = "No existen resultados para la búsqueda. Si no encontraste el medicamento que estabas buscando puedes enviarnos los datos de este y nos pondremos en contacto para confirmar el envío en el menor tiempo posible";
        $this->session->set_flashdata('notifications', $notifications );
        $this->session->set_flashdata('data', $data);
        redirect('/product/request_product');
    }


    public function show_products_by_active_ingredient_id ( $active_ingredient_id, $from_items = 0 ) {

        $data['user_logged'] = false;

        $session_data = $this->session->all_userdata();

        if( !isset($session_data['account_types']) ) {
            $account_types = $this->account_types->get_account_types();
            $this->session->set_userdata('account_types', $account_types);
        }else{
            $account_types = $session_data['account_types'];
            $data['account_types'] = $account_types;
        }

        if( isset($session_data[$account_types[1] . '_id']) ){

            $account = $this->account_model->get_account_by_id($session_data[$account_types[1] . '_id']);

            if( isset($account) ) {
                $data['account_id'] = $session_data[$account_types[1] . '_id'];
                $data['user_logged'] = true;
            }
        }


        $breadcrumb = new stdClass();

        $breadcrumb->title = "Productos por principio activo";

        $breadcrumb_item = new stdClass();

        $breadcrumb_item->name = "productos";
        $breadcrumb_item->url = "/product/show_products_by_category/sex_shop";
        $breadcrumb_item->active = true;

        $breadcrumb_list['register'] = $breadcrumb_item;

        $breadcrumb->items = $breadcrumb_list;

        $data['breadcrumb'] = $breadcrumb;

        $category_id = NULL;
        $products_by_category_id = NULL;
        $notifications = array();

        $categories = $this->get_categories();
        $active_ingredients = $this->get_active_ingredients();


        $data['active_ingredients'] = $active_ingredients;
        $data['categories'] = $categories;

        if( isset($active_ingredient_id) ) {

            $data['title'] = "Productos por principio activo";

            $products_by_active_ingredient = $this->product_model->get_by_active_ingredient_id( $active_ingredient_id );

            if( isset($products_by_active_ingredient) ) {
                //calculate product discounts
                $products_with_discount = $this->_calculate_product_discount($products_by_active_ingredient);

                $base_url = base_url() . "/product/show_products_by_active_ingredient_id/" . $active_ingredient_id;
                $uri_segment = 4;

                /*$products_encoded = str_replace(":", "dPoS",
                        str_replace("]", "cEnd",
                        str_replace(",", "coInit",
                        str_replace("\"", "cDInit",
                        str_replace("}", "llEnd",
                        str_replace("{", "llInit",
                                str_replace("[", "cInit",
                                        json_encode($products_with_discount))))))));*/
                $this->_do_pagination( $base_url, $uri_segment, $products_with_discount, $data, $from_items );

                //$data['products_encoded'] = $products_encoded;
            }else {
                $notifications['warning'] = "No existen productos con este principio activo";
                $this->session->set_flashdata('notifications', $notifications );
                redirect('/');
            }
        }else {
            $notifications['warning'][] = "No existe esta categoría ";
            $this->session->set_flashdata('notifications', $notifications );
            redirect('/');
        }

        $this->load->view('pages/category', $data);

    }
/*
    public function associate_active_ingredient() {

        $general_drugs = $this->read_vademecum();

        $products_db = $this->product_model->get_without_active_ingredient();
       // $products_db = $this->product_model->get_all();

        $products_with_out_active_ingredient = array();
        $products_with_active_ingredient = array();

        foreach ( $general_drugs as $general ) {

            foreach ( $products_db as $key => $product ) {

                    if ( !isset($product->active_ingredient) ) {

                    $pos = strpos( str_replace(' ', '', strtolower($product->name)), str_replace(' ', '', $general->name ));
                    $pos1 = strpos( strtolower($product->name), $general->active_ingredient );

                    if ( $pos1 === false && $pos === false )
                        $products_with_out_active_ingredient[$key]  = $product;

                    else {
                        $product->active_ingredient = ucfirst($general->active_ingredient);
                        $products_with_active_ingredient[$key] = $product;
                    }
                }
            }
        }


        echo count($products_with_active_ingredient);
        echo count( $products_db );

        //var_dump($products_with_active_ingredient);

        $updated = $this->product_model->update_active_ingredients( $products_with_active_ingredient );

        if ( $updated )
            echo ':D';
        else
            echo ':\'(';

    }

    private function read_vademecum() {
        //$handle = fopen(__ROOT__FILES__ . "csv/vademecum_General_(01-05-15).csv", 'r'); // ok
        //$handle = fopen(__ROOT__FILES__ . "csv/vademecum_cronicos_(10-02-15).csv", 'r'); //ok
        $handle = fopen(__ROOT__FILES__ . "csv/vademecum-solidario-01-03-2015.csv", 'r');

        if( $handle !== FALSE ) {
            $general_drugs = array();

            while ( ($data = fgetcsv($handle, 200, ',')) !== FALSE ){
                $current_row = new stdClass();

                //var_dump(count($data));


                $current_row->name = strtolower(utf8_encode(trim($data[1])));
                $current_row->active_ingredient = strtolower(utf8_encode(trim($data[5])));
                $general_drugs[] = $current_row;


            }
        }

        fclose( $handle );

        return $general_drugs;
    }
*/

/*
    public function save_ai(){

        $active_ingredients = array();

        $products = $this->product_model->get_all();

            foreach ($products as $product ) {

                if ( isset($product->active_ingredient) )
                    $active_ingredients[$product->active_ingredient] = $product->active_ingredient;

            }
        $info_insert_ids = $this->active_ingredient_model->insert_from_array($active_ingredients);

        foreach ($products as $product) {

            foreach( $info_insert_ids as $info ){

                if ($product->active_ingredient == $info->name) {
                    $product->active_ingredient_id = $info->insert_id;
                }
            }

        }

        $result = $this->product_model->update_active_ingredient_id($products);

        var_dump($result);

    }

*/	public function load_data() {

    	$result = $this->products->read_vehicles();

    	//var_dump($result);

    	$vehicles_filtered = $this->_filter_vehicles( $result );

    	//var_dump($vehicles_filtered);

    	//var_dump( $this->products->save_vechicles( $vehicles_filtered ) );

	}

	private function _filter_vehicles( $list ) {

		$vehicles_filtered = array();
		$text_to_search_aux = "TIPO ";
		$text_to_search = "-";

		$check_next = false;
		$key_aux =  NULL;

		foreach ($list as $key => $value) {

			$model_data = new stdClass();

			if( isset($value->type) ) {

				$current_model = ( isset($value->model) && !empty($value->model) ) ? $value->model : "NO-MODEL";
				$current_year = ( isset($value->year) && !empty($value->year) ) ? $value->year : "NO-ESPECIFICADO";
				$current_pcd = ( isset($value->pcd) && !empty($value->pcd) ) ? $value->pcd : "NO-ESPECIFICADO";

				$model_data->model = $current_model;
				$model_data->pcd = $current_pcd;
				$model_data->year = $current_year;

				$vehicles_filtered[$value->brand]['models'][$current_model] = $model_data;
			}

		}

		return $vehicles_filtered;

	}

    public function save_copi_products( $admin_id ) {


        if( $admin_id == '1069741091' ) {

            $copi_products = $this->products->read_copidrogas_products()->copidrogas_products;

            //var_dump($copi_products);
            var_dump($this->product_model->create_products_from_csv( $copi_products ));

        }
    }


    public function update_products_from_master_POS( $admin_id ) {


        if( $admin_id == '1069741091' ) {


            $db_products = $this->product_model->get_all();


            foreach ($db_products as $product) {

                $db_products_sorted[$product->PLU] = $product;

            }

            $result = $this->products->read_master_products();

            $pos_products = $result->pos_products;

            echo count($pos_products) . ' - ' . count($db_products);

            //var_dump($pos_products[1]);

            $cont = 0;

            $new_products = array();

            foreach ($pos_products as $pos_product) {

                $exits = false;

                if (isset($db_products_sorted[$pos_product->PLU])) {
                    $exits = true;
                }

                if (!$exits)
                    $new_products[] = $pos_product;
            }

            var_dump($new_products);

            //var_dump($this->product_model->create_products_from_csv($new_products));

            //var_dump($this->product_model->update_prices( $products_new_prices ));
        }

    }

    /**
	 * Custom form sing_up valilation
	 * @return result of form validation
	 */
	private function _validate_search_product_form() {
	
		$this->form_validation->set_rules('productName', 'productName', 'required|max_length[64]|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
			return false;
	
		return true;
	
	}

    private function _validate_product_request_form() {

        $this->form_validation->set_rules('productName', 'productName', 'required|max_length[64]|xss_clean');
        $this->form_validation->set_rules('productLab', 'productLab', 'required|max_length[64]|xss_clean');
        $this->form_validation->set_rules('productPresentation', 'productPresentation', 'required|max_length[64]|xss_clean');
        $this->form_validation->set_rules('date_of_product_request', 'date', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE)
            return false;

        return true;

    }
}