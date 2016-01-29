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
								<a href="javascript:void(0)">Users</a>
							</li>
							<li class="breadcrumb-active">Add User</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user"></i>Add New User</div>
							</div>
							<div class="portlet-body">
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/addnew', $attributes);?>
                                     	<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
										<?php if (!empty($_GET['clients'])){?>
											<div class="alert alert-warning">
												Client Already Exits..<a class="alert-link" href="#">Alert Link</a>.
											</div>
										<?php } ?>
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
											} ?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
														<input type="text" name="name" value="" class="form-control" placeholder="Username">
													</div>
											  </div>
											  
											</div>
										</div>
                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">CNIC #</span>
											  <div class="row">
												 <div class="col-lg-4">
												  <input type="text" id="UserCNIC1" name="UserCNIC1" class="form-control"  placeholder="12345" required maxlength="5" data-validation-required-message="start digits is required" >
												 </div>
												  <div class="col-lg-6">
												   <input type="text" id="UserCNIC2" name="UserCNIC2" class="form-control"  placeholder="7654321" required maxlength="7" data-validation-required-message="mid digits is required" >
												 </div>
												  <div class="col-lg-2">
												   <input type="text" id="UserCNIC3" name="UserCNIC3" class="form-control"  placeholder="9" required maxlength="1" data-validation-required-message="Last digit is required" >
												 </div>
											  </div>
                                        </div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer Name</span>
															<select class="form-control" name="UserCre" >
																<?php $result = mysql_query("SELECT Dlrname FROM dealer");
																		while ($cat = mysql_fetch_assoc($result)) { ?>		
																<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
																<?php } ?>
															</select>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Plan Expiry</span>
															<select class="form-control" name="UserStat">
															<?php	$newArray = array ('0' => 'Daily', '1' => 'Expire on 10', '3' => 'Monthly');
																		
																		foreach ($newArray as $k => $v) {
																		echo "<option value=" . $k . ">" . $v . "</option>";
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
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="" class="form-control" placeholder="Email">
													</div>
											  </div>
											  <div class="col-xs-6">
													
											  </div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea name="comment" class="form-control" rows="3"></textarea>
                                        </div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
														<input type="text" name="phone" value="" class="form-control" placeholder="Phone #">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-phone"  ></i></span>
														<input type="text" name="mobile" value="" class="form-control" placeholder="Mobile #">
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Address</span>
                                            <input type="text" name="UserAddress" value="" class="form-control" placeholder="Address">
                                        </div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Package</span>
																<select class="form-control" name="UserPkg" >
																	<?php $result = mysql_query("SELECT * FROM package");
																			while ($cat = mysql_fetch_assoc($result)) {	?>		
																		<option value="<?php echo $cat['listname']; ?>"><?php echo $cat['pname']; ?></option>
																	<?php }	?>
																</select>
													</div>
											  </div>
											  <div class="col-xs-6">
												<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
														<input type="text" name="username" value="" class="form-control" placeholder="User’s ID">
													</div>	
											  </div>
											</div>
										</div>
                                        
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													
											  </div>
											  <div class="col-xs-6">
													
											  </div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
														<input type="password" name="password" value="" class="form-control" placeholder="Password">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
														<input type="password" name="password2" value="" class="form-control" placeholder="Confirm Password">
													</div>
											  </div>
											</div>
										</div>
                                        
                                        <button type="submit" class="btn btn-default">Add User</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
        </div>
        <!-- /#page-wrapper -->