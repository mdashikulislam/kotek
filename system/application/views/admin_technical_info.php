<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $title; ?></title>
<link href="<?= base_url();?>css/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url();?>css/demo_table.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript">
//<![CDATA[
base_url = '<?= base_url();?>';
//]]>
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/customtools.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/menuNavigation.js" ></script>

<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" >
<style type="text/css">
#description {
    display: block;
    width: 100px;
}    
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
	  <?php $this->load->view('admin_header');?>
    </div>
	<div id="main">
	   






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
                  url: "<?=base_url()?>admin/technical/deleteMultiple",
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

<script type="text/javascript">
function updateOrder(bannerId,orderval)
{
var reqUrl = "<?=base_url()?>/admin/banner/updatebannerStatus/"+bannerId+"/"+orderval
$.ajax({
  url: reqUrl,
  context: document.body,
  success: function(){
    alert("Order status updated");
  }
});
    
}


</script><h1 class="pageTitle"><?php echo $title;?></h1>
<p>Create, edit, delete and manage Technical Info on your online store.</p>
<!-- <p>Banner reflects on Home page.</p> -->
<a href="<?=base_url()?>admin/technical/create" title="Create New Technical Info" class="createBanner">Create New Technical Info</a>

<?php

if ($this->session->flashdata('message')){

    echo "<div class='message'>".$this->session->flashdata('message')."</div>";

}

if ($this->session->flashdata('error')){

    echo "<div class='error'>".$this->session->flashdata('error')."</div>";

}



if (count($banner)){

    echo "<table id='tablesorter' class='tablesorter' border='0' cellspacing='0' cellpadding='3' width='800'>\n";

    echo "<thead>\n<tr valign='top'>\n";

    echo "<th><input type='checkbox' id='checkAll' name='checkAll' value='' onclick='checkAll();'/></th><th>ID</th>\n<th>Name</th><th>Description</th><th>Status</th><th>Actions</th>\n";

    echo "</tr>\n</thead>\n<tbody>\n";

    foreach ($banner as $key => $list){

        echo "<tr valign='top'>\n";
echo "<td>".form_checkbox('cat_id[]',$list->id,FALSE,'class="case"')."</td>\n";
        echo "<td align='center'>".$list->id."</td>\n";

        echo "<td align='center'>".$list->name."</td>\n";

        echo "<td align='center' id='description'>".$list->description."</td>\n";

        echo "<td align='center'>".$list->status."</td>\n";

        echo "<td align='center'>";

        //echo anchor('admin/banner/edit/'.$list['id'],'edit');

        echo "<a href='".base_url()."admin/technical/edit/".$list->id."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";

        //echo " | ";

        $adata = array('onclick'=>"return deletechecked('Are you sure you want to record ?');");

        //echo anchor('admin/banner/delete/'.$list['id'],'delete',$adata);

        echo "<a href='".base_url()."admin/technical/delete_single/".$list->id."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this record ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";

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
{ "sWidth": "5%", "sClass": "center", "bSortable": false },
        { "sWidth": "10%" },

        { "sWidth": "40%" },

        { "sWidth": "15%" },

        { "sWidth": "15%", "sClass": "center", "bSortable": false },

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











    </div>
		<div id="footer"> 
	  <?php $this->load->view('admin_footer');?>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
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

        { "sWidth": "15%", "sClass": "center", "bSortable": false },

        { "sWidth": "25%", "sClass": "center", "bSortable": false } ]

    } );

});    
</script>
