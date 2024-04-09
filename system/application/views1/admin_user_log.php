<h1 class="pageTitle"><?php echo $title;?></h1>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}
if (count($products)){
	echo '<table id="" class="productTable" border="0" cellspacing="0" cellpadding="3" width="100%">';
	echo "<thead>\n<tr valign='top'>\n";
	echo "<th>ID</th>\n<th style='width:200px;'>Product name</th><th style='width:120px;'>Group </th><th>Make </th><th style='width:100px;'>Model</th><th style='width:100px;'>Year</th><th style='width:100px;'>IP</th><th style='width:150px;'>Date\time</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n";$xx=1;

foreach ($products as $key => $list){ 
	$model = "--";if(!empty($list['model'])){ 
	$model = $this->MCarmodel->getCarmodel($list['model']); 

 if(!isset($model['title'])) { $model['title'] ="--"; }
	}
	$maker =" -- ";
	if(!empty($list['make'])){
      $maker = $this->MMaker->getMaker($list['make']);
if(!isset($maker['name'])) { $maker['name'] ="--"; }
	}
		$cateogry =" -- ";
	if(!empty($list['group'])){
      $cateogry = $this->MCats->getCategory($list['group']);
if(!isset($cateogry['name'])) { $cateogry['name'] ="--"; }
	} $product = " -- ";
	if(!empty($list['product_name'])){
      $product = $list['product_name'];
	}
	$year = " -- ";
	if(!empty($list['year'])){
      $yearList = explode('-',$list['year']);
	 $year =  $yearList[0];
	}
	$setclass ="class=''";
		if($xx%2 == 0){$setclass ="class='event'";}else{$setclass ="class='odd'";}
		echo "<tr valign='top'  ".$setclass.">\n";
		//echo "<td align='center' >".form_checkbox('p_id[]',$list['customer_id'],FALSE)."</td>";
		echo "<td align='center' style='width:50px;'>".$xx."</td>\n";
		echo "<td align='center'>".$product."</td>\n";		
		echo "<td align='center'>".$cateogry['name']."</td>\n";		
		echo "<td align='center'>".$maker['name']."</td>\n";		
		echo "<td align='center'>".$model['title']."</td>\n";	//	echo "<td align='center'></td>\n";
		echo "<td align='center'>".$year."</td>\n";
		echo "<td align='center'>".$list['IP']."</td>\n";
		echo "<td align='center'>".$list['timest']."</td>\n";
		echo "</tr>\n"; $xx++;
	}
	echo "</tbody></table>";
	echo form_close();
}
?>

<div class="pagiWrapper"> <?php echo $this->pagination->create_links(); ?> </div>