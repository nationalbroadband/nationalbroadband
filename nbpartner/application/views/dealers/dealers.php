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
								<a href="javascript:void(0)">Dealer</a>
							</li>
							<li class="breadcrumb-active">Dealer Detail</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">
					<div class="portlet box blue">
						<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested Dealer "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>PANGA: </b> bhai koi masla hay.. check karo yeh Dealer ID <b><?php echo $this->uri->segment(3); ?></b> ... :( </code></p>
			<?php } else { ?>
                            <h3>Dealer ID: <?php echo $post['Dlrname']; ?></h3>
                            <p></p>
							<div class="table-scrollable">
								<table class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
										<tr>
                                            <th>UserID</th>
                                            <td colspan="2"><?php echo $post['Dlrname']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <th>Name / CNIC #</th>
                                            <td><?php echo $post['DFullName']; ?></td>
                                            <td colspan="2"><?php echo $post['DCNIC']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Phone / Mobile# / Status</th>
                                            <td><?php if (!empty($post['DPhone'])){
													echo $post['DPhone'];
												} else {
												echo "";}?></td>
                                            <td><?php if (!empty($post['DMobile'])){
													echo $post['DMobile'];
												} else {
												echo "";}?></td>
                                             <td><?php 
													if ($post['Active']==1){
														echo "Active";
													} else if($post['Active']==0){
														echo "<code>In-Active</code>";
													} else {
														echo "User is Blocked By Managment";
													} ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
											<td class="text-muted" colspan="3"><?php echo $post['DEmail']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['DlrAdd']; ?></td>
                                        </tr>
										<tr>
                                            <th>Sub Dealer Allow / Registered on</th>
                                             <td><?php 
													if ($post['DSub']==1){
														echo "Allowed";
													} else if($post['DSub']==0){
														echo "<code>NotAllowed</code>";
													} ?>
											 </td>
                                             <td colspan="2"><?php echo date("j-m-Y, g:i a", strtotime($post["CDate"])); ?></td>
                                        </tr>
                                        <tr>
                                        <td>Click <a href="<?php echo base_url(); ?>dealers/dealerChange/<?php echo $post['Dlrname']; ?>">Change</a> Password</td>
                                        <td></td>
                                        <td></td>
                                        </tr>
										<tr>
                                            <th>Limit / Used</th>
                                             <td colspan="2"><?php echo $post["BalLimit"]; ?></td>
                                             <td colspan="2"><?php echo $post["Balance"]; ?></td>
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
		