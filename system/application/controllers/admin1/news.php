<?php

class News extends Controller {
  function News(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage News";
	$data['main'] = 'admin_news_home';
	$data['news'] = $this->MNews->getAllNewsAdmin();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('title')){
		
		/* if (empty($_FILES['image']['title'])){
		$this->session->set_flashdata('error','Please upload news image');
  		redirect('admin/news/index','refresh');
		} */
  		$this->MNews->createNews();
  		$this->session->set_flashdata('message','News created');
  		redirect('admin/news/index','refresh');
  	}else{
		$data['title'] = "Create News";
		$data['main'] = 'admin_news_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('title')){
  		$this->MNews->updateNews();
  		$this->session->set_flashdata('message','News updated');
  		redirect('admin/news/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit News";
		$data['main'] = 'admin_news_edit';
		$data['news'] = $this->MNews->getNews($id);
		if (!count($data['news'])){
			redirect('admin/news/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MNews->deleteNews($id);
	$this->session->set_flashdata('message','News deleted');
	redirect('admin/news/index','refresh');
  }

	
}//end class
?>