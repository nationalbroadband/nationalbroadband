<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
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
							<li class="breadcrumb-active">User Details</li>
						</ol>
					</div>
				</header>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
					<div class="portlet box blue">
						<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested User "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>Updated</b></code></p>
			<?php } else { ?>
			
			<?php if(strlen($post['CNIC']) < 13) {?>

					<div class="note note-danger note-shadow">
						<p>
							 It is to remind you that as per instructions of PTA, the details of your users (Name, Address, CNIC) should be complete and accurate. Therefore, you are advised to update all the details of the users in the billing otherwise you will be responsible for any legal action taken by the authority.
						</p>
						<h5 class="block"><a href="<?php echo base_url(); ?>clients/clientedit/<?php echo $post['Username']; ?>"><i class="fa fa-pencil"></i> Click here to update user info.</a></h5>
					</div>
			<?php } ?>

                            <h3>UserID: <?php echo $post['Username']; ?></h3>
                            <p></p>
							<div class="table-scrollable">
								<table class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
										<tr>
                                            <th>User ID / Password / Plan Expiry</th>
                                            <td><?php echo $post['Username']; ?> </td>
                                            <td colspan="3"><?php echo $post['Password']; ?> <a href="<?php echo base_url(); ?>clients/clientChange/<?php echo $post['Username']; ?>">Update</a></td>
                                        </tr>
										<tr>
                                            <th>User Name / CNIC #</th>
                                            <td colspan="2"><?php echo $post['FullName']; ?></td>
                                            <td><?php echo $post['CNIC']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address / Phone #</th>
                                            <td colspan="2"><?php echo $post['UsrAdd']; ?></td>
											<td><?php echo $post['Phone']; ?>/<?php echo $post['Mobile']; ?></td>
                                        </tr>
										<tr>
                                            <th>Package / MAC</th>
                                            <td><?php echo $post['pname']; ?></td>
                                            <td colspan="2"><?php if (!empty($post['Mac'])){
													echo $post['Mac'];
													echo " <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";
												} else {
												echo "<code>NiL</code>";
echo " <a href=\"".base_url()."clients/clientCLI/". $post['Username']."\">Clear</a>";

}?></td>
                                        </tr>
										<tr>
                                            <th>Status</th>
                                            <td colspan="3"><?php 
													if ($post['Active']==1){
														if ($post['UStatus']==3){
															echo "<code> Monthly Activation </code>";
														} else {
															echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">Active</a>";
														}
													} else if($post['Active']==0){
														echo " <a href=\"".base_url()."clients/clientStats/". $post['Username']."\">In-Active</a>";
													} else {
														echo "<code>User is Blocked By Management</code>";
													} ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Email</th>
											<td class="text-muted" colspan="3"><?php echo $post['Email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Comments</th>
                                            <td colspan="3"><?php echo $post['Comment']; ?></td>
                                        </tr>
										<tr>
                                            <th>Registration / De-Activation / Expiry Date</th>
                                             <td><?php echo $post['CDate']; ?></td>
											 <td><?php echo $post['Usr_DeActv']; ?></td>
                                             <td><?php echo $post['UExpiry']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--
                            <p>Grid classes apply to devices with screen widths greater than or equal to the breakpoint sizes, and override grid classes targeted at smaller devices. Therefore, applying any
                                <code>.col-md-</code> class to an element will not only affect its styling on medium devices but also on large devices if a
                                <code>.col-lg-</code> class is not present.</p>
						-->
						<?php
							}
						?>
                    </div>
                    </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->
		