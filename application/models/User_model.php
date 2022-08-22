<?php
class User_model extends CI_Model {

	/*public $title;
	public $content;
	public $date;*/
	function __construct() {
		parent::__construct();
	}



	//Save registration data to db
	public function save_user_info($user_data)
	{
		$this->db->insert('users',$user_data);
		return $this->db->insert_id();
	}


	//get user email verification code
	public function get_email_verification_code($email)
	{
		$this->db->where('email',$email);
		return $this->db->get('users')->row();
	}


	//verify user's email with code
	public function verify_email_code($email)
	{
		$data=array(
			'email_verification_code'=>"",
			'verification_status'=>"verified"
		);
		$this->db->update('users',$data);
	}

	//get user data
	public function get_user_data($email)
	{
		$this->db->where('email',$email);
		return $this->db->get('users')->row();
	}




}
