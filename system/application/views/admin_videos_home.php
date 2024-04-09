<h1><?php echo $title;?></h1>
<p><?php echo anchor("admin/videos/create", "Create new video");?></p>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($videos)){
	echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3' width='800'>\n";
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Full Path</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	foreach ($videos as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='center'>".$list['name']."</td>\n";
		echo "<td>";
   		//if (!preg_match("/\.html$/",$list['path'])){
  		//	$list['path'] .= ".html";
  		//}		
		
		if ($list['category_id'] == 0){
			echo "/". $list['path'];
		}else{
			echo "/". $cats[$list['category_id']]. "/". $list['path'];
		}
		echo "</td>";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/videos/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/videos/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</tbody>\n</table>";
}
?>