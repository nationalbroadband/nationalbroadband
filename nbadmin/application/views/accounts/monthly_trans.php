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
								<a href="javascript:void(0)">Accounts</a>
							</li>
							<li class="breadcrumb-active">Previous Transactions</li>
						</ol>
					</div>
				</header>

				
			<!-- END PAGE HEADER-->
			
<!-- Main content -->
                <section class="content invoice">    
				<div class="portlet light">                
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-newspaper-o"></i> Cybernet Internet Services (Pvt) Ltd.
                                <small class="pull-right">Previous Month Transactions</small>
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
                                    	<th>Date</th>
                                        <th>Dealer Name</th>
                                        <th>Amount with Tax</th>
                                        <th>Total Tax</th>
                                        <th>Discount</th>
                                        <th>Total Amount</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
							<?php $query = $this->db->query("SELECT DUcustomer,DATE_FORMAT(DATE(DUdate), '%M-%Y') AS DUdate,SUM(DUAmount) AS Amount,ROUND(SUM(taxamount),3) AS TotalTax, '0' AS Discount,(SUM(DUAmount)+SUM(taxamount)) AS TotalAmount FROM ordersreport
WHERE YEAR(DUdate) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(DUdate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)");

									foreach ($query->result() as $row) {
										echo "<tr>";
											echo "<td>" . $row->DUdate."</td>";
											echo "<td>" . $row->DUcustomer."</td>";
											echo "<td>".$row->Amount . "</td>";
											echo "<td>".$row->TotalTax . "</td>";
											echo "<td>".$row->Discount . "</td>";
											echo "<td>".$row->TotalAmount . "</td>";
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
<?php 
	if($this->input->post('EntDate')) {
		$EntyDate=$this->input->post('EntDate');
	} else {
		$EntyDate=date("Y-m-d");
	}
	
	$attributes = array('role' => 'form');
      echo form_open('accounts/monthlytrans', $attributes);?>
								<div class="col-xs-4">
									<div class="input-group">
									<span class="input-group-addon">Date</span>
										<input type="text" name="EntDate" value="<?php echo $EntyDate; ?>" class="form-control date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-1y">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Search</button>
										</span>
									</div>
								</div>
							 </form>
                            <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print" style="color:#fff;"></i> Print</button>
							<a href="<?php echo base_url('exportdata/entries/'.$EntyDate); ?>" class="btn btn-default pull-right" style="margin-right: 5px;" role="button"><i class="fa fa-download" style="color:#fff;"></i> Export to Excel</a>
                        <!--    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>  
							-->
                        </div>
                    </div>
                </section><!-- /.content -->
			
		</div> 
	</div>
</div> <!-- / #content-wrapper -->