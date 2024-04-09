<h1><?php echo $title;?></h1>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($products)){
	echo '<table id="tablesorter" class="tablesorter" border="0" cellspacing="0" cellpadding="3" width="100%">';
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>&nbsp;</th><th>Ordere ID</th>\n<th>Customer Name</th><th>Customer Email</th><th>Payment Status</th><th>Purchase Amount</th><th>Order Status</th><th>Action</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	

	foreach ($products as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".form_checkbox('p_id[]',$list['order_id'],FALSE)."</td>";
		echo "<td align='center'>".$list['order_id']."</td>\n";
		echo "<td align='center'>".$list['customerName']."</td>\n";
		
		echo "<td align='center'>".$list['customerEmail']."</td>\n";
		
		echo "<td align='center'>".$list['paymentStatus']."</td>\n";
		
		echo "<td align='center'>".$list['totalAmout']."</td>\n";
		echo "<td align='center'>"; ?>
		<select name='orderStatus' id='orderSttus' onchange='updateOrderStatus(this.value,<?php echo $list['order_id'] ?>);'>
        <option value='pending' <?php if($list['orderStatus'] == 'pending') echo "selected"; ?>>Pending</option>
        <option value='completed'  <?php if($list['orderStatus'] == 'completed') echo "selected"; ?>>Completed</option>
        <option value='cancelled'  <?php if($list['orderStatus'] == 'cancelled') echo "selected"; ?>>Cancelled</option></select> <?
		echo "</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/orders/viewOrder/'.$list['order_id'],'view');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</tbody></table>";
	echo form_close();
}
?>