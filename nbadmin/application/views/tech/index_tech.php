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
							<li class="breadcrumb-active">Online Users by RAS</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
				<center>
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('welcome/test', $attributes);?>
					<?php 
						$dayf=date("Y-m-d", time() - 86400);
						$dayt=date("Y-m-d");
					?>
						<div class="row">
							<div class="col-xs-5">
								<div class="input-group">
								<span class="input-group-addon">RAS Address</span>
									<select class="form-control" name="RASIP" >
									<option value="" selected="selected">Select Address</option>
									<?php $query = $this->db->query("SELECT nasipaddress FROM radacct GROUP BY nasipaddress ORDER BY nasipaddress ASC");
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<option value='".$row->nasipaddress."'>".$row->nasipaddress."</option>";
											}
										//echo $this->db->last_query();
									?>
									</select>
								</div>
							</div>
							<div class="col-xs-5">
								<div class="input-group">
								<span class="input-group-addon">Vlan ID</span>
									<select class="form-control" name="VLAN" >
									<option value="" selected="selected">Select VLAN ID</option>
									<?php $query = $this->db->query("SELECT nasport FROM radacct GROUP BY nasport ORDER BY nasport ASC");
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;
												echo "<option value='".$row->nasport."'>".$row->nasport."</option>";
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
                                            <th>RAS Address</th>
                                            <th>VLAN ID</th>
                                            <th>Users Online</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$VLAN=$this->input->post('VLAN');
									$RASIP=$this->input->post('RASIP');
									if(!empty($VLAN)) {
											$query = $this->db->query("SELECT COUNT(username) AS total, nasport, nasipaddress FROM radacct WHERE acctstoptime IS NULL AND nasport='".$this->input->post('VLAN')."' GROUP BY nasport");
									} else if(!empty($VLAN) && !empty($RASIP)){
											$query = $this->db->query("SELECT COUNT(username) AS total, nasport, nasipaddress FROM radacct WHERE acctstoptime IS NULL AND nasport='".$this->input->post('VLAN')."' AND nasipaddress='".$this->input->post('VLAN')."' GROUP BY nasport");
									} else {
											$query = $this->db->query("SELECT COUNT(username) AS total, ' ' AS nasport, nasipaddress FROM radacct WHERE acctstoptime IS NULL GROUP BY nasipaddress");
										}
											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->nasipaddress."</td>";
												echo "<td>" . $row->nasport."</td>";
												echo "<td>".$row->total . " Users</td>";
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