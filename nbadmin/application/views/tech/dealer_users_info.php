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
								<a href="javascript:void(0)">Support Tools</a>
							</li>
							<li class="breadcrumb-active">Online Users by Dealer</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
				<center>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('welcome/test2', $attributes);?>

						<div class="row">
							<div class="col-xs-12">
								<div class="input-group">
								<span class="input-group-addon">Select Dealer</span>
									<select class="form-control" name="DlrID" >
									<option value="" selected="selected">Select Dealer</option>
									<?php $query = $this->db->query("SELECT Dlrname FROM dealer where Active='1'");
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<option value='".$row->Dlrname."'>".$row->Dlrname."</option>";
											}
										//echo $this->db->last_query();
									?>
									</select>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
								</div>
							</div>
						</div>
					</form>
				</center>
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Online Users </div>
							</div>
							<div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Select Dealer</th>
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
												SELECT COUNT(username) AS `numrows`,'0' AS aa, `package`,`creator` FROM (`radacct`) WHERE `creator` = 'dadu' AND `acctstoptime` IS NULL GROUP BY `package`
												UNION
												SELECT '0' AS numrows, COUNT(*) AS aa,`Package` AS package,`creator` FROM (`users`) WHERE `creator` = 'dadu' AND `Active` = 1 GROUP BY `Package`
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
