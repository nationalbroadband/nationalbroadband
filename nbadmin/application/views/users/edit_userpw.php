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
							<a href="<?php echo base_url('users'); ?>">Users</a>
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
									<i class="fa"></i> Change Password
								</div>
							</div>
							<div class="portlet-body">
								<?php if($success==1) {?>
									<div class="alert alert-success">
										This Post Has Been Updated...!<a class="alert-link" href="#">Alert Link</a>.
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['Username']."'>";
								}?>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/clientChange/'.$post['Username'], $attributes);?>
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />
									<?php $result = mysql_query("SELECT nasipaddress,acctstoptime FROM radacct WHERE username='". $post['Username']. "' ORDER BY acctstarttime DESC LIMIT 0,1");
										while ($NasIP = mysql_fetch_assoc($result)) { ?>	
										<input type="hidden" name="NasIP" value="<?php echo $NasIP['nasipaddress']; ?>" />
									<?php } ?>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                            <input type="text" name="name" value="<?php echo $post['Username']; ?>" class="form-control" placeholder="Client Username" readonly>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Password</span></span>
                                            <input type="password" name="password" value="<?php //echo $post['Password']; ?>" class="form-control" placeholder="New Password">
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