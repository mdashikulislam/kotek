<?php

class MVideos extends Model{

	function MVideos(){
		parent::Model();
	}


function getPage($id){
    $data = array();
    $this->db->where('id',id_clean($id));
    $this->db->limit(1);
    $Q = $this->db->get('videos');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }

function getPagePath($path){
    $data = array();
    $this->db->where('path',db_clean($path));
    $this->db->where('status', 'active');
    $this->db->limit(1);
    $Q = $this->db->get('videos');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllVidoes(){
     $data = array();
     $Q = $this->db->get('videos');
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
		'description' => db_clean($_POST['description']),
		'status' => db_clean($_POST['status'],8),
		'path' => db_clean($_POST['path']),
		'content' => $_POST['content']
	
	);

	$this->db->insert('videos', $data);	 
 }
 
 function updatePage(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'keywords' => db_clean($_POST['keywords']),
		'description' => db_clean($_POST['description']),
		'status' => db_clean($_POST['status'],8),
		'path' => db_clean($_POST['path']),
		'content' => $_POST['content']
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('videos', $data);	
 
 }
 
 function deletePage($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->delete('videos', $data);	
 }
 
	
}

?>