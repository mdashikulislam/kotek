<?php
 
class MCustomers extends Model{
 
    function MCustomers(){
        parent::Model();
    }
 
    function getCustomer($id){
      $data = array();
      $options = array('customer_id' => id_clean($id));
      $Q = $this->db->getwhere('customer',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }
      $Q->free_result();
      return $data;
    }
 
    function getCustomerByEmail($e){
      $data = array();
      $options = array('email' => $e);
      $Q = $this->db->getwhere('customer',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }
      $Q->free_result();
      return $data;
    }
 
    function getAllCustomers(){
     $data = array();
     $Q = $this->db->get('customer');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();
     return $data;
    }
 
    function getCustomers(){
     $data = array();
     return $this->db->get('customer');
    }

    function getState(){
     $data = array();
     $Q = $this->db->get('state');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();
     return $data;
    }
 
    function addCustomer(){
     $data = array(
                    'customer_first_name' => db_clean($_POST['customer_first_name'],25),
                    'customer_last_name' => db_clean($_POST['customer_last_name'],25),
                    'phone_number' => db_clean($_POST['phone_number'],15),
		    'company' => db_clean($_POST['company'],50),
                    'email' => db_clean($_POST['email'],50),
                    'address' => db_clean($_POST['address'],50),
                    'city' => db_clean($_POST['city'],25),
					'state' => db_clean($_POST['state'],25),
					'country' => db_clean($_POST['country'],2),
                    'post_code' => db_clean($_POST['post_code'],10),
                    'password' => db_clean($_POST['password'],16),
                  //  'customer_first_name_ship' => db_clean($_POST['customer_first_name'],25),
                  //  'customer_last_name_ship' => db_clean($_POST['customer_last_name'],25),
                  //  'phone_number_ship' => db_clean($_POST['phone_number'],15),
                   // 'email_ship' => db_clean($_POST['email'],50),
                   // 'address_ship' => db_clean($_POST['address'],50),
                   // 'city_ship' => db_clean($_POST['city'],25),
				//	'state_ship' => db_clean($_POST['state'],25),
				//	'country_ship' => db_clean($_POST['country'],2),
                //    'post_code_ship' => db_clean($_POST['post_code'],10)

					
     );
      $this->db->insert('customer',$data);
	  
		/*     $_SESSION['customer_id'] = $this->db->insert_id();  
            $_SESSION['customer_first_name'] = $_POST['customer_first_name'];
            $_SESSION['customer_last_name'] = $_POST['customer_last_name'];
            $_SESSION['phone_number'] = $_POST['phone_number'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['city'] = $_POST['city'];
			$_SESSION['state'] = $_POST['state'];
            $_SESSION['country'] = $_POST['country']; */
	  
	  $message ="Hi ".$_POST['customer_first_name']."&nbsp;".$_POST['customer_last_name'].",<br/><br/>";
	  $message .= "Thank you for registering with Power Steering Kit Specialist, your email address are shown below, <br/><br/>";
      $message .= "Email :".$_POST['email'] ."<br/>";
      $message .= "Password :".$_POST['password']."<br/>";
	  $message .= "Please keep your login safe. <br/>";
	  $message .= "Power Steering Kit Specialist reserves the right to revoke the registration of any user. <br/>";
	  $message .= "<br/>";
	  $message .= "Regards,<br/>";
	  $message .= "Administration, <br/> Power Steering Kit Specialist";
	  
	  
    	$name =  "Power Steering Kit Specialist ";
	    $subject = "REGISTRATION CONFIRMATION -Power Steering Kit Specialist";
	  	$from= $this->config->item('site_admin_email');
	    $config['charset'] = 'iso-8859-1';
$config['smtp_host'] = 'relay-hosting.secureserver.net';
        $config['wordwrap'] = TRUE;
		$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['protocol'] = 'sendmail';
            
        $this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from( $from, $name );
		$this->email->to($_POST['email']);
		$this->email->subject( $subject );
		$this->email->message( $message );
		$this->email->send();
		$this->email->clear();
	  
	  
    }
	
	 function addCustomerShip(){
	// $password =  random_string('alnum', 8);
	 
     $data = array(
                    'customer_first_name' => db_clean($_POST['customer_first_name'],25),
                    'customer_last_name' => db_clean($_POST['customer_last_name'],25),
                    'phone_number' => db_clean($_POST['phone_number'],15),
					//	'company' => db_clean($_POST['company'],50),					
                    'email' => db_clean($_POST['email'],50),
                    'address' => db_clean($_POST['address'],50),
					'address2' => db_clean($_POST['address1'],50),
                    'city' => db_clean($_POST['city'],25),
					'state' => db_clean($_POST['state'],25),
					'country' => db_clean($_POST['country'],2),
                    'post_code' => db_clean($_POST['post_code'],10),
					'country_ship' => db_clean($_POST['countryS'],20),
                    'password' => $_POST['upassword'],
                    /* 'customer_first_name_ship' => db_clean($_POST['customer_first_nameS'],25),
                    'customer_last_name_ship' => db_clean($_POST['customer_last_nameS'],25),
                    'phone_number_ship' => db_clean($_POST['phone_numberS'],15),
                    'address1_ship' => db_clean($_POST['addressS'],50),
                    'address2_ship' => db_clean($_POST['address1S'],50),
                    'city_ship' => db_clean($_POST['cityS'],25),
					'state_ship' => db_clean($_POST['stateS'],25),
					'country_ship' => db_clean($_POST['countryS'],2),
                    'post_code_ship' => db_clean($_POST['post_codeS'],10) */
     );
      $this->db->insert('customer',$data);
	  $userID = $this->db->insert_id();  
	  
	  $message ="Hi ".$_POST['customer_first_name']."&nbsp;".$_POST['customer_last_name']."<br/>";
	  $message .= "Thank you for registering with Power Steering Kit Specialist, your email address are shown below, <br/><br/>";
      $message .= "Email :".$_POST['email'] ."<br/>";
      $message .= "Password :".$_POST['upassword']."<br/>";
	  $message .= "Please keep your logins safe. <br/>";
	  $message .= "Power Steering Kit Specialist reserves the right to revoke the registration of any user.. <br/>";
	  
     	$name =  "Power Steering Kit Specialist ";
	    $subject = "REGISTRATION CONFIRMATION -Power Steering Kit Specialist";
	  	$from= $this->config->item('site_admin_email');
	    $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
		
        $this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from( $from, $name );
		$this->email->to($_POST['email']);
		$this->email->subject( $subject );
		$this->email->message( $message );
		$this->email->send();
		$this->email->clear();
	  
	  
	  
	  return $userID;
    }
 
    function checkCustomer($e){
        $numrow = 0;
        $this->db->select('customer_id');
        $this->db->where('email',db_clean($e));
        $this->db->limit(1);
        $Q = $this->db->get('customer');
        if ($Q->num_rows() > 0){
            $numrow = TRUE;
            return $numrow;
        }else{
            $numrow = FALSE;
            return $numrow;
        }
    }
 
    function verifyCustomer($e,$pw){
        $this->db->where('email',db_clean($e,50));
        $this->db->where('password', db_clean($pw,16));
        $this->db->where('customer_status != ', '0');
        $this->db->limit(1);
        $Q = $this->db->get('customer');
        if ($Q->num_rows() > 0){
            $row = $Q->row_array();
			$_SESSION['customer_type'] = "user";
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['customer_first_name'] = $row['customer_first_name'];
            $_SESSION['customer_last_name'] = $row['customer_last_name'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['post_code'] = $row['post_code'];
			$_SESSION['state'] = $row['state'];
            $_SESSION['country'] = $row['country'];
        }else{
            // $_SESSION['customer_id'] = 0; // this will eliminate error
        }
    }
	
	    function makeSession($id){
        $this->db->where('customer_id',db_clean($id));
        $this->db->limit(1);
        $Q = $this->db->get('customer');
        if ($Q->num_rows() > 0){
            $row = $Q->row_array();
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['customer_first_name'] = $row['customer_first_name'];
            $_SESSION['customer_last_name'] = $row['customer_last_name'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['post_code'] = $row['post_code'];
			$_SESSION['state'] = $row['state'];
            $_SESSION['country'] = $row['country'];
        }else{
            // $_SESSION['customer_id'] = 0; // this will eliminate error
        }
    }
    function updatePassword(){
	 if($_POST['password'] == $_POST['repassword']){
      $data = array('password' => trim($_POST['password'])
                    );
	 
      $this->db->where('customer_id',id_clean($_POST['customerId']));
      $this->db->update('customer',$data);   
	 }
 
    }
    function updateCustomer(){
      $data = array('customer_first_name' => db_clean($_POST['customer_first_name'],25),
                    'customer_last_name' => db_clean($_POST['customer_last_name'],25),
                    'phone_number' => db_clean($_POST['phone_number'],15),
                    'email' => db_clean($_POST['email'],50),
                    'address' => db_clean($_POST['address'],50),
                    'company' => db_clean($_POST['company'],50),
                    'city' => db_clean($_POST['city'],25),
 		    'state' => db_clean($_POST['state'],25),
		    'country' => db_clean($_POST['country'],2),
                    'post_code' => db_clean($_POST['post_code'],10)
                //    'password' => db_clean(dohash($_POST['password']),16)
                    );
	  if(isset($_POST['password']) && !empty($_POST['password']))
	  {
		 $data['password']  =  $_POST['password'];
		}
      $this->db->where('customer_id',id_clean($_POST['customer_id']));
      $this->db->update('customer',$data);   
 
    }
 
    function deleteCustomer($id){
        $this->db->where('customer_id', id_clean($id));
        $this->db->delete('customer');
    }
 
    function checkOrphans($id){
        $data = array();
        $this->db->where('customer_id',id_clean($id));
        $Q = $this->db->get('omc_order');
        if ($Q->num_rows() > 0){
           foreach ($Q->result_array() as $key=>$row){
             $data[$key] = $row;
           }
        $Q->free_result();
        return $data;
        }
 
 }
 
    function changeCustomerStatus($id){
        // getting status
        $userinfo = array();
        $userinfo = $this->getUser($id);
        $status = $userinfo['status'];
        if($status =='active'){
            $data = array('status' => 'inactive');
            $this->db->where('id', id_clean($id));
            $this->db->update('customer', $data);
        }else{
            $data = array('status' => 'active');
            $this->db->where('id', id_clean($id));
            $this->db->update('omc_admin', $data);
    }
 }
 
	 function customerDetails($id)
	 {
	
		  $data = array();
		  $options = array('customer_id' => $id);
		  $Q = $this->db->getwhere('customer',$options,1);
		  if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		  }
		  $Q->free_result();
		  return  $data['customer_first_name']."&nbsp;".$data['customer_last_name'];
		
	 
	 }
 
  
	 function deleteUser($customer_id){
		$this->db->where('customer_id', id_clean($customer_id));
		$this->db->delete('customer');	
	 }
	
	function forgotUser($u){
		$this->db->select('customer_id,email');
		$this->db->where('email',db_clean($u,30));
		$this->db->limit(1); $data = "";
		$Q = $this->db->get('customer');
			if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }

      $Q->free_result();    
      return $data;  	
	}
	function updatePass($u,$pass){ 
      $data = array('password' => db_clean($pass,16));
	  $this->db->where('email',db_clean($u));
	  $this->db->update('customer',$data);	
	
	}
	
	function getCountry(){
     $data = array();
     $Q = $this->db->get('country');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();
     return $data;
    }
	
	function getCustomerArray($user)
	{
		$userinfo = array();
		if(!empty($user))
		{
			// billing information
			$userinfo['customer_first_name'] = $user['customer_first_name'];
			$userinfo['customer_last_name'] = $user['customer_last_name'];
			$userinfo['phone_number'] = $user['phone_number'];
			$userinfo['email'] = $user['email'];
			$userinfo['address'] = $user['address'];
			$userinfo['address2'] = $user['address2'];
			$userinfo['city'] = $user['city'];
			$userinfo['post_code'] = $user['post_code'];
			$userinfo['state'] = $user['state'];
			$userinfo['country'] = $user['country'];
			
			// shipping information
			$userinfo['customer_first_name_ship'] = $user['customer_first_name_ship'];
			$userinfo['customer_last_name_ship'] = $user['customer_last_name_ship'];
			$userinfo['phone_number_ship'] = $user['phone_number_ship'];
			$userinfo['address1_ship'] = $user['address1_ship'];
			$userinfo['address2_ship'] = $user['address2_ship'];
			$userinfo['city_ship'] = $user['city_ship'];
			$userinfo['post_code_ship'] = $user['post_code_ship'];
			$userinfo['state_ship'] = $user['state_ship'];
			$userinfo['country_ship'] = $user['country_ship'];			
			
		}else{
			
			// billing information
			$userinfo['customer_first_name'] = "";
			$userinfo['customer_last_name'] = "";
			$userinfo['phone_number'] = "";
			$userinfo['email'] = "";
			$userinfo['address'] = "";
			$userinfo['address2'] = "";
			$userinfo['city'] = "";
			$userinfo['post_code'] = "";
			$userinfo['state'] = "";
			$userinfo['country'] = "";
			
			// shipping information
			$userinfo['customer_first_name_ship'] = "";
			$userinfo['customer_last_name_ship'] = "";
			$userinfo['phone_number_ship'] = "";
			$userinfo['address1_ship'] = "";
			$userinfo['address2_ship'] = "";
			$userinfo['city_ship'] = "";
			$userinfo['post_code_ship'] = "";
			$userinfo['state_ship'] = "";
			$userinfo['country_ship'] = "";
			
		}
		return $userinfo;
	}
	
	//get count of total userlog
	function getTotalUserLog(){
     $data = array();
	 $this->db->orderby('id','desc');
     $Q = $this->db->get('user_log');
     if ($Q->num_rows() > 0){
       return $Q->num_rows();
     }else
	 {
	return 0;	 
	}
    }
	
	function getUserLog($fromLt,$per_page){
     $data = array();
	 $this->db->orderby('id','desc');
	 $this->db->limit($per_page,$fromLt);
     $Q = $this->db->get('user_log');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();
     return $data;
    }
	
	function getNewCustomers(){
	$data = array();
	$Q = $this->db->query('SELECT * FROM customer where customer_status = 0');
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}
	
	function allowuser($id)
	{
	  $data = array('customer_status' => '1');
      $this->db->where('customer_id',$id);
      $this->db->update('customer',$data);  
	
	
	
	
	}
function storeRequest()
	{
		
		     $data = array(
                    'name' => db_clean($_POST['name']),
                    'email' => db_clean($_POST['email']),
                    'message' => db_clean($_POST['message']),
					'phoneno' => db_clean($_POST['phoneno'])
					
     );
      $this->db->insert('user_request',$data);
	}
	
	
	function updateCustomerSt($id,$status)
	{
      $data = array('customer_status' => $status);
      $this->db->where('customer_id',$id);
      $this->db->update('customer',$data);  
	
	}
}
 
?>