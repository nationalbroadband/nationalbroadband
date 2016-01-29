<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badlogins extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('badlogin');
	}
	
	function index() {

		$results=$this->badlogin->get_posts();
		$data['posts']=$results['rows'];
		//$data['last_query']=$results['last_query'];
		$data['last_query']="";

		$this->load->view('header');
		$this->load->view('badlogins_index',$data);
		$this->load->view('footer');
     }
	 
}