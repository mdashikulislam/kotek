<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");

 
  $("#register").validate({
        rules: {  email:{   required : true, email:true },
		emailconf:{   required : true, email:true },		
		customer_first_name:{required : true, minlength:2,  maxlength: 20 },
		customer_last_name:{required : true, minlength:2,  maxlength: 20 },
		phone_number:{required : true, NumbersOnly:true, minlength:6,  maxlength: 15},
		address:{required : true, minlength:2,  maxlength: 100 },
		post_code:{required : true , maxlength: 10},
		city:{required : true , minlength:2,  maxlength: 20},
		cap:{required : true }

		  },
        messages: { 
		email: { required: "Please enter your Email"},
		emailconf: { required: "Please enter your Email"},
		customer_first_name:{required : "Please enter your first name" },
		customer_last_name:{required : "Please enter your last name"   },
		phone_number:{required : "Please enter phone number"   },
		address:{required : "Please enter your address"   },
		post_code:{required : "Please enter post code"   },
		city:{required : "Please enter city"   },
		cap:{required : "Please enter code in image" }
		  
        }       });
      });
  
  </script>

<div class="top-content-bg"></div>
<div class="content-mid">
  <div class="reg-module">
  <div class="forgotPwWrapper">
    <h2 class="forgotPwTitle"><?php echo $title; ?></h2>
    <?php
	if ($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message').".</div>";
	}?>
    <?php 
			echo '<p>'.$this->lang->line('webshop_regist_plz_here').'</p>'; 
        	echo '<p>'.sprintf( $this->lang->line('genral_login_msg'), anchor( $this->lang->line('webshop_folder').'/login', $this->lang->line('genral_login') ) ).'</p>';
        	if ($this->session->flashdata('msg')|| $this->session->flashdata('error')){
				echo "<div class='status_box'>";
				echo $this->session->flashdata('msg');
				echo $this->session->flashdata('error');
				echo "</div>";
			}
			echo validation_errors('<div class="message error">','</div>');
		?>
    <div style="clear:both;"></div>
    <?php echo form_open("welcome/profile",array('class' => 'expose', 'name'=>'register', 'id'=>'register' )); ?>
    <table cellpadding="0" cellspacing="0" border="0" class="registrationTable">
      <tbody>
        <tr>
          <td width="120"><label>* Email: </label></td>
          <td width="180"><input type="text" name="email" value="<?php echo $customer['email']; ?>" size="40" readonly class="textfield" /></td>
        </tr>
          <tr>
            <td><label> Company: </label></td>
            <td><input type="text" name="company" value="<?php echo $customer['company']; ?>" size="30" class="textfield" /></td>            
          </tr>
        <tr>
          <td><label>* First name: </label></td>
          <td><input type="text" name="customer_first_name" value="<?php echo $customer['customer_first_name']; ?>" size="30" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* Last Name: </label></td>
          <td><input type="text" name="customer_last_name" value="<?php echo $customer['customer_last_name']; ?>" size="30" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* Mobile no: </label></td>
          <td><input type="text" name="phone_number" value="<?php echo $customer['phone_number']; ?>" size="15" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* Address: </label></td>
          <td><input type="text" name="address" value="<?php echo $customer['address']; ?>" size="50" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* Post code: </label></td>
          <td><input type="text" name="post_code" value="<?php echo $customer['post_code']; ?>" size="8" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* City: </label></td>
          <td><input type="text" name="city" value="<?php echo $customer['city']; ?>" size="20" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* State: </label></td>
          <td><input type="text" name="state" value="<?php echo $customer['state']; ?>" size="20" class="textfield" /></td>
        </tr>
        <tr>
          <td><label>* Country: </label></td>
          <td><input type="text" name="country" value="US" size="20" readonly="readonly" class="textfield"  /></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer['customer_id']; ?>" />
            <input type="submit" name="submit" value="" class="updateBtn" title="Update" /></td>
        </tr>
      </tbody>
    </table>


    <?php echo form_close(); ?> </div>
  </div>  
<script type="text/javascript">
  $(document).ready(function() {

  $("#changePassword").validate({
        rules: {  
        password: {    required : true,  minlength:6,  maxlength: 15 },
		repassword: {    required : true,  equalTo: "#password" }
		  },
        messages: { 
		
		password: { required: "Please enter password" },
		repassword: { required: "Please re-enter password" , equalTo: "Re-enter Password and New Password must be same."}
		  
        }       });
      });
  
  </script>

<div>

<div class="forgotPwWrapper">
<?php echo form_open("welcome/updatePass",array('class' => 'expose', 'name'=>'changePassword', 'id'=>'changePassword' )); ?>

<h2 class="forgotPwTitle"> Change Password </h2>
<table cellpadding="0" cellspacing="0" border="0" class="registrationTable">
<tr>
        	<td width="120"><label> New Password </label></td>
            <td width="180"> <input type="password" name="password" id="password" value="" size="20" class="textfield" /> </td>
        </tr>
                <tr>
        	<td><label> Re-enter Password </label></td>
            <td> <input type="password" name="repassword" value="" size="20" class="textfield" /> </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="hidden" name="customerId" id="customer_id" value="<?php echo $customer['customer_id']; ?>" />
            <input type="submit" name="submit" value="" class="updateBtn" title="Update" /></td>
        </tr>
      </tbody>
</table>
 <?php echo form_close(); ?>
</div>

</div>
</div>
<div class="bottom-content-bg"></div>
