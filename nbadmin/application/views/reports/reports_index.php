<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				
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
							<li class="breadcrumb-active">Monthly Reports</li>
						</ol>
					</div>
				</header>

				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title" style="margin-top:-10px;">
								<div class="caption">
									<i class="fa"></i>Units Consumption by Dealer-Package Wise</div>
							</div>
							<div class="portlet-body" style="margin-top:-10px;">
      <?php 
      $attributes = array('role' => 'form','target' => '_blank');
      echo form_open('reports/reports_print', $attributes);?>
									<div class="row">
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">From Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" name="DateStart" type="text" value="" data-date-format="yyyy-mm-dd" id="stDate1">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">To Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" name="DateEnd" type="text" value="" data-date-format="yyyy-mm-dd" id="endDate1">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer</span>
												<select class="form-control width" name="UsrCre" id="dealer1" onchange="checkInputSearch1();" >
												<option value="" selected="selected">Select Dealer</option>
													<?php $result = mysql_query("SELECT Dlrname FROM dealer");
															while ($cat = mysql_fetch_assoc($result)) {
													
													?>		
													<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
													<?php 
													}
													?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn1" disabled="disabled">Search</button>
												</span>
											</div>
										</div>
									</div>
								</form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Units Consumption by Dealer-Date Wise
								</div>
							</div>
							<div class="portlet-body">
      <?php 
      $attributes = array('role' => 'form','target' => '_blank');
      echo form_open('reports/usersreports_print', $attributes);?>
									<div class="row">
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">From Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" name="DateStart" type="text" value="" data-date-format="yyyy-mm-dd" data-date-start-date="-3m" id="stDate2">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">To Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" name="DateEnd" id="endDate2" type="text" value="" data-date-format="yyyy-mm-dd">
												<!--<input class="form-control form-control-inline input-medium date-picker" name="DateEnd" type="text" value="" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">-->
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer</span>
												<select class="form-control width" name="UsrCre" id="dealer2" onchange="checkInputSearch2();" >
												<option value="" selected="selected">Select Dealer</option>
													<?php $result = mysql_query("SELECT Dlrname FROM dealer");
															while ($cat = mysql_fetch_assoc($result)) {
													
													?>		
													<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
													<?php 
													}
													?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn2" disabled="disabled">Search</button>
												</span>
											</div>
										</div>
									</div>
								</form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i> Units Consumption Summary by Dealer-Packages Wise 
									<?php if(!empty($dealername)){
										//echo $dealername; 
										} ?>  
								</div>
							</div>
							<div class="portlet-body">
							<?php if(empty($posts)){

	$attributes = array('role' => 'form');
      echo form_open('reports/index', $attributes);?>
									<div class="row">
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">From Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" id="stDate3" name="DateStart" type="text" value="" data-date-format="yyyy-mm-dd" data-date-start-date="-1y">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">To Date</span>
												<input class="form-control form-control-inline input-medium date-picker" readonly="readonly" id="endDate3" name="DateEnd" type="text" value="" data-date-format="yyyy-mm-dd" data-date-start-date="-1y">
											</div>
										</div>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer</span>
												<select class="form-control" name="UsrCre" id="dealer3" onchange="checkInputSearch3();" >
												<option value="" selected="selected">Select Dealer</option>
													<?php $result = mysql_query("SELECT Dlrname FROM dealer");
															while ($cat = mysql_fetch_assoc($result)) {
													
													?>		
													<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
													<?php 
													}
													?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit" id="searchBtn3" disabled="disabled">Search</button>
												</span>
											</div>
										</div>
									</div>
								</form>
							<?php } else {
								$count = 0;?>
								<table class="table table-bordered table-striped">
                                    <thead>
										<tr><td bgcolor='#e0e0e0' align='center' colspan='9'><font size='+2' color='#006393'>
									  <b>Units Consumption Summary by Dealer-Packages  Wise</b></font></td></tr>
                                    </thead>
                                    <tbody>
										<tr>
										<td colspan='2' align='left'><b><font size='-1'>From Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo $DateStart; ?>&nbsp;</font></td>
										<td colspan='2' align='left'><b><font size='-1'>To Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo $DateEnd; ?>&nbsp;</font></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Dealer Name</font></b></td>
										<td colspan='2'><b><font size='-1' color='purple'><?php echo $dealer['Dlrname']; ?>&nbsp;</font></b></td>
										<td colspan='2'><b><font size='-1'>Dealer’s Name</font></b></td>
										<td colspan='2' ><b><font size='-1' color='purple'><?php echo $dealer['DFullName']; ?>&nbsp;&nbsp;&nbsp;</font></b></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Net Payable</font></b></td>
										<td colspan='2' ><font size='-1'><?php echo $Total['DUAmount']; ?>.0&nbsp;</font></td>
										<td colspan='2' ><b><font size='-1'>Status</font></b></td>
										<td colspan='2' ><font size='-1'><font size='-1'><?php 
													if ($dealer['Active']==1){
														echo "Active";
													} else if($dealer['Active']==0){
														echo "<code>DeActive</code>";
													} else {
														echo "User is Blocked By Managment";
													} ?>&nbsp;</font></td></tr>
                                    </tbody>
                                </table>
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr. #</th>
                                            <th>Package</th>
                                            <th>Total Units</th>
                                            <th>Total Users</th>
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
										<tr><td align="right" colspan="3">&nbsp;</td><td>Users Total: &nbsp;<?php echo $Total['DUserID']; ?></td><td>Amount Total: &nbsp;<?php echo $Total['DUAmount']; ?></td></tr>
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
                        <div class="panel-heading">
                            Dealer Payments Report
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
      <?php 
      $attributes = array('role' => 'form');
      echo form_open('reports/paymentreport', $attributes);?>
									<div class="row">
										<div class="input-append">
											<div class="col-xs-12">
												<div class="input-group">
												<span class="input-group-addon">Select Dealer</span>
													<select class="form-control width" name="UsrCre" >
														<?php $result = mysql_query("SELECT Dlrname FROM dealer ORDER BY Dlrname ASC");
																while ($cat = mysql_fetch_assoc($result)) {
														?>		
														<option value="<?php echo $cat['Dlrname']; ?>"><?php echo $cat['Dlrname']; ?></option>
														<?php 
														}
														?>
													</select>
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
        <!-- /#page-wrapper -->