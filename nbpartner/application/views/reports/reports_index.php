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
								<a href="javascript:void(0)">Reports</a>
							</li>
							<li class="breadcrumb-active">Reports</li>
						</ol>
					</div>
				</header>

			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
                <div class="col-sm-12">

					<div class="panel panel-default">
                        <div class="caption2">
                            Units Consumption by Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="min-height:0!important;">
								<?php 
      $attributes = array('class' => 'panel','target' => '_blank');
      echo form_open('reports/usersreports', $attributes);?>
		<!--<form action ="<?php echo base_url()?>reports/usersreports" method="post" target="_blank">-->
									<div class="row">
									<div class="input-append">
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">From Date</span>
												<input type="text" name="DateStart" value="" readonly="readonly" class="form-control form-control-inline input-medium date-picker" id="stDate1">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">To Date</span>
												<input type="text" name="DateEnd" value="" readonly="readonly" class="form-control form-control-inline input-medium date-picker" id="endDate1">
<?php if(!$this->session->userdata('DealerPerm')){?>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn1" disabled="disabled">Search</button>
												</span>
<?php } ?>
											</div>
										</div>
									</div>
<?php if($this->session->userdata('DealerPerm')){?>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer Name</span>
												<select class="form-control width" name="UsrCre"  id="dealer1" onchange="checkInputSearch1();">
												<option value="" selected="selected">Select Dealer</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn1" disabled="disabled">Search</button>
												</span>
											</div>
										</div>
<?php } ?>
									</div>
								</form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="caption2">
                            Units Consumption by Users-Packages Wise</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="min-height:0!important;">
								<?php 
      $attributes = array('class' => 'panel','target' => '_blank');
      echo form_open('reports/unitreports', $attributes);?>
		<!--<form action ="<?php echo base_url()?>reports/unitreports" method="post" target="_blank"> -->
									<div class="row">
									<div class="input-append">
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">From Date</span>
												<input type="text" name="DateStart" value="" readonly="readonly" class="form-control form-control-inline input-medium date-picker" id="stDate2">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">To Date</span>
												<input type="text" name="DateEnd" value="" readonly="readonly" class="form-control form-control-inline input-medium date-picker" id="endDate2">
<?php if(!$this->session->userdata('DealerPerm')){?>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn2" disabled="disabled">Search</button>
												</span>
<?php } ?>
											</div>
										</div>
									</div>
<?php if($this->session->userdata('DealerPerm')){?>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer Name</span>
												<select class="form-control width" name="UsrCre" id="dealer2" onchange="checkInputSearch2();">
												<option value="" selected="selected">Select Dealer</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn2" disabled="disabled">Search</button>
												</span>
											</div>
										</div>
<?php } ?>
									</div>
								</form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="caption2">
                             <?php if(!empty($dealername)){
										//echo $dealername; 
										} ?>Units Consumption by Packages 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="min-height:0!important;">
							<?php if(empty($posts)){?>
								<?php 
      $attributes = array('class' => 'panel');
      echo form_open('reports/index', $attributes);?>
		<!--<form action ="<?php echo base_url()?>reports/index" method="post"> -->
									<div class="row">
									<div class="input-append">
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">From Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" name="DateStart" type="text" value="" data-date-format="yyyy-mm-dd" data-date-start-date="-1y" id="stDate3">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">To Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" name="DateEnd" type="text" value="" data-date-format="yyyy-mm-dd" data-date-start-date="-1y" id="endDate3">
<?php if(!$this->session->userdata('DealerPerm')){?>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn3" disabled="disabled">Search</button>
												</span>
<?php } ?>
											</div>
										</div>
									</div>
<?php if($this->session->userdata('DealerPerm')){?>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer Name</span>
												<select class="form-control width" name="UsrCre" id="dealer3" onchange="checkInputSearch3();">
												<option value="" selected="selected">Select Dealer</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn3" disabled="disabled">Search</button>
												</span>
											</div>
										</div>
<?php } ?>
									</div>
								</form>
							<?php } else {
								$count = 0;?>
								<table class="table table-bordered table-striped">
                                    <thead>
										<tr><td bgcolor='#e0e0e0' align='center' colspan='9'><font size='+2' color='#006393'>
										<b>Units Consumption by Packages </b></font></td></tr>
                                    </thead>
                                    <tbody>
										<tr><td colspan='2' align='left'><b><font size='-1'>From date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo $DateStart; ?>&nbsp;</font></td>
										<td colspan='2' align='left'><b><font size='-1'>To Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo $DateEnd; ?>&nbsp;</font></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Dealer ID</font></b></td>
										<td colspan='2'><b><font size='-1' color='purple'><?php echo $dealer['Dlrname']; ?>&nbsp;</font></b></td>
										<td colspan='2'><b><font size='-1'>Dealer Name</font></b></td>
										<td colspan='2' ><b><font size='-1' color='purple'><?php echo $dealer['DFullName']; ?>&nbsp;&nbsp;&nbsp;</font></b></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Net Payable</font></b></td>
										<td colspan='2' ><font size='-1'><?php echo $Total['DUAmount']; ?>.0&nbsp;</font></td>
										<td colspan='2' ><b><font size='-1'>Tax Amount</font></b></td>
										<td colspan='2' ><font size='-1'><font size='-1'><?php echo $Total['TaxAmount']; ?>.0&nbsp;</font></td></tr>
                                    </tbody>
                                </table>
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Package</th>
                                            <th>Units</th>
                                            <th>Users</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
							<?php foreach($posts as $row){ 
									$count++;?>
												<tr class="odd gradeX">
													<td><?php echo $count; ?></td>
													<td><?php echo $row['DUpakage']; ?></td>
													<td><?php echo $row['DUcount']; ?></td>
													<td><?php echo $row['DUserID']; ?></td>
													<td><?php echo $row['DUAmount']; ?></td>
												</tr>
								<?php }?>
										<tr><td align="right" colspan="3">&nbsp;</td><td>Total Users: &nbsp;<?php echo $Total['DUserID']; ?></td><td>Total Amount:: &nbsp;<?php echo $Total['DUAmount']; ?></td></tr>
                                    </tbody>
                                </table>
							<?php //echo $pagelink;
								}?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					
                    <div class="panel panel-default">
                        <div class="caption2">
                            Payments Report by Dealer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="min-height:0!important;">
								<?php 
      $attributes = array('class' => 'panel');
      echo form_open('reports/paymentreport', $attributes);?>
									<div class="row">
										<div class="input-append">
											<div class="col-xs-4">
												<div class="input-group">
												<span class="input-group-addon">Dealer Name</span>
<?php if($this->session->userdata('DealerPerm')){?>
													<select class="form-control width" name="UsrCre" >
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
													</select>
<?php } else { ?>
													<input type="text" name="yourid" value="<?php echo $this->session->userdata('username'); ?>" class="form-control" readonly>
<?php } ?>
													<span class="input-group-btn">
													<button class="btn btn-default" type="submit">Search</button>
													</span>
												</div>
											</div>
										</div>
									</div>
								</form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
	</div>
	<!-- /#page-wrapper -->