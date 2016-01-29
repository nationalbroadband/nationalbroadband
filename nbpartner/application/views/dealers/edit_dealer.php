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
							<li class="breadcrumb-active">Update Dealer Information</li>
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
								<i class="fa fa-map-marker"></i> Dealer Details
							</div>
						</div>
			<div class="portlet-body form">
			<?php if(empty($post)){?>
							<h1>Requested Dealer "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>Error: </b> ID <b><?php echo $this->uri->segment(3); ?></b></code></p>
			<?php } else { ?>
								<?php if($success==1) {?>
									<div class="alert alert-success">
										Updated...!
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."dealers/dealer/".$post['Dlrname']."'>";
								}?>
                                    <?php 
      $attributes = array('role' => 'form');
      echo form_open('dealers/dealeredit/'.$post['Dlrname'], $attributes);?>
	  						<div class="form-body">
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="name" value="<?php echo $post['DFullName']; ?>" class="form-control" placeholder="Dealer Name">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
														<input type="text" name="ShortID" value="<?php echo $post['ShrtID']; ?>" class="form-control" placeholder="Dealer ID">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													
                                                    <div class="input-group">
														<span class="input-group-addon">CNIC #</span>
														<input type="text" name="DlrCNIC" value="<?php echo $post['DCNIC']; ?>" class="form-control" placeholder="CNIC #">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-phone"  ></i></span>
														<input type="text" name="mobile" value="<?php echo $post['DMobile']; ?>" class="form-control" placeholder="Mobile #">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-mobile"></span></span>
														<input type="text" name="phone" value="<?php echo $post['DPhone']; ?>" class="form-control" placeholder="Phone #">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="<?php echo $post['DEmail']; ?>" class="form-control" placeholder="Email">
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Address</span>
                                            <input type="text" name="DAddress" value="<?php echo $post['DlrAdd']; ?>" class="form-control" placeholder="Address">
                                        </div>
                                        <button type="submit" class="btn btn-default">Update</button>
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