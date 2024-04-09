<script type="text/javascript">


  $(document).ready(function() {
   $("#fontForm").validate({
        rules: {  title:{   required : true,  minlength: 3,  maxlength: 15 }
		  },
        messages: { 	title: { required: "Please enter model name" }
		}
	});
  });
  
  </script>

<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata =  array('name'=>'fontForm', 'id'=>'fontForm');
echo form_open_multipart('admin/carmodel/edit', $fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='name'>Name<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'title','id'=>'title','class'=>'textfield','size'=>25, 'value'=>$color['title']);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr style='display:none;'>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Description :</label></td><td>\n";
$data = array('name'=>'carmodel_desc','id'=>'carmodel_desc','rows'=>5, 'cols'=>'40', 'value'=>$color['description']);
echo form_textarea($data) ."</td>\n";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Maker : </label></td><td>\n";
$maker_list = $this->MCarmodel->getCarMaker();
echo "<select name='maker' id='maker'>";
foreach($maker_list as $key=>$value)
{
$selct =""; if($color['maker'] == $key){$selct ="selected"; }
 echo "<option value='".$key."' ".$selct.">".$value."</option>";}
echo "</select>";
echo "</td>\n";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo form_hidden('id',$color['id']);
echo "<input type='submit' value='' class='updateModelBtn' title='Update Group' />";
echo "</td></tr>";

echo "</table>";

echo form_close();

?>
</div>