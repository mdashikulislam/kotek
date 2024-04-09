<?php



class Admins extends Controller {

  function Admins(){

    parent::Controller();

    session_start();

    

	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){

    	redirect('welcome/verify','refresh');

    }

  }

  

  function index(){

	$data['title'] = "Manage Admin Users";

	$data['main'] = 'admin_admins_home';

	$data['admins'] = $this->MAdmins->getAllUsers();

	$this->load->vars($data);

	$this->load->view('dashboard');  

  }

  



  

  function create(){

   	if ($this->input->post('username')){

$check = $this->MAdmins->checkUser($this->input->post('username'),$_POST['email']);

		if($check){	$this->session->set_flashdata('message','user already exists!!!');

  		redirect('admin/admins/index','refresh'); }

  		$this->MAdmins->addUser();

  		$this->session->set_flashdata('message','User created');

  		redirect('admin/admins/index','refresh');

  	}else{

		$data['title'] = "Create Admin User";

		$data['main'] = 'admin_admins_create';

		$this->load->vars($data);

		$this->load->view('dashboard');    

	} 

  }

  

  function edit($id=0){

  	if ($this->input->post('username')){

  		$this->MAdmins->updateUser();

  		$this->session->set_flashdata('message','User updated');

  		redirect('admin/admins/index','refresh');

  	}else{

		//$id = $this->uri->segment(4);

		$data['title'] = "Edit Admin User";

		$data['main'] = 'admin_admins_edit';

		$data['admin'] = $this->MAdmins->getUser($id);

		if (!count($data['admin'])){

			redirect('admin/admins/index','refresh');

		}

		$this->load->vars($data);

		$this->load->view('dashboard');    

	}

  }
  function profile(){
  	if ($this->input->post('username')){
  		$this->MAdmins->updateUser();
  		$this->session->set_flashdata('message','User updated');
  		redirect('admin/admins/profile','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		
		if(!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin')
		{
				redirect('admin/dashboard','refresh');
		}
		
		$data['title'] = "Update Profile";
		$data['main'] = 'admin_admins_profile';
		$data['admin'] = $this->MAdmins->getUser($_SESSION['customer_id']);
		if (!count($data['admin'])){
			redirect('admin/admins/profile','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  

  function delete($id){

	//$id = $this->uri->segment(4);

	$this->MAdmins->deleteUser($id);

	$this->session->set_flashdata('message','User deleted');

	redirect('admin/admins/index','refresh');

  }

  

}





?>