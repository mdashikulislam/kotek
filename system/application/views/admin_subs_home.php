<!-- Code Added by Prajakta T.-->
<script language="javascript" type="text/javascript">
//function for deleting multiple record
function delete_record()
{  
	var selectedItems = new Array();
	$("input[@name='cat_id[]']:checked").each(function() {selectedItems.push($(this).val());});
	if(confirm("Do you want to delete Records??"))
	{
		if (selectedItems .length == 0)
		{
			alert("Please select item(s) to delete."); 
		}
		else
		{
			var str = selectedItems.toString();  	
			$.ajax({
				  type: "POST",
				  url: "<?=base_url()?>admin/subscribers/deleteMultiple",
				  data: { id: str },
				  success : function(data) {
				 window.location.href = window.location.href;    
				  }
				});
			return false;
		}
	}
	return false;
}
</script>
<!-- Code Ended by Prajakta T.-->
<h1 class="pageTitle"><?php echo $title;?></h1>
<p>Manage Subscribers and send out emails. </p>
<a href="<?=base_url();?>admin/subscribers/sendemail" title="Create New Email" class="createEmail">Create New Email</a>

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

	echo "<th><input type='checkbox' id='checkAll' name='checkAll' value='' onclick='checkAll();'/></th><th>ID</th>\n<th>Email</th><th>Actions</th>\n";

	echo "</tr>\n</thead>\n<tbody>\n";

	foreach ($subscribers as $key => $list){

		echo "<tr valign='top'>\n";
echo "<td>".form_checkbox('cat_id[]',$list['id'],FALSE,'class="case"')."</td>\n";
		echo "<td align='center'>".$list['id']."</td>\n";

		echo "<td>".$list['email']."</td>\n";

		echo "<td align='center'>";

		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete this subscriber ?');");

		//echo anchor('admin/subscribers/delete/'.$list['id'],'unsubscribe',$adata);

		echo "<a href='".base_url()."admin/subscribers/delete/".$list['id']."' class='unsubscibe' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this subscriber ?');\"> Unsubscribe</a>";

		echo "</td>\n";

		echo "</tr>\n";

	}

	echo "</tbody>\n</table>";

}

?>
<div>
<form name="quickDelete" id="quickDelete" method="post" >
<input type="button" name="deleteproduct" id="deleteproduct" value="" class="delete_btn" onClick="javascript:delete_record();"  />
</form>
</div>
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
		{ "sWidth": "10%" , "sClass": "center", "bSortable": false },
		{ "sWidth": "10%" },

		{ "sWidth": "40%" },	

		

		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]

	} );

} )

	var checked = 0;

function checkAll()
{ 
if(checked == 0){ checked =1;
jQuery("INPUT[type='checkbox']").attr('checked', true);	
var val1 = "";
$(':checkbox:checked').each(function(i){
val1 = val1 + ","+ $(this).val();
jQuery("#deleteArr").val(val1);
});
}
else if(checked == 1){  checked =0;
jQuery("INPUT[type='checkbox']").attr('checked', false);	
jQuery("#deleteArr").val('');

}
}


</script>