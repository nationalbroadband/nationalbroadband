<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <div id="page-wrapper">
            
            	<!--<header class="alt" id="topbar">
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
								<a href="javascript:void(0)">Payments</a>
							</li>
							<li class="breadcrumb-active">Payment Details</li>
						</ol>
					</div>
				</header>-->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
			<?php if(empty($post)){?>
							<h1>Requested Page Not Found... </h1>
							<p><code><b>PANGA: </b> bhai koi masla hay is link mai ... :( </code></p>
			<?php } else { 
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
}
			?>
<div class="row">
						  <center> <h3>Cybernet Internet Services (Pvt) Ltd.</h3>
									<h4>Receiving Voucher</h4></center>
							<div class="col-xs-5">
								<div class="panel-heading">
									<h3>Dealer ID: <?php echo $post['customer']; ?></h3>
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
                                            <td colspan="1">Receivable Amount</td>
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
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Cash"){ ?>
													<span class="fa fa-check"></span><?php } else { ?>
													<span class="fa fa-unchecked"></span>
													<?php } ?> Cash </center></td>
                                            <td colspan="2"><?php if ($post['PaymentType']=="Cheque"){ ?>
													<span class="fa fa-check"></span> Cheque, Cheque#: <?php echo $post['ChequeNo']; ?> <?php } else { ?>
													<center><span class="fa fa-unchecked"></span> Cheque </center>
													<?php } ?></td>
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Online"){ ?>
													<span class="fa fa-check"></span><?php } else { ?>
													<span class="fa fa-unchecked"></span>
													<?php } ?> Online </center></td>
                                        </tr><!--
                                        <tr>
                                            <td colspan="5"><?php echo $post['Description']; ?>..</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                            <p><center>This is system generated invoice and does not require any stamp or signature</center></p>
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
		