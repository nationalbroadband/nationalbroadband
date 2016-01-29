	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
	<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>files/style/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>files/style/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- <script src="<?php echo base_url(); ?>files/style/global/plugins/jquery.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>files/style/global/sidebar-menu/jquery-1.11.3.min.js"></script>

<script src="<?php echo base_url(); ?>files/style/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url(); ?>files/style/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>files/style/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>files/style/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>files/style/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>files/style/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>files/style/admin/pages/scripts/table-advanced.js"></script>
<script src="<?php echo base_url(); ?>files/style/admin/pages/scripts/components-pickers.js"></script>



<!-- -------------- jQuery -------------- -->

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url(); ?>files/style/global/sidebar-menu/utility.js"></script>
<script src="<?php echo base_url(); ?>files/style/global/sidebar-menu/demo.js"></script>
<script src="<?php echo base_url(); ?>files/style/global/sidebar-menu/main.js"></script>

<!-- -------------- Widget JS -------------- -->
<script src="<?php echo base_url(); ?>files/style/global/sidebar-menu/dashboard1.js"></script>
<!-- -------------- /Scripts -------------- -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
jQuery(document).ready(function() {       
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	ComponentsPickers.init();
   TableAdvanced.init();
   
   /* charts begin */
				$(function () {
				$('#containerActiveUsers').highcharts({chart: {
					type: 'column'
				},
				title: {
					text: ''
				},
				xAxis: {
					<?php
						$dealers = '';
						$allCounts = '';
						if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT users.creator,COUNT(users.Username) AS UCount FROM users,dealer WHERE dealer.Dlrname=users.creator AND (users.creator='". $this->session->userdata('username'). "' OR dealer.creator='". $this->session->userdata('username'). "') AND users.Active='1' GROUP BY users.creator");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS UCount,creator FROM users WHERE creator='". $this->session->userdata('username'). "' AND Active='1'");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												
												$dealers .= "'".$row->creator."',";
												$allCounts .= $row->UCount.",";
											}
						 ?>
					categories: [<?php echo $dealers; ?>]
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},  
				series: [{
					name: 'Dealers',
					maxPointWidth: 50,
					data: [<?php echo $allCounts; ?>]
				}]
				});
			});
			
			//////////////////////////////////////////
			
			$(function () {
				$('#containerUserCounts').highcharts({ chart: {
					type: 'column'
				},
				title: {
					text: ''
				},
				xAxis: {
					<?php
						$packages = '';
						$totalUsers = '';
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(Username) AS UCount, pname AS Package FROM users INNER JOIN dealer ON dealer.Dlrname=users.creator INNER JOIN package ON users.Package=package.listname WHERE users.Active='1' AND dealer.creator='".$this->session->userdata('username')."' GROUP BY Package");
										} else {
											$query = $this->db->query("SELECT COUNT(Username) AS UCount, pname AS Package FROM users INNER JOIN package ON users.Package=package.listname WHERE users.Active='1' AND users.creator='".$this->session->userdata('username')."' GROUP BY Package");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												$packages .= "'".$row->Package."',";
												$totalUsers.= $row->UCount.",";
											}
									?>
					categories: [<?php echo $packages; ?>]
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},  
				series: [{
					name: 'Packages',
					maxPointWidth: 50,
					data: [<?php echo $totalUsers; ?>]
				}]
				});
			});
			
			
		//////////////////////////////
		$(function () {
				$('#containerOnlineUsers').highcharts({ chart: {
					type: 'column'
				},
				title: {
					text: ''
				},
				xAxis: {
					<?php
						$dealer = '';
						$counter = '';
										if($this->session->userdata('DealerPerm')){
											$query = $this->db->query("SELECT COUNT(username) AS UCount, radacct.creator FROM radacct INNER JOIN dealer ON dealer.Dlrname=radacct.creator WHERE acctstoptime IS NULL AND dealer.creator='".$this->session->userdata('username')."' GROUP BY creator");
										} else {
											$query = $this->db->query("SELECT COUNT(username) AS UCount, creator FROM radacct WHERE acctstoptime IS NULL AND creator='".$this->session->userdata('username')."'");
										}
											$count = 0;
											foreach ($query->result() as $row) {
												$dealer .= "'".$row->creator."'";
												$counter .= $row->UCount.",";
											}
									?>
					categories: [<?php echo $dealer; ?>]
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},  
				series: [{
					name: 'Dealers',
					maxPointWidth: 50,
					data: [<?php echo $counter; ?>]
				}]
				});
			});	
   /* charts end */
   
});


	////////////////////
	$('#stDate1').datepicker().on('changeDate', function (ev) {
    	checkInputSearch1();
		});
		
	$('#endDate1').datepicker().on('changeDate', function (ev) {
    	checkInputSearch1();
		});
		
		
	function checkInputSearch1(){
		var stDate1 = $('#stDate1').val();
		var endDate1 = $('#endDate1').val();
		var dealer1 = $('#dealer1').val();
		if(stDate1!='' && endDate1!='' && dealer1!=''){
			$('#searchBtn1').removeAttr("disabled","disabled");
			}else{
				$('#searchBtn1').attr("disabled","disabled");
				}
		}	
	/////////////////////
	
	
	
	
	
	
	
	
	////////////////////
	$('#stDate2').datepicker().on('changeDate', function (ev) {
    	checkInputSearch2();
		});
		
	$('#endDate2').datepicker().on('changeDate', function (ev) {
    	checkInputSearch2();
		});
		
		
	function checkInputSearch2(){
		var stDate2 = $('#stDate2').val();
		var endDate1 = $('#endDate2').val();
		var dealer2 = $('#dealer2').val();
		if(stDate2!='' && endDate2!='' && dealer2!=''){
			$('#searchBtn2').removeAttr("disabled","disabled");
			}else{
				$('#searchBtn2').attr("disabled","disabled");
				}
		}	
	/////////////////////
	
	
	
	
	
	
	////////////////////
	$('#stDate3').datepicker().on('changeDate', function (ev) {
    	checkInputSearch3();
		});
		
	$('#endDate3').datepicker().on('changeDate', function (ev) {
    	checkInputSearch3();
		});
		
		
	function checkInputSearch3(){
		var stDate3 = $('#stDate3').val();
		var endDate3 = $('#endDate3').val();
		var dealer3 = $('#dealer3').val();
		if(stDate3!='' && endDate3!='' && dealer3!=''){
			$('#searchBtn3').removeAttr("disabled","disabled");
			}else{
				$('#searchBtn3').attr("disabled","disabled");
				}
		}	
	/////////////////////
	

/*function checkDealerMatchPaswrd(){
	   var password = $('password').val();
	   var Cpassword = $('Cpassword').val();
	   if(password!=Cpassword){
		   $('#dealerPasswordError').show();
		   }else{
			   $('#dealerPasswordError').hide();
			   }
	   }*/
</script>
</body>
<!-- END BODY -->
</html>
