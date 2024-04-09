<script type="text/javascript">
var sitepath = "<?php echo base_url();?>";
function shipAddress()
{

var shipOption = $("#shipAdd:checked").val();

if(shipOption == 0)
{
$("#customer_first_nameS").val($("#customer_first_name").val());
$("#emailS").val($("#email").val());
$("#companyS").val($("#company").val());
$("#faxS").val($("#fax").val());
$("#customer_last_nameS").val($("#customer_last_name").val());
$("#phone_numberS").val($("#phone_number").val());
$("#addressS").val($("#address").val());
$("#post_codeS").val($("#post_code").val());
$("#stateS").val($("#state").val());
$("#cityS").val($("#city").val());
$("#countryS").val($("#country").val());

}
else{
$("#customer_first_nameS").val("");
$("#emailS").val("");
$("#companyS").val("");
$("#faxS").val("");
$("#customer_last_nameS").val("");
$("#phone_numberS").val("");
$("#addressS").val("");
$("#post_codeS").val("");
$("#cityS").val("");
$("#stateS").val("");
$("#countryS").val("");
$("#useBill").attr('checked', false);
}
}
function userAddress()
{
$("#shipAdd").attr('checked', true);
shipAddress();
}
 function giftVoucher(){

    var voucherPrice =  $("#giftVoucherCode").val();
	$.ajax({
	  url: sitepath+"index.php/welcome/giftVoucherPurchase",
	   type: 'POST',
		data: "secureCode=" + voucherPrice,  
	  context: document.body,
	  success: function(result){
	  if(result == "Gift certificate processed successfully")
	  {
	  $("#gift").hide();
	  $("#giftText").hide();
	  $("#giftMessage").html(result);
		checkremailTotal();
	  
	  }else{
	  $("#giftMessage").html(result);
	  }
	
	  }
	});
 }


function checkremailTotal(){
   
	$.ajax({
	  url: sitepath+"index.php/welcome/checktotalPrice",
	   type: 'POST',		
	  context: document.body,
	  success: function(result){ 
	  if(result == "1")
	  {
	 // $(".checkout-step-five").show();
	 checkState();
	  }
	
	  }
	});
 }
</script>
<!--script type="text/javascript">
	jQuery().ready(function(){
		// simple accordion
		jQuery('#list1a').accordion();
		jQuery('#list1b').accordion({
			autoheight: false
		});
		
		var wizard = $("#wizard").accordion({
			header: '.title',
			event: false
		});
		
		var wizardButtons = $([]);
		$("div.title", wizard).each(function(index) {
			wizardButtons = wizardButtons.add($(this)
			.next()
			.children(":button")
			.filter(".next, .previous")
			.click(function() {
				wizard.accordion("activate", index + ($(this).is(".next") ? 1 : -1))
			}));
		});
		
		// bind to change event of select to control first and seconds accordion
		// similar to tab's plugin triggerTab(), without an extra method
		var accordions = jQuery('#list1a, #list1b, #list2, #list3, #navigation, #wizard');
		
		jQuery('#switch select').change(function() {
			accordions.accordion("activate", this.selectedIndex-1 );
		});
		jQuery('#close').click(function() {
			accordions.accordion("activate", -1);
		});
		jQuery('#switch2').change(function() {
			accordions.accordion("activate", this.value);
		});
		jQuery('#enable').click(function() {
			accordions.accordion("enable");
		});
		jQuery('#disable').click(function() {
			accordions.accordion("disable");
		});
		jQuery('#remove').click(function() {
			accordions.accordion("destroy");
			wizardButtons.unbind("click");
		});
	});
</script-->
<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");

 
  $("#loginUser").validate({
        rules: {  emailLogin:{   required : true, email:true },
          password: {    required : true, minlength:6,  maxlength: 15 	  }
		  },
        messages: { 	emailLogin: { required: "Please enter your Email"},       password: { required: "Please enter password" }
        }       });
      });
  
  </script>
<style type="text/css">
/******************** Contact Form CSS *****************************/
	.for_contact_form {
	width:340px;
	margin:20px 0 0 0;
	border:1px solid #CCCCCC;
	height:270px;
	float:left;
}
.contactform {
	width:330px;
	margin:0;
	padding:0;
	font-family:Verdana;
	font-size:11px;
	color:#757575;
	float:left;
}
.frmbtn {
	background:url(../images/submit.png) no-repeat 0 0;
	width:83px;
	height:31px;
	margin:0 0 0 55px;
	padding:0;
	border:none;
	cursor:pointer;
}
.frmbtn:hover {
	background:url(../images/submit.png) no-repeat 0 -31px;
	width:83px;
	height:31px;
	margin:0 0 0 55px;
	padding:0;
	border:none;
	cursor:pointer;
}
.contactform label {
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#757575;
	margin:0;
	padding:0;
}
.contactform label a {
	color:#757575;
	text-decoration:underline;
}
.contacttxtfld {
	width:240px;
	height:18px;
	font-family:Verdana;
	font-size:11px;
	color:#757575;
	margin:0;
	padding:0;
	border:1px solid #c7c7c7; /*opacity:0.5;*/
	background:url(../images/bg_input.jpg) repeat-x scroll top left;
}
</style>
<!--script type="text/javascript" src="./js/custom-form-elements.js"></script-->
<script type="text/javascript" src="./js/jquery.idTabs.min.js"></script>
<!-- contact us fornm -->
<script type="text/javascript" src="./js/jquery_contact.js"></script>
<script type="text/javascript" src="./js/msg_script.js"></script>
<script type="text/javascript" src="./js/formValidation.js"></script>
<!--script type="text/javascript" src="./js/jquery.accordion.js"></script>
<script type="text/javascript" src="./js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="./js/jquery.easing.js"></script>
<script type="text/javascript" src="./js/jquery.dimensions.js"></script-->
<!--<script src="./js/menu.js" type="text/javascript"></script>-->
<?
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}?>
<div id="pleft">
  <div id="cart-structure">
    <div class="firstcol">
      <h6>Product Description</h6>
    </div>
    <!--<div class="secondcol">
      <h6>Description</h6>
    </div>
    <div class="thirdcol">
      <h6>Unit Price</h6>
    </div>-->
    <div class="fourthcol">
      <h6>Qty</h6>
    </div>
    <div class="fifth-col">
      <h6>Unit price</h6>
    </div>
    <!-- For Loop -->
    <?php
		$TOTALPRICE = $_SESSION['totalprice'];
		$_SESSION['TAX'] = 0;
		if (count($_SESSION['cart'])){
			foreach ($_SESSION['cart'] as $PID => $row){	
	
				$data = array(	
						'productid' => $row['productid'], 
						'name' => "li_id".$row['productid'], 
						'value'=>$row['count'], 
						'id' => "li_id_".$row['productid'], 
						'class' => 'process',
						'size' => 5
				);
				$product =  $this->MProducts->getProduct($row['productid']);
				if($row['productid'] == 20){$product['price'] = $row['price']; }
				
				
				?>
                  <form name="updateProduct" id="updateProduct" action="<?php echo site_url("welcome/updateOrder");?>" method="post" onsubmit="return checkQuantity(<?php echo $PID; ?>);" >
    <div class="columns-bg">
    
        <div class="first-col">
          <div class="thumbnail"><img src="./<?php echo $product['thumbnail']; ?>" border="0" width="70" height="70" style="margin:2px 0 0 5px;" /></div>
        <div class="second-col">
          <div class="second-row">
            <p><b><?php echo $product['name']; ?></b><br />
              <?
			  
             if(isset($row['colors'])){ echo "Color: ".$this->MProducts->getColor($row['colors']);}
            if(isset($row['fonts'])){ echo "<br />Font: ".$this->MProducts->getFont($row['fonts']);}
            if(isset($row['textLine1'])){ echo "<br />Text: ".$row['textLine1'];}
			 if(isset($row['lace'])){ echo "<br />Lace: ".$row['lace'];}
            ?>
            </p>
          </div>
        </div></div>
   
        <div class="fourth-col">
          <div class="qty-row">
            <p>
              <input type="hidden" name="seVal" id="seVal" value="<?php echo $PID; ?>" />
              <input type="text" name="qty" id="qty<?php echo $PID; ?>" value="<?php echo $row['count']; ?>" />
            </p>
          </div>
        </div>
        <div class="fifth-col">
          <div class="sub-total">
            <p>$<?php echo number_format(($row['price']*$row['count']),2); ?></p>
          </div>
        </div>
      
		<div class="for-buttons"><p><input type="submit" name="update" id="update" title="Update Cart" value="Update" />&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url()."index.php/welcome/removeItem/". $PID; ?>" title="Remove Item From Cart">Remove</a></p></div>
              
    </div>
    </form>
    
    
    <?php } } ?>
    <!-- For Loop : ends here  -->
    <div class="subtotal_wrapper fl">
        <div class="subtotal_inner fl">
        <div class="subtotal_innertxt fl">Subtotal</div>
        <div class="subtotal_innertxt fr">$ 129</div>
        </div>
        </div>
    <div class="continue-button"> <a href="<?php echo base_url();?>index.php/welcome/shop" class="c-button" title="Continue Shopping"></a> </div>
    </form>
  </div>
  <div class="checkout-process">
    <!--		<ul id="menu2" class="menu expandfirst">
			<li>-->
    <div class="basic" style="float:left;" id="list1b">
    <!--<a href="#" title="1. Checkout Method" id="titleHead">-->
    <h3>1. Checkout Method</h3>
    <!--</a>-->
    <!--<ul>
                    <li>-->
    <?php if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {?>
    <div class="checkout-step-one">
      <div class="left-col">
        <p>Checkout as a Guest or Register</p>
        <p>Register with us for future convenience: </p>
        <!--<p><span>Checkout as Guest</span></p>
        <p><span>Register</span></p>
-->        <p>Register and save time!</p>
        <!--<p>Register with us for future convenience: </p>-->
        <p>Fast and easy checkout</p>
        <p>Easy access to your order history status</p>
        <p><a href="#" title="Continue" class="continue" onclick="$('.checkout-step-two').show('slow'); return false;">Continue</a> </p>
      </div>
      <div class="right-col">
        <form name="loginUser" id="loginUser" action="<?php echo base_url();?>index.php/welcome/login" method="post">
          <p>Login</p>
          <p>&nbsp;</p>
          <p>Already registered?</p>
          <p>Please log in below:</p>
          <p>Email Address *</p>
          <p>
            <input type="text" size="50" maxlength="50" name="emailLogin" id="emailLogin" tabindex="101" />
          </p>
          <p>Password *</p>
          <p>
            <input type="password" size="50" maxlength="50" name="password" id="password" tabindex="102" />
          </p>
          <p style="text-align:right; font-size:10px;">* Required fields</p>
          <div class="bottom-link"> <a href="<?php echo site_url("welcome/forgotPassword");?>" title="Forgot your password?">Forgot your password?</a>
            <p>
              <input type="submit" name="submitLogin" id="submitLogin" value="Login" class="login" tabindex="103" />
            </p>
          </div>
        </form>
      </div>
    </div>
    <?php } ?>
    <form name="shipNow" id="shipNow" method="post" action="<?php echo site_url('welcome/processOrder');?>" onsubmit="return checkoutStatus();">
    <input type="hidden" name="changeSt" id="changeSt" value="0" />
      <!--<a href="#" title="2. Billing Information" id="titleHead">-->
      <h3>2. Billing Information</h3>
      <!--</a>-->
      <!--<ul>
                    <li>-->
      <div class="checkout-step-two">
        <div class="left-col">
          <p>First name *</p>
          <p>
            <input type="text" name="customer_first_name" id="customer_first_name" tabindex="104" value="<?php echo $userinfo['customer_first_name']; ?>" size="30" />
          </p>
          <p>Company</p>
          <p>
            <input type="text" name="company" id="company" value="" size="30" tabindex="106" />
          </p>
          <?php if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {?>
          <p>Password *</p>
          <p>
            <input type="password" name="upassword" id="upassword" value="" tabindex="108" size="30" />
          </p>
          <?php } ?>
        </div>
        <div class="right-col">
          <p>Last Name *</p>
          <p>
            <input type="text" tabindex="105" name="customer_last_name" id="customer_last_name" value="<?php echo $userinfo['customer_last_name']; ?>" size="30" />
          </p>
          <p>Email Address *</p>
          <p>
            <input type="text" tabindex="107" name="email" id="email" value="<?php echo $userinfo['email']; ?>" size="40" />
          </p>
          <?php if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {?>
          <p>Confirm Password *</p>
          <p>
            <input tabindex="109" type="password" name="cpassword" id="cpassword" value="" size="30" />
          </p>
          <?php } ?>
        </div>
        <p>Address *</p>
        <p>
          <input tabindex="110" type="text" name="address" id="address"  value="<?php echo $userinfo['address']; ?>" size="50" />
        </p>
        <p>
          <input tabindex="111" type="text" name="address1" id="address1"  value="<?php echo $userinfo['address2']; ?>" size="50" />
        </p>
        <div class="left-col">
          <p>City *</p>
          <p>
            <input tabindex="112" type="text" name="city" id="city"  value="<?php echo $userinfo['city']; ?>" size="20" />
          </p>
          <p>Zip/Postal code *</p>
          <p>
            <input tabindex="114" type="text" name="post_code" id="post_code"  value="<?php echo $userinfo['post_code']; ?>" size="8" />
          </p>
          <p>Telephone *</p>
          <p>
            <input tabindex="116" type="text" name="phone_number" id="phone_number"  value="<?php echo $userinfo['phone_number']; ?>" size="15" />
          </p>
        </div>
        <div class="right-col">
          <p>State/Province *</p>        
          <p><select name="state" id="state"><option value="">Select state</option>
                            <?
							$countrylist = $this->MCustomers->getState();
							foreach($countrylist as $key=>$value)
							{ $select =""; if($userinfo['state'] == $value['state_abbr']){ $select ="selected";}
								echo "<option value='".$value['state_abbr']."'  ".$select.">".$value['state']."</option>";
							}
							?>
                            </select></p>
          <p>Country *</p>
          <p>
            <input tabindex="115" type="text" name="country" id="country"  value="US" size="20" readonly="readonly" />
          </p>
         
          <p>Fax</p>
          <p>
            <input type="text" name="fax" id="fax"  value="" size="20" tabindex="117" />
          </p>
          <input type="hidden" name="checkPost1" id="checkPost1" tabindex="118" value="1" />
          <input type="hidden" name="checkType" id="checkType" tabindex="119" value="<?php if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id']))
							{ echo "1"; }else{ echo "2"; }?>" />
        </div>
        <div class="select-ship">
          <div style="float:left; margin:0 10px 0 0;">
            <input tabindex="120" type="radio" name="shipAdd" id="shipAdd" value="0"  onclick="shipAddress();"/>
            Ship to this address</div>
          <div style="float:left;">
            <input tabindex="121" type="radio" name="shipAdd" id="shipAdd" value="1" onclick="shipAddress();"  />
            Ship to different address</div>
        </div>
        <p style="text-align:right; clear:both; font-size:10px;">* Required fields</p>
        <p style="text-align:right; font-size:10px;"><a href="#" title="Continue" class="continue" id="titleHead" onclick="return validateCheck('checkout-step-three','shipping');" tabindex="122">Continue</a> </p>
      </div>
      <!--</li>
            </ul>
        	</li>
    		<li>-->
      <!--<a href="#" title="3. Shipping Information" id="titleHead" onclick="checkfuction('checkout-step-three'); return false; ">-->
      <h3>3. Shipping Information</h3>
      <!--</a>-->
      <!--<ul>
            		<li>-->
      <div class="checkout-step-three">
        <div class="left-col">
          <p>First name *</p>
          <p>
            <input tabindex="123" type="text" name="customer_first_nameS" id="customer_first_nameS" value="<?php echo $userinfo['customer_first_name_ship']; ?>" size="30" />
          </p>
          <p>Company</p>
          <p>
            <input tabindex="125" type="text" name="companyS" id="companyS" value="" size="30" />
          </p>
        </div>
        <div class="right-col">
          <p>Last Name *</p>
          <p>
            <input tabindex="124" type="text" name="customer_last_nameS" id="customer_last_nameS" value="<?php echo $userinfo['customer_last_name_ship']; ?>" size="30" />
          </p>
          <p>Email Address *</p>
          <p>
            <input tabindex="126" type="text" name="emailS" id="emailS" value="<?php echo $userinfo['email']; ?>" size="40" />
          </p>
        </div>
        <p>Address *</p>
        <p>
          <input tabindex="127" type="text" name="addressS" id="addressS"  value="<?php echo $userinfo['address1_ship']; ?>" size="50" />
        </p>
        <p>
          <input tabindex="128" type="text" name="address1S" id="address1S"  value="<?php echo $userinfo['address2_ship']; ?>" size="50" />
        </p>
        <div class="left-col">
          <p>City *</p>
          <p>
            <input tabindex="129" type="text" name="cityS" id="cityS"  value="<?php echo $userinfo['city_ship']; ?>" size="20" />
          </p>
          <p>Zip/Postal code *</p>
          <p>
            <input tabindex="131" type="text" name="post_codeS" id="post_codeS"  value="<?php echo $userinfo['post_code_ship']; ?>" size="8" />
          </p>
          <p>Telephone *</p>
          <p>
            <input tabindex="132" type="text" name="phone_numberS" id="phone_numberS"  value="<?php echo $userinfo['phone_number_ship']; ?>" size="15" />
          </p>
        </div>
        <div class="right-col">
          <p>State/Province * </p>
          <p><select name="stateS" id="stateS" ><option value="">Select state</option>
                            <?
							$countrylist = $this->MCustomers->getState();
							foreach($countrylist as $key=>$value)
							{ $select =""; if($userinfo['state_ship'] == $value['state_abbr']){ $select ="selected";}
								echo "<option value='".$value['state_abbr']."' ".$select.">".$value['state']."</option>";
							}
							?>
                            </select></p>
          <p>Country *</p>
          <p>
            <input tabindex="131" type="text" name="countryS" id="countryS"  value="US" size="20" readonly="readonly" />
          </p>
          <p>Fax</p>
          <p>
            <input tabindex="133" type="text" name="faxS" id="faxS"  value="" size="20" />
          </p>
          <input tabindex="134" type="hidden" name="checkPost1" id="checkPost1" value="1" />
        </div>
        <input tabindex="135" type="hidden" name="checkPost2" id="checkPost2" value="2" />
        <div class="select-ship">
          <input tabindex="136" type="radio" name="useBill" id="useBill" value="0" onclick="userAddress();"/>
          Use Billing Address</div>
        <p style="text-align:right; clear:both; font-size:10px;">* Required fields</p>
        <p style="text-align:right; font-size:10px;"><a href="#" title="Continue" class="continue" id="titleHead" onclick="return validateCheck('checkout-step-four','delivery');" tabindex="137">Continue</a> </p>
      </div>
      <!--</li>
		    </ul>
          	</li>
          	<li>-->
      <!--<a href="#" title="4. Payment Information" id="titleHead">-->
      <h3>4. Payment Information</h3>
      <!--</a>-->
      <!--<ul>
            		<li>-->
      <div class="checkout-step-four">
        <div id='cardPayment'></div>
        <div class="usual" id="usual1">
          <ul>
            <li style="float:left;"><a href="#tab1" class="selected" id="cc-tab">Credit Card</a></li>
            <li style="float:right;"><a href="#tab2" id="gift-tab">Gift Certificate</a></li>
          </ul>
          <div id="tab1">
            <div class="cc-tab-top"></div>
            <div class="cc-tab-mid">
              <!--form name="doPayment" id="doPayment" action="index.php/payments_pro/do_direct_payment_demo" method="post"-->
              <p>Credit Card Type *</p>
              <p>
                <select name="CardType" id="CardType" tabindex="138">
                  <option value="">Select Card Type</option>
                  <option value="Visa">Visa</option>
                  <option value="MasterCard">MasterCard</option>
                  <option value="Amex">Amex</option>
                  <option value="Discover">Discover</option>
                </select>
              </p>
              <p>Credit Card Number *</p>
              <p>
                <input type="text" name="cardNo" id="cardNo" value="" tabindex="139" />
              </p>
              <p>Expiration date *</p>
              <div>Month:
                <select name="month" id="month" tabindex="140">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
                Year:
                <input tabindex="141" type="text" name="year" id="year" value="Year(2 digits only)" onfocus="$(this).val('');" maxlength="2" />
              </div>
              <p>Card Verification Number *</p>
              <div>
                <input tabindex="142" type="text" name="ccv" id="ccv" value="" maxlength="6" />
              </div>
              <p style="text-align:right; font-size:10px;"><a href="#" title="Continue" class="continue" onclick="checkState(); return validateCheck('checkout-step-five','cardCheck');" tabindex="143">Continue</a> </p>
            </div>
            <div class="cc-tab-bottom"></div>
          </div>
          <div id="tab2">
            <div class="gift-tab-top"></div>
            <div class="gift-tab-mid">
              <p>Gift Certificate Number</p>
              <span id="giftMessage"></span>
              <p id="giftText">
                <input tabindex="144" type="text" name="giftVoucherCode" id="giftVoucherCode" value="security code" onfocus="$(this).val('');" />
              </p>
              <input tabindex="145" type="button" name="gift" id="gift" value="Continue" onclick="giftVoucher();"/>
            </div>
            <div class="gift-tab-bottom"></div>
          </div>
          <script type="text/javascript">
                                $("#usual1 ul").idTabs();
                            </script>
        </div>
      </div>
      <!--</li>
			</ul>               
			</li>
    		<li>
	        	<a href="#" title="5. Order Review" id="titleHead">-->
      <h3>5. Order Review</h3>
      <!--</a>
            	<ul>
            		<li>-->
      <div class="checkout-step-five">
      
        <div class="headings">
          <div class="head-one">Product Name</div>
          <div class="head-two">Unit Price</div>
          <div class="head-three">Qty</div>
          <div class="head-four">Subtotal</div>
        </div>
        <?php 

					$TOTALPRICE = $_SESSION['totalprice'];
					if (count($_SESSION['cart'])){
							foreach ($_SESSION['cart'] as $PID => $row){	
									$data = array(	
											'productid' => $row['productid'], 
											'name' => "li_id".$row['productid'], 
											'value'=>$row['count'], 
											'id' => "li_id_".$row['productid'], 
											'class' => 'process',
											'size' => 5
									);
						?>
        <div class="p-name">
          <p><?php echo $row['name']; ?></p>
        </div>
        <div class="u-price">
          <p>$<?php echo $row['price']; ?></p>
        </div>
        <div class="p-qty">
          <p><?php echo  $row['count']; ?></p>
        </div>
        <div class="p-subtotal">
          <p>$<?php echo ($row['price']*$row['count'] ) ; ?></p>
        </div>
        <?php } } ?>
        <div class="sub-tot">
          <div class="txt">Subtotal</div>
          <div class="amt">$<?php echo round($TOTALPRICE,2) ?></div>          
        </div>
         <div class="sub-tot">
          <div class="txt">Shipping Charges</div>
          <div class="amt">$0</div>          
        </div>
        <?php if(isset($_SESSION['giftVoucherPrice']) && !empty($_SESSION['giftVoucherPrice'])) { ?>
        <div class="sub-tot">
          <div class="txt">Gift certificate</div>
          <div class="amt">$<?php echo round($_SESSION['giftVoucherPrice'],2); ?></div>          
        </div>
        <?php } ?>
        <div class="grand-tot">
          <div class="txt">Grand Total</div>
          <div class="amt">$<?php 
		  if(isset($_SESSION['giftVoucherPrice']) && !empty($_SESSION['giftVoucherPrice'])){ echo $TOTALPRICE - $_SESSION['giftVoucherPrice'];}
		  else{ echo round($TOTALPRICE,2); }		  
		  ?></div>
        </div>
        <div style="clear:both; padding-top:10px;"></div>
        <p style=" clear:both;text-align:right; font-size:10px;">

          <input tabindex="146" type="submit" name="submit" id="submit" value="Place Order" class="order-button" />
        </p>
      </div>
      </div>
      <!--</li>
            </ul>
     		</li>
		</ul>-->
      <!--<h2>Shipping Method</h2>
      	<div>Free ground shipping (US Only)</div>
      <div>
        <input type="radio" name="shippingMethod" id="shippingMethod" value="0" checked="checked" />
        &nbsp;  UPS ground $0.00</div>
      <div>
        <input type="radio" name="shippingMethod" id="shippingMethod" value="0" />
        &nbsp;  UPS second day air $18.59</div>
      <div>
        <input type="radio" name="shippingMethod" id="shippingMethod" value="0" />
        &nbsp;  UPS next day air saver $18.59</div>
      <p>&nbsp;</p>-->
    </form>
  </div>
</div>
<script type="text/javascript">
 <?php if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {?>
$(".checkout-step-two").hide(); 

<?php }?>
$(".checkout-step-three").hide();
$(".checkout-step-four").hide();
$(".checkout-step-five").hide();


function checkfuction(classNm)
{
	$("."+classNm).show();
}


function checkoutStatus()
{
	var checkSt = $("#changeSt").val();
	if(checkSt > 0)
	{
	return true;	
	}else{ return false; }
}
function checkState()
{
var selectState = $('#stateS option:selected').val(); 

var siteurl =  "http://test:8090/twinklemynet/index.php/welcome/addtax";
if(selectState == 'CA'){
   $.ajax({
  url: siteurl,
  context: document.body,
  success: function(data){
$(".checkout-step-five").html(data);
  }
}); 
}
$("#changeSt").val("10");
}

</script>
