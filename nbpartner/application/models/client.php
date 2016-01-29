<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Model {

	function get_posts() {

//Users Status POST
		//$status="1";username
		//if($this->input->post('UsrStat')){
			 	//$status = "0";
			//}
			
	// results
		$this->db->select('users.Username,users.FullName,users.UsrAdd,users.Active,users.Mac,users.CDate,users.UStatus,users.Package');
		$this->db->from('users');
		//$this->db->join('package', 'package.listname = users.Package');
		
	if($this->input->post('UsrCre')){
		$this->db->where('users.creator',$this->input->post('UsrCre'));
	} else if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = users.creator');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
		$this->db->limit(250);
	} else {
		$this->db->where('users.creator',"".$this->session->userdata('username')."");
	}
	if($this->input->post('username')){
		$this->db->like('users.Username',$this->input->post('username'));
	}
	if($this->input->post('UsrPkg')){
		$this->db->where('users.Package',$this->input->post('UsrPkg'));
	}
	if($this->input->post('UsrStat') == "Active"){
		$this->db->where('users.Active','1');
	} else if($this->input->post('UsrStat') == "DeActive"){
		$this->db->where('users.Active','0');
	} else {}

		
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();
		
		$ret['last_query'] = $str = $this->db->last_query();
		
		return $ret;
	}
	
	function userusage($uname,$DateStart,$DateEnd,$UsrCre){
	$Date="radacct_archive.acctstarttime BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";

		$this->db->select('radacct_archive.username, radacct_archive.address, radacct_archive.acctstoptime, radacct_archive.acctsessiontime, radacct_archive.acctstarttime, radacct_archive.acctinputoctets, radacct_archive.acctoutputoctets');
		$this->db->from('radacct_archive');
		$this->db->join('package', 'package.listname = radacct_archive.package');
	if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = radacct_archive.creator');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('radacct_archive.creator',"".$this->session->userdata('username')."");
	}
		$this->db->where('radacct_archive.username',$uname);
		$this->db->where($Date)->order_by('radacct_archive.acctstarttime','asc');
		$query=$this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
		return 0;
		
	}
	
	function create_user($data) {
		$this->db->insert('users',$data);
	}
	
	function get_user($postID) {
		$this->db->select('users.ID,  Username,  Email,  Password,  FullName,  Package AS pname,  Usr_DeActv,  CNIC,  UsrAdd,  users.Active,  Mac,  Phone,  Mobile,  users.creator,  users.CDate,  Comment,  UStatus,  UExpiry');
		$this->db->from('users');
		//$this->db->join('package', 'package.listname = users.Package');
	if($this->session->userdata('DealerPerm')){
		$this->db->join('dealer', 'dealer.Dlrname = users.creator');
		$this->db->where('dealer.creator',"".$this->session->userdata('username')."");
	} else {
		$this->db->where('users.creator',"".$this->session->userdata('username')."");
	}
		$this->db->where('users.Username',$postID);
		$query=$this->db->get();
		return $query->first_row('array');
	}
//Edit	
	function update_user($postID,$data) {
		$this->db->where('Username',$postID);
		$this->db->update('users',$data);

	}
//change pw	
	function update_post($postID,$data,$data2) {
	
		$this->db->where('Username',$postID);
		$this->db->update('users',$data);
		
		$this->db->where('username',$postID);
		$this->db->where('attribute','Cleartext-Password');
		$this->db->update('radcheck',$data2);

	//User Drop
			$query = $this->db->query("SELECT username,nasipaddress,acctstoptime FROM radacct WHERE username='". $postID. "' AND acctstoptime IS NULL");		
			if ($query->num_rows() > 0){
				$row = $query->row();
				$this->db->query("INSERT INTO cronjob VALUES (NULL, '".$row->username."', '".$row->nasipaddress."', 'DropUser')");	
			}
	}

//Edit Radreply Table
	function user_radcheck($postID,$delete=0) {
		if(!empty($delete)) {
			$userPck = $this->input->post('UserPkg');
			$this->db->where('username', $postID)->update('radusergroup', array('groupname' => $userPck));
			/*
			$this->db->where('username',$postID);
			$this->db->where('value','Reject');
			$this->db->delete('radcheck'); 
			*/
			
		} else {
		/*
			$data=array(
				'username'=>$postID,
				'attribute'=>'Auth-Type',
				'op'=>':=',
				'value'=>'Reject'
			);
			$this->db->insert('radcheck',$data);
			*/
			$this->db->where('username', $postID)->update('radusergroup', array('groupname' => 'DISABLED'));
			
		}

	}
	
//Edit	
	function user_radreply($postID,$pkg) {
		
		$data = array('value'=>$pkg);
		
		$this->db->where('username',$postID);
		$this->db->where('attribute','Mikrotik-Address-List');
		$this->db->update('radreply',$data);
	
	if("D-Everyday-Low-Price" == $pkg){
		$data = array('value'=>'Bronze');
	} else {
		$data = array('value'=>$pkg);
	}
		
		$this->db->where('username',$postID);
		$this->db->where('attribute','Framed-Pool');
		$this->db->update('radreply',$data);

	}
	

}