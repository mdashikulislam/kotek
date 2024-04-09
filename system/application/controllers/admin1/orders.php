<?php

class Orders  extends Controller {
  function Orders(){
    parent::Controller();
    session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
  
    function index(){
	$data['title'] = "Manage Orders";
	$data['main'] = 'admin_order_home';
	$data['products'] = $this->MOrders->getAllOrders();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  
  
    function giftVouchers(){
	$data['title'] = "Manage Gift Certificates";
	$data['main'] = 'admin_gift_home';
	$data['products'] = $this->MOrders->getAllGift();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  
  
    function customers(){
	$data['title'] = "Manage Leads";
	$data['main'] = 'admin_customer_home';
	$data['products'] = $this->MOrders->getCustomers();

	
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  function userlog(){
	  $this->load->library('pagination');
	 $per_page = 20;
	$fromLt = $this->uri->segment(4);
	$total = $this->MCustomers->getTotalUserLog();
	if(empty($fromLt)){ $fromLt = 0; }
		$base_url = site_url('admin/orders/userlog');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '4';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$data['pagen'] =  $this->pagination->initialize($config);
	
	
	
	$data['title'] = "View User Log";
	$data['main'] = 'admin_user_log';
	$data['products'] = $this->MCustomers->getUserLog($fromLt,$per_page);

	
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  function viewOrder($id)
  {
  	if (!empty($id)){
  		$data['orders'] = $this->MOrders->getOrder($id); 
		$data['ordersDetails'] =  $this->MOrders->getOrderDetails($id);
  	$data['title'] = "View Order";
	$data['main'] = 'admin_order_view';
	$this->load->vars($data);
	$this->load->view('dashboard');  

  	}else{
	redirect('admin/orders','refresh');
	}
  
  } 
  
   function editCustomer($id=0){
  	if ($this->input->post('email')){
  		$this->MCustomers->updateCustomer(); 
  		$this->session->set_flashdata('message','Customer updated');
  		redirect('admin/orders/customers','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Lead";
		$data['main'] = 'admin_customer_edit';
		

		if (empty($id)){
			redirect('admin/orders/customers','refresh');
		}
		$data['customer'] = $this->MCustomers->getCustomer($id);
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function deleteCustomer($id){
	//$id = $this->uri->segment(4);
	$this->MCustomers->deleteUser($id);
	$this->session->set_flashdata('message','Customer deleted');
	redirect('admin/orders/customers','refresh');
  }
  function deleteNewCustomer($id){
	//$id = $this->uri->segment(4);
	$this->MCustomers->deleteUser($id);
	$this->session->set_flashdata('message','Customer deleted');
	redirect('admin/orders/newRegistration','refresh');
  }
  function updateOrderStatus()
  {
	  $id = $this->uri->segment(4);
	  $status = $this->uri->segment(5);
	  
	  $this->MOrders->updateOrderSt($id,$status); 
	
  }
  
   function newRegistration(){
	$data['title'] = "Manage New Registration";
	$data['main'] = 'admin_customer_new';
	$data['products'] = $this->MCustomers->getNewCustomers();

	
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  
  function allowCustomer($id)
  {
  $this->MCustomers->allowuser($id);
  $customer_data = $this->MCustomers->getCustomer($id);
  
  
      $message ="Hi ".$customer_data['customer_first_name']."&nbsp;".$customer_data['customer_last_name'].",<br/><br/>";
	  $message .= "Power Steering Kit Specialist authenticate your request, please use below login details to view product details and distributor list <br/><br/>";
      $message .= "Email :".$customer_data['email'] ."<br/>";
      $message .= "Password :".$customer_data['password']."<br/>";
	  $message .= "Please keep your logins safe. <br/>";
	  $message .= "Power Steering Kit Specialist reserves the right to revoke the registration of any user. <br/>";
	  $message .= "<br/>";
	  $message .= "Regards,<br/>";
	  $message .= "Administration, <br/>Power Steering Kit Specialist";
	  
    	$name =  "Power Steering Kit Specialist";
	    $subject = "User authentication -Power Steering Kit Specialist";
	  	$from= $this->config->item('site_admin_email');
                $config['smtp_host'] = 'relay-hosting.secureserver.net';
	        $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
		$config['protocol'] = 'sendmail';
                $this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from( $from, $name );
		$this->email->to($customer_data['email']);
		$this->email->subject( $subject );
		$this->email->message( $message );
		$this->email->send();
		$this->email->clear();
		
		
	$this->session->set_flashdata('message','Customer Authonticate!!! ');
	redirect('admin/orders/newRegistration','refresh');
  }
}


?>