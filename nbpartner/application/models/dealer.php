<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer extends CI_Model {

	function get_posts($status) {
		
	// results
		$this->db->select();
		$this->db->from("dealer");
		$this->db->order_by("Dlrname","asc");
		if(!empty($status)){
			$this->db->where("Active", $status); 
		}
			$this->db->where("creator", ""."".$this->session->userdata('username').""."");
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();
		
		return $ret;
	}

	function get_user($postID) {
	// Dealer Details
		$this->db->select();
		$this->db->from('dealer');
		$this->db->where("creator", ""."".$this->session->userdata('username')."".""); 
		$this->db->where('Dlrname',$postID)->order_by('CDate','desc');
		$query=$this->db->get();
		$ret['rows'] = $query->first_row('array');

	// Dealer Packages
		$this->db->select();
		$this->db->from("dealersrates");
			$this->db->where('dealername',$postID); 
			
		$query=$this->db->get();
		$ret['pkg'] = $query->result_array();

		return $ret;
	}
	
	function create_dealer($data,$uid,$DlrPkg) {
		$this->db->insert('dealer',$data);
		
//Add New Dealer Rates
			foreach($DlrPkg as &$item) {
				if (is_array($item)) {
					$this->db->query("INSERT INTO dealersrates VALUES (NULL,'".$uid."','".$item['listname']."','".$item['price']."' )");
				}
			}
	}
	
	function edit_dlr($postID,$data) {
	
		$this->db->where('Dlrname',$postID);
		$this->db->update('dealer',$data);
	}

}