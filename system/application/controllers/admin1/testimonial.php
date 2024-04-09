<?php

class Testimonial extends Controller {
  function Testimonial(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Testimonial";
	$data['main'] = 'admin_testimonial_home';
	$data['testimonial'] = $this->MNews->getAllTestimonialAdmin();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('title')){
		
		/* if (empty($_FILES['image']['title'])){
		$this->session->set_flashdata('error','Please upload testimonial image');
  		redirect('admin/testimonial/index','refresh');
		} */
  		$this->MNews->createTestimonial();
  		$this->session->set_flashdata('message','Testimonial created');
  		redirect('admin/testimonial/index','refresh');
  	}else{
		$data['title'] = "Create Testimonial";
		$data['main'] = 'admin_testimonial_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('title')){
  		$this->MNews->updateTestimonial();
  		$this->session->set_flashdata('message','Testimonial updated');
  		redirect('admin/testimonial/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Testimonial";
		$data['main'] = 'admin_testimonial_edit';
		$data['testimonial'] = $this->MNews->getTestimonial($id);
		if (!count($data['testimonial'])){
			redirect('admin/testimonial/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MNews->deleteTestimonial($id);
	$this->session->set_flashdata('message','Testimonial deleted');
	redirect('admin/testimonial/index','refresh');
  }

	
}//end class
?>