<?php

class Dashboard extends Controller {
  function Dashboard(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
	$this->session->set_flashdata('error',"You must log in!");  
    	redirect('welcome/verify','refresh');
    }
  }
  
 
  function index(){	
	$data['title'] = "Dashboard";
	$data['main'] = 'admin_home';
	$this->load->vars($data);
	$this->load->view('dashboard');
  }
 
 function logout(){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	$this->session->set_flashdata('error',"You've been logged out!");
	redirect('welcome/verify','refresh'); 	
 }
 
}
?>