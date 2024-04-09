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
echo form_open('admin/dimensions/create',$fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "\n<td width='150'><label for='catname'>Dimension<span class='red'>*</span> :</label></td><td width='810'>\n";
$data = array('name'=>'name','id'=>'catname','class'=>'textfield','size'=>25);
echo form_input($data) ."</td>\n";
echo "</tr>";

echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>\n";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</td>\n";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit'  class='createDimensionBtn' title='Create Dimensions'  value=''/>";
echo "</td></tr>";

echo "</table>";

echo form_close();


?>
</div>