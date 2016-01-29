<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				
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
								<a href="javascript:void(0)">Panel IDs</a>
							</li>
							<li class="breadcrumb-active">Send SMS</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->
							<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<i class=" font-red-sunglo"></i>
											<span class="caption-subject font-red-sunglo bold uppercase">Send SMS</span>
											<span class="caption-helper"></span>
										</div>
									</div>
<?php if(empty($response)){ ?>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
      <?php $attributes = array('class' => 'form-horizontal');
      echo form_open('users/sendmsg', $attributes);?>
                                     	<input type="hidden" name="Author" value="<?php echo $this->session->userdata('Admin');?>" />

										<?php if (!empty($errors)){
											echo "<pre>";
											print_r ($errors);
											echo "</pre>";
											} ?>
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Contact No</label>
													<div class="col-md-4">
														<input type="text" placeholder="Mobile #" name="ContactNo" class="form-control" required data-validation-required-message="Select Dealer Name">
														<span class="help-block">
														Example: 03452443866. </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Icon</label>
													<div class="col-md-4">
														<div class="input-icon">
															<i class="fa fa-user"></i>
														<select class="form-control" name="UsrDlr" required data-validation-required-message="Select Dealer Name">
															<option value="">Select</option>
														<?php	$query = $this->db->query("SELECT Dlrname FROM dealer");
																foreach ($query->result() as $row) {
																		echo "<option value=\"".$row->Dlrname."\">".$row->Dlrname."</option>";

																}
															?>
														</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Mask</label>
													<div class="col-md-4">
														<div class="input-icon">
															<i class="fa fa-envelope"></i>
															<select class="form-control" name="UserMask" required data-validation-required-message="Select Masking name">
																<option value="">Select</option>
																<option>Business</option>
																<option>BIZ1</option>
																<option>BIZ2</option>
																<option>BIZ3</option>
																<option>BIZ4</option>
															</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Message</label>
													<div class="col-md-4">
														<textarea name="Comment" class="form-control" rows="3" required data-validation-required-message="Type msg please"></textarea>
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn green" type="submit">Send</button>
														<button class="btn default" type="reset">Reset</button>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
<?php } else { ?>
									<div class="portlet-body">
										<h3></h3>
										<blockquote>
											<p>
												 <?php echo "Dear ".$this->input->post('UsrDlr'); ?>
											</p>
										</blockquote>
										<blockquote>
											<p>
												 <?php echo $this->input->post('Comment'); ?>
											</p>
											<small>From <cite title="Source Title"><?php echo $this->input->post('UserMask'); ?></cite></small>
										</blockquote>
										<div class="clearfix">
											<blockquote class="pull-right">
												<p>
													 Action Status: <?php echo $response; ?>
												</p>
												<small>Sent to <cite title="Source Title"><?php echo $this->input->post('ContactNo'); ?></cite></small>
											</blockquote>
										</div>
									</div>
<?php } ?>
								</div>
                                <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
        </div>
        <!-- /#page-wrapper -->
