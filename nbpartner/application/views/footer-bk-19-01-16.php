<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>style/newdesign/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>style/newdesign/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url(); ?>style/newdesign/plugins/jquery.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url(); ?>style/newdesign/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>style/newdesign/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>style/newdesign/datatables/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>style/newdesign/scripts/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- END CORE PLUGINS -->	
	<script src="<?php echo base_url(); ?>style/newdesign/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/newdesign/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/newdesign/scripts/layout.js" type="text/javascript"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
});
</script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
		
                $('#example1').datepicker({
					weekStart: 2,
					format: "yyyy-mm-dd",
                    startDate: "<?php echo date('Y-m-01', strtotime('-3 months')); ?>",
                    endDate: "<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                });
                $('#example2').datepicker({
					weekStart: 2,
					format: "yyyy-mm-dd",
                    startDate: "<?php echo date('Y-m-01', strtotime('-3 months')); ?>",
                    endDate: "<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                });
				
				$('.example').datepicker({
					weekStart: 2,
					format: "yyyy-mm-dd",
                    startDate: "<?php echo date('Y-m-01', strtotime('-1 months')); ?>",
                    //startDate: "<?php echo date('Y-m-01', strtotime('+1 day')); ?>",
                    endDate: "<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                });
				
				$('.userreport').datepicker({
					weekStart: 2,
					format: "yyyy-mm-dd",
                    //startDate: "<?php echo date('Y-m-01', strtotime('-1 months')); ?>",
                    endDate: "<?php echo date('Y-m-01', strtotime('+1 day')); ?>"
                });
				
                $('.usrusage').datepicker({
					weekStart: 2,
					format: "yyyy-mm-dd",
                    startDate: "<?php echo date('Y-m-01', strtotime('-1 months')); ?>",
                    endDate: "<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                });
				
				
				
				
				////////////////////////////////////
				
				
				
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
					name: 'counts',
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
					name: 'counts',
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
					name: 'counts',
					data: [<?php echo $counter; ?>]
				}]
				});
			});	
    });
    </script>
</body>
<!-- END BODY -->
</html>