<h1 class="pageTitle"><?php echo $title;?></h1>
<p><?php echo anchor("admin/products/create", "Create new product");?> </p>
<!--p><?php echo anchor("admin/products/settings", "Product settings");?> </p-->
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if ($this->session->flashdata('error')){
	echo "<div class='error'>".$this->session->flashdata('error')."</div>";
}

?>
<script type="text/javascript">
var siteUrl = "<?php echo base_url();?>";
  </script>
  <script type="text/javascript" src="<?php echo base_url();?>js/js-functions.js" ></script>
<div>
  <form name="searchProduct" id="searchProduct" action="<?php echo base_url();?>index.php/admin/products/search" method="post">
    <div>
      <div class="dataTables_length">Search
        <select name="search" id="search" >
          <option value="name">select search by </option>
          <option value="name">product name</option>
          <option value="model">model</option>
          <option value="year">year</option>
          <option value="maker">maker</option>
        </select>
      </div>
      <div class="dataTables_filter" style="width:312px;">
        <input type="text" id="searchKeyword" name="searchKeyword" value="" style="float:left;" />
        <input type="submit" name="submit" value="" class="submitBtn" style="float:left;" />
      </div>
    </div>
  </form>
</div>
<div style="clear:both;"></div>
<div>
<form name="searchProduct" id="searchProduct" method="post" action="<?php echo base_url();?>index.php/pages/searchProduct">
                	<div class="for_contact_form">
                                                   
                            <div style="float:left; padding:0px 5px;"><label>Make:</label> <select name="make" id="make" onchange="showModel();">
                            <option value="">Select Make</option>
                            <?php $modelList = $this->MMaker->getAllMakers();  
							$make_quick =0;
							if(isset($_SESSION['make_quick']) && !empty($_SESSION['make_quick'])) { $make_quick = $_SESSION['make_quick'];	}
							foreach($modelList as $key=>$value){ $slect =""; if($make_quick == $value['id']){$slect = "selected";}
								echo '<option value="'.$value['id'].'" '.$slect.'>'.ucfirst(strtolower($value['name'])).'</option>';
								}
							
							?>
                            	
                            </select></div>
                            
                            <div style="float:left;padding:0px 5px;" id="showModel"><label>Model:</label> <select name="model" id="model">
                            <option value="">Select Model</option></select></div>
                            
                            <div style="float:left; padding:0px 5px;"><label>Year:</label> <input type="text" name="year" id="year" value="" class="textfield" /></div>
                            
                            <div style="float:left;"><label>Group:</label>
                            <select name="group" id="group">
                            <option value="">Select Group</option>
                            <?php $modelList = $this->MCats->getAllCategories(); 
							$group_quick =0;
							if(isset($_SESSION['group_quick']) && !empty($_SESSION['group_quick'])) { $group_quick = $_SESSION['group_quick'];	}
							foreach($modelList as $key=>$value){ $slect =""; if($group_quick == $value['id']){$slect = "selected";}
								echo '<option value="'.$value['id'].'" '.$slect.'>'.ucfirst(strtolower($value['name'])).'</option>';
								}
							
							?>
                            	
                            </select>
                            </div>
                            
                            
                            
                            <div style="float:left;padding:0px 5px;"><input type="submit" name="submit" value="Search" class="startSearchBtn" title="Start Search" alt="Start Search"   /></div>

                    </div> <!-- for_contact_form ends -->
                </form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jMenu.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.color.js" ></script>
<style type="text/css">
#jQ-menu ul {
	list-style-type: none;
}

#jQ-menu a, #jQ-menu li {
	color: gray;
	text-decoration: none;
	padding-bottom: 3px;
}

#jQ-menu ul {
	padding-left: 15px;
}

</style>
<div style="clear:both;">&nbsp;</div>
<div>
  <div style="width:300px; float:left;">
    <!-- Menu Start -->
    <div id="jQ-menu">
      <ul>
      <?php $groupList = $this->MCats->getAllCategories(); 
	  
	  foreach($groupList as $key=>$value)
	  {
		    $makeList = $this->MProducts->makeBygroup($value['id']);
		  echo '<li><span class="toggle">'.$value['name'].'</span>';
	  if(!empty($makeList)){
		  echo "<ul>";
	  foreach($makeList as $key1=>$value1)
	  {
		  echo '<li>'.$value1['maker_name'].'</li>';
	  }
	  echo "</ul>";
		}
		  echo '</li>';
		  
		
		  
	  }
	  
	  ?>     
      </ul>
    </div>
    <!-- End Menu -->
  </div>
  <div style="width:600px; float:right;">
    <?

if (count($products)){
	echo '<table id="" class="productTable" border="0" cellspacing="0" cellpadding="3" width="100%">';
	echo "<thead>\n<tr valign='top'>\n";
	echo "<!--th>&nbsp;</th--><th width='100px'>Product ID</th>\n<th width='300px'>Name</th><th width='50px'>Status</th><th width='150px'>Model</th><th width='150px'>Make</th><th width='126px'>Price</th><th width='80px'>Actions</th>\n";
	echo "</tr>\n</thead>\n<tbody>\n"; $xx=0;
	foreach ($products as $key => $list){
		
		$setclass ="class=''";
		if($xx%2 == 0){$setclass ="class='event'";}else{$setclass ="class='odd'";}
		echo "<tr valign='top' ".$setclass.">\n";
		echo "<!--td align='center'>".form_checkbox('p_id[]',$list['id'],FALSE)."</td-->";
		echo "<td align='center'>".$list['id']."</td>\n";
		echo "<td align='left'>".$list['name']."</td>\n";
		
		//echo "<td align='center'>".$list['grouping']."</td>\n";
		
		echo "<td align='left'>".$list['status']."</td>\n";
		
		//echo "<td align='center'>".$list['category_id']."</td>\n";
		//echo "<td align='center'>".$list['CatName']."</td>\n";
		echo "<td align='left'>".$list['model_name']."</td>\n";
		echo "<td align='left'>".$list['maker_name']."</td>\n";
		echo "<td align='center'>$".$list['price']."</td>\n";
		echo "<td align='center'>";
		//echo anchor('admin/products/edit/'.$list['id'],'edit');
		echo "<a href='".base_url()."index.php/admin/products/edit/".$list['id']."' class='icons' title='Edit'><img src='".base_url()."images/icons/edit.png' /></a>";
		//echo " | ";
		$adata = array('onclick'=>"return deletechecked('Are you sure you want to delete this product ?');");
		//echo anchor('admin/products/delete/'.$list['id'],'delete',$adata);
		echo "<a href='".base_url()."index.php/admin/products/delete/".$list['id']."' class='icons' title='Delete' onClick=\"return deletechecked('Are you sure you want to delete this product ?');\"><img src='".base_url()."images/icons/delete.png' /></a>";
		echo "</td>\n";
		echo "</tr>\n";
		$xx++;
	}
	echo "</tbody></table>";
	echo form_close();
}else{
		echo '<table id="" class="" border="0" cellspacing="0" cellpadding="3" width="100%"><tr><td colspan="7">No product found.</td></tr></table>';
		
		}
?>
  </div>
</div>
<div class="pagiWrapper"> <?php echo $this->pagination->create_links(); ?> </div>
