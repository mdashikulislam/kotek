<?php



// get carmodel name



$carmodel = $this->MCarmodel->getCarmodel($product['model']);

$make = $carmodel['maker'];

$maker = $this->MMaker->getMakerName($make);

$category = $this->MCats->getCategory($product['category_id']);

$image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');









if(empty($product['image']))

{

	$product['image'] ="noimage.jpg";

}



$img= explode('.',$product['image']);



if(isset($img[1]) && !in_array($img[1],$image_extensions_allowed))

{

 $product['image'] ="noimage.jpg";

}



$filename = $_SERVER['DOCUMENT_ROOT']."/images/product/".$product['image'];

if (!file_exists($filename)) {

$product['image'] ="noimage.jpg";

}

?>

<div class="breadcrumb"><span class="homeLink"><a href="<?=base_url();?>" title="Home">Home</a></span> <span class="textBlue">Product</span> <span class="textBlue"> <?=$category['name']?> </span>  <span class="currentProduct"><?php echo $product['name']; ?></span> </div>

<div class="productDetailWrapper">

	<div class="leftThumb"> 

    	<div id="thumbnail"> <img src="<?=thumbnailer($product['image'],"/images/product/",200, 'auto')?>" /> <!-- <img src="<?php echo base_url(); ?>thumb.php?img=<?php echo base_url(); ?>images/product/<?=$product['image'] ?>" border="0" /> --> </div>

        <a href="<?=base_url()."images/product/".$product['image']?>" rel="facebox" class="viewLargeImage" title="View large image"> View large image </a>

    </div>

    <div class="rightDetails">

        <h1 class="productTitle"> <?php echo $product['name']; ?> (<?php echo $product['part_number']; ?>)</h1>

        <p class="desciption"> <?php echo $product['longdesc'];  ?> </p>

    <?php if(!empty($product['price'])) {?>    <!--p class="productPrice"> Price: <span class="productAmount">$<?=$product['price']?></span> </p--> <?php } ?>
<div>
        <a class="orderInfoBtn" title="Order Information" href="<?= base_url();?>pages/distributor"> </a>
<?php
                if ($this->session->flashdata('subscribe_msg')){
                  
                    echo $this->session->flashdata('subscribe_msg');
                  
                }else{ ?>   <span onclick="jQuery('#productRequest').show();" class="product_reqest_btn fl" >&nbsp;</span>      <?php }
            ?>
    </div>
    <div class="clr">&nbsp;</div>
<div class="newSearchWrapper" style="display:none;" id="productRequest">
 	    <h2 class="forgotPwTitle" > Send your request for <?=$product['name']?></h2>
            <div id="contactUsForm">
                <form name="contactRequest" id="contactRequest" action="<?php echo base_url(); ?>pages/requestProductDetails" method="post" >
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
                        <td> 
                        <input type="hidden" name="productid" id="productid" value="<?=$product['id']?>" />
                        <input type="hidden" name="productName" id="productName" value="<?=$product['name']?>" />
                        <input type="submit" name="submit" id="submit" value="" class="submitBtn" /> </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>    
        
        <div class="productDetailTableWrapper">

        	<table cellpadding="3" cellspacing="0" border="0" class="productDetailTable">

            	<tr>

                	<th colspan="2" width="712"> Product Specification </th>

                </tr>

                <tr class="odd">

                	<td class="bold" width="100"> Group:  </td>

                    <td class="normal" width="612"> <?=$category['name']?> </td>

                </tr>

                <tr class="even">

                	<td class="bold"> Make: </td>

                    <td class="normal"> <?=$maker?> </td>

                </tr>

                <tr class="odd">

                	<td class="bold" width="100"> Year:  </td>

                    <td class="normal" width="612"> <?=$product['year_from']."-".$product['year_to']?> </td>

                </tr>

                <tr class="even">

                	<td class="bold"> Model: </td>

                    <td class="normal"> <?=trim($carmodel['title'])?> </td>

                </tr>

                

                <tr class="odd">

                	<td class="bold" width="100"> Description:  </td>

                    <td class="normal" width="612"> <?=$product['shortdesc']?> </td>

                </tr>

                 <?php $dimensions = $this->MDimensions->getAllProductDimensions($product['id']);

				

				

				if(!empty($dimensions))

				{$xx =1; 

				foreach($dimensions as $k1=>$v1){	

				if($xx%2 == 0){$cls ="class='odd'";}else{$cls ="class='even'";}

				$dimension_nm = $this->MDimensions->getDimensions($v1['dimension_id']);

					?>

				<tr <?=$cls?>>

                	<td class="bold"><?=$dimension_nm['name']?>: </td>

                    <td class="normal"><?=$v1['dimension_value']; ?>  </td>

                </tr>

				<?php	 $xx++;}

				}

				?>

            </table>

        </div>

    </div>

</div>