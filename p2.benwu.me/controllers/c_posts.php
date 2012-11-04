<?php

class posts_controller extends base_controller {
	
	public function __construct() {
		
		parent::__construct();
		
		if(!$this->user){
			die("Members only. Please <a href='/users/login'>login </a>");
		}
		
	
	}
	
	public function index(){
		#set up view
		$this->template->content = View::instance('v_posts_index');
		$this->template->sidebar = View::instance('v_posts_add');
		$this->template->title 	 = 'Posts';
		
		#connections
			$q = "SELECT posts.*, users.first_name, users.last_name
					FROM posts
					LEFT JOIN users
					ON posts.user_id = users.user_id
					LEFT JOIN users_users
					ON users.user_id = users_users.user_id_followed
					WHERE users_users.user_id = ".$this->user->user_id."
					ORDER BY posts.created DESC";
							
		$posts = DB::instance(DB_NAME)->select_rows($q);
		//print_r($posts);
		$user_id = $this->user->user_id;
		
		#pass data to the view
		$this->template->content->posts = $posts;
		$this->template->content->user_id = $user_id;
		
		//echo Debug::dump($user_id);
		//echo Debug::dump($posts);
		
		#renderman
		echo $this->template;
		
		
	}
	
	public function add() {
		# set up the view
		$this->template->content = View::instance("v_posts_add");
		$this->template->sidebar = View::instance(NULL);
		$this->template->title = "Add a new post";
		
		$client_files = Array("/css/compose.css");
		$this->template->client_files = Utils::load_client_files($client_files);
		#render the view
		echo $this->template;		
	}


	
	public function p_add(){
		//print_r($_POST);
		$_POST['user_id'] = $this->user->user_id;
		
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
		
		
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		Router::redirect('/posts/');
		}
	
	
	
	public function users(){
		#controls who you follow
		
		$this->template->content = View::instance("v_posts_index");	
		$this->template->sidebar = View::instance("v_posts_users");
		$this->template->title 	 = 'Follow';
		
		$q = "SELECT posts.*, users.first_name, users.last_name
				FROM posts
				LEFT JOIN users
				ON posts.user_id = users.user_id
				ORDER BY posts.created DESC";
		
		
		$posts = DB::instance(DB_NAME)->select_rows($q);
		$user_id = $this->user->user_id;
		
		$this->template->content->posts = $posts;
		$this->template->content->user_id = $user_id;

		#connections
		$q = "SELECT posts.*, users.first_name, users.last_name
				FROM posts
				LEFT JOIN users
				ON posts.user_id = users.user_id
				LEFT JOIN users_users
				ON users.user_id = users_users.user_id_followed
				ORDER BY posts.created DESC";
							
		//print_r($posts);
		
		#pass data to the view
			
		//echo Debug::dump($user_id);
		//echo Debug::dump($posts);
		
		$q = "SELECT *
			FROM users";
		
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		$q = "SELECT *
			FROM users_users
			WHERE user_id =".$this->user->user_id;
			
		$connections = DB::instance(DB_NAME)->select_array($q, "user_id_followed");
		
		//echo Debug::dump($connections,"connections");
		
		$this->template->sidebar->connections = $connections;
		$this->template->sidebar->users = $users;
		
		echo $this->template;
		
	}
	
		
	public function follow ($user_id_followed = NULL){
		$data['created'] = Time::now();
		$data['user_id'] = $this->user->user_id;
		$data['user_id_followed'] = $user_id_followed;
		
		DB::instance(DB_NAME)->insert('users_users', $data);
		
		
		Router::redirect("/posts/users");
	}
	
	public function unfollow ($user_id_followed = NULL){
		$where_condition = "WHERE user_id_followed =".$user_id_followed."
							AND user_id= ".$this->user->user_id;

		DB::instance(DB_NAME)->delete("users_users", $where_condition);
		
		Router::redirect("/posts/users");
	}
	
	public function entry ($entry_id = NULL){
		$this->template->content = View::instance('v_posts_index');
	
		$q = "SELECT posts.*, users.first_name, users.last_name
			FROM posts
			LEFT JOIN users
			ON posts.user_id = users.user_id
			WHERE posts.post_id = ".$entry_id;
		
		$posts = DB::instance(DB_NAME)->select_rows($q);
		$this->template->content->posts = $posts;
		
		echo $this->template;
		
		
	}

	
}








































