<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->library('user_agent');
	}

	function index() {
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
		$results=$this->user->get_posts();
		$data['posts']=$results['rows'];
		//$data['last_query']=$results['last_query'];

		$this->load->view('header', $data);
        $this->load->view('admin/users_index', $data);
		$this->load->view('footer');
     }
	
	function PwChange($postID) {
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
		$data['success']=0;
		if($_POST){
		//This method will have the credentials validation
			$this->load->library('form_validation');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password]');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$pass = hash('sha512', $this->input->post('password'));
			$password = hash('sha512', $pass.$random_salt);
				
				$data=array(
					'password'=>$password,
					'salt'=>$random_salt,
				);
				//$userid=$this->user->create_user($data);
				$this->user->update_pw($postID,$data);
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>$this->input->post('username'),'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'NewAdminID');
				$this->db->insert('action_logs', $actionlogs);
				
				$data['success']=1;
			}
		}
		$data['postID']=$postID;
		$this->load->view('header');
		$this->load->view('admin/edit_userpw',$data);
		$this->load->view('footer');
	}
		
	function editdetails($postID) {
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
	$data['success']=0;
		if($_POST){
			
		//This method will have the credentials validation
			$this->load->library('form_validation');
							
				$this->form_validation->set_rules('name', 'Full Name', 'required|min_length[3]');
				$this->form_validation->set_rules('email', 'EMail Address', 'required|min_length[3]');
				$this->form_validation->set_rules('idtype', 'Permission', 'required');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
			$data_post=array(
					'email'=>$this->input->post('email'),
					'FullName'=>$this->input->post('name'),
					'user_type'=>$this->input->post('idtype')
				);
			
				$this->user->update_user($postID,$data_post);
				$data['success']=1;
			}
		}
		
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username',$postID);
		$query=$this->db->get();
		$data['post'] = $query->first_row('array');
		
		$this->load->view('header');
		$this->load->view('admin/edit_user',$data);
		$this->load->view('footer');
	}
	
	function addnew() {
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
	$data="";
		if($_POST){

		//This method will have the credentials validation
			$this->load->library('form_validation');
							
				$this->form_validation->set_rules('name', 'Full Name', 'required|min_length[3]');
				$this->form_validation->set_rules('username', 'Panel ID', 'trim|required|min_length[2]|alpha_dash|is_unique[admin.username]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password]');
				$this->form_validation->set_rules('idtype', 'Permission', 'required');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$pass = hash('sha512', $this->input->post('password'));
			$password = hash('sha512', $pass.$random_salt);
				
				$data=array(
					'username'=>$this->input->post('username'),
					'email'=>$this->input->post('email'),
					'password'=>$password,
					'salt'=>$random_salt,
					'FullName'=>$this->input->post('name'),
					'user_type'=>$this->input->post('idtype')
				);
				$userid=$this->user->create_user($data);
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>$this->input->post('username'),'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'NewAdminID');
				$this->db->insert('action_logs', $actionlogs);
				redirect(base_url('users'));
			}
		}
		$this->load->view('header');
		$this->load->view('admin/register_user',$data);
		$this->load->view('footer');
	}
	
	
	//cal and create captcha image//
	  function _create_captcha(){
		 $this->load->helper('captcha');
		 
		  $cap = create_captcha(time());
		  
		  imagepng($cap['image'],"./style/".$cap['count'].".png");
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
	
	
	function login() {
	   	
		$data['error']=0;
		if($_POST){
			session_start();
			$this->load->model('user');
			$username=$this->input->post('username',true);
			$password=$this->input->post('password',true);
			$captcha=$this->input->post('captcha',true);
			$validCaptcha = $this->check_captcha($captcha);
			
			//$user=$this->user->login($username,$password);
			
			//$type=$this->input->post('user_type',true);
			
			
			if(empty($username) || empty($password)){
				$data['details']=array(
					'user_id'=>$username,
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'Retry',
					'dept'=>'AdminPage'
				);
				$data=array(
					'user_id'=>$username,
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'Retry',
					'dept'=>'AdminPage'
				);
				
				$this->db->insert('login_attempts', $data);
			
				$data['error']=1;

			}
			
			else if($validCaptcha==false){
				$data['details']=array(
					'user_id'=>$username,
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'Retry',
					'dept'=>'AdminPage'
				);
				$data=array(
					'user_id'=>$username,
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'Retry',
					'dept'=>'AdminPage'
				);
				
				$this->db->insert('login_attempts', $data);
			
				$data['error']=2;

			}
			
			else if($validCaptcha==true){
				$user=$this->user->login($username,$password);
				}
			
		 	else if(empty($user)){
				$data['details']=array(
					'user_id'=>$username,
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'Retry',
					'dept'=>'AdminPage'
				);
				$data=array(
					'user_id'=>$username,
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'Retry',
					'dept'=>'AdminPage'
				);
				
				$this->db->insert('login_attempts', $data);
			
				$data['error']=1;

			}
			
			
			
			
			
			
			else {
				$this->session->set_userdata('dNtAdmin',$user['id']);
				$this->session->set_userdata('Admin',$user['username']);
				$this->session->set_userdata('username',$user['username']);
				$this->session->set_userdata('user_type',$user['user_type']);
				$this->session->set_userdata('logintime',time());
								
				$data=array(
					'user_id'=>$this->session->userdata('Admin'),
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'LogedIn',
					'dept'=>$this->session->userdata('user_type')
				);
				
				//
				$this->db->insert('login_attempts', $data);
				//$data['success']=$this->user->update_post($data);
				if($this->session->userdata('last_page')) {
				$LastPage=$this->session->userdata('last_page');
					redirect($LastPage);
				} else {
					redirect(base_url());
				}
				//redirect(base_url());
			}
		}
		$this->_create_captcha();
		$this->load->view('login',$data);

	}
	
	function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
		//redirect(base_url('users/login'));
	}
	
	function sendmsg() {
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
	
	if(!$this->input->post('ContactNo')) {
		
		$data['response'] = "";
	
	} else {
	
			//http://221.132.117.58:7700/sendsms_url.html?Username=03028501744&Password=123.123&From=Business&To=03322184182&Message=Ebone%20Testing
			//Massage Sending Start Here
			//$myString = "03452443866";
			$myString = "00000000000,".$this->input->post('ContactNo');
			$SMSNumbers = explode(',', $myString);
			foreach($SMSNumbers as $to){
				//echo $my_Array.'<br>';  
				$username = 'userid';
				$password = 'password123';
				$from = $this->input->post('UserMask');
				//$message = 'User ID '.$postID.' of '.$this->input->post('UserCre').' Is Recharged by '.$this->session->userdata('username').' having ip '.$this->input->ip_address().' On NAMECOMPANY Billing';
				$message = "Dear ".$this->input->post('UsrDlr').", ".$this->input->post('Comment');
				$url = "http://ipaddress:port/sendsms_url.html?Username=".$username."&Password=" .$password.
				"&From=" .urlencode($from). "&To=" .$to."&Message=" .urlencode($message)." ";
				//Curl Start
				$ch = curl_init();
				$timeout = 30;
				curl_setopt ($ch,CURLOPT_URL, $url) ;
				curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
				//$response = curl_exec($ch) ;
				$data['response'] = curl_exec($ch) ;
				curl_close($ch) ;
			}
			//Write out the response
			//echo $response;
			// Massage Sending END Here
	
	//Action Log
		$actionlogs=array(	
				'Sender_ID'=>$this->session->userdata('username'),
				'Sender_ipadd'=>$this->input->ip_address(),
				'SMS_To'=>$this->input->post('UsrDlr'),
				'SMS_Numbers'=>$this->input->post('ContactNo'),
				'SMS_Mask'=>$this->input->post('UserMask'),
				'SMS_Text'=>$this->input->post('Comment')
			);
				$this->db->insert('sms_logs', $actionlogs);
				
	}
		$this->load->view('header');
        $this->load->view('admin/sendsms', $data);
		$this->load->view('footer');
     }
	
//Permission Check	
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
