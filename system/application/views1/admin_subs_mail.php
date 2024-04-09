<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
echo $this->tinyMce;
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}

echo form_open('admin/subscribers/sendemail');

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='subject'>Subject<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name' => 'subject', 'id' => 'subject', 'class' => 'textfield', 'size' => 50, 'value'=>$subject);
echo form_input($data);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='message'>Message<span class='red'>*</span> :</label></td><td>";
$data = array('name' => 'message', 'id' => 'message', 'rows' => 20, 'cols' => 50, 'value'=>$msg);
echo form_textarea($data);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td><td>".form_checkbox('test', 'true', TRUE) . " <b>This is a test!</b></td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit' value='' class='createEmailBtn' title='Send Email' />";
echo "</td></tr>";

echo "</table>";

echo form_close();
?>
</div>