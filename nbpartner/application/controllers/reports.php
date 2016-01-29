<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('report');
	}

     function index(){

	if($_POST){
	
//Users Creator POST
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			} else {
				$UsrCre = $this->session->userdata('username');
			}
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');

//Calander Start Date
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
//Calander END Date
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}

		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="DUdate BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
		}			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,COUNT(DUserID) AS DUserID,SUM(DUAmount) AS DUAmount,SUM(DUcount) AS DUcount,SUM(taxamount) AS taxamount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE DUcustomer='$UsrCre' GROUP BY DUpakage,DUprice ORDER BY DUserID ASC");
			}

			if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,COUNT(DUserID) AS DUserID,SUM(DUAmount) AS DUAmount,SUM(DUcount) AS DUcount,SUM(taxamount) AS taxamount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE $Date AND DUcustomer='$UsrCre' GROUP BY DUpakage,DUprice ORDER BY DUserID ASC");
			}
			
			if ($query->num_rows() > 0){
				$data['posts']=$query->result_array();
			} else {
				$data['posts']="0";
			}
			
			
			if(!empty($UsrCre) && empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

			if(!empty($UsrCre) && !empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$this->db->where($Date);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

		//$data['pagelink']=$this->db->last_query();
		
		$this->load->view('header', $data);
        $this->load->view('reports/reports_index', $data);
		$this->load->view('footer');
		
		} else {
		
			$this->load->view('header');
			$this->load->view('reports/reports_index');
			$this->load->view('footer');
		}

     }

// UNITS REPORT ****** PRINT ******	 DONE
	function unitreports() {

	if($_POST){
	
//Users Creator POST
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			} else {
				$UsrCre = $this->session->userdata('username');
			}
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');

//Calander Start Date
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
//Calander END Date
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}

		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="DUdate BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";

				$this->db->select('id');
				$this->db->from('payments');
				$this->db->where('customer',$UsrCre);
				$this->db->where("payment_date BETWEEN '$DateStart' AND '$DateEnd'");
				$query=$this->db->get();
				$data['payment']=$query->first_row('array');
		}			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount,DUdate,DUprice,product_tax,taxamount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE DUcustomer='$UsrCre' ORDER BY DUdate ASC");
			} else if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount,DUdate,DUprice,product_tax,taxamount FROM ordersreport INNER JOIN package on ordersreport.DUpakage=package.listname WHERE $Date AND DUcustomer='$UsrCre' ORDER BY DUdate ASC");
			} else {
				$query = $this->db->query("SELECT package.pname AS DUpakage,DUcount,DUserID,DUAmount,DUdate,DUprice,product_tax,taxamount FROM ordersreport WHERE DUcustomer='$UsrCre' ORDER BY DUdate ASC");
			}
			
			if ($query->num_rows() > 0){
				$data['posts']=$query->result_array();
			} else {
				$data['posts']="0";
			}
			
			if(!empty($UsrCre) && empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

			if(!empty($UsrCre) && !empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$this->db->where($Date);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

		//$data['pagelink']=$this->db->last_query();

		$this->load->view('reports/reports_print',$data);
		
		} else {
			redirect(base_url().'reports');
		}
	}
	
// Current Month UNITS REPORT ****** PRINT ******	 DONE
	function usersreports() {

	if($_POST){
	
//Users Creator POST
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			} else {
				$UsrCre = $this->session->userdata('username');
			}
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');

//Calander Start Date
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
//Calander END Date
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}

		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="order_date BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";

				$this->db->select('id');
				$this->db->from('payments');
				$this->db->where('customer',$UsrCre);
				$this->db->where("payment_date BETWEEN '$DateStart' AND '$DateEnd'");
				$query=$this->db->get();
				$data['payment']=$query->first_row('array');
		}			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT order_date,user_id,product_id,SUM(quantity) AS DUcount,product_price AS price,product_tax,(product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
					WHERE customer_id='$UsrCre' GROUP BY product_id,product_price,user_id ORDER BY order_date ASC");
			} else if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT order_date,user_id,product_id,SUM(quantity) AS DUcount,product_price AS price,product_tax,(product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
					WHERE $Date AND customer_id='$UsrCre' GROUP BY product_id,product_price,user_id ORDER BY order_date ASC");
			} else {
				$query = $this->db->query("SELECT order_date,user_id,product_id,SUM(quantity) AS DUcount,product_price AS price,product_tax,(product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
					GROUP BY product_id,product_price,user_id ORDER BY order_date DESC");
			}
			
			if ($query->num_rows() > 0){
				$data['posts']=$query->result_array();
			} else {
				$data['posts']="0";
			}
			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT SUM(user_id) AS user_id, SUM(DUAmount) AS DUAmount,SUM(TaxAmount) AS TaxAmount FROM (
					SELECT COUNT(user_id) AS user_id, (product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
						WHERE customer_id='".$UsrCre."' GROUP BY product_id,product_price,user_id
					) dum");
				$data['Total']=$query->first_row('array');
				}

			if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT SUM(user_id) AS user_id, SUM(DUAmount) AS DUAmount,SUM(TaxAmount) AS TaxAmount FROM (
					SELECT COUNT(user_id) AS user_id, (product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
						WHERE ".$Date." AND customer_id='".$UsrCre."' GROUP BY product_id,product_price,user_id
					) dum");
				$data['Total']=$query->first_row('array');
				}

		//$data['pagelink']=$this->db->last_query();

		$this->load->view('reports/usersreports_print',$data);
		
		} else {
			redirect(base_url().'reports');
		}
	}
//Dealer Payments Report
	function paymentreport() {
		//$data['post']=$this->report->get_payments();
		$data['dealername'] = $this->session->userdata('username');
		$this->load->view('header');
		$this->load->view('reports/paymentreport_list',$data);
		$this->load->view('footer');
	}
	
//Without Pagination	
	function correct_permissions($required) {
		$user_type=$this->session->userdata('user_type');
		if($required=="user"){
			if($user_type=="user"){
				return true;
			}
		}elseif($required=="author"){
			if($user_type=="admin" || $user_type=="author"){
				return true;
			}
		}elseif($required=="admin"){
			if($user_type=="admin"){
				return true;
			}
		}
		
	}

 }
