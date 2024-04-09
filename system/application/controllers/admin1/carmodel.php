<?php

class Carmodel extends Controller {
  function Carmodel(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Carmodel";
	$data['main'] = 'admin_carmodel_home';
	$data['carmodel'] = $this->MCarmodel->getAllCarmodels();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('title')){
  		
		$this->MCarmodel->createCarmodel();
		$this->session->set_flashdata('message','Carmodel created');
  		redirect('admin/carmodel/index','refresh');
		
  	}else{
		
		$data['title'] = "Create Carmodel";
		$data['main'] = 'admin_carmodel_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('title')){
  		$this->MCarmodel->updateCarmodel();
  		$this->session->set_flashdata('message','Carmodel updated');
  		redirect('admin/carmodel/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Carmodel";
		$data['main'] = 'admin_carmodel_edit';
		$data['color'] = $this->MCarmodel->getCarmodel($id);
		if (!count($data['color'])){
			redirect('admin/carmodel/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MCarmodel->deleteCarmodels($id);
	$this->session->set_flashdata('message','Carmodel deleted');
	redirect('admin/carmodel/index','refresh');
  }
  function updateDb()
  {
	 // $this->MCarmodel->createmaker();
  }
	
}//end class
?>