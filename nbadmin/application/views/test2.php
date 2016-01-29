<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Payment Details</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('payments'); ?>">Payments</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Payment Details</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
				<center>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('welcome/test2', $attributes);?>

						<div class="row">
							<div class="col-xs-12">
								<div class="input-group">
								<span class="input-group-addon">Dealer Name</span>
									<select class="form-control" name="DlrID" >
									<option value="" selected="selected">Select Dealer</option>
										<?php $result = mysql_query("SELECT Dlrname FROM dealer where Active='1'");
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
									<i class="fa"></i> Dealer Active & Online Users Counting...
								</div>
							</div>
							<div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>Active Users</th>
                                            <th>Online Users</th>
                                            <th>Package</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$DealerID=$this->input->post('DlrID');
									if(!empty($DealerID)) {
											$query = $this->db->query("SELECT SUM(numrows) AS OnlineUsrs,SUM(aa) AS ActiveUsrs,package,creator FROM (
												SELECT COUNT(username) AS `numrows`,'0' AS aa, `package`,`creator` FROM (`radacct`) WHERE `creator` = '".$this->input->post('DlrID')."' AND `acctstoptime` IS NULL GROUP BY `package`
												UNION
												SELECT '0' AS numrows, COUNT(*) AS aa,`Package` AS package,`creator` FROM (`users`) WHERE `creator` = '".$this->input->post('DlrID')."' AND `Active` = 1 GROUP BY `Package`
												) ddd GROUP BY package");
									} else {
											$query = $this->db->query("SELECT SUM(numrows) AS OnlineUsrs,SUM(aa) AS ActiveUsrs,package,creator FROM (
												SELECT COUNT(username) AS `numrows`,'0' AS aa, `package`,`creator` FROM (`radacct`) WHERE `creator` = 'dreamnet1' AND `acctstoptime` IS NULL GROUP BY `package`
												UNION
												SELECT '0' AS numrows, COUNT(*) AS aa,`Package` AS package,`creator` FROM (`users`) WHERE `creator` = 'dreamnet1' AND `Active` = 1 GROUP BY `Package`
												) ddd GROUP BY package");
										}
											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>".$row->creator . "</td>";
												echo "<td>" . $row->ActiveUsrs."</td>";
												echo "<td>" . $row->OnlineUsrs."</td>";
												echo "<td>".$row->package . "</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query();
									?>
                                    </tbody>
                                </table>
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