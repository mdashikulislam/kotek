<script type="text/javascript">
  $(document).ready(function() {
  $("#forgotPass").validate({
        rules: {  email:{   required : true, email:true  }
         
		  },
        messages: { 	email: { required: "Please enter email id"}
        }       });
      });
  
  </script>
  
  <div class="top-content-bg"></div>
<div class="content-mid">
    <div class="reg-module">
    	<div class="forgotPwWrapper">
            <h2 class="forgotPwTitle">Forgot Password</h2>
            <?php
                        if ($this->session->flashdata('error')){ 
                            echo "<div class='msg msg-error'><p>";
                            echo $this->session->flashdata('error');
                            echo "</p></div>";
                        }
                            if ($this->session->flashdata('logout')){ 
                           echo "<div class='msg msg-ok'><p>";
                            echo $this->session->flashdata('logout');
                            echo "</p></div>";
                        }
                        if ($this->session->flashdata('message')){ 
                           echo "<div class='msg status_box'><p>";
                            echo $this->session->flashdata('message');
                            echo "</p></div>";
                        }
                
                        ?>
              <?php
                        $udata = array('name'=>'username','id'=>'u','size'=>15, 'class'=>'txtfield');
                        $pdata = array('name'=>'password','id'=>'p','size'=>15,  'class'=>'txtfield');
                        
                        $fdata = array('name'=>'forgotPass','id'=>'forgotPass');
                        echo form_open("welcome/forgotPassword", $fdata);
                        ?>
              <table cellpadding="0" cellspacing="0" border="0" class="forgotPwTable">
                <tbody>
                  <tr>
                    <td width="220"><label>Enter your email address: </label></td>
                    <td><input type="text" id="email" name="email" value="" class="textfield" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" id="submit" value="" alt="" class="submitBtn" title="Submit" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span class="forPadding"><a href="<?php echo base_url().'welcome/login'; ?>" title="Back to Login">Back to Login</a></span></td>
                  </tr>
                </tbody>
              </table>
              <?php echo form_close(); ?> 
          </div>
        </div>
</div>
<div class="bottom-content-bg"></div>