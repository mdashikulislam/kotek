<script type="text/javascript">
  $(document).ready(function() {
   $("#colorForm").validate({
        rules: {  name:{   required : true,  minlength: 3,  maxlength: 15 } ,
		product :{   required : true,  minlength: 3,  maxlength: 15 }
		  },
        messages: { 	name: { required: "Please enter color name" }, product: { required: "Please enter product name" }
		}
	});
  });
  
  </script>
<h1><?php echo $title;?></h1>

<?php
$fdata = array('name'=>'colorForm','id'=>'colorForm');
echo form_open_multipart('admin/colors/edit', $fdata);
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=>25, 'value'=>$color['name']);
echo form_input($data) ."<font color='red'>*</font></p>";


echo "<p><label for='name'>Product</label><br/>";
$data = array('name'=>'product','id'=>'product','size'=>25, 'value'=>$color['product']);
echo form_input($data) ."<font color='red'>*</font></p>";



echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $color['status']) ."</p>";


echo "<p><label for='uimage'>Upload Image</label><br/>";
$data = array('name'=>'image','id'=>'uimage');
echo form_upload($data) ."<br/>Current image: ". $color['image']."</p>";
echo "<div>Allowed only gif,jpg or png images with file size of max 200 KB</div>";
echo "<div>&nbsp;</div>";

echo form_hidden('id',$color['id']);
echo form_submit('submit','update color');
echo form_close();


?>