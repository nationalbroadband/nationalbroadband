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
							
							<li class="breadcrumb-active">Invalid logins</li>
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
      echo form_open('badlogins/index', $attributes);?>
						<div class="row">
<?php if($this->session->userdata('DealerPerm')){?>
							<div class="col-xs-6">
								<div class="input-group">
								<span class="input-group-addon">Dealer ID: </span>
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
								<i class="fa fa-user-times "></i>Invalid Logins</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">                                    <thead>
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
													<td class="center"></td>
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
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
													
													<td class="center"><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['username']; ?>">User Profile &raquo;</a></td>
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