<h1 class="pageTitle"><?php echo $title;?></h1>
<a href="<?=base_url()?>index.php/admin/maker/create" title="Create New Maker" class="createMaker">Create New Maker</a>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if ($this->session->flashdata('error')){ 
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}
if (count($maker)){
	echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3'>\n";
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	foreach ($maker as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='left'>".$list['name']."</td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		//echo anchor('admin/maker/edit/'.$list['id'],'edit');
		echo "<a href='".base_url()."index.php/admin/maker/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		//echo " | ";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete font ?');");
		//echo anchor('admin/maker/delete/'.$list['id'],'delete', $adata);
		echo "<a href='".base_url()."index.php/admin/maker/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this maker ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</tbody>\n</table>";
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
		{ "sWidth": "15%" },
		{ "sWidth": "50%" },
		{ "sWidth": "30%" },
		{ "sWidth": "20%", "sClass": "center", "bSortable": false } ]
	} );
} )
	
</script>
