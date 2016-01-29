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

     function userslist($offset = 0) {
		
		$uri_segment="3";
		$limit = 25;
		
        $data['posts'] = $this->client->getPosts($offset, $limit);

		$config['base_url']=base_url().'clients/userslist/';	
		
		$config['total_rows']=$this->client->getTotalPosts();
		$data['TotalUsers'] = $config['total_rows'];
		$config['per_page'] = $limit;
		
        $config["uri_segment"] = $uri_segment;
		$config['num_links'] = 10;
		
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
 
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        $data["results"] = $this->client->getPosts($config["per_page"], $page);

        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);

        $data['base_url'] = $config['base_url'];
		//$data['searchterm'] = $uname;
        $data['page_link'] = $this->pagination->create_js_links();

        $this->load->view('users/userslist', $data);
     }
	 
	function expirylist()
	{
		$this->load->view('header');
		$this->load->view('users/clients_expirylist');
		$this->load->view('footer');
	}
	 
	function userusage() {
		//print_r($this->session->userdata);die();
//Users POST
		$uname="0";
		if($this->input->post('username') != false){
			 	$uname = $this->input->post('username');
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
//Users Creator POST
		$UsrCre="0";
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			}	
		if(!empty($DateStart) && !empty($DateEnd)){
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
	if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = radacct_archive.creator');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('radacct_archive.creator',"".$this->session->userdata('username')."");
	}
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
		$this->load->library('form_validation');
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}

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
		if ($this->input->post('UserStutusOld') == "3") {
				$usersinfo=array('Package'=>$this->input->post('UserPkg'),'Usr_DeActv'=>'','Active'=>'1','Comment'=>$this->input->post('UserCmt'),'UExpiry'=>$Expiry);
			} else {
				$usersinfo=array('Package'=>$this->input->post('UserPkg'),'Usr_DeActv'=>'','Active'=>'1','Comment'=>$this->input->post('UserCmt').' Changed Status to Monthly','UStatus'=>$this->input->post('UserStutus'),'UExpiry'=>$Expiry);
			}
				$this->client->update_user($postID,$usersinfo);
					
				$DlrOrders=array('product_id'=>$this->input->post('UserPkg'),'quantity'=>'30','customer_id'=>$this->input->post('UserCre'),'user_id'=>$postID);
					$this->db->insert('orders',$DlrOrders);

		} else {
		
		//**** Daily Basis Users Section ****//
			//Billing entries
			//Billing entries
		if ($this->input->post('UserStutusOld') == $this->input->post('UserStutus')) {
				$usersinfo=array('Package'=>$this->input->post('UserPkg'),'Usr_DeActv'=>'','Active'=>'1','Comment'=>$this->input->post('UserCmt'));
			} else {
				$usersinfo=array('Package'=>$this->input->post('UserPkg'),'Usr_DeActv'=>'','Active'=>'1','Comment'=>$this->input->post('UserCmt').' Status Changed','UStatus'=>$this->input->post('UserStutus'));
			}
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

					$this->db->where('Username', $postID);
					$this->db->where('creator', $this->input->post('UserCre'));
					$this->db->from('users');
						if($this->db->count_all_results() != 0 ){
							$this->db->where('DpUserName', $postID);
							$this->db->where('DpName', $this->input->post('UserCre'));
							$this->db->where('MONTH(DpDate) = EXTRACT(MONTH FROM (NOW()))');
							$this->db->where('YEAR(DpDate) = EXTRACT(YEAR FROM (NOW()))');
							$this->db->from('userpayments');
							$UserResult = $this->db->count_all_results();
								if ($UserResult == 0) {
									$this->db->query("INSERT INTO userpayments (DpName,  DpUserName,  DpRecipt,  DpAmount) VALUES  ('".$this->input->post('UserCre', TRUE)."','".$postID."','".$this->input->post('UsrRecipt', TRUE)."','".$this->input->post('UsrAmt', TRUE)."')");
								}
						}
				}

	if($this->input->post('UserCre') == "headoffice") {
		//Massage Sending Start Here
			$myString = "8098098";
			$SMSNumbers = explode(',', $myString);
			foreach($SMSNumbers as $to){
				//echo $my_Array.'<br>';  
				$username = 'user';
				$password = 'psdd';
				$from = 'DEMO';
				$message = 'User ID '.$postID.' of '.$this->input->post('UserCre').' Is Recharged by '.$this->session->userdata('username').' having ip '.$this->input->ip_address().' On Billing';
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
	}

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
		$this->load->library('form_validation');
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
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
					$username = preg_replace('/\s+/', '', $username);
				} else {
					$username = $this->input->post('username');
					$username = preg_replace('/\s+/', '', $username);
				}
			
		//This method will have the credentials validation
			$this->load->library('form_validation');
							
				$this->form_validation->set_rules('name', 'User Name', 'required|min_length[3]');
				$this->form_validation->set_rules('username', 'User ID', 'trim|required|min_length[3]|alpha_dash|callback_username_check');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]');
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
					$username = $row->DlrShrtID."".$userid;
					//$username = preg_replace('/\s+/', '', $username);
				} else {
					$username = $this->input->post('username');
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
