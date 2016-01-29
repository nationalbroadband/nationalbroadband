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
							<li class="breadcrumb-active">User Payment</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
		<div class="row">
			<div class="col-sm-12">
			

				<center>
<?php if($this->session->userdata('DealerPerm')){

// Dealer Manager
      $attributes = array('class' => 'panel');
      echo form_open('payments/getuserpayments', $attributes);?>

						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">From Date</span>
									<input type="text" name="DateStart" value="" id="example1" class="form-control" placeholder="From Date">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">To Date</span>
									<input type="text" name="DateEnd" value="" id="example2" class="form-control" placeholder="To Date">
								</div>
							</div>
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
						</div>
					</form>

<?php } else {					
      $attributes = array('class' => 'panel');
      echo form_open('payments/getuserpayments', $attributes);?>
						<div class="row">
							<div class="col-xs-6">
								<div class="input-group">
								<span class="input-group-addon">Date Start</span>
									<input type="text" name="DateStart" value="" class="form-control userreport" placeholder="From Date">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="input-group">
								<span class="input-group-addon">Date End</span>
									<input type="text" name="DateEnd" value="" class="form-control userreport" placeholder="To Date">
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
								</div>
							</div>
						</div>
					</form>
<?php } ?>
				</center>
			
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cc-mastercard"></i>User  Payments</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
										<tr>
                                        <th>Date</th>
                                        <th>Receipt #</th>
                                            <th>User ID</th>
                                            
                                            
                                            <th>Amount</th>
                                            <th>Dealer ID</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<tr class="odd gradeX">
													<td class="center"></td>
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
												</tr>
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
                                                <td><?php echo date("j-m-Y, g:i a", strtotime($row["DpDate"])); ?></td>
                                                <td><?php echo $row['DpRecipt']; ?></td>
													<td><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['DpUserName']; ?>"> <?php echo $row['DpUserName']; ?> </a></td>
													
													
													<td><?php echo $row['DpAmount']; ?></td>
													<td><?php echo $row['DpName']; ?></td>
													<td class="center"><a href="<?php echo base_url(); ?>payments/pedit/<?php echo $row['DpID']; ?>"> Update Payment&raquo;</a></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
							<?php //echo $pages; 
							 //echo $last_query;?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
		