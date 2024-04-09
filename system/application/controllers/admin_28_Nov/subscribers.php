<?php



class Subscribers extends Controller {

  function Subscribers(){

    parent::Controller();

	session_start();

  $this->tinyMce = '

    <!-- TinyMCE -->

    <script type="text/javascript" src="'.  base_url()

       .'js/tiny_mce/tiny_mce.js"></script>

    <script type="text/javascript">

      tinyMCE.init({

      // General options

      mode : "textareas",

      theme : "simple"

      });

    </script>

    <!-- /TinyMCE -->

  ';



   

    

	if (!isset($_SESSION['customer_id']) || $_SESSION['customer_type'] != 'admin'){

    	redirect('welcome/verify','refresh');

    }

  }

  



  function index(){

	$data['title'] = "Manage Subscribers";

	$data['main'] = 'admin_subs_home';

	$data['subscribers'] = $this->MSubscribers->getAllSubscribers();

	$this->load->vars($data);

	$this->load->view('dashboard');  

  }

  

  

  function delete($id){

	//$id = $this->uri->segment(4);

$sub = $this->MSubscribers->getSubscriber($id);



$msg = "Hi, <br/> Admin unsubscribe you to Power Steering Kit Specialist.<br/><br/> <br/>Thanks,<br/>Administrator, Power Steering Kit Specialist

 ";                             $this->load->library('email');

                                $config['charset'] = 'iso-8859-1';

                                $config['wordwrap'] = TRUE;

                                $config['protocol'] = 'sendmail';

			        $this->email->initialize($config);

				$this->email->set_mailtype("html");

				$this->email->from($this->config->item('site_admin_email'), $this->config->item('site_title'));

				$this->email->to($sub['email']);

				$subject ="Unsubscribed to Power Steering Kit Specialist";

				$this->email->subject($subject);

				$this->email->message($msg);		

				$this->email->send();





	$this->MSubscribers->removeSubscriber($id);

	$this->session->set_flashdata('message','Subscriber deleted');

	redirect('admin/subscribers/index','refresh');

  }





  function sendemail(){

  

  	$this->load->helper('file');

	

  	if (isset($_POST['subject'])){

  		$test = $this->input->post('test');

 		$subject = $this->input->post('subject');

 		$msg = $this->input->post('message');

 	

	if( empty($subject) || empty($msg)){

		

	$this->session->set_flashdata('error', "Please insert subject and message");

	redirect('admin/subscribers/sendemail','refresh'); 

	

	}

 		if ($test){

 			

 	        $this->load->library('email');

                        $config['charset'] = 'iso-8859-1';

                        $config['wordwrap'] = TRUE;

                        $config['protocol'] = 'sendmail';



                        $this->email->initialize($config);

			$this->email->set_mailtype("html");

			$this->email->from($this->config->item('site_admin_email'), $this->config->item('site_title'));

			$this->email->to($this->config->item('site_admin_email'));

			$this->email->subject($subject);

			$this->email->message($msg);		

			$this->email->send();





			$this->session->set_flashdata('message', "Test email sent");

			write_file('/tmp/email.log', $subject ."|||".$msg);

			redirect('admin/subscribers/sendemail','refresh'); 

 		}else{

 			$subs = $this->MSubscribers->getAllSubscribers();

			foreach ($subs as $key => $list){

				$unsub = "<p><a href='". base_url()."welcome/unsubscribe/".$list['id']. "'>Unsubscribe</a></p>";



                        $config['charset'] = 'iso-8859-1';

                        $config['wordwrap'] = TRUE;

                        $config['protocol'] = 'sendmail';

                        $config['smtp_host'] = 'relay-hosting.secureserver.net';

                        $this->email->initialize($config);

				

		$this->email->set_mailtype("html");

		$this->email->from($this->config->item('site_admin_email'), $this->config->item('site_title'));

				$this->email->to($list['email']);

				

				$this->email->subject($subject);

				$this->email->message($msg . $unsub);		

				$this->email->send();

                                $this->email->clear();	

			}

 			$this->session->set_flashdata('message', count($subs) . " emails sent");

		}

	

		redirect('admin/subscribers/index','refresh'); 	





  	}else{

  		if ($this->session->flashdata('message') == "Test email sent"){

  			$lastemail = read_file('/tmp/email.log');

  			list($subj,$msg) = explode("|||",$lastemail);

			$data['subject'] = $subj;

			$data['msg'] = $msg;

		}else{

			$data['subject'] = '';

			$data['msg'] = '';

		}

 		$data['title'] = "Send Email";

		$data['main'] = 'admin_subs_mail';

		$this->load->vars($data);

		$this->load->view('dashboard');  			

  	}

  }

	

 /*********************************  section for user request ****************************************/

 

	

	function requests(){

	$data['title'] = "Manage Product Request";

	$data['main'] = 'admin_request_home';

	$data['subscribers'] = $this->MSubscribers->getAllReqeusts();

	$this->load->vars($data);

	$this->load->view('dashboard');  

  }

  

  

   function deleteRequest($id){

	//$id = $this->uri->segment(4);

	$this->MSubscribers->removeRequest($id);

	$this->session->set_flashdata('message','User Request deleted');

	redirect('admin/subscribers/requests','refresh');

  }

  

  function replyRequest($id)

  {

	  

		$data['user_request'] = $this->MSubscribers->getRequest($id);	

		$data['user_id'] = $id;

	 	$data['title'] = "Send Email";

		$data['main'] = 'admin_request_mail';

		$this->load->vars($data);

		$this->load->view('dashboard');

	  

  }
 function viewRequest($id)
  {
	  
		$data['user_request'] = $this->MSubscribers->getRequest($id);	
		$data['user_id'] = $id;
	 	$data['title'] = "View Request";
		$data['main'] = 'admin_request_view';
		$this->load->vars($data);
		$this->load->view('dashboard');
	  
  }
   function sendemailRequest()

   {

	   

			$message = $_POST['message'];

			$subject = $_POST['subject'];

	   		$user_request = $this->MSubscribers->getRequest($_POST['user']);

			

			

	   		$myemail = $user_request['email'];

		 	$this->load->library('email');

		          $config['charset'] = 'iso-8859-1';

        	        $config['wordwrap'] = TRUE;

                        $config['protocol'] = 'sendmail';

			$this->email->initialize($config);

			$this->email->set_mailtype("html");

			$this->email->set_newline("\r\n");

                        

			$this->email->from($this->config->item('site_admin_email'));

			$this->email->to($myemail);		

			$this->email->subject($subject.' Reply by Power Steering Kit Specialist');		

			$this->email->message("Hi ". ucfirst($user_request['name'])."<br /><br />".$message."<br /><br />Thanks & regards, <br />Team Power Steering Kit Specialist");

			$this->email->send();

			$this->email->clear();

		    $this->session->set_flashdata('message', 'Replied to user sucessfully');		

		

		    redirect('admin/subscribers/requests');

	   

	   

   }



}//end class

?>