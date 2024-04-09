<?php

class Products extends Controller {
  function Products(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){
    	redirect('welcome/verify','refresh');
    }
  }
  
  function index(){
	$this->load->library('pagination');
	$per_page = 20;
	$fromLt = $this->uri->segment(4);
	$total = $this->MProducts->getAllProductsCount();
	if(empty($fromLt)){ $fromLt = 0; }
		$base_url = site_url('admin/products/index');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '4';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';	
	$data['pagen'] =  $this->pagination->initialize($config);
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProducts($fromLt, $per_page);
	$data['categories'] = $this->MCats->getCategoriesDropDown();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  function searchKeyword(){
	$this->load->library('pagination');
	$per_page = 20;
	$fromLt = $this->uri->segment(6);
	$searchby = $this->uri->segment(4);
	$searchKeyword = $this->uri->segment(5);
	$total = $this->MProducts->getAllProductsCountSearch($searchKeyword,$searchby);	
	if(empty($fromLt)){ $fromLt = 0; }
	
	
		$base_url = site_url('admin/products/searchKeyword/'.$searchby.'/'.$searchKeyword);
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '6';
	
	$data['pagen'] =  $this->pagination->initialize($config);
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProductsSearch($searchKeyword,$searchby,$fromLt, $per_page);
	
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  
  function search(){
	$this->load->library('pagination');
	$per_page = 20;
	$fromLt = 0;
	$searchKeyword = $_POST['searchKeyword'];
	$searchby = $_POST['search'];
	
	$total = $this->MProducts->getAllProductsCountSearch($searchKeyword,$searchby);	

	if(empty($fromLt)){ $fromLt = 0; }
		$base_url = site_url('admin/products/searchKeyword/'.$searchby.'/'.$searchKeyword);
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '6';
	
	$data['pagen'] =  $this->pagination->initialize($config);
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProductsSearch($searchKeyword,$searchby,$fromLt, $per_page);
	
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  function create(){
   	if ($this->input->post('name')){
  		$this->MProducts->addProduct();
  		$this->session->set_flashdata('message','Product created');
  		redirect('admin/products/index','refresh');
  	}else{
		$data['title'] = "Create Product";
		$data['main'] = 'admin_product_create';
		$data['categories'] = $this->MCats->getCategoriesList();		
		$data['makers'] = $this->MMaker->getAllMakers();	
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MProducts->updateProduct();	
  		$this->session->set_flashdata('message','Product updated');
  		redirect('admin/products/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Product";
		$data['main'] = 'admin_product_edit';
		$data['product'] = $this->MProducts->getProduct($id);
		$data['categories'] = $this->MCats->getCategoriesList();
		$modelContent = $this->MCarmodel->getCarmodel($data['product']['model']);
        $data['makerPro'] = $modelContent['maker'];
		$data['makers'] = $this->MMaker->getAllMakers();	
		$data['models'] = $this->MCarmodel->getModelByMaker($modelContent['maker']);

		if (!count($data['product'])){
			redirect('admin/products/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MProducts->deleteProduct($id);
	$this->session->set_flashdata('message','Product deleted');
	redirect('admin/products/index','refresh');
  }
  
  
  function batchmode(){
  	$this->MProducts->batchUpdate();
  	redirect('admin/products/index','refresh');
  }

  function export(){
  	$this->load->helper('download');
  	$csv = $this->MProducts->exportCsv();
  	$name = "product_export.csv";
  	force_download($name,$csv);

  }
  
  function import(){
	if ($this->input->post('csvinit')){
		$data['csv'] = $this->MProducts->importCsv();
		$data['title'] = "Preview Import Data";
		$data['main'] = 'admin_product_csv';
		$this->load->vars($data);
		$this->load->view('dashboard');

	}elseif($this->input->post('csvgo')){
		if (eregi("finalize", $this->input->post('submit'))){
			$this->MProducts->csv2db();
			$this->session->set_flashdata('message','CSV data imported');
		}else{
			$this->session->set_flashdata('message','CSV data import cancelled');
		}
		redirect('admin/products/index','refresh');
	}
  	
  }
  
  // setting  lace and personalization
  function settings(){
  	if ($this->input->post('lace')){
  		$this->MProducts->updateSettings();		
  		$this->session->set_flashdata('message','Price updated');
  		redirect('admin/products/settings','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Product personalization";
		$data['main'] = 'admin_settings';
		$data['product'] = $this->MProducts->getSettings();
		if (!count($data['product'])){
			redirect('admin/products/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function udpateProductStatus()
  {
	 $id = $this->uri->segment(4);
	 $status = $this->uri->segment(5);
	 $this->MProducts->updateProductSt($id,$status);   
  }
}


?>