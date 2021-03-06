
		<!-- BEGIN CONTENT -->
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
							<li class="breadcrumb-home-active">
								<a href="<?php echo base_url(); ?>">Home</a>
							</li>
							<li class="breadcrumb-active">Dashboard</li>
						</ol>
					</div>
					
				</header>
				<!-- END PAGE HEADER-->

<?php if($this->session->userdata('user_type')=="admin"){?>
				<!-- BEGIN DASHBOARD STATS -->
				<div class="row">
                
                	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="panel panel-tile">
                        <div class="panel-body">
                          <div class="row pv10">
                            <div class="col-xs-5 ph10"><img src="http://acp.laksol.com/files/style/clipart4.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Active <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
                              <?php
										$query = $this->db->query("SELECT COUNT(Username) AS UCount FROM users WHERE Active='1'");
						$row = $query->row();
											
												echo $row->UCount;

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
                            <div class="col-xs-5 ph10"><img src="http://acp.laksol.com/files/style/clipart0.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Latest <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										$query = $this->db->query("SELECT COUNT(Username) AS NUCount FROM users WHERE DATE(CDate) BETWEEN (DATE(NOW()) - INTERVAL 1 DAY) AND DATE(NOW())");
											$row = $query->row();
											if (!empty($row->NUCount)) {
												$value = $row->NUCount; // call attributes
												//echo " Users Added";
												if ($value > 999 && $value <= 999999) {
											$result = floor($value / 1000) . 'K';
										} elseif ($value > 999999 && $value <= 999999999) {
											$result = floor($value / 1000000) . 'M';
										}elseif ($value > 999999999 && $value <= 999999999999) {
											$result = floor($value / 1000000000) . 'B';
										}elseif ($value > 999999999999) {
											$result = floor($value / 1000000000000) . 'T';
										}else {
											$result = $value;
										}
											echo $result;
											} else {
												echo 0;
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
                            <div class="col-xs-5 ph10"><img src="http://acp.laksol.com/files/style/clipart1.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">De-Activated <br /> Users</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										$query = $this->db->query("SELECT COUNT(Username) AS DeAUCount FROM users WHERE DATE(Usr_DeActv) BETWEEN (DATE(NOW()) - INTERVAL 1 DAY) AND DATE(NOW())");
											$row = $query->row(); 
											if (!empty($row->DeAUCount)) {
												$value = $row->DeAUCount; // call attributes
												
												if ($value > 999 && $value <= 999999) {
												$result = floor($value / 1000) . 'K';
											} elseif ($value > 999999 && $value <= 999999999) {
												$result = floor($value / 1000000) . 'M';
											}elseif ($value > 999999999 && $value <= 999999999999) {
												$result = floor($value / 1000000000) . 'B';
											}elseif ($value > 999999999999) {
												$result = floor($value / 1000000000000) . 'T';
											}else {
												$result = $value;
											}
												echo $result;
											} else {
												echo 0;
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
                            <div class="col-xs-5 ph10"><img src="http://acp.laksol.com/files/style/clipart2.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">New <br /> Dealers</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										$query = $this->db->query("SELECT COUNT(Dlrname) AS NDCount FROM dealer WHERE DATE(CDate) BETWEEN (DATE(NOW()) - INTERVAL 1 MONTH) AND DATE(NOW())");
											$row = $query->row(); 
											if (!empty($row->NDCount)) {
												$value = $row->NDCount; // call attributes
												
												if ($value > 999 && $value <= 999999) {
												$result = floor($value / 1000) . 'K';
											} elseif ($value > 999999 && $value <= 999999999) {
												$result = floor($value / 1000000) . 'M';
											}elseif ($value > 999999999 && $value <= 999999999999) {
												$result = floor($value / 1000000000) . 'B';
											}elseif ($value > 999999999999) {
												$result = floor($value / 1000000000000) . 'T';
											}else {
												$result = $value;
											}
												echo $result;
												//echo " Dealers Added";
											} else {
												echo 0;
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
                            <div class="col-xs-5 ph10"><img src="http://acp.laksol.com/files/style/clipart3.png" class="img-responsive mauto" alt=""></div>
                            <div class="col-xs-7 pl5">
                              <h6 class="text-muted">Monthly <br /> Payments</h6>
                              <h2 class="fs50 mt5 mbn">
                              		<?php
										$query = $this->db->query("SELECT SUM(paid) AS PaidAmount FROM payments WHERE payment_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') GROUP BY MONTH(payment_date)");
											$row = $query->row(); 
											if (!empty($row->PaidAmount)) {
												$value =  $row->PaidAmount; // call attributes
												
											if ($value > 999 && $value <= 999999) {
												$result = floor($value / 1000) . 'K';
											} elseif ($value > 999999 && $value <= 999999999) {
												$result = floor($value / 1000000) . 'M';
											}elseif ($value > 999999999 && $value <= 999999999999) {
												$result = floor($value / 1000000000) . 'B';
											}elseif ($value > 999999999999) {
												$result = floor($value / 1000000000000) . 'T';
											}else {
												$result = $value;
											}
												echo $result;;
											} else {
												echo 0;
											}
									?>
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
					
				</div>
				<!-- END DASHBOARD STATS -->

<?php	$dayf=date('Y-m-d', strtotime('-1 day'));
						$dayt=date("Y-m-d", strtotime('+1 day'));?>
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cc-mastercard"></i> Recent Payments
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-responsive">
									<table class="table table-bordered">
									<thead>
									<tr>
                                            <th>Dealer Name</th>
                                            <th>Date</th> 
                                            <th>Receipt #</th>
                                            <th>Total Amount</th>
                                            <th>Paid</th>
                                            <th>Discount</th>
                                            <th>Balance</th>
                                            <th>View</th>
									</tr>
									</thead>
                                    <tbody>
								<?php $query = $this->db->query("SELECT * FROM payments WHERE paid > 0 and payment_date BETWEEN '".$dayf."' AND '".$dayt."' ORDER BY payment_date DESC");
											$count = 0;
											if ($query->num_rows() > 0)
											{
											   foreach ($query->result() as $row)
											   {?>
												<tr class="odd gradeX">
													<td><a href="<?php echo base_url(); ?>payments/index/?Dlr=<?php echo $row->customer; ?>"><?php echo $row->customer; ?></a></td>
                                                    <td><?php echo $row->payment_date; ?></td>
													
													<td><?php echo $row->Receipt; ?></td>
                                                    <td><?php echo $row->Amount; ?></td>
													<td><?php echo $row->paid; ?></td>
													<td><?php echo $row->Discount; ?></td>
													<td><?php echo $row->Balance; ?></td>
													
													<td><center><a href="<?php echo base_url(); ?>payments/pview/<?php echo $row->id; ?>"><i class="glyphicon glyphicon-search"></i></a></center></td>
												</tr>
										<?php }
										} else {?>
												<tr class="odd gradeX">
													<td></td>
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										<?php } ?>
								</tbody>
									</table>
								</div>
							</div>
						</div>
<?php } ?>
            <!-- /.row -->
			<div class="row">
            
            		<div class="col-md-6">
						<!-- BEGIN BORDERED TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cloud"></i> Online Users
								</div>
							</div>
							<div class="portlet-body">
								<div id="containerOnlineUsers" style="height: 400px"></div>
							</div>
						</div>
						<!-- END BORDERED TABLE PORTLET-->
					</div>
                    
					<div class="col-md-6">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user"></i> User Counts – Package wise
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<div id="containerUserCountsPackageWise" style="height: 400px"></div>
								</div>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
					
				</div>
            <!-- /.row -->

			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>
