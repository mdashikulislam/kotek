<h1 class="pageTitle"><?php echo $title;?></h1>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}
if (count($products)){
	echo '<table id="tablesorter" class="tablesorter" border="0" cellspacing="0" cellpadding="3" width="100%">';
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Email </th><th>Address</th><th>Phone no</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";

foreach ($products as $key => $list){
		echo "<tr valign='top'>\n";
		//echo "<td align='center' >".form_checkbox('p_id[]',$list['customer_id'],FALSE)."</td>";
		echo "<td align='center' style='width:50px;'>".$list['customer_id']."</td>\n";
		echo "<td align='center'>".$list['customer_first_name']."&nbsp;".$list['customer_last_name']."</td>\n";
		
		echo "<td align='center'>".$list['email']."</td>\n";
		
		echo "<td align='center'>".$list['address'].", ".$list['city'].", ".$list['post_code']."</td>\n";
		
		echo "<td align='center'>".$list['phone_number']."</td>\n";
	//	echo "<td align='center'></td>\n";
		echo "<td align='center'>";
		//echo anchor('admin/orders/editCustomer/'.$list['customer_id'],'edit');
		echo "<a href='".base_url()."index.php/admin/orders/allowCustomer/".$list['customer_id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		echo "<a href='".base_url()."index.php/admin/orders/deleteNewCustomer/".$list['customer_id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this new lead ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</tbody></table>";
	echo form_close();
}
?>
<script type="text/javascript">
$(document).ready( function() {
	$("#tablesorter").dataTable( {
		"iDisplayLength": 40,
                "oLanguage": {
			"sLengthMenu": 'Display <select>'+
				'<option value="20">20</option>'+
				'<option value="40">40</option>'+
				'<option value="60">60</option>'+
				'<option value="80">80</option>'+
				'<option value="100">100</option>'+
				'<option value="-1">All</option>'+
				'</select> records'
		},
		"aoColumns": [
		{ "sWidth": "10%" },
		{ "sWidth": "30%" },	
		{ "sWidth": "15%" },
		{ "sWidth": "30%" },
		{ "sWidth": "20%" },
		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]
	} );
} )
	
</script>