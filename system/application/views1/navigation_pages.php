<?php
	$currentPage  = $this->uri->segment(2);
	
	
  	/*echo "\n<ul id=\"nudgeUs\">";
	echo "\n<li class='cat'>\n".anchor("welcome/customer_care/","Customer Care")."\n</li>\n";
	echo "\n<li class='cat'>\n".anchor("welcome/about_us/","About Us")."\n</li>\n";
	echo "\n<li class='cat'>\n".anchor("welcome/company_info/","Company Info")."\n</li>\n";
	echo "\n<li class='cat'>\n".anchor("welcome/website_info/","Wesite Info")."\n</li>\n";
	echo "\n<li class='cat' >\n".anchor("welcome/contact/","Contact Us")."\n</li>\n";
  echo "\n</ul>\n";*/

?>

<ul id="nudgeUs">
<li class='cat <?php if($currentPage == 'customer_care') echo "active-link"; ?>'><?php echo anchor("welcome/customer_care/","Customer Care"); ?></li>
<li class='cat <?php if($currentPage == 'about_us') echo "active-link"; ?>'><?php echo anchor("welcome/about_us/","About Us"); ?></li>
<li class='cat <?php if($currentPage == 'company_info') echo "active-link"; ?>'><?php echo anchor("welcome/company_info/","Company Info"); ?></li>
<li class='cat <?php if($currentPage == 'website_info') echo "active-link"; ?>'><?php echo anchor("welcome/website_info/","Website Info"); ?></li>
<li class='cat <?php if($currentPage == 'contact') echo "active-link"; ?>'  ><?php echo anchor("welcome/contact/","Contact Us"); ?></li>
</ul>