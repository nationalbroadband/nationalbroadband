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
								<a href="javascript:void(0)">Accounts</a>
							</li>
							<li class="breadcrumb-active">Dealer's Limit</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> List of Dealers having Increased Balance Limit</div>
							</div>
							<div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>Dealer Limit</th>
                                            <th>Dealer Balance</th>
                                            <th>Contact #</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
											$query = $this->db->query("Select Dlrname,DPhone,DMobile,BalLimit,Balance FROM dealer WHERE Active='1' AND BalLimit <= Balance ORDER BY Balance DESC");

											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->Dlrname."</td>";
												
												echo "<td>".$row->BalLimit . "</td>";
												echo "<td>".$row->Balance . "</td>";
												echo "<td>" . $row->DPhone." - " . $row->DMobile."</td>";
												echo "</tr>";
											}
									?>
                                    </tbody>
                                </table>
								<?php //echo $this->db->last_query(); ?>
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