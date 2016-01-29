<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model {

	function get_posts() {
		
	// results
		$this->db->select();
		$this->db->from("payments");
		$this->db->order_by("payment_date","desc");
		
		if($this->session->userdata('DealerPerm')){
			$this->db->join('dealer', 'dealer.Dlrname = payments.customer');
		} else {
			$this->db->where('payments.customer',"".$this->session->userdata('username')."");
		}
		if($this->input->post('UsrCre')){
			$this->db->where('payments.customer',$this->input->post('UsrCre'));
		} else {
			$this->db->where('payments.customer',"".$this->session->userdata('username')."");
		}

		//if(!empty($this->input->post('DateEnd')) && !empty($this->input->post('DateStart'))){
		//	$this->db->where("payment_date BETWEEN '".$this->input->post('DateStart')." 00:00:00' AND '".$this->input->post('DateEnd')." 23:59:59'", NULL, FALSE);
		//}
		
		$this->db->where('payments.paid >', '0');
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();

		$ret['last_query'] = $str = $this->db->last_query();
		return $ret;
	}
		
	function add_payment($data) {
		$this->db->insert('userpayments',$data);
		return $this->db->insert_id();
	}
	
// user payment results
	function user_payment($num,$start=0,$uname,$UsrCre) {
		
		$this->db->select();
		$this->db->from("userpayments");
		$this->db->order_by("DpDate","desc")->limit($num,$start);
		if(!empty($uname)){
			$this->db->like("DpUserName", $uname); 
		}
		if(!empty($UsrCre)){
			$this->db->where("DpName", $UsrCre); 
		} else {
		$this->db->where("DpName","".$this->session->userdata('username').""); 
		}
			
		$query=$this->db->get();

		$ret['num_rows'] = $query->num_rows();
		if (!empty($ret['num_rows'])) {
			$ret['rows'] = $query->result_array();
		} else {
			$ret['rows'] = 0;
			$ret['num_rows'] = 0;
		}

		$ret['last_query'] = $str = $this->db->last_query();
		return $ret;
	}
	
	function get_payment($postID) {
		$this->db->select('payments.*');
		$this->db->from('payments');
		$this->db->join('dealer', 'dealer.Dlrname = payments.customer');
		$this->db->where('payments.customer',"".$this->session->userdata('username')."");
		$this->db->where('payments.id',$postID);
		$query=$this->db->get();
		return $query->first_row('array');
	}
	
	function get_userpayment($postID) {
		$this->db->select('userpayments.DpID,userpayments.DpUserName,userpayments.DpDate,userpayments.DpRecipt,userpayments.DpAmount,userpayments.DpName');
		$this->db->from('userpayments');
if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = userpayments.DpName');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('userpayments.DpName',"".$this->session->userdata('username')."");
	}
		$this->db->where('userpayments.DpID',$postID);
		$query=$this->db->get();
		return $query->first_row('array');
	}
	
//Edit	
	function update_payment($postID,$data) {
	
		$this->db->where('DpID',$postID);
		$this->db->update('userpayments',$data);

	}

}