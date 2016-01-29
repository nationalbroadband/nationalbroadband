<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Billing System</title>
<style type="text/css">

* { margin: 0; padding: 0; }
body {  }
#page-wrap {     background: none repeat scroll 0 0 #FFFFFF;
    box-shadow: 0 -1px 3px 0 #666666;
    margin: 0 auto;
    min-height: 1100px;
    overflow: auto;
    padding: 40px 33px 0 35px;
    width: 730px;}

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header { height: 15px; width: 100%; margin: 20px 0; text-align: center; color: black; font: bold 25px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 5px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#invoicedetails { width: 300px; height: 80px; float: right; font: bold 12px Helvetica, Sans-Serif; }
#invoicedetails td { border: 0; }
#invoicedetails table td, table th { padding: 0px; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #D8D7D7; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }

.left{
float: left;
}

.right{
float: right;
}

.clear{
clear: both;
}

#meta { margin-top: 1px; width: 350px; }
#meta td { text-align: left;  font: bold 10px Helvetica, Sans-Serif; }
#meta td.meta-head { text-align: left; background: #D8D7D7; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; font: 13px Helvetica, Sans-Serif;  }
#items th { background: #D8D7D7; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #D8D7D7; }
#items td.blank { border: 0; }


#itemssmall { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; font: bold 9px Helvetica, Sans-Serif;  }
#itemssmall th { background: #D8D7D7; font: bold 10px Helvetica, Sans-Serif;}
#itemssmall textarea { width: 80px; height: 50px; }
#itemssmall tr.item-row td { border: 0; vertical-align: top; }
#itemssmall td.description { width: 300px; }
#itemssmall td.item-name { width: 175px; }
#itemssmall td.description textarea, #itemssmall td.item-name textarea { width: 100%; }
#itemssmall td.total-line { border-right: 0; }
#itemssmall td.total-value { border-left: 0; padding: 10px; }
#itemssmall td.total-value textarea { height: 20px; background: none; }
#itemssmall td.balance { background: #D8D7D7; }
#itemssmall td.blank { border: 0; }

#terms {
	width: 810px;
    bottom: 0;
    position: absolute; margin: 20px 0 0 0; }
/*#terms { text-align: center; margin: 20px 0 0 0; } */
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; text-align: center; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }

</style>
</head>

<body>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
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
} ?>
	<div id="page-wrap">
    
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
							<div class="col-xs-5 left">
								<div class="panel-heading">
									<h3>Dealer Name: <?php echo $post['customer']; ?></h3>
									<p>Date: <?php echo $post['payment_date']; ?></p>
								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-2 right">
								<div class="panel-heading">
								  <h3>Office Copy</h3>
									<p>Receipt#: <?php echo $post['Receipt']; ?></p>
								</div>
							</div>
						  </div>
                            <div class="clear"></div>
                            <div class="table-responsive">
                                <table id="items">
                                    <thead>
										<tr>
										   <td class="balance" colspan="1">Particular</td>
											<td class="balance" colspan="4">Amount</td>
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
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Cash"){ ?>
													<span class="glyphicon glyphicon-check"></span><?php } else { ?>
													<span class="glyphicon glyphicon-unchecked"></span>
													<?php } ?> Cash </center></td>
                                            <td colspan="2"><?php if ($post['PaymentType']=="Cheque"){ ?>
													<span class="glyphicon glyphicon-check"></span> Cheque, Cheque#: <?php echo $post['ChequeNo']; ?> <?php } else { ?>
													<center><span class="glyphicon glyphicon-unchecked"></span> Cheque </center>
													<?php } ?></td>
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Online"){ ?>
													<span class="glyphicon glyphicon-check"></span><?php } else { ?>
													<span class="glyphicon glyphicon-unchecked"></span>
													<?php } ?> Online </center></td>
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
		
		<div class="spacer"></div>
		
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
							<div class="col-xs-5 left">
								<div class="panel-heading">
									<h3>Dealer Name: <?php echo $post['customer']; ?></h3>
									<p>Date: <?php echo $post['payment_date']; ?></p>
								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-2 right">
								<div class="panel-heading">
								  <h3>Customer Copy</h3>
								  <p>Receipt#: <?php echo $post['Receipt']; ?></p>
								</div>
							</div>
						  </div>
						  <div class="clear"></div>
                            <div class="table-responsive">
                                <table id="items">
                                    <thead>
										<tr>
										   <td class="balance" colspan="1">Particular</td>
											<td class="balance" colspan="4">Amount</td>
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
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Cash"){ ?>
													<span class="glyphicon glyphicon-check"></span><?php } else { ?>
													<span class="glyphicon glyphicon-unchecked"></span>
													<?php } ?> Cash </center></td>
                                            <td colspan="2"><?php if ($post['PaymentType']=="Cheque"){ ?>
													<span class="glyphicon glyphicon-check"></span> Cheque, Cheque#: <?php echo $post['ChequeNo']; ?> <?php } else { ?>
													<center><span class="glyphicon glyphicon-unchecked"></span> Cheque </center>
													<?php } ?></td>
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Online"){ ?>
													<span class="glyphicon glyphicon-check"></span><?php } else { ?>
													<span class="glyphicon glyphicon-unchecked"></span>
													<?php } ?> Online </center></td>
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
			<!-- Print Break ->
		<div class="pagebreakhere">	</div>
		</br> -->
		<div class="spacer"></div>
		<!-- /.print-break -->
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
								<div class="panel-heading left">
									<h3>Dealer Name: <?php echo $post['customer']; ?></h3>
									<p>Date: <?php echo $post['payment_date']; ?></p>
								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-2 right">
								<div class="panel-heading">
								  <h3>Accounts Copy</h3>
									<p>Receipt#: <?php echo $post['Receipt']; ?></p>
								</div>
							</div>
						  </div>
						  <div class="clear"></div>
                            <div class="table-responsive">
                                <table id="items">
                                    <thead>
										<tr>
										   <td class="balance" colspan="1">Particular</td>
											<td class="balance" colspan="4">Amount</td>
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
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Cash"){ ?>
													<span class="glyphicon glyphicon-check"></span><?php } else { ?>
													<span class="glyphicon glyphicon-unchecked"></span>
													<?php } ?> Cash </center></td>
                                            <td colspan="2"><?php if ($post['PaymentType']=="Cheque"){ ?>
													<span class="glyphicon glyphicon-check"></span> Cheque, Cheque#: <?php echo $post['ChequeNo']; ?> <?php } else { ?>
													<center><span class="glyphicon glyphicon-unchecked"></span> Cheque </center>
													<?php } ?></td>
                                            <td colspan="1"><center><?php if ($post['PaymentType']=="Online"){ ?>
													<span class="glyphicon glyphicon-check"></span><?php } else { ?>
													<span class="glyphicon glyphicon-unchecked"></span>
													<?php } ?> Online </center></td>
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
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

</body>

</html>
