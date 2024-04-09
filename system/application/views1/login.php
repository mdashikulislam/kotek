<script type="text/javascript">
  $(document).ready(function() {
  $("#adminlogin").validate({
        rules: {  username:{   required : true  },
          password: {    required : true 	  }
		  },
        messages: { 	username: { required: "Please enter username"},       password: { required: "Please enter password" }
        }       });
      });
  
  </script>


<div class="top-content-bg"></div>
<div class="content-mid">
  <div class="reg-module">
  <div class="forgotPwWrapper">
  	<h2 class="forgotPwTitle">Please login to Access the Dashboard</h2>
    
    <?php
    if ($this->session->flashdata('error')){ 
        echo "<div class='message'>";
        echo $this->session->flashdata('error');
        echo "</div>";
    }
    ?>
    <?php
		$udata = array('name'=>'username','id'=>'u','class'=>'textfield','size'=>15);
		$pdata = array('name'=>'password','class'=>'textfield','size'=>15);
		$fdata = array('name'=>'adminlogin','id'=>'adminlogin');
		echo form_open("welcome/verifyAdmin", $fdata);
	?>
    <table cellpadding="0" cellspacing="0" border="0" class="forgotPwTable">
      <tbody>
        <tr>
          <td width="100"><label>Username: </label></td>
          <td><?php echo form_input($udata); ?></td>
        </tr>
        <td colspan="2">&nbsp;  </td>
        <tr>
          <td><label>Password: </label></td>
          <td><?php echo form_password($pdata); ?></td>
        </tr>
        <td colspan="2">&nbsp;  </td>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" value="" class="loginBtn" title="Login" /></td>
        </tr>
      </tbody>
    </table>
    <?php
		echo form_close();
		?>
    </div>
  </div>
</div>
<div class="bottom-content-bg"></div>