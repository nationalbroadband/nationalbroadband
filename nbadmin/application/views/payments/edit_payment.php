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
							<a href="#">Accounts</a>
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
									<i class="fa"></i> Client User Details Form
								</div>
							</div>
							<div class="portlet-body">
								<?php if($success==1) {?>
									<div class="alert alert-success">
										This Post Has Been Updated...!<a class="alert-link" href="#">Alert Link</a>.
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."dealers/dealer/".$post['customer']."'>";
								}?>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('payments/pedit/'.$post['id'], $attributes);?>
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
														<input type="text" name="name" value="<?php echo $post['customer']; ?>" class="form-control" placeholder="Type User Full Name" readonly>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Recept #</span>
														<input type="text" name="ReceptNo" value="<?php echo $post['Receipt']; ?>" class="form-control" placeholder="Receipt #">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<div class="input-group">
														<span class="input-group-addon">Amount</span>
														<input type="text" name="BAmount" value="<?php echo $post['Amount']; ?>" class="form-control" placeholder="Type Amount">
													</div>
												</div>
												<div class="col-xs-4">
													<div class="input-group">
													<span class="input-group-addon">Paid</span>
														<input type="text" name="PaidAmt" value="<?php echo $post['paid']; ?>" class="form-control" placeholder="1, 2 or more?">
													</div>
												</div>
												<div class="col-xs-4">
													<div class="input-group">
														<span class="input-group-addon">Discount</span>
														<input type="text" name="Discount" value="<?php echo $post['Discount']; ?>" class="form-control" placeholder="MB, Data ?">
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
																			
																	if($post['PaymentType'] == $k){
																		echo "<option selected value=" . $k . ">" . $v . "</option>";
																	}else {
																		echo "<option value=" . $k . ">" . $v . "</option>";
																	}
																}	?>
															</select>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Cheque #</span>
														<input type="text" name="ChequeNo" value="<?php echo $post['ChequeNo']; ?>" class="form-control" placeholder="ChequeNo #">
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="comment" class="form-control" rows="3"><?php echo $post['Description']; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
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