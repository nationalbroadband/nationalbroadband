<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dealers extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('dealer');
		$this->load->library('user_agent');
	}
	
	function index() {
//Users Status POST
		$status="1";
		if($this->input->post('UsrStat') != false){
			 	$status = "0";
			}	

		$results=$this->dealer->get_posts($status);
		$data['posts']=$results['rows'];

		$this->load->view('header');
		$this->load->view('dealers/dealers_index',$data);
		$this->load->view('footer');
	}
	
	function dealer($postID) {
		$results = $this->dealer->get_user($postID);
		
		$data['post'] = $results['rows'];
		$data['packages'] = $results['pkg'];
		$this->load->view('header');
		$this->load->view('dealers/dealers',$data);
		$this->load->view('footer');
	}
	
	function dealerChange($postID) {
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
				$this->dealer->edit_Dlr($postID,$data_post);
			
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$postID."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'DlrPwd');
				$this->db->insert('action_logs', $actionlogs);
			}
					
			$data['success']=1;
			
			//redirect(base_url().'welcome/profile');
		}
	// Dealer Details
		$results=$this->dealer->get_user($postID);
		$data['post'] = $results['rows'];
		$this->load->view('header');
		$this->load->view('dealers/edit_dealerpw',$data);
		$this->load->view('footer');
	}
	
	function addnew() {
	$data="";
		if($_POST){
		
		//This method will have the credentials validation
			$this->load->library('form_validation');

				$this->form_validation->set_rules('name', 'Dealer Name', 'required');
				$this->form_validation->set_rules('username', 'Dealer ID', 'trim|required|min_length[3]|alpha_dash|is_unique[dealer.Dlrname]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password]');
				$this->form_validation->set_rules('DlrCNIC', 'Dealer CNIC', 'trim|required|min_length[8]|alpha_dash|is_unique[users.CNIC]');
				$this->form_validation->set_rules('DAddress', 'Dealer Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('UserCre', 'ID Creator', 'required');
				$this->form_validation->set_rules('mobile', 'Dealer Mobile Number', 'required');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
				$data=array(
					'Dlrname'=>$this->input->post('username'),
					'ShrtID'=>$this->input->post('ShortID'),
					'DEmail'=>$this->input->post('email'),
					'DlrPswd'=>md5($this->input->post('password')),
					'DFullName'=>$this->input->post('name'),
					'DCNIC'=>$this->input->post('DlrCNIC'),
					'DMobile'=>$this->input->post('mobile'),
					'DlrAdd'=>$this->input->post('DAddress'),
					'Active'=>1,
					'DPhone'=>$this->input->post('phone'),
					'creator'=>$this->input->post('UserCre'),
					'DLogo'=>$this->input->post('logo'),
					'DSub'=>$this->input->post('DealerCre'),
					'BalLimit'=>$this->input->post('BLimit'),
					'Balance'=>$this->input->post('Balance'),
					'DExpiry'=>$this->session->userdata('DealerExpiry'),
					'AddedBy'=>$this->session->userdata('DealerCre')
				);
				
			//Discount Section	
				$managers=array(
				    'creator'=>$this->input->post('UserCre'),
					'Dlrname'=>$this->input->post('username'),
					'mPerCentOff'=>0,
					'mDlrname'=>$this->input->post('UserCre')
				);
				$this->db->insert('managers', $managers);

			//Massage Sending Start Here
			$myString = "8080808";
			$SMSNumbers = explode(',', $myString);
			foreach($SMSNumbers as $to){
				echo $my_Array.'<br>';  
				$username = 'user';
				$password = 'G123';
				$from = 'NAME';
				$message = 'New Dealer ID '.$this->input->post('username').' Is Created By '.$this->session->userdata('username').' On Billing';
				$url = "http://host:port/sendsms_url.html?Username=".$username."&Password=" .$password.
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

		// results
			$this->db->select('dealersrates.listname, dealersrates.price');
			$this->db->from("package");
			$this->db->join('dealersrates', 'package.listname = dealersrates.listname');
			$this->db->where('dealersrates.dealername',"".$this->session->userdata('username')."");
			
			$query=$this->db->get();
			$DlrPkg = $query->result_array();

				$userid=$this->dealer->create_dealer($data,$this->input->post('username'),$DlrPkg);
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$this->input->post('username')."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'NewDealer-'.$this->input->post('BLimit'));
				$this->db->insert('action_logs', $actionlogs);

// SEND MAIL START				
    $this->load->helper('url');  
	
	$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'localhost',
		  'smtp_port' => 25,
		  'smtp_timeout' => 15,
		  'smtp_user' => '',
		  'smtp_pass' => '',
		  'charset' => 'utf-8',
		  'newline' => '\r\n',
		  'mailtype' => 'html', // or html
		  'validation' => TRUE, // bool whether to validate email or not 
		);
		
	   $message = '<html>
				<head>
					<title>New Dealer ID</title>
				</head>
				<body>
				<p>Dear Support</p>
				<p>New Dealer ID created, details are as follows:</p>
				<table>
					<tr>
						<td>Dealer ID</td>
						<td>'.$this->input->post('username').'</td>
					</tr>
					<tr>
						<td>Dealer Name</td>
						<td>'.$this->input->post('name').'</td>
					</tr>
					<tr>
						<td>CNIC#</td>
						<td>'.$this->input->post('DlrCNIC').'</td>
					</tr>
					<tr>
						<td>Contact#</td>
						<td>'.$this->input->post('phone').'/'.$this->input->post('mobile').'</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>'.$this->input->post('DAddress').'</td>
					</tr>
					<tr>
						<td>E-Mail</td>
						<td>'.$this->input->post('email').'</td>
					</tr>
				</table>
				<p>&nbsp;</p>
				<div id="_rc_sig"><span style="font-size: 20.0pt; font-family: \'Brush Script MT\'; color: #1f497d; text-shadow: none;">Best Regards,</span><span style="font-size: 10.0pt; font-family: \'Arial\',\'sans-serif\'; color: #1f497d; text-shadow: none;"> </span><br />
				<p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;"><strong><span style="font-size: 11.0pt; font-family: \'Cooper Black\',\'serif\'; color: #1f497d; text-shadow: none;"></span></strong><span style="font-size: 11.0pt; font-family: \'Cooper Black\',\'serif\'; color: navy; text-shadow: none;">Muhammad Tahir Irshad</span><span style="font-size: 11.0pt; font-family: \'Calibri\',\'sans-serif\'; text-shadow: none;"></span></p>
				<p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;"><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">│Jr. PHP Developer│</span></strong><span style="font-size: 11.0pt; font-family: \'Calibri\',\'sans-serif\'; text-shadow: none;"></span></p>
				<p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;"><strong><span style="font-size: 7.5pt; font-family: \'Calibri\',\'sans-serif\'; color: #1f497d; text-shadow: none;">Multimedia Department</span></strong><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">│</span></strong><strong><span style="font-size: 7.5pt; font-family: \'Calibri\',\'sans-serif\'; color: #1f497d; text-shadow: none;">Example</span></strong><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">│</span></strong><span style="font-size: 11.0pt; font-family: \'Calibri\',\'sans-serif\'; text-shadow: none;"></span></p>
				<p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;"><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">│</span></strong><strong><span style="font-size: 7.5pt; font-family: \'Calibri\',\'sans-serif\'; color: #1f497d; text-shadow: none;">Direct Tel: +92-21-38679121-22 </span></strong><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">││</span></strong><strong><span style="font-size: 7.5pt; font-family: \'Calibri\',\'sans-serif\'; color: #1f497d; text-shadow: none;">Mobile: </span></strong><a href="tel:%2B92-311-2666125"><strong><span style="font-size: 7.5pt; font-family: \'Calibri\',\'sans-serif\'; color: blue; text-shadow: none;">+92-321-2221153</span></strong></a><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">│</span></strong><span style="font-size: 11.0pt; font-family: \'Calibri\',\'sans-serif\'; text-shadow: none;"></span></p>
				<strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: #1f497d; text-shadow: none;">│</span></strong><a href="http://example.apna.com.pk"><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: #104160; text-shadow: none;">example.apna.com.pk</span></strong></a><strong><span style="font-size: 7.5pt; font-family: \'Arial\',\'sans-serif\'; color: gray; text-shadow: none;">│</span></strong></div>
			</body>
		</html>';
	
    //load email helper
    $this->load->helper('email');
    //load email library
 //   $this->load->library('email');
	$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
  
      // compose email
		$this->email->from('emailaddreaa', 'Billing');
		$this->email->to('emailadd');
		$this->email->cc('emailadd');
		$this->email->bcc('');
		$this->email->subject('New Dealer ID '.$this->input->post('username').' Created');
		$this->email->message($message);  
      
      // try send mail ant if not able print debug
      if (!$this->email->send()){
        $data['message'] ="Email not sent \n".$this->email->print_debugger();      
      }
// SEND MAIL END
				redirect(base_url().'dealers');
			}
		}
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('dealers/register_dealer',$data);
		$this->load->view('footer');
	}
	
	function dealeredit($postID) {
		$this->load->library('form_validation');
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
		$data['success']=0;
		if($_POST){
			$data_post=array(
					'ShrtID'=>$this->input->post('ShortID'),
					'DEmail'=>$this->input->post('email'),
					'DFullName'=>$this->input->post('name'),
					'DCNIC'=>$this->input->post('DlrCNIC'),
					'DMobile'=>$this->input->post('mobile'),
					'DlrAdd'=>$this->input->post('DAddress'),
					'DPhone'=>$this->input->post('phone')
				);
			
			$this->dealer->edit_dlr($postID,$data_post);
			$data['success']=1;
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$postID."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'EditDealer');
				$this->db->insert('action_logs', $actionlogs);
		}
		$results=$this->dealer->get_user($postID);
		$data['post'] = $results['rows'];
		$this->load->view('header');
		$this->load->view('dealers/edit_dealer',$data);
		$this->load->view('footer');
	}

	
//User correct permissions check
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
