<?php

class Dimensions extends Controller {
  function Dimensions(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Dimension";
	$data['main'] = 'admin_dimensions_home';
	$data['dimensions'] = $this->MDimensions->getAllDimensions();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MDimensions->addDimensions();
  		$this->session->set_flashdata('message','Dimension created');
  		redirect('admin/dimensions/index','refresh');
  	}else{
		$data['title'] = "Create Dimension";
		$data['main'] = 'admin_dimensions_create';
		
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MDimensions->updateDimensions();
  		$this->session->set_flashdata('message','Dimension updated');
  		redirect('admin/dimensions/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Dimension";
		$data['main'] = 'admin_dimensions_edit';
		$data['category'] = $this->MDimensions->getDimensions($id);
		
		if (!count($data['category'])){
			redirect('admin/dimensions/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MDimensions->deleteDimensions($id);
	
		$this->session->set_flashdata('message','Dimension deleted');
		redirect('admin/dimensions/index','refresh');
	
  }

  function export(){
  	$this->load->helper('download');
  	$csv = $this->MDimensions->exportCsv();
  	$name = "category_export.csv";
  	force_download($name,$csv);

  }

	function reassign($id=0){
		if ($_POST){
			$this->MProducts->reassignProducts();
			$this->session->set_flashdata('message','Dimensions deleted and products reassigned');
			redirect('admin/dimensions/index','refresh');
		}else{
			//$id = $this->uri->segment(4);
			$data['category'] = $this->MDimensions->getDimensions($id);
			$data['title'] = "Reassign Products";
			$data['main'] = 'admin_dimensions_reassign';
			$data['dimensions'] = $this->MDimensions->getDimensionsDropDown();
			$this->load->vars($data);
			$this->load->view('dashboard');    	
		}	
	}

	function addDimentions($counter = 0)
	{
		$dimenList = $this->MDimensions->getAllDimensions();
		echo '<div class="dimenSelect"><select name="dimentionsList[]" >';
		foreach($dimenList as $key1=>$value1)
		{
		echo "<option value='".$value1['id']."'>".$value1['name']."</option>";	
		}
	
		echo '</select></div>';
		echo '<div class="dimenValue"><input type="text" class="textfield" id="dimensions" value="" name="dimensions[]"></div>';
		
	}
	
}//end class
?>