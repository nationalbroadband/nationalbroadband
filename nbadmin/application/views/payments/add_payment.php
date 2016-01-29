<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if($this->input->get('Amount')){
	$Amount=$this->input->get('Amount');
} else {
	$Amount="";
}?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				
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
									<i class="fa"></i>Payment Details</div>
							</div>
							<div class="portlet-body">
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('payments/addnew', $attributes);?>
                                        <input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
                                        <input type="hidden" name="Dlrname" value="<?php if(!empty($post['Dlrname'])) { echo $post['Dlrname']; } else { echo "0"; } ?>" />
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
										} ?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer Name</span>
														<?php if(!empty($post['Dlrname'])) {?>
														<input type="hidden" name="Dealer" value="<?php echo $post['Dlrname']; ?>" />
															<select class="form-control" name="Dealer" disabled>
														<?php } else {?>
															<select class="form-control" name="Dealer">
														<?php }?>
																<?php $result = mysql_query("SELECT Dlrname FROM dealer");
																		while ($cat = mysql_fetch_assoc($result)) { 
																	if($post['Dlrname'] == $cat['Dlrname']){
																		echo "<option selected value=" . $cat['Dlrname'] . ">" . $cat['Dlrname'] . "</option>";
																	}else {
																		echo "<option value=" . $cat['Dlrname'] . ">" . $cat['Dlrname'] . "</option>";
																	}
																} ?>
															</select>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Recept No</span>
														<input type="text" name="ReceptNo" value="<?php if(!empty($post['Receipt'])) { echo $post['Receipt']; } ?>" class="form-control" placeholder="Receipt No.">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<div class="input-group">
														<span class="input-group-addon">Amount</span>
														<input type="text" name="BAmount" value="<?php if(!empty($post['DlrBalance'])) { echo $post['DlrBalance']; } ?>" class="form-control" placeholder="Amount">
													</div>
												</div>
												<div class="col-xs-4">
													<div class="input-group">
													<span class="input-group-addon">Paid</span>
														<input type="text" name="PaidAmt" value="<?php echo $Amount; ?>" class="form-control" placeholder="Paid Amount">
													</div>
												</div>
												<div class="col-xs-4">
													<div class="input-group">
														<span class="input-group-addon">Discount (if any)</span>
														<input type="text" name="Discount" value="" class="form-control" placeholder="Discount (if any)">
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Payment Method</span>
															<select class="form-control" name="PaymentType">
															<?php	$newArray = array ('Cash' => 'Cash','Cheque' => 'Cheque', 'Online' => 'Online');
																		foreach ($newArray as $k => $v) {
																		echo "<option value=" . $k . ">" . $v . "</option>";
																}	?>
															</select>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Cheque No.</span>
														<input type="text" name="ChequeNo" value="" class="form-control" placeholder="Cheque Number">
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea name="comment" class="form-control" rows="3"><?php if(!empty($post['Balance'])) { echo "Payment Balance: ".$post['Balance']; } ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Change</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->