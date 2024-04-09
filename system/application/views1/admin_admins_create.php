<script type="text/javascript">


  $(document).ready(function() {
   $("#adminUser").validate({
        rules: {  
		email :{   required : true, email:true },
		username :{   required : true,  minlength:2,  maxlength: 20 },
		password :{   required : true,  minlength:6,  maxlength: 15 },
		repassword: {    required : true,  equalTo: "#password" }
		  },
        messages: { 
		email: { required: "Please enter email id" },
		username: { required: "Please enter name" },
		password :{  required: "Please enter password"  },
		repassword: { equalTo: "Confirm Password and Password must be same."}
		
		}
	});
  });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata = array('name'=>'adminUser', 'id'=>'adminUser');
echo form_open('admin/admins/create', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='uname'>Username<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'username','id'=>'uname','class'=>'textfield','size'=>25);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='email'>Email<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'email','id'=>'email','class'=>'textfield','size'=>50);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='pw'>Password<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'password','id'=>'password','class'=>'textfield','size'=>25);
echo form_password($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='pw'>Confirm Password<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'repassword','id'=>'repassword','class'=>'textfield','size'=>25);
echo form_password($data) ."</td>";
echo "</tr>";


echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit' value='' class='createAdminBtn' title='Create Admin' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>