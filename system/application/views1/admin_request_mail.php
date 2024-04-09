<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
echo $this->tinyMce;

echo form_open('admin/subscribers/sendemailRequest');

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='subject'>Subject<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name' => 'subject', 'id' => 'subject', 'class' => 'textfield', 'size' => 50, 'value'=>"");
echo form_input($data);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='message'>Message<span class='red'>*</span> :</label></td><td>";
$data = array('name' => 'message', 'id' => 'message', 'rows' => 20, 'cols' => 50, 'value'=>'');
echo form_textarea($data);
echo "</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='hidden' name='user' id='user' value='".$user_id."' />";
echo "<input type='submit' value='' class='createEmailBtn' title='Send Email' />";
echo "</td></tr>";

echo "</table>";

echo form_close();
?>
</div>