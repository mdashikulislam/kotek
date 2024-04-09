<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");

 
  $("#contactUs").validate({
        rules: {  email:{   required : true, email:true },		
       	name:{required : true, minlength:6,  maxlength: 20 },
		message:{required : true, minlength:2,  maxlength: 400 },
		captcha:{required : true }

		  },
        messages: { 
		email: { required: "Please enter your Email"},
		name:{required : "Please enter your name" },
		message:{required : "Please enter message"   },
		captcha:{required : "Please enter captcha code"   }
		
		  
        }       });
      });
  
  </script>
 
<div class="content-mid">
	<h1 class="productListTitle">Contact Us</h1>
    <div class="productListWrapper">    
  	<?php
	if ($this->session->flashdata('subscribe_msg')){
		echo "<div class='message'>";
		echo $this->session->flashdata('subscribe_msg');
		echo "</div>";
	}
	?>
	  <?php echo validation_errors(); ?> 
      <?php $fdata = array('name'=>'contactUs', 'id'=>'contactUs'); echo form_open("pages/message", $fdata); ?>
      <?php //echo form_fieldset('Send Message'); ?>
      <table cellpadding="3" cellspacing="0" border="0" class="productListTable">
      	<tr>
        	<td colspan="2"> <span> Fields marked with <span class="red">*</span> are mandatory. </span> </td>
        </tr>
        <tr>
        	<td width="150"> <label>Name<span class="red">*</span> :</label></td>
            <td width="810"> <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" size="40" class="textfield" /> </td>
        </tr>
        <tr>
        	<td> <label>Email<span class="red">*</span> :</label></td>
            <td> <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" size="40" class="textfield" /> </td>
        </tr>
        <tr>
        	<td> <label>Your message<span class="red">*</span> :</label></td>
            <td> <textarea name="message" id="message" rows="5" cols="50"></textarea> </td>
        </tr>
        <tr>
        	<td> <label>Are you human?<span class="red">*</span> :</label> </td>
            <td> <?php echo "<p>$cap_img</p>" ;?><input type="text" name="captcha" value="" size="40" class="textfield" /> </td>
        </tr>
        <tr>
        	<td> &nbsp; </td>
            <td> <input type="submit" value="" title="Submit" class="submitBtn" /> </td>
        </tr>
    </table>
        
      
      
      
      
      <?php echo form_fieldset_close(); ?> <?php echo form_close(); ?> 
      </div>
</div>