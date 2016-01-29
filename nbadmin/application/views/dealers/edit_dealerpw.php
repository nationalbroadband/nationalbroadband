<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Change Dealer Password</h3>
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
							<a href="#">Password Change</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>New Password</div>
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
      echo form_open('dealers/dealerChange/'.$post['Dlrname'], $attributes);?>
										<input type="hidden" name="Author" value="<?=$this->session->userdata('Admin');?>" />
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Dealer Name</span>
                                            <input type="text" name="name" value="<?php echo $post['Dlrname']; ?>" class="form-control" placeholder="Client Username" readonly>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                            <input type="password" name="password" value="" class="form-control" placeholder="New Password">
                                        </div>
                                        <button type="submit" class="btn btn-default">Change</button>
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