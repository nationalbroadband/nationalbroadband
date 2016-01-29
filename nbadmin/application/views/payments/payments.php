<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Payment Details</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('payments'); ?>">Payments</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Payment Details</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Payment Details
								</div>
							</div>
							<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
                            <h3>Dealer Name: <?php echo $post['customer']; ?></h3>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <th>Date / Author</th>
                                            
                                            <td><?php echo $post['payment_date']; ?></td>
                                            <td><?php echo $post['AddedBy']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <th>DealerID / Receipt #</th>
                                            <td><?php echo $post['customer']; ?></td>
                                            <td colspan="2"><?php echo $post['Receipt']; ?></td>
                                        </tr>
                                        
										<tr>
                                            <th>Amount / Discount</th>
                                            <td><?php echo $post['Amount']; ?></td>
                                            <td colspan="2"><?php echo $post['Discount']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Amount Paid / Balance</th>
                                            <td><?php echo $post['paid']; ?></td>
                                            <td><?php echo $post['Balance']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Comment</th>
                                            <td colspan="3"><?php echo $post['Description']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>This is system generated invoice and does not require any stamp or signature</p>
						<?php
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
		