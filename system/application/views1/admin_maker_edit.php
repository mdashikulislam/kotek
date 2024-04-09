<script type="text/javascript">


  $(document).ready(function() {
   $("#makerForm").validate({
        rules: {  name:{   required : true,  minlength: 3,  maxlength: 15 }
		  },
        messages: { 	name: { required: "Please enter maker" }
		}
	});
  });
  
  </script>

<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata =  array('name'=>'makerForm', 'id'=>'makerForm');
echo form_open_multipart('admin/maker/edit', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='name'>Name<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'name','id'=>'name','class'=>'textfield','size'=>25, 'value'=>$color['name']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr style='display:none;'>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Description :</label></td><td>\n";
$data = array('name'=>'maker_desc','id'=>'maker_desc','rows'=>5, 'cols'=>'40', 'value'=>$color['description']);
echo form_textarea($data) ."</td>\n";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo form_hidden('id',$color['id']);
echo "<input type='submit' value='' class='updateMakerBtn' title='Update Maker' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>