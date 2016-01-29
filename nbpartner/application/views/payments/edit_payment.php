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
							<li class="breadcrumb-active">Edit Payment</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Update Payment
							</div>
						</div>
			<div class="portlet-body form">
					<?php if($success==1) {?>
									<div class="alert alert-success">
										Updated...!
									</div>
					<?php echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['DpUserName']."'>"; } ?>
								<?php 
      $attributes = array('role' => 'form');
      echo form_open('payments/pedit/'.$post['DpID'], $attributes);?>
	  						<div class="form-body">
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer ID</span>
														<input type="text" name="Dealer" value="<?php echo $post['DpName']; ?>" class="form-control" placeholder="Type Dealer ID" readonly>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Date</span>
														<input type="text" name="UserPaid" value="<?php echo $post['DpDate']; ?>" class="form-control" placeholder="Type User ID">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
                                              <div class="input-group">
														<span class="input-group-addon">Recept #</span>
														<input type="text" name="ReceptNo" value="<?php echo $post['DpRecipt']; ?>" class="form-control" placeholder="Receipt #">
													</div>
													
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Amount</span>
														<input type="text" name="BAmount" value="<?php echo $post['DpAmount']; ?>" class="form-control" placeholder="Type Amount">
													</div>
											  </div>
											</div>
										</div>
                                        <button type="submit" class="btn btn-default">Update</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->