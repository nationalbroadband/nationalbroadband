<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
	$(".edit_tr").click(function()
	{
		var ID=$(this).attr('id');
		$("#first_"+ID).hide();
		$("#last_"+ID).hide();
		$("#first_input_"+ID).show();
		$("#last_input_"+ID).show();
		}).change(function()
		{
		var ID=$(this).attr('id');
		var first=$("#first_input_"+ID).val();
		var last=$("#last_input_"+ID).val();
		var dataString = 'id='+ ID +'&firstname='+first+'&lastname='+last;
		$("#first_"+ID).html('<img src="<?php echo base_url().'style/images/';?>load.gif" />');


		if(first.length && last.length>0)
		{
		$.ajax({
		type: "POST",
		url: "<?php echo base_url().'dealers/dealerpkgchng/';?>",
		data: dataString,
		cache: false,
		success: function(html)
		{

		$("#first_"+ID).html(first);
		$("#last_"+ID).html(last);
		}
		});
		}
		else
		{
		alert('Enter something.');
		}

		});

		$(".editbox").mouseup(function() 
		{
		return false
		});

		$(document).mouseup(function()
		{
		$(".editbox").hide();
		$(".text").show();
		});

	});
</script>
<style>
.editbox
{
display:none
}
td
{
padding:7px;
}
.editbox
{
font-size:14px;
width:270px;
background-color:#ffffcc;

border:solid 1px #000;
padding:4px;
}
.edit_tr:hover
{
background:url(edit.png) right no-repeat #80C8E5;
cursor:pointer;
}


th
{
font-weight:bold;
text-align:left;
padding:4px;
}
.head
{
background-color:#333;
color:#FFFFFF

}

</style>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Customer Information...</h1>
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
                            <h3>Dealer ID: <?php echo $post['Dlrname']; ?></h3>
                            <p>Here is the Dealer account information and personal details.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
										<tr>
                                            <th>UserID</th>
                                            <td colspan="2"><?php echo $post['Dlrname']; ?></td>
                                            <td>Click <a href="<?php echo base_url(); ?>dealers/dealerChange/<?php echo $post['Dlrname']; ?>">Change</a> Password</td>
                                        </tr>
										<tr>
                                            <th>Name / CNIC#</th>
                                            <td><?php echo $post['DFullName']; ?></td>
                                            <td colspan="2"><?php echo $post['DCNIC']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td colspan="3"><?php echo $post['DlrAdd']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone/Mobile#/Status</th>
                                            <td><?php if (!empty($post['DPhone'])){
													echo $post['DPhone'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                            <td><?php if (!empty($post['DMobile'])){
													echo $post['DMobile'];
												} else {
												echo "<code>NiL</code>";}?></td>
                                             <td><?php 
													if ($post['Active']==1){
														echo "Active";
													} else if($post['Active']==0){
														echo "<code>DeActive</code>";
													} else {
														echo "User is Blocked By Managment";
													} ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
											<td class="text-muted" colspan="3"><?php echo $post['DEmail']; ?></td>
                                        </tr>
										<tr>
                                            <th>SubDlr/ Register on</th>
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
                                            <th>Limit/ Used</th>
                                             <td colspan="2"><?php echo $post["BalLimit"]; ?></td>
                                             <td colspan="2"><?php echo $post["Balance"]; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>
							<table width="100%">
							<tr class="head">
							<th>First Name</th><th>Last Name</th>
							</tr>
						<?php if(!isset($packages)){?>
								<p><?php echo $row['Description']; ?> <code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
						<?php } else {
							foreach($packages as $row){
								$id=$row['id'];
								$firstname=$row['listname'];
								$lastname=$row['price'];
							$i="0";
							if($i%2){?>
							<tr id="<?php echo $id; ?>" class="edit_tr">
							<?php } else { ?>
							<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
							<?php } ?>
							<td width="50%" class="edit_td">
							<span id="first_<?php echo $id; ?>" class="text"><?php echo $firstname; ?></span>
							<input type="text" value="<?php echo $firstname; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
							</td>
							<td width="50%" class="edit_td">
							<span id="last_<?php echo $id; ?>" class="text"><?php echo $lastname; ?></span> 
							<input type="text" value="<?php echo $lastname; ?>"  class="editbox" id="last_input_<?php echo $id; ?>"/>
							</td>
							</tr>
							<?php $i++; }
							}?>

							</table></p>
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
		