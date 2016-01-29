
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>files/theme/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>files/theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>files/theme/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>files/theme/dist/js/sb-admin-2.js"></script>

	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script type="text/javascript" src="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->

<script>
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
</script>
</body>

</html>