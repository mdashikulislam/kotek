<?php



class Advertise extends Controller {

  function Advertise(){

    parent::Controller();

    session_start();

    

	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){

    	redirect('welcome/verify','refresh');

    }

  }

  



  function index(){

	$data['title'] = "Manage Advertise";

	$data['main'] = 'admin_advertise_home';

	$data['advertise'] = $this->MNews->getAllAdvertise();

	$this->load->vars($data);

	$this->load->view('dashboard');  

  }

  



  

  function create(){

   	if ($this->input->post('title')){

		

		/* if (empty($_FILES['image']['title'])){

		$this->session->set_flashdata('error','Please upload advertise image');

  		redirect('admin/advertise/index','refresh');

		} */

  		$this->MNews->createAdvertise();

  		$this->session->set_flashdata('message','Advertise created');

  		redirect('admin/advertise/index','refresh');

  	}else{

		$data['title'] = "Create Advertise";

		$data['main'] = 'admin_advertise_create';

		$this->load->vars($data);

		$this->load->view('dashboard');    

	} 

  }

  

  function edit($id=0){

  	if ($this->input->post('title')){

  		$this->MNews->updateAdvertise();

  		$this->session->set_flashdata('message','Advertise updated');

  		redirect('admin/advertise/index','refresh');

  	}else{

		//$id = $this->uri->segment(4);

		$data['title'] = "Edit Advertise";

		$data['main'] = 'admin_advertise_edit';

		$data['advertise'] = $this->MNews->getAdvertise($id);

		if (!count($data['advertise'])){

			redirect('admin/advertise/index','refresh');

		}

		$this->load->vars($data);

		$this->load->view('dashboard');    

	}

  }

  

  function delete($id){

	//$id = $this->uri->segment(4);

	$this->MNews->deleteAdvertise($id);

	$this->session->set_flashdata('message','Advertise deleted');

	redirect('admin/advertise/index','refresh');

  }
	function deleteMultiple(){
	
        $id_str = $_POST['id'];
	$deleteArr = explode(',',$id_str);
	if(!empty($deleteArr)){
	foreach($deleteArr as $row)
	{
	  $this->MNews->deleteAdvertise($row);
	}
	$this->session->set_flashdata('message','Advertises deleted sucessfully');
	
	}
	 echo '1';die;
	}

function udpateAdvertiseStatus()
  {
	 $id = $this->uri->segment(4);
	 $status = $this->uri->segment(5);
	 $this->MNews->updateAdvertiseSt($id,$status);   
  }

	

}//end class

?>