<?php

class Mdistributors extends Model{
 function  __construct(){
    parent::Model();
 }

	function getAllDistributors(){
	$data = array();
	$Q = $this->db->query('SELECT * FROM distributor');
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}
	
	function getDistributors(){
	$data = array();
	$Q = $this->db->query('SELECT * FROM distributor');
	// $Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
	foreach ($Q->result_array() as $row){
	 $data[] = $row;
	}
	}
	$Q->free_result();    
	return $data; 
	}

	 function getDistributor($id){
      $data = array();
      $options = array('distributor_id' => id_clean($id));
      $Q = $this->db->getwhere('distributor',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }
      $Q->free_result();
      return $data;
    }
	
		
	function createDistributor()
	{
		 $data = array(
                    'distributor_title' => db_clean($_POST['distributor_title'],25),
                    'phone_number' => db_clean($_POST['phone_number'],15),
				    'email' => db_clean($_POST['email'],50),
                    'address' => db_clean($_POST['address'],50),
                    'city' => db_clean($_POST['city'],25),
					'state' => db_clean($_POST['state'],25),
					'country' => db_clean($_POST['country'],40),
                    'post_code' => db_clean($_POST['post_code'],10),
                    'website' => db_clean($_POST['website'],50)
                  
					
     );
      $this->db->insert('distributor',$data);
		
	}
	    function updateDistributor(){
      $data = array('distributor_title' => db_clean($_POST['distributor_title'],250),
                    'phone_number' => db_clean($_POST['phone_number'],15),
                    'email' => db_clean($_POST['email'],50),
                    'address' => db_clean($_POST['address'],50),
                    'city' => db_clean($_POST['city'],25),
					'state' => db_clean($_POST['state'],25),
					'country' => db_clean($_POST['country'],40),
                    'post_code' => db_clean($_POST['post_code'],10),
					'website' => db_clean($_POST['website'],50)
               
                    );

      $this->db->where('distributor_id',id_clean($_POST['distributor_id']));
      $this->db->update('distributor',$data);   
 
    }
	
	 function deleteUser($customer_id){
		$this->db->where('distributor_id', id_clean($customer_id));
		$this->db->delete('distributor');	
	 }

   
    
}//end class
?>