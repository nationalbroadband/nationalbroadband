<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	function create_user($data) {
		$this->db->insert('dealer',$data);
	}

	function login($username,$password) {
		  
	$where=array(
		'Dlrname'=>$username,
		'DlrPswd'=>md5($password),
		'Active'=>1
		//'user_type'=>$type
		);
		$this->db->select()->from('dealer')->where($where);
		$query=$this->db->get();
		return $query->first_row('array');	
	}
	
}