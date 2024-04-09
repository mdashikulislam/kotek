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

$filename = $_SERVER['DOCUMENT_ROOT']."/kotek/images/product/".$product['image'];
if (!file_exists($filename)) {
$product['image'] ="noimage.jpg";
}
?>
<div class="breadcrumb"><span class="homeLink"><a href="<?=base_url();?>" title="Home">Home</a></span> <span class="textBlue">Product</span> <span class="textBlue"> <?=$category['name']?> </span>  <span class="currentProduct"><?php echo $product['name']; ?></span> </div>
<div class="productDetailWrapper">
	<div class="leftThumb"> 
    	<div id="thumbnail"> <img src="<?=thumbnailer($product['image'],"/kotek/images/product/",200, 'auto')?>" /> <!-- <img src="<?php echo base_url(); ?>thumb.php?img=<?php echo base_url(); ?>images/product/<?=$product['image'] ?>" border="0" /> --> </div>
        <a href="<?=base_url()."images/product/".$product['image']?>" rel="facebox" class="viewLargeImage" title="View large image"> View large image </a>
    </div>
    <div class="rightDetails">
        <h1 class="productTitle"> <?php echo $product['name']; ?> </h1>
        <p class="desciption"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
        <p class="productPrice"> Price: <span class="productAmount">$<?=$product['price']?></span> </p>
        <a class="orderInfoBtn" title="Order Information" href="<?= base_url();?>index.php/pages/distributor"> </a>
        <div class="productDetailTableWrapper">
        	<table cellpadding="3" cellspacing="0" border="0" class="productDetailTable">
            	<tr>
                	<th colspan="2" width="712"> Product Specification </td>
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
				<?	 $xx++;}				
				}
				?>
            </table>
        </div>
    </div>
</div>