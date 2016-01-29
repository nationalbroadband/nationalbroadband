<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				User Details</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('users'); ?>">Users</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">User Details</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>User Details...
								</div>
							</div>
							<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
                            <h3>Dealer: <?php echo $post['creator']; ?></h3>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <th>User Name / CNIC#</th>
                                            <td><?php echo $post['FullName']; ?></td>
                                            <td colspan="2"><?php echo $post['CNIC']; ?></td>
                                        </tr>
										<tr>
                                            <th>User ID / Password / Plan Expiry</th>
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
                                            <th>Email</th>
											<td class="text-muted" colspan="3"><?php echo $post['Email']; ?></td>
											<!--<td><?php //echo $post['UExpiry']; ?></td>-->
                                        </tr>
                                        <tr>
                                            <th>Comments</th>
                                            <td colspan="3"><?php echo $post['Comment']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Package / Phone # / Mobile #</th>
											<td><?php echo $post['pname']; ?></td>
                                            <td><?php if (!empty($post['Phone'])){
													echo $post['Phone'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                            <td><?php if (!empty($post['Mobile'])){
													echo $post['Mobile'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['UsrAdd']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>MAC / Port / Status </th>
                                            <td><?php if (!empty($post['Mac'])){
													echo $post['Mac'];
													echo " <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												} else {
												echo "<code>NiL</code> <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												}?></td>
                                            <td><?php if (!empty($post['nasport'])){
													echo $post['nasport'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                            <td><?php 
													if ($post['Active']==1){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">Active</a>";
													} else if($post['Active']==0){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">In-Active</a>";
													} else {
														echo "<code>Blocked By Management</code>";
													} ?></td>
                                            
                                        </tr>
                                        
                                        
										<tr>
                                            <th>Registeration / De-Activation / Expiry Date</th>
                                             <td><?php echo $post['CDate']; ?></td>
											 <td><?php echo $post['Usr_DeActv']; ?></td>
                                             <td><?php echo $post['UExpiry']; ?></td>
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
		