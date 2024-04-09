<?php

//var_export($productList);

$category = $this->MCats->getCategory($searchGroup);

?>
<script type="text/javascript" src="./js/avoid.js" ></script>
<style type="text/css">
*.unselectable {
   -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;
   user-select: none;
}

</style>
<div class="breadcrumb"><span class="homeLink"><a href="#" title="Home">Home</a></span> <span class="textBlue">Product</span> <span class="textBlue"><?php if(!empty($category['name'])) { ?> <?=$category['name']?> <?php } ?></span> </div>

<div id="content" unselectable="on" class="unselectable">

	

    <?php if(!empty($category['name'])) { ?> <h1 class="productListTitle">Search Result for <?=$category['name']?></h1> <?php } ?>

     <div class="productListWrapper">

     	<table cellpadding="3" cellspacing="0" border="0" class="productListTable">

        <?php if(!empty($productList)){ ?>

        	<tr>

				
  <th width="120"> Part Number </th>
                <th width="120"> Product </th>

                <th width="120"> Make </th>

                <th width="80"> Year </th>

                <th width="100"> Model </th>

                <th width="300"> Description </th>

              
				 <th width="150">&nbsp;</th>
              </tr>

              

            <?php $xx =1; foreach($productList as $key=>$value) {

			if($xx%2 == 0){$cls ="class='even'";}else{$cls ="class='odd'";}

			?>

            <tr <?=$cls?> >

            <td align="center"> <?=$value['part_number']?> </td>

            <td align="left"> <?=$value['name']?> </td>

         

            <td align="left"> <?=$value['maker_name']?> </td>

            <td align="center"> <?=$value['year_from']."-".$value['year_to']?> </td>

            <td align="center"> <?=$value['model_name']?> </td>

            <td align="left"> <?=$value['shortdesc']?>  </td>

            
            <td align="center"> <a href="<?php echo base_url(); ?>pages/product/<?=$value['id']?>" title="<?=$value['name']?>" target="_blank" >Click here for enquiry </a></td>
             </tr>

            <?php $xx++; } ?>

         

             

            <?php }else{

            ?>

            <tr>

            <td colspan="6"> No product found </td>

            </tr>

            <?php }?>

        </table>

        <div>   <?php echo $this->pagination->create_links(); ?> </div>

    </div>

    

</div>

<div style="clear:both;"></div>

<script type="text/javascript">

  $(document).ready(function() {



$.validator.addMethod("noSpecialChars", function(value, element) {

      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);

  }, "This field must contain only letters, numbers, or underscore.");



 $.validator.addMethod("NumbersOnly", function(value, element) {

        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);

    }, "Phone must contain only numbers, + and -.");



 

  $("#contactRequest").validate({

        rules: {  email:{   required : true, email:true },		

       	name:{required : true, minlength:6,  maxlength: 20 },

		message:{required : true, minlength:2,  maxlength: 400 },
        phoneno:{required : true, minlength:4,  maxlength: 10 }



		  },

        messages: { 

		email: { required: "Please enter your Email"},

		name:{required : "Please enter your name" },

		message:{required : "Please enter message"   },
		phoneno:{required : "Please enter phone number" }

		

		

		  

        }       });

      });

  

  </script>



<div class="newSearchWrapper">

    	<h2 class="forgotPwTitle"> Didn't find what you were looking for? </h2>

 	    <div style="text-align:center;"> Please tell us what were you looking for?</div>

            <div id="contactUsForm">

                <form name="contactRequest" id="contactRequest" action="<?php echo base_url(); ?>pages/contactRequest" method="post" />

                <table cellpadding="4" cellspacing="4" class="registrationTable">

                	<tr>

                    	<td width="150"> <label> Name:<span class='red'>*</span> </label> </td>

                        <td width="200"> <input type="text" name="name" id="name" value="" class="textfield" /> </td>

                    </tr>

                    <tr>

                    	<td> <label> Email:<span class='red'>*</span> </label> </td>

                        <td> <input type="text" name="email" id="email" value="" class="textfield" /> </td>

                    </tr>
                    <tr>
                    	<td> <label> Phone no:<span class='red'>*</span> </label> </td>
                        <td> <input type="text" name="phoneno" id="phoneno" value="" class="textfield" /> </td>
                    </tr>

                    <tr>

                    	<td> <label> Message:<span class='red'>*</span></label> </td>

                        <td> <textarea name="message" id="message" rows="5" cols="25" class="textarea" ></textarea> </td>

                    </tr>

                    <tr>

                    	<td>&nbsp;  </td>

                        <td> <input type="submit" name="submit" id="submit" value="" class="submitBtn" title="Submit" /> </td>

                    </tr>

                </table>

                </form>

            </div>

        </div>





<div style="clear:both;">&nbsp;</div>