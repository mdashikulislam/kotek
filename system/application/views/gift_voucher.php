<?php 
// Gift Voucher Template
?>
<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Gift certificate amount must contain only numbers, + and -.");


$.validator.addMethod("accept", function(value, element, param) {
  return value.match(new RegExp("." + param + "$"));
});

$.validator.addMethod("greaterThan", function( value, element) {

        var val_a = 0;

        return this.optional(element)
            || (value > val_a);
    },"Please enter amount more than zero.");



  	  $("#giftcart").validate({
        rules: {
          fromNm:{
		   required : true,  accept: "[a-zA-Z]+",
            noSpecialChars : true,maxlength: 40, minlength: 6		  
		  },// simple rule, converted to {required:true}
          receipientNm: { required : true,  accept: "[a-zA-Z]+", maxlength: 40, minlength: 6, noSpecialChars : true	
		  },
		  receipientEmail: {
		    required : true, email: true	
		  },
			 messageContent: {
		    required : true, maxlength: 40, minlength: 6	
		  },
		  amount:{
			   required : true, NumbersOnly: true, greaterThan:true			  
			  }
		  
        },
        messages: {
		fromNm: { required: "Please enter your name", accept: "Please enter only alphabetic characters"},
       receipientNm: { required: "Please enter recipient name",  accept: "Please enter only alphabetic characters" },
	   receipientEmail: { required: "Please enter valid recipient email" },
	   messageContent: { required: "Please enter short message" },
	   amount:{required: "Please enter amount" }
        }
		
      });
  
    });
  </script>


<div class="gift-content">
  <div class="giftcontent-top"></div>
  <div class="giftcontent-mid">
  	<h1><strong>gift</strong>certificates</h1>
    <div class="midcontent">
    	<img src="./images/gift-pack.jpg" width="168" height="243" border="0" style="float:left;" />
        <div class="taglines">
        	<p><strong><em>Give the thrilled mom-to-be an e-certificate<br />that lets her customize a dreamy crib canopy.</em></strong></p>
			<p>They can be emailed in any denomination you choose,<br />with a gift certificate code that can be used in our website,<br />along with a personal message.</p>
        </div>
    </div>
	<div class="col">
    	<?php
            if ($this->session->flashdata('conf_msg')){ //change!
                echo "<div class='message'>";
                echo $this->session->flashdata('conf_msg');
                echo "</div>";
            }
            ?>
          <?php
			 // echo "<img src='".$product['image']."' border='0' align='left'/>\n";
			 // echo "<h2>".$product['name']."</h2>\n";
			  //echo "<p>".$product['longdesc'] . "<br/>\n"; 
			  //echo anchor('welcome/giftcart/'.$product['id'],'add to cart') . "</p>\n";
			?>
		<div style="clear:both;"></div>
		<form name="giftcart" id="giftcart"  action="<?php echo site_url('welcome/giftcart/'.$product['id'])?>" method="post">
        <div class="col-left">
        	<p><strong>e-certificate</strong></p>
            <p><span>gift certificate via e-mail</span></p>
        </div>
        <div class="col-center-new">
        	<p style="font-size:11px;">All fields are mandatory.</p>
            <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
            	<tr>
                	<td width="10">&nbsp;</td>
                    <td colspan="2">enter amount</td>                    
                </tr>
                <tr>
                	<td>$</td>
                    <td colspan="2"><input type="text" name="amount" style="width:124px;" id="amount" value=""/></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                	<td>&nbsp;</td>
                    <td align="right" width="252">from</td>
                    <td width="218"><input type="text" name="fromNm" id="fromNm" value=""/></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td align="right">Recipient name</td>
                    <td><input type="text" name="receipientNm" id="receipientNm" value=""/></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td align="right">Recipient email</td>
                    <td><input type="text" name="receipientEmail" id="receipientEmail" value=""/></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td align="right">Gift message</td>
                    <td><textarea name="messageContent" id="messageContent" cols="30" rows="5"></textarea></td>
                </tr>
              </tbody>
        	</table>
        </div>
        <div class="col-right-new">
        	<input type="submit" name="addtoCart" value="add to basket" />
        </div>
        </form>
    </div>
  </div>
  <div class="giftcontent-bottom"></div>
</div>