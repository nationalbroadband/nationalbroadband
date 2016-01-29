<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Report Info</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('reports'); ?>">Reports</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Report Info</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
				<center>
			<?php $attributes = array('role' => 'form');
				echo form_open('reports/usersreport', $attributes);?>
					<?php 
						$dayf=date("Y-m-d", time() - 86400);
						$dayt=date("Y-m-d");
					?>
						<div class="row">
							<div class="col-xs-3">
								<div class="input-group">
									<span class="input-group-addon">User</span>
									<input type="text" name="username" value="" class="form-control" placeholder="Type UserName">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="input-group">
								<span class="input-group-addon">Start</span>
									<input type="text" name="DateStart" value="<?php echo $dayf; ?>" class="form-control" id="example1" placeholder="select date from">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="input-group">
								<span class="input-group-addon">END</span>
									<input type="text" name="DateEnd" value="<?php echo $dayt; ?>" class="form-control" id="example2" placeholder="select date to">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="input-group">
								<span class="input-group-addon">Dealer Name</span>
									<select class="form-control" name="UsrCre" >
									<option value="" selected="selected">Select Dealer</option>
										<?php $result = mysql_query("SELECT Dlrname FROM dealer");
												while ($cat = mysql_fetch_assoc($result)) {
										
										?>		
										<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
										<?php 
										}
										?>
									</select>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Go</button>
									</span>
								</div>
							</div>
						</div>
					</form>
				</center>
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Dealers Montly Units Report
								</div>
							</div>
							<div class="portlet-body">
								<div id="postlist">
									<?php
									$data['posts'] = $posts;
									$data['page_link'] = $page_link;
									$this->load->view('reports/usersreportlist', $data);
									?>
								</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->