<?php

class MDimensions extends Model{

	function MDimensions(){
		parent::Model();
	}


function getDimensions($id){
    $data = array();
    $options = array('id' =>id_clean($id));
    $Q = $this->db->getwhere('dimensions',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllDimensions(){
     $data = array();
     $Q = $this->db->get('dimensions');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }



 function getDimensionsDropDown(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('parentid !=',0);
     $Q = $this->db->get('dimensions');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }
function getDimensionsList(){
     $data = array();
     $this->db->select('id,name');
//     $this->db->where('parentid !=',0);
     $Q = $this->db->get('dimensions');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }
	
 function addDimensions(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		
		'status' =>  db_clean($_POST['status'],8),
		//'parentid' => id_clean($_POST['parentid'])
	
	);

	$this->db->insert('dimensions', $data);	 
 }
 
 function updateDimensions(){
	 
	
	$data = array( 
		'name' =>  db_clean($_POST['name']),
		'status' =>  db_clean($_POST['status'],8),
		//'parentid' =>  id_clean($_POST['parentid'])
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('dimensions', $data);	
 
 }
 
 function deleteDimensions($id){
 	$this->db->where('id', id_clean($id));
	$this->db->delete('dimensions');	
 }
 
 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("select * from dimensions");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 
 function getAllProductDimensions($productId)
 {
	 $Q = $this->db->query("select * from product_dimensions where product_id ='".$productId."'");
	 $data = array();
		if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
		$data[] = $row;
		}
		}
		$Q->free_result();  
		return $data; 
  }
 
 	
}

?>