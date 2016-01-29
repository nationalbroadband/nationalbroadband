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
							<li class="breadcrumb-active">Change Dealer Password</li>
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
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Change Dealer Password
							</div>
						</div>
			<div class="portlet-body form">
			<?php if(empty($post)){?>
							<h1>Requested Dealer "<?php echo $this->uri->segment(3); ?>" Not Found... </h1>
							<p><code><b>Error: </b> ID <b><?php echo $this->uri->segment(3); ?></b></code></p>
			<?php } else { ?>
								<?php if($success==1) {?>
									<div class="">
										Updated...!
									</div>
								<?php 
									echo "<meta http-equiv='refresh' content='2;url=".base_url()."dealers/dealer/".$post['Dlrname']."'>";
								}?>
			<?php 
      $attributes = array('role' => 'form');
      echo form_open('dealers/dealerChange/'.$post['Dlrname'], $attributes);?>
	  						<div class="form-body">
										<input type="hidden" name="Author" value="<?php echo $this->session->userdata('username');?>" />
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Email</span>
                                            <input type="text" name="name" value="<?php echo $post['Dlrname']; ?>" class="form-control" placeholder="Client Username" readonly>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="password" name="password" value="" class="form-control" placeholder="New Password">
                                        </div>
                                        <button type="submit" class="btn btn-default">Change</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
			<?php } ?>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->