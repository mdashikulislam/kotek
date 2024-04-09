<h1 class="pageTitle"><?php echo $title;?></h1>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}
if (count($subscribers)){
	echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3' width='800'>\n";
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th><th>Name</th><th>Email</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	foreach ($subscribers as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='center'>".$list['name']."</td>\n";
		echo "<td>".$list['email']."</td>\n";
		echo "<td align='center'>";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete this subscriber ?');");
		//echo anchor('admin/subscribers/delete/'.$list['id'],'unsubscribe',$adata);
		echo "<a href='".base_url()."index.php/admin/subscribers/replyRequest/".$list['id']."' class='' title='Delete'> Reply </a>";
		echo " | <a href='".base_url()."index.php/admin/subscribers/deleteRequest/".$list['id']."' class='' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this request ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</tbody>\n</table>";
}
?><script type="text/javascript">
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
		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]
	} );
} )
	
</script>