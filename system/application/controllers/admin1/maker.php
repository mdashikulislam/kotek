<?php

class Maker extends Controller {
  function Maker(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Maker";
	$data['main'] = 'admin_maker_home';
	$data['maker'] = $this->MMaker->getAllMakers();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		
		$this->MMaker->createMaker();
		$this->session->set_flashdata('message','Maker created');
  		redirect('admin/maker/index','refresh');
		
  	}else{
		
		$data['title'] = "Create Maker";
		$data['main'] = 'admin_maker_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MMaker->updateMaker();
  		$this->session->set_flashdata('message','Maker updated');
  		redirect('admin/maker/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Maker";
		$data['main'] = 'admin_maker_edit';
		$data['color'] = $this->MMaker->getMaker($id);
		if (!count($data['color'])){
			redirect('admin/maker/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MMaker->deleteMakers($id);
	$this->session->set_flashdata('message','Maker deleted');
	redirect('admin/maker/index','refresh');
  }

	
}//end class
?>