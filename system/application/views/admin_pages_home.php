<h1 class="pageTitle"><?php echo $title;?></h1>
<p>Edit, delete and manage Pages fonts on your online store. </p>
<a href="<?=base_url()?>admin/pages/create" title="Create New Page" class="createNewLink">Create New Page</a>

<?php

if ($this->session->flashdata('message')){

	echo "<div class='message'>".$this->session->flashdata('message')."</div>";

}



if (count($pages)){

	echo "<div class='test'><table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3'>\n";

	echo "<thead>\n<tr valign='top'>\n";

	echo "<th>ID</th>\n<th>Title</th><th>Full Path</th><th>Status</th><th>Actions</th>\n";

	echo "</tr>\n</thead>\n<tbody>\n";

	foreach ($pages as $key => $list){

		echo "<tr valign='top'>\n";

		echo "<td align='center'>".$list['id']."</td>\n";

		echo "<td align='left'>".$list['name']."</td>\n";

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

		//echo anchor('admin/pages/edit/'.$list['id'],'');

		echo "<a href='".base_url()."admin/pages/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";

		//echo " | ";

		//echo anchor('admin/pages/delete/'.$list['id'],'delete');

		echo "<a href='".base_url()."admin/pages/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this pages ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";

		echo "</td>\n";

		echo "</tr>\n";

	}

	echo "</tbody>\n</table></div>";

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

		{ "sWidth": "15%" , "sClass": "center", "bSortable": false},

		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]

	} );

} )

	

</script>