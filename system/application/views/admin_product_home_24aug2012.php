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
				  url: "<?=base_url()?>admin/products/deleteMultiple",
				  data: { id: str },
				  success : function(data) {
				// window.location.href = window.location.href;    
   window.location.href ="<?=base_url()?>admin/products/";
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
<p>Create, edit, delete and manage Products on your online store. </p>
<div class="productFloatLeft"><?php echo anchor("admin/products/create", "Create new product");?> <div style="clear:both;"></div> <div class="export-button"><?php echo anchor("admin/products/exportProduct", "Export All Products");?> </div> </div>
<!--p><?php //echo anchor("admin/products/settings", "Product settings");
?> </p--> 
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}
if($fromLt == 0 )
{
	$fromLt = '';
}
else
{
	$fromLt = '/'.$fromLt;
}
?>
<div class="productFloatRight">
<form name="searchProduct" id="searchProduct" action="<?php echo base_url();?>index.php/admin/products/search" method="post">
<div>
<div class="dataTables_filter" style="width:410px;"><input type="text" id="searchKeyword" name="searchKeyword" value="<?=$searchKey?>" style="float:left;" />
<input type="submit" name="submit" value="" class="submitBtn" style="float:left;" />
&nbsp;<a href="<?php echo base_url();?>index.php/admin/products/index" class="resetBtn" ></a>
</div>
<div class="dataTables_length">Search <select name="search" id="search" >
<option value="name">Select search by </option>
<option value="name" <?php if($searchBy == 'name') { ?> selected="selected" <?php } ?>>Product Name</option>
<option value="part_number" <?php if($searchBy == 'part_number') { ?> selected="selected" <?php } ?>>Part number</option>
<option value="maker" <?php if($searchBy == 'maker') { ?> selected="selected" <?php } ?>>Maker</option>
<option value="model" <?php if($searchBy == 'model') { ?> selected="selected" <?php } ?>>Model</option>
<option value="year" <?php if($searchBy == 'year') { ?> selected="selected" <?php } ?>>Year</option>
<option value="group" <?php if($searchBy == 'group') { ?> selected="selected" <?php } ?>>Group</option>
<!--option value="price">Price</option-->
<option value="status">Status</option>

</select></div>
<div class="forDisplay">Display: <select name="sortBy" id="sortBy" >
<option value="20" <?php if($per_page == '20') { ?> selected="selected" <?php } ?>>20</option>
<option value="40" <?php if($per_page == '40') { ?> selected="selected" <?php } ?>>40</option>
<option value="60" <?php if($per_page == '60') { ?> selected="selected" <?php } ?>>60</option>
<option value="80" <?php if($per_page == '80') { ?> selected="selected" <?php } ?>>80</option>
</select></div>
</div>
</div>
<style type="text/css">
a img_sort {
    border: medium none !important;
    float: left;
    outline: medium none !important;
    margin-right:2px;
}
a{ text-decoration:none !important;}
.productTable th {
    background: none repeat scroll 0 0 #C6D6FF;
    color: #242425;
    font-family: Verdana,Geneva,sans-serif;
    font-size: 16px;
    font-weight: normal;
    padding:10px 4px;
    text-align: left;
}
.productTable table.tablesorter th {
    border-bottom: 1px solid #FFFFFF;
    border-collapse: collapse;
    border-right: 1px solid #FFFFFF;
    vertical-align: middle;
}
.productTable .tablesorter th {
    background: none repeat scroll 0 0 #C6D6FF;
    color: #242425;
    font-family: Verdana,Geneva,sans-serif;
    font-size: 16px;
    font-weight: normal;
    padding:2px;
    text-align: left;
}
</style>
<?

if (count($products)){
	echo '<table id="" class="productTable" border="0" cellspacing="0" cellpadding="0" width="100%">';
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th width='20px'><input type='checkbox' id='checkAll' name='checkAll' value='' onclick='javascript:checkAllfun();'/></th>
	
	     <th width='42px'><a href='".$base_url."/id/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/id/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>ID</th>\n

		 <th width='165px'><a href='".$base_url."/name/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/name/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>Product Name</th>\n

		 <th width='150px'><a href='".$base_url."/part_number/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/part_number/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>Part Number</th>

		 <th width='95px'><a href='".$base_url."/maker/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/maker/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>Maker</th>

		 <th width='85px'><a href='".$base_url."/model/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/model/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>Model</th>

		 <th width='100px'><a href='".$base_url."/year_from/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/year_from/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>Year</th>\n

		 <th width='100px'>Group</th>

		 <th width='50px'><a href='".$base_url."/status/asc".$fromLt."'><img src='".base_url()."images/sort_both-1.jpg' class='img_sort' />
</a><a href='".$base_url."/status/desc".$fromLt."'><img src='".base_url()."images/sort_both-2.jpg' class='img_sort' /></a>Status</th>\n

		 <th width='80px'>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n"; $xx=0;
	foreach ($products as $key => $list){
		 $cateogry['name']=" -- ";
	if(!empty($list['category_id'])){
      $cateogry = $this->MCats->getCategory($list['category_id']);
if(!isset($cateogry['name'])) { $cateogry['name'] ="--"; }
	}	
		$setclass ="class=''";
		if($xx%2 == 0){$setclass ="class='event'";}else{$setclass ="class='odd'";}
		echo "<tr valign='top' ".$setclass.">\n";
		echo "<td>".form_checkbox('cat_id[]',$list['id'],FALSE,'class="case"')."</td>\n";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='left'>".$list['name']."</td>\n";
		echo "<td align='center'>".$list['part_number']."</td>\n";
		
		echo "<td align='left'>".$list['maker_name']."</td>\n";
		echo "<td align='center'>".$list['model_name']."</td>\n";
		echo "<td align='center'>".$list['year_from']."-".$list['year_to']."</td>\n";
		echo "<td align='left'>". $cateogry['name']."</td>\n";
		//echo "<td align='center'>".$list['grouping']."</td>\n";
		
		
		
		
		//echo "<td align='center'>".$list['CatName']."</td>\n";
		//if(empty($list['price'])){$list['price'] = "NA";}else{$list['price'] = "$".$list['price'];}

$pro_status ="<select name='status' id='status' onchange='updateProductStatus(".$list['id'].",this.value);' >";
$selct  =""; $deselct ="";if($list['status'] == 'active'){ $selct ="selected";} else{$deselct ="selected"; }
$pro_status .= "<option value='active'  ".$selct.">Active </option>";
$pro_status .= "<option value='inactive'  ".$deselct."> In active </option>";
$pro_status .="</select>";


		//echo "<td align='center'>".$list['price']."</td>\n";
		echo "<td align='center'>".$pro_status."</td>\n";
		echo "<td align='left'>";
		//echo anchor('admin/products/edit/'.$list['id'],'edit');
		echo "<a href='".base_url()."index.php/admin/products/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		//echo " | ";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete this product ?');");
		//echo anchor('admin/products/delete/'.$list['id'],'delete',$adata);
		echo "<a href='".base_url()."index.php/admin/products/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this product ?');\" ><img src='".base_url()."images/icons/delete.png' /></a>";
		echo "</td>\n";
		echo "</tr>\n";
		$xx++;
	}
	echo "</tbody></table>";
	echo form_close();
}else{
		echo '<table id="" class="" border="0" cellspacing="0" cellpadding="3" width="100%"><tr><td colspan="7">No product found.</td></tr></table>';
		
		}
?>
<div class="pagiWrapper"> <?php echo $this->pagination->create_links(); ?> </div>
<div class="quickDeleteWrapper">
<input type="button" name="deleteproduct" id="deleteproduct" value="" class="delete_btn" onClick="javascript:delete_record();"  />
</form>
</div>

<script type="text/javascript">

function updateProductStatus(productId,status)
{
var reqUrl = "<?=base_url()?>index.php/admin/products/udpateProductStatus/"+productId+"/"+status
$.ajax({
  url: reqUrl,
  context: document.body,
  success: function(){
    alert("Product status updated");
  }
});
	
}

var checked = 0;

function checkAllfun()
{ 
	if(checked == 0){ checked = 1;
	$("INPUT[type='checkbox']").attr('checked', true);	
	var val1 = "";
	$(':checkbox:checked').each(function(i){
	val1 = val1 + ","+ $(this).val();
	$("#deleteArr").val(val1);
	});
	}
	else if(checked == 1){  checked =0;
	$("INPUT[type='checkbox']").attr('checked', false);	
	$("#deleteArr").val('');
	}
}

</script>