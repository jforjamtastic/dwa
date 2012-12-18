<?php

class maps_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
		
	}	
	
	public function index(){
	
	}
	
	
	public function save(){
		
		
	}
	
	public function p_control_panel() {

		$q = "SELECT count(post_id) FROM posts";
		$data['post_count'] = DB::instance(DB_NAME)->select_field($q);

		$q = "SELECT count(user_id) FROM users";
		$data['users_count'] = DB::instance(DB_NAME)->select_field($q);

		$q = "SELECT created FROM posts ORDER by created DESC LIMIT 1";
		$data['last_created_post'] = DB::instance(DB_NAME)->select_field($q);

		echo json_encode($data);


	}
	
	public function p_data (){
		print_r($_POST);

		$temp = $_POST['data'];
		
		$q = "SELECT * from ".$_POST['data']; 
		
		echo $q;
		
		$data = DB::instance(DB_NAME)->select_rows($q);

		$fp = fopen('json/'.$temp.'.json', 'w');
		fwrite($fp, json_encode($data));
		fclose($fp);

		echo json_encode($data);
		
	}
	
}