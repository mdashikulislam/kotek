<?php

class Test1 extends Controller {
    
    function Test1(){
    parent::Controller();
    
  }
  
  
   function index(){	
  	
  }

   function cat($id){
  	//$this->benchmark->mark('query_start');
	$cat = $this->MCats->getCategory($id);
	// $id is the thirdn in URI which represents the ID and any variables that will be passed to the controller.
	//$this->benchmark->mark('query_end');
	if (!count($cat)){
		redirect('welcome/index','refresh');
	}
	$data['title'] = "Power Steering Kit Specialist | ". $cat['name'];
	
	if ($cat['parentid'] < 1){
		//show other categories
		$data['listing'] = $this->MCats->getSubCategories($id);
		$data['level'] = 1;
	}else{
		//show products
		$data['listing'] = $this->MProducts->getProductsByCategory($id);
		$data['level'] = 2;

	}
        $data['parentid']=$cat['parentid'];
	$data['category'] = $cat;
	$data['main'] = 'category';
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('mytest/test2');
 }



    
}