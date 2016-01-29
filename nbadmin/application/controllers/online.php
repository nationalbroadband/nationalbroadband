<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Online extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('onlines');
	}
	
	function index() {

		$results=$this->onlines->getPosts();
		$data['posts']=$results['rows'];
		$data['totals'] = $results['total_rows'];
		$data['lastquery']=$results['last_query'];

		$this->load->view('header', $data);
        $this->load->view('online_index', $data);
		$this->load->view('footer');
     }
	 
     function index2($offset = 0){
		$uri_segment="3";
//Users POST
		$uname="0";
		if($this->input->post('username') != false){
			 	$uname = $this->input->post('username');
			 	$data['searchterm'] = $uname;
			$uri_segment=$uri_segment+1;
			}		
//Users Creator POST
		$UsrCre="0";
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			$uri_segment=$uri_segment+1;
			}
		
        $limit = 25;
        $data['posts'] = $this->onlines->getPosts($offset, $limit,$uname, $UsrCre);
		
		$config['base_url']=base_url().'online/userslist/'.$uname.'/'.$UsrCre.'/';	
		
		$config['total_rows']=$this->onlines->getTotalPosts($uname, $UsrCre);
		$config['per_page'] = $limit;
		
        $config["uri_segment"] = $uri_segment;
		$config['num_links'] = 15;
		
 // twitter bootstrap markup 
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>'; $config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_link'] = '&laquo;';
		$config['prev_link'] = '&lsaquo;';
		$config['last_link'] = '&raquo;';
		$config['next_link'] = '&rsaquo;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        $data["results"] = $this->onlines->getPosts($config["per_page"], $page,$uname, $UsrCre);

        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);

        $data['base_url'] = $config['base_url'];
        $data['page_link'] = $this->pagination->create_js_links();
        $data['totals'] = $config['total_rows'];

		$this->load->view('header', $data);
        $this->load->view('online_index', $data);
		$this->load->view('footer');
     }

     function userslist($uname, $UsrCre, $offset = 0) {
		
		if(!empty($uname)){ $uname=$uname;	} else { $uname="0"; }
		if(!empty($UsrCre)){ $UsrCre=$UsrCre;	} else { $UsrCre="0"; }
		
		$limit = 25;

        $data['posts'] = $this->onlines->getPosts($offset, $limit, $uname, $UsrCre);

		$uri_segment="5";
		$config['base_url']=base_url().'online/userslist/'.$uname.'/'.$UsrCre.'/';	
		
		$config['total_rows']=$this->onlines->getTotalPosts($uname, $UsrCre);
		$config['per_page'] = $limit;
		
        $config["uri_segment"] = $uri_segment;
		$config['num_links'] = 15;
		
 // twitter bootstrap markup 
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>'; $config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_link'] = '&laquo;';
		$config['prev_link'] = '&lsaquo;';
		$config['last_link'] = '&raquo;';
		$config['next_link'] = '&rsaquo;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        $data["results"] = $this->onlines->getPosts($config["per_page"], $page,$uname, $UsrCre);

        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);

        $data['base_url'] = $config['base_url'];
		$data['searchterm'] = $uname;
        $data['page_link'] = $this->pagination->create_js_links();

        $this->load->view('onlineuserslist', $data);
     }
	 

}