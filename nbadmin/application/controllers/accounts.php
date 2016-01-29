<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

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

	function __construct(){
		parent::__construct();
		//load our new PHPExcel library
		$this->load->library('excel');
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('accounts/accounts');
		$this->load->view('footer');
	}
	
	public function limits()
	{
		$this->load->view('header');
		$this->load->view('accounts/limits');
		$this->load->view('footer');
	}
	
	public function balance()
	{
		$this->load->view('header');
		$this->load->view('accounts/balance');
		$this->load->view('footer');
	}
	
	public function monthlytrans()
	{
		$this->load->view('header');
		$this->load->view('accounts/monthly_trans');
		$this->load->view('footer');
	}
	
// UNITS REPORT ****** PRINT ******	 
	function reports_print($UsrCre="dadu",$DateStart=0,$DateEnd=0) {

	if($UsrCre){
	
						$date = $DateStart;

						$x = new DateTime($date);

						$x->modify("last day of this month");
						//$x->modify("last second");

						$DateEnd =  $x->format("d-M-Y");

						$x->modify("first day of this month");
						//$x->modify("last second");

						$DateStart2 = $x->format("d-M-Y");
						
						$DateStart = $x->format("Y-m-d");
	
				//Dealer Details
				$this->db->select('DFullName,Dlrname,Active');
				$this->db->from('dealer');
				$this->db->where('Dlrname',$UsrCre);
				$query=$this->db->get();
				$data['dealer']=$query->first_row('array');


				$data['DateStart']=$DateStart2;
				$data['DateEnd']=$DateEnd;
	
		if(!empty($DateStart) && !empty($DateEnd)){
			//$Date="DUdate BETWEEN '$DateStart 00:00:00' AND '$DateEnd 23:59:59'";
			$Date="DUdate > '$DateStart 00:00:00'";

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
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount');
				$this->db->from('ordersreport');
				$this->db->where('DUcustomer',$UsrCre);
				$query=$this->db->get();
				$data['Total']=$query->first_row('array');
			}

			if(!empty($UsrCre) && !empty($Date)){
				$this->db->select('COUNT(DUserID) AS DUserID, SUM(DUAmount) AS DUAmount');
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
	
	function monthlybalancereport($date="2015-09-09",$dealer="office") {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getProperties()->setCreator("StyleOfGlobal")
							 ->setLastModifiedBy("StyleOfGlobal")
							 ->setTitle($dealer.'-'.date("F Y", strtotime($date)))
							 ->setSubject($dealer.'-'.date("F Y", strtotime($date)))
							 ->setDescription("Dealer Monthly Units Report.")
							 ->setKeywords("ebone bills units report")
							 ->setCategory("Monthly Bill");
                $this->excel->getActiveSheet()->setTitle($dealer.'-'.date("F Y", strtotime($date)));
                //set cell A1 content with some text

                $this->excel->getActiveSheet()->setCellValue('C1', $dealer.' - '.date("F Y", strtotime($date)).' Monthly Units Report');
                $this->excel->getActiveSheet()->setCellValue('C3', 'DealerID');
                $this->excel->getActiveSheet()->setCellValue('D3', 'Month');
                $this->excel->getActiveSheet()->setCellValue('E3', 'Bill Amount');
                $this->excel->getActiveSheet()->setCellValue('F3', 'Discount');
                $this->excel->getActiveSheet()->setCellValue('G3', 'Adv Tax');
                $this->excel->getActiveSheet()->setCellValue('H3', 'TotalAmount');
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
					$this->db->select("DUcustomer,DATE_FORMAT(DATE(DUdate), '%M %Y') AS BillMonth,SUM(DUAmount) AS Amount,mPerCentOff,SUM(taxamount) AS TotalTax,'=(E4-F4)+G4' AS TotalAmount", FALSE);
					$this->db->from('ordersreport');
					$this->db->join('dealer', 'dealer.Dlrname=ordersreport.DUcustomer');
					$this->db->join('managers', 'managers.creator=dealer.creator AND managers.Dlrname=dealer.Dlrname');
					if(!empty($date)) {
						$this->db->where("MONTH(DUdate) = MONTH('".$date."') AND YEAR(DUdate) = YEAR('".$date."')");
						$this->db->where('dealer.creator',$dealer);
					} else {
						$this->db->where('MONTH(DUdate) = MONTH(NOW()) AND YEAR(DUdate) = YEAR(NOW())');
					}
					$this->db->group_by(array("DUcustomer", "MONTH(DUdate)", "YEAR(DUdate)"));
					
					$query=$this->db->get();
		$count = 4;
			foreach ($query->result() as $row) {
				//set cell A1 content with some text
				$this->excel->getActiveSheet()->setCellValue('C'.$count, $row->DUcustomer);
				$this->excel->getActiveSheet()->setCellValue('D'.$count, $row->BillMonth);
				$this->excel->getActiveSheet()->setCellValue('E'.$count, $row->Amount);
			$Discount="=E".$count."*".$row->mPerCentOff."/100";
				$this->excel->getActiveSheet()->setCellValue('F'.$count, $Discount);
				$this->excel->getActiveSheet()->setCellValue('G'.$count, $row->TotalTax);
			$TotalAmount="=(E".$count."-F".$count.")+G".$count."";
				$this->excel->getActiveSheet()->setCellValue('H'.$count, $TotalAmount);
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

		$filename=$dealer.'-'.date("F Y", strtotime($date)).'-UnitReport.xls'; //save our workbook as this file name
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
	
	function monthlybalancereport2($date=0,$dealer=0) {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getProperties()->setCreator("StyleOfGlobal")
							 ->setLastModifiedBy("StyleOfGlobal")
							 ->setTitle($dealer.'-'.date("F Y", strtotime($date)))
							 ->setSubject($dealer.'-'.date("F Y", strtotime($date)))
							 ->setDescription("Dealer Monthly Units Report.")
							 ->setKeywords("ebone bills units report")
							 ->setCategory("Monthly Bill");
                $this->excel->getActiveSheet()->setTitle($dealer.'-'.date("F Y", strtotime($date)));
                //set cell A1 content with some text

                $this->excel->getActiveSheet()->setCellValue('C1', $dealer.' - '.date("F Y", strtotime($date)).' Monthly Units Report');
                $this->excel->getActiveSheet()->setCellValue('C3', 'DealerID');
                $this->excel->getActiveSheet()->setCellValue('D3', 'Month');
                $this->excel->getActiveSheet()->setCellValue('E3', 'Bill Amount');
                $this->excel->getActiveSheet()->setCellValue('F3', 'Discount');
                $this->excel->getActiveSheet()->setCellValue('G3', 'Adv Tax');
                $this->excel->getActiveSheet()->setCellValue('H3', 'TotalAmount');
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
                //retrive mysql clients table data
					$this->db->select("DUcustomer,DATE_FORMAT(DATE(DUdate), '%M %Y') AS BillMonth,SUM(DUAmount) AS Amount,SUM(DUAmount)*managers.mPerCentOff/100 AS Discount,SUM(taxamount) AS TotalTax,'=(E4-F4)+G4' AS TotalAmount", FALSE);
					$this->db->from('ordersreport');
					$this->db->join('dealer', 'dealer.Dlrname=ordersreport.DUcustomer');
					$this->db->join('managers', 'managers.creator=dealer.creator AND managers.Dlrname=dealer.Dlrname');
					if(!empty($date)) {
						$this->db->where("MONTH(DUdate) = MONTH('".$date."') AND YEAR(DUdate) = YEAR('".$date."')");
						$this->db->where('dealer.creator',$dealer);
					} else {
						$this->db->where('MONTH(DUdate) = MONTH(NOW()) AND YEAR(DUdate) = YEAR(NOW())');
					}
					$this->db->group_by(array("DUcustomer", "MONTH(DUdate)", "YEAR(DUdate)"));
					
					$rs=$this->db->get();

                $exceldata="";
        foreach ($rs->result_array() as $row){
                $exceldata[] = $row;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'C4');
                 
                $this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
				$LastLine=count($exceldata)+4;
				$AutoSum=$LastLine-1;
				$this->excel->getActiveSheet()->setCellValue('E'.$LastLine, '=SUM(E4:E'.$AutoSum.')');
				$this->excel->getActiveSheet()->setCellValue('F'.$LastLine, '=SUM(F4:F'.$AutoSum.')');
				$this->excel->getActiveSheet()->setCellValue('G'.$LastLine, '=SUM(G4:G'.$AutoSum.')');
				$this->excel->getActiveSheet()->setCellValue('H'.$LastLine, '=SUM(H4:H'.$AutoSum.')');
				 
                $filename=$dealer.'-'.date("F Y", strtotime($date)).'-UnitReport.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
    }
	
    function excel($date=0,$dealer=0) {
		$filename=$dealer."-".date("F Y", strtotime($date))."-UnitReport.xls";
	//retrive mysql clients table data
			$this->db->select("DUcustomer AS DealerID,DATE_FORMAT(DATE(DUdate), '%M %Y') AS BillMonth,SUM(DUAmount) AS Amount,SUM(DUAmount)*managers.mPerCentOff/100 AS Discount,SUM(taxamount) AS TotalTax", FALSE);
			$this->db->from('ordersreport');
			$this->db->join('dealer', 'dealer.Dlrname=ordersreport.DUcustomer');
			$this->db->join('managers', 'managers.mDlrname=dealer.creator');
		if(!empty($date)) {
			$this->db->where("MONTH(DUdate) = MONTH('".$date."') AND YEAR(DUdate) = YEAR('".$date."')");
			$this->db->where('dealer.creator',$dealer);
		} else {
			$this->db->where('MONTH(DUdate) = MONTH(NOW()) AND YEAR(DUdate) = YEAR(NOW())');
		}
			$this->db->group_by(array("DUcustomer", "MONTH(DUdate)", "YEAR(DUdate)"));
					
			$query=$this->db->get();
			$data = $query->result_array();

        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);
                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
    }
	
	function createfile2($data=0) {
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		//See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.KfhZu4kn.dpuf
	}

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
