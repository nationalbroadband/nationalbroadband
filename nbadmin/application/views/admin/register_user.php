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
								<a href="javascript:void(0)">Panel IDs</a>
							</li>
							<li class="breadcrumb-active">Add Application Admin</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>Admin Details</div>
							</div>
							<div class="portlet-body">
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('users/addnew', $attributes);?>
                                     	<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
											} ?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<div class="input-group">
														<span class="input-group-addon">Name</span>
														<input type="text" name="name" value="" class="form-control" placeholder="Name">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-user"  ></i></span>
														<input type="text" name="username" value="" class="form-control" placeholder="Admin ID">
													</div>
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
														<input type="password" name="password2" value="" class="form-control" placeholder="Confirm New Password">
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
													<div class="input-group">
														<span class="input-group-addon">Role</span>
																<select class="form-control" name="idtype">
																<?php	$newArray = array ('user' => 'Support','author' => 'Manager','admin' => 'Admin');
																			foreach ($newArray as $k => $v) {
																				echo "<option value=" . $k . ">" . $v . "</option>";

																			}	?>
																</select>
													</div>
											  </div>
											</div>
										</div>
                                        <button type="submit" class="btn btn-default">Add</button>
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