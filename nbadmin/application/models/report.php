<?php

class Report extends CI_Model {

	    function getPosts($offset, $limit, $DateStart, $DateEnd, $UsrCre){
			
			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT * FROM ordersreport WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' ORDER BY DUdate DESC LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT * FROM ordersreport WHERE DUcustomer='$UsrCre' ORDER BY DUdate DESC LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT * FROM ordersreport WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' AND DUcustomer='$UsrCre' ORDER BY DUdate DESC LIMIT $offset, $limit");
			} else {
				$query = $this->db->query("SELECT * FROM ordersreport ORDER BY DUdate DESC LIMIT $offset, $limit");
			}
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			}
		return 0;
    }
	
    function getTotalPosts($DateStart, $DateEnd, $UsrCre){
	
			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd'");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUcustomer='$UsrCre'");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' AND DUcustomer='$UsrCre'");
			} else {
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport");
			}

			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->total_rows;
			}
        return 0;
    }
	
	function getUsersunit($offset, $limit, $uname, $DateStart, $DateEnd, $UsrCre){

			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT id,order_date, product_id, COUNT(user_id) AS quantity, customer_id,user_id FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' GROUP BY user_id LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, COUNT(user_id) AS quantity, customer_id,user_id FROM orders WHERE customer_id='$UsrCre' GROUP BY user_id ORDER BY order_date DESC LIMIT $offset, $limit");
			} else if(!empty($uname) && empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, COUNT(user_id) AS quantity, customer_id,user_id FROM orders WHERE user_id='$uname' GROUP BY user_id ORDER BY order_date DESC LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, COUNT(user_id) AS quantity, customer_id,user_id FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' AND customer_id='$UsrCre' GROUP BY user_id LIMIT $offset, $limit");
			} else if(!empty($uname) && !empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, COUNT(user_id) AS quantity, customer_id,user_id FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' AND user_id='$uname' GROUP BY user_id LIMIT $offset, $limit");
			} else {
				$query = $this->db->query("SELECT id,order_date, product_id, COUNT(user_id) AS quantity, customer_id,user_id FROM orders GROUP BY user_id ORDER BY order_date DESC LIMIT $offset, $limit");
			}
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			}
		return 0;
    }
	
    function getTotalUnits($uname, $DateStart, $DateEnd, $UsrCre){
	
			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd'");
			} else if(!empty($uname) && empty($DateStart)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE user_id='$uname'");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE customer_id='$UsrCre'");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' AND customer_id='$UsrCre'");
			} else if(!empty($uname) && !empty($DateStart)){
				$query = $this->db->query("SELECT * FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' AND user_id='$uname'");
			} else {
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders");
			}

			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->total_rows;
			}
        return 0;
    }
	
	function create_user($data) {
		$this->db->insert('users',$data);
	}
	
	function get_user($postID) {
		$this->db->select('users.ID,users.FullName,users.Username,users.Password,users.Usr_DeActv,users.Active,users.Phone,users.Mobile,users.Mac,users.Email,users.Comment,users.CNIC,users.UsrAdd,users.CDate,package.pname');
		$this->db->from('users');
		$this->db->join('package', 'package.listname = users.Package');
		$this->db->where('users.Username',$postID)->order_by('CDate','desc');
		$query=$this->db->get();
		return $query->first_row('array');
	}
//Edit	
	function update_user($postID,$data) {
	
		$this->db->where('Username',$postID);
		$this->db->update('users',$data);

	}
//change pw	
	function update_post($postID,$data,$data2) {
	
		$this->db->where('Username',$postID);
		$this->db->update('users',$data);
		
		$this->db->where('username',$postID);
		$this->db->where('attribute','Cleartext-Password');
		$this->db->update('radcheck',$data2);
	}

}