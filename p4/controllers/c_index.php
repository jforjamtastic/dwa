<?php

class index_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	/*-------------------------------------------------------------------------------------------------
	Access via http://yourapp.com/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->header = View::instance('v_header');
			$this->template->content = View::instance('v_index_index');
			//$this->template->content->subview = '';
			
		# Now set the <title> tag
			$this->template->title = "Interactive Map";
	
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
			$client_files = Array(
				"/css/jquery-jvectormap.css",
				"/css/tablecss/red/style.css",
				"/js/jquery-jvectormap-1.1.1.min.js",
				"/js/jquery-jvectormap-us-aea-en.js",
				"/js/jquery.form.js",
				"/js/maps.js"
			
			);
	                    
	        $q = "SELECT *
	        		FROM total_population";
	        		
	        $mapData = DB::instance(DB_NAME)->select_rows($q);
	        
	        //echo Debug::dump($mapData); 
	        
	        $this->template->content->mapData = $mapData;
	    	$this->template->client_files = Utils::load_client_files($client_files);   
	      		
		# Render the view
			echo $this->template;

	}
	
	
	
		
} // end class
