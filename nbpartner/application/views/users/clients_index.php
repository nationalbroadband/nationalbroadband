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
							
							<li class="breadcrumb-active">Users</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
<div class="row">
                <div class="col-sm-12">
<?php 
      $attributes = array('class' => 'panel');
      echo form_open('clients/index', $attributes);?>
		<!--<form action ="<?php echo base_url()?>clients/index" method="post"> -->
					<?php 
						$dayf=date("Y-m-d", time() - 86400);
						$dayt=date("Y-m-d");
					?>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Package</span>
									<select class="form-control" name="UsrPkg">
									<option value="" selected="selected">Select Package</option>
											<?php $query = $this->db->query("SELECT dealersrates.listname, pkg.pname FROM dealersrates INNER JOIN ( SELECT listname, pname FROM package LIMIT 9,11) AS pkg ON dealersrates.listname=pkg.listname WHERE dealersrates.dealername='" . $this->session->userdata('username') . "'");
												foreach ($query->result() as $row) {
													echo "<option value=" . $row->listname . ">" . $row->pname . "</option>";
												}?>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Status</span>
									<select class="form-control" name="UsrStat">
										<option value="Active">Active</option>
										<option value="DeActive">In-Active</option>
									</select>

<?php if(!$this->session->userdata('DealerPerm')){?>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
<?php } ?>
								</div>
							</div>
<?php if($this->session->userdata('DealerPerm')){?>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Dealer</span>
									<select class="form-control" name="UsrCre" >
									<option value="" selected="selected">Select Dealer</option>
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
		<div class="row">
			<div class="col-sm-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>Users</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example"> 
								<thead>
									<tr>
											<th>Name</th>
                                            <th>User ID</th>
                                            <th>Status</th>
                                            <th>Reg Date</th>
                                            <th>Package</th>
                                            <th>Address</th>
                                            <th>Mac</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<tr class="odd gradeX">
													<td></td>
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										<?php } else {
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><?php echo $row['FullName']; ?></td>
													<td><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['Username']; ?>"><?php echo $row['Username']; ?></a></td>
                                                    <td><?php 
															if ($row['Active']==1){
																echo "OPEN";
															} else if($row['Active']==0){
																echo "<code>CLOSE</code>";
															} else {
																echo "Blocked";
														} ?></td>
													<td><?php echo $row['CDate']; ?></td>
													<td><?php echo $row['Package']; ?></td>
													<td><?php echo $row['UsrAdd']; ?></td>
													<td><?php echo $row['Mac']; ?></td>
													
													<td><center><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['Username']; ?>"><i class="fa fa-search"></i></a> | <a href="<?php echo base_url(); ?>clients/clientedit/<?php echo $row['Username']; ?>"><i class="fa fa-pencil"></i></a></center></td>
												</tr>
										<?php }
										}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
<!-- /11. $JQUERY_DATA_TABLES -->

			</div>
		</div>

	</div> <!-- / #content-wrapper -->