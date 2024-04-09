<?php
echo '<pre>
<h1>code</h1>
function cat($id){
  	
	$cat = $this->MCats->getCategory($id);
	// $id is the thirdn in URI which represents the ID and any variables that will be passed to the controller.
	$data[\'category\'] = $cat;
	$data[\'main\'] = \'category\';
	$data[\'navlist\'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view(\'mytest/test1\');
 }

<h2>$category</h2>';
print_r ($category);
echo'<br /><h2>$main</h2>';
print_r ($main);
echo'<br /><h2>$navlist</h2>';
print_r ($navlist);
echo "</pre>";
?>