 
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
							<!--<li class="breadcrumb-current-item">
								<a href="javascript:void(0)">Invalid Login</a>
							</li>-->
							<li class="breadcrumb-active">Invalid Logins</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->
				<center>	
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('badlogins/index', $attributes);?>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">User ID</span>
									<input type="text" name="searchterm" value="" class="form-control" placeholder="User ID">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Dealer Name</span>
									<select class="form-control" name="UsrCre" >
									<option value="" selected="selected">Select Dealer</option>
										<?php $result = mysql_query("SELECT Dlrname FROM dealer ORDER BY Dlrname ASC");
												while ($cat = mysql_fetch_assoc($result)) {
										?>		
										<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
										<?php 
										}
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
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user-times"></i>Invalid Logins</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
									<thead>
                                        <tr>
                                        	<th>Date & Time</th>
                                            <th>User ID</th>
                                            <th>Password</th>
                                            <th>MAC Address</th>
                                            <th>Reason</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<tr class="odd gradeX">
                                                <td>No entries found</td>
													<!--<td class="center"><code> - No -</code></td>
													<td><code> - Data -</code></td>
													<td><code> - Found -</code></td>-->
													<td><code> - - -</code></td>
													<td><code> - Try -</code></td>
													<td><code> - Again -</code></td>
												</tr>
										<?php } else { 
										$count = 0;
											foreach($posts as $row){
												$UPass = strcmp($row['pass'],$row['usrpwd']);
											if (!empty($row['usrcli'])){
												$UMac = strcmp($row['callingstationid'],$row['usrcli']);
											} else {
												$UMac = 0;
											}
											
									// Online Check
										$this->db->select("username");
										$this->db->from("radacct");
										$this->db->where('username',$row['username']);
										$this->db->where("acctstoptime IS NULL");
										$query=$this->db->get();
										if ($query->num_rows() > 0){
											$uonline=$query->first_row('array');
										} else {
											$uonline=0;
										}
											
												$count++;?>
												<tr class="odd gradeX">
                                                <td><?php echo date("j-m-Y, g:i a", strtotime($row["authdate"])); ?></td>
													<td><?php echo $row['username']; ?></td>
													<td><?php echo $row['pass']; ?></td>
													<td><?php echo $row['callingstationid']; ?></td>
													<td><?php if (empty($row['usrstatus'])){
														echo "<code>NotActive</code>";
													} else if (!empty($uonline)){
														echo "<code>Online</code>";
													} else if (!empty($UPass)){
														echo "<code>Password</code>";
													} else if (!empty($UMac)){
														echo "<code>Mac Issue</code>";
													}?></td>
													
													<td class="center"><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['username']; ?>">user profile &raquo;</a></td>
												</tr>
										<?php }
										}?>
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