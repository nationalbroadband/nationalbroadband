<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
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
							<li class="breadcrumb-active">Previous Payment Entries</li>
						</ol>
					</div>
				</header>
				<!-- END PAGE HEADER-->	
					<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-newspaper-o"></i> Previous Payment Entries</div>
							</div>
							<div class="portlet-body">
								 <table class="table table-striped table-bordered table-hover" id="sample_6">
                                    <thead>
                                        <tr>
                                        <th>Date</th>
                                        <th>Receipt  #</th>
                                            <th>Dealer Name</th>
                                            <th>Total Amount</th>
                                            <th>Total Paid</th>
                                            <th>Discount</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php $query = $this->db->query("SELECT * FROM (
																SELECT * FROM payments WHERE paid > 0 ORDER BY payment_date DESC
															) AS sub GROUP BY customer");
											$count = 0;
											if ($query->num_rows() > 0)
											{
											   foreach ($query->result() as $row)
											   {?>
												<tr class="odd gradeX">
                                                <td><?php echo $row->payment_date; ?></td>
                                                <td><?php echo $row->Receipt; ?></td>
													<td><a href="<?php echo base_url(); ?>dealers/dealer/<?php echo $row->customer; ?>"><?php echo $row->customer; ?></a></td>
													
													<td><?php echo $row->Amount; ?></td>
													
													<td><?php echo $row->paid; ?></td>
													<td><?php echo $row->Discount; ?></td>
													<td><?php echo $row->Balance; ?></td>
													<td><center><a href="<?php echo base_url(); ?>payments/pview/<?php echo $row->id; ?>"><i class="glyphicon glyphicon-search"></i></a></center></td>
												</tr>
										<?php }
										} else {?>
												<tr class="odd gradeX">
													<td><code>- No -</code></td>
													<td><code>- Data -</code></td>
													<td><code>- Found -</code></td>
													<td><code>- - -</code></td>
													<td><code>- - -</code></td>
													<td><code>- - -</code></td>
													<td><code>- Try -</code></td>
													<td><code>- Again -</code></td>
												</tr>
										<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                </div>
				<!-- /.col-lg-12 -->
			</div>
        </div>
        <!-- /#page-wrapper -->