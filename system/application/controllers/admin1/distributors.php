<?php

class Distributors  extends Controller {
  function Distributors(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
  
    function index(){
	$data['title'] = "Manage Distributors";
	$data['main'] = 'admin_distributor_home';
	$data['products'] = $this->MDistributors->getAllDistributors();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
   
    function editDistributor($id=0){ 

  	if ($this->input->post('email')){
  		$this->MDistributors->updateDistributor(); 
  		$this->session->set_flashdata('message','Distributor updated');
  		redirect('admin/distributors','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Distributor";
		$data['main'] = 'admin_distributor_edit';
		

		if (empty($id)){
			redirect('admin/distributors','refresh');
		}
		$data['distributor'] = $this->MDistributors->getDistributor($id);
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function createDistributor()
  {if ($this->input->post('email')){
  		$this->MDistributors->createDistributor(); 
  		$this->session->set_flashdata('message','Distributor created');
  		redirect('admin/distributors','refresh');
  	}else{

    $data['title'] = "Create Distributor";
	$data['main'] = 'admin_distributor_create';
	$this->load->vars($data);
	$this->load->view('dashboard');  
	}
  }
  
  function deleteDistributor($id){
	//$id = $this->uri->segment(4);
	$this->MDistributors->deleteUser($id);
	$this->session->set_flashdata('message','Distributor deleted');
	redirect('admin/distributors','refresh');
  }
  
  
  
}


?>