<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(!empty($post)){
$UserID=$post['Username'];
$Amount="";
$Receipt=$post['creator']."-001";
} else {
$UserID="";
$Amount="";
$Receipt="";
}?>

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
							<li class="breadcrumb-active">Make User Payment</li>
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
								<i class="fa fa-cc-mastercard"></i>Make User Payment
							</div>
						</div>
			<div class="portlet-body form">
<?php $attributes = array('role' => 'form');
      echo form_open('payments/addnew', $attributes);?>
                                        <input type="hidden" name="AdvTax" value="14" />
                                        <input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
										} ?>
	  						<div class="form-body">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer ID</span>
<?php if($this->session->userdata('DealerPerm')){?>
															<select class="form-control" name="Dealer">
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
															</select>
<?php } else {?>
																<input type="text" name="Dealer" value="<?php echo $this->session->userdata('username');?>" class="form-control" placeholder="Type Dealer ID" readonly>
<?php }?>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">User ID</span>
														<input type="text" name="UserName" value="<?php echo $UserID; ?>" class="form-control" placeholder="User ID">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
                                              <div class="input-group">
														<span class="input-group-addon">Recept #</span>
														<input type="text" name="ReceptNo" value="<?php echo $Receipt; ?>" class="form-control" placeholder="Receipt #">
													</div>
													
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Amount</span>
														<input type="text" name="BAmount" value="<?php echo $Amount; ?>" class="form-control" placeholder="Amount">
													</div>
											  </div>
											</div>
										</div>
                                        <button type="submit" class="btn btn-default">Add</button>
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