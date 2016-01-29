<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div id="content-wrapper">

		<div class="page-header">
			<h1>Dealers</h1>
		</div> <!-- / .page-header -->

		<div class="row">
			<div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Packages/Prices From Dealer Panel
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<?php if($success==1) {?>
									<div class="alert alert-success">
										Updated...!
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."dealers/dealer/".$post['Dlrname']."'>";
								}?>
			<?php 
      $attributes = array('role' => 'form');
      echo form_open('dealers/dealerChange/'.$post['Dlrname'], $attributes);?>
		<!--<form role="form" action="<?php echo base_url(); ?>dealers/dealerChange/<?php echo $post['Dlrname']; ?>" method="post"> -->
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
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
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
		