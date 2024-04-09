<h1><?php echo $title;?></h1>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($products)){
	echo '<table id="tablesorter" class="tablesorter" border="0" cellspacing="0" cellpadding="3" width="100%">';
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>&nbsp;</th><th>ID</th><th>Customer </th><th>Secure Code</th><th>Purchase price</th><th>Remaining Amount</th><th>Status</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	

	foreach ($products as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".form_checkbox('p_id[]',$list['id'],FALSE)."</td>";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='center'>".$this->MCustomers->customerDetails($list['customer_id'])."</td>\n";
		echo "<td align='center'>".$list['secure_code']."</td>\n";
		
		echo "<td align='center'>".$list['purchase_price']."</td>\n";
		
		echo "<td align='center'>".$list['current_price']."</td>\n";
		
		echo "<td align='center'>".$list['status']."</td>\n";

		echo "</tr>\n";
	}
	echo "</tbody></table>";
	echo form_close();
}
?>