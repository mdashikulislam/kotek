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
				  url: "<?=base_url()?>admin/distributors/deleteMultiple",
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
<p>Create, edit, delete and manage Distributors on your online store.</p>
<a href="<?=base_url()?>admin/distributors/createDistributor" title="Create Distributor" class="createUser">Create Distributor</a>

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

	echo "<th><input type='checkbox' id='checkAll' name='checkAll' value='' onclick='checkAll();'/></th><th>ID</th>\n<th>Name</th><th>Email </th><th>Address</th><th>Phone no</th><th>Actions</th>\n";

	echo "</tr>\n</thead>\n<tbody>\n";

$xx =1;

foreach ($products as $key => $list){

		echo "<tr valign='top'>\n";

		//echo "<td align='center' >".form_checkbox('p_id[]',$list['distributor_id'],FALSE)."</td>";
echo "<td>".form_checkbox('cat_id[]',$list['distributor_id'],FALSE,'class="case"')."</td>\n";
		echo "<td align='center' style='width:50px;'>".$xx."</td>\n";

		echo "<td align='center'>".$list['distributor_title']."</td>\n";

		

		echo "<td align='center'>".$list['email']."</td>\n";

		

		echo "<td align='center'>".$list['address'].", ".$list['city'].", ".$list['post_code']."</td>\n";

		

		echo "<td align='center'>".$list['phone_number']."</td>\n";

	//	echo "<td align='center'></td>\n";

		echo "<td align='center'>";

		//echo anchor('admin/distributors/editDistributor/'.$list['distributor_id'],'edit');

		echo "<a href='".base_url()."admin/distributors/editDistributor/".$list['distributor_id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";

		//echo " | ";

		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete this distributor account ?');");

		//echo anchor('admin/distributors/deleteDistributor/'.$list['distributor_id'],'delete',$adata);

		echo "<a href='".base_url()."admin/distributors/deleteDistributor/".$list['distributor_id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this distributor ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";

		echo "</td>\n";

		echo "</tr>\n";

$xx++;

	}

	echo "</tbody></table>";

	echo form_close();

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
{ "sWidth": "5%", "sClass": "center", "bSortable": false },
		{ "sWidth": "10%" },

		{ "sWidth": "20%" },

		{ "sWidth": "15%" },

		{ "sWidth": "25%" },

		{ "sWidth": "15%" },

		{ "sWidth": "20%", "sClass": "center", "bSortable": false } ]

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