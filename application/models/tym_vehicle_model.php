<?php
class Tym_vehicle_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	/**
	 *  get all categories in the table Category
	 * @return unknown|boolean all categories if this exist
	 */
	public function all_categories() {
		//The second and third parameters enable you to set a limit and offset clause:
		//$query = $this->db->get('mytable', 10, 20);
        $this->db->where('have_products', true);

        $this->db->order_by("name", "asc");

        $query = $this->db->get('category');

		if($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		
		return NULL;
	}

	public function get_rin_types() {

        $query = $this->db->get('tym_vehicle');

		if($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		
		return NULL;
	}
	
	public function insert_vehicles( $categories_to_save ) {
		
		$category_insert_ids = array();
		
		$num_of_categories_to_save = count($categories_to_save);
		
		foreach ($categories_to_save as $key1 => $value1 ) {
			$models = $value1['models'];
			$id = isset($value1['id']) ? $value1['id'] : NULL;

			foreach ($models as $key => $value) {

				if( isset($id) ) {
					$data = array(
						"model" => $value->model,
						"pcd" => $value->pcd,
						"year" => $value->year,
						"tym_vehicle_id" => $id
					);
					
					$this->db->insert("tym_vehicle_model", $data);	
				}
				
			}
				
			$category_insert_ids[] = $this->db->insert_id();
		}
		
		return $category_insert_ids;
		
		
	}

    public function disable_categories_without_product ( $new_categories ) {


        foreach ( $new_categories as $new_category ) {
            $this->db->set('have_products', $new_category->have_products);
            $this->db->where('id', $new_category->id);

            $this->db->update('category');
        }

        if ($this->db->affected_rows() == count($new_categories))
            return true;

        return false;

    }
}