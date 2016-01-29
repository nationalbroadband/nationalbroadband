<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Online extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('onlines');
	}
	
	function index() {

		$results=$this->onlines->get_posts();
		$data['posts']=$results['rows'];

		$this->load->view('header', $data);
        $this->load->view('online_index', $data);
		$this->load->view('footer');
     }

}