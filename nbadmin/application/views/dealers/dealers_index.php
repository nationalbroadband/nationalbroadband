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
								<a href="javascript:void(0)">Dealers</a>
							</li>
							<li class="breadcrumb-active">Dealer List</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-map-marker"></i>Dealers
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
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
										<?php if($this->session->userdata('user_type')=="user"){ ?>
													<td><center><a href="<?php echo base_url(); ?>dealers/dealer/<?php echo $row['Dlrname']; ?>"><i class="fa fa-search"></i></a></center></td>
										<?php } else {?>
													<td><center><a href="<?php echo base_url(); ?>dealers/dealer/<?php echo $row['Dlrname']; ?>"><i class="fa fa-search"></i></a> | <a href="<?php echo base_url(); ?>dealers/dealeredit/<?php echo $row['Dlrname']; ?>"><i class="fa fa-pencil"></i></a></center></td>
										<?php }?>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
