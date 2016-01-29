<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	function get_user($postID) {
		$this->db->select('users.*,package.pname');
		$this->db->from('users');
		$this->db->join('package', 'package.listname = users.Package');
		$this->db->where('users.Username',$postID);
		$query=$this->db->get();
		return $query->first_row('array');
	}

	function login($username,$password) {
		  
	$where=array(
			'Username'=>$username,
			'Password'=>$password
			//'Active'=>1
		);
		$this->db->select()->from('users')->where($where);
		$query=$this->db->get();
		return $query->first_row('array');	
	}
	
//change pw	
	function update_post($postID,$curpw,$password, $repassword) {
	
	if($password != $repassword){
		return "<div class=''>Password mismatch...!.</div>";
	}

	$UsrData=array(
		'Password'=>$password
		);
	$RadData=array(
		'value'=>$password
	);
				
		$this->db->where('Username',$postID);
		$this->db->where('Password',$curpw);
		$this->db->update('users',$UsrData);
		
		$this->db->where('username',$postID);
		$this->db->where('value',$curpw);
		$this->db->where('attribute','Cleartext-Password');
		$this->db->update('radcheck',$RadData);

		if ($this->db->affected_rows() > 0) {
			return "<div class=''>Your Password Has Been Updated...!.</div>";
		} else {
			return "<div class=''>Error: Password not updated..!.</div>";
		}
	}
	
}