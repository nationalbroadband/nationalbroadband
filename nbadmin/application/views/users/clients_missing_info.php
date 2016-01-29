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
							<li class="breadcrumb-active">Users With Missing Info.</li>
						</ol>
					</div>
				</header>

				
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-users"></i> Users Without CNIC</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
                                    <thead>
										<tr>
												<th>Name</th>
												<th>User ID</th>
												<th>Package</th>
												<th>Address</th>
                                                <th>Dealer Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

									<?php
											$query = $this->db->query("SELECT Username,FullName,creator,Package,UsrAdd,CNIC FROM users WHERE CNIC = '' AND Active='1'");

											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->FullName."</td>";
												
												echo "<td>".$row->creator . "</td>";
												echo "<td>".$row->Package . "</td>";
												echo "<td>".$row->UsrAdd . "</td>";
												echo "<td><a href=\"" . base_url()."clients/client/" . $row->Username."\">" . $row->Username."</a></td>";
												echo "<td><a href=\"" . base_url()."clients/clientStats/" . $row->Username."\">De-Activate</a></td>";
												echo "</tr>";
											}
									?>
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