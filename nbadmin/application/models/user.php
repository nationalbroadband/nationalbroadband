<?php

class User extends CI_Model {


	function get_posts() {
	// results
		$this->db->select('*');
		$this->db->from('admin');
		
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();
		
		$ret['last_query'] = $str = $this->db->last_query();
		
		return $ret;
	}
	
	function create_user($data) {
		$this->db->insert('admin',$data);
	}
	
//Edit	
	function update_user($postID,$data) {
		$this->db->where('username',$postID);
		$this->db->update('admin',$data);
	}

//Change PW	
	function update_pw($postID,$data) {
		$this->db->where('username',$postID);
		$this->db->update('admin',$data);
	}

	function login($username,$password) {
		$this->db->select('salt')->from('admin')->where('username',$username);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
			$ret = $query->row();
			$salt = $ret->salt;
        } else {
			return null;
		}
		
		$password1 = hash('sha512', $password); // hash the password with the unique salt.
		
		$password2 = hash('sha512', $password1.$salt); // hash the password with the unique salt.
			  
	$where=array(
		'username'=>$username,
		'password'=>$password2
		//'password'=>sha1($password),
		//'user_type'=>$type
		);
		$this->db->select()->from('admin')->where($where);
		$query=$this->db->get();
		return $query->first_row('array');	
	}
	
}