<h1><?php echo $title;?></h1>
<p><?php echo anchor("admin/colors/create", "Create new color");?>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}

if (count($colors)){
	echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3' width='800'>\n";
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	foreach ($colors as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='center'>".$list['name']."</td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/colors/edit/'.$list['id'],'edit');
		echo " | ";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete color ?');");
		echo anchor('admin/colors/delete/'.$list['id'],'delete',$adata);
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</tbody>\n</table>";
}
?>