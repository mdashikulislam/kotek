<h1 class="pageTitle"><?php echo $title;?></h1>
<a href="<?=base_url()?>index.php/admin/admins/create" title="Create New User" class="createUser">Create New User</a>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($admins)){
	echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3' width='800'>\n";
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Username</th><th>email</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	foreach ($admins as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='center'>".$list['username']."</td>\n";
		echo "<td align='center'>".$list['email']."</td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		if($list['id'] != 1){
		//echo anchor('admin/admins/edit/'.$list['id'],'edit');
		echo "<a href='".base_url()."index.php/admin/admins/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		//echo " | ";
		//echo anchor('admin/admins/delete/'.$list['id'],'delete');
		echo "<a href='".base_url()."index.php/admin/admins/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this admin ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
		}else{
			echo "<span class='superAdmin'> Super Admin </span>";
			}
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
		{ "sWidth": "10%" },
		{ "sWidth": "40%" },
		{ "sWidth": "15%" },
		{ "sWidth": "15%" },
		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]
	} );
} )
	
</script>