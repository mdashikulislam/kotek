<?php

class MPages extends Model{

	function MPages(){
		parent::Model();
	}


function getPage($id){
    $data = array();
    $this->db->where('id',id_clean($id));
    $this->db->limit(1);
    $Q = $this->db->get('pages');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
function  getFooterPages()
{
 	$data = array();
	$this->db->where('display_in','3');
	$this->db->or_where('display_in','4');
	$this->db->order_by("order_show", "asc");   
     $Q = $this->db->get('pages');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 	
}
	function  getHeaderPages()
{
 	$data = array();
	$this->db->where('display_in','2');
	$this->db->or_where('display_in','4');	
	$this->db->order_by("order_show", "asc");   
     $Q = $this->db->get('pages');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 	
}
function getPagePath($path){
    $data = array();
    $this->db->where('path',db_clean($path));
    $this->db->where('status', 'active');
    $this->db->limit(1);
    $Q = $this->db->get('pages');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllPages(){
     $data = array();
     $Q = $this->db->get('pages');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }


	
 function addPage(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'keywords' => db_clean($_POST['keywords']),
		'order_show' => db_clean($_POST['order_show']),
		'display_in' => db_clean($_POST['display_in']),
		'description' => db_clean($_POST['elm1']),
		'status' => db_clean($_POST['status'],8),
		'path' => db_clean($_POST['path']),
		'content' => $_POST['content']
	
	);

	$this->db->insert('pages', $data);	 
 }
 
 function updatePage(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'keywords' => db_clean($_POST['keywords']),
		'order_show' => db_clean($_POST['order_show']),
		'display_in' => db_clean($_POST['display_in']),
		'description' => db_clean($_POST['elm1']),
		'status' => db_clean($_POST['status'],8),
		'path' => db_clean($_POST['path']),
		'content' => $_POST['content']
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('pages', $data);	
 
 }
 
 function deletePage($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->delete('pages');	
 }
 
	
}

?>