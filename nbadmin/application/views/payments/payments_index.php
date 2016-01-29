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
								<a href="javascript:void(0)">Payments</a>
							</li>
							<li class="breadcrumb-active">Payments</li>
						</ol>
					</div>
				</header>

      <?php 
      $attributes = array('role' => 'form');
      echo form_open('payments/index', $attributes);?>
					<?php 
						$dayf=date("Y-m-d", time() - 86400);
						$dayt=date("Y-m-d");
					?>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">From Date</span>
									<input class="form-control form-control-inline input-medium date-picker" value="<?php echo $dayf; ?>" name="DateStart" type="text" value="" data-date-format="yyyy-mm-dd">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">To Date</span>
									<input class="form-control form-control-inline input-medium date-picker" value="<?php echo $dayt; ?>" name="DateEnd" type="text" value="" data-date-format="yyyy-mm-dd">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Dealer Name</span>
									<select class="form-control" name="UsrCre" >
									<option value="" selected="selected">Select Dealer</option>
										<?php $result = mysql_query("SELECT Dlrname FROM dealer");
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
						</div>
					</form>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Payment Details</div>
							</div>
							<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_6">
									<thead>
                                        <tr>
                                        	<th>Date</th>
                                            <th>Receipt #</th>
                                            <th>Dealer Name</th>
                                            <th>Total Amount</th> 
                                            <th>Amount Paid</th>
                                            <th>Discount</th>
                                            <th>Balance</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($posts)){?>
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
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
                                                <td><?php echo $row['payment_date']; ?></td>
                                                <td><?php echo $row['Receipt']; ?></td>
													<td><?php echo $row['customer']; ?></td>
													
													<td><?php echo $row['Amount']; ?></td>
													
													<td><?php echo $row['paid']; ?></td>
													<td><?php echo $row['Discount']; ?></td>
													<td><?php echo $row['Balance']; ?></td>
													<td><?php echo $row['Description']; ?></td>
													<td><center><a href="<?php echo base_url(); ?>payments/pview/<?php echo $row['id']; ?>"><i class="fa fa-search"></i></a></center></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
							<?php echo $last_query; ?>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->