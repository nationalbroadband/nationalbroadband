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
							<li class="breadcrumb-active">Dealer Balances</li>
						</ol>
					</div>
				</header>
	
			<!-- END PAGE HEADER-->
<?php
	if($this->input->post('EntDate')) {
		$EntyDate=$this->input->post('EntDate');
	} else {
		$EntyDate=date("Y-m-d");
	}

	if($this->input->post('UsrCre')) {
		$UsrCre=$this->input->post('UsrCre');
	} else {
		$UsrCre="office";
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
                                <small class="pull-right">Dealers Balances as of  <?php echo date("F Y", strtotime($EntyDate)); ?></small>
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
                                            <th>Total Bill</th>
                                            <th>Discount</th>
                                            <th>Adv Tax</th>
                                            <th>Total Amount</th>
                                            <th>Manager Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									if(!empty($UsrCre) && !empty($EntyDate)){
											$query = $this->db->query("SELECT DUcustomer,DATE(DUdate) AS DUdate,SUM(DUAmount) AS Amount,ROUND(SUM(taxamount),3) AS TotalTax,ROUND(SUM(taxamount),3)+SUM(DUAmount) AS totalAmount,dealer.creator AS DealerHead FROM ordersreport
																INNER JOIN dealer ON dealer.Dlrname=ordersreport.DUcustomer
																WHERE dealer.creator='".$this->input->post('UsrCre')."' AND MONTH(DUdate) = MONTH('".$EntyDate."') AND YEAR(DUdate) = YEAR('".$EntyDate."')
																GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)");
									} else if(!empty($UsrCre) && empty($EntyDate)){
											$query = $this->db->query("SELECT DUcustomer,DATE(DUdate) AS DUdate,SUM(DUAmount) AS Amount,ROUND(SUM(taxamount),3) AS TotalTax,ROUND(SUM(taxamount),3)+SUM(DUAmount) AS totalAmount,dealer.creator AS DealerHead FROM ordersreport
																INNER JOIN dealer ON dealer.Dlrname=ordersreport.DUcustomer
																WHERE dealer.creator='".$this->input->post('UsrCre')."'
																GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)");
									} else {
											$query = $this->db->query("SELECT DUcustomer,DATE(DUdate) AS DUdate,SUM(DUAmount) AS Amount,ROUND(SUM(taxamount),3) AS TotalTax,ROUND(SUM(taxamount),3)+SUM(DUAmount) AS totalAmount,dealer.creator AS DealerHead FROM ordersreport
																INNER JOIN dealer ON dealer.Dlrname=ordersreport.DUcustomer
																WHERE dealer.creator='".$this->input->post('UsrCre')."' AND MONTH(DUdate) = MONTH('".$EntyDate."') AND YEAR(DUdate) = YEAR('".$EntyDate."')
																GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)");
										}
											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td><a href='";
												echo base_url();
												echo "accounts/reports_print/";
												echo $row->DUcustomer."/" . $row->DUdate;
												echo "'>" . $row->DUdate."</a></td>";
												echo "<td>" . $row->DUcustomer."</td>";
												
												echo "<td>".$row->Amount . "</td>";
												echo "<td>0</td>";
												echo "<td>".$row->TotalTax . "</td>";
												echo "<td>".$row->totalAmount . "</td>";
												echo "<td>".$row->DealerHead . "</td>";
												echo "<td><a href='";
												echo base_url();
												echo "payments/addnew/";
												echo $row->DUcustomer."?Amount=".$row->totalAmount;
												echo "'>Make Payment</a></td>";
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
<?php 	$attributes = array('role' => 'form');
      echo form_open('accounts/balance', $attributes);?>
								<div class="col-xs-3">
									<div class="input-group">
									<span class="input-group-addon">Select Date</span>
										<input type="text" name="EntDate" value="<?php echo $EntyDate; ?>" class="form-control date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-1y">
									</div>
								</div>
								<div class="col-xs-3">
									<div class="input-group">
										<span class="input-group-addon">Manager Name</span>
												<select class="form-control" name="UsrCre" >
												<option value="" selected="selected">Select</option>
													<?php $result = mysql_query("SELECT Dlrname FROM dealer WHERE Active='1' AND DSub='1' ORDER BY Dlrname ASC");
															while ($cat = mysql_fetch_assoc($result)) {
													
													?>		
													<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
													<?php 
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
							<a href="<?php echo base_url('accounts/monthlybalancereport/'.$EntyDate.'/'.$UsrCre); ?>" class="btn btn-default pull-right" style="margin-right: 5px;" role="button"><i class="fa fa-download" style="color:#fff;"></i> Export to Excel</a>
                        <!--    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>  
							-->
                        </div>
                    </div>
                </section><!-- /.content -->
			
		</div> 
	</div>
</div> <!-- / #content-wrapper -->