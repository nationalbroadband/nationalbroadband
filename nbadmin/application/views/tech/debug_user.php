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
							<li class="breadcrumb-active">User Tech. Details</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->
      <?php $attributes = array('role' => 'form');
      echo form_open('technoc/debuguser', $attributes);?>
									<div class="row">
										<div class="col-xs-12">
											<div class="input-group">
											<span class="input-group-addon">Enter User ID</span>
												<input class="form-control form-control-inline" name="Username" type="text" value="">
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
									<i class="fa fa-users"></i>Technical Details</div>
							</div>
							<div class="portlet-body">
									<?php
									if($this->input->post('Username')){
										$UserID = $this->input->post('Username');
									} else {
										$UserID = "support1";
									}

										$this->db->select('users.*,package.pname');
										$this->db->from('users');
										$this->db->join('package', 'package.listname = users.Package');
										$this->db->where('users.Username',$UserID);
										$query=$this->db->get();
										$post = $query->first_row('array');
									?>
			<?php if(empty($post)){
					if($this->input->post('Username')){
			?>
							<h1>Requested User Not Found...</h1>
						<!--	<p><code>404: ERROR</code> there must be some issue here ... :( </p> -->
			<?php 
					}
				} else { ?>
                            <h3>User’s Dealer Name: <?php echo $post['creator']; ?></h3>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
										<tr>
                                            <th>User ID / Password / Expiry Plan</th>
                                            <td><?php echo $post['Username']; ?></td>
                                            <td><?php echo $post['Password']; ?> <a href="<?php echo base_url(); ?>clients/clientChange/<?php echo $post['Username']; ?>">Update</a></td>
                                            <td><?php 
													if ($post['UStatus']==3){
														echo "Monthly";
													} else if($post['UStatus']==1){ 
														echo "Expire On 10";
													} else { 
														echo "Never Expire";
													}
											?></td>
                                        </tr>
										<tr>
                                            <th>User Name / CNIC#</th>
                                            <td><?php echo $post['FullName']; ?></td>
                                            <td colspan="2"><?php echo $post['CNIC']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email / Expiry Date</th>
											<td class="text-muted" colspan="2"><?php echo $post['Email']; ?></td>
											<td><?php echo $post['UExpiry']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Registeration / Deactivation Date</th>
                                             <td colspan="2"><?php echo $post['CDate']; ?></td>
											 <td><?php echo $post['Usr_DeActv']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['UsrAdd']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Port / Status / MAC</th>
                                            <td><?php if (!empty($post['nasport'])){
													echo $post['nasport'];
												} else {
												echo "<code></code>";}?></td>
                                            <td><?php 
													if ($post['Active']==1){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">Active</a>";
													} else if($post['Active']==0){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">In-Active</a>";
													} else {
														echo "<code>Blocked By Management</code>";
													} ?></td>
                                            <td><?php if (!empty($post['Mac'])){
													echo $post['Mac'];
													echo " <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												} else {
												echo "<code></code> <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												}?></td>
                                        </tr>
                                        <tr>
                                            <th>Package / Contact</th>
											<td><?php echo $post['pname']; ?></td>
                                            <td><?php if (!empty($post['Phone'])){
													echo $post['Phone'];
												} else {
												echo "<code></code>";}?></td>
                                            <td><?php if (!empty($post['Mobile'])){
													echo $post['Mobile'];
												} else {
												echo "<code></code>";}?></td>
                                        </tr>
                                        
										
                                        <tr>
                                            <th>Comments</th>
                                            <td colspan="3"><?php echo $post['Comment']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
						<?php
							}
						?>								
                            <h3>Online Entries</h3>
                            <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
                                        <tr>
                                            
                                            <th>User ID</th>
                                            <th>MAC Address</th>
                                            <th>IP</th>
                                            <th>Port</th>
                                            <th>RAS IP</th>
                                            
                                            <th>Session Start</th>
                                            <th>Session Stop</th>
                                            <th>Dealer Name</th>
                                        </tr>
                                    </thead>
                                   <tbody>
									<?php
											$query = $this->db->query("SELECT username,framedipaddress,acctstarttime,acctstoptime,callingstationid,nasipaddress,nasport,creator,package,address FROM radacct WHERE username='".$UserID."'");

											foreach ($query->result() as $row) {
												echo "<tr>";
												
												echo "<td>" . $row->username."</td>";
												echo "<td>" . $row->callingstationid."</td>";
												echo "<td>" . $row->framedipaddress."</td>";
												
												echo "<td>" . $row->nasport."</td>";
												echo "<td>" . $row->nasipaddress."</td>";
												
												
												echo "<td>" . $row->acctstarttime."</td>";
												echo "<td>" . $row->acctstoptime."</td>";
												echo "<td>" . $row->creator."</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query(); 
									?>
                                    </tbody>
									</table>
								</div>
								
                            <h3>Invalid Logins</h3>
                            <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Original MAC</th>
                                            <th>Requested MAC</th>
                                            <th>Original Port</th>
                                            <th>Requested Port</th>
                                            <th>Original Pass.</th>
                                            <th>Requested Pass.</th>
                                        </tr>
                                    </thead>
                                   <tbody>
									<?php
											$query = $this->db->query("SELECT * FROM radpostauth WHERE reply='Access-Reject' AND username='".$UserID."' Order by authdate desc Limit 5");

											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->username."</td>";
												
												echo "<td>" . $row->usrcli."</td>";
												echo "<td>" . $row->callingstationid."</td>";
												echo "<td>" . $row->usrnasport."</td>";
												echo "<td>" . $row->nasport."</td>";
												echo "<td>" . $row->pass."</td>";
												echo "<td>" . $row->usrpwd."</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query(); 
									?>
                                    </tbody>
									</table>
								</div>
								
                            <h3>Rad Check Entries</h3>
                            <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
                                        <tr>
                                            <th>Entry ID</th>
                                            <th>User ID</th>
                                            <th>Attribute</th>
                                            <th>Option</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                   <tbody>
									<?php
											$query = $this->db->query("SELECT * FROM radcheck WHERE username='".$UserID."'");

											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->id."</td>";
												echo "<td>" . $row->username."</td>";
												echo "<td>" . $row->attribute."</td>";
												echo "<td>" . $row->op."</td>";
												echo "<td>" . $row->value."</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query(); 
									?>
                                    </tbody>
									</table>
								</div>
								
                            <h3>Rad Reply Entries</h3>
                            <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
                                        <tr>
                                            <th>Entry ID</th>
                                            <th>UserID</th>
                                            <th>Attribute</th>
                                            <th>Option</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                   <tbody>
									<?php
											$query = $this->db->query("SELECT * FROM radreply WHERE username='".$UserID."'");

											foreach ($query->result() as $row) {
												echo "<tr>";
												echo "<td>" . $row->id."</td>";
												echo "<td>" . $row->username."</td>";
												echo "<td>" . $row->attribute."</td>";
												echo "<td>" . $row->op."</td>";
												echo "<td>" . $row->value."</td>";
												echo "</tr>";
											}
										//echo $this->db->last_query(); 
									?>
                                    </tbody>
									</table>
								</div>
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