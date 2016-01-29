<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
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
							<li class="breadcrumb-active">Dealer Payment</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-sm-12">

				<center>	
					<?php 
      $attributes = array('class' => 'panel');
      echo form_open('payments/index', $attributes);

						$dayf=date("Y-m-d", time() - 86400);
						$dayt=date("Y-m-d");
					?>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">From Date</span>
									<input type="text" name="DateStart" value="<?php echo $dayf; ?>" class="form-control" id="example1" placeholder="From Date">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">To Date</span>
									<input type="text" name="DateEnd" value="<?php echo $dayt; ?>" class="form-control" id="example2" placeholder="To Date">
<?php if(!$this->session->userdata('DealerPerm')){?>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
<?php } ?>
								</div>
							</div>
<?php if($this->session->userdata('DealerPerm')){?>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Dealer</span>
									<select class="form-control" name="UsrCre" >
									<option value="" selected="selected">All</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
									</select>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
								</div>
							</div>
<?php } ?>
						</div>
					</form>
				</center>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cc-mastercard"></i>Dealer  Payments</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">                                    
								<thead>
                                        <tr>
                                        <th>Date</th>
                                        <th>Receipt #</th>
                                            <th>Dealer ID</th>
                                            <th>Total Amount</th>
                                            
                                            <th>Amount Paid</th>
                                            <th>Discount</th>
                                            <th>Balance</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($posts)){?>
												<tr class="odd gradeX">
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
													<td></td>
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
													
													<td><center><a href="<?php echo base_url(); ?>payments/pview/<?php echo $row['id']; ?>"><i class="fa fa-search"></i></a></center></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
							<?php echo $last_query; ?>
                            <!-- /.table-responsive
                            <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                            </div> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->