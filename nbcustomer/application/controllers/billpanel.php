<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Billpanel extends CI_Controller {
//User Details
	public function index(){
		if(!$this->correct_permissions('user')){
			redirect(base_url().'billpanel/login');
		}
		$this->load->model('user');
		$data['post']=$this->user->get_user($this->session->userdata('UserID'));
		$this->load->view('header');
		$this->load->view('welcome_message',$data);
		$this->load->view('footer');
	}
//User Password Change	
	function PWChange() {
		$this->load->library('form_validation');
		$this->load->model('user');
		if(!$this->correct_permissions('user')){
			redirect(base_url().'billpanel/login');
		}
		$data['success']=0;
		if($_POST){
			$data['success']=$this->user->update_post($this->session->userdata('UserID'),$_POST['curpassword'],$_POST['password'], $_POST['repassword']);
		}
		$data['post']=$this->user->get_user($this->session->userdata('UserID'));
		$this->load->view('header');
		$this->load->view('edit_userpw',$data);
		$this->load->view('footer');
	}
	
//User Login
	function login() {
		session_start();
		$data['error']=0;
		if($_POST){
			$config=array(
				array(
				'field'=>'username',
				'rules'=>'trim|required'
				),
				array(
				'field'=>'password',
				'rules'=>'trim|required'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE) {
				$data['errors']=validation_errors();
			} else {
			
				$this->load->model('user');
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				$captcha=$this->input->post('captcha',true);
				$validCaptcha = $this->check_captcha($captcha);
				
				if(!$validCaptcha){
					$data=array(
						'user_id'=>$username,
						'ipadd'=>$this->input->ip_address(),
						//'client_user_agent'=>$this->agent->agent_string(),
						//'referer_page'=>$this->agent->referrer(),
						'request_uri'=>$this->input->server('REQUEST_URI'),
						'Action'=>'Retry',
						'dept'=>'AdminPage'
					);
					
					$data['loginerror']=2;

					//$this->_create_captcha();
					$data['username'] = $username;
					$data['password'] = $password;
					return $this->load->view('login',$data);
				}
				
				$user=$this->user->login($username,$password);
				if($validCaptcha && !$user){
					$data['loginerror']=1;
				} else {
					$this->session->set_userdata('UserID',$user['Username']);
					$this->session->set_userdata('user_type','user');
					$this->session->set_userdata('username',$user['creator']);
					redirect(base_url());
				}
			}
			$data['username'] = $username;
			$data['password'] = $password;
		}

		//$this->_create_captcha();
		$this->load->view('login',$data);
	}
//User Logout
	function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
//Permissions	
	function correct_permissions($required) {
		$user_type=$this->session->userdata('user_type');
		if($required=="user"){
			if($user_type=="user"){
				return true;
			}
		}
	}
	
	//cal and create captcha image//
	function _create_captcha(){
		$this->load->helper('captcha');
		$cap = create_captcha(time());  
		
		//$_SESSION['count'] = $cap['count'];
		//imagepng($cap['image'],"./style/".$cap['count'].".png");
		$count = glob("./style/captcha/*.png");
		
		print json_encode(array('count' => $count[count($count)-1]));
	}
	  
	  //refresh Captcha
	  public function refresh_captcha(){
		  
		  $this->_create_captcha();
	  }
	  
	  /**check for valid captcha**/
	   function check_captcha($string){
		if($string==$_SESSION['captcha_string']){
			  return true;
		}else{
			session_destroy();
			 return false;
			}
		  } 
		  
	///////////
	
	
	function usage() {
	//Users POST
		$uname="0";
	 	$uname = $this->session->userdata('UserID');
	//Calander Start Date
		$DateStart="0";
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
	//Calander END Date
		$DateEnd="0";
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}
	//Users Creator POST
		// $UsrCre="0";
		// if($this->input->post('UsrCre') != false){
			 	// $UsrCre = $this->input->post('UsrCre');
			// }	
		if(!empty($DateStart) && !empty($DateEnd)){
			//print "$DateStart";die();
			$DateStart = date("Y-m-d", strtotime($DateStart));
			$DateEnd = date("Y-m-d", strtotime($DateEnd));
			$Date="radacct_archive.acctstarttime BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
		} else {
			$DateEnd = date("Y-m-d"); // 2015-03-16
			$DateStart = date("Y-m-d", strtotime("-1 DAYS"));
			$Date="radacct_archive.acctstarttime BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
		}
	//Slect from radacct_archive START
		$this->db->select('radacct_archive.username, radacct_archive.framedipaddress, radacct_archive.acctstoptime, radacct_archive.acctsessiontime, radacct_archive.acctstarttime, radacct_archive.acctinputoctets, radacct_archive.acctoutputoctets');
		$this->db->from('radacct_archive');
		//$this->db->join('package', 'package.listname = radacct_archive.package');
		$this->db->where('radacct_archive.creator',"".$this->session->userdata('username')."");
	//User ID $_POST
	if(!empty($uname)){
			$this->db->like('radacct_archive.username',$uname);
	}
	//DateStart & DateEnd $_POST
			//$this->db->where($Date)->order_by('radacct_archive.acctstarttime','asc');
		$this->db->where($Date);
		$query=$this->db->get();
		
	if ($query->num_rows() > 0){
			$data['posts']=$query->result_array();
		} else {
			$data['posts']="0";
		}
	//Slect from radacct_archive END

	//Slect from radacct START
	if(!empty($uname)){
		$this->db->select('username, framedipaddress, acctstoptime, acctsessiontime, acctstarttime, acctinputoctets, acctoutputoctets');
		$this->db->from('radacct');
	if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = radacct.creator');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('radacct.creator',"".$this->session->userdata('username')."");
	}
		$this->db->like('radacct.username',$uname);
		$query=$this->db->get();
	if ($query->num_rows() > 0){
			$data['uonline']=$query->result_array();
		} else {
			$data['uonline']="0";
		}
	}
	//Slect from radacct END



		//$data['posts'] = $this->client->userusage($uname,$DateStart,$DateEnd,$UsrCre);
		$data['lastquery'] = $this->db->last_query();
		
		$this->load->view('header');
		$this->load->view('usage_index',$data);
		$this->load->view('footer');
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
