<script type="text/javascript">
  $(document).ready(function() {
$.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
});

 
  $("#advertiseForm").validate({
        rules: {  title:{   required : true,  minlength: 3,  maxlength: 100 },
year:{   required : true,  minlength: 4,  maxlength: 4 },
image: { required: true, accept: "png|jpe?g|gif", filesize: 1048576  },
thumbnail: { required: true, accept: "png|jpe?g|gif", filesize: 40000}         
		  },
        messages: { 	
title: { required: "Please enter advertise title" },
 year: { required: "Please enter advertise year" },
image: "File must be JPG, GIF or PNG, less than 1MB",
thumbnail: "File must be JPG, GIF or PNG, less than 40KB"
		}
	});
      });  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata = array('name'=>'advertiseForm','id'=>'advertiseForm');
echo form_open_multipart('admin/advertise/create', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='name'>Title<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'title','id'=>'title','class'=>'textfield','size'=>25);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='name'>Year<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'year','id'=>'year','class'=>'textfield','size'=>25);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='uimage'>Upload Image<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'image','id'=>'image');
echo form_upload($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='uimage'>Upload thumbnail<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'thumbnail','id'=>'thumbnail');
echo form_upload($data) ."</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit' value='' class='createAdvtBtn' title='Create Advertise' />";
echo "</td></tr>";

echo "</table>";

echo form_close();
?>
</div>