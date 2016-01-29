<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Model {

	    function getPosts($offset, $limit, $DateStart, $DateEnd, $UsrCre){
			
			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' AND DUcustomer='"."".$this->session->userdata('username').""."' ORDER BY DUdate DESC LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE DUcustomer='$UsrCre' ORDER BY DUdate DESC LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' AND DUcustomer='$UsrCre' ORDER BY DUdate DESC LIMIT $offset, $limit");
			} else {
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE DUcustomer='"."".$this->session->userdata('username').""."' ORDER BY DUdate DESC LIMIT $offset, $limit");
			}
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			}
		return 0;
    }
	
    function getTotalPosts($DateStart, $DateEnd, $UsrCre){
	
			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' AND DUcustomer='"."".$this->session->userdata('username').""."' ");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUcustomer='$UsrCre'");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUdate BETWEEN '$DateStart' AND '$DateEnd' AND DUcustomer='$UsrCre'");
			} else {
				$query = $this->db->query("SELECT count(DUcustomer) as total_rows FROM ordersreport WHERE DUcustomer='"."".$this->session->userdata('username').""."'");
			}

			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->total_rows;
			}
        return 0;
    }
	
	function getUsersunit($offset, $limit, $uname, $DateStart, $DateEnd, $UsrCre){

			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT id,order_date, product_id, quantity, customer_id,user_id FROM orders WHERE user_id='$uname' AND order_date BETWEEN '$DateStart' AND '$DateEnd' AND customer_id='"."".$this->session->userdata('username').""."' LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, quantity, customer_id,user_id FROM orders WHERE user_id='$uname' AND customer_id='$UsrCre' ORDER BY order_date DESC LIMIT $offset, $limit");
			} else if(!empty($uname) && empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, quantity, customer_id,user_id FROM orders WHERE user_id='$uname' AND customer_id='"."".$this->session->userdata('username').""."' ORDER BY order_date DESC LIMIT $offset, $limit");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, quantity, customer_id,user_id FROM orders WHERE user_id='$uname' AND order_date BETWEEN '$DateStart' AND '$DateEnd' AND customer_id='$UsrCre' LIMIT $offset, $limit");
			} else if(!empty($uname) && !empty($DateStart)){
				$query = $this->db->query("SELECT id,order_date, product_id, quantity, customer_id,user_id FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' AND user_id='$uname' AND customer_id='"."".$this->session->userdata('username').""."' LIMIT $offset, $limit");
			} else {
				$query = $this->db->query("SELECT id,order_date, product_id, quantity, customer_id,user_id FROM orders WHERE customer_id='"."".$this->session->userdata('username').""."' ORDER BY order_date DESC LIMIT $offset, $limit");
			}
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			}
		return 0;
    }
	
    function getTotalUnits($uname, $DateStart, $DateEnd, $UsrCre){
	
			if(!empty($DateStart) && empty($UsrCre)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE user_id='$uname' AND order_date BETWEEN '$DateStart' AND '$DateEnd' AND customer_id='"."".$this->session->userdata('username').""."'");
			} else if(!empty($uname) && empty($DateStart)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE user_id='$uname' AND customer_id='"."".$this->session->userdata('username').""."'");
			} else if(!empty($UsrCre) && empty($DateStart)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE user_id='$uname' AND customer_id='$UsrCre'");
			} else if(!empty($UsrCre) && !empty($DateStart)){
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE user_id='$uname' AND order_date BETWEEN '$DateStart' AND '$DateEnd' AND customer_id='$UsrCre'");
			} else if(!empty($uname) && !empty($DateStart)){
				$query = $this->db->query("SELECT * FROM orders WHERE order_date BETWEEN '$DateStart' AND '$DateEnd' AND user_id='$uname' AND customer_id='"."".$this->session->userdata('username').""."'");
			} else {
				$query = $this->db->query("SELECT count(user_id) as total_rows FROM orders WHERE customer_id='"."".$this->session->userdata('username').""."'");
			}

			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->total_rows;
			}
        return 0;
    }


}