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
								<a href="javascript:void(0)">Users</a>
							</li>
							<li class="breadcrumb-active">Usage Detail</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
<center>
					<?php 
      $attributes = array('onsubmit' => 'return validateForm()');
      echo form_open('clients/userusage', $attributes);?>
		<!--<form name="userreport" action="<?php echo base_url()?>clients/userusage" onsubmit="return validateForm()" method="post"> -->
					<?php 
						$dayf=date('Y-m-01', strtotime('+1 day'));
						$dayt=date("Y-m-d", strtotime('+1 day'));
					?>
						<div class="row">
                        
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group input-group">
									<span class="input-group-addon">Username</span>
									<input type="text" name="username" value="" class="form-control" placeholder="Username">
								</div>
							</div>
                            
                            <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div class="form-group input-group">
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
                            
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div style="width:100%!important;" class="form-group input-group input-large date-picker input-daterange" data-date="<?php echo $dayf; ?>" data-date-format="yyyy-mm-dd">
										<span class="input-group-addon">From Date</span>
                                        <input type="text" class="form-control" name="DateStart">
								</div>
							</div>
                            
                            <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div style="width:100%!important;" class="form-group input-group input-large date-picker input-daterange" data-date="<?php echo $dayf; ?>" data-date-format="yyyy-mm-dd">
								            <span class="input-group-addon">To Date </span>
                                            <input type="text" class="form-control" name="DateStart">
								</div>
							</div>
                            
							
                            
						</div>
                        
					</form>
				</center>
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user"></i>Usage Detail
								</div>
							</div>
							<div class="portlet-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											
											<th>User</th>
											<th>IP Address</th>
											<th>RAS IP</th>
											<th>Online Time</th>
											<th>Offline Time</th>
                                            <th>Dealer Name</th>
											<th>Up / Down</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
				<?php if(!empty($uonline) || !empty($posts)){
								if(!empty($uonline)){
											foreach($uonline as $row){?>
												<tr class="odd gradeX">
													
													<td><?php echo $row['username']; ?></td>
													
													<td><?php echo $row['framedipaddress']; ?></td>
													<td><?php echo $row['nasipaddress']; ?></td>

													<td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstarttime"])); ?></td>
													<td><?php if(!empty($row["acctstoptime"])) {
															echo date("j-m-Y, g:i a", strtotime($row["acctstoptime"]));
														} else {
															echo "ONLINE NOW";
														}?></td>
                                                        
                                                     <td><?php echo $row['creator']; ?></td>   
													<td><?php echo (round($row['acctinputoctets']/1000/1000)) . "MB / " . (round($row['acctoutputoctets']/1000/1000)) . " MB"; ?></td>
												</tr>
									<?php }	
								}
									if(!empty($posts)){
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													
													<td><?php echo $row['username']; ?></td>
													<td><?php echo $row['framedipaddress']; ?></td>
													<td><?php echo $row['nasipaddress']; ?></td>
													<td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstarttime"])); ?></td>
													<td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstoptime"])); ?></td>
													<td><?php echo $row['creator']; ?></td>
													<td><?php echo (round($row['acctinputoctets']/1000/1000)) . "MB / " . (round($row['acctoutputoctets']/1000/1000)) . " MB"; ?></td>
												</tr>
										<?php }
										}
						} else {?>
												<tr class="odd gradeX">
                                                	<td colspan="7" align="center">No entries found</td>	
													
												</tr>
						<?php }
							//echo $lastquery; ?>
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