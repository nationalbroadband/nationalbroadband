		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				
								<header id="topbar" class="alt">
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
							<li class="breadcrumb-active">Admins</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	

						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-key"></i> Admins
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
                                    <thead>
										<tr>
												<th>Admin ID</th>
												<th>Full Name</th>
												<th>Email</th>
												<th>Registration Date</th>
												<th>Role</th>
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
														<td><?php echo $row['username']; ?></td>
														<td><?php echo $row['FullName']; ?></td>
														<td><?php echo $row['email']; ?></td>
														<td><?php echo $row['RegDate']; ?></td>
														<td><?php echo $row['user_type']; ?></td>
														<td><center><a href="<?php echo base_url(); ?>users/PwChange/<?php echo $row['username']; ?>"><i class="fa fa-key"></i></a> | <a href="<?php echo base_url(); ?>users/editdetails/<?php echo $row['username']; ?>"><i class="fa fa-pencil"></i></a></center></td>
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