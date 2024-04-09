<?php



class Dashboard extends Controller {

  function Dashboard(){

    parent::Controller();

    session_start();

    

	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){

	$this->session->set_flashdata('error',"Logged not successfully, Please check Username / Password.");  

    	redirect('welcome/verify','refresh');

    }

  }

  

 

  function index(){	

	$data['title'] = "Quick Links";

	$data['main'] = 'admin_home';

	$this->load->vars($data);

	$this->load->view('dashboard');

  }

 

 function logout(){

	unset($_SESSION['customer_id']);

	unset($_SESSION['username']);

	$this->session->set_flashdata('error',"You've been logged out!");

	redirect('welcome/verify','refresh'); 	

 }

 

}

?>