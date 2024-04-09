<?php

class Pages extends Controller
{

    function __construct()
    {
        parent::Controller();
        session_start();

        $this->load->library('form_validation');
        $this->load->library('validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->output->enable_profiler(FALSE);
        $this->load->library('pagination');
        $this->load->helper('thumbnailer');
        $this->load->model('general');

    }

    function index()
    {

        //echo 'asaa'; die;
        if (isset($_SESSION['customer_id'])) {
            $id = $_SESSION['customer_id'];
            $result = $this->MAdmins->getUser($id);
            if (count($result) > 0) {
                $data['flag'] = 1;
            } else {
                $data['flag'] = 0;
            }
        } else {
            $data['flag'] = 0;
        }
        $data['title'] = "Welcome to Power Steering Kit Specialist";

        $data['main'] = 'home';
        $captcha_result = '';
        $data['cap_img'] = $this->_make_captcha();

        $data['default_model_car'] = $this->general->getModelRecord();

        $this->load->vars($data);

        $this->load->view('home-template', $data);
    }

    public function send()
    {
        try {
            $this->load->library('email');
            $this->email->from('noreply@powersteeringkits.net');
            $this->email->to('vikinaleb@gmail.com');
            /*$this->email->bcc('them@their-example.com');*/
            $this->email->subject('Test Email Subject');
            $this->email->message('Email contient');
            if ($this->email->send()) {
                echo 'Message sent';
            } else {
                echo 'Message not sent';
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    function view($path)
    {
        $page = $this->MPages->getPagePath($path);
        $data['main'] = 'page';// this is using views/page.php
        $data['title'] = $page['name'] . " - " . $this->config->item('site_title');
        $data['page'] = $page;
        $this->load->vars($data);

        $cond = array('status' => 1);
        $data['records'] = $this->general->getRecord('videos', $cond);

        $this->load->view('template', $data);
    }

    function promotions()
    {
        $data['main'] = 'promotions';// this is using views/page.php
        $data['title'] = "promotions - " . $this->config->item('site_title');
        $data['years'] = $this->MNews->getAllAdvertiseYear();
        $this->load->vars($data);
        $this->load->view('template');
    }

    function contact()
    {

        $data['title'] = "Contact us" . " - " . $this->config->item('site_title');
        $data['main'] = 'contact';
        /**
         * Addition for captcha
         */

        $captcha_result = '';
        $data['cap_img'] = $this->_make_captcha();
        /**
         * End of captcha
         */

        $this->load->vars($data);
        $this->load->view('template');
        //$this->load->view('contact');
    }

    function faq()
    {

        $data['title'] = "FAQ" . " - " . $this->config->item('site_title');
        $data['faqlist'] = $this->MFaq->getActiveFaq();
        $data['main'] = 'faq';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function news()
    {
        $data['title'] = "News " . " - " . $this->config->item('site_title');
        $data['newsList'] = $this->MNews->getAllNews();

        $data['main'] = 'news';

        $this->load->vars($data);
        $this->load->view('template');
    }

    function testimonial()
    {

        $data['title'] = "Testimonial " . " - " . $this->config->item('site_title');
        $data['testimonialList'] = $this->MNews->getAllTestimonial();

        $data['main'] = 'testimonial';

        $this->load->vars($data);
        $this->load->view('template');
    }

    function login()
    {
        if (isset($_SESSION['customer_id'])) {
            redirect('pages/index', 'refresh');
        }
        if ($this->input->post('emailLogin')) {
            $e = $this->input->post('emailLogin');
            $pw = $this->input->post('password');
            $this->MCustomers->verifyCustomer($e, $pw);
            if (isset($_SESSION['customer_id'])) {

                $this->session->set_flashdata('message', 'Logged in successfully');
                redirect('pages/cart', 'refresh');
            }
            $this->session->set_flashdata('message', 'Logged not successfully, Please check Email / Password.');
            redirect('pages/cart', 'refresh');
        }


        $data['title'] = "Customer Login" . " - " . $this->config->item('site_title');
        $data['page'] = $this->config->item('backendpro_template_shop') . 'customerlogin';
        $data['title'] = "Power Steering Kit Specialist | Login";
        $data['main'] = 'cutomerlogin';

        $this->load->vars($data);
        $this->load->view('template');
    }

    function loginCheck()
    {
        if ($this->input->post('emailLogin')) {
            $e = $this->input->post('emailLogin');
            $pw = $this->input->post('password');
            $this->MCustomers->verifyCustomer($e, $pw);
            if (isset($_SESSION['customer_id'])) {
                if (isset($_SESSION['temp_product']) && !empty($_SESSION['temp_product'])) {
                    redirect('pages/product/' . $_SESSION['temp_product'], 'refresh');
                }
                $this->session->set_flashdata('message', 'Logged in successfully');
                redirect('pages/profile', 'refresh');
            }
            $this->session->set_flashdata('message', 'Logged not successfully, Please check Email / Password.');
            redirect('pages/login', 'refresh');
        }


        $data['title'] = "Customer Login" . " - " . $this->config->item('site_title');
        $data['page'] = $this->config->item('backendpro_template_shop') . 'customerlogin';
        $data['title'] = "Power Steering Kit Specialist | Login";
        $data['main'] = 'cutomerlogin';

        $this->load->vars($data);
        $this->load->view('template');
    }

    function profile()
    {
        if (!isset($_SESSION['customer_id'])) {
            redirect('pages/index', 'refresh');
        }
        if ($this->input->post('email')) {
            $this->MCustomers->updateCustomer();
            $this->session->set_flashdata('message', 'Customer updated');
            redirect('welcome/profile', 'refresh');
        } else {
            $data['title'] = "User Profile" . " - " . $this->config->item('site_title');
            $data['title'] = "Power Steering Kit Specialist | Profile";
            $data['main'] = 'profile';
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['customer_id']);
            $data['orders'] = $this->MOrders->getCustomerOrder($_SESSION['customer_id']);


            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function changePassword()
    {
        if ($this->input->post('email')) {
            $this->MCustomers->updateCustomer();
            $this->session->set_flashdata('message', 'Customer updated');
            redirect('welcome/profile', 'refresh');
        } else {
            $data['title'] = "User Profile" . " - " . $this->config->item('site_title');
            $data['title'] = "Power Steering Kit Specialist | Profile";
            $data['main'] = 'profile';
            $data['customer'] = $this->MCustomers->getCustomer($_SESSION['customer_id']);
            $data['orders'] = $this->MOrders->getCustomerOrder($_SESSION['customer_id']);


            $this->load->vars($data);
            $this->load->view('template');
        }
    }


    function registration()
    {
        /* If you are using recaptcha, don't forget to configure modules/recaptcha/config/recaptcha.php
         * Add your own key
         * */
        $captcha_result = '';
        $data['cap_img'] = $this->_make_captcha();

        if ($this->input->post('email')) {

            $data['title'] = "Registration" . " - " . $this->config->item('site_title');

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
            $rules['captcha'] = 'trim|required|alpha';

            // if you want to use recaptcha, set modules/recaptcha/config and uncomment the following
            $rules['recaptcha_response_field'] = 'trim|required|valid_captcha';

            $this->form_validation->set_rules($rules);

            // set fields. This will be used for error messages
            // for example instead of customer_first_name, First Name will be used in errors


            if ($this->_check_capthca()) {
                // run validation
                if ($this->form_validation->run() == FALSE) {
                    // if false outputs errors
                    $this->validation->output_errors();
                    // and take them to registration page to show errors
                    $data['main'] = 'registration';
                    $data['module'] = lang('webshop_folder');
                    $data['navlist'] = $this->MCats->getCategoriesNav();
                    $this->load->vars($data);
                    $this->load->view('template');
                } else {
                    $e = $this->input->post('email');

                    // otherwise check if the customer's email is in the database
                    $numrow = $this->MCustomers->checkCustomer($e);
                    if ($numrow == TRUE) {
                        // you have registered before, set the message and redirect to login page.
                        $this->session->set_flashdata('error', 'user already exists!!!');
                        redirect('welcome/login', 'refresh');
                    }

                    // a customer is new, so create the new customer, set message and redirect to login page.
                    $this->MCustomers->addCustomer();

                    /* if(empty($_SESSION['cart']))
                    { */

                    $this->session->set_flashdata('message', 'Request registered sucessfully!!! We will inform you once Administrator verify details.');
                    redirect('welcome/registration', 'refresh');

                    //}
                    $this->session->set_flashdata('message', 'user registration succssful');
                    redirect('welcome/cart', 'refresh');


                }
            } else {
                //$this->session->set_flashdata('message', 'If you are human, please input correct captcha code. Please try again!');
                //redirect('pages/registration');
                $data['messageShow'] = 'If you are human, please input correct captcha code. Please try again!';
            }
        }// end of if($this->input->post('email'))

        $data['title'] = "Registration" . " - " . $this->config->item('site_title');
        $data['page'] = $this->config->item('backendpro_template_shop') . 'registration';
        $data['main'] = 'registration';
        $data['navlist'] = $this->MCats->getCategoriesNav();
        $this->load->vars($data);
        $this->load->view('template');


    }

    function logout()
    {
        // this would remove all the variable in the session
        session_unset();

        //destroy the session
        session_destroy();

        redirect('welcome/index', 'refresh');
    }


    function subscribe($email)
    {
        if (empty($email)) {
            echo 'All fields are required . Please try again!';

        } else {
            $chk = $this->MSubscribers->createSubscriberAjax($email);
            if ($chk == 1) {
                echo "<span class='popMsg'>Thanks for subscribing!</span>";
            } else {
                echo "<span class='popErroeMsg'>You have already registered!</span>";
            }
        }
    }


    function subscribe1()
    {
        /**
         * form_validation
         */
        // var_export($_POST);

//	$this->form_validation->set_rules('name', 'Name', 'required');
//	$this->form_validation->set_rules('subscribe_email', 'Email', 'trim|required|valid_email');
//	$this->form_validation->set_rules('captcha', 'Captcha', 'required');
//	if ( $this -> _check_capthca() ) {


        $flg = 1;
        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['subscribe_email'])) {
            list($username, $domain) = split('@', $_POST['subscribe_email']);

            $flg = 0;
        }


        if ($flg) {

            $this->session->set_flashdata('subscribe_msg', 'Invalid Email id . Please try again!');
            redirect('welcome/contact');
        } else {

            $result = $this->MSubscribers->createSubscriber();
            if ($result) {
                $this->session->set_flashdata('subscribe_msg', '<span class="popMsg">Thanks for subscribing!</span>');
            } else {
                $this->session->set_flashdata('subscribe_msg', '<span class="popErroeMsg">You have already registered!</span>');
            }
            redirect('welcome/contact', 'refresh');
        }
        //     }else {
//        $this->session->set_flashdata('subscribe_msg', 'Enter captcha . Please try again!');
//	redirect('welcome/index');
        //     }

    }


    function unsubscribe($id)
    {
        //$id = $this->uri->segment(3);
        $this->MSubscribers->removeSubscriber($id);
        $this->session->set_flashdata('subscribe_msg', 'You have been unsubscribed!');
        redirect('welcome/index', 'refresh');
    }

    function processOrder1()
    {
        session_destroy();
    }

    function processOrder()
    {
        //session_destroy();
        die();
        if (!empty($_SESSION['cart'])) {
            if (isset($_SESSION['customer_id'])) {
                $this->MOrders->submitOrder();
            } else {
                $e = $this->input->post('email');
                $numrow = $this->MCustomers->checkCustomer($e);
                if ($numrow == TRUE) {
                    // you have registered before, set the message and redirect to login page.
                    $this->session->set_flashdata('error', 'user already exists!!!');
                    redirect('welcome/login', 'refresh');
                }
                $userID = $this->MCustomers->addCustomerShip();
                $this->MCustomers->makeSession($userID);
                // var_export($_SESSION);
                // die();
                $this->MOrders->submitOrder();
            }
            $data = array();


            if ($_SESSION['totalprice'] > 0) {

                $purchase = $this->Payments->Do_direct_payment_demo();

            } else {
                $purchase['PayPalResult']['ACK'] = "success";
            }

            $this->MOrders->updateOrderStatus($purchase);
            if (isset($purchase['PayPalResult']['ACK']) && strtoupper($purchase['PayPalResult']['ACK']) == 'SUCCESS') {

                // update gift voucher remains
                if (isset($_SESSION['giftVoucherPrice']) && !empty($_SESSION['giftVoucherPrice'])) {
                    $this->MOrders->updateGiftVoucher();
                }
                $this->MOrders->updatePaymentStatus($purchase['PayPalResult']['ACK']);
                $this->MOrders->voucherMail();
                $this->MOrders->purchaseMail();
                $data['paymentStatus'] = "Transaction successful. Thanks for your purchase.";
            } else {
                $data['paymentStatus'] = "Transaction failed. Please try again.";
            }
            $_SESSION['purchase'] = $purchase;
            $data['main'] = 'orderProcess';// this is using views/login.php
            $data['title'] = "Power Steering Kit Specialist";

            //var_export($purchase);


            $this->load->vars($data);
            $this->load->view('template');
            //$this->session->set_flashdata('subscribe_msg', 'Thanks for purchase!');
            //redirect('welcome/orderProcess');

        } else {
            //$this->session->set_flashdata('subscribe_msg', 'Thanks for purchase!');
            redirect('welcome/cart');


        }
    }

    /**
     * For captcha
     *
     */
    function _make_captcha()
    {
        $this->load->plugin('captcha');
        $vals = array(
            'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
            'img_url' => 'captcha/', // URL for captcha img
            'img_width' => 200, // width
            'img_height' => 60, // height
            'font_path' => './system/fonts/elephant.ttf',
            'expiration' => 7200,
        );
        // Create captcha
        $cap = create_captcha($vals);
        // Write to DB
        if ($cap) {
            $data = array(

                'captcha_time' => $cap['time'],
                'ip_address' => $this->input->ip_address(),
                'word' => $cap['word'],
            );
            $query = $this->db->insert_string('captcha', $data);
            $this->db->query($query);
        } else {
            return "Umm captcha not work";
        }
        return $cap['image'];
    }

    function _check_capthca()
    {
        // Delete old data ( 2hours)
        $expiration = time() - 7200;
        $sql = " DELETE FROM captcha WHERE captcha_time < ? ";
        $binds = array($expiration);
        $query = $this->db->query($sql, $binds);

        //checking input
        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count > 0) {
            return true;
        }
        return false;

    }


    function customer_care()
    {

        $data['title'] = "Customer care" . " - " . $this->config->item('site_title');

        $data['main'] = 'customer_care';
        $this->load->vars($data);
        $this->load->view('general-template');

    }

    function website_info()
    {

        $data['title'] = "Website Information" . " - " . $this->config->item('site_title');

        $data['main'] = 'website_info';
        $this->load->vars($data);
        $this->load->view('template_pages');

    }

    function company_info()
    {

        $data['title'] = "Company info" . " - " . $this->config->item('site_title');
        $data['main'] = 'company_info';
        $this->load->vars($data);
        $this->load->view('general-template');

    }


    function about_us()
    {

        $data['title'] = "About Us" . " - " . $this->config->item('site_title');
        $data['main'] = 'about_us';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function forgotPassword()
    {
        if ($this->input->post('email')) {
            $u = $this->input->post('email');

            if (empty($u)) {
                $this->session->set_flashdata('error', 'No such user exists');
                redirect('welcome/forgotPassword');
            }
            $check = $this->MCustomers->forgotUser($u);
            if (!empty($check)) {
                // $user = $this->MAdmins->getUser($u);
                $this->load->library('email');
                $this->load->helper('string');
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['smtp_host'] = 'relay-hosting.secureserver.net';
                $config['protocol'] = 'sendmail';
                $this->email->initialize($config);
                $newpass = random_string('alnum', 8);
                $this->MCustomers->updatePass($check['email'], $newpass);
                $check['email'];
                $this->email->set_mailtype("html");
                $this->email->from($this->config->item('site_admin_email'), 'Site Administrator');
                $this->email->to($check['email']);
                $this->email->subject('Forgot Password');
                $this->email->message('Hi,<br/><br/> As per your request below is your new password for Power Steering Kit Specialist<br/>Password:' . $newpass . '<br/><br/> Thanks,<br/>Administrator,<br/>Power Steering Kit Specialist');
                $this->email->send();

                $this->session->set_flashdata('error', 'Message send successfully!!!');
                redirect('welcome/forgotPassword', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No such user exists');
                redirect('welcome/forgotPassword');
            }
        }
        $data['main'] = 'forgotPassword';// this is using views/login.php
        $data['title'] = "Power Steering Kit Specialist | Forgot password";

        $this->load->vars($data);
        $this->load->view('template');
    }

    function updateOrder()
    {
        $this->MOrders->updateProductQuantity();

        redirect('welcome/cart');

    }

    function filterProduct()
    {
        $searchType = $this->uri->segment(3);
        if (empty($searchType)) {
            $searchType = "make";
            $_SESSION['make'] = "";
            $_SESSION['group'] = "";
            $_SESSION['model'] = "";
            $_SESSION['year'] = "";
        }
        $data['title'] = "Power Steering Kit Specialist | Forgot password";


        $data['maker'] = $this->MMaker->getAllMakers();
        $data['searchType'] = $searchType;
        if ($searchType == 'make') {
            $data['main'] = 'searchProduct';
        }
        if ($searchType == 'model') {
            $data['main'] = 'searchModel';
            $makeID = $this->uri->segment(4);
            $data['makeID'] = $makeID;
            $data['model'] = $this->MCarmodel->getModelByMaker($makeID);
        }
        if ($searchType == 'year') {
            $data['main'] = 'searchYear';
            $makeID = $this->uri->segment(4);
            if (empty($makeID)) {
                $_SESSION['model'] = "";
            }
            $data['makeID'] = $makeID;
            $data['year'] = $this->MCarmodel->getYearListByModel($makeID);
            //$data['group'] = $this->MCarmodel->getGroupListByModel($makeID);

        }
        if ($searchType == 'group') {
            $data['main'] = 'searchGroup';
            $makeID = $this->uri->segment(4);

            $data['makeID'] = $makeID;
            //$data['model'] = $this->MCarmodel->getYearListByModel($makeID);
            $data['group'] = $this->MCarmodel->getGroupListByYear($makeID);

        }
        $this->load->vars($data);
        $this->load->view('simple-template');
    }

    function saveSearch()
    {
        $searchType = $this->uri->segment(3);
        $searchId = $this->uri->segment(4);
        $_SESSION[$searchType] = $searchId;
    }


    function setYear()
    {

        $this->MCarmodel->setYear();
    }

    function getModelByMakeId()
    {
        $make_id = $this->input->post('make');
        $records = $this->general->getModelByMakeId($make_id);
        if (!empty($records)) {
            echo '<option value="">Select Model</option>';
            foreach ($records as $record) {
                echo '
                    <option value="' . $record->id . '">' . $record->title . '</option>
                ';
            }
        } else {
            echo '
                <option>No Medel</option>
            ';
        }
    }

    function searchProduct()
    {

        $per_page = 20;
        $fromLt = $this->uri->segment(9);
        $pagination = 1;
        if (!empty($fromLt)) { //$fromLt = ($this->uri->segment(8)-1)*$per_page;
            $make = $this->uri->segment(3);
            $group = $this->uri->segment(4);
            $model = $this->uri->segment(5);
            $product = $this->uri->segment(6);
            $year = $this->uri->segment(7);
            $partno = $this->uri->segment(8);
            //die();
        } else {
            $fromLt = 0;
            if (isset($_POST['make']) && !empty($_POST['make'])) {
                $make = $_POST['make'];
            } else {
                $make = 0;
            }
            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $group = $_POST['group'];
            } else {
                $group = 0;
            }
            if (isset($_POST['model']) && !empty($_POST['model'])) {
                $model = $_POST['model'];
            } else {
                $model = 0;
            }
            if (isset($_POST['product']) && !empty($_POST['product'])) {
                $product = $_POST['model'];
            } else {
                $product = 0;
            }
            if (isset($_POST['year']) && !empty($_POST['year'])) {
                $year = $_POST['year'];
            } else {
                $year = 0;
            }
            if (isset($_POST['partno']) && !empty($_POST['partno'])) {
                $partno = $_POST['partno'];
            } else {
                $partno = 0;
            }
            //$product = $_POST['product'];
            //$year =  $_POST['year'];

            $_SESSION['make_quick'] = $make;
            $_SESSION['group_quick'] = $group;

        }
        $flg = 0;
        if (!empty($partno)) {
            $flg = 1;
        }
        if (!empty($make) || !empty($group)) {
            $flg = 1;
        }

        if ($flg == 0) {
            redirect('pages/index', 'refresh');
        }

        /* if(empty($make) || empty($group))
       {
           redirect('pages/index','refresh');
       } */
        $total = $this->MProducts->searchProductListCount($fromLt, $pagination = 2);


        $base_url = site_url('pages/searchProductPaginate/' . $make . '/' . $group . '/' . $model . '/' . $product . '/' . $year . '/' . $partno);
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = '9';


        $data['searchGroup'] = $group;

        $data['pagen'] = $this->pagination->initialize($config);
        $data['productList'] = $this->MProducts->searchProductList($fromLt, $per_page, $pagination = 2);
        $data['main'] = 'productList';// this is using views/login.php
        $data['title'] = "Power Steering Kit Specialist | Search";

        //var_export($data['productList']);
        $this->load->vars($data);
        $this->load->view('template');
    }

    function searchProductPaginate()
    {


        $per_page = 20;

        $fromLt = $this->uri->segment(9);

        if (empty($fromLt)) { //$fromLt = ($this->uri->segment(8)-1)*$per_page;
            $fromLt = 0;
            //die();
        }
        $make = $this->uri->segment(3);
        $group = $this->uri->segment(4);
        $model = $this->uri->segment(5);
        $product = $this->uri->segment(6);
        $year = $this->uri->segment(7);
        $partno = $this->uri->segment(8);

        $total = $this->MProducts->searchProductListCount($fromLt, $pagination = 1);

        $data['searchGroup'] = $group;
        $base_url = site_url('pages/searchProductPaginate/' . $make . '/' . $group . '/' . $model . '/' . $product . '/' . $year . '/' . $partno);
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = '9';


        $data['pagen'] = $this->pagination->initialize($config);
        $data['productList'] = $this->MProducts->searchProductList($fromLt, $per_page, $pagination = 1);
        $data['main'] = 'productList';// this is using views/login.php
        $data['title'] = "Power Steering Kit Specialist | Search Product";

        //var_export($data['productList']);
        $this->load->vars($data);
        $this->load->view('template');
    }

    function searchProductShow()
    {

        //var_export($_SESSION);
        //die();

        $data['main'] = 'productList';// this is using views/login.php
        $data['title'] = "Power Steering Kit Specialist | Search";
        //var_export($_SESSION);
        if (isset($_SESSION['make']) && isset($_SESSION['group'])) {
            $data['productList'] = $this->MProducts->searchProductListAjax();
            $data['searchGroup'] = $_SESSION['group'];
        } else {
            $data['productList'] = array();
        }
        //var_export($data['productList']);
        $this->load->vars($data);
        $this->load->view('template');
    }

    function getModelList($maker = 0)
    {

        $modelList = $this->MCarmodel->getModelByMaker($maker);
        $showModel = "<select name='model' id='model'>";
        $showModel .= "<option value=''>Select Model</option>";
        foreach ($modelList as $key => $value) {
            $showModel .= "<option value='" . $key . "'>" . $value . "</option>";
        }
        $showModel .= "</select>";
        echo $showModel;
    }

    function getModelListAdmin($maker = 0, $id)
    {

        $modelList = $this->MCarmodel->getModelByMaker($maker);
        $showModel = "<select name='model_" . $id . "' id='model_" . $id . "'>";
        $showModel .= "<option value=''>Select Model</option>";
        foreach ($modelList as $key => $value) {
            $showModel .= "<option value='" . $key . "'>" . $value . "</option>";
        }
        $showModel .= "</select>";
        echo $showModel;
    }

    function product($id)
    {

        $product = $this->MProducts->getProduct($id);

        if (!count($product)) {
            redirect('welcome/index', 'refresh');
        }
        if (!isset($_SESSION['customer_id'])) {
            $_SESSION['temp_product'] = $id;
            redirect('welcome/login', 'refresh');
        }
        $data['product'] = $product;
        $data['title'] = "Power Steering Kit Specialist | " . $product['name'];
        $data['main'] = 'product';


        $this->load->vars($data);
        $this->load->view('template');
    }


    function distributor()
    {
        $this->load->model('Mdistributors');

        $data['title'] = "Distributor list " . " - " . $this->config->item('site_title');
        $data['distributorList'] = $this->Mdistributors->getAllDistributors();
        $data['main'] = 'distributor-list';

        $this->load->vars($data);
        $this->load->view('template');
    }

    function message()
    {
        /**
         * form_validation
         */
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required');
        if ($this->_check_capthca()) {
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('subscribe_msg', 'All fields are required . Please try again!');
                redirect('welcome/contact');
            } else {
                // you need to send email
                // validation has passed. Now send the email
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $message = $this->input->post('message');
                $myemail = $this->config->item('site_admin_email');
                $this->load->library('email');
                $this->email->from($email);
                $this->email->to($myemail);

                //		    $config['charset'] = 'iso-8859-1';
//            $config['wordwrap'] = TRUE;
                // $config['smtp_host'] = 'relay-hosting.secureserver.net';
//            $config['protocol'] = 'sendmail';
//			$this->email->initialize($config);
//			$this->email->set_mailtype("html");
                //$this->email->set_newline("\r\n");
                // $this->email->from($myemail);
                // $this->email->to('vikinaleb@gmail.com');//$this->config->item('site_admin_email'));
                $this->email->subject('Contact us request');
                $this->email->message("Hi, Admin,<br/>  " . ucfirst($name) . " send a contact us request. Please check below for more details.<br />Name: " . $name . "<br />Email: " . $email . "<br />Message: " . $message . "<br /><br />");
                $this->email->send();
                $this->email->clear();

                $this->session->set_flashdata('subscribe_msg', 'Thanks for your message!!! <br/> Admin will get back to you soon....');
                redirect('pages/contact');
            }
        } else {
            $this->session->set_flashdata('subscribe_msg', 'If you are human, please input six letters or numbers. Please try again!');
            redirect('pages/contact');
        }


    }

// function to receive request from user for what they looking for
    public function requestProductDetails()
    {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');
        $productName = $this->input->post('message');
        $productid = $this->input->post('productid');


        if (!empty($email) && !empty($message)) {
            $this->MCustomers->storeRequest();
        }
        $myemail = $this->config->item('site_admin_email');
        $this->load->library('email');
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from($this->config->item('site_admin_email'), $this->config->item('site_title'));
        $this->email->to($myemail);
        $this->email->subject('Contact us request');
        $this->email->message("Hi, Admin,<br/>  " . ucfirst($name) . " send a product search request. Please check below for more details.
															   <br />Name: " . $name . "<br />Email: " . $email . "<br />Product: " . $productName . "<br />Message: " . $message . "<br /><br />");
        $this->email->send();
        $this->email->clear();

        // send email to user
        $myemail = $email;

        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from($email . $name);
        $this->email->to($myemail);
        $this->email->subject('Contact us request');
        $this->email->message("Hi " . ucfirst($name) . ",  Thank you for request.<br /> we will provide you requested information ASAP.<br/> <br/> Thanks,
												 Administator, Power Steering Kit Specialist");
        $this->email->send();
        $this->email->clear();

        $this->session->set_flashdata('subscribe_msg', 'Thanks for your request. Our Representative contact you soon!');
        redirect('pages/product/' . $productid);
        exit();

    }

    // function to receive request from user for what they looking for
    public function contactRequest()
    {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');


        if (!empty($email) && !empty($message)) {
            $this->MCustomers->storeRequest();
        }
        $myemail = $this->config->item('site_admin_email');
        $this->load->library('email');
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_host'] = 'relay-hosting.secureserver.net';
        $config['protocol'] = 'sendmail';
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from($email);
        $this->email->to($myemail);
        $this->email->subject('Contact us request');
        $this->email->message("Hi, Admin,<br/>  " . ucfirst($name) . " send a product search request. Please check below for more details.
															   <br />Name: " . $name . "<br />Email: " . $email . "<br />Message: " . $message . "<br /><br />");
        $this->email->send();
        $this->email->clear();

// send email to user
        $myemail = $email;

        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['protocol'] = 'sendmail';
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from($this->config->item('site_admin_email'));
        $this->email->to($myemail);
        $this->email->subject('Contact us request');
        $this->email->message("Hi " . ucfirst($name) . ",  Thank you for request.<br/> we will provide you requested information ASAP.<br/> <br/> Thanks, <br/> Administrator, <br/> Power Steering Kit Specialist");
        $this->email->send();
        $this->email->clear();

        $this->session->set_flashdata('subscribe_msg', 'Thanks for your message!');
        redirect('pages/contact');
        exit();

    }

    function getQuickSearchProductList()
    {

        $make = $this->uri->segment(3);
        $group = $this->uri->segment(4);
        $year = $this->uri->segment(5);
        $year = 0;
        $productList = $this->MProducts->quickSearchProductList($make, $group, $year);

        $showProduct = "<select name='product' id='product'>";
        $showProduct .= "<option value=''>Select Product</option>";
        foreach ($productList as $key => $value) {
            $showProduct .= "<option value='" . $value['name'] . "'>" . $value['name'] . "</option>";
        }
        $showProduct .= "</select>";
        echo $showProduct;

    }

}//end controller class

?>