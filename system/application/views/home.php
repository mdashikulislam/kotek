<?php /*?><div id='pleft'>
<?php
  echo "<img src='".$mainf['image']."' border='0' align='left'/>\n";
  echo "<h2>".$mainf['name']."</h2>\n";
  echo "<p>".$mainf['shortdesc'] . "<br/>\n";
  echo anchor('welcome/product/'.$mainf['id'],'see details') . "<br/>\n";
  echo anchor('welcome/cart/'.$mainf['id'],'add to cart') . "</p>\n";
?>

<br style='clear:both'><br/>

<?php
if ($this->session->flashdata('subscribe_msg')){
	echo "<div class='message'>";
	echo $this->session->flashdata('subscribe_msg');
	echo "</div>";
}
?>

<?php echo validation_errors(); ?>

<?php echo form_open("welcome/subscribe"); ?>
<?php echo form_fieldset('Subscribe To Our Newsletter'); ?>
<h5>*Name</h5>
<input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" size="40" />

<h5>*Email</h5>
<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" size="40" />

<h5>*Are you human?</h5>
<?php echo "<p>$cap_img</p>" ;?>
<input type="text" name="captcha" value="" size="40" />



<div><input type="submit" value="Subscribe" /></div>
<?php echo form_fieldset_close(); ?>

<?php echo form_close(); ?>

</div>

<div id='pright'>
<?php
  foreach ($sidef as $key => $list){
    echo "<div class='productlisting'>";
    echo '<a href="' . site_url(). '/welcome/product/'.$list['id']. '">';
    echo "<img src='".$list['thumbnail']."' border='0' class='thumbnail'/></a>\n";
    echo "<h4>".$list['name']."</h4>\n";
    echo anchor('welcome/product/'.$list['id'],'see details') . "<br/>\n";
    echo anchor('welcome/cart/'.$list['id'],'add to cart') . "\n</div>";
  }
?>


</div><?php */?>
<?php
if ($this->session->flashdata('subscribe_msg')){
	echo "<div class='message'>";
	echo $this->session->flashdata('subscribe_msg');
	echo "</div>";
}
?>