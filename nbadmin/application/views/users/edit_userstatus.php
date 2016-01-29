<?php if($this->session->userdata('user_type')=="user"){ ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Register User</h3>
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
							<a href="#">User Status</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>User Status Change Form
								</div>
							</div>
							<div class="portlet-body">
									    <div class="alert alert-error">
											<a href="#" class="close" data-dismiss="alert">&times;</a>

											<strong>Bhai Jaan!</strong> Dealer Sy Kahoo k APny Panel sy Status Change karin.
										</div>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php } else { ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Status Change</h3>
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
							<a href="#">Status Change</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>Client Status Change Form
								</div>
							</div>
							<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested User "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>PANGA: </b> bhai koi masla hay.. check karo yeh ID <b><?php echo $this->uri->segment(3); ?></b> ... :( </code></p>
			<?php } else { ?>

	<?php	if($post['Active']=="1"){ ?>

    <div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong></strong>This User is In-Active.

    </div>


	<?php	} else if($post['Active']=="0"){ ?>


    <div class="alert alert-warning">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong></strong> This User is In-Active.<?php if ($post['UStatus']=="3") {?><strong>THIS USERS IS ON MONTHLY EXPIRY</strong><?php } ?>

    </div>
	
	<?php } else { ?>


    <div class="alert alert-error">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Warning!</strong> This User Is Blocked by Managment.

    </div>


	<?php	}  ?>
	
	<?php if(($post['Active']=="1") OR ($post['Active']=="0")){
	
			if (($post['UStatus'] == "3" && $post['Active']=="1")) {?>
           
<div class="alert alert-warning">THIS USERS IS ON MONTHLY EXPIRY, Expire Date: <b><?php echo $post['UExpiry']; ?></b></div>
	   <?php if($success==1) {?>
					
					<div class="alert alert-success">This UserID Has Been Updated...!.</div>
					
		<?php 
				echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['Username']."'>";
			}?>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/clientStats/'.$post['Username'], $attributes);?>
							<input id="UserID" type="hidden" name="UserID" value="<?php echo $post['Username']; ?>" />
							<input type="hidden" name="UserCre" value="<?php echo $post['creator']; ?>" />
							<input type="hidden" name="UserStutus" value="<?php echo $post['UStatus']; ?>" />
							<input type="hidden" name="UserExpiry" value="<?php echo $post['UExpiry']; ?>" />
				
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="Username" value="<?php echo $post['Username']; ?>" class="form-control" placeholder="Client Username" readonly>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Package</span>
														<input type="text" name="UserPkg" value="<?php echo $post['Package']; ?>" class="form-control" placeholder="Client Package" readonly>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
                                            <label>Comments</label>
                                            <textarea rows="3" name="UserCmt" class="form-control"><?php echo $post['Comment']; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
						</form>

	<?php } else {
					if($success==1) {?>
									<div class="alert alert-success">
										This Post Has Been Updated...!<a class="alert-link" href="#">Alert Link</a>.
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['Username']."'>";
								}?>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/clientStats/'.$post['Username'], $attributes);?>
										<input type="hidden" name="UserStutus" value="<?php echo $post['UStatus']; ?>" />	
										<input type="hidden" name="UserCre" value="<?php echo $post['creator']; ?>" />
										<input type="hidden" name="UserExpiry" value="<?php echo $post['UExpiry']; ?>" />
							
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="Username" value="<?php echo $post['Username']; ?>" class="form-control" placeholder="Client Username" readonly>
													</div>
											  </div>
									<?php 	if($post['Active']=="1"){ ?>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Status</span>
															<select class="form-control" name="UserActive">
															<?php	$newArray = array ('0' => 'Disable', '1' => 'Enable');
																	
																		foreach ($newArray as $k => $v) {
																			
																	if($post['Active'] == $k){
																		echo "<option selected value=" . $k . ">" . $v . "</option>";
																	}else {
																		echo "<option value=" . $k . ">" . $v . "</option>";
																	}
																}	?>
															</select>
													</div>
											  </div>
										<?php } else {  ?>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Package</span>
																<select class="form-control" name="UserPkg" >
																	<?php $result = mysql_query("SELECT listname, pname FROM package");
																			while ($cat = mysql_fetch_assoc($result)) {

																			if($post['pname'] == $cat['pname']){
																				echo "<option selected value=" . $cat['listname'] . ">" . $cat['pname'] . "</option>";
																			}else {
																				echo "<option value=" . $cat['listname'] . ">" . $cat['pname'] . "</option>";
																			}
																		}	?>
																</select>
													</div>
											  </div>
										<?php };  ?>
											</div>
										</div>
					<?php 	if ($post['UStatus'] == "1" && $post['Active']=="0") {?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Recipt#</span>
														<input type="text" name="UsrRecipt" value="" class="form-control" placeholder="Client Username">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Amount</span>
														<input type="text" name="UsrAmt" value="" class="form-control" placeholder="Client Package">
													</div>
											  </div>
											</div>
										</div>
									<?php };  ?>
										<div class="form-group">
                                            <label>Comments</label>
                                            <textarea rows="3" name="UserCmt" class="form-control"><?php echo $post['Comment']; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Change</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
										</form>
		<?php }
		}
	}?>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php } ?>