<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model {

	function get_posts($DateStart, $DateEnd) {
		
	// results
		$this->db->select('*');
		$this->db->from("payments");
		
		if($this->input->post('UsrCre')){
			$this->db->where('payments.customer',$this->input->post('UsrCre'));
		} else {
			$this->db->limit(250);
		}
		
		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="payment_date BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
			$this->db->where($Date);
		}
		
		$this->db->where('payments.paid >', '0');
		$this->db->order_by("payment_date","desc");
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();

		$ret['last_query'] = $str = $this->db->last_query();
		return $ret;
	}
	
	function add_payment($data) {
		
		$this->db->insert('payments',$data);
		return $this->db->insert_id();
	}
	
	function get_payment($postID) {
		$this->db->select();
		$this->db->from('payments');
		$this->db->where('id',$postID);
		$query=$this->db->get();
		return $query->first_row('array');
	}
	
	function get_dealerpayment($postID) {
		$this->db->select('dealer.Dlrname,dealer.Balance AS DlrBalance,payments.Balance,payments.Receipt,payments.customer');
		$this->db->from('dealer');
		$this->db->join('payments', 'dealer.Dlrname = payments.customer', 'left outer');
		$this->db->where('dealer.Dlrname',$postID);
		$this->db->order_by("payment_date","desc")->limit(1,0);
		$query=$this->db->get();
		
        if ($query->num_rows() > 0) {
            return $query->first_row('array');
        }
        return 0;
		
	}
//Edit	
	function update_payment($postID,$data) {
	
		$this->db->where('id',$postID);
		$this->db->update('payments',$data);

	}

}