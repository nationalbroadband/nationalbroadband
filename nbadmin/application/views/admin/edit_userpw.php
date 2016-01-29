<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Change Password</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('users'); ?>">Admin</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Change Password</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Change Password</div>
							</div>
							<div class="portlet-body">
								<?php if($success==1) {?>
									<div class="alert alert-success">
										This User Password Has Been Updated...!
									</div>
						<?php }

							  $attributes = array('role' => 'form');
							  echo form_open('users/PwChange/'.$postID, $attributes);

								if (!empty($errors)){
									echo "<pre>";
									print_r ($errors);
									echo "</pre>";
								} ?>
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
														<input type="text" name="name" value="<?php echo $postID; ?>" class="form-control" placeholder="Client Username" readonly>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
														<input type="password" name="password" value="" class="form-control" placeholder="New Password">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
														<input type="password" name="password2" value="" class="form-control" placeholder="Confirm New Password">
													</div>
											  </div>
											</div>
										</div>
                                        <button type="submit" class="btn btn-default">Change</button>
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
        <!-- /#page-wrapper -->