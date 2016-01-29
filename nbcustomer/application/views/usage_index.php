<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div id="page-wrapper">
		<br />
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<div class="caption" style="margin-bottom:20px;">
								<i class="fa fa-lock"></i> Usage Information</div>
                            <div class="dataTable_wrapper">

			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->

					<?php 
      $attributes = array('class' => 'panel');
      echo form_open('billpanel/usage', $attributes);?>
					<?php 
						$dayf=date('Y-m-01', strtotime('+1 day'));
						$dayt=date("Y-m-d", strtotime('+1 day'));
					?>
						<div class="row">
                           
							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								
                                <div style="width:100%!important;" class="form-group input-group input-large date-picker input-daterange" data-date="2016-01-01" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon">From Date</span>
									<input type="text" name="DateStart" value="<?php isset($_POST['DateStart'])? print $_POST['DateStart']: ""; ?>" class="form-control form-control form-control-inline input-medium date-picker" id="stDate1" 
									style="background-color:white" readonly>
								</div>
							</div>

							<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
								<div style="width:100%!important;" class="form-group input-group input-large date-picker input-daterange" data-date="<?php echo $dayf; ?>" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon">To Date</span>
									<input type="text" name="DateEnd" value="<?php isset($_POST['DateEnd'])?print $_POST['DateEnd']: ""; ?>" class="form-control form-control form-control-inline input-medium date-picker" id="stDate2" 
									style="background-color:white" readonly>
									<?php if(!$this->session->userdata('DealerPerm')){?>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Search</button>
									</span>
									<?php } ?>
								</div>
							</div>
						</div>
					</form>

					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>Usage Detail
							</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example"> 
                                    <thead>
                                        <tr>
											
											<th>User Name </th>
											<th>IP Address</th>
                                            <th>Online Time</th>
											<th>Offline Time</th>
											<th>Up / Down</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
				<?php 
				
				if(!empty($uonline) || !empty($posts)){
								if(!empty($uonline)){
											foreach($uonline as $row){?>
												<tr class="odd gradeX">
													
													<td><?php echo $row['username']; ?></td>
													<td><?php echo $row['framedipaddress']; ?></td>
                                                    <td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstarttime"])); ?></td>
													<td><?php if(!empty($row["acctstoptime"])) {
															echo date("j-m-Y, g:i a", strtotime($row["acctstoptime"]));
														} else {
															echo "ONLINE NOW";
														}?></td>
													<td><?php echo (round($row['acctinputoctets']/1000/1000)) . "MB / " . (round($row['acctoutputoctets']/1000/1000)) . " MB"; ?></td>
												</tr>
									<?php }	
								}
									if(!empty($posts)){
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><?php echo $row['username']; ?></td>
													<td><?php echo $row['framedipaddress']; ?></td>
													<td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstarttime"])); ?></td>
													<td><?php echo date("j-m-Y, g:i a", strtotime($row["acctstoptime"])); ?></td>
													<td><?php echo (round($row['acctinputoctets']/1000/1000)) . "MB / " . (round($row['acctoutputoctets']/1000/1000)) . " MB"; ?></td>
												</tr>
										<?php }
										}
						} else {?>
												<tr class="odd gradeX">
													<td></td>
													<td></td>
													<td>No entry found</td>
													<td></td>
													<td></td>
												</tr>
						<?php }
							//echo $lastquery; ?>
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