<script type="text/javascript">


  $(document).ready(function() {
   $("#adminUser").validate({
        rules: {  
		email :{   required : true, email:true },
		username :{   required : true,  minlength:2,  maxlength: 20 },
		password :{    minlength:6,  maxlength: 15 }
		repassword: {  equalTo: "#password" },
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
echo form_open('admin/admins/edit', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='uname'>Username<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'username','id'=>'uname','class'=>'textfield','size'=>25, 'value'=>$admin['username']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='email'>Email<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'email','id'=>'email','class'=>'textfield','size'=>50, 'value'=>$admin['email']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='pw'>Password<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'password','id'=>'password','class'=>'textfield','size'=>25, 'value'=>$admin['password']);
echo form_password($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='pw'>Re Password<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'repassword','id'=>'repassword','class'=>'textfield','size'=>25, 'value'=>$admin['password']);
echo form_password($data) ."</td>";
echo "</tr>";


echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $admin['status']) ."</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo form_hidden('id',$admin['id']);
echo "<input type='submit' value='' class='updateAdminBtn' title='Update Admin' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>