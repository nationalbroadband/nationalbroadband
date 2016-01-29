<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Technoc extends CI_Controller {

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
	 
	public function index(){
		$this->load->view('header');
		$this->load->view('tech/index_tech');
		$this->load->view('footer');
	}
	
	function test2()
	{
		$this->load->view('header');
		$this->load->view('test2');
		$this->load->view('footer');
	}
	
	function dlrusersinfo(){
		$this->load->view('header');
		$this->load->view('tech/dealer_users_info');
		$this->load->view('footer');
	}
	
	function queryip() {
		$this->load->view('header');
		$this->load->view('tech/query_ip');
		$this->load->view('footer');
	}
	
	function queryuserid() {
		$this->load->view('header');
		$this->load->view('tech/query_userid');
		$this->load->view('footer');
	}
	
	function debuguser() {
		$this->load->view('header');
		$this->load->view('tech/debug_user');
		$this->load->view('footer');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */