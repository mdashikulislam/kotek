<div id="content">
    <h1 class="productListTitle"> Distributor's List </h1>
    <div class="productListWrapper">
    <?php foreach($distributorList as $key=>$value){
    ?>
    <h2 class="distriTitle"> <?=$value['distributor_title']?> </h2>
    <div> <b><?=$value['address']?></b></div>
    <div> <b><?=$value['address2']?></b></div>
    <div> <b><?=$value['city']?></b></div>
    <div> <b><?=$value['post_code']?></b></div>

    <div> <b><?=$value['state']?></b></div>
    <div> <b><?=$value['country']?></b></div>
    <div> <b><?=$value['website']?></b></div>
    <div> <b><?=$value['phone_number']?></b></div>
    <div><a href="mailto:<?=$value['email']?>" title="<?=$value['email']?>"><?=$value['email']?></a></div>
    <div>&nbsp;</div>
    <?php } ?>
    </div>
</div>