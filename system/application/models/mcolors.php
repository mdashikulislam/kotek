<?php

class MColors extends Model{

	function MColors(){
		parent::Model();
	}

function getColor($id){
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('colors',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	function getColorName($id){
    $data = array();
     $this->db->select('name');
     $this->db->where('id',$id);
     $Q = $this->db->get('colors');
    if ($Q->num_rows() > 0){
      foreach ($Q->result_array() as $row){
       return  $row['name'];
       }
    }

    $Q->free_result();    
     
 }
 function getAllColors(){
     $data = array();
	  $this->db->select('id,name,product,status');
     $Q = $this->db->get('colors');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 function getActiveColors(){
     $data = array();
     /** Colors table has fields of id, name and status.
      * the following will select all the ids and names where status is active
      * If there are any data, then the results are stored as arrays in $row.
      * then $row name is stored in $row id.
      */
     $this->db->select('id,name,product');
     $this->db->where('status','active');
     $Q = $this->db->get('colors');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 
  function getActiveColorsProduct(){
     $data = array();
     /** Colors table has fields of id, name and status.
      * the following will select all the ids and names where status is active
      * If there are any data, then the results are stored as arrays in $row.
      * then $row name is stored in $row id.
      */
     $this->db->select('id,name,product');
     $this->db->where('status','active');
     $Q = $this->db->get('colors');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name']."(".$row['product'].")";
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 function createColor(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8),
		'product' => db_clean($_POST['product'],25)
	);

	if ($_FILES){
		$config['upload_path'] = './images/colors/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/colors/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "images/colors/".$image['file_name'];
		
			}
		}
		}
	

	$this->db->insert('colors', $data);	 
 }
 
 function updateColor(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8),
		'product' => db_clean($_POST['product'],25)
	
	);

   if ($_FILES){
		$config['upload_path'] = './images/colors/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/colors/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "images/colors/".$image['file_name'];
		
			}
		}
	}


 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('colors', $data);	
 
 }
 
 function deleteColor($id){
 //	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->delete('colors');
	
 } 
 
 
}//end class
?>