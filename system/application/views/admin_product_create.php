<h1 class="pageTitle"><?php echo $title;?></h1>
<script type="text/javascript">
var procnt =1;
 //jQuery("#make").live("change",function(){
function showModel(procnter1, selectVal){

		var groups = new Array;
		//var selObj = document.getElementById('make_'+procnter1);
		//var selIndex = selObj.selectedIndex;
		//var searchModel = selObj.options[selIndex].value;
		urlStore ="<?php echo base_url();?>pages/getModelListAdmin/"+selectVal+"/"+procnter1;

		$.ajax({
				url: urlStore,
				context: document.body,
				success: function(data){					
				$("#showModel_"+procnter1).html(data);
				}
		});
}
//});

</script>
<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "This field must contain only numbers, + and -.");
$.validator.addMethod("selectNone",function(value, element) { 
    if (element.value == "")  {  return false; } else { return true;} },
  "Please select an option.");
 
 $.validator.addMethod("greaterThan", function(value, element, params) { 
            if (!/Invalid|NaN/.test(value)) {       return value >= $(params).val();         }
            return isNaN(value) && isNaN($(params).val()) || (parseInt(value) > parseInt($(params).val())); 
        },'Must be greater than or equal to {0}.');
 

  $("#createProduct").validate({
        rules: {  
		name:{   required : true},
		part_number:{   required : true},
        //shortdesc:{minlength:10,  maxlength: 100},
        //longdesc: {minlength:10,  maxlength: 200},
		year_from_1: { required: true, NumbersOnly:true, minlength:4,  maxlength: 4},
//    	year_to_1: { required: true, NumbersOnly:true, minlength:4,  maxlength: 4, greaterThan: "#year_from_1"},
    	year_to_1: { required: true, NumbersOnly:true, minlength:4,  maxlength: 4},
		price: { NumbersOnly:true},
		model_1: { required: true, selectNone:true}

		  },
        messages: { 
		name: { required: "Please enter product name"},
		part_number: { required: "Please enter part number"},
 	    year_from_1: { required: "Please enter year from"},
    	year_to_1: { required: "Please enter year to"},
//    	year_to_1: { required: "Please enter year to", greaterThan: "Please enter year greater than or equal to start year"},
		price: {NumbersOnly: "Please enter valid amount" },
		model_1: { required: "Please choose car model"}
		  
        }       });
      });
  
  function checkDynamicItems()
  {
	var loop = $("#procounter").val();
	
			
	for(var i=2;i<=loop;i++)
	{ 
	 
		var year_from  = parseInt($("#year_from_"+i).val());
		var year_to  = parseInt($("#year_to_"+i).val());
		var selObj=document.getElementById("model_"+i);
		var selIndex = selObj.selectedIndex;
		var searchModel = selObj.options[selIndex].value;
		
		$('#newProd_'+i).css("background-color", "#ffffff");  
		if(isNaN(year_from) || isNaN(year_to))
		{
		alert('Please enter valid year');	
		$("#year_to_"+i).focus();
		$('#newProd_'+i).css("border", "2px solid red");  
		return false;
		}

		if(year_to < year_from)
		{
		alert('Please enter year greater than start year');	
		$("#year_to_"+i).focus();
		$('#newProd_'+i).css("border", "2px solid red");  
		return false;
		}
		if(searchModel == "")
		{
	 	alert('Please choose Model');	
		$('#newProd_'+i).css("border", "2px solid red");  
		return false;
		}
		
	}

	return true;
  }
  
  </script>
<div class="dashboardWrapper">
<?php
$fdata = array('name'=>'createProduct', 'id'=>'createProduct' ,'onsubmit'=>"return checkDynamicItems(); ");
echo form_open_multipart('admin/products/create',$fdata );

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='pname'>Name<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'name','id'=>'pname','class'=>'textfield','size'=>25, 'value' => '');
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='short'>Short Description :</label></td><td>";
$data = array('name'=>'shortdesc','id'=>'short','class'=>'textfield','size'=>40, 'value' => '');
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Long Description :</label></td><td>";
$data = array('name'=>'longdesc','id'=>'long','rows'=>5, 'cols'=>'40', 'value' =>'');
echo form_textarea($data) ."</td>";
echo "</tr>";

?>
<tr id=''>
<td><label for='long'>Choose Attributes :</label></td><td>
<div class="dimenWrapper" style="clear:both;">
	<div class="dimenSelect"> Attribute: </div>
    <div class="dimenValue"> Values: </div>
</div>
<div style="clear:both;"> </div>
<div class="dimenWrapper" id="dimentions_list">
<div class="dimenSelect"><select name="dimentionsList[]" >
<?php $dimenList = $this->MDimensions->getAllDimensions();
foreach($dimenList as $key1=>$value1)
{
echo "<option value='".$value1['id']."'>".$value1['name']."</option>";	
}
?>
</select> 
</div>

<div class="dimenValue"><input type="text" class="textfield" id="dimensions[]" value="" name="dimensions[]"></div> 
</div>

<div> <a href="#" onclick="addDie();" class="addDimen" >Add</a></div>

<input type="hidden" name="counter" id="counter" value="1"/>
<input type="hidden" name="procounter" id="procounter" value="1"/></td></tr>
<?
echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>Allowed only gif,jpg or png images with file size of max 200 KB</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='uimage'>Image name :</label></td><td>";
$data = array('name'=>'image','id'=>'uimage');
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td> <span style='font-size:16px;'>OR</span></td>";
echo "</tr>";


echo "<tr>";
echo "<td><label for='uthumb'>Upload Image :</label></td><td>";
$data = array('name'=>'image_up','id'=>'image_up');
echo form_upload($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='group'>Part Number<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'part_number','id'=>'part_number','class'=>'textfield','size'=>10, 'value' =>'');
echo form_input($data) ."</td>";
echo "</tr>";


echo "<tr style='display:none;'>";
echo "<td><label for='price'>Price :</label></td><td>";
$data = array('name'=>'price','id'=>'price','class'=>'textfield','size'=>10, 'value' => '');
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='price'>Group<span class='red'>*</span> :</label></td><td>";
echo "<select name='group' id='group'>";
foreach ($categories as $key => $value){
	echo "<option value='".$key."' >".$value."</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<div id='multiple_product'>";
echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable' id='newProd_1'>";
echo "<tr>";
echo "<td width='143' ><label for='group'>Year from<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'year_from_1','id'=>'year_from_1','class'=>'textfield','size'=>10, 'value' =>'');
echo form_input($data) ."</td>";

echo "<td width='80' ><label for='group'>Year to<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'year_to_1','id'=>'year_to_1','class'=>'textfield','size'=>10, 'value' =>'','style'=> 'width:',);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='price'>Maker<span class='red'>*</span> :</label></td><td>";
echo "<select name='make_1' id='make_1' onchange='showModel(1,this.value);'> <option value=''>select maker</option>";
foreach ($makers as $key => $value){
	echo "<option value='".$value['id']."' >".$value['name']."</option>";
}
echo "</select>";
echo "</td>";
echo "";

echo "";
echo "<td><label for='price'>Model<span class='red'>*</span> :</label></td><td id='showModel_1'>";
echo "<select name='model_1' id='model_1'> <option value=''>select model</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";
echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit' value='' class='createProductBtn' title='Create Product' />";
echo "</td></tr>";

echo "</table>";

echo "<div> <a href='' onclick='addprod(); return false;' class='addDimen'  >Add</a></div>";
echo form_close();

?>
</div>
<script type="text/javascript">
var siteUrl = "<?php echo base_url();?>";

$('.button_remove').live('click',function() {
										
  $(this).parents("div:first").remove();
});



function addprod()
{
	//r couterGet = parseInt($("#counter").val());
	procnt = parseInt(procnt) + 1;
	
var	chkUrl = siteUrl+"admin/products/getProductArray/"+procnt;

$.ajax({
  url: chkUrl,
  context: document.body,
  success: function(data){	  
    $("#multiple_product").append(data);
	$("#procounter").val(procnt);
	
  }
  
});	


//var settings = $('#createProduct').validate().settings;
//settings.rules.leftform_input1 = {required: true};
	//	$("#year_from_"+procnt).rules("add", { required:true });
	//	$("#year_to_"+procnt).rules("add", { required:true});
}
function addDie()
{

	
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