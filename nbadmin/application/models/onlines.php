<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onlines extends CI_Model {

	function getPosts() {

//Users POST
		$uname="0";
		if($this->input->post('username') != false){
			 	$uname = $this->input->post('username', true);
			}		
			
//Users Creator POST
		$UsrCre="";
		if($this->input->post('UsrCre') != false){
		 	$UsrCre = $this->input->post('UsrCre', true);
		}

//RASIP Address POST
		$RasIP="";
		if($this->input->post('RASIP') != false){
		 	$RasIP = $this->input->post('RASIP', true);
		}
			
	// results
		$this->db->select('*');
		$this->db->from('radacct');
	if(!empty($UsrCre)){
		$this->db->where('radacct.creator',$UsrCre);
	} else if(!empty($uname)){
		$this->db->like('radacct.username',$uname);
	} else if(!empty($RasIP)){
		$this->db->where('radacct.nasipaddress',$RasIP);
	} else {
		$this->db->limit(250, 0);
	}
		$this->db->where("acctstoptime IS NULL");
		$this->db->order_by("acctstarttime", "desc"); 
		
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();

		$ret['last_query'] = $str = $this->db->last_query();
			
	// results
		$this->db->select('*');
		$this->db->from('radacct');
	if(!empty($UsrCre)){
		$this->db->where('radacct.creator',$UsrCre);
	}
	if(!empty($uname)){
		$this->db->like('radacct.username',$uname);
	}
		$this->db->where("acctstoptime IS NULL");
		$this->db->order_by("acctstarttime", "desc"); 
		
		$query=$this->db->get();
		$ret['total_rows'] = $query->num_rows();

		return $ret;
	}
	
}