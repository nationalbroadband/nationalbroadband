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
							<li class="breadcrumb-active">Payment reports</li>
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
                        <div class="panel-body">
                            <h3>Dear Dealer, We Are Working on this page...</h3>
                            <p>Here is the Dealer payments information and details.</p>
			<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr><td align='center' colspan='9'><font size='+2' color='#006393'>
										<b>Payments Report by Dealer</b></font></td></tr>
                                    </thead>
                                    <tbody>
										<tr><td colspan='2' align='left'><b><font size='-1'>From date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo "2014-09-01"; ?>&nbsp;</font></td>
										<td colspan='2' align='left'><b><font size='-1'>To Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo date("Y-m-d"); ?>&nbsp;</font></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Dealer ID</font></b></td>
										<td colspan='2'><b><font size='-1' color='purple'><?php echo $dealername; ?>&nbsp;</font></b></td>
										<td colspan='2'><b><font size='-1'>Dealer Name</font></b></td>
										<td colspan='2' ><b><font size='-1' color='purple'><?php echo $dealername; ?>&nbsp;&nbsp;&nbsp;</font></b></td></tr>
                                    </tbody>
                                </table>
								
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Receipt. #</th>
                                            <th>Date Time</th>
                                            
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									// results
										$this->db->select('payments.*');
										$this->db->from("payments");
										$this->db->order_by("payment_date","desc");
										
										if($this->session->userdata('DealerPerm')){
											$this->db->join('dealer', 'dealer.Dlrname = payments.customer');
										} else {
											$this->db->where('payments.customer',$this->session->userdata('username'));
										}
										if($this->input->post('UsrCre')){
											$this->db->where('payments.customer',$this->input->post('UsrCre'));
										} else {
											$this->db->where('payments.customer',$this->session->userdata('username'));
										}
										
										//$this->db->where('payments.paid >', '0');
										$query=$this->db->get();
								
											$count = 0;
											foreach ($query->result() as $row) {
												$count++;?> 
												<tr class="odd gradeX">
													<td><?php echo $count; ?></td>
													<td><?php echo $row->Receipt; ?></td>
													<td><?php echo $row->payment_date; ?></td>
													
													<td><?php echo $row->Amount; ?></td>
													<td><?php echo $row->paid; ?></td>
													<td><?php echo $row->Balance; ?></td>
                                                    <td><?php echo $row->Description; ?></td>
												</tr>
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
		