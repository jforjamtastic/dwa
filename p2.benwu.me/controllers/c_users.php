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
			$this->template->content = View::instance("v_users_signup");
			$this->template->content->error = $error;
			$this->template->sidebar = View::instance("v_login_text");
					
			echo $this->template;
			}
		else {
			Router::redirect('/posts/');
		}
	}
	
	public function p_signup(){
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
			$this->template->content = View::instance("v_users_login");
			$this->template->content->error = $error;
			$this->template->sidebar = View::instance("v_signup_text");
			
			
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
			Router::redirect("/posts/");
			
		}
	
	}
	
	public function logout() {
		$this->template->content = View::instance("v_users_login");
		$this->template->sidebar = View::instance("v_users_logout");

		
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		$data = Array("token" => $new_token);
		
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		setcookie("token", "", strtotime('-1 year'), '/');
		
		echo $this->template;
		
	}
	
	public function profile($user_id = NULL){
		if(!$this->user){
			echo "Members only";
			return false;
		}
		
		if ($user_id == NULL) {
			echo "you did not specify a user";
		} 
		else {		
			# Create the view
			$this->template->sidebar = View::instance("v_users_profile");
			$this->template->content = View::instance("v_posts_index");
			
			$q = "SELECT users.*
					FROM users
					WHERE user_id = ".$user_id;
				
			$users = DB::instance(DB_NAME)->select_rows($q);

			$q = "SELECT posts.*, users.first_name, users.last_name
					FROM posts
					LEFT JOIN users
					ON posts.user_id = users.user_id
					WHERE users.user_id = ".$user_id."
					ORDER BY posts.created DESC";
					
			$posts = DB::instance(DB_NAME)->select_rows($q);

			//echo "This is the profile for ".$user_id;
			
			//echo Debug::dump($users);
			//echo Debug::dump($posts);
			$this->template->content->posts = $posts;
			$this->template->sidebar->users = $users;

			# Render the View
			echo $this->template;
		}
	}	
}