<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
	
	/**
	 * Controller constructor 
	 */
	function __construct() {
		parent::__construct();
		$this->load->model( array('product_model', 'account_model') );// add second param for add a "alias" ex: $this->load->model('Account', 'user')
// 		$this->load->library('functions');
	}
	
	public function show_products_by_category($category_name) {
		
		$breadcrumb = new stdClass();
		
		$data['user_logged'] = false;
		
		$session_data = $this->session->all_userdata();
		
		if( isset($session_data['account_id']) ){

			$account = $this->account_model->get_account_by_id($session_data['account_id']);
			
			if( isset($account) ) {
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
					
					$data['products_by_category_id'] = $products_with_discount;
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
	
	public function convert_csv_file_to_array_of_products() {
		if ( $this->input->is_cli_request() ) {
		}
		//$handle = fopen("ftp://user:password@example.com/somefile.txt", "w");
		$handle = fopen(__ROOT__FILES__ . "\\preciosmnd.csv", "r+");
		$categories = $this->get_categories();
		
		if( $handle !== FALSE ) {
			
			$products =array();
			
			$category_id = 1;
			
			while ( ($data = fgetcsv($handle, 130, '|')) !== FALSE ){
				$current_row = new stdClass();
				
				if( (count($data)) >= 6 ){
					
					if ($category_id > 4 )
						$category_id = 0;
					
					$current_row->PLU = $data[0];
					$current_row->name = $data[2];
					$current_row->category_id = $category_id; //WTF ?
					$current_row->presentation = $data[3];
					$current_row->description = $data[3];
					$current_row->stock = $data[4];
					$current_row->price = $data[5];
					
					$products[] = $current_row;
					
					$category_id++;
				}
			}
			fclose( $handle );
			
			$num_of_products = count( $products );
			 
			$product_ids = $this->product_model->create_produts_from_csv( $products );
			
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
				$product->new_price = bcsub($product->price, $discount, 4);
				
			}
		}
		
		return $products;
	}
}