<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				
				<header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon">
                        <a href="#">
                            <span class="fa fa-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-active">
                        <a href="<?php echo base_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href="<?php echo base_url('clients'); ?>">Users</a>
                    </li>
                    <li class="breadcrumb-current-item">Edit User</li>
                </ol>
            </div> 
        </header>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Update User Information
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
      echo form_open('clients/clientedit/'.$post['Username'], $attributes);?>
										<input type="hidden" name="Author" value="<?=$this->session->userdata('Admin');?>" />
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
														<input type="text" name="name" value="<?php echo $post['FullName']; ?>" class="form-control" placeholder="User’s Name">
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">CNIC#</span>
														<input type="text" name="UserCNIC" value="<?php echo $post['CNIC']; ?>" class="form-control" placeholder="CNIC#">
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
												<div class="input-group">
														<span class="input-group-addon">Plan Expiry</span>
															<select class="form-control" name="UserStat">
															<?php	$newArray = array ('0' => 'Daily', '1' => 'Expire on 10', '3' => 'Monthly');
																	
																		foreach ($newArray as $k => $v) {
																			
																	if($post['UStatus'] == $k){
																		echo "<option selected value=" . $k . ">" . $v . "</option>";
																	}else {
																		echo "<option value=" . $k . ">" . $v . "</option>";
																	}
																}	?>
															</select>
													</div>	
											  </div>
											  <div class="col-xs-6">
												<div class="input-group">
														<span class="input-group-addon">Email</span>
														<input type="text" name="email" value="<?php echo $post['Email']; ?>" class="form-control" placeholder="Email">
													</div>	
											  </div>
											</div>
										</div>
                                        
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
												<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
														<input type="text" name="phone" value="<?php echo $post['Phone']; ?>" class="form-control" placeholder="Phone #">
													</div>	
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-phone"  ></i></span>
														<input type="text" name="mobile" value="<?php echo $post['Mobile']; ?>" class="form-control" placeholder="Mobile #">
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Address</span>
                                            <input type="text" name="UserAddress" value="<?php echo $post['UsrAdd']; ?>" class="form-control" placeholder="Address">
                                        </div>
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea name="comment" class="form-control" rows="3"><?php echo $post['Comment']; ?></textarea>
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