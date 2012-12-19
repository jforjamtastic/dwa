<?php

class maps_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
		
	}	
	
	public function index(){
	
	}
	
	
	public function save(){
		
		
	}
	
	
	public function p_data (){
		//print_r($_POST);

		$temp = $_POST['data'];
		
		$q = "SELECT * from ".$_POST['data']; 
		
		
		$data = DB::instance(DB_NAME)->select_rows($q);

	
		

		$fp = fopen('json/'.$temp.'.json', 'w');
		fwrite($fp, json_encode($data, JSON_FORCE_OBJECT));
		fclose($fp);

		echo $temp;

	}
	
}