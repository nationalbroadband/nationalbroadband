<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>User Status <small>Client status change page</small></h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
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
							<li class="breadcrumb-active">User Status</li>
						</ol>
					</div>
				</header>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
			<?php if(empty($post)){?>
							<h1>Requested User "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b></b><b><?php echo $this->uri->segment(3); ?></b> ... :( </code></p>
			<?php } else if ((strlen($post['CNIC']) < 13 && $post['Active']=="0")) {?>

					<div class="note note-danger note-shadow">
						<h4 class="block">User "<?php echo $post['Username'];?>" Information Missing/incorrect.</h4>
						<p>
							 It is to remind you that as per instructions of PTA, the details of your users (Name, Address, CNIC) should be complete and accurate. Therefore, you are advised to update all the details of the users in the billing otherwise you will be responsible for any legal action taken by the authority.
						</p>
						<h5 class="block"><a href="<?php echo base_url(); ?>clients/clientedit/<?php echo $post['Username']; ?>"><i class="fa fa-pencil"></i> Click here to update user info.</a></h5>
					</div>
			<?php } else { ?>

	<?php	if($post['Active']=="1"){ ?>

    <div class="alert " style="color:green">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Active!</strong> This User Is Active/Enable.

    </div>


	<?php	} else if($post['Active']=="0"){ ?>


    <div class="alert alert-danger">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong></strong>This User is In-Active<?php if ($post['UStatus']=="3") {?><strong>THIS USERS IS ON MONTHLY EXPIRY</strong><?php } ?>

    </div>
	
	<?php } else { ?>


    <div class="alert alert-error">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Warning!</strong> This User Is Blocked by Managment.

    </div>


	<?php	}  ?>
	
	<?php		if(($post['Active']=="1") OR ($post['Active']=="0")){
	
		if ($this->session->userdata('DlrBalance') >= $this->session->userdata('DlrLimit') && ($post['Active']=="0" OR $post['UStatus']=="3")) {?>

				<h1>Your Balance Limit Is Exceeded</h1>
	<?php } else if (($post['UStatus'] == "3" && $post['Active']=="1")) {?>
           
<div class="alert alert-danger">THIS USERS IS ON MONTHLY EXPIRY, Expire Date: <b><?php echo $post['UExpiry']; ?></b></div>
	   <?php if($success==1) {?>
					
					<div class="alert alert-success">This UserID Has Been Updated...!.</div>
					
		<?php 
				echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['Username']."'>";
			}?><div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Change User Status
							</div>
						</div>
				<div class="portlet-body form">
					   <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/clientStats/'.$post['Username'], $attributes);?>
		<div class="form-body">

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
<?php 
															$this->db->select('listname')->from('dealersrates')->where('listname',$post['pname'])->where('dealername',$this->session->userdata('username'));
																	$query=$this->db->get();
																	$usrpkginfo=$query->first_row('array');

														if (!empty($usrpkginfo['listname'])) { ?>
																	   <input type="text" name="UserPkg" value="<?php echo $post['pname']; ?>" class="form-control" placeholder="Client Package" readonly>
																	   <?php
														} else {?>
																<select class="form-control" name="UserPkg">
															<?php $query = $this->db->query("SELECT dealersrates.listname, pkg.pname FROM dealersrates INNER JOIN ( SELECT listname, pname FROM package LIMIT 0,7) AS pkg ON dealersrates.listname=pkg.listname WHERE dealersrates.dealername='" . $this->session->userdata('username') . "'");
																	foreach ($query->result() as $row) {
																		
																		if($post['pname'] == $row->listname){
																				echo "<option selected value=" . $row->listname . ">" . $row->pname . "</option>";
																			} else {
																				echo "<option value=" . $row->listname . ">" . $row->pname . "</option>";
																			}
																		}?>
																</select>
														<?php } ?>
														
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
										Updated...!
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."clients/client/".$post['Username']."'>";
								}?>
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Client Status Change Form
							</div>
						</div>
				<div class="portlet-body form">
			<?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/clientStats/'.$post['Username'], $attributes);?>
				<div class="form-body">
			<?php 	if($post['UStatus']=="3"){ ?>
										<input type="hidden" name="UserStutus" value="<?php echo $post['UStatus']; ?>" />
			<?php 	} else { ?>										
										<input type="hidden" name="UserStutusOld" value="<?php echo $post['UStatus']; ?>" />	
			<?php 	} ?>	
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
															<?php $query = $this->db->query("SELECT dealersrates.listname, pkg.pname FROM dealersrates INNER JOIN ( SELECT listname, pname FROM package LIMIT 0,7) AS pkg ON dealersrates.listname=pkg.listname WHERE dealersrates.dealername='" . $this->session->userdata('username') . "'");
																	foreach ($query->result() as $row) {
																		if($post['pname'] == $row->listname){
																				echo "<option selected value=" . $row->listname . ">" . $row->pname . "</option>";
																			} else {
																				echo "<option value=" . $row->listname . ">" . $row->pname . "</option>";
																			}
																		}?>
																</select>
													</div>
											  </div>
										<?php };  ?>
											</div>
										</div>
			<?php 	if($post['Active']=="0" && $post['UStatus']!="3"){ ?>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<div class="input-group">
														<span class="input-group-addon">Want to Change User Expiry Type?</span>
															<select class="form-control" name="UserStutus" required data-validation-required-message="field is required">
														<?php	$newArray = array ('0' => 'Change it to Daily Basis','3' => 'Change it to Monthly Basis','1' => 'Change it to Daily Basis with Expiry on 10');
																	foreach ($newArray as $k => $v) {
																if($post['UStatus'] == $k){
																	$v = str_replace("Change it to","Continue ID on a",$v);
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
			<?php 	} ?>
					<?php 	if ($post['UStatus'] == "1" && $post['Active']=="0") {?>
									<input type="hidden" name="AdvTax" value="14" />
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
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
										</form>
		<?php }
		}
	}?>
                                </div>
                               </div>
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