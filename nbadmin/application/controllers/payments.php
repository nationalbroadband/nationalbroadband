<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('payment');
	}

	function index() {

//Calander Start Date
		$DateStart="0";
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart')." 00:00:00";
			}
//Calander END Date
		$DateEnd="0";
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd')." 23:59:59";
			}			
//Users Creator POST
		$UsrCre="0";
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			}
//Users Creator GET
		if($this->input->get('Dlr') != false){
			 	$UsrCre = $this->input->get('Dlr');
			}

		$results=$this->payment->get_posts($DateStart, $DateEnd);
		$data['posts']=$results['rows'];
		//$data['last_query']=$results['last_query'];
		$data['last_query']="";

		$this->load->view('header', $data);
        $this->load->view('payments/payments_index', $data);
		$this->load->view('footer');
     }
	 
	function pview($postID) {
		$data['post']=$this->payment->get_payment($postID);
		$this->load->view('header');
		$this->load->view('payments/payments',$data);
		$this->load->view('footer');
	}
	
	function payments_print($postID) {
		$data['post']=$this->payment->get_payment($postID);

		$this->load->view('payments/payments_print',$data);

	}
	 
	
	function pedit($postID) {
		$this->load->library('form_validation');
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
		$data['success']=0;
		if($_POST){
			$data_post=array(
					'Description'=>$_POST['comment'],
					'Amount'=>$_POST['BAmount'],
					'paid'=>$_POST['PaidAmt'],
					'Discount'=>$_POST['Discount'],
					'Balance'=>$_POST['BAmount'] - ($_POST['PaidAmt'] + $_POST['Discount']),
					'Receipt'=>$_POST['ReceptNo'],
					'PaymentType'=>$_POST['PaymentType'],
					'ChequeNo'=>$_POST['ChequeNo'],
					'ModifyBy'=>$_POST['Author']
				);
			
			$this->payment->update_payment($postID,$data_post);
			$data['success']=1;
		}
		$data['post']=$this->payment->get_payment($postID);
		$this->load->view('header');
		$this->load->view('payments/edit_payment',$data);
		$this->load->view('footer');
	}

	function addnew($postID="") {
	$data="";
		if($_POST){
		
			$config=array(
				array(
				'field'=>'BAmount',
				'rules'=>'required'
				),
				array(
				'field'=>'PaidAmt',
				'rules'=>'required'
				),
				array(
				'field'=>'ReceptNo',
				'rules'=>'required'
				),
				array(
				'field'=>'Dealer',
				'rules'=>'required'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE) {
				$data['errors']=validation_errors();
			} else {
				$data=array(
					'Description'=>$_POST['comment'],
					'Amount'=>$_POST['BAmount'],
					'paid'=>$_POST['PaidAmt'],
					'customer'=>$_POST['Dealer'],
					'Discount'=>$_POST['Discount'],
					'Balance'=>$_POST['BAmount'] - ($_POST['PaidAmt'] + $_POST['Discount']),
					'AddedBy'=>$_POST['Author'],
					'Receipt'=>$_POST['ReceptNo'],
					'PaymentType'=>$_POST['PaymentType'],
					'ChequeNo'=>$_POST['ChequeNo']
				);
				$data3=array(
					'Description'=>"Remaining Balance...",
					'Amount'=>$_POST['BAmount'] - ($_POST['PaidAmt'] + $_POST['Discount']),
					'paid'=>0,
					'customer'=>$_POST['Dealer'],
					'Discount'=>0,
					'Balance'=>$_POST['BAmount'] - ($_POST['PaidAmt'] + $_POST['Discount']),
					'AddedBy'=>$_POST['Author'],
					'Receipt'=>$_POST['ReceptNo'],
					'PaymentType'=>$_POST['PaymentType'],
					'ChequeNo'=>$_POST['ChequeNo']
				);
		if(!empty($_POST['Dlrname'])){
				$data2=array(
					'Balance'=>$_POST['BAmount'] - ($_POST['PaidAmt'] + $_POST['Discount'])
				);
					$this->db->where('Dlrname',$_POST['Dealer']);
					$this->db->update('dealer',$data2);
			}
				$this->db->insert('payments',$data);
			
				$userid=$this->payment->add_payment($data3);
			//http://221.132.117.58:7700/sendsms_url.html?Username=03028501744&Password=123.123&From=Business&To=03322184182&Message=Name%20Testing
			//Massage Sending Start Here
			$myString = "090909090";
			$SMSNumbers = explode(',', $myString);
			foreach($SMSNumbers as $to){
				echo $my_Array.'<br>';  
				$username = '00000000';
				$password = 'Ghatia123';
				$from = 'NAMECOMPANY';
				$message = 'Payment Amount '.$this->input->post('PaidAmt').' Added Into  Dealer ID '.$this->input->post('Dealer').' by '.$this->session->userdata('username').' having ip '.$this->input->ip_address().' On NAMECOMPANY Billing';
				$url = "http://ipaddress:port/sendsms_url.html?Username=".$username."&Password=" .$password.
				"&From=" .urlencode($from). "&To=" .$to."&Message=" .urlencode($message)." ";
				//Curl Start
				$ch = curl_init();
				$timeout = 30;
				curl_setopt ($ch,CURLOPT_URL, $url) ;
				curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
				$response = curl_exec($ch) ;
				curl_close($ch) ;
			}
			//Write out the response
			//echo $response;
			// Massage Sending END Here

		//$response="Off";
				redirect(base_url().'dealers/dealer/'.$_POST['Dealer'].'?SMS='.$response);
			}
		}
		
		$data['post']=$this->payment->get_dealerpayment($postID);
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('payments/add_payment',$data);
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
