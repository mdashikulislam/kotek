<script type="text/javascript">


$(document).ready(function() {
   $("#faqForm").validate({
        rules: {  question:{   required : true,  minlength: 3,  maxlength: 250 },
		faq_desc:{   required : true,  minlength: 3,  maxlength: 600 }
		  },
        messages: { 	question: { required: "Please enter FAQ question" },
		faq_desc: { required: "Please enter FAQ answer" }
		}
	});
  });
  
  </script>

<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata =  array('name'=>'faqForm', 'id'=>'faqForm');
echo form_open_multipart('admin/faq/create', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='name'>Question<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'question','id'=>'question','class'=>'textfield','size'=>25);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Answer<span class='red'>*</span> :</label></td><td>\n";
$data = array('name'=>'faq_desc','id'=>'faq_desc','rows'=>5, 'cols'=>'40');
echo form_textarea($data) ."</td>\n";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit' value='' class='createFaqBtn' title='Create FAQ' />";
echo "</td></tr>";

echo "</table>";

echo form_close();
?>
</div>