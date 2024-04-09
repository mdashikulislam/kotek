<script type="text/javascript">


  $(document).ready(function() {


$.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");
  


   $("#distributorForm").validate({
        rules: {  
		distributor_title :{   required : true,  minlength:5,  maxlength: 20 },
                email:{   required : true, email:true},
		address :{   required : true,  minlength:5,  maxlength: 100 },
		phone_number:{   required : true,  minlength: 6,  maxlength: 15, NumbersOnly:true  },
		post_code :{   required : true,  minlength:3,  maxlength: 40 },
		city :{   required : true,  minlength:3,  maxlength: 40 },
		state :{   required : true,  minlength:5,  maxlength: 40 },
		country :{   required : true,  minlength:2,  maxlength:40 }
		
		  },
        messages: { 
		distributor_title: { required: "Please enter title", minlength:"Please enter at least 5 Alphabets", maxlength:"Please enter no more than 20 Alphabets" },
                email:{ required: "Please enter email id" },
		address :{  required: "Please enter address with max length 100 characters"  },
		phone_number: {required : "Please enter Phone number" },
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
$fdata =  array('name'=>'distributorForm', 'id'=>'distributorForm');

echo form_open_multipart('admin/distributors/createDistributor', $fdata ); ?>
<table cellpadding="3" cellspacing="0" border="0" class="createNewTable">
	<tr>
    	<td width="150"> <label>Name<span class="red">*</span> :</label> </td>
        <td width="810"> <input type="text" name="distributor_title" value="" size="30" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Email<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="email" value="" size="40" class="textfield"  /> </td>
    </tr>
    <tr>
    	<td> <label>Phone No<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="phone_number" value="" size="15" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Address<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="address" value="" size="50" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Post code<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="post_code" value="" size="8" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>City<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="city" value="" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>State<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="state" value="" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Country<span class="red">*</span> :</label> </td>
        <td> <input type="text" name="country" value="" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td> <label>Website :</label> </td>
        <td> <input type="text" name="website" value="" size="20" class="textfield" /> </td>
    </tr>
    <tr>
    	<td>&nbsp;  </td>
        <td> <input type="submit" value="" class="createDistriBtn" title="Create Distributor" /> </td>
    </tr>
</table>
<?
echo form_close();
?>





</div>