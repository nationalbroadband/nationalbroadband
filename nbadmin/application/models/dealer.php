<?php

class Dealer extends CI_Model {

	function get_posts($num,$start=0,$uname) {
		
	// results
		$this->db->select();
		$this->db->from("dealer");
		//$this->db->order_by("Dlrname","asc")->limit($num,$start);
		if(!empty($uname)){
			$this->db->like("Dlrname", $uname); 
		}
			
		$query=$this->db->get();
		$ret['rows'] = $query->result_array();
		
		//$ret['rows'] = $this->get->result();	

	// count
		$this->db->select("COUNT(Dlrname) AS count", FALSE);
		$this->db->from("dealer");
		if(!empty($uname)){
			$this->db->like("Dlrname", $uname); 
		}
			
		$tmp=$this->db->get()->result();
		$ret['num_rows'] = $tmp['0']->count;
		
		return $ret;
	}

	function get_user($postID) {
	
	// Dealer Details
		$this->db->select();
		$this->db->from('dealer');
		$this->db->where('Dlrname',$postID)->order_by('CDate','desc');
		$query=$this->db->get();
		$ret['rows'] = $query->first_row('array');

	// Dealer Users Count
		$this->db->select('COUNT(Username) AS TotalUsers,users.creator,users.Package');
		$this->db->from("dealer");
		$this->db->join('users', 'users.creator = dealer.Dlrname');
		$this->db->where('users.creator',$postID)->order_by('users.Package','asc');
		$this->db->where('users.Active','1');
		$this->db->group_by("users.Package");
			
		$query=$this->db->get();
		$ret['pkg'] = $query->result_array();
		
	// Dealer Payments
		$this->db->select('payments.paid,payments.payment_date,payments.customer');
		$this->db->from('dealer');
		$this->db->join('payments', 'dealer.Dlrname = payments.customer', 'left outer');
		//$this->db->where('YEAR(payment_date) = YEAR(CURRENT_DATE)');
		//$this->db->where('MONTH(payment_date) = MONTH(CURRENT_DATE)');
		$this->db->limit(5);
		$this->db->where('payments.paid > 0');
		$this->db->where('dealer.Dlrname',$postID)->order_by("payment_date","desc");
			
		$query=$this->db->get();
		$ret['payment'] = $query->result_array();
		
	// Dealer Packages NEW
		$this->db->select('*');
		$this->db->from('dealersrates');
		$this->db->where('dealername',$postID);
		$query = $this->db->get();
	 
		$ret['query'] = $query->result();

		return $ret;
	}
	
	function create_dealer($data,$uid,$DlrPkg) {
		$this->db->insert('dealer',$data);
		
//Add New Dealer Rates
			foreach ($DlrPkg as $value) {
				$this->db->select('*')->from('dealersrates')->where('listname',$value)->where('dealername','admin'); 
				$query = $this->db->get();
					foreach ($query->result() as $row){
						$this->db->query("INSERT INTO dealersrates VALUES (NULL,'".$uid."','".$row->listname."','".$row->price."' )");
					}
			}
	}
	
	function edit_dlr($postID,$data) {
	
		$this->db->where('Dlrname',$postID);
		$this->db->update('dealer',$data);
	}

	
//Dealer Packages & Rates CRUD
	
  function get($id){
    $query = $this->db->getwhere('dealersrates',array('id'=>$id));
    return $query->row_array();
  }
 
  function save(){
    $date = $this->input->post('date');
    $name = $this->input->post('name');
    $amount=$this->input->post('amount');
    $data = array(
      'dealername'=>$date,
      'listname'=>$name,
      'price'=>$amount
    );
    $this->db->insert('dealersrates',$data);
  }
 
  function update(){
    $id   = $this->input->post('id');
    $date = $this->input->post('date');
    $name = $this->input->post('name');
    $amount=$this->input->post('amount');
    $data = array(
      'dealername'=>$date,
      'listname'=>$name,
      'price'=>$amount
    );
    $this->db->where('id',$id);
    $this->db->update('dealersrates',$data);
  }
}