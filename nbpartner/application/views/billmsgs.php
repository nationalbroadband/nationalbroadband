<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		<div class="page-content-wrapper">
			<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Notifications <small>Notifications/Massages from NOC</small></h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
			<!-- END PAGE HEAD -->

			<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="portlet light">
					<div class="portlet-body">
						<div class="invoice">
							<div class="row invoice-logo">
								<div class="col-xs-6 invoice-logo-space">
									<img src="<?php echo base_url(); ?>images/announcement.png" class="img-responsive" alt=""/>
								</div>
								<div class="col-xs-6">
									<p><br />
										 <?php echo date("j M Y", strtotime($post['MsgDate'])); ?> <span class="muted">
										MsgCode: <u><?php echo $post['Msgaly']; ?></u></span>
									</p>
								</div>
							</div>
							<hr/>
							<div class="row">
								<div class="col-xs-4">
									<h3><?php echo $post['MsgTo']; ?></h3>
								</div>
								<div class="col-xs-8">
									
										
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<table class="table table-striped table-hover">
										<thead></thead>
											<tbody>
												<tr>
											<?php if(!empty($post['Msgimg2'])) { ?>
												<center><img class="img-responsive" src="<?php echo base_url(); ?><?php echo $post['Msgimg2']; ?>" alt="<?php echo $post['Msgaly']; ?>"></center>
											<?php } ?><br />
												</tr>
												<tr>
											<?php echo $post['AdminMsg']; ?>
												</tr>
											</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4">
									<div class="well">
										<address>
										</address>
									</div>
								</div>
								<div class="col-xs-8 invoice-block">
									<div>
										<address>
										<strong></strong><br/>
									</div>
									<br/>
									<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
									Print <i class="fa fa-print"></i>
									</a><!--
									<a class="btn btn-lg green hidden-print margin-bottom-5">
									Submit Your Invoice <i class="fa fa-check"></i>
									</a>-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
