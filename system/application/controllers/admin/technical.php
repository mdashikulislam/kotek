<?php class Technical extends Controller {

  function Technical(){
    parent::Controller();
    session_start();
	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){
    	redirect('welcome/verify','refresh');
    }

  }

  function index(){
	$this->load->model('general');
	$data['title'] = "Technical Info";
	$cond = array('status'=>1);
  	$data['banner'] = $this->general->getRecord('videos',$cond);
	$this->load->view('admin_technical_info',$data);  

  }

  
  function create(){
   	if ($this->input->post('title')){
  		$this->MNews->createBanner();
  		$this->session->set_flashdata('message','Technical created');
  		redirect('admin/technical/index','refresh');
  	}else{
		$data['title'] = "Create Technical Info";
		$this->load->view('admin_technical_info_create',$data);  
	} 
  }

  function save(){
  	$this->load->model('general');
  	 $name = $this->input->post('name');
  	 $keyword = $this->input->post('keyword');
  	 $description = $this->input->post('description');
  	 $content = $this->input->post('content');
  	 $data = array('name'=>$name,
  				   'keywords'=>$keyword,
  				   'description'=>$description,
  			       'content'=>$content);
  	 $this->general->addData('videos',$data);
  	 $this->session->set_flashdata('message','Record save');
  	 redirect('admin/technical');
  }

  

  function edit($id=0){
  	$this->load->model('general');
  	if ($this->input->post('title')){
  		$this->MNews->createBanner();
  		$this->session->set_flashdata('message','Technical created');
  		redirect('admin/technical/index','refresh');
  	}else{
		$data['title'] = "Edit Technical Info";
		$cond = array('id'=>$id);
		$data['record'] = $this->general->getRecord('videos',$cond);
		$this->load->view('admin_technical_info_edit',$data);  
	}
  }


  function update(){
  	$this->load->model('general');
  	 $name = $this->input->post('name');
  	 $keyword = $this->input->post('keyword');
  	 $description = $this->input->post('description');
  	 $content = $this->input->post('content');
  	 $updated_id = $this->input->post('updated_id');
  	 $data = array('name'=>$name,
  				   'keywords'=>$keyword,
  				   'description'=>$description,
  			       'content'=>$content);
  	 $this->general->updateData('videos',$data,array('id'=>$updated_id));
  	 $this->session->set_flashdata('message','Record updated');
  	 redirect('admin/technical/edit/'.$updated_id.'');
  }

  function delete_single($id=null){
  	$this->load->model('general');
  	 if($id==''){
  	 	$this->session->set_flashdata('message','id is missing');
  		redirect('admin/technical');	 	
  	 }
  	 $this->general->deleteData('videos',array('id'=>$id));
  	 $this->session->set_flashdata('message','Record delete successfully');
  	 redirect('admin/technical');	
  }


	function deleteMultiple(){
		$id_str = $_POST['id'];
		$deleteArr = explode(',',$id_str);
		if(!empty($deleteArr)){
			for ($i=0; $i < count($deleteArr); $i++) { 
				$this->general->deleteData('videos',array('id'=>$deleteArr[$i]));
			}
		   echo '1';die;
		}else{
			redirect('admin/technical');		
		}	
	
	}

	

}//end class

?>