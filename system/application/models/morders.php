<?php

class MOrders extends Model{
 function  __construct(){
    parent::Model();
 }

function updateCart($productid,$fullproduct){

	$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	$lacePrice = 0; $personalizePrice = 0; $flgp =0;
	// $cart = $_SESSION['cart'];//$this->session->userdata('cart');
	$productid = id_clean($productid);
	$totalprice = 0;
	if(!isset($_SESSION['scounter']) || empty($_SESSION['scounter'])){ $_SESSION['scounter'] = 1;}
	$_SESSION['scounter'] = $_SESSION['scounter'] +1;
	$proCount = $_SESSION['scounter'];

	if (count($fullproduct)){
		//if (isset($cart[$productid])){
			//$prevct = $cart[$productid]['count'];
			$prevname = $fullproduct['name'];
			$prevprice = $fullproduct['price'];
					
			
		
		
				if(isset($_POST['lace']) && !empty($_POST['lace'])) { $productContent['lace'] = $_POST['lace']; $lacePrice = $this->MProducts->getLacePrice();	 }
				if(isset($_POST['fonts']) ) { $productContent['fonts'] = $_POST['fonts'];  }
				if(isset($_POST['textLine1'])) { $productContent['textLine1'] = $_POST['textLine1'];}
				if(isset($_POST['textLine2'])) { $productContent['textLine2'] = $_POST['textLine2']; }
  			    if(isset($_POST['textColor'])) { $productContent['textColor'] = $_POST['textColor'];  }
				if(isset($_POST['colors'])) { $productContent['colors'] = $_POST['colors']; }
				
				if(!empty($_POST['fonts']) || !empty($_POST['textLine1']) || !empty($_POST['textLine1']))
				{
				 $flgp =1;
				}
				
				if($flgp == '1'){ $personalizePrice = $this->MProducts->getPersonlizePrice(); }
				
				$productContent['productid'] = $productid;
				$productContent['name'] = $prevname;
				$productContent['price'] = $prevprice+$personalizePrice+$lacePrice;
				$productContent['count'] = 1;

	
			/* asort($cart);   
			$proCont = key ($cart);
			$proCont = $proCont +1;	*/					

			$cart[$proCount] = $productContent;
	/*	}else{
			$productContent  = array(
					'productid' => $productid,
					'name' => $fullproduct['name'],
					'price' => $this->format_currency($fullproduct['price']),
					'count' => 1
					);		
					
				 if(isset($_POST['lace'])) { $productContent['lace'] = $_POST['lace']; }
				if(isset($_POST['fonts'])) { $productContent['fonts'] = $_POST['fonts']; }
				if(isset($_POST['textLine1'])) { $productContent['textLine1'] = $_POST['textLine1']; }
				if(isset($_POST['textLine2'])) { $productContent['textLine2'] = $_POST['textLine2']; }
  			    if(isset($_POST['textColor'])) { $productContent['textColor'] = $_POST['textColor']; }
				 
				 $proCont = count($fullproduct)+1;								
			     $cart[$proCont] = $productContent;
				
						
		} */

		foreach ($cart as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		
		
		$_SESSION['totalprice'] = $this->format_currency($totalprice);
                $_SESSION['subtotalprice'] = $this->format_currency($totalprice);

		//$this->session->set_userdata('totalprice', $totalprice);
		$_SESSION['cart'] = $cart;
		//$this->session->set_userdata('cart',true);
		$this->session->set_flashdata('conf_msg', "Product has been added to cart successfully."); 
	}

}


function updateProductQuantity(){
	
	$qty = (int)$this->input->post('qty');
	$sessionVal  = $this->input->post('seVal');
	
	$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	// $cart = $_SESSION['cart'];//$this->session->userdata('cart');
		//$productid = id_clean($productid);
		$totalprice = 0;	
		$cart[$sessionVal]['count'] = $qty;
		foreach ($cart as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		
		
		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		//$this->session->set_userdata('totalprice', $totalprice);
		$_SESSION['cart'] = $cart;
		//$this->session->set_userdata('cart',true);
		$this->session->set_flashdata('message', "We've updated product details."); 

}

function updateGiftVoucher()
	{
		$this->db->select('*');
		$this->db->where("secure_code", $_SESSION['giftVoucherCode']);
		$this->db->where("status", "1");
		$Q = $this->db->get('giftvouchers');
    	if ($Q->num_rows() > 0){
			$result = $Q->row_array();
			$price =  $result['current_price'] - $_SESSION['giftVoucherPrice'];
						
			$data = array('current_price' => $price);
			$this->db->where('secure_code', $_SESSION['giftVoucherCode']);
	  		$this->db->update('giftvouchers',$data);	
		}
		
	}

function updateGiftCart($productid,$fullproduct){

	$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	// $cart = $_SESSION['cart'];//$this->session->userdata('cart');
	$productid = id_clean($productid);
	$totalprice = 0;
	//$proCount = count($cart);
if(!isset($_SESSION['scounter']) || empty($_SESSION['scounter'])){ $_SESSION['scounter'] = 1;}

$_SESSION['scounter'] = $_SESSION['scounter'] +1;
$proCount = $_SESSION['scounter'];

	//if (count($fullproduct)){
			$cart[$proCount] = array(
					'productid' => $productid,
					'name' => $fullproduct['name'],
					'price' => $this->input->post('amount'),
					'from' => $this->input->post('fromNm'),
					'recipientEm'=> $this->input->post('receipientEmail'),
					'recipientName'=>$this->input->post('receipientNm'),
					'message'=>$this->input->post('messageContent'),
					'count' => 1
					);			
	//	}
	
		foreach ($cart as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		
		
		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		//$this->session->set_userdata('totalprice', $totalprice);
		
		$_SESSION['cart'] = $cart;
		
		//$this->session->set_userdata('cart',true);
		$this->session->set_flashdata('conf_msg', "Product has been added to cart successfully."); 
	//}

}

function removeLineItem($id){
	$id = id_clean($id);
	$totalprice = 0;
	$cart = $_SESSION['cart'];//$this->session->userdata('cart');
	if (isset($cart[$id])){
		unset($cart[$id]);
		foreach ($cart as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		
		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		$_SESSION['cart'] = $cart;
		//$this->session->set_userdata('totalprice', $totalprice);
		//$this->session->set_userdata('cart',true);
		return "Product removed.";
	}else{
		return "Product not in cart!";
	}
}

function updateCartAjax($idlist){
	$cart = $_SESSION['cart'];//$this->session->userdata('cart');
	//split idlist on comma first
	$records = explode(',',$idlist);
	$updated = 0;
	$totalprice = $_SESSION['totalprice'];
	//$this->session->userdata('totalprice');
	if (count($records)){
		foreach ($records as $record){
			if (strlen($record)){
				//split each record on colon
				$fields = explode(":",$record);
				$id = id_clean($fields[0]);
				$ct = $fields[1];
				
				if ($ct > 0 && $ct != $cart[$id]['count']){
					$cart[$id]['count'] = $ct;
					$updated++;
				}elseif ($ct == 0){
					unset($cart[$id]);
					$updated++;
				}
			
			}
			
		}
		
		
		if ($updated){
			$totalprice=0;
			foreach ($cart as $id => $product){
				$totalprice += $product['price'] * $product['count'];
			}		

			$_SESSION['totalprice'] = $this->format_currency($totalprice);
			$_SESSION['cart'] = $cart;
			//$this->session->set_userdata('totalprice', $totalprice);		
			//$this->session->set_userdata('cart',true);
			
		
			switch ($updated){
				case 0:
				$string = "No records";
				break;
				
				case 1:
				$string = "$updated record";
				break;
				
				default:
				$string = "$updated records";
				break;
			}
			echo "$string updated";
			//$this->session->set_flashdata('update_count', $string ." updated");
		}else{
			echo "No changes detected.";
			//$this->session->set_flashdata('update_count', "No changes detected");
		}
	}else{
		echo "Nothing to update.";
		//$this->session->set_flashdata('update_count', "Nothing to update");
	}
}

function verifyCart(){
	$cart = $_SESSION['cart'];
	$change = false;
	
	if (count($cart)){
		foreach ($cart as $id => $details){
			$idlist[] = $id;		
		}
		$ids = implode(",",$idlist);
		
		$this->db->select('id,price');
		$this->db->where("id in ($ids)");
		$Q = $this->db->get('products');
    	if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
			
				$db[$row['id']] = $row['price'];
			}
		}
		
		foreach ($cart as $id => $details){
			if (isset($db[$id])){
				if ($details['price'] != $db[$id]){
					$details['price'] = $this->format_currency($db[$id]);
					$change = true;
				}
				
				$final[$id] = $details;
			
			}else{
				$change = true;
			}
		}
		
		$totalprice=0;
		foreach ($final as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		

		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		$_SESSION['cart'] = $final;
		$this->session->set_flashdata('change',$change);
	
	}else{
		//nothing in cart!
		$this->session->set_flashdata('error',"Nothing in cart!");
	}

}

function format_currency($number){
	return number_format($number,2,'.',',');
}

	function submitOrder()
	{
$_SESSION['subtotalprice'] = $_SESSION['totalprice'];
if(isset($_SESSION['giftVoucherPrice']))
{
$_SESSION['totalprice'] = $_SESSION['totalprice'] - $_SESSION['giftVoucherPrice'];
}
// tax amount
if(isset($_SESSION['TAX']) && !empty($_SESSION['TAX']))
{
$_SESSION['totalprice'] = $_SESSION['totalprice'] + $_SESSION['TAX'];
}


			$data = array
					(
						'totalAmout' => str_replace(',','',$_SESSION['totalprice']),
						'customerId' => $_SESSION['customer_id'],
						'customerName' => $_SESSION['customer_first_name']." ".$_SESSION['customer_last_name'],
						'customerEmail' => $_SESSION['email'],
						'customerBillingAddress' =>  $_POST['customer_first_name']." ".$_POST['customer_last_name']." ".$_POST['email']." ".
						$_POST['address']."<br/>".$_POST['address1']."<br/>".$_POST['city'].",".$_POST['state'].",".$_POST['country'].",".$_POST['phone_number'],
						'customerDeliveryAddress' =>  $_POST['customer_first_nameS']." ".$_POST['customer_last_nameS']." ".$_POST['emailS']." ".
						$_POST['addressS']."<br/>".$_POST['address1S']."<br/>".$_POST['cityS'].",".$_POST['stateS'].",".$_POST['countryS'].",".$_POST['phone_numberS'],
						'paymentStatus' => "pending",
						'paymentMethod' => "paypal",	
						'orderStatus' => "pending",
						'shippingMethod' => "",
						'shippingCharges' => "1.00",
						'paymentData'=>"NULL",
						'purchaseDate' => date('Y-m-d H:i:s'),
						'shippingDate' => date('Y-m-d H:i:s'),
                                                'tax_amount' =>$_SESSION['TAX']
						
						);					

if(isset($_SESSION['giftVoucherPrice']) && !empty($_SESSION['giftVoucherPrice']))
{
$data['giftVoucher'] = $_SESSION['giftVoucherPrice'];
}else{
$data['giftVoucher'] = 0;
}

		$this->db->insert('orders', $data);

	$_SESSION['orderId'] = $orderid = $this->db->insert_id();
	
	foreach ($_SESSION['cart'] as $PID => $row){	
			$productSpec = array();	
				if(isset($row['lace'])) { $productSpec['lace'] = $row['lace']; }
				if(isset($row['fonts'])) { $productSpec['fonts'] = $row['fonts']; }
				if(isset($row['textLine1'])) { $productSpec['textLine1'] = $row['textLine1']; }
				if(isset($row['textLine2'])) { $productSpec['textLine2'] = $row['textLine2']; }
  			    if(isset($row['textColor'])) { $productSpec['textColor'] = $row['textColor']; }
				 if(isset($row['colors'])) { $productSpec['colors'] = $row['colors']; }
				$productSpec = serialize($productSpec);
					$data = array
					(
					'order_id'=>$orderid,
					'product_id'=>$row['productid'],
					'quantity'=>$row['count'],
					'product_price'=>$row['price'],
					'productSpecification'=>$productSpec
					
					);
					if(isset($row['colors']))
					{
					$data ['colors'] = $row['colors'];
					}
					else{ $data ['colors'] = "0"; }
			$this->db->insert('productorder', $data);
		}
	}	



	function getAllOrders(){
	$data = array();
	$Q = $this->db->query('SELECT * FROM orders');
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}
	
	
	function getAllGift(){
	$data = array();
	$Q = $this->db->query('SELECT * FROM giftvouchers');
	// $Q = $this->db->get('products');
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
	$Q = $this->db->query('SELECT * FROM customer where customer_status !=0');
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}

	 function getOrder($id){
      $data = array();
      $options = array('order_id ' => id_clean($id));
      $Q = $this->db->getwhere('orders',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }
      $Q->free_result();
      return $data;
    }
	
	function getOrderDetails($id){
      $data = array();
      $options = array('order_id ' => id_clean($id));
      $Q = $this->db->getwhere('productorder',$options);
      if ($Q->num_rows() > 0){
        foreach ($Q->result_array() as $row){
		 $data[] = $row;
		}
      }
      $Q->free_result();
      return $data;
    }
	
	function updateOrderStatus($data1)
	{
	$data1 = serialize($data1);
	
	     $data = array('paymentData' => $data1
                    );
      $this->db->where('order_id',$_SESSION['orderId']);
      $this->db->update('orders',$data);  
	
	}
	
	
	function updateOrderSt($id,$status)
	{
	
	     $data = array('orderStatus' => $status
                    );
      $this->db->where('order_id',$id);
      $this->db->update('orders',$data);  
	
	}
	function updatePaymentStatus($data1)
	{
	  $data = array('paymentStatus' => $data1);
      $this->db->where('order_id',$_SESSION['orderId']);
      $this->db->update('orders',$data);  
	
	}

	function secureCodeCheck($secureCode)
	{
		$this->db->select('*');
		$this->db->where("secure_code", $secureCode);
		$this->db->where("status", "1");
		$Q = $this->db->get('giftvouchers');
    	if ($Q->num_rows() > 0){
			$result = $Q->row_array();
			return $result['current_price'];
		}else{
		return -1;
		
		}
	
	
	}
   
    function voucherMail()
	{
		$from =$this->config->item('site_admin_email');
		
		$name =  "Twinkle My Net ";
		$subject = "Twinkle My Net Order Details";
		
		$this->load->helper('string');
		$message = '<p>Thank you for purchasing Gift Cerificate from us.</p><p>&nbsp;</p>';
		$message .= "<table border='0' cellspacing='0' cellpadding='5' style='border-left:1px solid #7b5722;border-top:1px solid #7b5722;'>";
		  $flg=0;
		  $TOTALPRICE = $_SESSION['totalprice'];
		  
		  foreach ($_SESSION['cart'] as $PID => $row){
		  if($row['productid']  == '20' ){	
		  
		  $flg = 1;
		  $seurecode = random_string();
		  $data = array('secure_code' =>$seurecode,
		  'purchase_price' =>$row['price']*$row['count'],
		  'current_price'=>$row['price']*$row['count'],
		  'status' =>1,
		  'customer_id'=>$_SESSION['customer_id'],
                  'recipient'=>$row['recipientEm']				
		  );
		 // $to = $to.",". $row['recipientEm'];
		  $this->db->insert('giftvouchers', $data);

			$message .= "<tr valign='top'>\n";
			$message .= "<td id='li_name_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>Product Name</font></td>\n"; 
			$message .= "<td id='li_price_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>Price</font></td>\n";
			$message .= "<td id='li_total_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>Voucher Code</font></td>\n";			
			$message .= "</tr>\n";
			$message .= "<tr valign='top'>\n";
			$message .= "<td id='li_name_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>". $row['name']."</font></td>\n"; 
			$message .= "<td id='li_price_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>$". ($row['price']*$row['count'])."</font></td>\n";
			$message .= "<td id='li_total_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>".$seurecode."</font></td>\n";			
			$message .= "</tr>\n";
			$message .= "<tr valign='top'><td colspan='3' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>From : </strong>".$row['from']."</font></td></tr>\n";
			$message .= "<tr valign='top'><td colspan='3' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>Recipient Name : </strong>".$row['recipientName']."</font></td></tr>\n";
			$message .= "<tr valign='top'><td colspan='3' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>Recipient Email : </strong>".$row['recipientEm']."</font></td></tr>\n";
			$message .= "<tr valign='top'><td colspan='3' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>&nbsp;</td></tr>\n";
			$message .= "<tr valign='top'><td colspan='3' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>Message : </strong>".$row['message']."</font></td></tr>\n";
			$to = $row['recipientEm'].",".$_SESSION['email'];
		  }
		}
		if($flg == 1){
			$message .= "</table>";
			$message .= "<p>&nbsp;</p>";
			$message .= "<p><font color='#7b5722'>Thanks,</font></p>";
			$message .= "<p><font color='#7b5722'>Twinkle My Net</font></p><p><img src='http://demoecommerce.com/twinklemynet/images/logo.png' width='196' height='72' alt='' /></p>";
		$from= $this->config->item('site_admin_email');
	    $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
		
        $this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from( $from, $name );
		$this->email->to($to);
		$this->email->subject( $subject );
		$this->email->message( $message );
		$this->email->send();
		$this->email->clear();
	    }
	
	}		

	  function purchaseMail()
	  {
	    $to = $_SESSION['email'];
		$from = $this->config->item('site_admin_email');
		$name =  "Twinkle My Net ";
		$subject = "Twinkle My Net Order Details";
		
	
		$message = "<p><font color='#7b5722'>Congratulations on purchase of your Twinkle My Net custom crib canopy! </font></p><p>&nbsp;</p>";
		
		$message .= "<div>&nbsp;</div>";
		$message .= "<font color='#7b5722'>Order Id : ".$_SESSION['orderId']."</font>";
		$message .= "<div>&nbsp;</div>";
		$message .= "<font color='#7b5722'>Purchase Date : ".date('Y-m-d H:i:s')."</font>";
		$message .= "<div>&nbsp;</div>";
		
		
		if(isset($_SESSION['orderId']) && !empty($_SESSION['orderId'])){
		$orderDetails =  $this->getOrder($_SESSION['orderId']);
		$message .= "<table border='0' cellspacing='0' cellpadding='5' style='border-left:1px solid #7b5722;border-top:1px solid #7b5722;'>
		<tr><td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>Billing Address </font></td>
		<td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>Shipping Address</font></td></tr>
		<tr><td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>".$orderDetails['customerBillingAddress']."</font></td><td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>".$orderDetails['customerDeliveryAddress']."</font></td></tr>	
		</table><p>&nbsp;</p>
		";		
		}
		$message .= "<table border='0' cellspacing='0' cellpadding='5' style='border-left:1px solid #7b5722;border-top:1px solid #7b5722;'>";

		$TOTALPRICE = $_SESSION['totalprice'];
		$i=1;
			foreach ($_SESSION['cart'] as $PID => $row){	
				$data = array(	
						'name' => $row['name'], 
						'value'=>$row['count'], 
						'id' => "li_id_$PID", 
						'class' => 'process',
						'size' => 5
				);
				
				$message .= "<tr valign='top'>\n";
				$message .= "<td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'>".$i."</td>\n";
				$message .= "<td id='li_name_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>". $row['name']."</font></td>\n"; 
				$message .= "<td id='li_price_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>". $row['price']."</font></td>\n";
				$message .= "<td id='li_total_".$PID."' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>$".number_format($row['price'] * $row['count'], 2,'.',',')."</font></td>\n";
			
				$message .= "</tr>\n";
				
				$message .= "<tr valign='top'>\n";
				$message .= "<td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>Details : </strong></font></td>\n"; $productDetails ="";
				if(isset($row['lace'])) { $lace = "No"; if($row['lace'] == 1){$lace = "Yes"; } $productDetails .= "Lace :". $lace."<br/>"; }
				if(isset($row['fonts'])) {$productDetails .= "Font: ". $this->MFonts->getFontName($row['fonts'])."<br/>"; }
				if(isset($row['textLine1'])) { $productDetails .= "Textline1 : " .$row['textLine1']."<br/>"; }
				if(isset($row['textLine2'])) { $productDetails .= "Textline2 : " . $row['textLine2']."<br/>"; }
  			    if(isset($row['textColor'])) {  $productDetails .= "TextColor : ". $row['textColor']."<br/>"; }
				if(isset($row['colors'])) {  $productDetails .=  "Color : ". $this->MColors->getColorName($row['colors'])."<br/>" ; }
					$message .= "<td colspan='3' style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'>".$productDetails."</font></td>\n"; 
				$message .= "</tr>\n";
				
				
				$i++;
			}
			
			$total_data = array('name' => 'total', 'id'=>'total', 'value' => $TOTALPRICE);
                        
                        $message .= "<tr valign='top'>\n";
			$message .= "<td colspan='2' style='border-bottom:1px solid #7b5722;'>&nbsp;</td>\n";
		        $message .= "<td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>Tax : </strong></font></td><td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>$".$_SESSION['TAX']."</font></td>\n";
			$message .= "</tr>\n";

			$message .= "<tr valign='top'>\n";
			$message .= "<td colspan='2' style='border-bottom:1px solid #7b5722;'>&nbsp;</td>\n";
			$message .= "<td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'><strong>Total : </strong></font></td><td style='border-right:1px solid #7b5722;border-bottom:1px solid #7b5722;'><font color='#7b5722'>$".$TOTALPRICE."</font></td>\n";
			
			$message .= "</tr>\n";
		
			$message .= "</table>";
			
			$message .= "<p><font color='#7b5722'>This one-of-kind of, hand crafted piece will top off your baby's nursery with your unique style. </font></p>";
			$message .= '<p>&nbsp;</p>';
			$message .= "<p><font color='#7b5722'>Thank you</font></p>";
			$message .= "<p><font color='#7b5722'>Twinkle My Net</font></p><p><img src='http://demoecommerce.com/twinklemynet/images/logo.png' width='196' height='72' alt='' /></p>";

		$from= $this->config->item('site_admin_email');
		$config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
		$this->email->set_mailtype("html");
        $this->email->initialize($config);
		$this->email->from( $from, "Administrator, Power Steering Kit Specialist" );
		$this->email->to($to);
		$this->email->subject( $subject );
		$this->email->message( $message );
		$this->email->send();
		$this->email->clear();
	  
	  }
 // customer profile orders
	function getCustomerOrder($customer){
	$data = array();
	$Q = $this->db->query('SELECT * FROM orders where customerId='.$customer);
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}

	 function getGiftByUser($cusotmer){
	$data = array();
	$Q = $this->db->query('SELECT * FROM giftvouchers where customer_id ='.$cusotmer);
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}
 
}//end class
?>