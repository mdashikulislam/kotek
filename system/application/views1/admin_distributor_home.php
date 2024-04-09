<h1 class="pageTitle"><?php echo $title;?></h1>
<a href="<?=base_url()?>index.php/admin/distributors/createDistributor" title="Create Distributor" class="createUser">Create Distributor</a>
<?php
echo "<div>&nbsp;</div>";
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
$xx =1;
foreach ($products as $key => $list){
		echo "<tr valign='top'>\n";
		//echo "<td align='center' >".form_checkbox('p_id[]',$list['distributor_id'],FALSE)."</td>";
		echo "<td align='center' style='width:50px;'>".$xx."</td>\n";
		echo "<td align='center'>".$list['distributor_title']."</td>\n";
		
		echo "<td align='center'>".$list['email']."</td>\n";
		
		echo "<td align='center'>".$list['address'].", ".$list['city'].", ".$list['post_code']."</td>\n";
		
		echo "<td align='center'>".$list['phone_number']."</td>\n";
	//	echo "<td align='center'></td>\n";
		echo "<td align='center'>";
		//echo anchor('admin/distributors/editDistributor/'.$list['distributor_id'],'edit');
		echo "<a href='".base_url()."index.php/admin/distributors/editDistributor/".$list['distributor_id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		//echo " | ";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete this distributor account ?');");
		//echo anchor('admin/distributors/deleteDistributor/'.$list['distributor_id'],'delete',$adata);
		echo "<a href='".base_url()."index.php/admin/distributors/deleteDistributor/".$list['distributor_id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this distributor ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
		echo "</td>\n";
		echo "</tr>\n";
$xx++;
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
		{ "sWidth": "20%" },
		{ "sWidth": "15%" },
		{ "sWidth": "25%" },
		{ "sWidth": "15%" },
		{ "sWidth": "20%", "sClass": "center", "bSortable": false } ]
	} );
} )
	
</script>