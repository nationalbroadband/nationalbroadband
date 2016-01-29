<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('report');
	}

     function index(){

	if($_POST){
	
//Users Creator POST
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');
			}
//Calander Start Date
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
//Calander END Date
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}

		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="DUdate BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
			
		}			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT DUpakage,COUNT(DUserID) AS DUserID,SUM(DUAmount) AS DUAmount,SUM(DUcount) AS DUcount,SUM(taxamount) AS taxamount FROM ordersreport WHERE DUcustomer='$UsrCre' GROUP BY DUpakage ORDER BY DUdate ASC");
			}

			if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT DUpakage,COUNT(DUserID) AS DUserID,SUM(DUAmount) AS DUAmount,SUM(DUcount) AS DUcount,SUM(taxamount) AS taxamount FROM ordersreport WHERE $Date AND DUcustomer='$UsrCre' GROUP BY DUpakage ORDER BY DUdate ASC");
			}
			
			if ($query->num_rows() > 0){
				$data['posts']=$query->result_array();
			} else {
				$data['posts']="0";
			}
			
			
			if(!empty($UsrCre) && empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

			if(!empty($UsrCre) && !empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$this->db->where($Date);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

		//$data['pagelink']=$this->db->last_query();
		
		$this->load->view('header', $data);
        $this->load->view('reports/reports_index', $data);
		$this->load->view('footer');
		
		} else {
		
			$this->load->view('header');
			$this->load->view('reports/reports_index');
			$this->load->view('footer');
		}

     }
//Dealer Units/Payments Report
     function dreports(){
		 
		$this->load->view('header');
        $this->load->view('reports/reports');
		$this->load->view('footer');
		 
	 }
	 
//Dealer Units/Payments Report Export to Exl
	function ExportDlrReport($dealer="nbadmin") {
		 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getProperties()->setCreator("StyleOfGlobal")
							 ->setLastModifiedBy("StyleOfGlobal")
							 ->setTitle($dealer)
							 ->setSubject($dealer)
							 ->setDescription("Dealer Units/Payments Report.")
							 ->setKeywords("ebone bills units report")
							 ->setCategory("Monthly Bill");
                $this->excel->getActiveSheet()->setTitle($dealer);
                //set cell A1 content with some text

                $this->excel->getActiveSheet()->setCellValue('C1', $dealer.' Dealer Units/Payments Report.');
                $this->excel->getActiveSheet()->setCellValue('C3', 'DealerID');
                $this->excel->getActiveSheet()->setCellValue('D3', 'Month');
                $this->excel->getActiveSheet()->setCellValue('E3', 'Amount');
                $this->excel->getActiveSheet()->setCellValue('F3', 'Adv Tax');
                $this->excel->getActiveSheet()->setCellValue('G3', 'Total Bill');
                $this->excel->getActiveSheet()->setCellValue('H3', 'PaidAmount');
                //merge cell C1 until G1
                $this->excel->getActiveSheet()->mergeCells('C1:H1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->setARGB('#333');

			
			//$col=""
       for($col = ord('C'); $col <= ord('H'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
		
		//$query = $this->db->query("SELECT COUNT(Username) AS UCount, pname AS Package FROM users INNER JOIN package ON users.Package=package.listname WHERE users.Active='1' AND users.creator='".$this->session->userdata('username')."' GROUP BY Package");
                //retrive mysql clients table data
$query = $this->db->query("SELECT DUcustomer,DATE_FORMAT(DATE(DUdate), '%M-%Y') AS EntryDate,SUM(totalAmount) AS totalAmount,SUM(TotalTax) AS TotalTax,SUM(PaidAmount) AS TotalPaid FROM (
									SELECT DUcustomer,DUdate,SUM(DUAmount) AS totalAmount,SUM(taxamount) AS TotalTax,0 AS PaidAmount FROM ordersreport
									WHERE DUcustomer='".$dealer."' 
									GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)
									UNION
									SELECT customer_id AS DUcustomer,order_date AS DUdate,(product_price*SUM(quantity)) AS totalAmount,(product_tax*SUM(quantity)) AS TotalTax,0 AS PaidAmount FROM orders 
									WHERE customer_id='".$dealer."' AND order_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01')
									GROUP BY product_id,MONTH(order_date)
									UNION
									SELECT customer,payment_date,0,0,SUM(paid) AS PaidAmount FROM payments WHERE customer='".$dealer."' AND paid > 0
									GROUP BY MONTH(payment_date),YEAR(payment_date)
									) dump GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate) ORDER BY DUdate ASC;");
		$count = 4;
			foreach ($query->result() as $row) {
				//set cell A1 content with some text
				$this->excel->getActiveSheet()->setCellValue('C'.$count, $row->DUcustomer);
				$this->excel->getActiveSheet()->setCellValue('D'.$count, $row->EntryDate);
				$this->excel->getActiveSheet()->setCellValue('E'.$count, $row->totalAmount);
				$this->excel->getActiveSheet()->setCellValue('F'.$count, $row->TotalTax);
			$TotalAmount="=E".$count."+F".$count."";
				$this->excel->getActiveSheet()->setCellValue('G'.$count, $TotalAmount);
				$this->excel->getActiveSheet()->setCellValue('H'.$count, $row->totalAmount);
			//starting from row
				$count++;
			}

                $this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
				$LastLine=$count;
				$AutoSum=$count-1;
				$this->excel->getActiveSheet()->setCellValue('E'.$LastLine, '=SUM(E4:E'.$AutoSum.')');
				$this->excel->getActiveSheet()->setCellValue('F'.$LastLine, '=SUM(F4:F'.$AutoSum.')');
				$this->excel->getActiveSheet()->setCellValue('G'.$LastLine, '=SUM(G4:G'.$AutoSum.')');
				$this->excel->getActiveSheet()->setCellValue('H'.$LastLine, '=SUM(H4:H'.$AutoSum.')');

		$filename=$dealer.'-Units-N-PaymentsReport.xls'; //save our workbook as this file name
		//$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
    }


// UNITS REPORT ****** PRINT ******	 
	function reports_print() {

	if($_POST){
	
//Users Creator POST
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');
			}
//Calander Start Date
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
//Calander END Date
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}

		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="DUdate BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";

				$this->db->select('id');
				$this->db->from('payments');
				$this->db->where('customer',$UsrCre);
				$this->db->where("payment_date BETWEEN '$DateStart' AND '$DateEnd'");
				$query=$this->db->get();
				$data['payment']=$query->first_row('array');
		}			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT * FROM ordersreport WHERE DUcustomer='$UsrCre' ORDER BY DUpakage,DUdate ASC");
			} else if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT * FROM ordersreport WHERE $Date AND DUcustomer='$UsrCre' ORDER BY DUpakage,DUdate ASC");
			} else {
				$query = $this->db->query("SELECT * FROM ordersreport ORDER BY DUdate DESC");
			}
			
			if ($query->num_rows() > 0){
				$data['posts']=$query->result_array();
			} else {
				$data['posts']="0";
			}
			
			if(!empty($UsrCre) && empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

			if(!empty($UsrCre) && !empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount, SUM(taxamount) AS TaxAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$this->db->where($Date);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

		//$data['pagelink']=$this->db->last_query();

		$this->load->view('reports/reports_print',$data);
		
		} else {
			redirect(base_url().'reports');
		}
	}
	
// Current Month UNITS REPORT ****** PRINT ******	 
	function usersreports_print() {

	if($_POST){
	
//Users Creator POST
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');
			}
//Calander Start Date
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
				$data['DateStart']=$DateStart;
			}
//Calander END Date
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
				$data['DateEnd']=$DateEnd;
			}

		if(!empty($DateStart) && !empty($DateEnd)){
			$Date="order_date BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";

				$this->db->select('id');
				$this->db->from('payments');
				$this->db->where('customer',$UsrCre);
				$this->db->where("payment_date BETWEEN '$DateStart' AND '$DateEnd'");
				$query=$this->db->get();
				$data['payment']=$query->first_row('array');
		}			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT order_date,user_id,product_id,SUM(quantity) AS DUcount,product_price AS price,product_tax,(product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
					WHERE customer_id='$UsrCre' GROUP BY product_id,product_price,user_id ORDER BY order_date ASC");
			} else if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT order_date,user_id,product_id,SUM(quantity) AS DUcount,product_price AS price,product_tax,(product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
					WHERE $Date AND customer_id='$UsrCre' GROUP BY product_id,product_price,user_id ORDER BY order_date ASC");
			} else {
				$query = $this->db->query("SELECT order_date,user_id,product_id,SUM(quantity) AS DUcount,product_price AS price,product_tax,(product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
					GROUP BY product_id,product_price,user_id ORDER BY order_date DESC");
			}
			
			if ($query->num_rows() > 0){
				$data['posts']=$query->result_array();
			} else {
				$data['posts']="0";
			}
			
			if(!empty($UsrCre) && empty($Date)){
				$query = $this->db->query("SELECT SUM(user_id) AS user_id, SUM(DUAmount) AS DUAmount,ROUND(SUM(TaxAmount),2) AS TaxAmount FROM (
					SELECT COUNT(user_id) AS user_id, (product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
						WHERE customer_id='".$UsrCre."' GROUP BY product_id,product_price,user_id
					) dum");
				$data['Total']=$query->first_row('array');
				}

			if(!empty($UsrCre) && !empty($Date)){
				$query = $this->db->query("SELECT SUM(user_id) AS user_id, SUM(DUAmount) AS DUAmount,ROUND(SUM(TaxAmount),2) AS TaxAmount FROM (
					SELECT COUNT(user_id) AS user_id, (product_price*SUM(quantity)) AS DUAmount,(product_tax*SUM(quantity)) AS TaxAmount FROM orders 
						WHERE ".$Date." AND customer_id='".$UsrCre."' GROUP BY product_id,product_price,user_id
					) dum");
				$data['Total']=$query->first_row('array');
				}

		//$data['pagelink']=$this->db->last_query();

		$this->load->view('reports/usersreports_print',$data);
		
		} else {
			redirect(base_url().'reports');
		}
	}
	
//USERS UNITS REPORT ****** ******
	function usersreport($offset = 0){
		$uri_segment="3";
//Users POST
		$uname="0";
		if($this->input->post('username') != false){
			 	$uname = $this->input->post('username');
			 	$data['searchterm'] = $uname;
			$uri_segment=$uri_segment+1;
			}
//Calander Start Date
		$DateStart="0";
		if($this->input->post('DateStart') != false){
			 	$DateStart = $this->input->post('DateStart');
			$uri_segment=$uri_segment+1;
			}
//Calander END Date
		$DateEnd="0";
		if($this->input->post('DateEnd') != false){
			 	$DateEnd = $this->input->post('DateEnd');
			$uri_segment=$uri_segment+1;
			}
//Users Creator POST
		$UsrCre="0";
		if($this->input->post('UsrCre') != false){
			 	$UsrCre = $this->input->post('UsrCre');
			$uri_segment=$uri_segment+1;
			}
		$data['DateStart'] = $DateStart;
		$data['DateEnd'] = $DateEnd;
        $limit = 25;
        $data['posts'] = $this->report->getUsersunit($offset, $limit, $uname, $DateStart, $DateEnd, $UsrCre);
		
		$config['base_url']=base_url().'reports/usersreportlist/'.$uname.'/'.$DateStart.'/'.$DateEnd.'/'.$UsrCre.'/';

		$config['total_rows']=$this->report->getTotalUnits($uname, $DateStart, $DateEnd, $UsrCre);
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
        $data["results"] = $this->report->getUsersunit($config["per_page"], $page, $uname, $DateStart, $DateEnd, $UsrCre);

        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);

        $data['base_url'] = $config['base_url'];
        $data['totalrows'] = $config['total_rows'];
        $data['page_link'] = $this->pagination->create_js_links();

		$this->load->view('header', $data);
        $this->load->view('reports/usersreport_index', $data);
		$this->load->view('footer');
     }

     function usersreportlist($uname, $DateStart, $DateEnd, $UsrCre, $offset = 0) {
		
		if(empty($uname)){ $uname="0";}
		if(empty($DateStart)){ $status="0";}
		if(empty($DateEnd)){ $status="0";}
		if(empty($UsrCre)){ $UsrCre="0";}
		
		$limit = 25;
		$uri_segment="7";
		
        $data['posts'] = $this->report->getUsersunit($offset, $limit, $uname, $DateStart, $DateEnd, $UsrCre);

		$config['base_url']=base_url().'reports/usersreportlist/'.$uname.'/'.$DateStart.'/'.$DateEnd.'/'.$UsrCre.'/';	
		
		$config['total_rows']=$this->report->getTotalUnits($uname, $DateStart, $DateEnd, $UsrCre);
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
        $data["results"] = $this->report->getUsersunit($config["per_page"], $page, $uname, $DateStart, $DateEnd, $UsrCre);

        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);

        $data['base_url'] = $config['base_url'];
		$data['searchterm'] = $uname;
        $data['page_link'] = $this->pagination->create_js_links();

        $this->load->view('reports/usersreportlist', $data);
     }
	 
//Dealer Payments Report
	function paymentreport() {
		//$data['post']=$this->report->get_payments();
		$data['dealername'] = "office";
		$this->load->view('header');
		$this->load->view('reports/paymentreport_list',$data);
		$this->load->view('footer');
	}
	
//Without Pagination	
	function correct_permissions($required) {
		$user_type=$this->session->userdata('user_type');
		if($required=="user"){
			if($user_type=="user"){
				return true;
			}
		}elseif($required=="author"){
			if($user_type=="admin" || $user_type=="author"){
				return true;
			}
		}elseif($required=="admin"){
			if($user_type=="admin"){
				return true;
			}
		}
		
	}

 }
