<?php

class Welcome extends Controller {
  
  function  __construct(){
    parent::Controller();
    session_start();
    $this->load->library('form_validation');
	$this->load->library('validation');
	$this->load->helper('form');
	$this->load->helper('url');
	$this->load->helper('string');
    $this->output->enable_profiler(FALSE);
  }

  function index(){

	$data['title'] = "Welcome to Power Steering Kit Specialist";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$data['mainf'] = $this->MProducts->getMainFeature();
	$skip = $data['mainf']['id'];
	$data['sidef'] = $this->MProducts->getRandomProducts(3,$skip);
	$data['main'] = 'home';
	/**
	 * Addition for captcha
	 */
	
	$captcha_result = '';
	$data['cap_img'] = $this -> _make_captcha();
	/**
	 * End of captcha
	 */
    
	$this->load->vars($data);
	$this->load->view('home-template');
  }

  function test(){
    
	$data['title'] = "Welcome to Power Steering Kit Specialist";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$data['mainf'] = $this->MProducts->getMainFeature();
	$skip = $data['mainf']['id'];
	$data['sidef'] = $this->MProducts->getRandomProducts(3,$skip);
	$data['main'] = 'home';
	/**
	 * Addition for captcha
	 */
	
	$captcha_result = '';
	$data['cap_img'] = $this -> _make_captcha();
	/**
	 * End of captcha
	 */
    
	$this->load->vars($data);
	$this->load->view('home-template');
  }
function contact(){
    
	$data['title'] = "Contact us";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	
	$data['main'] = 'contact';
	/**
	 * Addition for captcha
	 */
	
	$captcha_result = '';
	$data['cap_img'] = $this -> _make_captcha();
	/**
	 * End of captcha
	 */
    
	$this->load->vars($data);
	$this->load->view('general-template');
  }

  function cat($id){
  	/**
         * $this->benchmark->mark('query_start');
         */
	$cat = $this->MCats->getCategory($id);
	/**
         * $id is the third(3) in URI which represents the ID and any variables that will be passed to the controller.
         */
	$this->benchmark->mark('query_end');
	if (!count($cat)){
		redirect('welcome/index','refresh');
	}
	$data['title'] = "Power Steering Kit Specialist | ". $cat['name'];
	
	if ($cat['parentid'] < 1){
		/**
                 * show children/other categories
                 */
		$data['listing'] = $this->MCats->getSubCategories($id);
		/**
                 *this will receive a series of array with id, name, shortdesc and thumbnail
		 *and store them in listing. See http://127.0.0.1/codeigniter_shopping/test1/cat/2
		 *Array ([0]=>array([id]=>14 [name]=>long-sleeve...))
                 */
		$data['level'] = 1;
	}else{
		/**
                 * show products
                 */
		$data['listing'] = $this->MProducts->getProductsByCategory($id);
		/**
                 * this will receive a series of product with array.id,name,shortdesc,thumbnail
                 */
		
		$data['level'] = 2;

	}
	$data['category'] = $cat;
	$data['main'] = 'category';
	/**
         * Since using < ?php $this- > load- > view($main);? >,This is the same as < ?php $this- > load- > view(category);? >
	 * this will load views/category.php
         */
	 
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');
 }



  function product($id){
    
	$product = $this->MProducts->getProduct($id);

	if (!count($product)){
		redirect('welcome/index','refresh');
	}

	$data['product'] = $product;
	$data['title'] = "Twinkel my net | ". $product['name'];
	$data['main'] = 'product';

	$data['navlist'] = $this->MCats->getCategoriesNav();
	$data['assigned_colors'] = $this->MProducts->getAssignedColors($id);

	$data['assigned_sizes'] = $this->MProducts->getAssignedSizes($id);
	$data['colors'] = $this->MColors->getActiveColors();

	$data['sizes'] = $this->MFonts->getActiveFonts();
	$this->load->vars($data);
	$this->load->view('template');
  }
  
  
   function giftVoucher($id = null){
   
   $id ="20";
	$product = $this->MProducts->getProduct($id);

	if (!count($product)){
		redirect('welcome/index','refresh');
	}

	$data['product'] = $product;
	$data['title'] = "Twinkel my net | ". $product['name'];
	$data['main'] = 'gift_voucher';

	$data['navlist'] = $this->MCats->getCategoriesNav();
	$data['assigned_colors'] = $this->MProducts->getAssignedColors($id);

	$data['assigned_sizes'] = $this->MProducts->getAssignedSizes($id);
	$data['colors'] = $this->MColors->getActiveColors();

	$data['sizes'] = $this->MSizes->getActiveSizes();
	$this->load->vars($data);
	$this->load->view('template');
  }

  function cart($productid=0){

	
	if ($productid > 0){
		/**
                 * $productid = $this->uri->segment(3);
                 */
				 
		$fullproduct = $this->MProducts->getProduct($productid);
		$this->MOrders->updateCart($productid,$fullproduct);
		redirect('welcome/product/'.$productid, 'refresh');
	
	}else{
		
		
		$data['title'] = "Twinkel my net | Shopping Cart";
		//var_export($_SESSION);
		if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
			$userDetails = array();
			//get user info
			if(isset($_SESSION['customer_id']) || !empty($_SESSION['customer_id'])){
				$userinfo = $this->MCustomers->getCustomer($_SESSION['customer_id']);
				$userDetails = $this->MCustomers->getCustomerArray($userinfo);
				$data['userinfo'] = $userDetails;
				
			}else{
				$userinfo ="";
				$userDetails = $this->MCustomers->getCustomerArray($userinfo);
				$data['userinfo'] = $userDetails;
				
				}
			
			$data['main'] = 'shoppingcart';
			// Since using < ?php $this- > load- > view($main);? >,
			// this is using views/shoppingcart.php
			$data['navlist'] = $this->MCats->getCategoriesNav();
			$this->load->vars($data);
			$this->load->view('checkout-template');	
		}else{
			$this->session->set_flashdata('subscribe_msg','You have no item yet!');
			redirect('welcome/index','refresh');
		}
	}
  }
  

	function giftcart($productid=0)
	{

		if ($productid > 0){
		/**
                 * $productid = $this->uri->segment(3);
                 */
		$fullproduct = $this->MProducts->getProduct($productid);
		$this->MOrders->updateGiftCart($productid,$fullproduct);
		redirect('welcome/giftVoucher/'.$productid, 'refresh');
	
	}else{
		$data['title'] = "Power Steering Kit Specialist | Shopping Cart";
		if (isset($_SESSION['cart'])){
			$data['main'] = 'shoppingcart';
			// Since using < ?php $this- > load- > view($main);? >,
			// this is using views/shoppingcart.php
			$data['navlist'] = $this->MCats->getCategoriesNav();
			$this->load->vars($data);
			$this->load->view('template');	
		}else{
			$this->session->set_flashdata('subscribe_msg','You have no item yet!');
			redirect('welcome/index','refresh');
		}
	}
	
	}


  function ajax_cart(){
   	$this->MOrders->updateCartAjax($this->input->post('ids'));
	
	
  
  }

  function ajax_cart_remove(){
   	$this->MOrders->removeLineItem($this->input->post('id'));
  }
  
  function removeItem($id){
   	$message = $this->MOrders->removeLineItem($id);
	$this->session->set_flashdata('message', $message);
		    	redirect('welcome/cart','refresh');
  }
  
  function checkout(){
  
   if (!isset($_SESSION['customer_id'])){
       			$this->session->set_flashdata('info', 'Please login/register to proceed checkout.');
		    	redirect('welcome/login','refresh');
            }
			

  	//$this->MOrders->verifyCart();
	$data['main'] = 'confirmorder';// this is using views/confirmaorder.php
	$data['title'] = "TwinkleMyNet | Order Confirmation";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');   	
  }
  
  function giftVoucherPurchase()
  {
  $secureCode = $this->input->post('secureCode'); 
 // $secureCode ="sf@3d55sd";
  $codeResult = $this->MOrders->secureCodeCheck($secureCode);
  if($codeResult == "-1")
  {
  echo "Gift certificate is not valid";
  }
  else{
		if($codeResult >$_SESSION['totalprice'])
		{
		$giftVoucherPrice = $_SESSION['totalprice'];
		}else{
		$giftVoucherPrice =  $_SESSION['totalprice'] - $codeResult;		
		}
		$_SESSION['giftVoucherPrice'] = $giftVoucherPrice;
		$_SESSION['giftVoucherCode'] = $secureCode;
		echo "Gift certificate processed successfully";
  
  }
  
  }
  
  function checktotalPrice()
  {

	if(isset($_SESSION['giftVoucherPrice']))  
	{
	$remain  = $_SESSION['totalprice'] - $_SESSION['giftVoucherPrice'];
	if($remain > 0)
	{
		echo  "0";
	}
	else{
		echo  "1";
		}
	}
	else{
		echo "1";
		}
  }
  
	function login(){
        if ($this->input->post('emailLogin')){
            $e = $this->input->post('emailLogin');
            $pw = $this->input->post('password');
            $this->MCustomers->verifyCustomer($e,$pw);
            if (isset($_SESSION['customer_id'])){
              
			   $this->session->set_flashdata('message', 'Logged in successfully');
		       redirect('welcome/cart','refresh');			  
            }
         $this->session->set_flashdata('message', 'Logged not successfully, Please check username/password.');
		 redirect('welcome/cart','refresh');	
        }
		

        $data['title'] = "Customer Login";
        $data['page'] = $this->config->item('backendpro_template_shop') . 'customerlogin';
		$data['title'] = "Power Steering Kit Specialist | Login";
		$data['main'] = 'cutomerlogin';
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
        $this->load->view('template');  
  }
  
  	function profile(){
			if ($this->input->post('email')){
  		$this->MCustomers->updateCustomer(); 
  		$this->session->set_flashdata('message','Customer updated');
  		redirect('welcome/profile','refresh');
  	}else{
         $data['title'] = "User Profile";
		$data['title'] = "Power Steering Kit Specialist | Profile";
		$data['main'] = 'profile';		
		$data['customer'] = $this->MCustomers->getCustomer($_SESSION['customer_id']);
		$data['orders'] = $this->MOrders->getCustomerOrder($_SESSION['customer_id']);
		$data['giftVoucher'] = $this->MOrders->getGiftByUser($_SESSION['customer_id']);
		
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
        $this->load->view('template');  
	}
  }  
  function paypalGateway()
  {
  
 //  	$this->MOrders->verifyCart();
	$this->MOrders->submitOrder();
	
	$data['main'] = 'paypal';// this is using views/confirmaorder.php
	$data['title'] = "Power Steering Kit Specialist | Order Confirmation";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');   
  
  }
  
  
  function registration(){
    /* If you are using recaptcha, don't forget to configure modules/recaptcha/config/recaptcha.php
     * Add your own key
     * */
        $captcha_result = '';
        $data['cap_img'] =  $this -> _make_captcha();
 
    if ($this->input->post('email')){
 
        $data['title'] = "Registration";
 
        // set rules
        $rules['email'] = 'trim|required|matches[emailconf]|valid_email';
        $rules['emailconf'] = 'trim|required|valid_email';
        $rules['password'] = 'trim|required';
        $rules['customer_first_name'] = 'trim|required|min_length[3]|max_length[20]';
        $rules['customer_last_name'] = 'trim|required|min_length[3]|max_length[20]';
        $rules['phone_number'] = 'trim|required|min_length[8]|max_length[12]|numeric';
        $rules['address'] = 'trim|required';
        $rules['city'] = 'trim|required|alpha';
        $rules['post_code'] = 'trim|required|numeric';
        // if you want to use recaptcha, set modules/recaptcha/config and uncomment the following
        $rules['recaptcha_response_field'] = 'trim|required|valid_captcha';
 
        $this->form_validation->set_rules($rules);
 
        // set fields. This will be used for error messages
        // for example instead of customer_first_name, First Name will be used in errors
 


        // run validation
        if ($this->form_validation->run() == FALSE)
            {
                // if false outputs errors
                $this->validation->output_errors();
                // and take them to registration page to show errors
             	$data['main'] = 'registration';
                $data['module'] = lang('webshop_folder');
                $data['navlist'] = $this->MCats->getCategoriesNav();
				$this->load->vars($data);
				$this->load->view('template');  
            }
            else
            {
                $e = $this->input->post('email');
				
                // otherwise check if the customer's email is in the database
                $numrow = $this->MCustomers->checkCustomer($e);
                if ($numrow == TRUE){
                    // you have registered before, set the message and redirect to login page.
                 $this->session->set_flashdata('error', 'user already exists!!!');
		      	 redirect('welcome/login','refresh');	
                }

            // a customer is new, so create the new customer, set message and redirect to login page.
            $this->MCustomers->addCustomer();
			if(empty($_SESSION['cart']))
			{
						 $this->session->set_flashdata('message', 'user registration succssful');
						   redirect('welcome/registration','refresh');
				
			}
			 $this->session->set_flashdata('message', 'user registration succssful');
		       redirect('welcome/cart','refresh');
		
            
            }
    }// end of if($this->input->post('email'))
 
    $data['title'] =  "Registration";
    $data['page'] = $this->config->item('backendpro_template_shop') . 'registration';
	$data['main'] = 'registration';
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
    $this->load->view('template');  
 
 
 
  }
  
  function logout(){
        // this would remove all the variable in the session
        session_unset();
 
        //destroy the session
        session_destroy();
 
        redirect('welcome/index','refresh');
     }
  
  function search(){
  	/**
	 * form in views/header.php point to this search
	 * form_open("welcome/search");
	 * This will look in name, shortdesc and longdesc
	 *
	 */
	if ($this->input->post('term')){
	  /**
	   * In CodeIgniter, the way to check for form input is to use the $this - > input - > post() method
	   */
		$data['results'] = $this->MProducts->search($this->input->post('term'));
		/**
		 * This output id,name,shortdesc,thumbnail
		 */
	}else{
		redirect('welcome/index','refresh');
		/**
		 * if nothing in search form, then redirect to index
		 */
	}
	$data['main'] = 'search';// this is using views/search.php. Output will be displayed in views/search.php
	$data['title'] = "Power Steering Kit Specialist | Search Results";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');  
  }

  function verify(){
	if ($this->input->post('username')){
		$u = $this->input->post('username');
		$pw = $this->input->post('password');
		$this->MAdmins->verifyUser($u,$pw);
		if ($_SESSION['userid'] > 0){
			redirect('admin/dashboard','refresh');
		}
	}
	$data['main'] = 'login';// this is using views/login.php
	$data['title'] = "Power Steering Kit Specialist | Admin Login";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');  
  }


  function pages($path){
    $page = $this->MPages->getPagePath($path);
	$data['main'] = 'page';// this is using views/page.php
	$data['title'] = $page['name'];
	$data['page'] = $page;
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template'); 
  }

  
  
  function subscribe(){
    /**
	 * form_validation
	 */
	// var_export($_POST); 
	 
//	$this->form_validation->set_rules('name', 'Name', 'required');
//	$this->form_validation->set_rules('subscribe_email', 'Email', 'trim|required|valid_email');
//	$this->form_validation->set_rules('captcha', 'Captcha', 'required');
//	if ( $this -> _check_capthca() ) {
	
	
$flg =1;
  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$_POST['subscribe_email'])){
    list($username,$domain)=split('@',$_POST['subscribe_email']);
    
   $flg =0;
  }


	
        if ($flg)
		{
	
		    $this->session->set_flashdata('subscribe_msg', 'Invalid Email id . Please try again!');
		    redirect('welcome/contact');
		}
		else
		{
                 $result =  $this->MSubscribers->createSubscriber();
			if($result)
		{
		    $this->session->set_flashdata('subscribe_msg', 'Thanks for subscribing!');
		}else{
			$this->session->set_flashdata('subscribe_msg', 'You have already registerd!!!');
	       }

		    redirect('welcome/contact','refresh');
		}
 //     }else {
//        $this->session->set_flashdata('subscribe_msg', 'Enter captcha . Please try again!');
//	redirect('welcome/index');
 //     }

  }
  

  function unsubscribe($id){
	//$id = $this->uri->segment(3);
	$this->MSubscribers->removeSubscriber($id);
	$this->session->set_flashdata('subscribe_msg','You have been unsubscribed!');
	redirect('welcome/index','refresh');
  }
  
  function processOrder1()
  {
  session_destroy();
  }
  function processOrder()  
  {  
  //session_destroy();
  //die();
   
  if(!empty($_SESSION['cart'])){
  if (isset($_SESSION['customer_id'])){
  $this->MOrders->submitOrder();
  }else{   
  $e =$this->input->post('email');
   $numrow = $this->MCustomers->checkCustomer($e);
	if ($numrow == TRUE){
	// you have registered before, set the message and redirect to login page.
	$this->session->set_flashdata('error', 'user already exists!!!');
	redirect('welcome/login','refresh');	
	}
   $userID = $this->MCustomers->addCustomerShip();
   $this->MCustomers->makeSession($userID);
    // var_export($_SESSION);
    // die();
   $this->MOrders->submitOrder();  
  }
 $data = array();
 
 
 if($_SESSION['totalprice'] > 0){
  $purchase = $this->Payments->Do_direct_payment_demo();
  
  }
  else{
 $purchase['PayPalResult']['ACK'] ="success";
  }

  $this->MOrders->updateOrderStatus($purchase);
  if(isset($purchase['PayPalResult']['ACK']) && strtoupper($purchase['PayPalResult']['ACK']) == 'SUCCESS'){
  $this->MOrders->updatePaymentStatus($purchase['PayPalResult']['ACK']);
  $this->MOrders->voucherMail();
  $this->MOrders->purchaseMail(); 
  $data['paymentStatus']= "Transaction successful. Thanks for your purchase." ;
  } else{
	 $data['paymentStatus']= "Transaction falied. Please try again." ; 
	 }
	$_SESSION['purchase'] = $purchase;
   	$data['main'] = 'orderProcess';// this is using views/login.php
	$data['title'] = "Power Steering Kit Specialist";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	
	

	$this->load->vars($data);
	$this->load->view('template'); 
 //$this->session->set_flashdata('subscribe_msg', 'Thanks for purchase!');
 //redirect('welcome/orderProcess');
  
  }
  else{
	  //$this->session->set_flashdata('subscribe_msg', 'Thanks for purchase!');
 	redirect('welcome/cart');
 
	  
	  }
  }
  function orderProcess()
  {
  
  
  	$data['main'] = 'orderProcess';// this is using views/login.php
	$data['title'] = "Power Steering Kit Specialist";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');  
  }
  
function message(){
    /**
	 * form_validation
	 */
	$this->form_validation->set_rules('name', 'Name', 'required');
	$this->form_validation->set_rules('email', 'Email',  'required|valid_email');
	$this->form_validation->set_rules('message', 'Message', 'required');
	$this->form_validation->set_rules('captcha', 'Captcha', 'required');
	if ( $this -> _check_capthca() ) {
        if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('subscribe_msg', 'All fields are required . Please try again!');
		    redirect('welcome/contact');
		}
		else
		{
		    // you need to send email
		    // validation has passed. Now send the email
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
			$myemail = 'okada.shin@gmail.com';
			$this->load->library('email');
			$this->email->set_newline("\r\n");

			$this->email->from($email.$name);
			$this->email->to($myemail);		
			$this->email->subject('Email message form codeigniter shopping copy 2');		
			$this->email->message("sender: ". $name."<br />Sender email: ". $email. "<br />Message: " . $message);
			$this->email->send();
			
		    $this->session->set_flashdata('subscribe_msg', 'Thanks for your message!');
		    redirect('welcome/contact');
		}
      }else {
        $this->session->set_flashdata('subscribe_msg', 'If you are human, please input six letters or numbers. Please try again!');
	redirect('welcome/contact');
      }

	
  	
  }  
  /**
   * For captcha
   *
   */
   function _make_captcha()
  {
    $this -> load -> plugin( 'captcha' );
    $vals = array(
      'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
      'img_url' => 'captcha/', // URL for captcha img
      'img_width' => 200, // width
      'img_height' => 60, // height
      'font_path'     => './system/fonts/elephant.ttf',
      'expiration' => 7200 , 
      ); 
    // Create captcha
    $cap = create_captcha( $vals ); 
    // Write to DB
    if ( $cap ) {
      $data = array(
        
        'captcha_time' => $cap['time'],
        'ip_address' => $this -> input -> ip_address(),
        'word' => $cap['word'] , 
        );
      $query = $this -> db -> insert_string( 'captcha', $data );
      $this -> db -> query( $query );
    }else {
      return "Umm captcha not work" ;
    }
    return $cap['image'] ;
  }

  function _check_capthca()
  { 
    // Delete old data ( 2hours)
    $expiration = time()-7200 ;
    $sql = " DELETE FROM captcha WHERE captcha_time < ? ";
    $binds = array($expiration);
    $query = $this->db->query($sql, $binds);
    
    //checking input
    $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
    $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
    $query = $this->db->query($sql, $binds);
    $row = $query->row();

  if ( $row -> count > 0 )
    {
      return true;
    }
    return false;

  }
  
function shop()
{
    $data['title'] = "Shop";
	$data['navlist'] = $this->MCats->getCategoriesNav();	
	$data['main'] = 'shop';    
	$this->load->vars($data);
	$this->load->view('template');
}  
  
 function customer_care()
 {
 
     $data['title'] = "Customer care";
	
	$data['main'] = 'customer_care';    
	$this->load->vars($data);
	$this->load->view('general-template');

 }
 
  function website_info()
 {
 
     $data['title'] = "Website Information";
	
	$data['main'] = 'website_info';    
	$this->load->vars($data);
	$this->load->view('template_pages');

 }
 
   function company_info()
 {
 
    $data['title'] = "Company info";	
	$data['main'] = 'company_info';    
	$this->load->vars($data);
	$this->load->view('general-template');

 }
 
 function photo_gallery()
 {
 	$data['title'] = "photo gallery";	
	$data['main'] = 'photo_gallery';   
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('no-sidebar-template');
 
 
 }
 
 function twinkle_gives_back()
 {

    $data['title'] = "Twinkle gives back";	
	$data['main'] = 'twinkle_gives_back';    
	$this->load->vars($data);
	$this->load->view('general-template');
 }
 
 function about_us()
 {

    $data['title'] = "About Us";	
	$data['main'] = 'about_us';    
	$this->load->vars($data);
	$this->load->view('general-template');
 }
 
 function forgotPassword(){
			if ($this->input->post('email')){
			$u = $this->input->post('email');

                       	$check = $this->MCustomers->forgotUser($u);
			if (!empty($check)){
			// $user = $this->MAdmins->getUser($u);
			$this->load->library('email');
			$this->load->helper('string');
			
			$newpass = random_string('alnum', 8);
			$this->MCustomers->updatePass($check['email'],$newpass);
			$check['email'];
			$this->email->set_mailtype("html");
			$this->email->from($this->config->item('site_admin_email'), 'Site Administrator');
			$this->email->to($check['email']);
			$this->email->subject('Forgot Password');
			$this->email->message('Hi,<br/><br/> As per your request below is your new password for Power Steering Kit Specialist<br/>Password:'.$newpass.'<br/> Thanks,<br/><br/>Administrator,<br/>Power Steering Kit Specialist');
			$this->email->send();
			
			$this->session->set_flashdata('error', 'Message send successfully!!!');
			redirect('welcome/forgotPassword','refresh');
			}else{		
			$this->session->set_flashdata('error', 'No such user exists');
			redirect('welcome/forgotPassword');
			}
			}
			$data['main'] = 'forgotPassword';// this is using views/login.php
			$data['title'] = "Power Steering Kit Specialist | Forgot password";
			$data['navlist'] = $this->MCats->getCategoriesNav();
			$this->load->vars($data);
			$this->load->view('template');
  }
 
	 function updateOrder()
	 {
		$this->MOrders->updateProductQuantity();
	
			redirect('welcome/cart');
			
	 }
 
  /**
   * End of captcha
   */
}//end controller class

?>