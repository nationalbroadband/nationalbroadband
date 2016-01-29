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
			$data['success']=$this->user->update_post($this->session->userdata('UserID'),$_POST['curpassword'],$_POST['password']);
		}
		$data['post']=$this->user->get_user($this->session->userdata('UserID'));
		$this->load->view('header');
		$this->load->view('edit_userpw',$data);
		$this->load->view('footer');
	}
	
//User Login
	function login() {
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
				$user=$this->user->login($username,$password);
				if(!$user){
					$data['loginerror']=1;
				} else {
					$this->session->set_userdata('UserID',$user['Username']);
					$this->session->set_userdata('user_type','user');
					redirect(base_url());
				}
			}
		}
		
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
