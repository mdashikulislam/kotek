<h1><?php echo $title;?></h1>

<div class="vieworder-table">
<table cellpadding="0" cellspacing="0" border="0">
	<tbody>
    	<tr>
        	<td width="120"><strong>Customer Name:</strong></td>
            <td bgcolor="#DFF3FD"><?php echo $orders['customerName']; ?></td>
        </tr>
        <tr>
        	<td><strong>Customer Email:</strong></td>
            <td><?php echo $orders['customerEmail']; ?></td>
        </tr>
	</tbody>
</table>
<table cellpadding="0" cellspacing="0" border="0">
	<tbody>
        <tr>
        	<td width="190"><strong>Customer Billing Address:</strong></td>
            <td bgcolor="#DFF3FD"><?php echo $orders['customerBillingAddress']; ?></td>
        </tr>
        <tr>
            <td><strong>Customer Shipping Address:</strong></td>
            <td><?php echo $orders['customerDeliveryAddress']; ?></td>
        </tr>
	</tbody>
</table>    
<table cellpadding="0" cellspacing="0" border="0">
	<tbody>    
		<tr>
        	<td width="120"><strong>Payment Status:</strong></td>
            <td bgcolor="#DFF3FD"><?php echo $orders['paymentStatus']; ?></td>
        </tr>
        <tr>
        	<td><strong>Payment Method:</strong></td>
            <td><?php echo $orders['paymentMethod']; ?></td>
        </tr>
        <tr>
        	<td><strong>Order Status:</strong></td>
            <td bgcolor="#DFF3FD"><?php echo $orders['orderStatus']; ?></td>
        </tr>
        <tr>
        	<td><strong>Shipping Method:</strong></td>
            <td><?php echo $orders['shippingMethod']; ?></td>
        </tr>
        <tr style="text-transform : none;">
        	<td><strong>Purchase Data:</strong></td>
            <td bgcolor="#DFF3FD"><?php echo date('d/m/Y', strtotime($orders['purchaseDate'])); ?></td>
        </tr>
        </tbody>
	</table>
        <?php $cartDetails = $ordersDetails;

        if (count($cartDetails)){
			foreach ($cartDetails as $PID => $row){	
			
			
				$product =  $this->MProducts->getProductOrder($row['product_id']);
				if(!empty($product)){
				$proname  = $product['name'];
				
				$product_details  = unserialize($row['productSpecification']); 
				$quantity  = $row['quantity']; 
				//var_export($product_details);
				
			//	if($row['productid'] == 20){$product['price'] = $row['price']; }
			$siteroot = $this->config->item('base_url');

				?>
		<table cellpadding="0" cellspacing="0" border="0">
        <tbody>    
            <tr>
                <td width="120"><strong>Product Image:</strong></td>
                <td bgcolor="#DFF3FD"><img src="<?php echo $siteroot.$product['thumbnail']; ?>" style="border:1px solid #7b5722; padding:2px;" width="70" height="70"  /></td>
            </tr>
            <tr>
                <td width="120"><strong>Description:</strong></td>
                <td>
                    <?php echo $proname; ?>
                    <?
                    if(isset($product_details['colors'])){ echo "<br />Colors: ".$this->MProducts->getColor($product_details['colors']);}
                    if(isset($product_details['fonts'])){ echo "<br />Font: ".$this->MProducts->getFont($product_details['fonts']); }
                    if(isset($product_details['textColor'])){ echo "<br />Text color: ".$product_details['textColor']; }
                    if(isset($product_details['textLine1'])){  echo "<br />Text: ".$product_details['textLine1']."<br/>".$product_details['textLine2'];}
                    if(isset($product_details['lace'])  ){ if($product_details['lace'] == 1){  echo "Lace: Yes";}else{ echo "<br />Lace: No"; }}
                    ?>
				</td>
            </tr>
            <tr>
                <td width="120"><strong>Price:</strong></td>
                <td bgcolor="#DFF3FD">$<?php echo $row['product_price']; ?></td>
            </tr>
             <tr>
                <td width="120"><strong>Quantity:</strong></td>
                <td><?php echo $quantity; ?></td>
            </tr>
             <tr>
                <td width="120"><strong>Subtotal:</strong></td>
                <td bgcolor="#DFF3FD">$<?php echo number_format(($row['product_price']*$row['quantity']),2); ?></td>
            </tr>
	
    <?php } } } ?>
           
        </div>
    </div>
        </td>
        </tr>
    </tbody>
</table>
</div>
