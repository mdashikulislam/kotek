<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Mobile number must contain only numbers, + and -.");

 
  $("#register").validate({
        rules: {  email:{   required : true, email:true },		
        password: {    required : true,  minlength:6,  maxlength: 15 },
		cpassword: {    required : true,  equalTo: "#password" },
		customer_first_name:{required : true, minlength:2,  maxlength: 20 },
		customer_last_name:{required : true, minlength:2,  maxlength: 20 },
		phone_number:{required : true, NumbersOnly:true, minlength:6,  maxlength: 15 },
		address:{required : true, minlength:6,  maxlength: 100 },
		post_code:{required : true, maxlength: 15 },
		city:{required : true },
		state :{   required : true,  minlength:5,  maxlength: 40 },
		country :{   required : true,  minlength:2,  maxlength: 40 },
		cap:{required : true }

		  },
        messages: { 
		email: { required: "Please enter your Email"},		
		password: { required: "Please enter password" },
		cpassword: { required: "Please confirm password" , equalTo: "Confirm Password and Password must be same."},
		customer_first_name:{required : "Please enter your first name" },
		customer_last_name:{required : "Please enter your last name"   },
		phone_number:{required : "Please enter mobile number"   },
		address:{required : "Please enter your address"   },
		post_code:{required : "Please enter post code"   },
		city:{required : "Please enter city"   },
		state :{   required : "Please enter state" },
		country :{   required : "Please enter country" },
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
			echo '<p>'.$this->lang->line('webshop_regist_plz_here').'</p>'; 
        	echo '<p>'.sprintf( $this->lang->line('genral_login_msg'), anchor( $this->lang->line('webshop_folder').'/login', $this->lang->line('genral_login') ) ).'</p>';
        	if ($this->session->flashdata('msg')|| $this->session->flashdata('error') || !empty($messageShow)){
				if(!empty($messageShow)){
				echo "<div class='status_box'>";
				echo $messageShow;
				echo "</div>";
				}else{
					
					echo "<div class='status_box'>";
				echo $this->session->flashdata('msg');
				echo $this->session->flashdata('error');
				echo "</div>";
					}
			}
			echo validation_errors('<div class="message error">','</div>');
		?>
        <div style="clear:both;"></div>
        <?php
		if ($this->session->flashdata('message')){
			echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}?>
        <div style="clear:both;"></div>
        <?php echo form_open("pages/registration",array('class' => 'expose', 'name'=>'register', 'id'=>'register' )); ?>
        <table cellpadding="0" cellspacing="0" border="0" class="registrationTable">
        <tbody>
          <tr>
            <td width="200"><label>* Email: </label></td>
            <td width="178"><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" size="40" class="textfield" /></td>            
          </tr>
          
          <tr>
          	<td><label>* Password: </label></td>
            <td><input type="password" name="password"  id="password" value="" size="20" class="textfield" /></td>            
          </tr>
          
          <tr>
          	<td><label>* Confirm Password: </label></td>
            <td><input type="password" name="cpassword" id="cpassword" value="" size="20" class="textfield" /></td>
          </tr>
           <tr>
            <td><label> Company: </label></td>
            <td><input type="text" name="company" value="<?php if(isset($_POST['company'])) echo $_POST['company'] ?>" size="30" class="textfield" /></td>            
          </tr>
          <tr>
            <td><label>* First name: </label></td>
            <td><input type="text" name="customer_first_name" value="<?php if(isset($_POST['customer_first_name'])) echo $_POST['customer_first_name'] ?>" size="30" class="textfield" /></td>            
          </tr>
          
          <tr>
          	<td><label>* Last Name: </label></td>
            <td><input type="text" name="customer_last_name" value="<?php if(isset($_POST['customer_last_name'])) echo $_POST['customer_last_name'] ?>" size="30" class="textfield" /></td>
          </tr>
          
          <tr>
          	<td><label>* Mobile No: </label></td>
            <td><input type="text" name="phone_number" value="<?php if(isset($_POST['phone_number'])) echo $_POST['phone_number'] ?>" size="15" class="textfield" /></td>
          </tr>
          
          <tr>
            <td><label>* Address: </label></td>
            <td><input type="text" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address'] ?>" size="50" class="textfield" /></td>
          </tr>
          
          <tr>
          	<td><label>* Post code: </label></td>
            <td><input type="text" name="post_code" value="<?php if(isset($_POST['post_code'])) echo $_POST['post_code'] ?>" size="8" class="textfield" /></td>
          </tr>
          
          <tr>            
            <td><label>* City: </label></td>
            <td><input type="text" name="city" value="<?php if(isset($_POST['city'])) echo $_POST['city'] ?>" size="20" class="textfield" /></td>            
          </tr>
          
          <tr>
          	<td><label>* State: </label></td>
            <td><input type="text" name="state" value="<?php if(isset($_POST['state'])) echo $_POST['state'] ?>" size="20" class="textfield" /></td>
          </tr>
          
          <tr>
          	<td><label>* Country: </label></td>
            <td><input type="text" name="country" value="<?php if(isset($_POST['country'])) echo $_POST['country'] ?>" size="20" class="textfield" /></td>
          </tr>
          
          <tr>
            <td><label>* Are you human?</label></td>
            <td align="left"><input type="text" name="captcha" value="" size="20" class="textfield" /><div style="clear:both; padding-top:10px;" align="left";><?php echo $cap_img; ?></div></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="" class="registerBtn" title="Register" /></td>
          </tr>
        </tbody>
        </table>
    	<?php echo form_close(); ?>
      </div>
    </div>
</div>
<div class="bottom-content-bg"></div>