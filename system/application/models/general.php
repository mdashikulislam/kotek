<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends Model {

	function addData($table_name=null,$data=array()){
		$this->db->insert($table_name,$data);
		return true;		
	}

	function updateData($table_name=null,$data=array(),$cond=array()){
		$this->db->where($cond);
		$this->db->update($table_name,$data);
		return true;		
	}

	function deleteData($table_name=null,$cond=array()){
		$this->db->where($cond);
		$this->db->delete($table_name);
		return true;		
	}

	function getRecord($table_name=null,$cond=array()){
		$this->db->select();
		$this->db->from($table_name);
		$this->db->where($cond);
		$query = $this->db->get();
		return $query->result();
	}

	function getModelRecord(){
		$this->db->select('*');
		$this->db->from('carmodel');
		$query = $this->db->get();	
		return $query->result();
	}

	function getModelByMakeId($make_id=null){
		$this->db->select('*');
		$this->db->from('carmodel');
		$this->db->where('maker',$make_id);
		$query = $this->db->get();	
		return $query->result();	
	}

}