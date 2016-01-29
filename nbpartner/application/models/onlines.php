<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Onlines extends CI_Model {


	function get_posts() {
			
//Users Creator POST
		$UsrCre="";
		if($this->input->post('UsrCre') != false){
		 	$UsrCre = $this->input->post('UsrCre');
		} else {
			$UsrCre = "".$this->session->userdata('username')."";
		}
			
	// results
		$this->db->select('radacct.username, radacct.address, radacct.acctstoptime, radacct.acctsessiontime, radacct.acctstarttime, radacct.acctinputoctets, radacct.acctoutputoctets, radacct.framedipaddress');
		$this->db->from('radacct');
		$this->db->join('package', 'package.listname = radacct.package');
	if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = radacct.creator');
		//$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('radacct.creator',"".$this->session->userdata('username')."");
	}
	if($this->input->post('UsrCre')){
		$this->db->where('radacct.creator',$this->input->post('UsrCre'));
	} else {
		$this->db->where('radacct.creator',"".$this->session->userdata('username')."");
	}
		$this->db->where("acctstoptime IS NULL");
		
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();

		$ret['last_query'] = $str = $this->db->last_query();
		return $ret;
	}
	
}