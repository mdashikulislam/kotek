<?php

class MCats extends Model{

	function MCats(){
		parent::Model();
	}


function getCategory($id){
    $data = array();
    $options = array('id' =>id_clean($id));
    $Q = $this->db->getwhere('categories',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllCategories(){
     $data = array();
        $this->db->where('status', 'active');
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }



 function getSubCategories($catid){
// this runs when $cat['parentid'] < 1 in controllers/welcom.php
// Which means 0 and they are main/top categories.
//e.g. 7 and 8 have parent id 0
     $data = array();
     $this->db->select('id,name,shortdesc');
     $this->db->where('parentid', id_clean($catid));
     // When $catid is 7, which has 0 for parent id, and looking for items where parentid is this 7 $catid 
     $this->db->where('status', 'active');
     $this->db->orderby('name','asc');
     $Q = $this->db->get('categories'); // this will gives series of items such as 1 shoes, 2 shirts, 3 pants etc.
     if ($Q->num_rows() > 0){// if there are items then
       foreach ($Q->result_array() as $row){//each item as an array to $row
       		$sql = "select thumbnail as src 
       				from products 
       				where category_id=".id_clean($row['id'])."
       				and status='active'
       				order by rand() limit 1";
		
       		$Q2 = $this->db->query($sql);
		// then run a quary. select one thumbnail randumly from products where category_id is $row['id']
		// e.g shirts has 2 for $row['id']
       	
			if($Q2->num_rows() > 0){
					$thumb = $Q2->row_array();
				$THUMB = $thumb['src']; // the result src which is result thumbnail is $THUMB
			}else{
				$THUMB = '';// otherwise none in $THUMB
			}
			
       		$Q2->free_result();
			$data[] = array(
				'id' => $row['id'], 
				'name' => $row['name'], 
				'shortdesc' => $row['shortdesc'],
				'thumbnail' => $THUMB
			);
       	}
    }
    $Q->free_result();  
    
    return $data; 

 }


 function getCategoriesNav(){
     $data = array();
     $this->db->select('id,name');

	 $this->db->orderby('name','asc');
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result() as $row){
	// see the output $navlist at http://127.0.0.1/codeigniter_shopping/test1/cat/7
		
				$data[0][$row->id] = $row->name;
		
		}
    }
    $Q->free_result(); 
    return $data; 
 }



 function getCategoriesDropDown(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('parentid !=',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }
function getCategoriesList(){
     $data = array();
     $this->db->select('id,name');
//     $this->db->where('parentid !=',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }
	
 function getTopCategories(){
     $data[0] = 'root';
     $this->db->where('parentid',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }	





	
 function addCategory(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'shortdesc' =>  db_clean($_POST['shortdesc']),
		'longdesc' =>  db_clean($_POST['longdesc'],5000),
		'status' =>  db_clean($_POST['status'],8),
		//'parentid' => id_clean($_POST['parentid'])
	
	);

	$this->db->insert('categories', $data);	 
 }
 
 function updateCategory(){
	$data = array( 
		'name' =>  db_clean($_POST['name']),
		'shortdesc' =>  db_clean($_POST['shortdesc']),
		'longdesc' =>  db_clean($_POST['longdesc'],5000),
		'status' =>  db_clean($_POST['status'],8),
		//'parentid' =>  id_clean($_POST['parentid'])
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('categories', $data);	
 
 }
 
 function deleteCategory($id){
 	$this->db->where('id', id_clean($id));
	$this->db->delete('categories');	
 }
 
 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("select * from categories");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 
 function checkOrphans($id){
 	$data = array();
 	$this->db->select('id,name');
 	$this->db->where('category_id',id_clean($id));
 	$Q = $this->db->get('products');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data;  	
 
 }
 
 function updateCategorySt($id,$status)
	{
      $data = array('status' => $status);
      $this->db->where('id1',$id);
      $this->db->update('categories',$data);  
	
	}
	
}

?>