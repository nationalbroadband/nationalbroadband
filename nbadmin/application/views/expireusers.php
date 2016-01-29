<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Expired Users</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Expired Users</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('welcome/expireusers', $attributes);?>
						<div class="row">
							<div class="col-xs-6">
								<div class="input-group">
									<span class="input-group-addon">Date</span>
									<input type="text" name="before" value="" class="form-control" id="example1" placeholder="select date from">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
										<span class="input-group-btn">
										<button class="btn btn-default" type="submit">Go</button>
									</span>
								</div>
							</div>
						</div>
					</form>
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Expired Users List
								</div>
							</div>
							<div class="portlet-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Expire Date</th>
                                            <th>Package</th>
                                            <th>Status</th>
                                            <th>Manager ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$today = date("Y-m-d"); // 2015-03-16
										$last_day = date("Y-m-d", strtotime("$today -1 day"));
									$Before=$this->input->post('before');
									if(!empty($Before)){
											$query = $this->db->query("SELECT Username,Package,Usr_DeActv,UStatus,creator FROM users WHERE DATE(Usr_DeActv) BETWEEN '".$Before."'  AND DATE(NOW())");
									} else {
											$query = $this->db->query("SELECT Username,Package,Usr_DeActv,UStatus,creator FROM users WHERE DATE(Usr_DeActv) BETWEEN (DATE(NOW()) - INTERVAL 1 DAY) AND DATE(NOW())");
										}
											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td><a href='";
												echo base_url();
												echo "clients/client/";
												echo $row->Username;
												echo "'>" . $row->Username."</a></td>";
												echo "<td>" . $row->Usr_DeActv."</td>";
												echo "<td>".$row->Package . "</td>";
												echo "<td>".$row->UStatus . "</td>";
												echo "<td>".$row->creator . "</td>";
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