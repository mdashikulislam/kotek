<?php



class Categories extends Controller {

  function Categories(){

    parent::Controller();

    session_start();

    

	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){

    	redirect('welcome/verify','refresh');

    }

  }
  function index(){

	$data['title'] = "Manage Groups";

	$data['main'] = 'admin_cat_home';

	$data['categories'] = $this->MCats->getAllCategoriesAdmin();

	$this->load->vars($data);

	$this->load->view('dashboard');  

  }

  



  

  function create(){

   	if ($this->input->post('name')){

  		$this->MCats->addCategory();

  		$this->session->set_flashdata('message','Group created');

  		redirect('admin/categories/index','refresh');

  	}else{

		$data['title'] = "Create Group";

		$data['main'] = 'admin_cat_create';

		$data['categories'] = $this->MCats->getTopCategories();

		$this->load->vars($data);

		$this->load->view('dashboard');    

	} 

  }

  

  function edit($id=0){

  	if ($this->input->post('name')){

  		$this->MCats->updateCategory();

  		$this->session->set_flashdata('message','Group updated');

  		redirect('admin/categories/index','refresh');

  	}else{

		//$id = $this->uri->segment(4);

		$data['title'] = "Edit Group";

		$data['main'] = 'admin_cat_edit';

		$data['category'] = $this->MCats->getCategory($id);

		$data['categories'] = $this->MCats->getTopCategories();

		if (!count($data['category'])){

			redirect('admin/categories/index','refresh');

		}

		$this->load->vars($data);

		$this->load->view('dashboard');    

	}

  }

  

  function delete($id){

	//$id = $this->uri->segment(4);

	$this->MCats->deleteCategory($id);

	

		$this->session->set_flashdata('message','Group deleted');

		redirect('admin/categories/index','refresh');

	

  }



  function export(){

  	$this->load->helper('download');

  	$csv = $this->MCats->exportCsv();

  	$name = "category_export.csv";

  	force_download($name,$csv);



  }



	function reassign($id=0){

		if ($_POST){

			$this->MProducts->reassignProducts();

			$this->session->set_flashdata('message','Category deleted and products reassigned');

			redirect('admin/categories/index','refresh');

		}else{

			//$id = $this->uri->segment(4);

			$data['category'] = $this->MCats->getCategory($id);

			$data['title'] = "Reassign Products";

			$data['main'] = 'admin_cat_reassign';

			$data['categories'] = $this->MCats->getCategoriesDropDown();

			$this->load->vars($data);

			$this->load->view('dashboard');    	

		}	

	}

 function udpateCategoryStatus()
  {
	 $id = $this->uri->segment(4);
	 $status = $this->uri->segment(5);
	 $this->MCats->updateCategorySt($id,$status);   
  }

	

}//end class

?>