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
								<a href="javascript:void(0)">Dealer</a>
							</li>
							<li class="breadcrumb-active">Register Dealer</li>
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
								<i class="fa fa-map-marker"></i> Dealer Information
							</div>
						</div>
			<div class="portlet-body form">
<?php $attributes = array('role' => 'form');
      echo form_open('dealers/addnew', $attributes);?>
	  						<div class="form-body">
                                        <input type="hidden" name="UserCre" value="<?php echo $this->session->userdata('username');?>" />
										<input type="hidden" name="DealerCre" value="0" />
										<input type="hidden" name="Balance" value="0" />
										<input type="hidden" name="logo" value="images/logo.png" />
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
										} ?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="name" value="" class="form-control" placeholder="Dealer Name">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">CNIC</span>
														<input type="text" name="DlrCNIC" value="" class="form-control" placeholder="CNIC #">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="username" value="" class="form-control" placeholder="Dealer ID">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-user"  ></i></span>
														<input type="text" name="ShortID" value="" class="form-control" placeholder="Dealer Short ID">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-mobile"></span></span>
														<input type="text" name="phone" value="" class="form-control" placeholder="Phone #">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-phone"  ></i></span>
														<input type="text" name="mobile" value="" class="form-control" placeholder="Mobile #">
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
													<label>Address</label>
											<textarea type="text" name="DAddress" class="form-control" rows="3"></textarea>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Balance Limit</span>
														<input type="text" name="BLimit" value="0" class="form-control" placeholder="Amount in digits" readonly>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" name="password" value="" class="form-control" id="password" placeholder="Password">
													</div>
											  </div>
											</div>
										</div>
                                        
                                        
                                        
										<div class="form-group">
                                        <div class="col-xs-6">
                                        <div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" name="password2" value="" class="form-control" id="Cpassword" placeholder="Confirm New Password">
													</div>
                                        </div>
                                        <div class="col-xs-6">
											
                                          </div>          
										</div>
                                        <button type="submit" class="btn btn-default" on>Add</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                   <!-- <div class="form-group" id="dealerPasswordError"   style="color:#F00; display:none;">
                                         <div class="col-xs-12">
                                          <div>
                                          Password Not Matched!
                                          <p>&nbsp;</p>
                                          </div>
                                         </div>
                                        </div>-->
                                </div>
                                <!-- /.col-lg-6 (nested) -->
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