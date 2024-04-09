<?php

class Banner extends Controller {
  function Banner(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Banner";
	$data['main'] = 'admin_banner_home';
	$data['banner'] = $this->MNews->getAllBannerAdmin();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('title')){
		
		/* if (empty($_FILES['image']['title'])){
		$this->session->set_flashdata('error','Please upload banner image');
  		redirect('admin/banner/index','refresh');
		} */
  		$this->MNews->createBanner();
  		$this->session->set_flashdata('message','Banner created');
  		redirect('admin/banner/index','refresh');
  	}else{
		$data['title'] = "Create Banner";
		$data['main'] = 'admin_banner_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('title')){
  		$this->MNews->updateBanner();
  		$this->session->set_flashdata('message','Banner updated');
  		redirect('admin/banner/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Banner";
		$data['main'] = 'admin_banner_edit';
		$data['banner'] = $this->MNews->getBanner($id);
		if (!count($data['banner'])){
			redirect('admin/banner/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MNews->deleteBanner($id);
	$this->session->set_flashdata('message','Banner deleted');
	redirect('admin/banner/index','refresh');
  }

	
}//end class
?>