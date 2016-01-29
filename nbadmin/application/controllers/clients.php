<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->library('user_agent');
	}

	function index() {

		$results=$this->client->get_posts();
		$data['posts']=$results['rows'];
		//$data['last_query']=$results['last_query'];

		$this->load->view('header', $data);
        $this->load->view('users/clients_index', $data);
		$this->load->view('footer');
     }
 
	function missing_info()
	{
		$this->load->view('header');
		$this->load->view('users/clients_missing_info');
		$this->load->view('footer');
	}
 
	function expirylist()
	{
		$this->load->view('header');
		$this->load->view('users/clients_expirylist');
		$this->load->view('footer');
	}
	 
	function userusage() {
//Users POST
		$uname="0";
		if($this->input->post('username') != false){
			 	$uname = $this->input->post('username');
			} else {
				$uname = "support1";
			}
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
	
		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="radacct_archive.acctstarttime BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
		} else {
			$DateEnd = date("Y-m-d"); // 2015-03-16
			$DateStart = date("Y-m-d", strtotime("-1 DAYS"));
			$Date="radacct_archive.acctstarttime BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
		}
//Slect from radacct_archive START
		$this->db->select('radacct_archive.username, radacct_archive.creator,radacct_archive.framedipaddress,radacct_archive.nasipaddress, radacct_archive.acctstoptime, radacct_archive.acctsessiontime, radacct_archive.acctstarttime, radacct_archive.acctinputoctets, radacct_archive.acctoutputoctets');
		$this->db->from('radacct_archive');
		//$this->db->join('package', 'package.listname = radacct_archive.package');
	if($this->input->post('UsrCre')){
		$this->db->where('radacct_archive.creator',"".$this->input->post('UsrCre')."");
	}
		$this->db->like('radacct_archive.username',$uname);

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
		$this->db->select('username, creator,framedipaddress,nasipaddress, acctstoptime, acctsessiontime, acctstarttime, acctinputoctets, acctoutputoctets');
		$this->db->from('radacct');
	if($this->input->post('UsrCre')){
		$this->db->where('radacct.creator',"".$this->input->post('UsrCre')."");
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
		$this->load->view('users/userusage_index',$data);
		$this->load->view('footer');
	}
	 
	function client($postID) {
		$data['post']=$this->client->get_user($postID);
		$this->load->view('header');
		$this->load->view('users/clients',$data);
		$this->load->view('footer');
	}
	 
	function clientCLI($postID) {
		$data_post=array(
			'value'=>''
		);
		
		$udata=array(
			"Mac"=>"",
			"nasport"=>""
		);

		$this->db->where('Username', $postID);
		$this->db->update('users',$udata);

		$this->db->where('Username', $postID);
		$this->db->where('op', '=~');
		//$this->db->where('attribute', 'Calling-Station-Id');
		$this->db->update('radcheck',$data_post);
		
		redirect(base_url().'clients/client/'.$postID);
	}
	
	function clientStats($postID) {
		$data['success']=0;
		if($_POST){
			
	if($this->input->post('UserPkg') != false){
		if (isset($_POST['UserStutus']) && $_POST['UserStutus'] == "3") {
		
		//**** Monthly Users Section ****//
			$query = $this->db->query("SELECT UExpiry FROM users WHERE Username='".$postID."'");
				$row = $query->row();
				$UserExpiry=$row->UExpiry;
				
				$Today=date("Y-m-d");

				if ( $Today > $UserExpiry ) {
					//$Expiry="CURDATE()";
					$delidate = date(''); // Today is Monday
					$monthlyDate = strtotime("+1 month".$delidate);
					$Expiry = date("Y-m-d", $monthlyDate);

				} else {
					//$Expiry="'".$UserExpiry."'";
					$delidate = $UserExpiry; // Today is Monday
					$monthlyDate = strtotime("+1 month".$delidate);
					$Expiry = date("Y-m-d", $monthlyDate);
				}
			//Billing entries
				$usersinfo=array('Package'=>$this->input->post('UserPkg'),'Usr_DeActv'=>'','Active'=>'1','Comment'=>$this->input->post('UserCmt'),'UExpiry'=>$Expiry);
					$this->client->update_user($postID,$usersinfo);
					
				$DlrOrders=array('product_id'=>$this->input->post('UserPkg'),'quantity'=>'30','customer_id'=>$this->input->post('UserCre'),'user_id'=>$postID);
					$this->db->insert('orders',$DlrOrders);

		} else {
		
		//**** Daily Basis Users Section ****//
			//Billing entries
				$usersinfo=array('Package'=>$this->input->post('UserPkg'),'Usr_DeActv'=>'','Active'=>'1','Comment'=>$this->input->post('UserCmt'));
					$this->client->update_user($postID,$usersinfo);

				$DlrOrders=array('product_id'=>$this->input->post('UserPkg'),'customer_id'=>$this->input->post('UserCre'),'user_id'=>$postID);
					$this->db->insert('orders',$DlrOrders);
		}
	//Radious entries			
				$this->client->user_radcheck($postID,1);
				
				$radreply=$this->input->post('UserPkg');
				$this->client->user_radreply($postID,$radreply);
				
	//Action Log
			$actionlogs=array('Dlrname'=>$this->input->post('UserCre'),'user_id'=>$postID,'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'UserActive');
				$this->db->insert('action_logs', $actionlogs);
		
//monthly expiry check
				if($_POST['UserStutus'] == "1") {

			//user payment check
					$this->db->where('Username', $postID);
					$this->db->from('users');
					$UserResult = $this->db->count_all_results();
					if ($UserResult == 0) {
							$this->db->query("INSERT INTO userpayments (DpName,  DpUserName,  DpRecipt,  DpAmount) VALUES  ('".$this->input->post('UserCre', TRUE)."','".$postID."','".$this->input->post('UsrRecipt', TRUE)."','".$this->input->post('UsrAmt', TRUE)."')");
					}
					
				}
				
			//http://221.132.117.58:7700/sendsms_url.html?Username=03028501744&Password=123.123&From=Business&To=03322184182&Message=Name%20Testing
			//Massage Sending Start Here
			$myString = "00000000000";
			$SMSNumbers = explode(',', $myString);
			foreach($SMSNumbers as $to){
				//echo $my_Array.'<br>';  
				$username = 'username';
				$password = 'Passw123';
				$from = 'NAMECOMPAN';
				$message = 'User ID '.$postID.' of '.$this->input->post('UserCre').' Is Recharged by '.$this->session->userdata('username').' having ip '.$this->input->ip_address().' On NAMECOMPAN Billing';
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
					
			} elseif (isset($_POST['UserActive']) && $_POST['UserActive'] == "0") {
	//Radious entries			
				$this->client->user_radcheck($postID);
			//Billing entries
				$usersinfo=array('Usr_DeActv'=>date("Y-m-d h:i:s"),'Active'=>'0','Comment'=>$this->input->post('UserCmt'));
				$this->client->update_user($postID,$usersinfo);

	//Action Log
			$actionlogs=array('Dlrname'=>$this->input->post('UserCre'),'user_id'=>$postID,'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'UserDeActive');
				$this->db->insert('action_logs', $actionlogs);

				$query = $this->db->query("SELECT username,nasipaddress,acctstoptime FROM radacct WHERE username='". $postID. "' AND acctstoptime IS NULL");		
				if ($query->num_rows() > 0){
					$row = $query->row();
					$this->db->query("INSERT INTO cronjob VALUES (NULL, '".$row->username."', '".$row->nasipaddress."', 'DropUser')");	
				}
			} else {
					
/*/monthly expiry check
				$exe = mysql_query("SELECT Username,UStatus FROM users WHERE Username='". $_POST['UserID']. "' AND UStatus='1'");
				if(mysql_num_rows($exe) != 0 ){

					$exe2 = mysql_query("SELECT * FROM userpayments WHERE  DpUserName='".$_POST['UserID']."' AND MONTH(DpDate) = EXTRACT(MONTH FROM (NOW()))");
					if(mysql_num_rows($exe2) == 0 ){
				
						header("Location: payments.php?Add=NewPayment&UserID=" . $_POST['UserID']. "");
					die;
					}
					
				}
			*/
			}
			$data['success']=1;
		}
		$data['post']=$this->client->get_user($postID);
		$this->load->view('header');
		$this->load->view('users/edit_userstatus',$data);
		$this->load->view('footer');
	}
	
	function clientChange($postID) {

		$data['success']=0;
		if($_POST){
			$data_post=array(
				'Password'=>$this->input->post('password', TRUE)
				);
			$datapost=array(
				'value'=>$this->input->post('password', TRUE)
				);
			$this->client->update_post($postID,$data_post,$datapost);
			$data['success']=1;
		}
		$data['post']=$this->client->get_user($postID);
		$this->load->view('header');
		$this->load->view('users/edit_userpw',$data);
		$this->load->view('footer');
	}
		
	function clientedit($postID) {
	$data['success']=0;
		if($_POST){
			
		//This method will have the credentials validation
			$this->load->library('form_validation');
							
				$this->form_validation->set_rules('name', 'User Name', 'required|min_length[3]');
				$this->form_validation->set_rules('UserCNIC', 'User CNIC', 'trim|required|exact_length[15]|alpha_dash');
				$this->form_validation->set_rules('UserAddress', 'User Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('mobile', 'User Mobile Number', 'required|min_length[3]');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
			$data_post=array(
					'Email'=>$this->input->post('email'),
					'FullName'=>$this->input->post('name'),
					'CNIC'=>$this->input->post('UserCNIC'),
					'UsrAdd'=>$this->input->post('UserAddress'),
					'Phone'=>$this->input->post('phone'),
					'Mobile'=>$this->input->post('mobile'),
					'Comment'=>$this->input->post('comment')
				);
			
				$this->client->update_user($postID,$data_post);
				$data['success']=1;
			}
		}
		$data['post']=$this->client->get_user($postID);
		$this->load->view('header');
		$this->load->view('users/edit_user',$data);
		$this->load->view('footer');
	}
	
	function addnew() {
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
	$data="";
		if($_POST){
			
			$today = date("Y-m-d"); // 2015-03-16
			$next_month = date("Y-m-d", strtotime("$today +1 month"));
	
		if($_POST['UserStat'] == "3") {
			$UExpiry=$next_month;
		} else {
			$UExpiry=$today;	
		}
		
			$query = $this->db->query("SELECT ShrtID AS DlrShrtID FROM dealer WHERE Dlrname='".$this->input->post('UserCre')."'");
				$row = $query->row();
				
				if(!empty($row->DlrShrtID)) {
					$username = $row->DlrShrtID."-".$this->input->post('username');
					//$username = preg_replace('/\s+/', '', $username);
				} else {
					$username = $this->input->post('username');
					//$username = preg_replace('/\s+/', '', $username);
				}
			
		//This method will have the credentials validation
			$this->load->library('form_validation');
							
				$this->form_validation->set_rules('name', 'User Name', 'required|min_length[3]');
				$this->form_validation->set_rules('username', 'User ID', 'trim|required|min_length[3]|alpha_dash|callback_username_check');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password]');
				$this->form_validation->set_rules('UserCNIC1', 'User CNIC First 5 Digits', 'trim|required|exact_length[5]|alpha_dash');
				$this->form_validation->set_rules('UserCNIC2', 'User CNIC Mid 7 Digits', 'trim|required|exact_length[7]|alpha_dash');
				$this->form_validation->set_rules('UserCNIC3', 'User CNIC Last Digit', 'trim|required|exact_length[1]|alpha_dash');
				$this->form_validation->set_rules('UserAddress', 'User Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('UserCre', 'User Dealer ID', 'required|min_length[1]');
				$this->form_validation->set_rules('mobile', 'User Mobile Number', 'required|min_length[3]');
				$this->form_validation->set_rules('UserPkg', 'User Package', 'required|min_length[3]');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
				$UserNIC = $this->input->post('UserCNIC1')."-".$this->input->post('UserCNIC2')."-".$this->input->post('UserCNIC3');
				$data=array(
					'username'=>$username,
					'Email'=>$this->input->post('email'),
					'Password'=>$this->input->post('password'),
					'FullName'=>$this->input->post('name'),
					'Package'=>$this->input->post('UserPkg'),
					'CNIC'=>$UserNIC,
					'UsrAdd'=>$this->input->post('UserAddress'),
					'Active'=>1,
					'Mac'=>'',
					'Phone'=>$this->input->post('phone'),
					'Mobile'=>$this->input->post('mobile'),
					'creator'=>$this->input->post('UserCre'),
					'Comment'=>$this->input->post('comment'),
					'UStatus'=>$this->input->post('UserStat'),
					'UExpiry'=>$UExpiry
				);
				$userid=$this->client->create_user($data);
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>$username,'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'NewUser');
				$this->db->insert('action_logs', $actionlogs);
				redirect(base_url().'clients/client/'.$username);
			}
		}
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('users/register_user',$data);
		$this->load->view('footer');
	}
	
	function username_check($userid){

			$query = $this->db->query("SELECT ShrtID AS DlrShrtID FROM dealer WHERE Dlrname='".$this->input->post('UserCre')."'");
				$row = $query->row();
				
				if(!empty($row->DlrShrtID)) {
					$username = $Dlr['DlrShrtID']."-".$userid;
					//$username = preg_replace('/\s+/', '', $username);
				} else {
					$username = $userid;
					//$username = preg_replace('/\s+/', '', $username);
				}
		//Check user record
				$this->db->where('Username', $username);
				$this->db->from('users');
				$UserResult = $this->db->count_all_results();
				if ($UserResult > 0) {
					$this->form_validation->set_message("username_check', 'The %s ".$username." already exists");
					return FALSE;
				} else {
					return TRUE;
				}
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
