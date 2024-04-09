<script type="text/javascript">


  $(document).ready(function() {
   $("#groupForm").validate({
        rules: {  name:{   required : true,  minlength: 3,  maxlength: 25 }
		  },
        messages: { 	name: { required: "Please enter Group" }
		}
	});
  });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata =  array('name'=>'groupForm', 'id'=>'groupForm');
echo form_open('admin/categories/edit',$fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='catname'>Name<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'name','id'=>'catname','class'=>'textfield','size'=>25, 'value' => $category['name']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='short'>Short Description :</label></td><td>";
$data = array('name'=>'shortdesc','id'=>'short','class'=>'textfield','size'=>40, 'value' => $category['shortdesc']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Long Description :</label></td><td>";
$data = array('name'=>'longdesc','id'=>'long','rows'=>5, 'cols'=>'40', 'value' => $category['longdesc']);
echo form_textarea($data) ."</td>";
echo "</tr>";

echo "<tr style='display:none;'>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo form_hidden('id',$category['id']);
echo "<input type='submit' value='' class='updateGroupBtn' title='Update Group' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>