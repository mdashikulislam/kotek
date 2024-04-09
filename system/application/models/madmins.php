<?php

class MAdmins extends Model{

	function MAdmins(){
		parent::Model();
	}


	function verifyUser($u,$pw){
		$this->db->select('id,username');
		$this->db->where('username',db_clean($u,16));
		$this->db->where('password', db_clean($pw,16));
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$Q = $this->db->get('admins');

		if ($Q->num_rows() > 0){
			$row = $Q->row_array();
            $_SESSION['customer_type'] = "admin";
			$_SESSION['customer_id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
            $_SESSION['customer_first_name']  = $row['username'];
		}else{
			//$_SESSION['customer_id'] = 0; // this will eliminate error 
			$this->session->set_flashdata('error', 'Sorry, your username or password is incorrect!');
		}		
	}
        function checkUser($u,$email){
		$this->db->select('id,username');
		$this->db->where('username',db_clean($u,16));
                $this->db->or_where('email',$email);
		$this->db->limit(1);
		$Q = $this->db->get('admins');

		if ($Q->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}		
	}
	function getUser($id){
      $data = array();
      $options = array('id' => id_clean($id));
      $Q = $this->db->getwhere('admins',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }

      $Q->free_result();    
      return $data;  		

	}
	
	function getAllUsers(){
     $data = array();
     $Q = $this->db->get('admins');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();    
     return $data; 	
	}
	
	
	function addUser(){
      $data = array('username' => db_clean($_POST['username'],16),
                    'email' => db_clean($_POST['email'],255),
                    'status' => db_clean($_POST['status'],8),
                    'password' => db_clean($_POST['password'],16)
                    );
	
	  $this->db->insert('admins',$data);
	
	}
	
	function updateUser(){
      $data = array('username' => db_clean($_POST['username'],16),
                    'email' => db_clean($_POST['email'],255),
                    'status' => db_clean($_POST['status'],8),
                    'password' => db_clean($_POST['password'],16)
                    );
	  $this->db->where('id',id_clean($_POST['id']));
	  $this->db->update('admins',$data);	
	
	}
	
	
	function deleteUser($id){
 
 	 $this->db->where('id', id_clean($id));
	 $this->db->delete('admins');
	
	}
}


?>