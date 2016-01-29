<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Dealer Details</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-user"></i>
							<a href="<?php echo base_url('dealers'); ?>">Dealers</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Dealer Info</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->	
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa"></i>Dealer Details
								</div>
							</div>
							<div class="portlet-body">
			<?php if(empty($post)){?>
							<h1>Requested User Not Found...</h1>
							<p><code>404: ERROR</code> there must be some issue here ... :( </p>
			<?php } else { ?>
                            <h3>Dealer ID: <?php echo $post['Dlrname']; ?></h3>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
										
										<tr>
                                            <th>Name / CNIC#</th>
                                            <td><?php echo $post['DFullName']; ?></td>
                                            <td colspan="2"><?php echo $post['DCNIC']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Phone# / Mobile# / Status</th>
                                            <td><?php if (!empty($post['DPhone'])){
													echo $post['DPhone'];
												} else {
												echo "<code></code>";}?></td>
                                            <td><?php if (!empty($post['DMobile'])){
													echo $post['DMobile'];
												} else {
												echo "<code></code>";}?></td>
                                             <td><?php 
													if ($post['Active']==1){
														echo "Active";
													} else if($post['Active']==0){
														echo "<code>In-Active</code>";
													} else {
														echo "User is Blocked By Managment";
													} ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
											<td class="text-muted" colspan="3"><?php echo $post['DEmail']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['DlrAdd']; ?></td>
                                        </tr>
										<tr>
                                            <th>Sub Dealer Allow / Registered on</th>
                                             <td><?php 
													if ($post['DSub']==1){
														echo "Allowed";
													} else if($post['DSub']==0){
														echo "<code>NotAllowed</code>";
													} ?>
											 </td>
                                             <td colspan="2"><?php echo date("j-m-Y, g:i a", strtotime($post["CDate"])); ?></td>
                                        </tr>
										<tr>
                                        <tr>
                                            <th>ClearPort / Change Password</th>
                                            <td><a href="<?php echo base_url(); ?>dealers/DealerPortChng/<?php echo $post['Dlrname']; ?>">Clear Binded Ports</a></td>
                                            <td>Click <a href="<?php echo base_url(); ?>dealers/dealerChange/<?php echo $post['Dlrname']; ?>">Change</a> Password</td>
                                        </tr>
                                            <th>Limit / Used</th>
										<?php if($this->session->userdata('user_type')=="user"){ ?>
                                             <td colspan="2"><?php echo $post["BalLimit"]; ?></td>
										<?php } else {?>
                                             <td colspan="2"><?php echo $post["BalLimit"]; ?> <a href="<?php echo base_url(); ?>payments/addnew/<?php echo $post['Dlrname']; ?>">Make Payment</a></td>
										<?php }?>
                                             <td colspan="2"><?php echo $post["Balance"]; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <div class="well">
                                <h4>Comments</h4>
                                <p><?php echo $post["Remarks"]; ?></p>
                                <!--<a class="btn btn-default btn-lg btn-block" target="_blank" href="#">View Documentation</a>-->
                            </div>
                            </div>
			<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Active Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Dealer Name</th>
                                            <th>Package</th>
                                            <th># of Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($users)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($users as $row){
											$count++;
											?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['creator']; ?></td>
													<td><?php echo $row['Package']; ?></td>
													<td><?php echo $row['TotalUsers']; ?></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Latest payments
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Dealer Name</th>
                                            <th>Date</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if(!isset($payment)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											$count = 0;
											foreach($payment as $row){
											$count++;
											?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['customer']; ?></td>
													<td><?php echo date("j-m-Y", strtotime($row["payment_date"])); ?></td>
													<td><?php echo $row['paid']; ?></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
<?php if($this->session->userdata('user_type')=="user"){ 

	//Non
 
 } else {?>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>

    <script>
jQuery.noConflict();
(function( $ ) {
$(function() {
// More code using $ as alias to jQuery
 
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
 
        $( "#dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height:140,
            modal: true,
            hide: 'Slide',
            buttons: {
                "Delete": function() {
                    var del_id = {id : $("#del_id").val(),<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'};
                    $.ajax({
                        type: "POST",
                        url : "<?php echo site_url('dealers/delete/'.$post['Dlrname'].'')?>",
                        data: del_id,
                        success: function(msg){
                            $('#show').html(msg);
                            $('#dialog-confirm' ).dialog( "close" );
                            //$( ".selector" ).dialog( "option", "hide", 'slide' );
                        }
                    });
 
                    },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
 
        $( "#form_input" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: false,
            hide: 'Slide',
            buttons: {
                "Add": function() {
                    var form_data = {
                        id: $('#id').val(),
                        date: $('#date').val(),
                        name: $('#name').val(),
                        amount: $('#amount').val(),
						<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                        ajax:1
                    };
 
                    $('#date').attr("disabled",true);
                    $('#name').attr("disabled",true);
                    $('#amount').attr("disabled",true);
 
                  $.ajax({
                    url : "<?php echo site_url('dealers/submit/'.$post['Dlrname'].'')?>",
                    type : 'POST',
                    data : form_data,
                    success: function(msg){
                    $('#show').html(msg),
                    $('#date').val('<?php echo $post['Dlrname']; ?>'),
                    $('#id').val(''),
                    $('#name').val(''),
                    $('#amount').val(''),
                    $('#date').attr("disabled",false);
                    $('#name').attr("disabled",false);
                    $('#amount').attr("disabled",false);
                    $( '#form_input' ).dialog( "close" )
                    }
                  });
 
            },
                Cancel: function() {
                    $('#id').val(''),
                    $('#name').val('');
                    $('#amount').val('');
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                $('#id').val(''),
                $('#name').val('');
                $('#amount').val('');
            }
        });
 
    $( "#create-daily" )
            .button()
            .click(function() {
                $( "#form_input" ).dialog( "open" );
            });	
});

 
    $(".edit").live("click",function(){
        var id = $(this).attr("id");
        var date = $(this).attr("date");
        var name = $(this).attr("name");
        var amount = $(this).attr("amount");
 
        $('#id').val(id);
        $('#date').val(date);
        $('#name').val(name);
        $('#amount').val(amount);
 
        $( "#form_input" ).dialog( "open" );
 
        return false;
    });
 
    $(".delbutton").live("click",function(){
        var element = $(this);
        var del_id = element.attr("id");
        var info = 'id=' + del_id;
        $('#del_id').val(del_id);
        $( "#dialog-confirm" ).dialog( "open" );
 
        return false;
    });
})(jQuery);
    </script>
 
<div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dealer Packages & Rates
                        </div>
    <div id="show">
        <?php $this->load->view('daily/show'); ?>
    </div>
    <p>
        <button id="create-daily">Add Package</button>
    </p>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
<div id="form_input">
      <table>
        <?php echo form_open('dealers/submit'); ?>
        <input type="hidden" value='' id="id" name="id">
        <tr >
            <td> <?php echo form_label('DealerID : '); ?></td>
            <td> <?php echo form_input('date',$post['Dlrname'],'id="date"'); ?></td>
        </tr>
		<tr>
            <td> <label>Package : </label> </td>
            <td> <select id="name" name="name" >
						<option value="" selected="selected">Select Package</option>
						<?php $result = mysql_query("SELECT * FROM package");
								while ($cat = mysql_fetch_assoc($result)) {
						
						?>		
						<option value="<?php echo $cat['listname']; ?>"><?php echo $cat['listname']; ?></option>
						<?php 
						}
						?>
						</select></td>
        </tr><!--
        <tr>
            <td> <?php echo form_label('Package : ');?> </td>
            <td> <?php echo form_input('name','','id="name"'); ?></td>
        </tr>-->
        <tr>
            <td> <?php echo form_label('Amount : ');?> </td>
            <td> <?php echo form_input('amount','','id="amount"'); ?></td>
        </tr>
      </table>
    </div>
 
    <div id="dialog-confirm" title="Delete Item ?">
    <p>
        <input type="hidden" value='' id="del_id" name="del_id">
                <span class="ui-icon ui-icon-alert"></span> Are you sure?
</div>
<?php }?>

							
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
		