<script type="text/javascript">


  $(document).ready(function() {
   $("#groupForm").validate({
        rules: {  name:{   required : true,  minlength: 3,  maxlength: 25 }
		  },
        messages: { 	name: { required: "Please enter Dimensions" }
		}
	});
  });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata =  array('name'=>'groupForm', 'id'=>'groupForm');
echo form_open('admin/dimensions/edit',$fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='catname'>Dimension<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'name','id'=>'catname','class'=>'textfield','size'=>25, 'value' => $category['name']);
echo form_input($data) ."</td>";
echo "</tr>";


echo "<tr style='display:none;'>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active');
echo form_dropdown('status',$options, $category['status']) ."</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo form_hidden('id',$category['id']);
echo "<input type='submit'  class='updateDimensionBtn' title='Update Dimension' value='' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>