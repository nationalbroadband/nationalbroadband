<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealers extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('dealer');
		$this->load->library('user_agent');
	}
	
	function index($start=0) {
	
	$uname="";
		if($this->input->post('searchterm') != false){
			 	$uname = $this->input->post('searchterm');
			}
			
		 $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
			
		$results=$this->dealer->get_posts($limit=25,$start,$uname);
		$data['posts']=$results['rows'];
		$this->load->library('pagination');
		$config['base_url']=base_url().'dealers/index/';
		//$config['total_rows']=$this->badlogin->get_posts_count($searchterm,$ucre);
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
		$this->load->view('dealers/dealers_index',$data);
		$this->load->view('footer');
	}
	
	function dealer($postID) {

		$results = $this->dealer->get_user($postID);
		
		$data['post'] = $results['rows'];
		$data['users'] = $results['pkg'];
		$data['payment'] = $results['payment'];
		$data['query'] = $results['query'];
		
		$this->load->view('header');
		$this->load->view('dealers/dealers',$data);
		$this->load->view('footer');
	}
	
  public function submit($postID){
    if ($this->input->post('ajax')){
      if ($this->input->post('id')){
        $this->dealer->update();
		$results = $this->dealer->get_user($postID);
        $data['query'] = $results['query'];
        $this->load->view('daily/show',$data);
      }else{
        $this->dealer->save();
		$results = $this->dealer->get_user($postID);
        $data['query'] = $results['query'];
        $this->load->view('daily/show',$data);
      }
    }
  }
 
  public function delete($postID){
    $id = $this->input->post('id');
    $this->db->delete('dealersrates', array('id' => $id));
		$results = $this->dealer->get_user($postID);
        $data['query'] = $results['query'];
    $this->load->view('daily/show',$data);
  }
	
	function dealerChange($postID) {
		$this->load->library('form_validation');
//		if(!$this->correct_permissions('author')){
//			redirect(base_url().'users/login');
//		}
		$data['success']=0;
		if($_POST){
			$data_post=array(
				'DlrPswd'=>md5($_POST['password'])
				);
			$this->dealer->edit_Dlr($postID,$data_post);
			$data['success']=1;
		}
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
				$this->form_validation->set_rules('username', 'Dealer ID', 'trim|required|min_length[2]|alpha_dash|xss_clean|is_unique[dealer.Dlrname]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password]');
				$this->form_validation->set_rules('DlrCNIC', 'Dealer CNIC', 'trim|required|min_length[8]|alpha_dash|xss_clean|is_unique[users.CNIC]');
				$this->form_validation->set_rules('DAddress', 'Dealer Address', 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('UserCre', 'ID Creator', 'required');
				$this->form_validation->set_rules('mobile', 'Dealer Mobile Number', 'required');
				
				$this->form_validation->set_message('is_unique', '%s is already in use.');
			
			if($this->form_validation->run() == FALSE){
				$data['errors']=validation_errors();
			} else {
				$data=array(
					'Dlrname'=>$this->input->post('username'),
					'ShrtID'=>$_POST['ShortID'],
					'DEmail'=>$this->input->post('email'),
					'DlrPswd'=>md5($_POST['password']),
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
					'Balance'=>0,
					'DExpiry'=>$this->input->post('DlrExpiry'),
					'Remarks'=>$this->input->post('Comment'),
					'AddedBy'=>$this->session->userdata('username')
				);
				$userid=$this->dealer->create_dealer($data,$this->input->post('username'),$this->input->post('DlrPkg'));
			//Discount Section	
				$managers=array(
				    'creator'=>$this->input->post('UserCre'),
					'Dlrname'=>$this->input->post('username'),
					'mPerCentOff'=>0,
					'mDlrname'=>$this->input->post('UserCre')
				);
				$this->db->insert('managers', $managers);


			//http://ipaddress:port/sendsms_url.html?Username=03028501744&Password=123.123&From=Business&To=03322184182&Message=one%20Testing
			//Massage Sending Start Here
			//$myString = "090000000";
			//$SMSNumbers = explode(',', $myString);
			//foreach($SMSNumbers as $to){
			//	echo $my_Array.'<br>';  
			//	$username = '09999999999';
			//	$password = 'pasw123';
			//	$from = 'NAMECOMPANY';
			//	$message = 'New Dealer ID '.$this->input->post('username').' Is Created On NAMECOMPANY Billing';
			//	$url = "http://ipaddress:port/sendsms_url.html?Username=".$username."&Password=" .$password.
			//	"&From=" .urlencode($from). "&To=" .$to."&Message=" .urlencode($message)." ";
			//	//Curl Start
			//	$ch = curl_init();
			//	$timeout = 30;
			//	curl_setopt ($ch,CURLOPT_URL, $url) ;
			//	curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
			//	curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
			//	$response = curl_exec($ch) ;
			//	curl_close($ch) ;
			//}
			//Write out the response
			//echo $response;
			// Massage Sending END Here

		//$response="Off";
		//AddDealer UserName
			$this->load->model('client');
				$data=array(
					'Username'=>'d'.$this->input->post('username'),
					'Email'=>$this->input->post('email'),
					'Password'=>$_POST['password'],
					'FullName'=>$this->input->post('name'),
					'Package'=>'NB-Dealer',
					'CNIC'=>$this->input->post('DlrCNIC'),
					'UsrAdd'=>$this->input->post('DAddress'),
					'Active'=>1,
					'Mac'=>'',
					'Phone'=>$this->input->post('phone'),
					'Mobile'=>$this->input->post('mobile'),
					'creator'=>'nbadmin',
					'Comment'=>'free dealer ID',
					'UStatus'=>0,
					'UExpiry'=>'2014-06-13'
				);
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$this->input->post('username')."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'NewDealer'.$this->input->post('BLimit'));
				$this->db->insert('action_logs', $actionlogs);
			
				$userid=$this->client->create_user($data);
			//	redirect(base_url('dealers/dealer/'.$this->input->post('username').'?SMS='.$response));
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
					'ShrtID'=>$_POST['ShortID'],
					'DEmail'=>$this->input->post('email'),
					'DFullName'=>$this->input->post('name'),
					'DCNIC'=>$this->input->post('DlrCNIC'),
					'DMobile'=>$this->input->post('mobile'),
					'DlrAdd'=>$this->input->post('DAddress'),
					'Active'=>$this->input->post('DealerStat'),
					'DPhone'=>$this->input->post('phone'),
					'creator'=>$this->input->post('DlrMngr'),
					'DLogo'=>$this->input->post('logo'),
					'DSub'=>$this->input->post('DealerCre'),
					'BalLimit'=>$this->input->post('BLimit'),
					'DExpiry'=>$this->input->post('DlrExpiry'),
					'Remarks'=>$this->input->post('Comment')
				);
			$this->dealer->edit_dlr($postID,$data_post);
			$data['success']=1;
	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$postID."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'EditDealer'.$this->input->post('BLimit'));
				$this->db->insert('action_logs', $actionlogs);
			
		}
		$results=$this->dealer->get_user($postID);
		$data['post'] = $results['rows'];
		$this->load->view('header');
		$this->load->view('dealers/edit_dealer',$data);
		$this->load->view('footer');
	}
	
	function dealerpkg($postID) {
		$this->load->library('form_validation');
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
		$data['success']=0;
		if($_POST){
			$data_post=array(
					'ShrtID'=>$_POST['ShortID'],
					'DEmail'=>$this->input->post('email'),
					'DFullName'=>$this->input->post('name'),
					'DCNIC'=>$this->input->post('DlrCNIC'),
					'DMobile'=>$this->input->post('mobile'),
					'DlrAdd'=>$this->input->post('DAddress'),
					'DPhone'=>$this->input->post('phone'),
					'Active'=>$_POST['DealerStat'],
					'DLogo'=>$_POST['logo'],
					'DSub'=>$_POST['DealerCre']
				);
			
			$this->dealer->edit_dlr($postID,$data_post);
			$data['success']=1;
		}
		$data['post']=$this->dealer->get_user($postID);
		$this->load->view('header');
		$this->load->view('dealers/edit_dealerpkg',$data);
		$this->load->view('footer');
	}
	
	function dealerpkgchng() {
	
//Package ID
		if($this->input->post('id') != false){
			 	$postID = $this->input->post('id');
			}
//Package POST
		if($this->input->post('firstname') != false){
			 	$listname = $this->input->post('firstname');
			}		
//Package Price
		if($this->input->post('lastname') != false){
			 	$price = $this->input->post('lastname');
			}
			
		$data_post=array(
			  'price'=>$price
		);

		$this->db->where('id',$postID);
		$this->db->update('dealersrates',$data_post);

		//redirect(base_url().'dealers/');
		//redirect(base_url().'dealers/client/'.$postID);
	}
	
	
	function DealerPortChng($postID) {
		if(!empty($postID)) {
//Get Users List 			
			$this->db->select('Username');
			$this->db->from('users');
			$this->db->where('creator',$postID);
			$query=$this->db->get();
// Insert Into
			foreach ($query->result() as $row) {
				$this->db->query("INSERT INTO usr_dactiv_queue VALUES  (NULL, '".$row->Username."', '".$this->session->userdata('username')."', '', '', '".$this->input->ip_address()."')");
			};

	//Action Log
			$actionlogs=array('Dlrname'=>"".$this->session->userdata('username')."",'user_id'=>"".$postID."",'ipadd'=>$this->input->ip_address(),'dept'=>$this->agent->referrer(),'action'=>'PortClear');
				$this->db->insert('action_logs', $actionlogs);
			
			redirect(base_url('dealers/dealer/'.$postID));
		} else {

		}
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
