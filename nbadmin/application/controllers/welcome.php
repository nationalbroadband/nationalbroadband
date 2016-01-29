<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('short_digits');
		$this->load->view('header');
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}
	
	function test()
	{
		$this->load->view('header');
		$this->load->view('test');
		$this->load->view('footer');
	}
	
	function test2()
	{
		$this->load->view('header');
		$this->load->view('test2');
		$this->load->view('footer');
	}
	
	function chart()
	{
		$this->load->view('header');
		$this->load->view('chart');
	}
	
	function newdealers()
	{
		$this->load->view('header');
		$this->load->view('newdealers');
		$this->load->view('footer');
	}
	
	function newusers()
	{
		$this->load->view('header');
		$this->load->view('newusers');
		$this->load->view('footer');
	}
	
	function expireusers()
	{
		$this->load->view('header');
		$this->load->view('expireusers');
		$this->load->view('footer');
	}
	
	function msg($msgid) {

	// Dealer Details
		$this->db->select();
		$this->db->from('dbadmin_msgs');
	if(!empty($msgid)){
		$this->db->where('Msgaly',$msgid);
	} else {
		$this->db->order_by('MsgDate','desc');	
	}
		$query=$this->db->get();
		$data['post'] = $query->first_row('array');
		
		$this->load->view('header');
		$this->load->view('billmsgs',$data);
		$this->load->view('footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */