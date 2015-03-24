<?php
class Account_model extends CI_Model {
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	/**
	 * Create a new register on the account table of type Account
	 * @param Array $sign_up_form
	 * @return boolean
	 */
	public function insert_account($sign_up_form) {
		
		$date_format = 'Y-m-d H:i:s'; //(the MySQL DATETIME format)
		
		$data = array(
				'first_name' => $sign_up_form['userFirstName'],
				'last_name' => $sign_up_form['userLastName'],
				'email' => $sign_up_form['userEmail'],
				'terms_and_conditions' => $sign_up_form['termsAndConditions'],
				'registration_date' => date($date_format),
				'password' => $sign_up_form['userPassword']
				
									
		);
		
		$this->db->insert('account', $data);
		
		if($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		
		return NULL;
		
	}
	
	public function update_account($update_account_form, $account_id) {
		
		$update_account_form['userSecondName'] = ( empty($update_account_form['userSecondName']) ) ? NULL : $update_account_form['userSecondName'];
		$update_account_form['userSurname'] = ( empty($update_account_form['userSurname']) ) ? NULL : $update_account_form['userSurname'];
		$update_account_form['userId'] = ( empty($update_account_form['userId']) ) ? NULL : $update_account_form['userId'];
		$update_account_form['userPhone'] = ( empty( $update_account_form['userPhone'] ) ) ? NULL : $update_account_form['userPhone'];
		$update_account_form['userMobile'] = ( empty($update_account_form['userMobile']) ) ? NULL : $update_account_form['userMobile'];
		
		$this->db->set('first_name', $update_account_form['userFirstName']);
		$this->db->set('second_name', $update_account_form['userSecondName'] );
		$this->db->set('last_name', $update_account_form['userLastName']);
		$this->db->set('surname', $update_account_form['userSurname']);
		$this->db->set('email', $update_account_form['userEmail']);
		$this->db->set('identification_number', $update_account_form['userId'] );
		$this->db->set('phone', $update_account_form['userPhone'] );
		$this->db->set('mobile', $update_account_form['userMobile']);
		$this->db->set('gender', $update_account_form['userGender']);
		
		$this->db->where('id', $account_id);
		$this->db->update('account');
		
		if($this->db->affected_rows() > 0)
			return true;
		
		return NULL;
		
	}
	
	public function get_account_by_email($userEmail) {
		
		$this->db->where('email', $userEmail);
		
		$query = $this->db->get('account');
		
		if($query->num_rows() > 0) {
			$result = $query->row(); 
			return $result; 
		}
		
		return NULL;
	}
	
	public function get_account_by_id($account_id) {
		
		$this->db->select('id, first_name, second_name, last_name, surname, identification_number, phone, mobile, gender, email, terms_and_conditions');
		
		$this->db->where('id', $account_id);
		
		$query = $this->db->get('account');
		
		if($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		}
		
		return NULL;
	}
	
	public function get_pathologies_by_id( $account_id ) {
		
		$this->db->select('pathologies');
		
		$this->db->where( 'id', $account_id );
		
		$query = $this->db->get('account');
		
		if($query->num_rows() == 1) {
			$result = $query->row();
			if( isset($result->pathologies) ){
				return $result;
			}else{
				return null;
			}
		}
		
		return NULL;
		
	}
}