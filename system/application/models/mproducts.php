<?php

class MProducts extends Model{
 function MProducts(){
    parent::Model();
 }

 function getProduct($id){
  /**
   * input $id 
   * output one item of id, name, shortdesc, longdesc, thumbnail, image, groupting, status, category_id
   * featured, price
   * from products table
   */
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('products',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }


function getProductOrder($id){
  /**
   * input $id 
   * output one item of id, name, shortdesc, longdesc, thumbnail, image, groupting, status, category_id
   * featured, price
   * from products table
   */
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('products',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }

 function getAllProducts($fromLt, $per_page , $sortfield, $orderby){
     $data = array();
     if($sortfield == '')
	 {
		  $sortfield = 'p.id';
	 }
	 else
	 {
		 if($sortfield == 'maker')
		 {
			 $sortfield = 'm.name';
		 }
		 else if($sortfield == 'model')
		 {
			 $sortfield = 'c.title';
		 }
		 else if($sortfield == 'cat_name')
		 {
			 $sortfield = 'k.name';
		 }
		 else
		 {
		    $sortfield = 'p.'.$sortfield;
		 }
	 }
	 if($orderby == '')
	 {
		  $orderby = 'asc';
	 }
	
     $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name ,k.name as cat_name FROM categories k, products p, carmodel c 
		LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id and k.id = p.category_id order by '.$sortfield.' '.$orderby.' limit '.$fromLt.','.$per_page.' ');
		
    // $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
 }
 function getAllProductsCount(){
     $data = array();
     $Q = $this->db->query('SELECT P.*, C.Name AS CatName FROM products AS P LEFT JOIN categories C ON C.id = P.category_id ');
    // $Q = $this->db->get('products');
    return $Q->num_rows();
 }
 function getAllProductsCountSearch($searchKeyword,$searchby)
 { 
		$model_search =""; $make_search = ""; $product_like ="";  $year_search =""; $group_search ="";  $price_search =""; $status_search ="";
		if(!empty($searchby) && $searchby == 'model') {$model_search = " AND  c.title like '%".$searchKeyword."%' "; } // car model
		if(!empty($searchby) && $searchby == 'maker') {$model_search = " AND  m.name like '%".$searchKeyword."%' "; } // maker
		if(!empty($searchby) && $searchby == 'name') {$product_like = " AND  p.name like '%".$searchKeyword."%' "; } // product
		if(!empty($searchby) && $searchby == 'year')  {$year_search = " AND p.year_to >= '".$searchKeyword."' AND year_from <= '".$searchKeyword."' "; } //year
if(!empty($searchby) && $searchby == 'part_number') {$product_like = " AND  p.part_number like '%".$searchKeyword."%' "; } // product part number
		if(!empty($searchby) && $searchby == 'group')  {$group_search = "  AND p.category_id = (SELECT id FROM categories WHERE `name` LIKE '%".$searchKeyword."%' ) ";  } //group
		if(!empty($searchby) && $searchby == 'price')  {$price_search = " AND p.price = '".$searchKeyword."' "; } //year
		if(!empty($searchby) && $searchby == 'status')  {$status_search = " AND p.status = '".$searchKeyword."' "; } //year
		
		
		
		$data = array();
		$limit ="";  //echo $fromLt;
	
		$Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name ,k.name as cat_name FROM categories k, products p, carmodel c 
		LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id and k.id = p.category_id'.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.' '.$price_search.''.$status_search.' '.$limit.'');
		
		return $Q->num_rows();	
	 
  }
 function getAllProductsSearch($searchKeyword,$searchby,$from,$per_page ,$sortfield ,$orderby)
 { 
         if($sortfield == '')
		 {
			  $sortfield = 'p.id';
		 }
		 else
		 {
			 if($sortfield == 'maker')

			 {
				 $sortfield = 'm.name';
			 }
			 else if($sortfield == 'model')
			 {
				 $sortfield = 'c.title';
			 }
			 else if($sortfield == 'cat_name')
			 {
				 $sortfield = 'k.name';
			 }
			 else
			 {
				$sortfield = 'p.'.$sortfield;
			 }
		 }
		 if($orderby == '')
		 {
			  $orderby = 'asc';
		 }
		$model_search =""; $make_search = ""; $product_like ="";  $year_search =""; $group_search =""; $price_search =""; $status_search ="";
		if(!empty($searchby) && $searchby == 'model') {$model_search = " AND  c.title like '%".$searchKeyword."%' "; } // car model
		if(!empty($searchby) && $searchby == 'maker') {$model_search = " AND  m.name like '%".$searchKeyword."%' "; } // maker
		if(!empty($searchby) && $searchby == 'name') {$product_like = " AND  p.name like '%".$searchKeyword."%' "; } // product
		if(!empty($searchby) && $searchby == 'year')  {$year_search = " AND p.year_to >= '".$searchKeyword."' AND year_from <= '".$searchKeyword."' "; } //year
		if(!empty($searchby) && $searchby == 'part_number') {$product_like = " AND  p.part_number like '%".$searchKeyword."%' "; } // product part number
		if(!empty($searchby) && $searchby == 'group')  {$group_search = "  AND p.category_id = (SELECT id FROM categories WHERE `name` LIKE '%".$searchKeyword."' ) ";  } //group
		if(!empty($searchby) && $searchby == 'price')  {$price_search = " AND p.price = '".$searchKeyword."' "; } //year
		if(!empty($searchby) && $searchby == 'status')  {$status_search = " AND p.status = '".$searchKeyword."' "; } //year
		
		
		$data = array();
		 if(!empty($per_page)){$limit = "limit $from,$per_page ";}
	
		$Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name ,k.name as cat_name FROM categories k, products p, carmodel c 
		LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id and k.id = p.category_id'.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.' '.$price_search.''.$status_search.' order by '.$sortfield.' '.$orderby.' '.$limit.'');
		
		 if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
	 
  }
 function getProductsByCategory($catid){
  // this is used in function cat($id) in pages.php
  // When a product is clicked this will be used.
  // If not $cat['parentid'] < 1
  // $catid is given in URI, the third element
     $data = array();
     $this->db->select('id,name,shortdesc,thumbnail');
     $this->db->where('category_id', id_clean($catid));
     $this->db->where('status', 'active');
     $this->db->orderby('name','asc');
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
 } 
 
 
  function getProductsByGroup($limit,$group,$skip){
   // page 99
   // for controllers/welcome.php function product($id)
     $data = array();
     if ($limit == 0){
     	$limit=3;
     }
     $this->db->select('id,name,shortdesc,thumbnail');
     $this->db->where('grouping', db_clean($group,16));
     $this->db->where('status', 'active');
     $this->db->where('id !=', id_clean($skip));
     $this->db->orderby('name','asc');
     $this->db->limit($limit);
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
 } 
 
 
 function getMainFeature(){
     $data = array();
     $this->db->select("id,name,shortdesc,image");
     $this->db->where('featured','true');
     $this->db->where('status', 'active');
     $this->db->order_by('name','random'); 
     $this->db->limit(1);
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data = array(
         	"id" => $row['id'],
         	"name" => $row['name'],
         	"shortdesc" => $row['shortdesc'],
         	"image" => $row['image']
         	);
       }
    }
    $Q->free_result();    
    return $data;  
 
 }
 
 
function getRandomProducts($limit,$skip){
	$data = array();
	$temp = array();
	if ($limit == 0){
	$limit=3;
	}
	$this->db->select("id,name,thumbnail,category_id");
	$this->db->where('id !=', id_clean($skip));
	 $this->db->where('status','active');
	$this->db->orderby("category_id","asc"); 
	$this->db->limit(100);
	$Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
			$temp[$row['category_id']] = array(
				"id" => $row['id'],
				"name" => $row['name'],
				"thumbnail" => $row['thumbnail']
         	);
		}
	}

	shuffle($temp);
	if (count($temp)){
		for ($i=1;$i<=$limit; $i++){
			$data[] = array_shift($temp);
		} 
	}
	$Q->free_result();    
	return $data;  
}


function search($term){
	$data = array();
	$this->db->select('id,name,shortdesc,thumbnail');
	$this->db->where("(name LIKE '%$term%' OR shortdesc LIKE '%$term%' OR longdesc LIKE '%$term%') AND status='active'"); 
    
    $this->db->orderby('name','asc');
    $this->db->limit(50);
    $Q = $this->db->get('products');
 
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data;
}
 
 function addProduct(){

$procounter =  $_POST['procounter'];
$i =1;
$price = $_POST['price'];
if(empty($price)){$price = 0;}
for($i=1 ;$i<= $procounter;$i++)
{
	$year_from =  $_POST['year_from_'.$i];
$year_to =  $_POST['year_to_'.$i];
$model =  $_POST['model_'.$i];

if(!empty($year_from) && !empty($year_to) && !empty($model) ){
	
	$data = array( 
		'name' => db_clean($_POST['name']),
		'shortdesc' => db_clean($_POST['shortdesc']),
		'longdesc' => db_clean($_POST['longdesc'],5000),
		//'dimensions' => db_clean($_POST['dimensions'],5000),		
		'status' => db_clean($_POST['status'],8),
		'category_id' => db_clean($_POST['group'],16),
		'year_from' => db_clean($year_from,4),
		'year_to' => db_clean($year_to,4),
		'price' => db_clean($price,16),
		'model' => db_clean($model,16),
        'image' => $_POST['image'],
        'part_number' => $_POST['part_number']
	
	);

	 if ($_FILES){
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '800';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
    	$this->upload->initialize($config);
		if (strlen($_FILES['image_up']['name'])){
			if(!$this->upload->do_upload('image_up')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/products/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = $image['file_name'];
		
			}
		}
	
	} 
	$this->db->insert('products', $data);		
	$new_product_id = $this->db->insert_id();
	//$this->updateDimensions($new_product_id);
	
 }
}
  
}
 
 function updateProduct(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'shortdesc' => db_clean($_POST['shortdesc']),
		'longdesc' => db_clean($_POST['longdesc'],5000),
	//	'dimensions' => db_clean($_POST['dimensions'],5000),		
		'status' => db_clean($_POST['status'],8),
		'category_id' => db_clean($_POST['group'],16),
		'year_from' => db_clean($_POST['year_from'],4),
		'year_to' => db_clean($_POST['year_to'],4),
		'price' => db_clean($_POST['price'],16),
		'model' => db_clean($_POST['model'],16),
		'image' => $_POST['image'],
		'part_number' => $_POST['part_number']
	
	);
	 if ($_FILES){
		
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '800';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
		$this->upload->initialize($config);
	    if (strlen($_FILES['image_up']['name'])){
			if(!$this->upload->do_upload('image_up')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/products/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = $image['file_name'];
		
			}
		}
		
	} 
 	$this->db->where('id', $_POST['id']);
	$this->db->update('products', $data);	
		$this->updateDimensions($_POST['id']);

 }
 function updateDimensions($product_id)
 {
	  $Q = $this->db->query('Delete from product_dimensions where product_id = "'.$product_id.'"');
	  $dimensionList = $_POST['dimentionsList'];
	  $dimensions = $_POST['dimensions'];
	 
	  foreach($dimensionList as $key=>$value)
	  {
		  
		  $Q = $this->db->query('insert into product_dimensions (dimension_id,dimension_value,product_id)values("'.$value.'" , "'.$dimensions[$key].'","'.$product_id.'")');
	  }
	  
 }
 
 function deleteProduct($id){
 	$this->db->where('id', id_clean($id));
	$this->db->delete('products');	
 }
	
	
  function batchUpdate(){
  	if (count($this->input->post('p_id'))){
  		$data = array('category_id' => id_clean($this->input->post('category_id')),
  					'grouping' => db_clean($this->input->post('grouping'))
  					);
  		$idlist = implode(",",array_values($this->input->post('p_id')));
		$where = "id in ($idlist)";
  		$this->db->where($where);
  		$this->db->update('products',$data);
  		$this->session->set_flashdata('message', 'Products updated');
  	}else{
    	$this->session->set_flashdata('message', 'Nothing to update!');
	} 
  
  }

 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("SELECT p.id, p.name, p.shortdesc, p.longdesc, p.thumbnail, p.image, p.status, p.featured, p.price, p.part_number, p.year_from, p.year_to,  p.dimensions, CONCAT( m.name, '_', m.id ) AS maker_name, CONCAT( c.title, '_', c.id ) AS model_name, CONCAT( k.name, '_', k.id ) AS category
FROM carmodel c
LEFT JOIN maker m ON m.id = c.maker, products p
LEFT JOIN categories k ON k.id = p.category_id
WHERE p.model = c.id
ORDER BY p.id");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 function importCsv(){
 	
	$config['upload_path'] = './csv/';
	$config['allowed_types'] = 'csv';
	$config['max_size'] = '2000';
	$config['remove_spaces'] = true;
	$config['overwrite'] = true;
	$this->load->library('upload', $config);
  	$this->load->library('CSVReader'); 
  	
	if(!$this->upload->do_upload('csvfile')){
		$this->upload->display_errors();
		exit();
	}
	$csv = $this->upload->data();
	$path = $csv['full_path'];
	
	return $this->csvreader->parseFile($path);
 }
 
 function csv2db(){
 	unset($_POST['submit']);
 	unset($_POST['csvgo']);
 	
 	foreach ($_POST as $line => $data){
 		if (isset($data['id'])){
 			$this->db->where('id',$data['id']);
 			unset($data['id']);
 			$this->db->update('products',$data);	
 		}else{
 			$this->db->insert('products',$data);
 		}
 	}
 }
 
 
 function reassignProducts(){
 	$data = array('category_id' => $this->input->post('categories'));
	$idlist = implode(",",array_keys($this->session->userdata('orphans')));
	$where = "id in ($idlist)";
 	$this->db->where($where);
 	$this->db->update('products',$data);
 } 
 
 
 function getAssignedColors($id){
 	$data = array();
 	$this->db->select('color_id');
 	$this->db->where('product_id',id_clean($id));
 	$Q = $this->db->get('products_colors');
    if ($Q->num_rows() > 0){
     /**
      * products_colors table have product_id and color_id
      * This will select color_id. where product_id=$id.
      * e.g. product id = 7 may have color_id 2, 3, 4.
      */
      
       foreach ($Q->result_array() as $row){
         $data[] = $row['color_id'];
       }
    }
    $Q->free_result();    
    return $data; 	
 }
 
 
 function getAssignedSizes($id){

 	$data = array();
 	$this->db->select('size_id');
 	$this->db->where('product_id',id_clean($id));
 	$Q = $this->db->get('products_sizes');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row['size_id'];
       }
    }
    $Q->free_result();    
    return $data; 	
 } 

 
function getSettings()
{
	 $data = array();
     $Q = $this->db->query('SELECT * FROM settings');
    // $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data;
}

	function updateSettings()
	{

		
		$personal = $_POST['personal'];
		$data = array('setting_price' => $personal);
 		$this->db->where('id', '2');
		$this->db->update('settings', $data);	
		
		
		$lace = $_POST['lace'];
		$data = array('setting_price' => $lace);
 		$this->db->where('id', '1');
		$this->db->update('settings', $data);
	}
	
		
	function searchProductList($fromLt,$per_page,$pagination)
	{
	//var_export($_POST);	
	//$fromLt = $this->uri->segment(8);
	if($pagination == 1){ 
 			        $make = $this->uri->segment(3);
					$group =  $this->uri->segment(4);
					$model =  $this->uri->segment(5);
					$product = $this->uri->segment(6);
					$year =  $this->uri->segment(7);
					$partno = $this->uri->segment(8);

	}else{
	$make =  db_clean($_POST['make']);
	$group =  db_clean($_POST['group']);
	$model =  db_clean($_POST['model']);
	$product =  db_clean($_POST['product']);
	$year =  db_clean($_POST['year']);
	//changed for warning issue
	if(isset($_POST['partno'])){
		$partno =  db_clean($_POST['partno']);
	}
	}
	$model_search =""; $make_search = ""; $product_like ="";  $year_search =""; $partno_search =""; $group_search ="";
	if(!empty($model)) {$model_search = " AND  p.model ='".$model."' "; }
	if(!empty($make)) {$make_search = " AND  c.maker ='".$make."' "; }
	if(!empty($group)) {$group_search = " AND  p.category_id ='".$group."' "; }
	if(!empty($product)) {$product_like = " AND  p.name like '".$product."%' "; }
	if(!empty($year)) {$year_search = " AND p.year_to >= '".$year."' AND year_from <= '".$year."' "; }
	if(!empty($partno)) {$partno_search = " AND  p.part_number like'".$partno."%' "; }
	$this->saveLog($product,$make,$model,$year,$group);
 	 $data = array();
	 $limit ="";  //echo $fromLt;
	 if(!empty($per_page)){$limit = "limit $fromLt,$per_page ";}
     $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.'  '.$partno_search.' '.$limit.'');
	/*  echo 'SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.' '.$limit.''; */

	 
    // $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result(); 
    return $data;	
	}
	
	function searchProductListCount($fromLt,$pagination)
	{
	//	echo $pagination;
		//var_export($_POST);	
//	$fromLt = $this->uri->segment(8);
	if($pagination == 1){ 
	
 			        $make = $this->uri->segment(3);
					$group =  $this->uri->segment(4);
					$model =  $this->uri->segment(5);
					$product = $this->uri->segment(6);
					$year =  $this->uri->segment(7);
					$partno = $this->uri->segment(8);

	}else{ 
	$make =  db_clean($_POST['make']);
	$group =  db_clean($_POST['group']);
	$model =  db_clean($_POST['model']);
	$product =  db_clean($_POST['product']);
	$year =  db_clean($_POST['year']);
	//changed for warning issue
	if(isset($_POST['partno'])){
		$partno =  db_clean($_POST['partno']);
	}
	}
	$model_search =""; $make_search = ""; $product_like ="";  $year_search =""; $partno_search =""; $group_search ="";
	if(!empty($model)) {$model_search = " AND  p.model ='".$model."' "; }
	if(!empty($make)) {$make_search = " AND  c.maker ='".$make."' "; }
	if(!empty($group)) {$group_search = " AND  p.category_id ='".$group."' "; }
	if(!empty($product)) {$product_like = " AND  p.name like '".$product."%' "; }
	if(!empty($year)) {$year_search = " AND p.year_to >= '".$year."' AND year_from <= '".$year."' "; }
	if(!empty($partno)) {$partno_search = " AND  p.part_number like'".$partno."%' "; }
	//$this->saveLog('',$make,$model,$year,$group);
 	 $data = array();
     $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.'  '.$partno_search.' '.$year_search.'');
    if ($Q->num_rows() > 0){
     $row = $Q->num_rows();        
	}
    else{
		$row = 0;
		}
   	return $row;
	}
	
	
	function searchProductListAjax()
	{
	//var_export($_POST);	
	if(isset($_SESSION['make'])){ $make =  db_clean($_SESSION['make']); }else{ $make ="";}
	if(isset($_SESSION['group'])){ $group =  db_clean($_SESSION['group']); }else{ $group ="";}
	if(isset($_SESSION['model'])){ $model =  db_clean($_SESSION['model']); }else{ $model ="";}
	//$product =  db_clean($_POST['product']);
        $model_search =""; $make_search = ""; $product_like ="";  $year_search =""; $group_search ="";
	if(isset($_SESSION['year'])){ $year =  db_clean($_SESSION['year']); }else{ $year ="";}
	$model_search =""; $make_search = ""; $product_like ="";  $year_search ="";
	if(!empty($model)) {$model_search = " AND  p.model ='".$model."' "; }
	if(!empty($make)) {$make_search = " AND  c.maker ='".$make."' "; }
	if(!empty($group)) {$group_search = " AND  p.category_id ='".$group."' "; }
	//if(!empty($product)) {$product_like = " AND  p.name like '".$product."%' "; }
	if(!empty($year)) {$year_search = " AND p.year_to >= '".$year."' AND year_from <= '".$year."' "; }
	
	$this->saveLog('',$make,$model,$year,$group);
	
 	 $data = array();
     $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.'');
/* 	 echo 'SELECT c.*,m.name as maker_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$make_search.' '.$product_like.'';
*/
	 
    // $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
	
	
    return $data;
	
	
	
	}
	
	
	// function to save log
	function saveLog($product_name,$make,$model,$year,$group)
	{                $IP = $_SERVER['REMOTE_ADDR'];
		$user_id =0; if(isset($_SESSION['customer_id'])) { $user_id = $_SESSION['customer_id']; }
		 if(empty($model)){ $model =0;} 
		 if(empty($make)){ $model =0;} 
		 if(empty($group)){ $group =0;} 
		 $date =date('Y:m:d h:m:s');
		 $Q = $this->db->query("insert into user_log(`product_name`,`make`,`model`,`year`,`group`,`user_id`,`IP`,`timest`)values('$product_name','$make','$model','$year','$group','$user_id','$IP','$date')");
		
 	}
// function to get product list 
	function getAllProductList()
	{
	$Q = $this->db->query("SELECT * FROM products GROUP BY NAME");	 
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	$data[] = $row;
	}
	}
	$Q->free_result();    
	return $data;
	}
	
	
	// function to get all product list in quick search	
	function quickSearchProductList($make,$group,$year)
	{

	
	$model_search =""; $make_search = ""; $product_like ="";  $year_search =""; $partno_search ="";  $group_search ="";
	if(!empty($make)) {$make_search = " AND  c.maker ='".$make."' "; }
	if(!empty($group)) {$group_search = " AND  p.category_id ='".$group."' "; }
	if(!empty($year)) {$year_search = " AND p.year_to >= '".$year."' AND year_from <= '".$year."' "; }


 	 $data = array();
	 $limit ="";  //echo $fromLt;
	 if(!empty($per_page)){$limit = "limit $fromLt,$per_page ";}
     $Q = $this->db->query('SELECT p.name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.' '.$partno_search.' group by p.name '.$limit.'');
	/*  echo 'SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$group_search.' '.$make_search.' '.$product_like.' '.$year_search.' '.$limit.''; */

	 
    // $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result(); 
    return $data;	
	}
	
 // function to get list of make by group
	
	function makeBygroup($group)
	{
		 $data = array();

    	 $Q = $this->db->query('SELECT m.name as maker_name FROM products p, carmodel c 
		LEFT JOIN maker m ON m.id = c.maker WHERE p.category_id = "'.$group.'" GROUP BY m.id ');
    // $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
		
	}
	function updateProductSt($id,$status)
	{
     $data = array('status' => $status);
      $this->db->where('id',$id);
      $this->db->update('products',$data);  
	
	}

}//end class
?>