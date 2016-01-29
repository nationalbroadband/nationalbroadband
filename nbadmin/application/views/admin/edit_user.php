<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Update Admin Information</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('users'); ?>">Users</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Update Admin Information</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Admin Details</div>
							</div>
							<div class="portlet-body">
								<?php if($success==1) {?>
									<div class="alert alert-success">
										This Information Has Been Updated...!
									</div>
								<?php }

      $attributes = array('role' => 'form');
      echo form_open('users/editdetails/'.$post['username'], $attributes);?>
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
											} ?>
	  
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<div class="input-group">
														<span class="input-group-addon">Name</span>
														<input type="text" name="name" value="<?php echo $post['FullName']; ?>" class="form-control" placeholder="Name">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="<?php echo $post['email']; ?>" class="form-control" placeholder="Email">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Role</span>
																<select class="form-control" name="idtype">
																<?php	$newArray = array ('user' => 'Support','author' => 'Manager','admin' => 'Admin');
																			foreach ($newArray as $k => $v) {
																				if($post['user_type'] == $k){
																		echo "<option selected value=" . $k . ">" . $v . "</option>";
																	} else {
																		echo "<option value=" . $k . ">" . $v . "</option>";
																		}
																}	?>
																</select>
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
        <!-- /#page-wrapper -->