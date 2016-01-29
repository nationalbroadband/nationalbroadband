<?php

class Badlogin extends CI_Model {

	function get_posts() {

		if($this->input->post('searchterm') != false){
			 	$uname = $this->input->post('searchterm');
			}
			
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			}
//Users Creator GET
		if($this->input->get('Dlr') != false){
			 	$UsrCre = $this->input->get('Dlr');
			}
			
	// results
		$this->db->select();
		$this->db->from("radpostauth");
		$this->db->group_by("username"); 
		//$this->db->order_by("authdate","desc")->limit($num,$start);
		if(!empty($uname)){
			$this->db->like("username", $uname); 
		}
		
		if(!empty($UsrCre)){
			$this->db->where('creator',$UsrCre);
		}
		
		$this->db->where("reply","Access-Reject"); 
			
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();
		$ret['last_query'] = $str = $this->db->last_query();

	// count
		$this->db->select("COUNT(username) AS count", FALSE);
		$this->db->from("radpostauth");
		$this->db->group_by("username"); 
		if(!empty($uname)){
			$this->db->like("username", $uname); 
		}
		$this->db->where("reply","Access-Reject"); 
		$tmp=$this->db->get()->result();
		
	if(!empty($tmp)) {
		$ret['num_rows'] = $tmp['0']->count;
	} else {
		$ret['num_rows'] = "0";
	}
	
		return $ret;
	}

}