<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Home Page </h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
					<div class="note note-success note-shadow">
						<p>
							 It is to inform you that the rates of E-Silver Package have been revised. The new and discounted rate for E-Silver Package is now PKR 300/-.
						</p>
						<p>
								<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS UCount FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.Active='1' AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS UCount FROM users WHERE users.Active='1' AND users.creator='".$this->session->userdata('username')."'");
										}
											$row = $query->row(); 
											echo ucwords($this->session->userdata('username'))." Have " . $row->UCount . " Active Users Right Now..";
									?>
						</p>
					</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-purple-soft">
									<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS NUCount FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.CDate > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS NUCount FROM users WHERE users.CDate > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND users.creator='".$this->session->userdata('username')."'");
										}
											$row = $query->row();
											if (!empty($row->NUCount)) {
												echo $row->NUCount; // call attributes
												//echo " Users Added";
											} else {
												echo "- NiL -";
											}
											//echo $this->db->last_query();
									?></h3>
								<small>NEW USERS</small>
							</div>
							<div class="icon">
								<i class="icon-user"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="status">
								<div class="status-title">
									 This Month
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-red-haze"><?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS DeAUCount FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.Usr_DeActv > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS DeAUCount FROM users WHERE Usr_DeActv > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND creator='".$this->session->userdata('username')."'");
										}
											$row = $query->row();
											if (!empty($row->DeAUCount)) {
												echo $row->DeAUCount; // call attributes
												//echo " Users Added";
											} else {
												echo "- NiL -";
											}
											//echo $this->db->last_query();
									?></h3>
								<small>Stoped Users</small>
							</div>
							<div class="icon">
								<i class="icon-pie-chart"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="status">
								<div class="status-title">
									  This Month
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-green-sharp"><?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT SUM(paid) AS TotalPayments FROM payments INNER JOIN dealer ON dealer.Dlrname=payments.customer WHERE payment_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND dealer.creator='".$this->session->userdata('username')."'");
										} else {
											$query = $this->db->query("SELECT SUM(paid) AS TotalPayments FROM payments WHERE payment_date > DATE_FORMAT(DATE(NOW()), '%Y-%m-01') AND customer='".$this->session->userdata('username')."'");
										}
											$row = $query->row();
											if (!empty($row->TotalPayments)) {
												echo $row->TotalPayments; // call attributes
												//echo " Users Added";
											} else {
												echo "- NiL -";
											}
											//echo $this->db->last_query();
									?>
								</h3>
								<small>Total Payment</small>
							</div>
							<div class="icon">
								<i class="fa fa-dollar"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="status">
								<div class="status-title">
									 This Month
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
                <div class="col-sm-7">
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-coffee"></i>Active Users Count Package Wise
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Package</th>
                                            <th>User Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS UCount, pname AS Package FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator INNER JOIN package ON users.Package=package.listname WHERE users.Active='1' AND dealer.creator='".$this->session->userdata('username')."' GROUP BY Package");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS UCount, pname AS Package FROM users INNER JOIN package ON users.Package=package.listname WHERE users.Active='1' AND users.creator='".$this->session->userdata('username')."' GROUP BY Package");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<tr>";
												echo "<td>" . $count."</td>";
												echo "<td>" . $row->Package."</td>";
												echo "<td>".$row->UCount . " Users</td>";
												echo "</tr>";
											}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Dealer Active Users Count..
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
                                    <thead>
                                            <th>#</th>
                                            <th>Dealer</th>
                                            <th>User Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT users.creator,COUNT(users.Username) AS UCount FROM users,dealer WHERE dealer.Dlrname=users.creator AND (users.creator='". $this->session->userdata('username'). "' OR dealer.creator='". $this->session->userdata('username'). "') AND users.Active='1' GROUP BY users.creator");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS UCount,creator FROM users WHERE creator='". $this->session->userdata('username'). "' AND Active='1'");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<tr>";
												echo "<td>" . $count."</td>";
												echo "<td>" . $row->creator."</td>";
												echo "<td>".$row->UCount . " Users</td>";
												echo "</tr>";
											}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-sm-5">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-picture"></i>Notification.......!
							</div>
						</div>
						<div class="portlet-body">
							<!--<div class="thumbnail">
								<img class="img-responsive" src="<?php echo base_url(); ?>images/Dealer-Notice.jpg" alt="Dealer Users Limit Notice">
							</div>-->
						<?php	$query = $this->db->query("SELECT * FROM dbadmin_msgs WHERE Active='1' ORDER BY MsgDate DESC LIMIT 0,1");
											foreach ($query->result() as $row) {
												echo $row->AdminMsg;
												echo '<a href="'.base_url().'welcome/msg/'.$row->Msgaly . '">';
											if(!empty($row->Msgimg)) {
												echo '<img width="340" alt="'.$row->Msgaly . '" src="'.$row->Msgimg . '">';
											}
												echo '</a>';
											} ?>
                            <!-- /.Billing Msg -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				<?php if($this->session->userdata('DealerPerm')){ ?>
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Online Users <?php	if($this->session->userdata('DealerPerm')){	echo "Dealer Wise";	} ?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dealer Name</th>
                                            <th>Online Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(username) AS UCount, radacct.creator FROM radacct INNER JOIN dealer ON dealer.Dlrname=radacct.creator WHERE acctstoptime IS NULL AND dealer.creator='".$this->session->userdata('username')."' GROUP BY creator");
										} else {
											$query = $this->db->query("SELECT COUNT(username) AS UCount, creator FROM radacct WHERE acctstoptime IS NULL AND creator='".$this->session->userdata('username')."'");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<tr>";
												echo "<td>" . $count."</td>";
												echo "<td>" . $row->creator."</td>";
												echo "<td>".$row->UCount . " Users</td>";
												echo "</tr>";
											}
									?>
                                    </tbody>
                                </table>
                            </div>
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