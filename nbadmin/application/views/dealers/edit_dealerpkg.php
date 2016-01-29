<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Dealers</h3>
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
							<a href="#">Dealer Panel</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>Edit Packages/Prices From Dealer Panel
								</div>
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
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon">Dealer Creation</span>
															<select class="form-control" name="DealerCre">
														<?php	$newArray = array ('0' => 'Disable', '1' => 'Enable');
																
																	foreach ($newArray as $k => $v) {
																		
																if($post['DSub'] == $k){
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
														<span class="input-group-addon">Dealer</span>
															<select class="form-control" name="UserCre" >
															<?php 
																$result = mysql_query("SELECT * FROM categories");
																	while ($cat = mysql_fetch_assoc($result)) {
															
																		if($post['Category_ID'] == $cat['id']){
																				//echo "<option selected value=" . $cat['id'] . ">" . $cat['ctitle'] . "</option>";
																			}else {
																				echo "<option value=" . $cat['id'] . ">" . $cat['ctitle'] . "</option>";
																			}
																	}
																	?>
																<?php
																	$query = $this->db->query("SELECT listname,pname FROM package");
																	foreach ($query->result() as $row) {
																	echo "<option value=\"" . $row->listname."\">" . $row->pname."</option>";
																	}
																?>
															</select>
													</div>
											  </div>
											</div>
										</div>
                                        <div class="form-group input-group">
											<label>Packages - Multiple Selection</label>
												<select multiple class="form-control" name="DlrPkg[]">
										<?php	$result = mysql_query("SELECT listname,pname FROM package");
													while ($cat = mysql_fetch_assoc($result)) {	?>
														<option value="<?php echo $cat['listname']; ?>"><?php echo $cat['pname']; ?></option>
										<?php }	?>
												</select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
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
		
				<select class="chzn-select medium-select select" name="UserPkg" id="UserPkg">
				<option value="no">Select Here</option>
					<?php
						$result = mysql_query("SELECT dealersrates.listname, package.pname FROM package INNER JOIN dealersrates ON dealersrates.listname=package.listname WHERE dealersrates.dealername='" . $_SESSION['user'] . "'");
							while ($cat = mysql_fetch_assoc($result)) {
					
					?>		
					<option value="<?php echo $cat['listname']; ?>"><?php echo $cat['pname']; ?></option>
					<?php 
					}
					?>
				</select>
		