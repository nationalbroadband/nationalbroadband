<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Badlogins extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('badlogin');
	}
	
	function index() {

		$results=$this->badlogin->get_posts();
		$data['posts']=$results['rows'];

		$this->load->view('header');
		$this->load->view('badlogins_index',$data);
		$this->load->view('footer');
	}
	

}