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
	
	
	public function p_fetchfacts (){
		$temp = $_POST['state'];
		
		$q = "SELECT statehood FROM statefacts
			WHERE statefacts.state = '".$_POST['state']."'";
		
		$data['statehood'] = DB::instance(DB_NAME)->select_field($q);
		
		$q = "SELECT capital FROM statefacts
			WHERE statefacts.state = '".$_POST['state']."'";
		
		$data['capital'] = DB::instance(DB_NAME)->select_field($q);
		
		$q = "SELECT area FROM statefacts
			WHERE statefacts.state = '".$_POST['state']."'";
		
		$data['area'] = DB::instance(DB_NAME)->select_field($q);
		
		$q = "SELECT notes FROM statefacts
			WHERE statefacts.state = '".$_POST['state']."'";
		
		$data['notes'] = DB::instance(DB_NAME)->select_field($q);		
		

		$q = "SELECT capitalyear FROM statefacts
			WHERE statefacts.state = '".$_POST['state']."'";
		
		$data['capitalyear'] = DB::instance(DB_NAME)->select_field($q);		
		
		
		
		echo json_encode($data);
		
		
		
	}
	
	public function p_data (){
		$data = array();
		$temp = $_POST['data'];
		//print_r($temp);

		
		for( $i = 2006; $i < 2010 ; $i++){

			if ($temp == 'vetPercent'){
				$q = "SELECT state, vetPercent from veterans
					WHERE veterans.year = ".$i."
					ORDER BY veterans.state";
			}
			else if ($temp == 'ninetotwelve'){
				$q = "SELECT state, ninetotwelve from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			
			else if ($temp == 'lessthannine'){
				$q = "SELECT state, lessthannine from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			
			else if ($temp == 'highschoolgrad'){
				$q = "SELECT state, highschoolgrad from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			
			else if ($temp == 'somecollege'){
				$q = "SELECT state, somecollege from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			
			else if ($temp == 'associates'){
				$q = "SELECT state, associates from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			
			else if ($temp == 'bachelors'){
				$q = "SELECT state, bachelors from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			else if ($temp == 'graduate'){
				$q = "SELECT state, graduate from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			else if ($temp == 'atleasthigh'){
				$q = "SELECT state, atleasthigh from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			else if ($temp == 'atleastbachelor'){
				$q = "SELECT state, atleastbachelor from educationalattainment
					WHERE educationalattainment.year = ".$i."
					ORDER BY educationalattainment.state";
			}
			
			
			$test = DB::instance(DB_NAME)->select_rows($q);

			//print_r($test);
			for ($j = 0; $j < 50; $j++)
			{
				$state = $test[$j]['state'];
				$data['states'][$i][$state] = $test[$j][$temp];
				
			}
			
		}

		$fp = fopen('json/'.$temp.'.json', 'w');
		fwrite($fp, json_encode($data, JSON_NUMERIC_CHECK));
		fclose($fp);
		

		echo $temp;

	}
	
	public function custom (){
		$this->template->header = View::instance('v_header');
		$this->template->content = View::instance("v_maps_custom");
		
		$client_files = Array(
				"/js/validate.js"
			
			);
			
		$this->template->client_files = Utils::load_client_files($client_files);
		
		echo $this->template;
		
	}
	
	public function p_custom (){
		if (!$this->user)
		{
			die("You must be logged in to do that! <a href='/users/login'>login </a> ");
		}
		else
		{	
			$_POST['user_id'] = $this->user->user_id;
			$_POST['created'] = Time::now();
			$_POST['modified'] = Time::now();	
			
			$new = $_POST['user_id']."-".$_POST['year'];
			
			DB::instance(DB_NAME)->insert("custom", $_POST);
		
			$q = "SELECT custom.US_AL, custom.US_AK, custom.US_AZ, custom.US_AR, custom.US_CA, custom.US_CO, custom.US_CT, custom.US_DE, custom.US_FL, 
			custom.US_GA, custom.US_HI, custom.US_ID, custom.US_IL, custom.US_IN, custom.US_IA, custom.US_KS, custom.US_KY, custom.US_LA, custom.US_ME, custom.US_MD, custom.US_MA, custom.US_MI, 
			custom.US_MN, custom.US_MS, custom.US_MO, custom.US_MT, custom.US_NE, custom.US_NV, custom.US_NH, custom.US_NJ, custom.US_NM, custom.US_NY , custom.US_NC, custom.US_ND, custom.US_OH, 
			custom.US_OK, custom.US_OR, custom.US_PA, custom.US_RI, custom.US_SC, custom.US_SD, custom.US_TN, custom.US_TX, custom.US_UT, custom.US_VT, 	custom.US_VA, custom.US_WA, custom.US_WV, 
			custom.US_WI, custom.US_WY from custom
			WHERE custom.user_id = '".$this->user->user_id."'
			AND custom.created = '".$_POST['created']."'";
			
			$data['states'][$_POST['year']] = DB::instance(DB_NAME)->select_rows($q);
			
			
			/*for ($j = 0; $j < 50; $j++)
			{
				$state = 
				echo ($data['states'][$_POST['year']]);
				
			}*/
			// str_replace(find,replace,string,count) 
			
			//echo json_encode($data, JSON_NUMERIC_CHECK);
			
			$fp = fopen('json/'.$new.'.json', 'w');
			fwrite($fp, json_encode($data, JSON_NUMERIC_CHECK));
			fclose($fp);		
			
			$contents = file_get_contents('json/'.$new.'.json');
			$new_contents = str_replace('_', '-', $contents);
			file_put_contents('json/'.$new.'.json', $new_contents);

			echo $new;

		
		
		
		}
		
		
	}
	
}