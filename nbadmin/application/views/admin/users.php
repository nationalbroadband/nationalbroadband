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
                        <a href="<?php echo base_url('users'); ?>">Panel IDs</a>
                    </li>
                    <li class="breadcrumb-current-item">Admins</li>
                </ol>
            </div> 
        </header>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>Customer Information...
								</div>
							</div>
							<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
                            <h3>Dealer Name: <?php echo $post['creator']; ?></h3>
                            <p>Here is the user account information and personal details.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
										<tr>
                                            <th>UserID / Password / Type</th>
                                            <td><?php echo $post['Username']; ?></td>
                                            <td><?php echo $post['Password']; ?> <a href="<?php echo base_url(); ?>clients/clientChange/<?php echo $post['Username']; ?>">Change</a></td>
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
                                            <th>Name / CNIC#</th>
                                            <td><?php echo $post['FullName']; ?></td>
                                            <td colspan="2"><?php echo $post['CNIC']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['UsrAdd']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Package/Status/Mac</th>
                                            <td><?php echo $post['pname']; ?></td>
                                            <td><?php 
													if ($post['Active']==1){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">Active</a>";
													} else if($post['Active']==0){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">NotActive</a>";
													} else {
														echo "<code>Blocked By Management</code>";
													} ?></td>
                                            <td><?php if (!empty($post['Mac'])){
													echo $post['Mac'];
													echo " <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												} else {
												echo "<code>NiL</code> <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												}?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact</th>
                                            <td><?php if (!empty($post['Phone'])){
													echo $post['Phone'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                            <td><?php if (!empty($post['Mobile'])){
													echo $post['Mobile'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                            <td><?php if (!empty($post['STRN'])){
													echo $post['STRN'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
											<td class="text-muted" colspan="3"><?php echo $post['Email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Comment</th>
                                            <td colspan="3"><?php echo $post['Comment']; ?></td>
                                        </tr>
										<tr>
                                            <th>Register/Deactive Date</th>
                                             <td colspan="2"><?php echo $post['CDate']; ?></td>
											 <td><?php echo $post['Usr_DeActv']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
						<?php
							}
						?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
		