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
								<a href="javascript:void(0)">Users</a>
							</li>
							<li class="breadcrumb-active">Edit User</li>
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
								<i class="fa fa-gift"></i> Update User Information
							</div>
						</div>
			<div class="portlet-body form">
			<?php if(empty($post)){?>
							<h1>Requested User "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>Error: </b> ID <b><?php echo $this->uri->segment(3); ?></b></code></p>
			<?php } else { ?>
								<?php if($success==1) {?>
									<div class="alert alert-success">
										Updated...!
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['Username']."'>";
								}?>
                                    <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/clientedit/'.$post['Username'], $attributes);?>
	  						<div class="form-body">
										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
										}
										?>
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="name" value="<?php echo $post['FullName']; ?>" class="form-control" placeholder="User Name">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">CNIC #</span>
														<input type="text" name="UserCNIC" value="<?php echo $post['CNIC']; ?>" class="form-control" placeholder="Type User CNIC">
														<span class="input-group-addon">Like,12345-1234567-0</span>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="<?php echo $post['Email']; ?>" class="form-control" placeholder="Type User Email">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="form-group">
                                            <label>Comments</label>
                                            <textarea name="comment" class="form-control" rows="3"><?php ($post['Comment']!='') ? $post['Comment'] : ''; ?></textarea>
                                        </div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-mobile"></span></span>
														<input type="text" name="phone" value="<?php echo $post['Phone']; ?>" class="form-control" placeholder="Phone #">
													</div>
											  </div>
                                              <div class="col-xs-6">
                                              <div class="input-group">
														<span class="input-group-addon"><i class="fa fa-phone"  ></i></span>
														<input type="text" name="mobile" value="<?php echo $post['Mobile']; ?>" class="form-control" placeholder="Cell #">
													</div>
                                              </div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="UserAddress" class="form-control" rows="3"><?php echo $post['UsrAdd']; ?></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default">Change</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
			<?php } ?>
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