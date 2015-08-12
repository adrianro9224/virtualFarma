<?php
class Address_model extends CI_Model {
	/**
	 * instance the Model
	 */
	function __construct() {
		//call the Model constructor
		parent::__construct();
	}
	
	/**
	* Insert a address in DB
	* @param Array $message_data
	* @return NULL
	*/
	public function insert_address($address_data, $account_id) {

		$data = array(
				'account_id' => $account_id,
				'from' => $address_data->from,
				'address_line' => $address_data->line1,
				'status' => 1
		);

        if ( isset($address_data->neighborhood) )
            $data['neighborhood'] = $address_data->neighborhood;

        if ( $address_data->from  == 'ACCOUNT_SING_UP' )
            $data['name'] = "Mi cuenta";
        else
            $data['name'] = $address_data->name;
	
		$this->db->insert('address', $data);
	
		if($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
	
		return NULL;
	}

    public function get_sign_up_address_by_id( $account_id ) {

        $this->db->where('account_id', $account_id);
        $this->db->where('from', 'ACCOUNT_SING_UP');

        $query = $this->db->get('address');

        if( $query->num_rows() > 0 ) {
            return $query->row();
        }

        return NULL;

    }
	
	public function get_every_addresses_by_id( $account_id ) {
		
		$this->db->where('account_id', $account_id);
		
		$query = $this->db->get('address');
		
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		
		return NULL;
		
	}
	
} 