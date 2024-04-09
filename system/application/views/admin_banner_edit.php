<script type="text/javascript">

  $(document).ready(function() {

   $("#bannerForm").validate({

        rules: {  title:{   required : true,  minlength: 3,  maxlength: 100 }

		  },

        messages: { 	title: { required: "Please enter banner title" }

		}

	});

  });

  

  </script>

<h1 class="pageTitle"><?php echo $title;?></h1>

<div class="dashboardWrapper">

<?php

$fdata = array('name'=>'bannerForm','id'=>'bannerForm');

echo form_open_multipart('admin/banner/edit', $fdata);



echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";



echo "<tr>";

echo "<td width='150'><label for='name'>Title<span class='red'>*</span> :</label></td><td width='810'>";

$data = array('name'=>'title','id'=>'title','class'=>'textfield','size'=>25, 'value'=>$banner['title']);

echo form_input($data) ."</td>";

echo "</tr>";



echo "<tr>";

echo "<td><label for='name'>Set Order :</label></td><td>";

$data = array('name'=>'place_order','id'=>'place_order','class'=>'textfield','size'=>25, 'value'=>$banner['place_order']);

echo form_input($data) ."</td>";

echo "</tr>";



echo "<tr>";

echo "<td><label for='status'>Status :</label></td><td>";

$options = array('active' => 'active', 'inactive' => 'inactive');

echo form_dropdown('status',$options, $banner['status']) ."</td>";

echo "</tr>";



echo "<tr>";
echo "<td><label for='uimage'>Upload Image<span class='red'>*</span> :</label></td><td><span style='vertical-align:top;'>";
$data = array('name'=>'image','id'=>'image');
echo form_upload($data) ."</span>&nbsp;&nbsp;<img src='".base_url().$banner['image']."' width='80' height='60' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='uimage'>Upload thumbnail<span class='red'>*</span> :</label></td><td><span style='vertical-align:top;'>";
$data = array('name'=>'thumbnail','id'=>'thumbnail');
echo form_upload($data) ."</span>&nbsp;&nbsp;<img src='".base_url().$banner['thumbnail']."' width='80' height='60' /></td>";
echo "</tr>";



echo "<tr><td>&nbsp;</td><td>";

echo form_hidden('id',$banner['id']);

echo "<input type='submit' value='' class='updateBannerBtn' title='Update Banner' />";

echo "</td></tr>";



echo "</table>";



echo form_close();



?>

</div>