<?php
class Recipient_model extends CI_Model {
	
	/**
	 * Recipient_model constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * insert a new row of type recipient 
	 * @param Array $recipient_data
	 * @return NULL or the insert_id
	 */
	public function insert_recipient( $recipient_data ){

		$data = array(
			'address_line' => $recipient_data->addressLine1,
			'names' => $recipient_data->names,
			'last_names' => $recipient_data->lastNames,
			//'mobile' => $recipient_data->mobile,
			'phone' => $recipient_data->phone
		);

        if ( isset($recipient_data->neighborhood) )
            $data['neighborhood'] = $recipient_data->neighborhood;

        if( isset($recipient_data->id) )
            $data['identification_number'] = $recipient_data->id;
		
		if ( isset($recipient_data->doctorName) )
			$data['prescribed_by'] =  $recipient_data->doctorName;
		
		if ( isset($recipient_data->notes) )
			$data['note'] = $recipient_data->notes;
		
		$this->db->insert( 'recipient', $data );
		
		if( $this->db->affected_rows() == 1 ) 
			return $this->db->insert_id();
		
		
		return NULL;
	} 
}