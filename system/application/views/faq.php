<h2 class='innerPageTittle'>FAQ</h2>
<div class='contentWrapper' style="min-height:400px;">
<?php
foreach($faqlist as $key=>$value){
?>
<div><div> <b><?=$value['question']?></b></div> <div><?=$value['description']?></div></div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<?php } ?>
</div>