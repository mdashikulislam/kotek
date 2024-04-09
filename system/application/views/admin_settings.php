<h1><?php echo $title;?></h1>

<?php

echo form_open_multipart('admin/products/settings');

echo "<p><label for='short'>".$product[0]['setting_name']."</label><br/>";
$data = array('name'=>'lace','id'=>'lace','size'=>40, 'value' => $product[0]['setting_price']);
echo form_input($data) ."</p>";

echo "<p><label for='long'>".$product[1]['setting_name']."</label><br/>";
$data = array('name'=>'personal','id'=>'personal','rows'=>5, 'cols'=>'40', 'value' => $product[1]['setting_price']);
echo form_input($data) ."</p>";


echo form_submit('submit','update');
echo form_close();


?>