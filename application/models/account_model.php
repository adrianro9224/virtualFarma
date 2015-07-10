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
				'password' => $sign_up_form['userPassword'],
                'points' => 1000
				
									
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

        if ( isset($update_account_form['userFirstName']) )
		    $this->db->set('first_name', $update_account_form['userFirstName']);

        if ( isset($update_account_form['userSecondName']) )
		    $this->db->set('second_name', $update_account_form['userSecondName'] );

        if ( isset($update_account_form['userLastName']) )
		    $this->db->set('last_name', $update_account_form['userLastName']);

        if ( isset($update_account_form['userSurname']) )
		    $this->db->set('surname', $update_account_form['userSurname']);

        if ( isset($update_account_form['userEmail']) )
		    $this->db->set('email', $update_account_form['userEmail']);

        if ( isset($update_account_form['userId']) )
		    $this->db->set('identification_number', $update_account_form['userId'] );

        if ( isset($update_account_form['userPhone']) )
		    $this->db->set('phone', $update_account_form['userPhone'] );

        if ( isset($update_account_form['userMobile']) )
		    $this->db->set('mobile', $update_account_form['userMobile']);

        if ( isset($update_account_form['userGender']) )
            $this->db->set('gender', $update_account_form['userGender']);
		
		$this->db->where('id', $account_id);
		$this->db->update('account');
		
		if($this->db->affected_rows() > 0)
			return true;
		
		return NULL;
		
	}
	
	public function get_account_by_email( $userEmail ) {
		
		$this->db->where('email', $userEmail);
		
		$query = $this->db->get('account');
		
		if($query->num_rows() > 0) {
			$result = $query->row(); 
			return $result; 
		}
		
		return NULL;
	}
	
	public function get_account_by_id($account_id) {
		
		$this->db->select('id, first_name, account_type_id, second_name, last_name, surname, identification_number, phone, mobile, gender, email, terms_and_conditions, points');
		
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
	
	public function get_admin_account_by_id( $admin_id ) {
		
		$this->db->where('id', $admin_id);
		
		$query = $this->db->get('account');
		
		if ( $query->num_rows() == 1 ) 
			return $query->row();
		else 
			return NULL;
		
	}

    public function get_by_identification_number( $identification_number ) {

        $this->db->where('identification_number', $identification_number);

        $query = $this->db->get('account');

        if ( $query->num_rows() == 1 )
            return $query->row();
        else
            return NULL;


    }

	public function get_admin_account_by_identification_number( $admin_id ) {
	
		$this->db->where('identification_number', $admin_id);
	
		$query = $this->db->get('account');
	
		if ( $query->num_rows() == 1 )
			return $query->row();
		else
			return NULL;
	
	}
	
	public function update_fb_id( $account_id, $fb_id ) {
		
		$this->db->set('fb_id', $fb_id);
		
		$this->db->where('id', $account_id);
		
		$this->db->update('account');
		
		if($this->db->affected_rows() > 0)
			return true;
		
		return false;
		
	}
	
	public function insert_fb_account( $fb_public_profile ) {
		
		$date_format = 'Y-m-d H:i:s'; //(the MySQL DATETIME format)
		
		$gender = NULL;
		
		if ($fb_public_profile->gender == 'female' )
			$gender = 'F';
		
		if ($fb_public_profile->gender == 'male' )
			$gender = 'M';
		
		$data = array(
				'first_name' => $fb_public_profile->first_name,
				'last_name' => $fb_public_profile->last_name,
				'email' => $fb_public_profile->email,
				'gender' => $gender,
				'terms_and_conditions' => 1,
				'registration_date' => date($date_format),
				'email' => $fb_public_profile->email,
				'fb_id' => $fb_public_profile->id,
		);
		
		$this->db->insert('account', $data);
		
		
		if($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		
		return NULL;
		
	}

    public function get_points ( $account_id ) {

        $this->db->select('points');
        $this->db->where('id', $account_id);

        $query = $this->db->get('account');

        if ( $query->num_rows() == 1 )
            return $query->row();
        else
            return NULL;
    }

    public function update_points( $points_to_save, $account_id ) {

        $this->db->set( 'points', $points_to_save );
        $this->db->where('id', $account_id);
        $this->db->update('account');

        if($this->db->affected_rows() > 0)
            return true;

        return false;

    }
}