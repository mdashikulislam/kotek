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
				  url: "<?=base_url()?>admin/carmodel/deleteMultiple",
				  data: { id: str },
				  success : function(data) {
				// window.location.href = window.location.href;    
				 window.location.href ="<?=base_url()?>admin/carmodel/";
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
<p>Create, edit, delete and manage Models on your online store.</p>
<a href="<?=base_url()?>admin/carmodel/create" title="Create New Model" class="createMaker">Create New Model</a>

<?php

if ($this->session->flashdata('message')){

	echo "<div class='message'>".$this->session->flashdata('message')."</div>";

}

if ($this->session->flashdata('error')){ 

	echo "<div class='error'>".$this->session->flashdata('error')."</div>";

}

if (count($carmodel)){

	echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3' width='800'>\n";

	echo "<thead>\n<tr valign='top'>\n";

	echo "<th><input type='checkbox' id='checkAll' name='checkAll' value='' onclick='checkAll();'/></th><th>ID</th>\n<th>Name</th>\n<th>Maker</th><th>Status</th><th>Actions</th>\n";

	echo "</tr>\n</thead>\n<tbody>\n";$xx=1;

	foreach ($carmodel as $key => $list){
		//echo $list['maker'];
$maker = $this->MMaker->getMaker($list['maker']);
if(!empty($maker))
{
//echo '<pre>';print_r($maker);echo '</pre>';
		echo "<tr valign='top'>\n";
echo "<td>".form_checkbox('cat_id[]',$list['id'],FALSE,'class="case"')."</td>\n";
		echo "<td align='center'>".$xx."</td>\n";

		echo "<td align='left'>".$list['title']."</td>\n";
echo "<td align='left'>".$maker['name']."</td>\n";

			echo "<td align='center' ><a style='cursor:pointer' id='".$list['id']."' onclick=updateProductStatus(".$list['id'].");>".$list['status']."</a></td>\n";
		echo "<input type='hidden' id='status_val_".$list['id']."' name='status_val' value='".$list['status']."' />";
		
		echo "<td align='center'>";

		//echo anchor('admin/carmodel/edit/'.$list['id'],'edit');

		echo "<a href='".base_url()."admin/carmodel/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";

		//echo " | ";

		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete font ?');");

		//echo anchor('admin/carmodel/delete/'.$list['id'],'delete', $adata);

		echo "<a href='".base_url()."admin/carmodel/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this Model ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";

		echo "</td>\n";

		echo "</tr>\n";

$xx++;
}

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
{ "sWidth": "5%", "sClass": "center", "bSortable": false },
		{ "sWidth": "10%" },

		{ "sWidth": "40%" },	

		{ "sWidth": "15%" },
		{ "sWidth": "15%" },

		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]

	} );

} );

function updateProductStatus(productId)
{
	var status_val = document.getElementById('status_val_'+productId).value;
	if(status_val === 'active')
	{
		var status_val1 = 'inactive';
	}
	else
	{
		var status_val1 = 'active';
	}
var reqUrl = "<?=base_url()?>admin/carmodel/udpateCarmodelStatus/"+productId+"/"+status_val1
$.ajax({
  url: reqUrl,
  context: document.body,
  success: function(){
    alert("Model status updated");
	$('#'+productId).html(status_val1);
	document.getElementById('status_val_'+productId).value = status_val1;
	$("#tablesorter").dataTable( {"bDestroy":true,

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

		{ "sWidth": "40%" },	

		{ "sWidth": "15%" },
		{ "sWidth": "15%" },

		{ "sWidth": "25%", "sClass": "center", "bSortable": false } ]

	} );

	return false;
  }
});
	
}
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

