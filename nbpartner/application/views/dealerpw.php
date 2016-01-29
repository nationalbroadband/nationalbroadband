<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Update Password...<small>fill the form to change your password</small></h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Home</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Settings</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Update Password</a>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-key"></i>Password Change Form
							</div>
						</div>
						<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested Dealer "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>Error: </b> ID <b><?php echo $this->uri->segment(3); ?></b></code></p>
			<?php } else { ?>
								<?php if($success==1) {?>
									<div class="">
										Updated...!
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."welcome/profile'>";
								}?>
			<?php 
      $attributes = array('role' => 'form');
      echo form_open('welcome/password', $attributes);?>
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Email</span>
                                            <input type="text" name="DlrID" value="<?php echo $post['Dlrname']; ?>" autocomplete="off" class="form-control" placeholder="Client Username" readonly>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="password" name="password" value="" class="form-control" autocomplete="off" placeholder="Contact Password">
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
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