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




}
