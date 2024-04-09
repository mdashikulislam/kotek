<?php

class MSubscribers extends Model{

	function MSubscribers(){
		parent::Model();
	}

function getSubscriber($id){
    $this->db->where('id',id_clean($id));
    $this->db->limit(1);
    $Q = $this->db->getwhere('subscribers');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllSubscribers(){
     $data = array();
     $Q = $this->db->get('subscribers');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 
 function createSubscriber(){
	$this->db->where('email', $_POST['subscribe_email']);
	$this->db->from('subscribers');
	$ct = $this->db->count_all_results();

	if ($ct == 0){
		$data = array( 
			'name' => db_clean(" "),
			'email' => db_clean($_POST['subscribe_email'])	
		);

		$this->db->insert('subscribers', $data);	 
 	return 1;
 	}else{
	return 0;	
	}
 }
 function createSubscriberAjax($email){
	$this->db->where('email', $email);
	$this->db->from('subscribers');
	$ct = $this->db->count_all_results();

	if ($ct == 0){
		$data = array( 
			'name' => db_clean(" "),
			'email' => db_clean($email)	
		);

		$this->db->insert('subscribers', $data);	 
 	return 1;
 	}else{
	return 0;	
	}
 }
 
 function updateSubscriber(){
	$data = array( 
		//'name' => db_clean($_POST['name']),
		'email' => db_clean($_POST['subscribe_email'])
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('subscribers', $data);	
 
 }
 
 function removeSubscriber($id){
 	$this->db->where('id', id_clean($id));
	$this->db->delete('subscribers');
	
 } 

/*********************************  section for user request ****************************************/
 
  function getAllReqeusts(){
     $data = array();
     $Q = $this->db->get('user_request');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
  function removeRequest($id){
 	$this->db->where('id', id_clean($id));
	$this->db->delete('user_request');
	
 } 
 
 function getRequest($id){
    $this->db->where('id',id_clean($id));
    $this->db->limit(1);
    $Q = $this->db->getwhere('user_request');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }

}//end class
?>