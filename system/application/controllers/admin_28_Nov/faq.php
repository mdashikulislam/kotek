<?php

class Faq extends Controller {
  function Faq(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Faq";
	$data['main'] = 'admin_faq_home';
	$data['faq'] = $this->MFaq->getAllFaqs();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('question')){
  		
		$this->MFaq->createFaq();
		$this->session->set_flashdata('message','Faq created');
  		redirect('admin/faq/index','refresh');
		
  	}else{
		
		$data['title'] = "Create Faq";
		$data['main'] = 'admin_faq_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('question')){
  		$this->MFaq->updateFaq();
  		$this->session->set_flashdata('message','Faq updated');
  		redirect('admin/faq/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Faq";
		$data['main'] = 'admin_faq_edit';
		$data['color'] = $this->MFaq->getFaq($id);
		if (!count($data['color'])){
			redirect('admin/faq/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MFaq->deleteFaqs($id);
	$this->session->set_flashdata('message','Faq deleted');
	redirect('admin/faq/index','refresh');
  }

	
}//end class
?>