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

          password: {    required : true 	  }

		  },

        messages: { 	emailLogin: { required: "Please enter your Email"},       password: { required: "Please enter password" }

        }       });

      });

  

  </script>

  

  <div class="top-content-bg"></div>

<div class="content-mid">

	<div class="forgotPwWrapper">

    <h2 class="forgotPwTitle">Login</h2>

        <div class="reg-module">

          <?php

                if ($this->session->flashdata('message')){

                    echo "<div class='status_box'>";

                    echo $this->session->flashdata('message');

                    echo "</div>";

                }

            ?>

            <?php

                if ($this->session->flashdata('error')){

                    echo "<div class='status_box'>";

                    echo $this->session->flashdata('error');

                    echo "</div>";

                }

            ?>
 <?php
                if (isset($_SESSION['temp_product']) && !empty($_SESSION['temp_product'])){
                    echo "<div class='status_box'>";
                    echo "You need to login to view product details.";
                    echo "</div>";
                }
            ?>
          <?php

                $udata = array('name'=>'emailLogin','id'=>'emailLogin','class'=>'textfield','size'=>30);

                $pdata = array('name'=>'password','id'=>'password','class'=>'textfield','size'=>16);

                $attributes = array('class' => 'loginUser', 'id' => 'loginUser');

				// $submitBtn = array('name' => 'submit','id' => 'submitBtn','value' => 'Login','type' => 'submit','class'=>'testClass','content' => 'Login');

                echo form_open("pages/loginCheck",$attributes);

            ?>

          <table cellpadding="0" cellspacing="0" border="0" class="forgotPwTable">

            <tbody>

              <tr>

                <td width="120"><label>Email: </label></td>

                <td width="200"><?php echo form_input($udata); ?></td>

              </tr>

              <tr>

                <td><label>Password: </label></td>

                <td><?php echo form_password($pdata); ?></td>

              </tr>

              <tr>

                <td>&nbsp;</td>

                <td><input type="submit" value="" class="loginBtn" title="Login" /></td>

              </tr>

              <tr>

                <td>&nbsp;</td>

                <td><span class="forPadding"><?php echo anchor("pages/forgotPassword", "Forgot Password"); ?></a></span></td>

              </tr>

              <tr>

                <td>&nbsp;</td>

                <td><span class="forPadding"><?php echo anchor("pages/registration", "New user? Create a new account"); ?></a></span></td>

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