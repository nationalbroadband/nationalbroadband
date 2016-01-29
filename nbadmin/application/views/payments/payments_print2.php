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
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>files/style/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>files/style/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/select2/select2.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
	<!-- END PAGE LEVEL STYLES -->

	<link id="style_color" href="<?php echo base_url(); ?>files/style/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	
</head>

<body>
<?php if($this->session->userdata('dNtHeaD')){
	$user_type=$this->session->userdata('user_type');
 } else { 
	
	header("Location: " . base_url(). "users/login");
	
	} 
	
function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
}?>
<div class="container">
    
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
						  <div class="row"><center> <h3>company name</h3>
									<h4>Receiving Voucher</h4></center>
							<div class="col-xs-5">
								<div class="panel-heading">
									<h3>Dealer Name: <?php echo $post['customer']; ?></h3>
									<p>Date: <?php echo $post['payment_date']; ?></p>
								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-2 text-right">
								<div class="panel-heading">
								  <h3>Office Copy</h3>
									<p>Receipt#: <?php echo $post['Receipt']; ?></p>
								</div>
							</div>
						  </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
										<tr>
										   <th colspan="1">Particular</th>
											<th colspan="4">Amount</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="1">Receivable</td>
                                            <td colspan="4"><?php echo $post['Amount']; ?></td>
                                        </tr>
										<?php if(!empty($post['Discount'])) { ?>
                                        <tr>
                                            <td>Discount</td>
                                            <td colspan="4"><?php echo $post['Discount']; ?></td>
                                        </tr>
										<?php } ?>
                                        <tr>
                                            <td>Paid Amount</td>
                                            <td colspan="4"><?php echo $post['paid']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td colspan="4"><?php echo $post['Balance']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount In Words:</td>
                                            <td colspan="4"><?php echo convert_number($post['paid']); ?> Only..</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">Payment Method: </td>
                                            <td colspan="1"><span class="glyphicon glyphicon-check"></span> Cash <span class="glyphicon glyphicon-unchecked"></span> Cheque </td>
                                            <td colspan="2">Cheque#: </td>
                                            <td colspan="1"><span class="glyphicon glyphicon-unchecked"></span> Online </td>
                                        </tr><!--
                                        <tr>
                                            <td colspan="5"><?php echo $post['Description']; ?>..</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                            <p><center>This is a system generated invoice and does not require any signatures.</center></p>
						<?php
							}
						?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
						  <div class="row">
						  <center> <h3>company name</h3>
									<h4>Receiving Voucher</h4></center>
							<div class="col-xs-5">
								<div class="panel-heading">
									<h3>Dealer Name: <?php echo $post['customer']; ?></h3>
									<p>Date: <?php echo $post['payment_date']; ?></p>
								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-2 text-right">
								<div class="panel-heading">
								  <h3>Customer Copy</h3>
								  <p>Receipt#: <?php echo $post['Receipt']; ?></p>
								</div>
							</div>
						  </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
										<tr>
										   <th>Particular</th>
											<th colspan="3">Amount</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Receivable</td>
                                            <td colspan="3"><?php echo $post['Amount']; ?></td>
                                        </tr>
										<?php if(!empty($post['Discount'])) { ?>
                                        <tr>
                                            <td>Discount</td>
                                            <td colspan="3"><?php echo $post['Discount']; ?></td>
                                        </tr>
										<?php } ?>
                                        <tr>
                                            <td>Paid Amount</td>
                                            <td colspan="3"><?php echo $post['paid']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td colspan="3"><?php echo $post['Balance']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount In Words:</td>
                                            <td colspan="3"><?php echo convert_number($post['paid']); ?> Only..</td>
                                        </tr><!--
                                        <tr>
                                            <td colspan="4"><?php echo $post['Description']; ?>..</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                            <p><center>This is a system generated invoice and does not require any signatures.</center></p>
						<?php
							}
						?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
		<div class="pagebreakhere">	</div>
		</br>
		<!-- /.print-break -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
						  <div class="row"><center> <h3>company</h3>
									<h4>Receiving Voucher</h4></center>
							<div class="col-xs-5">
								<div class="panel-heading">
									<h3>Dealer Name: <?php echo $post['customer']; ?></h3>
									<p>Date: <?php echo $post['payment_date']; ?></p>
								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-2 text-right">
								<div class="panel-heading">
								  <h3>Accounts Copy</h3>
									<p>Receipt#: <?php echo $post['Receipt']; ?></p>
								</div>
							</div>
						  </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
										<tr>
										   <th>Particular</th>
											<th colspan="3">Amount</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Receivable</td>
                                            <td colspan="3"><?php echo $post['Amount']; ?></td>
                                        </tr>
										<?php if(!empty($post['Discount'])) { ?>
                                        <tr>
                                            <td>Discount</td>
                                            <td colspan="3"><?php echo $post['Discount']; ?></td>
                                        </tr>
										<?php } ?>
                                        <tr>
                                            <td>Paid Amount</td>
                                            <td colspan="3"><?php echo $post['paid']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td colspan="3"><?php echo $post['Balance']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount In Words:</td>
                                            <td colspan="3"><?php echo convert_number($post['paid']); ?> Only..</td>
                                        </tr><!--
                                        <tr>
                                            <td colspan="4"><?php echo $post['Description']; ?>..</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                            <p><center>This is a system generated invoice and does not require any signatures.</center></p>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

</body>

</html>
