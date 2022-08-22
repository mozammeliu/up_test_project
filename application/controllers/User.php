<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper(
			array('url')
		);
		$this->load->library('session');
		$this->load->model('User_model');
	}



	public function index()
	{
		//$this->load->view('welcome_message');
		$user_info=$this->session->userdata();

		if((isset($user_info['logged_in']))&&($user_info['logged_in']==true)){

		}else{
			redirect(site_url('user/registration'));
		}

		$this->load->view('home');

	}





	//Create a Registration form:
	public function registration(){

		//var_dump($this->session->userdata());
		$user_info=$this->session->userdata();


		if((isset($user_info['logged_in']))&&($user_info['logged_in']==true)){
			redirect(site_url('user'));
		}

		$data=array();

		if((isset($_POST['email']))&&(isset($_POST['password']))&&(isset($_POST['password_confirm']))){
			$email=trim($_POST['email']);
			//var_dump($email);
			$password=$_POST['password'];
			$password_confirm=$_POST['password_confirm'];
			if($email!="" && $password!="" && $password_confirm!="")
			{
				if($password!=$password_confirm){
					$data['error']=true;
					$data['error_reason']="Password doesn't matched with Confirm Password";
				}else{
					$db_data=array('email'=>$email, 'password'=>md5($password));
					$response=$this->User_model->save_user_info($db_data);
					if($response!=false){

						//$data['error']=false;
						//$data['message']="Your Credential saved successfully, <br/>An Email has been sent to your email containing Email_Verification_Link<br/>Please click on that Link to verify your email. <br/>Thank you";
						$newdata = array(
							'email'     => $email,
							'logged_in' => TRUE
						);
						$this->session->set_userdata($newdata);

						redirect(site_url('user'));
						die();
					}

				}
			}else{
				$data['error']=true;
				$data['error_reason']="Form Data Empty, Please fill up properly and submit again";
			}
		}

		//var_dump($_POST);



		$this->load->view('registration',$data);
	}



}
