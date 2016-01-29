<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				
				<header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    
                    <li class="breadcrumb-active">
                        <a href="<?php echo base_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href="<?php echo base_url('welcome'); ?>">Support Tools</a>
                    </li>
                    <li class="breadcrumb-current-item">Payment Details</li>
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
										<?php $result = mysql_query("SELECT nasipaddress FROM radacct GROUP BY nasipaddress ORDER BY nasipaddress ASC");
												while ($cat = mysql_fetch_assoc($result)) {
										
										?>		
										<option value="<?php echo $cat['nasipaddress']; ?>"><?php echo $cat['nasipaddress']; ?></option>
										<?php 
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-xs-5">
								<div class="input-group">
								<span class="input-group-addon">VLAN ID</span>
									<select class="form-control" name="VLAN" >
									<option value="" selected="selected">Select VLAN ID</option>
										<?php $result = mysql_query("SELECT nasport FROM radacct GROUP BY nasport ORDER BY nasport ASC");
												while ($cat = mysql_fetch_assoc($result)) {
										
										?>		
										<option value="<?php echo $cat['nasport']; ?>"><?php echo $cat['nasport']; ?></option>
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
									<i class="fa"></i> Expired Users List
								</div>
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