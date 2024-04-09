<?php



class Carmodel extends Controller {

  function Carmodel(){

    parent::Controller();

    session_start();

    

	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){

    	redirect('welcome/verify','refresh');

    }

  }

  



  function index(){

	$data['title'] = "Manage Models";

	$data['main'] = 'admin_carmodel_home';

	$data['carmodel'] = $this->MCarmodel->getAllCarmodels();

	$this->load->vars($data);

	$this->load->view('dashboard');  

  }

  



  

  function create(){

   	if ($this->input->post('title')){

  		

		$this->MCarmodel->createCarmodel();

		$this->session->set_flashdata('message','Model created');

  		redirect('admin/carmodel/index','refresh');

		

  	}else{

		

		$data['title'] = "Create Model";

		$data['main'] = 'admin_carmodel_create';

		$this->load->vars($data);

		$this->load->view('dashboard');    

	} 

  }

  

  function edit($id=0){

  	if ($this->input->post('title')){

  		$this->MCarmodel->updateCarmodel();

  		$this->session->set_flashdata('message','Model updated');

  		redirect('admin/carmodel/index','refresh');

  	}else{

		//$id = $this->uri->segment(4);

		$data['title'] = "Edit Model";

		$data['main'] = 'admin_carmodel_edit';

		$data['color'] = $this->MCarmodel->getCarmodel($id);

		if (!count($data['color'])){

			redirect('admin/carmodel/index','refresh');

		}

		$this->load->vars($data);

		$this->load->view('dashboard');    

	}

  }

  

  function delete($id){

	//$id = $this->uri->segment(4);

	$this->MCarmodel->deleteCarmodels($id);

	$this->session->set_flashdata('message','Model deleted');

	redirect('admin/carmodel/index','refresh');

  }
	function deleteMultiple(){
	

	$id_str = $_POST['id'];
	$deleteArr = explode(',',$id_str);
	if(!empty($deleteArr)){
	foreach($deleteArr  as $row){
	$this->MCarmodel->deleteCarmodels($row);
	}
	$this->session->set_flashdata('message','Models deleted sucessfully');	
	}
	echo '1';die;
	
	}
  function updateDb()

  {

	 // $this->MCarmodel->createmaker();

  }

	function udpateCarmodelStatus()
  {
	 $id = $this->uri->segment(4);
	 $status = $this->uri->segment(5);
	 $this->MCarmodel->updateCarmodelSt($id,$status);   
  }

}//end class

?>