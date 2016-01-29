<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('payment');
	}

	function index() {
		$results=$this->payment->get_posts();
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
	
	function pedit($postID) {
		$this->load->library('form_validation');
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
		$data['success']=0;
		if($_POST){
			$data_post=array(
					'DpName'=>$this->input->post('Dealer'),
					'DpDate'=>$this->input->post('UserPaid'),
					'DpRecipt'=>$this->input->post('ReceptNo'),
					'DpAmount'=>$this->input->post('BAmount')
				);
			
			$this->payment->update_payment($postID,$data_post);
			$data['success']=1;
		}
		$data['post']=$this->payment->get_userpayment($postID);
		$this->load->view('header');
		$this->load->view('payments/edit_payment',$data);
		$this->load->view('footer');
	}

	function getuserpayments($start=0) {
			$today = date("Y-m-01"); // 2015-03-16
			//$next_month = date("Y-m-d", strtotime("$today -1 month"));
		
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
			$Date="DpDate BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
		}
			
	$uname="";
		if($this->input->post('searchterm') != false){
			 	$uname = $this->input->post('searchterm');
			}
	$UsrCre="";
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			}
			
		$this->db->select();
		$this->db->from("userpayments");
		$this->db->order_by("DpDate","desc");
		if(!empty($uname)){
			$this->db->like("DpUserName", $uname); 
		}
		if(!empty($UsrCre)){
			$this->db->where("DpName", $UsrCre); 
		} else {
		$this->db->where("DpName","".$this->session->userdata('username').""); 
		}
		if(!empty($Date)){
			$this->db->where($Date);
		} else {
			$this->db->where("DpDate > ", "'".$today."'", FALSE);
		}
		$query=$this->db->get();

		$data['posts'] = $query->result_array();
		$data['last_query']=$this->db->last_query();
		$this->load->view('header');
		$this->load->view('payments/userpayments',$data);
		$this->load->view('footer');
		
		/*
			
		$limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
		 
		$results=$this->payment->user_payment($limit=25,$start,$uname,$UsrCre);
		$data['posts']=$results['rows'];
		$data['last_query']=$results['last_query'];
		$this->load->library('pagination');
		$config['base_url']=base_url().'payments/getuserpayments/';

		$config['total_rows'] = $results['num_rows'];
		$config['per_page']=25;
		
 // twitter bootstrap markup 
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>'; $config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_link'] = '&laquo;';
		$config['prev_link'] = '&lsaquo;';
		$config['last_link'] = '&raquo;';
		$config['next_link'] = '&rsaquo;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
        
		$this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();
		$this->load->view('header');
		$this->load->view('payments/userpayments',$data);
		$this->load->view('footer');
		*/
	}
	
// Add User Payment
	function addnew($postID="") {
	$data="";
		if($_POST){

		//This method will have the credentials validation
			$this->load->library('form_validation');

				$this->form_validation->set_rules('UserName', 'User ID', 'trim|required');
				$this->form_validation->set_rules('Dealer', 'User Dealer ID', 'required|min_length[1]');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
				$this->db->where('Username', $this->input->post('UserName'));
				$this->db->where('creator', $this->input->post('Dealer'));
				$this->db->from('users');
				if($this->db->count_all_results() != 0 ){
						$this->db->where('DpUserName', $this->input->post('UserName'));
						$this->db->where('DpName', $this->input->post('Dealer'));
						$this->db->where('MONTH(DpDate) = EXTRACT(MONTH FROM (NOW()))');
						$this->db->where('YEAR(DpDate) = EXTRACT(YEAR FROM (NOW()))');
						$this->db->from('userpayments');
						$UserResult = $this->db->count_all_results();
							if ($UserResult == 0) {

								$data=array(
									'DpName'=>$this->input->post('Dealer'),
									'DpUserName'=>$this->input->post('UserName'),
									'DpRecipt'=>$this->input->post('ReceptNo'),
									'DpAmount'=>$this->input->post('BAmount')
									//'DpAdvTax'=>$this->input->post('AdvTax')
								);
								$userid=$this->payment->add_payment($data);
								redirect(base_url().'payments');
							} else {
								
						redirect(base_url().'payments/addnew?id=entryfound');
						
							}
				} else {
					
						redirect(base_url().'payments/addnew?id=check');
						
				}
			}
		}
		
//Get User Details
		$this->db->select();
		$this->db->from('users');
	if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = users.creator');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('users.creator',"".$this->session->userdata('username')."");
	}
		$this->db->where('users.Username',$postID);
		$query=$this->db->get();
		$data['post']=$query->first_row('array');
		
		$this->load->view('header');
		$this->load->view('payments/add_payment',$data);
		$this->load->view('footer');
	}
	
//test in your controller
function form222()
{
  $config = array(
        array(
            'field' => 'first_submission',
            'label' => 'First Submission',
            'rules' => 'trim|required'
          ),
        array(
            'field' => 'last_submission',
            'label' => 'Last Submission',
            'rules' => 'trim|required|callback__compare_submission_dates'
          )
      );

  $this->load->library('form_validation');
  $this->form_validation->set_rules($config);

  if($this->form_validation->run()) {
  }
}
//test in your controller

function _compare_submission_dates() {
  $_POST['first_submission'];
  $_POST['last_submission'];

          if($time_last > $time_first) {
            return TRUE;
          } else {
            $this->form_validation->set_message('_compare_submission_dates', 'First Submission must be earlier than Last Submission');
            return FALSE;
       }
  return FALSE;
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
