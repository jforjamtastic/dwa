<?php

class users_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		Router::redirect("/");	
	}
	
	
	
	
	public function signup() {
		$this->template->content = View::instance("v_users_signup");
		
		$client_files = Array("/css/forms.css","http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js");
		$this->template->client_files = Utils::load_client_files($client_files);
				
		echo $this->template;

	}
	
	public function p_signup(){
		#what data was printed
		print_r($_POST);
		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']); 	#hashes password
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		$_POST['created'] = Time::now(); 								#this returned the time stamp
		$_POST['modified']= Time::now(); 								#timestamp 
		
		
		
		#put the data into db
		DB::instance(DB_NAME)->insert('users', $_POST); #inserts form data to DB
		
		echo "You are Registered!";
		
		
	}
	
	public function login() {
		$this->template->content = View::instance("v_users_login");
		
		$client_files = Array("/css/forms.css","http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js");
		$this->template->client_files = Utils::load_client_files($client_files);
		
		
		echo $this->template;	
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
			Router::redirect("/users/login");
		}
		else{
			setcookie("token", $token, strtotime('+2 weeks'), "/");
			Router::redirect("/");
			
		}
	
	}
	
	public function logout() {
		$this->template->content = View::instance("v_users_logout");
		
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		$data = Array("token" => $new_token);
		
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		setcookie("token", "", strtotime('-1 year'), '/');
		
		
		$client_files = Array("/css/forms.css","http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js");
		$this->template->client_files = Utils::load_client_files($client_files);
		
		echo $this->template;
		
	}
	
	public function profile($user_name = NULL){
		if(!$this->user){
			echo "Members only";
			return false;
		}
		
		if ($user_name == NULL) {
			echo "you did not specify a user";
		} 
		else {		
			# Create the view
			$this->template->content = View::instance("v_users_profile");
			$this->template->title = "Profile for ".$user_name;
			
			# Pass Content
			$this->template->content->user_name = $user_name;
			
			# Render the View
			echo $this->template;
		}
	}	
}