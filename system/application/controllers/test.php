<?php

class Test extends Controller {
    
    function Test(){
    parent::Controller();
    
  }
  
  
   function index(){	
  	
  }

  function cat($id){
  	//$this->benchmark->mark('query_start');
	$cat = $this->MCats->getCategory($id);
	// $id is the thirdn in URI which represents the ID and any variables that will be passed to the controller.
	//$this->benchmark->mark('query_end');
	
	$data['category'] = $cat;
	$data['main'] = 'category';
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('mytest/test1');
 }


    
}