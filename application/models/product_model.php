<?php
class Product_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all() {
		
		$this->db->select('id, PLU, barcode, name, category_id, active_ingredient, presentation, stock, tax, price, discount, lab' );
		
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {

            $products = $query->result();

            $this->calculate_prices_to_client( $products );

			return $products;
		}
		
		return NULL;
	}

    public function get_by_product_id ( $product_id_to_search ) {

        $this->db->where('id', $product_id_to_search );

        $query = $this->db->get('product');

        if( $query->num_rows() > 0 ) {

            $products = $query->result();

            $this->calculate_prices_to_client( $products );

            return $products;
        }

        return NULL;

    }

    public function get_all_just_names_and_presentation () {

        $this->db->select('id, name, presentation, lab');
        $this->db->where('price >', 0);

        $query = $this->db->get('product');

        if( $query->num_rows() > 0 ) {

            $products = $query->result();

//            $this->calculate_prices_to_client( $products );

            return $products;
        }

        return NULL;

    }

    public function get_without_active_ingredient() {

        $this->db->where('active_ingredient');

        $query = $this->db->get('product');

        if( $query->num_rows() > 0 ) {
            $result = $query->result();
            return $result;
        }

        return NULL;

    }
	
	public function get_by_category_id($category_id) {
		
		$this->db->where('category_id', $category_id);
        $this->db->where('stock >', 0);
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {

            $products = $query->result();

            $this->calculate_prices_to_client( $products );

			return $products;
		}
		
		return null;
	}

    public function get_by_subcategory_id( $subcategory_id ) {

        $this->db->where('sub_category_id', $subcategory_id);
        $query = $this->db->get('product');

        if( $query->num_rows() > 0 ) {

            $products = $query->result();
            $this->calculate_prices_to_client( $products );

            return $products;
        }

        return null;
    }
	
	public function create_products_from_csv( $list_products ) {
		$product_ids = array();
		
		$num_of_products_to_save = count($list_products);

		foreach ($list_products as $product ) {
			$data = array(
					"name" => $product->name,
					"description" => $product->presentation,
					"stock" => $product->stock,
                    "tax" => $product->tax,
					"price" => $product->price,
                    "uri_img" => "productwithoutimage",
                    "image_format_id" => ".jpg"
					
			);

            if ( isset($product->PLU) )
                $data["PLU"] = $product->PLU;

            if ( isset($product->barcode) )
                $data["barcode"] = $product->barcode;

            if ( isset($product->category_id) )
                $data["category_id"] = $product->category_id;

            if ( isset($product->presentation) )
                $data["presentation"] = $product->presentation;

            if ( isset($product->lab) )
                $data["lab"] = $product->lab;


			$this->db->insert("product", $data);
			
			if( $this->db->affected_rows() == 1 )
				$product_ids[] = $this->db->insert_id();
		}

		
		if ( $num_of_products_to_save == count($product_ids) )
			return $product_ids;

		return false;
		
	}
	
	public function get_by_name( $pattern_to_search ) {

        $text_exploded = explode(' ', $pattern_to_search);

		////$this->db->like('name', $pattern_to_search);

        $this->db->like('name', $text_exploded[0]);

        if ( count($text_exploded) > 1 )
            $this->db->like('name', $text_exploded[1]);

        $this->db->where('price !=', 0);
		$query = $this->db->get('product');
		
		if( $query->num_rows() > 0 ) {

            $products = $query->result();
            $this->calculate_prices_to_client( $products );

			return $products;
		}
		
		return NULL;
		
	}

    public function update_active_ingredients( $products_to_update ) {

        $counter = 0;

        foreach ( $products_to_update as $product ) {

            if ( $product->category_id != 290 ) {

                $this->db->set('active_ingredient', $product->active_ingredient);
                $this->db->where('id', $product->id);

                $this->db->update('product');
            }else
                $counter++;

        }

        if ( $this->db->affected_rows() == (count($products_to_update) - $counter) )
            return true;

        return false;

    }

    public function get_by_active_ingredient ( $active_ingredient ) {

        $this->db->select('id, PLU, barcode, name, active_ingredient, category_id, presentation, stock, tax, price, discount, lab' );

        $this->db->where('active_ingredient', $active_ingredient);

        $query = $this->db->get('product');

        if( $query->num_rows() > 0 )
            return $query->result();

        return NULL;


    }

    public function update_active_ingredient_id ( $products_to_update ) {

        foreach ( $products_to_update as $product ) {

            if ( isset($product->active_ingredient_id)) {
                $this->db->set('active_ingredient_id', $product->active_ingredient_id);

                $this->db->where('id', $product->id);

                $this->db->update('product');
            }

        }


        if( $this->db->affected_rows() > 0 )
            return true;

        return false;
    }

    public function get_by_active_ingredient_id ( $active_ingredient_id ) {

        $this->db->where('active_ingredient_id', $active_ingredient_id);

        $query = $this->db->get('product');

        if( $query->num_rows() > 0 )
            return $query->result();

        return NULL;


    }

    public function update_prices( $products_to_update ) {

        foreach ( $products_to_update as $product ) {

            if ( isset($product->active_ingredient_id)) {
                $this->db->set('price', $product->price);

                $this->db->where('id', $product->id);

                $this->db->update('product');
            }

        }


        if( $this->db->affected_rows() > 0 )
            return true;

        return false;

    }

    public function calculate_prices_to_client( &$products ) {

        foreach( $products as $product ) {

            if( isset($product->tax) ) {

                if( $product->price < 100000 ) {

                    if ( $product->tax )
                        $product->price = round(ceil( (bcmul( $product->price, 1.40, 3 ) ) ), -2);
                    else
                        $product->price = round(ceil( bcmul( $product->price, 1.10, 3 ) ), -2);

                }else {
                    $product->price = round(ceil( $product->price ), -2);
                }

            }

            $product->joker = $product->price + (bcmul($product->price, 0.05));
        }
    }

}