<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('User_model');
	}



	public function index()
	{
		//$this->load->view('welcome_message');
		$user_info=$this->session->userdata();

		//var_dump($user_info);

		if((isset($user_info['logged_in']))&&($user_info['logged_in']==true)){

		}else{
			redirect(site_url('user/registration'));
		}

		$user_data['user_data']=$this->User_model->get_user_data($user_info['email']);



		$this->load->view('home',$user_data);

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
					$email_verification_code=rand(100000,999999);


					//echo $email_verification_code; die();
					$db_data=array('email'=>$email, 'password'=>md5($password),'email_verification_code'=>$email_verification_code);
					$response=$this->User_model->save_user_info($db_data);
					if($response!=false){


						$link=site_url('user/verify_email')."/".$email_verification_code;
						$email_verification_link="<a href='".$link."'>".$link."<a></a>";

						//Send Email to User with Verification Code
						$this->email->clear();

						$this->email->to($email);
						$this->email->from('mozammel@ictblog.net');
						$this->email->subject('Your Email Verification Code Is Here');
						$message="Hi User,
						<br/>Here is your email verification link, 
						<br/> <b>".$email_verification_link."</b>
						<br/>Please click on the link above to verify your email.
				
						<br/> Thank you";
						$this->email->message($message);
						$this->email->send();



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



	public function verify_email($email_verification_code=null)
	{
		if($email_verification_code!=null)
		{
			$user_code=$this->User_model->get_email_verification_code($this->session->userdata('email'));
//var_dump($user_code->email_verification_code);

			if($email_verification_code===$user_code->email_verification_code)
			{
				$this->User_model->verify_email_code($this->session->userdata('email'));
				redirect(site_url('user?email=verified'));

			}


		}
	}


	//logout the user
	public function logout()
	{
		$array_items = array('email', 'logged_in');

		$this->session->unset_userdata($array_items);
		redirect(site_url('user/login'));
	}



}
