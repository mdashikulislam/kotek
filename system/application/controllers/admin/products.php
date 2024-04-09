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
	  /* Code Added by Prajakta T.*/
	    $sortfield = '';
		$orderby = '';
		if(is_numeric($this->uri->segment(4)))
		{
		  $fromLt = $this->uri->segment(4);
		  $config['uri_segment'] = '4';
		}
		else
		{
			if($this->uri->segment(4) != '')
			{
				$sortfield = $this->uri->segment(4);
			}
			if($this->uri->segment(5) != '')
			{
				$orderby = $this->uri->segment(5);
			}
			$fromLt = $this->uri->segment(6);
			$config['uri_segment'] = '6';
		}

    /* Code Ends */
	  
	$this->load->library('pagination');
	$per_page = 20;
	
	$total = $this->MProducts->getAllProductsCount();
	
	if(empty($fromLt)){ $fromLt = 0; }
		$base_url1 = site_url('admin/products/index');
		$base_url = $base_url1;
		if($sortfield != '')
		{
			$base_url .= '/'.$sortfield;
		}
		if($orderby != '')
		{
			$base_url .= '/'.$orderby;
		}

		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
			
	$data['pagen'] =  $this->pagination->initialize($config);
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProducts($fromLt, $per_page, $sortfield, $orderby);
	//$data['categories'] = $this->MCats->getCategoriesDropDown();
	$data['searchKey'] = "";
	$data['per_page'] = $per_page;
	$data['searchBy'] = "";
	$data['fromLt'] = $fromLt;
	$data['base_url'] = $base_url1;
	$data['orderby'] = $orderby;
	$data['sortfield'] = $sortfield;
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  
 
  function searchKeyword(){
 
	$this->load->library('pagination');
	$per_page = 20;
	$sortfield = '';
	$orderby = '';
	if(is_numeric($this->uri->segment(6)))
    {
	  $fromLt = $this->uri->segment(6);
	  $config['uri_segment'] = '6';
    }
	else
	{
		if($this->uri->segment(6) != '')
		{
			$sortfield = $this->uri->segment(6);
		}
		if($this->uri->segment(7) != '')
		{
			$orderby = $this->uri->segment(7);
		}
		$fromLt = $this->uri->segment(8);
		$config['uri_segment'] = '8';
	}
	//$fromLt = $this->uri->segment(6);
	$searchby = $this->uri->segment(4);
	$searchKeyword = $this->uri->segment(5);
	$total = $this->MProducts->getAllProductsCountSearch($searchKeyword,$searchby);	
	if(empty($fromLt)){ $fromLt = 0; }
	
	
		$base_url1 = site_url('admin/products/searchKeyword/'.$searchby.'/'.$searchKeyword);
		$base_url = $base_url1;
		if($sortfield != '')
		{
			$base_url .= '/'.$sortfield;
		}
		if($orderby != '')
		{
			$base_url .= '/'.$orderby;
		}
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		
	
	$data['base_url'] = $base_url1;
	$data['pagen'] =  $this->pagination->initialize($config);
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProductsSearch($searchKeyword,$searchby,$fromLt, $per_page,  $sortfield, $orderby);
	$data['searchKey'] = $searchKeyword;
	$data['per_page'] = $per_page;
	$data['searchBy'] = $searchby;
	$data['fromLt'] = $fromLt;
	$data['orderby'] = $orderby;
	$data['sortfield'] = $sortfield;
	$this->load->vars($data);
	$this->load->view('dashboard');  
	
  }
  function search(){
	$sortfield = '';
	$orderby = '';
	if(is_numeric($this->uri->segment(4)))
    {
	  $fromLt = $this->uri->segment(4);
	  $config['uri_segment'] = '6';
    }
	else
	{
		if($this->uri->segment(4) != '')
		{
			$sortfield = $this->uri->segment(4);
		}
		if($this->uri->segment(5) != '')
		{
			$orderby = $this->uri->segment(5);
		}
		$fromLt = $this->uri->segment(6);
		$config['uri_segment'] = '6';
	}

	$this->load->library('pagination');
	$per_page = 20;
	$fromLt = 0;
	$searchKeyword  = '';
	if(isset($_POST['searchKeyword']))
	{ 
	  $searchKeyword = $_POST['searchKeyword'];
	}
	else
	{
		redirect('admin/products/index');
	} 
	$searchby = $_POST['search'];
	$total = $this->MProducts->getAllProductsCountSearch($searchKeyword,$searchby);	

	if(empty($fromLt)){ $fromLt = 0; }
		$base_url1 = site_url('admin/products/searchKeyword/'.$searchby.'/'.$searchKeyword);
        $base_url = $base_url1;
		if($sortfield != '')
		{
			$base_url .= '/'.$sortfield;
		}
		if($orderby != '')
		{
			$base_url .= '/'.$orderby;
		}
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '7';
	
	$data['pagen'] =  $this->pagination->initialize($config);
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProductsSearch($searchKeyword,$searchby,$fromLt, $per_page ,$sortfield, $orderby);
	$data['searchKey'] = $searchKeyword;
	$data['per_page'] = $per_page;
	$data['searchBy'] = $searchby;
	$data['fromLt'] = $fromLt;
	$data['base_url'] = $base_url1;
	$data['orderby'] = $orderby;
	$data['sortfield'] = $sortfield;
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
  
   function deleteMultiple(){
	
	$id_str = $_POST['id'];
	$deleteArr = explode(',',$id_str);
	if(!empty($deleteArr)){
		foreach($deleteArr as $row)
		{
			$this->MProducts->deleteProduct($row);
		}
		$this->session->set_flashdata('message','Products deleted sucessfully');
		
	}
	echo '1';die;
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
  
  function getProductArray($id)
  {
	 // $id = $id+1;
	  $makers = $this->MMaker->getAllMakers();	
	  
		$productArray =  "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable' id='newProd_".$id."'>";
		$productArray .="<tr>";
		$productArray .="<td width='143' ><label for='group'>Year from<span class='red'>*</span> :</label></td><td>";
		$data = array('name'=>'year_from_'.$id,'id'=>'year_from_'.$id,'class'=>'textfield','size'=>10, 'value' =>' ');
		$productArray .=form_input($data) ."</td>";
		
		$productArray .="<td width='80' ><label for='group'>Year to<span class='red'>*</span> :</label></td><td>";
		$data = array('name'=>'year_to_'.$id,'id'=>'year_to_'.$id,'class'=>'textfield','size'=>10, 'value' =>' ','style'=> 'width:',);
		$productArray .=form_input($data) ."</td>";
		$productArray .="</tr>";
		
		$productArray .="<tr>";
		$productArray .="<td><label for='price'>Maker<span class='red'>*</span> :</label></td><td>";
		$productArray .="<select name='make_".$id."' id='make_".$id."' onchange='showModel(".$id.", this.value)' > <option value=''>select maker</option>";
		foreach ($makers as $key => $value){
		$productArray .="<option value='".$value['id']."' >".$value['name']."</option>";
		}
		$productArray .="</select>";
		$productArray .="</td>";

		$productArray .="<td><label for='price'>Model<span class='red'>*</span> :</label></td><td id='showModel_".$id."'>";
		$productArray .="<select name='model_".$id."' id='model_".$id."'> <option value=''>select model</option>";
		$productArray .="</select>";
		$productArray .="</td>";
		$productArray .="</tr>";		
		$productArray .="</table>";

	  echo $productArray;
  }
  
  function udpateProductStatus()
  {
	 $id = $this->uri->segment(4);
	 $status = $this->uri->segment(5);
	 $this->MProducts->updateProductSt($id,$status);   
  }
  
  function exportProduct(){
	  
      $data = $this->MProducts->exportCsv();
	
	  $now = time();
	  $filename = str_replace(' ','-',date("Y-m-d H:i:s", $now)); 
	  header("Pragma: public");
	  header("Expires: 0");
	  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	  header("Cache-Control: private",false);
	  header("Content-Type: application/octet-stream");
	  
	  header("Content-Disposition: attachment; filename=".$filename.".csv;" );
	  header("Content-Transfer-Encoding: binary"); 
	  echo $data;
                  
	
	
	
  }
	
}


?>