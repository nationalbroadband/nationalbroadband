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
								<a href="javascript:void(0)">Online Users</a>
							</li>-->
							<li class="breadcrumb-active">Online users </li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('online/index', $attributes);?>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">Username</span>
									<input type="text" name="username" value="" class="form-control" placeholder="Username">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">RAS IP</span>
									<select class="form-control" name="RASIP" >
									<option value="" selected="selected">Select RASIP</option>
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
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Dealer</span>
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
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cloud"></i>Online users &nbsp; (<?php echo $totals; ?>)
								</div>
							</div>
							<div class="portlet-body">
								
								<table class="table table-striped table-bordered table-hover" id="sample_6">
									<thead>
											<tr>
												
												<th>User Name</th>
												<th>Package</th>
                                                <th>Login Time</th>
												<th>VLAN</th>
												<th>RAS IP</th>
												<th>IP Address</th>
												<th>Data Usage</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
											<tr style="border:none !important;">
												
												<th></th>
												<th></th>
                                                <th></th>
												<th>No &nbsp; entry &nbsp; found</th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										<?php } else { 
										$count = 0;
											foreach($posts as $row){											
												$count++;?>
												<tr class="odd gradeX">
													
													<td class="center"><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a></td>
													<td><?php echo $row['package']; ?></td>
                                                    <td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstarttime"])); ?></td>
													<td><?php echo $row['nasport']; ?></td>
													<td><?php echo $row['nasipaddress']; ?></td>
													<td><?php echo $row['framedipaddress']; ?></td>
													<td><?php echo (round($row['acctinputoctets']/1000/1000)) . "MB / " . (round($row['acctoutputoctets']/1000/1000)) . "MB";; ?></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
									</table>
								</div>
							</div>
<?php echo "";//$lastquery; ?>
            <!-- /.row -->
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>