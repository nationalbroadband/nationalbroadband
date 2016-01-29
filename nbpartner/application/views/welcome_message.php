<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<header class="alt" id="topbar">
					<div class="topbar-left">
						<ol class="breadcrumb">
							<li class="breadcrumb-icon">
								<a href="<?php echo base_url(); ?>">
									<span class="fa fa-home" style="color:#14B9D6 !important;"></span>
								</a>
							</li>
							<li class="breadcrumb-home">
								<a href="<?php echo base_url(); ?>">Home</a>
							</li>
							<li class="breadcrumb-active">Dashboard</li>
						</ol>
					</div>
					
				</header>
				<!-- END PAGE HEADER-->

			<div class="row">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="panel panel-tile">
                        <div class="panel-body">
                          <div class="row pv10">
                            <div class="col-xs-5 ph10"><img src="files/style/clipart4.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Online <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
							  <?php
						$dealer = '';
						$counter = '';
										if($this->session->userdata('DealerPerm')){
//											$query = $this->db->query("SELECT COUNT(username) AS UCount, radacct.creator FROM radacct INNER JOIN dealer ON dealer.Dlrname=radacct.creator WHERE acctstoptime IS NULL AND dealer.creator='".$this->session->userdata('username')."' GROUP BY creator");
											$query = $this->db->query("SELECT COUNT(username) AS UCount, radacct.creator FROM radacct INNER JOIN dealer ON dealer.Dlrname=radacct.creator WHERE acctstoptime IS NULL AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(username) AS UCount, creator FROM radacct WHERE acctstoptime IS NULL AND creator='".$this->session->userdata('username')."'");
										}
											foreach ($query->result() as $row) {
												$value = $row->UCount;
											}
											echo short_digit_value($value);
									?>
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
			
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="panel panel-tile">
                        <div class="panel-body">
                          <div class="row pv10">
                            <div class="col-xs-5 ph10"><img src="files/style/clipart4.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Active <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
                              <?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS UCount FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.Active='1' AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS UCount FROM users WHERE users.Active='1' AND users.creator='".$this->session->userdata('username')."'");
										}
											$row = $query->row(); 
											$value =  $row->UCount;
											echo short_digit_value($value);
									?>
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="panel panel-tile">
                        <div class="panel-body">
                          <div class="row pv10">
                            <div class="col-xs-5 ph10"><img src="files/style/clipart0.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Latest <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS NUCount FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.CDate > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS NUCount FROM users WHERE users.CDate > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND users.creator='".$this->session->userdata('username')."'");
										}
											$row = $query->row();
											if (!empty($row->NUCount)) {
												$value =  $row->NUCount; 
												echo short_digit_value($value);
											} else {
												echo "0";
											}
									?>
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="panel panel-tile">
                        <div class="panel-body">
                          <div class="row pv10">
                            <div class="col-xs-5 ph10"><img src="files/style/clipart1.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">De-Activated <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS DeAUCount FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.Usr_DeActv > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS DeAUCount FROM users WHERE Usr_DeActv > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND creator='".$this->session->userdata('username')."'");
										}
											$row = $query->row();
											if (!empty($row->DeAUCount)) {
												$value = $row->DeAUCount; 
												echo short_digit_value($value);
												} else {
												echo "0";
											}
									?>
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="panel panel-tile">
                        <div class="panel-body">
                          <div class="row pv10">
                            <div class="col-xs-5 ph10"><img src="files/style/clipart3.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Monthly <br /> Payments</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT SUM(paid) AS TotalPayments FROM payments INNER JOIN dealer ON dealer.Dlrname=payments.customer WHERE payment_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT SUM(paid) AS TotalPayments FROM payments WHERE payment_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND customer='".$this->session->userdata('username')."' AND paid > 0");
										}
											$row = $query->row();
											if (!empty($row->TotalPayments)) {
												$value =  $row->TotalPayments; 
												echo short_digit_value($value);
											} else {
												echo "0";
											}
									?>
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
			</div>
			
		<?php if($this->session->userdata('DealerPerm')){?>
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN BORDERED TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cc-mastercard"></i> Units Consumption</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
									<thead>
										<tr>
                                            <th>#</th>
                                            <th>Dealer ID</th>
                                            <th>Month Year</th>
                                            <th>Bill Amount</th>
                                            <th>Advance Tax</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php //$query = $this->db->query("SELECT COUNT(username) AS UCount, creator FROM radacct WHERE acctstoptime IS NULL GROUP BY creator");
									$Date = date("Y-m-d", strtotime("first day of last month"));
									 $query = $this->db->query("SELECT DUcustomer,DATE_FORMAT(DATE(DUdate), '01-%m-%Y') AS DUdate,SUM(DUAmount) AS totalAmount,SUM(taxamount) AS TotalTax,dealer.creator AS DealerHead FROM ordersreport INNER JOIN dealer ON dealer.Dlrname=ordersreport.DUcustomer WHERE dealer.creator='".$this->session->userdata('username')."' AND DUdate > '".$Date." 00:00:00' GROUP BY DUcustomer,MONTH(DUdate),YEAR(DUdate)");
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<tr>";
												echo "<td>" . $count."</td>";
												echo "<td>" . $row->DUcustomer."</td>";
												echo "<td>".$row->DUdate . "</td>";
												echo "<td>".$row->totalAmount . "</td>";
												echo "<td>".$row->TotalTax . "</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query();
									?>
                                    </tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END BORDERED TABLE PORTLET-->
					</div>
                    
                    <div class="col-sm-3">
                	
					
                    <!-- /.panel -->
                </div>
                
				</div>
            <!-- /.row -->
		<?php } ?>
			
			<div class="row">                

                <div class="col-sm-12">
                
                <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>User Counts – Package Wise</div>
						</div>
						<div class="portlet-body">
							<div id="containerUserCounts" style="height: 400px"></div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
			<div class="row">
                
                <div class="col-sm-12">
                
                <?php if($this->session->userdata('DealerPerm')){ ?>
                
                <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>User Counts – Dealer Wise</div>
						</div>
						<div class="portlet-body">
							<div id="containerActiveUsers" style="height: 400px"></div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					
				<?php } ?>
                
                
                </div>
                <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->                
		</div>
	</div>
	<!-- END CONTENT -->

        <!-- Page rendered in <strong>{elapsed_time}</strong> seconds  -->
