<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			
								<header class="alt" id="topbar">
					<div class="topbar-left">
						<ol class="breadcrumb">
							<li class="breadcrumb-icon">
								<a href="<?php echo base_url(); ?>">
									<span class="fa fa-home"></span>
								</a>
							</li>
							<li class="breadcrumb-home">
								<a href="<?php echo base_url(); ?>">Home</a>
							</li>
							<li class="breadcrumb-current-item">
								<a href="javascript:void(0)">Reports</a>
							</li>
							<li class="breadcrumb-active">Dealers Payments Report</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE HEADER-->
<?php 
	if($this->input->post('UsrCre')) {
		$UsrCre=$this->input->post('UsrCre');
	} else {
		$UsrCre="nbadmin";
	}
?>
<!-- Main content -->
                <section class="content invoice">    
				<div class="portlet light">                
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-newspaper-o"></i> Cybernet Internet Services (Pvt) Ltd.
                                <small class="pull-right">Dealer’s Transaction Details</small>
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <!-- Table row -->
				
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Dealer Name</th>
                                        <th>Acounting Month</th>
                                        <th>Total Amount</th>
                                        <th>Total Tax Amount</th>
                                        <th>Total Bill</th>
                                        <th>Total Paid</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
							<?php $query = $this->db->query("SELECT DUcustomer,DATE_FORMAT(DATE(DUdate), '%M-%Y') AS EntryDate,SUM(totalAmount) AS totalAmount,SUM(TotalTax) AS TotalTax,SUM(PaidAmount) AS TotalPaid FROM (
									SELECT DUcustomer,DUdate,SUM(DUAmount) AS totalAmount,SUM(taxamount) AS TotalTax,0 AS PaidAmount FROM ordersreport
									WHERE DUcustomer='".$UsrCre."' 
									GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)
									UNION
									SELECT customer_id AS DUcustomer,order_date AS DUdate,(product_price*SUM(quantity)) AS totalAmount,(product_tax*SUM(quantity)) AS TotalTax,0 AS PaidAmount FROM orders 
									WHERE customer_id='".$UsrCre."' AND order_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01')
									GROUP BY product_id,MONTH(order_date)
									UNION
									SELECT customer,payment_date,0,0,SUM(paid) AS PaidAmount FROM payments WHERE customer='".$UsrCre."' AND paid > 0
									GROUP BY MONTH(payment_date),YEAR(payment_date)
									) dump GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate) ORDER BY DUdate ASC;");

									foreach ($query->result() as $row) {
										echo "<tr>";
											echo "<td>" . $row->DUcustomer."</td>";
											echo "<td>" . $row->EntryDate."</td>";
											echo "<td>".$row->totalAmount . "</td>";
											echo "<td>".$row->TotalTax . "</td>";
											echo "<td>0</td>";
											echo "<td>".$row->TotalPaid . "</td>";
										echo "</tr>";
									}
								?>
                                </tbody>
                            </table>                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
<?php $attributes = array('role' => 'form');
      echo form_open('reports/dreports', $attributes);?>
								<div class="col-xs-4">
									<div class="input-group">
									<span class="input-group-addon">Dealer Name</span>
											<select class="form-control" name="UsrCre">
									<?php	$query = $this->db->query("SELECT Dlrname FROM dealer");
											foreach ($query->result() as $row) {
												if($UsrCre == $row->Dlrname) {
													echo "<option selected value=\"".$row->Dlrname."\">".$row->Dlrname."</option>";
												} else {
													echo "<option value=\"".$row->Dlrname."\">".$row->Dlrname."</option>";
												}
											}
										?>
											</select>
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Search</button>
										</span>
									</div>
								</div>
							 </form>
                            <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print" style="color:#fff;"></i> Print</button>
							<a href="<?php echo base_url('reports/ExportDlrReport/'.$UsrCre); ?>" class="btn btn-default pull-right" style="margin-right: 5px;" role="button"><i class="fa fa-download" style="color:#fff;"></i> Export to Excel</a>
                        <!--    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>  
							-->
                        </div>
                    </div>
                </section><!-- /.content -->
			
		</div> 
	</div>
</div> <!-- / #content-wrapper -->