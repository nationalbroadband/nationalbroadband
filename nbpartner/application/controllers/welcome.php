<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->load->helper('short_digits');
		$this->load->view('header');
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}
	
	public function test() {
		$this->load->view('header');
		$this->load->view('test');
		$this->load->view('footer');
	}
	
	function profile() {

	// Dealer Details
		$this->db->select();
		$this->db->from('dealer');
		$this->db->where('Dlrname',""."".$this->session->userdata('username').""."")->order_by('CDate','desc');
		$query=$this->db->get();
		$data['post'] = $query->first_row('array');

	// Dealer Users Count
		$this->db->select('COUNT(Username) AS TotalUsers,users.creator,users.Package');
		$this->db->from("dealer");
		$this->db->join('users', 'users.creator = dealer.Dlrname');
		$this->db->where('users.creator',"".$this->session->userdata('username')."")->order_by('users.Package','asc');
		$this->db->where('users.Active','1');
		$this->db->group_by("users.Package");
			
		$query=$this->db->get();
		$data['users'] = $query->result_array();
		
	// Dealer Current Payments
		$this->db->select('payments.paid,payments.payment_date,payments.customer');
		$this->db->from('dealer');
		$this->db->join('payments', 'dealer.Dlrname = payments.customer', 'left outer');
		$this->db->where('YEAR(payment_date) = YEAR(CURRENT_DATE)');
		$this->db->where('MONTH(payment_date) = MONTH(CURRENT_DATE)');
		$this->db->where('payments.paid > 0');
		$this->db->where('dealer.Dlrname',"".$this->session->userdata('username')."")->order_by("payment_date","desc");
		$this->db->order_by('payment_date', 'desc'); 
		//$this->db->limit(5);
		$query=$this->db->get();
		$data['payment'] = $query->result_array();
		
	// Dealer Monthly Payments
		$query = $this->db->query("SELECT customer,DATE_FORMAT(DATE(payment_date), '%M - %Y') AS mDate,SUM(paid) AS PaidAmount FROM payments WHERE customer='".$this->session->userdata('username')."' AND paid > 0 AND payment_date > (NOW() - INTERVAL 6 MONTH) GROUP BY MONTH(payment_date) DESC;");
		$data['monthlypay'] = $query->result_array();

	// Dealer Monthly Units Report
		$query = $this->db->query("SELECT DUcustomer,DATE_FORMAT(DATE(DUdate), '%M - %Y') AS DUdate,SUM(DUAmount) AS totalAmount FROM ordersreport WHERE DUcustomer='".$this->session->userdata('username')."' AND DUdate > (NOW() - INTERVAL 6 MONTH) GROUP BY DUcustomer,MONTH(DUdate) DESC;");
		$data['monthlyunits'] = $query->result_array();

		
		$this->load->view('header');
		$this->load->view('dealersprofile',$data);
		$this->load->view('footer');
	}
	
	function password() {
		$this->load->library('user_agent');
		$data['success']=0;
		if($_POST){
		//This method will have the credentials validation
			$this->load->library('form_validation');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
				$data_post=array(
					//'Dlrname'=>$this->input->post('DlrID'),
					'DlrPswd'=>md5($this->input->post('password'))
					);
				$this->db->where('Dlrname',""."".$this->session->userdata('username').""."");
				$this->db->update('dealer',$data_post);
			
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$this->session->userdata('username')."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'DlrPwd');
				$this->db->insert('action_logs', $actionlogs);
			}
					
			$data['success']=1;
			
			//redirect(base_url().'welcome/profile');
		}
	// Dealer Details
		$this->db->select();
		$this->db->from('dealer');
		$this->db->where('Dlrname',""."".$this->session->userdata('username').""."");
		$query=$this->db->get();
		$data['post'] = $query->first_row('array');
		
		$this->load->view('header');
		$this->load->view('dealerpw',$data);
		$this->load->view('footer');
	}
	
	function msg($msgid) {

	// Dealer Details
		$this->db->select();
		$this->db->from('dbadmin_msgs');
	if(!empty($msgid)){
		$this->db->where('Msgaly',$msgid);
	} else {
		$this->db->order_by('MsgDate','desc');	
	}
		$query=$this->db->get();
		$data['post'] = $query->first_row('array');
		
		$this->load->view('header');
		$this->load->view('billmsgs',$data);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */