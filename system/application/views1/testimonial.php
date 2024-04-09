<h2 class='innerPageTittle'>Testimonials</h2>
<div class='contentWrapper'>
<?php foreach($testimonialList as $key=>$value){
?>
<div> <?=$value['description']?><br/> <b><?=$value['title']?></b></div>
<div>&nbsp;</div>
<?php } ?>
</div>