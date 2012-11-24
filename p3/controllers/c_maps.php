<?php

class maps_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	public function index() {
		$this->template->header = View::instance('v_header');
		$this->template->content = View::instance('v_index_index');
			
		$this->template->title = "Interactive Map";
	
		$client_files = Array(
					""
                    );
	    
	   	$this->template->client_files = Utils::load_client_files($client_files);   
	   	echo $this->template;

	}
	
	
		
}