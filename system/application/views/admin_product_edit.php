<h1 class="pageTitle"><?php echo $title;?></h1>
<script type="text/javascript">
function showModel()
	{
		var groups = new Array;
		var selObj = document.getElementById('make');
		var selIndex = selObj.selectedIndex;
		var searchModel = selObj.options[selIndex].value;
		urlStore ="<?php echo base_url();?>pages/getModelList/"+searchModel;
		
		$.ajax({
				url: urlStore,
				context: document.body,
				success: function(data){
				$("#showModel").html(data);
				}
				});
		
	}

</script>
<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");
$.validator.addMethod("selectNone",function(value, element) { 
    if (element.value == "")  {  return false; } else { return true;} },
  "Please select an option.");
  $.validator.addMethod("greaterThan", function(value, element, params) {
            if (!/Invalid|NaN/.test(value)) {       return value > $(params).val();         }
            return isNaN(value) && isNaN($(params).val()) || (parseInt(value) > parseInt($(params).val())); 
        },'Must be greater than {0}.');
  $("#editProduct").validate({
        rules: {  
		name:{   required : true},
		part_number:{   required : true},
      //          shortdesc:{minlength:10,  maxlength: 100},
      //          longdesc: {minlength:10,  maxlength: 200},
		year_from: { required: true, NumbersOnly:true, minlength:4,  maxlength: 4},
//    	year_to: { required: true, NumbersOnly:true, minlength:4,  maxlength: 4, greaterThan: "#year_from"},
    	year_to: { required: true, NumbersOnly:true, minlength:4,  maxlength: 4},
		price: { NumbersOnly:true},
		model: { required: true, selectNone:true}

		  },
        messages: { 
		name: { required: "Please enter product name"},
		part_number: { required: "Please enter part number"},
		year_from: { required: "Please enter year from"},
//    	year_to: { required: "Please enter year to", greaterThan: "Please enter year greater than start year"},
    	year_to: { required: "Please enter year to"},
		price: {NumbersOnly: "Please enter valid amount" },
		model: { required: "Please choose car model"}
		  
        }       });
      });
  $('.button_remove').live('click',function() {
										
  $(this).parents("div:first").remove();
  return false;
});
  </script>

<div class="dashboardWrapper">
<?php
$fdata = array('name'=>'editProduct', 'id'=>'editProduct');
echo form_open_multipart('admin/products/edit',$fdata );

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='pname'>Name<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'name','id'=>'pname','class'=>'textfield','size'=>25, 'value' => $product['name']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='short'>Short Description :</label></td><td>";
$data = array('name'=>'shortdesc','id'=>'short','class'=>'textfield','size'=>40, 'value' => $product['shortdesc']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Long Description :</label></td><td>";
$data = array('name'=>'longdesc','id'=>'long','rows'=>5, 'cols'=>'40', 'value' => $product['longdesc']);
echo form_textarea($data) ."</td>";
echo "</tr>";

$dimenList = $this->MDimensions->getAllDimensions();
$productDimensions = $this->MDimensions->getAllProductDimensions($product['id']);
if(!empty($productDimensions)){
	
?>
<tr id=''>
<td><label for='long'>Choose Attribute :</label></td>
<td>
<div class="dimenWrapper" style="clear:both;">
	<div class="dimenSelect"> Attribute: </div>
    <div class="dimenValue"> Values: </div>
</div>

<div style="clear:both;"> </div>

<div class="dimenWrapper" id="dimentions_list">
<?php foreach($productDimensions as $key=>$value){ ?>
<div class="singleDimention">
<div class="dimenSelect"><select name="dimentionsList[]" >
<?php
foreach($dimenList as $key1=>$value1)
{ $selct =""; if($value1['id'] == $value['dimension_id']){$selct ="selected";}
echo "<option value='".$value1['id']."' ".$selct.">".$value1['name']."</option>";	
}
?>
</select> 
</div>

<div class="dimenValue"><input type="text" class="textfield" id="dimensions[]" value="<?=$value['dimension_value']?>" name="dimensions[]"></div> 
<a class="button_remove" href="#">Delete</a>
</div>

<?php } ?>
</div>

<div> <a href="#" onclick="addDie();" class="addDimen" >Add</a></div>

<input type="hidden" name="counter" id="counter" value="1"/></td>
</tr>
<?
}else{
	?>
	<tr id=''>
<td><label for='long'>Choose Dimensions :</label></td>
<td>
<div class="dimenWrapper" style="clear:both;">
	<div class="dimenSelect"> Dimentions: </div>
    <div class="dimenValue"> Values: </div>
</div>

<div style="clear:both;"> </div>

<div class="dimenWrapper" id="dimentions_list">
<div class="singleDimention">
<div class="dimenSelect"><select name="dimentionsList[]" >
<?php
foreach($dimenList as $key1=>$value1)
{
echo "<option value='".$value1['id']."'>".$value1['name']."</option>";	
}
?>
</select> 
</div>

<div class="dimenValue"><input type="text" class="textfield" id="dimensions[]" value="" name="dimensions[]"></div> 

<a class="button_remove" href="#">Delete</a>
</div>

</div>

<div> <a href="#" onclick="addDie();" class="addDimen" >Add</a></div>

<input type="hidden" name="counter" id="counter" value="1"/>
</td></tr>

<?	
	}
echo "<tr>";
echo "<td><label for='uimage'>Image name :</label></td><td>";
$data = array('name'=>'image','id'=>'uimage');
echo form_input($data) ."<span style='font-size:16px; padding-left:100px;'>OR</span> </td>";
echo "</tr>";



echo "<tr>";
echo "<td><label for='uthumb'>Upload Image :</label></td><td>";
$data = array('name'=>'image_up','id'=>'image_up');
echo form_upload($data) ."</td>";
echo "</tr>";

/* echo "<tr>";
echo "<td><label for='uthumb'>Upload Thumbnail :</label></td><td>";
$data = array('name'=>'thumbnail','id'=>'uthumb');
echo form_upload($data) ."<br/>Current thumbnail: ". $product['thumbnail']."</td>";
echo "</tr>"; */ 

echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $product['status']) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='group'>Part Number<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'part_number','id'=>'part_number','size'=>10, 'value' => $product['part_number']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='group'>Year from<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'year_from','id'=>'year_from','class'=>'textfield','size'=>10, 'value' =>$product['year_from']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='group'>Year to<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'year_to','id'=>'year_to','class'=>'textfield','size'=>10, 'value' => $product['year_to']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr style='display:none;'>";
echo "<td><label for='price'>Price :</label></td><td>";
$data = array('name'=>'price','id'=>'price','class'=>'textfield','size'=>10, 'value' => $product['price']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='price'>Group<span class='red'>*</span> :</label></td><td>";
echo "<select name='group' id='group'>";
foreach ($categories as $key => $value){
	if($key  == $product['category_id']){
		$checked = "selected";
	}else{
		$checked = "";
	}
	echo "<option value='".$key."' ".$checked.">".$value."</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td><label for='price'>Maker<span class='red'>*</span> :</label></td><td>";
echo "<select name='make' id='make' onchange='showModel()'> <option value=''>select maker</option>";
foreach ($makers as $key => $value){
	$checked = ""; if($value['id'] == $makerPro){ $checked = "selected"; }
	echo "<option value='".$value['id']."' ".$checked.">".$value['name']."</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='price'>Model<span class='red'>*</span> :</label></td><td id='showModel'>";
echo "<select name='model' id='model' ><option value=''>select model</option>";
foreach ($models as $key => $value){
	$checked = ""; if($key == $product['model']){ $checked = "selected"; }
	echo "<option value='".$key."' ".$checked." >".$value."</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<tr><td>&nbsp;</td><td>";
echo form_hidden('id',$product['id']);
echo "<input type='submit' value='' class='updateProductBtn' title='Update Product' />";
echo "</td></tr>";

echo "</table>";

echo form_close();


?>
</div>

<script type="text/javascript">
var siteUrl = "<?php echo base_url();?>";
function addDie()
{
	//r couterGet = parseInt($("#counter").val());
	
var	chkUrl = siteUrl+"admin/dimensions/addDimentions/";

$.ajax({
  url: chkUrl,
  context: document.body,
  success: function(data){	  
    $("#dimentions_list").append(data);
	//couterGet = couterGet + 1;
	//$("#counter").val(couterGet);
  }
});	
	
}

</script>