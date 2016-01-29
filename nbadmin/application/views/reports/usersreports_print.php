<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Billing System</title>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
	<!-- END PAGE LEVEL STYLES -->
	
</head>

<body>
<?php if($this->session->userdata('dNtAdmin')){
	$user_type=$this->session->userdata('user_type');
 } else { 
	
	header("Location: " . base_url(). "users/login");
	
	} ?>
     <div id="wrapper">
			<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr><td align='center' colspan='9'><h1 style="font-size:20px; font-weight:400; color:#2a2f43";>Units Consumption by Dealer-Date Wise</h1></td></tr>
                                    </thead>
                                    <tbody>
										<tr><td colspan='2' align='left'><b><font size='-1'>From Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo $DateStart; ?>&nbsp;</font></td>
										<td colspan='2' align='left'><b><font size='-1'>To Date</font></b></td>
										<td colspan='2'><font size='-1'><?php echo $DateEnd; ?>&nbsp;</font></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Name</font></b></td>
										<td colspan='2'><b><font size='-1' color='purple'><?php echo $dealer['Dlrname']; ?>&nbsp;</font></b></td>
										<td colspan='2'><b><font size='-1'>Dealer's Name</font></b></td>
										<td colspan='2' ><b><font size='-1' color='purple'><?php echo $dealer['DFullName']; ?>&nbsp;&nbsp;&nbsp;</font></b></td></tr>
										<tr><td colspan='2' ><b><font size='-1'>Net Payable</font></b></td>
										<td colspan='2' ><font size='-1'><?php echo $Total['DUAmount']; ?>.0&nbsp;</font></td>
										<td colspan='2' ><b><font size='-1'>Tax Amount</font></b></td>
										<td colspan='2' ><font size='-1'><?php echo $Total['TaxAmount']; ?>.0&nbsp;</font></td></tr>
                                    </tbody>
                                </table>
								
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr. #</th>
                                            <th>Date Time</th>
                                            <th>UserID</th>
                                            <th>Package Name</th>
                                            <th>Total Units</th>
                                            <th>Price Per Unit</th>
                                            <th>Amount</th>
                                            <th>Per Unit Tax</th>
                                            <th>Total Tax Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<p> <code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($posts as $row){
											$count++;?>
												<tr class="odd gradeX">
													<td><?php echo $count; ?></td>
													<td><?php echo $row['order_date']; ?></td>
													<td><?php echo $row['user_id']; ?></td>
													<td><?php echo $row['product_id']; ?></td>
													<td><?php echo $row['DUcount']; ?></td>
													<td><?php echo $row['price']; ?></td>
													<td><?php echo $row['DUAmount']; ?></td>
													<td><?php echo $row['product_tax']; ?></td>
													<td><?php echo $row['TaxAmount']; ?></td>
												</tr>
								<?php }?>
										<tr><td align="right" colspan="2">&nbsp;</td><td colspan="2">Total Users <?php echo $count; ?>&nbsp;</td><td colspan="2">&nbsp;</td><td colspan="2">Total Amount: &nbsp;<?php echo $Total['DUAmount']; ?></td><td colspan="2">Total Tax: &nbsp;<?php echo $Total['TaxAmount']; ?></td></tr>
                                    </tbody>
                                </table>
							<?php //echo $pagelink;
								}?>

                            </div>
<?php //echo $pagelink; ?>
		

    <!-- DataTables JavaScript -->
	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>


</body>

</html>
