<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Badlogin extends CI_Model {

	function get_posts() {
		
//Users Creator POST

		
	// results
		$this->db->select();
		$this->db->from("radpostauth");
		$this->db->group_by("username"); 
		$this->db->order_by("authdate","desc");
		
		if($this->session->userdata('DealerPerm')){
			$this->db->join('dealer', 'dealer.Dlrname = radpostauth.creator');
			//$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
		} else {
			$this->db->where('radpostauth.creator',"".$this->session->userdata('username')."");
		}
		if($this->input->post('UsrCre')){
			$this->db->where('radpostauth.creator',$this->input->post('UsrCre'));
		} else {
			$this->db->where('radpostauth.creator',"".$this->session->userdata('username')."");
		}
/*		
		if($this->input->post('UsrCre') != false){
				$this->db->where("creator", $this->input->post('UsrCre')); 
		} else {
			$this->db->where("creator","".$this->session->userdata('username').""); 
		}
*/
		$this->db->where("reply","Access-Reject");
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();

		$ret['last_query'] = $str = $this->db->last_query();
		return $ret;
	}

}