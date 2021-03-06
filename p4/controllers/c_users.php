<?php

class users_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if (!$this->user){
			Router::redirect("/");	
		}
	}
	

	
	public function signup($error = NULL) {
		if(!$this->user){
			$this->template->header = View::instance('v_header');
			$this->template->content = View::instance("v_users_signup");
			$this->template->content->error = $error;
			
			$client_files = Array(
				"/js/validate.js"
			
			);
			
			$this->template->client_files = Utils::load_client_files($client_files);   

			echo $this->template;
			}
		else {
			Router::redirect('/');
		}
	}
	
	public function p_signup(){
		#what data was printed
		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']); 	#hashes password
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		$_POST['created'] = Time::now(); 								#this returned the time stamp
		$_POST['modified']= Time::now(); 								#timestamp 
		
		$q = "SELECT users.email
				FROM users
				WHERE users.email = '".$_POST['email']."'";
			
		$emails = DB::instance(DB_NAME)->select_rows($q);
		
		//echo Debug::dump ($emails);
		
		if($emails <> NULL){
			Router::redirect("/users/signup/error");	
			break;
		}
	
		DB::instance(DB_NAME)->insert('users', $_POST); #inserts form data to DB

		Router::redirect("/users/login/");

		
		
		#put the data into db
		
		
	}
	
	public function login($error = NULL) {
		if(!$this->user){
			$this->template->header = View::instance('v_header');
			$this->template->content = View::instance('v_users_login');
			$this->template->content->error = $error;
			
			$client_files = Array(
				"/js/validate.js"
			
			);
			
			$this->template->client_files = Utils::load_client_files($client_files);
			
			echo $this->template;	
			}
		else {
			Router::redirect('/');
		}
	}
	
	public function p_login(){
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		$q = "SELECT token
				FROM users
				WHERE email = '".$_POST['email']."'
				AND password = '".$_POST['password']."'
				";
				
		$token = DB::instance(DB_NAME)->select_field($q);
		
		if ($token == ""){
			Router::redirect("/users/login/error");
		}
		else{
			setcookie("token", $token, strtotime('+2 weeks'), "/");
			Router::redirect("/");
			
		}
	
	}
	
	public function logout() {
		$this->template->header = View::instance('v_header');
		$this->template->content = View::instance("v_users_login");
		$client_files = Array(
				"/js/validate.js"
			
			);
			
		$this->template->client_files = Utils::load_client_files($client_files);

		
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		$data = Array("token" => $new_token);
		
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		setcookie("token", "", strtotime('-1 year'), '/');
		
		echo $this->template;
		
	}
	
	
}