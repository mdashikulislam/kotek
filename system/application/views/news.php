<h2 class='innerPageTittle'>News and Events</h2>
<div class='contentWrapper'>
<?php foreach($newsList as $key=>$value){
?>
<div><b><?=$value['title']?></b></div>
<div> <?=$value['description']?></div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<?php } ?>
</div>