<script type="text/javascript">
  $(document).ready(function() {
 
  $("#newsForm").validate({
        rules: {  title:{   required : true,  minlength: 3,  maxlength: 100 },  
		description:{   required : true,  minlength: 3,  maxlength: 100 }  
		  },
        messages: { 	title: { required: "Please enter news title" },
		description: { required: "Please enter description" }
		}
	});
      });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata = array('name'=>'newsForm','id'=>'newsForm');
echo form_open_multipart('admin/news/edit', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='name'>Title<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'title','id'=>'title','class'=>'textfield','size'=>25, 'value'=>$news['title']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $news['status']) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Description<span class='red'>*</span> :</label></td><td>\n";
$data = array('name'=>'description','id'=>'description','rows'=>5, 'cols'=>'40', 'value'=>$news['description']);
echo form_textarea($data) ."</td>\n";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";

echo form_hidden('id',$news['id']);
echo "<input type='submit' value='' class='updateNewsBtn' title='Update News' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>
