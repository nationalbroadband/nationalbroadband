<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
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
							<li class="breadcrumb-active">Online users</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-sm-12">

				<center>	
					<?php 
      $attributes = array('class' => 'panel');
      echo form_open('online/index', $attributes);?>
		<!--<form action ="<?php echo base_url()?>online/index" method="post"> -->
						<div class="row">
<?php if($this->session->userdata('DealerPerm')){?>
							<div class="col-xs-5">
								<div class="input-group">
								<span class="input-group-addon">Select Dealer ID: </span>
									<select class="form-control" name="UsrCre" >
							<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
										foreach ($query->result() as $row) {
											echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
									}?>
									</select>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
								</div>
							</div>
<?php } ?>
						</div>
					</form>
				</center>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cloud"></i>Online Users
							</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>MAC Address</th>
                                            <th>IP</th>
                                            <th>Data</th>
                                            <th>Login Time</th>
                                            <th>Data Usage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<tr class="odd gradeX">
													<td class="center"></td>
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
												</tr>
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td class="center"><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a></td>
													<td><?php echo $row['address']; ?></td>
													<td><?php echo $row['framedipaddress']; ?></td>
													<td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstarttime"])); ?></td>
													<td><?php echo gmdate("H:i:s", $row['acctsessiontime']); ?></td>
													<!--<td><?php echo (round($row['acctsessiontime']/60)); ?> Min</td>-->
													<td><?php echo (round($row['acctinputoctets']/1000/1000)) . "MB / " . (round($row['acctoutputoctets']/1000/1000)) . "MB";; ?></td>
												</tr>
										<?php }
										}?>
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