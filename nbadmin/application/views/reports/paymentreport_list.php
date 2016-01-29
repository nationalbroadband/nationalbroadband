<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Dealer Payment</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('reports'); ?>">Reports</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Dealer Payment</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>
								</div>
							</div>
							<div class="portlet-body">
                            <h3></h3>
                            <p></p>
			<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr><td align='center' colspan='9'><font size='+2' color='#006393'>
										<b>Dealer Payment Report </b></font></td></tr>
                                    </thead>
                                    <tbody>
										<tr><td colspan='2' align='left'><b><font size='-1'>From Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo "2014-09-01"; ?>&nbsp;</font></td>
										<td colspan='2' align='left'><b><font size='-1'>To Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo date("Y-m-d"); ?>&nbsp;</font></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Dealer Name</font></b></td>
										<td colspan='2'><b><font size='-1' color='purple'><?php echo $this->input->post('UsrCre'); ?>&nbsp;</font></b></td>
										<td colspan='2'><b><font size='-1'>Dealer’s Name</font></b></td>
										<td colspan='2' ><b><font size='-1' color='purple'><?php echo $this->input->post('UsrCre'); ?>&nbsp;&nbsp;&nbsp;</font></b></td></tr>
                                    </tbody>
                                </table>
								
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr. #</th>
                                            <th>Receipt. #</th>
                                            <th>Date Time</th>
                                            <th>Description</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php
									$dealername=$this->input->post('UsrCre');
									
									$query3 = mysql_query("SELECT * FROM payments WHERE customer='$dealername'") or die(mysql_error());

											if(mysql_num_rows($query3) == 0) {?>
												<p> <code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
								<?php 	} else {
									$count = 0;
											while($row = mysql_fetch_assoc($query3)){
											$count++;?> 
												<tr class="odd gradeX">
													<td><?php echo $count; ?></td>
													<td><?php echo $row['Receipt']; ?></td>
													<td><?php echo $row['payment_date']; ?></td>
													<td><?php echo $row['Description']; ?></td>
													<td><?php echo $row['Amount']; ?></td>
													<td><?php echo $row['paid']; ?></td>
													<td><?php echo $row['Balance']; ?></td>
												</tr>
							<?php 	}	
								}?>								
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->
		