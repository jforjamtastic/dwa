<?php

class maps_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
		
	}	
	
	public function index(){
	
	}
	
	
	public function p_save (){
		if (!$this->user)
		{
			die("You must be logged in to do that! <a href='/users/login'>login </a> ");
		}
		else
		{	
			$_POST['user_id'] = $this->user->user_id;
			$_POST['created'] = Time::now();
			$_POST['modified'] = Time::now();	
			print_r($_POST);
			
			$q = "SELECT saves.user_id, saves.tablename, saves.year
				FROM saves
				WHERE saves.tablename = '".$_POST['tablename']."'
				AND saves.year = '".$_POST['year']."'
				AND saves.user_id = '".$_POST['user_id']."'";
			
			$dupes = DB::instance(DB_NAME)->select_rows($q);
			
			if ($dupes == NULL){
				DB::instance(DB_NAME)->insert("saves", $_POST);
				echo "saved";
			}
			else{
				echo "already saved";
			}
		}
	
	}
	
	
	public function p_statepop (){
		
		$temp = $_POST['table'];
		
		
		if($temp == 'veterans')
		{
		$q = "SELECT veterans.population FROM veterans
				WHERE veterans.year = ".$_POST['year']."
				AND veterans.state = '".$_POST['state']."'";
		}		

		$data = DB::instance(DB_NAME)->select_field($q);
		
		echo $data;
	}	
	
	public function p_data (){
		//print_r($_POST);
		$data = array();


		$temp = $_POST['data'];
		for( $i = 2006; $i < 2010 ; $i++){
		
			$q = "SELECT state, vetPercent from ".$_POST['data']."
					WHERE veterans.year = ".$i."
					ORDER BY veterans.state";
		
		
			$test = DB::instance(DB_NAME)->select_rows($q);
			//$data['state'][$i] = $test;

			for ($j = 0; $j < 50; $j++)
			{
				$state = $test[$j]['state'];
				$data['states'][$i][$state] = $test[$j]['vetPercent'];
				//print_r("".$test[$j][state].":".$test[$j][vetPercent]);
				
			}
			//print_r ($data);

			
		}
	
	
		

		$fp = fopen('json/'.$temp.'.json', 'w');
		fwrite($fp, json_encode($data, JSON_NUMERIC_CHECK));
		fclose($fp);
		

		echo $temp;

	}
	
}