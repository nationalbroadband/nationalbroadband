<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Update Dealer</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('dealers'); ?>">Dealers</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Edit Dealer</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-users"></i>Dealer Details</div>
							</div>
							<div class="portlet-body">
								<?php if($success==1) {?>
									<div class="alert alert-success">
										This Post Has Been Updated...!<a class="alert-link" href="#">Alert Link</a>.
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."dealers/dealer/".$post['Dlrname']."'>";
								}?>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('dealers/dealeredit/'.$post['Dlrname'], $attributes);?>

										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
														<input type="text" name="name" value="<?php echo $post['DFullName']; ?>" class="form-control" placeholder="Dealer Name">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
														<input type="text" name="ShortID" value="<?php echo $post['ShrtID']; ?>" class="form-control" placeholder="Dealer Name">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
														<input type="text" name="phone" value="<?php echo $post['DPhone']; ?>" class="form-control" placeholder="Phone #">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-phone"  ></i></span>
														<input type="text" name="mobile" value="<?php echo $post['DMobile']; ?>" class="form-control" placeholder="Mobile #">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="<?php echo $post['DEmail']; ?>" class="form-control" placeholder="Email">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">CNIC#</span>
														<input type="text" name="DlrCNIC" value="<?php echo $post['DCNIC']; ?>" class="form-control" placeholder="CNIC#">
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Address</span>
                                            <input type="text" name="DAddress" value="<?php echo $post['DlrAdd']; ?>" class="form-control" placeholder="Address">
                                        </div>
                                        <div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Credit Limit</span>
														<input type="text" name="BLimit" value="<?php echo $post['BalLimit']; ?>" class="form-control" placeholder="Amount in digits">
													</div>
											  </div>											  
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Expiry Plan</span>
															<select class="form-control" name="DlrExpiry">
														<?php	$newArray = array ('1' => 'Never Expire', '3' => 'Monthly Expire');
																
																	foreach ($newArray as $k => $v) {
																		
																if($post['DExpiry'] == $k){
																	echo "<option selected value=" . $k . ">" . $v . "</option>";
																}else {
																	echo "<option value=" . $k . ">" . $v . "</option>";
																}
															}	?>
															</select>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-picture"  ></i></span>
														<input type="text" name="logo" value="<?php echo $post['DLogo']; ?>" class="form-control" placeholder="Company Logo">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Allow Sub-Dealer Creation</span>
															<select class="form-control" name="DealerCre">
														<?php	$newArray = array ('0' => 'Disable', '1' => 'Enable');
																
																	foreach ($newArray as $k => $v) {
																		
																if($post['DSub'] == $k){
																	echo "<option selected value=" . $k . ">" . $v . "</option>";
																}else {
																	echo "<option value=" . $k . ">" . $v . "</option>";
																}
															}	?>
															</select>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer’s Manager</span>
																<select class="form-control" name="DlrMngr" >
																	<?php $result = mysql_query("SELECT creator FROM dealer group by creator asc");
																			while ($cat = mysql_fetch_assoc($result)) {

																			if($post['creator'] == $cat['creator']){
																				echo "<option selected value=" . $cat['creator'] . ">" . $cat['creator'] . "</option>";
																			}else {
																				echo "<option value=" . $cat['creator'] . ">" . $cat['creator'] . "</option>";
																			}
																		}	?>
																</select>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer’s Status</span>
															<select class="form-control" name="DealerStat">
														<?php	$newArray = array ('0' => 'NotActive', '1' => 'Active');
																
																	foreach ($newArray as $k => $v) {
																		
																if($post['Active'] == $k){
																	echo "<option selected value=" . $k . ">" . $v . "</option>";
																}else {
																	echo "<option value=" . $k . ">" . $v . "</option>";
																}
															}	?>
															</select>
													</div>
											  </div>
											</div>
										</div>
                                        
										
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<div class="input-group">
														<span class="input-group-addon">Comments</span>
														<input type="text" name="Comment" value="<?php echo $post['Remarks']; ?>" class="form-control" placeholder="Comments">
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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->