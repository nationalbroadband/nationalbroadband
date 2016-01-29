<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Your Details...<small>Full details of your dealer id</small></h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Home</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Profile</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Your Details</a>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
			<?php } else { ?>Dealer ID: <?php echo $post['Dlrname']; ?>
							</div>
						</div>
						<div class="portlet-body">
                            <p>Below are the information and personal details of you dealer account.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
										<tr>
                                            <th>UserID</th>
                                            <td colspan="2"><?php echo $post['Dlrname']; ?></td>
                                            <td>Click <a href="<?php echo base_url(); ?>welcome/password">Change</a> Password</td>
                                        </tr>
										<tr>
                                            <th>Name / CNIC</th>
                                            <td><?php echo $post['DFullName']; ?></td>
                                            <td colspan="2"><?php echo $post['DCNIC']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['DlrAdd']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone/Mobile/Status</th>
                                            <td><?php if (!empty($post['DPhone'])){
													echo $post['DPhone'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                            <td><?php if (!empty($post['DMobile'])){
													echo $post['DMobile'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                             <td><?php 
													if ($post['Active']==1){
														echo "Active";
													} else if($post['Active']==0){
														echo "<code>DeActive</code>";
													} else {
														echo "User is Blocked By Managment";
													} ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
											<td class="text-muted" colspan="3"><?php echo $post['DEmail']; ?></td>
                                        </tr>
										<tr>
                                            <th>Limit/ Used</th>
                                             <td colspan="2"><?php echo $post["BalLimit"]; ?></td>
                                             <td colspan="2"><?php echo $post["Balance"]; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
			<div class="row">
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            This Month Payments
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DealerID</th>
                                            <th>Date</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if(!isset($payment)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($payment as $row){
											$count++;
											?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['customer']; ?></td>
													<td><?php echo date("j-m-Y", strtotime($row["payment_date"])); ?></td>
													<td><?php echo $row['paid']; ?></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Active Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DealerID</th>
                                            <th>Package</th>
                                            <th>Total Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($users)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($users as $row){
											$count++;
											?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['creator']; ?></td>
													<td><?php echo $row['Package']; ?></td>
													<td><?php echo $row['TotalUsers']; ?></td>
												</tr>
										<?php }
										}?>
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
            </div>
			
			<div class="row">
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Last 6 Month Payments
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DealerID</th>
                                            <th>Date</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if(!isset($monthlypay)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($monthlypay as $row){
											$count++;
											?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['customer']; ?></td>
													<td><?php echo $row['mDate']; ?></td>
													<td><?php echo $row['PaidAmount']; ?></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Last 6 Months Usage
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DealerID</th>
                                            <th>Date</th>
                                            <th>Total Usage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($monthlyunits)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($monthlyunits as $row){
											$count++;
											?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['DUcustomer']; ?></td>
													<td><?php echo $row['DUdate']; ?></td>
													<td><?php echo $row['totalAmount']; ?></td>
												</tr>
										<?php }
										}?>
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
            </div>
						<?php
							}
							
		$postID =	$this->session->userdata('username');
		
			$this->db->select('*');
			$this->db->from('login_attempts');
			$this->db->where('Action','LogedIn');
			$this->db->where('user_id',$postID)->order_by('time','desc');
			$query=$this->db->get();
        if ($query->num_rows() > 0)
        {
            //$logindetail = $query->first_row('array');
            $logindetail = $query->next_row('array');
			
			echo "<center><h6>Your last login date & time ";
			echo $logindetail['time'];
			echo " From ";
			echo $logindetail['ipadd'];
			echo " IP address.</h6></center>";
			//echo $logindetail['client_user_agent'];
        }
						?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->
		