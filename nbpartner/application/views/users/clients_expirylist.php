<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			
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
							<li class="breadcrumb-active">Users Expiring</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-sm-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>Users  being expired this week</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>User ID</th>
                                            <th>Package</th>
                                            <th>Expiry date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
								<?php	if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT Username,FullName,Package,UExpiry FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator WHERE users.Active='1' AND dealer.creator='".$this->session->userdata('username')."' AND users.UStatus='3' AND users.UExpiry BETWEEN CURRENT_DATE AND (CURRENT_DATE + INTERVAL 7 DAY)");
										} else {
											$query = $this->db->query("SELECT Username,FullName,Package,UExpiry FROM users WHERE creator='".$this->session->userdata('username')."' AND UStatus='3' AND Active = '1' AND UExpiry BETWEEN CURRENT_DATE AND (CURRENT_DATE + INTERVAL 7 DAY)");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<tr>";
												echo "<td>" . $count."</td>";
												echo "<td>" . $row->FullName."</td>";
												echo "<td>" . $row->Username."</td>";
												echo "<td>" . $row->Package."</td>";
												echo "<td>" . $row->UExpiry."</td>";
												echo "<td><a href=\"".base_url()."clients/clientStats/" . $row->Username . "\">Recharge</a></td>";
												echo "</tr>";
											}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive
                            <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                            </div> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->