<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Massage <small>Dealer Massages inbox</small></h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<div class="portlet light">
				<div class="portlet-body">
					<div class="row inbox">
			<h1><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;<?php echo $post['MsgTo']; ?></h1>
			<div class="pull-right btn btn-primary" style="display: block;" target="_blank"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $post['MsgDate']; ?></div>
		</div>
		</div>

        <div class="row">

            <div class="col-md-12">
			<?php echo $post['AdminMsg']; ?><br />
				<?php if(!empty($post['Msgimg2'])) { ?>
					<img class="img-responsive" src="http://acp.cyber.net.pk/<?php echo $post['Msgimg2']; ?>" alt="">
				<?php } ?>
				<br />
            </div>

        </div>
		
		</div> 
		</div> 
	</div> <!-- / #content-wrapper -->
