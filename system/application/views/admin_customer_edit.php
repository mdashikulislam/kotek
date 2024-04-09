<script type="text/javascript">


  $(document).ready(function() {


$.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");
  


   $("#customerForm").validate({
        rules: {  
		customer_first_name :{   required : true,  minlength:5,  maxlength: 20 },
		customer_last_name :{   required : true,  minlength:5,  maxlength: 20 },
		address :{   required : true,  minlength:5,  maxlength: 100 },
		phone_number:{   required : true,  minlength: 6,  maxlength: 15, NumbersOnly:true  },
		post_code :{   required : true,  maxlength: 15 },
		city :{   required : true,  minlength:3,  maxlength: 40 },
		state :{   required : true,  minlength:2,  maxlength: 40 },
		country :{   required : true,  minlength:2,  maxlength: 40 }
		
		  },
        messages: { 
		customer_first_name: { required: "Please enter first name", minlength:"Please enter at least 5 Alphabets", maxlength:"Please enter no more than 20 Alphabets" },
		customer_last_name: { required: "Please enter last name",  minlength:"Please enter at least 5 Alphabets", maxlength:"Please enter no more than 20 Alphabets" },
		address :{  required: "Please enter address with max length 100 characters"  },
		phone_number: {required : "Please enter mobile number" },
		post_code :{   required : "Please enter post code" },
		city :{   required : "Please enter city" },
		state :{   required : "Please enter state" },
		country :{   required : "Please enter country"}
		}
	});
  });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata =  array('name'=>'customerForm', 'id'=>'customerForm');

echo form_open_multipart('admin/orders/editCustomer', $fdata ); ?>
<table cellpadding="3" cellspacing="0" border="0" class="createNewTable">
	<tr>
    	<td width="150"> <label>Email : </label></td>
        <td width="810"> <input type="text" name="email" value="<?php echo $customer['email']; ?>" size="40" readonly="readonly" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>First name<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="customer_first_name" value="<?php echo $customer['customer_first_name']; ?>" size="30" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Last Name<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="customer_last_name" value="<?php echo $customer['customer_last_name']; ?>" size="30" class="textfield" /> </td>
    </tr>
<tr>
    	<td> <label>Company : </label> </td>
        <td> <input type="text" name="company" value="<?php echo $customer['company']; ?>" size="15" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Mobile No.<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="phone_number" value="<?php echo $customer['phone_number']; ?>" size="15" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Address<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="address" value="<?php echo $customer['address']; ?>" size="50" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Postal Code<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="post_code" value="<?php echo $customer['post_code']; ?>" size="8" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>City<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="city" value="<?php echo $customer['city']; ?>" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>State<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="state" value="<?php echo $customer['state']; ?>" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Country<span class="red">*</span> : </label> </td>
        <td> <input type="text" name="country" value="<?php echo $customer['country']; ?>" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td>&nbsp;  </td>
        <td> <?php echo form_hidden('customer_id',$customer['customer_id']); ?> <input type="submit" value="" class="updatecustomerBtn" title="Update Customer" /> </td>
    </tr>
</table>
		
<?php
echo form_close();
?>
</div>