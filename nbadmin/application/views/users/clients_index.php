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
								<a href="javascript:void(0)">Users</a>
							</li>
							<li class="breadcrumb-active">Users</li>
						</ol>
					</div>
				</header>



				
				<!-- END PAGE HEADER-->	
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('clients/index', $attributes);?>
						<div class="row">
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Username</span>
                                    <input type="text" name="username" class="form-control" placeholder="Username">
                                </div>
							</div>
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group input-group">
								<span class="input-group-addon">Package</span>
									<select class="form-control" name="UsrPkg">
									<option value="" selected="selected">Select Package</option>
											<?php $result = mysql_query("SELECT pname,listname FROM package");
													while ($cat = mysql_fetch_assoc($result)) {?>		
											<option value="<?php echo $cat['listname']; ?>"><?php echo $cat['pname']; ?></option>
											<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group input-group">
								<span class="input-group-addon">Status</span>
									<select class="form-control" name="UsrStat">
										<option value="0">Select Status</option>
										<option value="Active">Active</option>
										<option value="DeActive">DeActive</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group input-group">
								<span class="input-group-addon">Dealer</span>
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
									<button class="btn btn-default" type="submit">Search</button>
									</span>
								</div>
							</div>
						</div>
					</form>
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user"></i> Users</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
                                    <thead>
										<tr>
												<th>Name</th>
												<th>User ID</th>
                                                <th>Status</th>
                                                <th>Reg Date</th>
												<th>Package</th>
												<th>Address</th>
                                                
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(empty($posts)){?>
													<tr class="odd gradeX">
														<td><code> - No -</code></td>
														<td><code> - Data -</code></td>
														<td><code> - Found -</code></td>
														<td><code> - - -</code></td>
														<td><code> - Try -</code></td>
														<td><code> - Again -</code></td>
														<td><code> - - -</code></td>
													</tr>
											<?php } else { 
												foreach($posts as $row){?>
													<tr class="odd gradeX">
														<td><?php echo $row['FullName']; ?></td>
														<td><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['Username']; ?>"><?php echo $row['Username']; ?></a></td>
                                                        <td><?php 
																if ($row['Active']==1){
																	echo "Active";
																} else if($row['Active']==0){
																	echo "<code>DeActive</code>";
																} else {
																	echo "User is Blocked By Managment";
															} ?></td>
                                                        <td><?php echo $row['CDate']; ?></td>    
														
														<td><?php echo $row['Package']; ?></td>
														<td><?php echo $row['UsrAdd']; ?></td>
														
                                                        
														<td><center><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['Username']; ?>"><i class="fa fa-search"></i></a> | <a href="<?php echo base_url(); ?>clients/clientedit/<?php echo $row['Username']; ?>"><i class="fa fa-pencil"></i></a></center></td>
													</tr>
											<?php }
											}?>
									</tbody>
								</table>
								</div>
							</div>

            <!-- /.row -->
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>