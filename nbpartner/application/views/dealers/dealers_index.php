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
								<a href="javascript:void(0)">Dealer</a>
							</li>
							<li class="breadcrumb-active">Dealer list</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
		<div class="row">
			<div class="col-sm-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
							<i class="fa fa-map-marker"></i>Dealers</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example"> 
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Mobile #</th>
                                            
                                            <th>Created by</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
										<?php if(!isset($posts)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><?php echo $row['DFullName']; ?></td>
													<td><?php echo $row['Dlrname']; ?></td>
                                                    <td><?php 
														if ($row['Active']==1){
															echo "Active";
														} else if($row['Active']==0){
															echo "<code>DeActive</code>";
														} else {
															echo "User is Blocked By Managment";
														} ?>
													</td>
													<td><?php echo $row['DMobile']; ?></td>
													
													<td><?php echo $row['creator']; ?></td>
													<td><center><a href="<?php echo base_url(); ?>dealers/dealer/<?php echo $row['Dlrname']; ?>"><i class="fa fa-search"></i></a> | <a href="<?php echo base_url(); ?>dealers/dealeredit/<?php echo $row['Dlrname']; ?>"><i class="fa fa-pencil"></i></a></center></td>
												</tr>
										<?php }
										}?>
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