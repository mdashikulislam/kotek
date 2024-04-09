<?php
//page 91

function cat($id){
$cat = $this-> MCats-> getCategory($id);
if (!count($cat)){
redirect('welcome/index','refresh');
}
$data['title'] = "Power Steering Kit Specialist | ". $cat['name'];
if ($cat['parentid'] < 1){
//show other categories
}else{
//show products
}
$data['category'] = $cat;
$data['main'] = 'category';
$data['navlist'] = $this-> MCats-> getCategoriesNav();
$this -> load -> vars($data);
$this -> load -> view('template');
}