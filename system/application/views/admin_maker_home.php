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
				  url: "<?=base_url()?>admin/maker/deleteMultiple",
				  data: { id: str },
				  success : function(data) {
				 //window.location.href = window.location.href;    
				  window.location.href ="<?=base_url()?>admin/maker/";
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
<p>Create, edit, delete and manage Makers on your online store.</p>
<a href="<?=base_url()?>admin/maker/create" title="Create New Maker" class="createMaker">Create New Maker</a>
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
	echo "<th><input type='checkbox' id='checkAll' name='checkAll' value='' onclick='checkAll();'/></th><th>ID</th>\n<th>Name</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";
	foreach ($maker as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td>".form_checkbox('cat_id[]',$list['id'],FALSE,'class="case"')."</td>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='left'>".$list['name']."</td>\n";
		
		echo "<td align='center' ><a style='cursor:pointer' id='".$list['id']."' onclick=updateMakerStatus(".$list['id'].");>".$list['status']."</a></td>\n";
		echo "<input type='hidden' id='status_val_".$list['id']."' name='status_val' value='".$list['status']."' />";
		
		echo "<td align='center'>";
		//echo anchor('admin/maker/edit/'.$list['id'],'edit');
		echo "<a href='".base_url()."admin/maker/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		//echo " | ";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete font ?');");
		//echo anchor('admin/maker/delete/'.$list['id'],'delete', $adata);
		echo "<a href='".base_url()."admin/maker/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this maker ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
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
		{ "sWidth": "20%", "sClass": "center", "bSortable": false },
		{ "sWidth": "15%" },
		{ "sWidth": "50%" },
		{ "sWidth": "30%"},
		{ "sWidth": "20%", "sClass": "center", "bSortable": false } ]
	} );
} );
	
function updateMakerStatus(makerId)
{
	var status_val = document.getElementById('status_val_'+makerId).value;
	if(status_val === 'active')
	{
		var status_val1 = 'inactive';
	}
	else
	{
		var status_val1 = 'active';
	}
var reqUrl = "<?=base_url()?>admin/maker/udpateMakerStatus/"+makerId+"/"+status
$.ajax({
  url: reqUrl,
  context: document.body,
  success: function(data){
    alert("Maker status updated");
	$('#'+makerId).html(status_val1);
	document.getElementById('status_val_'+makerId).value = status_val1;
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
		{ "sWidth": "20%", "sClass": "center", "bSortable": false },
		{ "sWidth": "15%" },
		{ "sWidth": "50%" },
		{ "sWidth": "30%"},
		{ "sWidth": "20%", "sClass": "center", "bSortable": false } ]
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
