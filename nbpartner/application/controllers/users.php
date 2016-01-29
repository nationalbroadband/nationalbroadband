<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function login() {
		$this->load->library('user_agent');
		$data['error']=0;
		if($_POST){
			session_start();
			$this->load->model('user');
			$username=$this->input->post('username',true);
			$password=$this->input->post('password',true);
			//$type=$this->input->post('user_type',true);
			$user=$this->user->login($username,$password);
			$captcha=$this->input->post('captcha',true);
			$validCaptcha = $this->check_captcha($captcha);
			
			if(empty($username) || empty($password)){
				
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
			
				$data['error'] = 1;

				//$this->_create_captcha();
				$data['username'] = $username;
				$data['password'] = $password;
				return $this->load->view('login',$data);

			}

			if(!$validCaptcha){
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

				//$this->_create_captcha();
				$data['username'] = $username;
				$data['password'] = $password;
				return $this->load->view('login',$data);
			}
			
			$user = $this->user->login($username,$password);
			
			if(empty($user)){
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
					'dept'=>'DealerPage'
				);
				
				$this->db->insert('login_attempts', $data);
				$data['username'] = $username;
				$data['password'] = $password;
				$data['error'] = 1;
				//$this->_create_captcha();
				return $this->load->view('login',$data);

			} 
			
			if($validCaptcha && !empty($user)){
/*				$this->session->set_userdata('Billing',$user['ID']);
				$this->session->set_userdata('username',$user['Dlrname']);
				$this->session->set_userdata('ShrtID',$user['ShrtID']);
				$this->session->set_userdata('DealerPerm',$user['DSub']);
				$this->session->set_userdata('DlrLimit',$user['BalLimit']);
				$this->session->set_userdata('DlrBalance',$user['Balance']);
				$this->session->set_userdata('DealerExpiry',$user['DExpiry']);
				$this->session->set_userdata('DealerLogo',$user['DLogo']);
				$this->session->set_userdata('manager',$user['creator']); */
				
				$mydata = array(
                   'Billing'  => $user['ID'],
                   'username'     => $user['Dlrname'],
                   'ShrtID' => $user['ShrtID'],
                   'DealerPerm' => $user['DSub'],
                   'DlrLimit' => $user['BalLimit'],
                   'DlrBalance' => $user['Balance'],
                   'DealerExpiry' => $user['DExpiry'],
                   'DealerLogo' => $user['DLogo'],
                   'manager' => $user['creator']
               );
			   
			   if(!empty($user['DSub'])) {
					$mydata['user_type']='admin';
				} else {
					$mydata['user_type']='author';
				}
				$mydata['logintime']=time();

			   $this->session->set_userdata($mydata);
			   
				/*
			if(!empty($user['DSub'])) {
				$this->session->set_userdata('user_type','admin');
			} else {
				$this->session->set_userdata('user_type','author');
			}
				$this->session->set_userdata('logintime',time());
					*/			
				$data=array(
					'user_id'=>$this->session->userdata('username'),
					'ipadd'=>$this->input->ip_address(),
					'client_user_agent'=>$this->agent->agent_string(),
					'referer_page'=>$this->agent->referrer(),
					'request_uri'=>$this->input->server('REQUEST_URI'),
					'Action'=>'LogedIn',
					'dept'=>'DealerPage'
				);
				
				//
				$this->db->insert('login_attempts', $data);
				//$data['success']=$this->user->update_post($data);
				
				redirect(base_url());
			}
			$data['username'] = $username;
			$data['password'] = $password;
			
		}
		//$this->_create_captcha();
		$this->load->view('login',$data);

	}
	
	function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	
	//cal and create captcha image//
	function _create_captcha(){
		$this->load->helper('captcha');
		$cap = create_captcha(time());  
		
		//$_SESSION['count'] = $cap['count'];
		//imagepng($cap['image'],"./style/captcha/".$cap['count'].".png");
		$count = glob("./style/captcha/*.png");
		
		print json_encode(array('count' => $count[count($count)-1]));
	}
	  
	  //refresh Captcha
	  public function refresh_captcha(){
		  
		  $this->_create_captcha();
	  }
	  
	  /**check for valid captcha**/
	   function check_captcha($string){
		if($string == $_SESSION['captcha_string']){
			  return true;
		}else{
			session_destroy();
			 return false;
			}
		  } 
		  
	///////////
	

}
