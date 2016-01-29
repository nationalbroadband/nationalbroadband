<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
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
							<li class="breadcrumb-active">Register User</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Add New User</div>
						</div>
			<div class="portlet-body form">
<?php 	 if ($this->session->userdata('DlrBalance') >= $this->session->userdata('DlrLimit')) { ?>
				<h1>Your Balance Limit Is Exceeded</h1>
<?php } else {?>
									<?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/addnew', $attributes);?>
	  						<div class="form-body">
                                     	<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />

										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
										?><!--
											<div class="alert alert-warning">
												Client Already Exits..<a class="alert-link" href="#">Alert Link</a>.
											</div>-->
										<?php } ?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="name" value="" class="form-control" placeholder="User Name" required>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">CNIC #</span>
														<input type="text" id="UserCNIC1" name="UserCNIC1" class="form-control"  placeholder="12345" required maxlength="5" data-validation-required-message="start digits is required" >
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer Name</span>
<?php if($this->session->userdata('DealerPerm')){?>
															<select class="form-control" name="UserCre" >
															<option value="">Select</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
															</select>
<?php } else { ?>
															<input type="text" name="UserCre" value="<?php echo $this->session->userdata('username');?>" class="form-control" placeholder="Dealer Name" readonly>
<?php }; ?>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Plan Expiry</span>
<?php 	if($this->session->userdata('DealerExpiry')==3){ ?>
															<input type="hidden" id="UserStat" name="UserStat" value="3" />
															<input type="text" value="Monthly Expiry" class="form-control" readonly>
<?php 	} else if($this->session->userdata('DealerExpiry')==1){ ?>
															<select class="form-control" name="UserStat">
																<option value="0">Never Expire</option>
																<option value="1">Expire On 10</option>
															</select>
<?php } else {?>
															<select class="form-control" name="UserStat">
																<option value="0">Never Expire</option>
																<option value="3">Monthly Expire</option>
															</select>
<?php } ?>
													</div>
											  </div>
											</div>
										</div>
                                        
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="" class="form-control" placeholder="Type User Email">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<label>Comments</label>
                                            <textarea name="comment" class="form-control" rows="3" ></textarea>
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
														<input type="text" name="mobile" value="" class="form-control" placeholder="Mobile #" required>
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Address</span>
                                            <input type="text" name="UserAddress" value="" class="form-control" placeholder="Address" required>
                                        </div>
                                        
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Package</span>
																<select class="form-control" name="UserPkg" >
																	<option value="">Select</option>
													<?php $query = $this->db->query("SELECT dealersrates.listname, pkg.pname FROM dealersrates INNER JOIN ( SELECT listname, pname FROM package LIMIT 0,7) AS pkg ON dealersrates.listname=pkg.listname WHERE dealersrates.dealername='" . $this->session->userdata('username') . "'");
															foreach ($query->result() as $row) {
																	if("D-Basic" == $row->pname){

																	} else if("D-Turbo" == $row->pname){

																	} else if("D-Extreme" == $row->pname){

																	} else {
																	echo "<option value=" . $row->listname . ">" . $row->pname . "</option>";
																	}
																}?>
																</select>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer ID</span>
<?php if($this->session->userdata('DealerPerm')){?>
															<select class="form-control" name="UserCre" >
															<option value="">Select</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
															</select>
<?php } else { ?>
															<input type="text" name="UserCre" value="<?php echo $this->session->userdata('username');?>" class="form-control" placeholder="Dealer ID" readonly>
<?php }; ?>
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Address</span>
                                            <input type="text" name="UserAddress" value="" class="form-control" placeholder="Address" required>
                                        </div>
										
                                        <div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" name="password" value="" class="form-control" placeholder="Password" required>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" name="password2" value="" class="form-control" placeholder="Confirm Password" required>
													</div>
											  </div>
											</div>
										</div>
                                        <button type="submit" class="btn btn-default">Add User</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
<?php }?>
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
	</div>
    <!-- /#page-wrapper -->