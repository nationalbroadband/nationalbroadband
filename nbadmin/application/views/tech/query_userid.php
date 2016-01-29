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
							<li class="breadcrumb-active">Usage Log by Users</li>
						</ol>
					</div>
				</header>

				
				<!-- END PAGE HEADER-->
      <?php $attributes = array('role' => 'form');
      echo form_open('technoc/queryuserid', $attributes);?>
									<div class="row">
										<div class="col-xs-3">
											<div class="input-group">
											<span class="input-group-addon">UserID</span>
												<input class="form-control form-control-inline input-medium" name="Username" type="text" value="">
											</div>
										</div>
										<div class="col-xs-5">
													<div class="input-daterange input-group" id="datepicker">
													<span class="input-group-addon">From Date</span>
													<input class="form-control form-control-inline input-medium date-picker" name="DateStart" type="text" value="" data-date-format="yyyy-mm-dd">
													<span class="input-group-addon">To Date</span>
													<input class="form-control form-control-inline input-medium date-picker" name="DateEnd" type="text" value="" data-date-format="yyyy-mm-dd">
													</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">DB</span>
												<select class="form-control" name="dbtable" >
												<option value="radacct" selected="selected">Live DB</option>	
													<option value="radacct_archive">Archive DB</option>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit">Search</button>
												</span>
											</div>
										</div>
									</div>
					</form>

						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
								<i class="fa fa-gears"></i><span class="">Usage Log by Users</span></div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
									<thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>User ID</th>
                                            <th>MAC Address</th>
                                            <th>IP</th>
                                            <th>Port</th>
                                            <th>RAS IP</th>
                                            <th>Session Start</th>
                                            <th>Session Stop</th>
                                            
                                        </tr>
                                    </thead>
                                   <tbody>
									<?php
									if($this->input->post('dbtable')){
										$TableName = $this->input->post('dbtable');
									} else {
										$TableName = "radacct";
									}
									if($this->input->post('DateStart')){
										$Date = $this->input->post('DateStart');
									} else {
										$Date = "2015-10-14";
									}
									if($this->input->post('DateEnd')){
										$Date2 = $this->input->post('DateEnd');
									} else {
										$Date2 = "0";
									}
									if($this->input->post('Username')){
										$IPAddress = $this->input->post('Username');
									} else {
										$IPAddress = "support1";
									}

									if(!empty($Date) && !empty($Date2)){
											$query = $this->db->query("SELECT creator,username,nasport,callingstationid,framedipaddress,acctstarttime,acctstoptime,nasipaddress FROM ".$TableName." WHERE username='".$IPAddress."' AND DATE(acctstarttime) BETWEEN '".$Date."' AND '".$Date2."' ORDER BY acctstoptime DESC");
									} else if(!empty($Username) && empty($Date)){
											$query = $this->db->query("SELECT creator,username,nasport,callingstationid,framedipaddress,acctstarttime,acctstoptime,nasipaddress FROM ".$TableName." WHERE username='".$IPAddress."' AND DATE(acctstarttime) > '".$Date."' ORDER BY acctstoptime DESC");
									} else {
											$query = $this->db->query("SELECT creator,username,nasport,callingstationid,framedipaddress,acctstarttime,acctstoptime,nasipaddress FROM ".$TableName." WHERE username='".$IPAddress."' AND DATE(acctstarttime) > '".$Date."' ORDER BY acctstoptime DESC");
										}

											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->creator."</td>";
												echo "<td>" . $row->username."</td>";
												echo "<td>" . $row->nasipaddress."</td>";
												echo "<td>" . $row->framedipaddress."</td>";
												
												echo "<td>" . $row->nasport."</td>";
												
												echo "<td>" . $row->callingstationid."</td>";
												echo "<td>" . $row->acctstarttime."</td>";
												echo "<td>" . $row->acctstoptime."</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query(); 
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