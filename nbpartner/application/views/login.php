<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Billing System</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>files/style/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->


</head>

<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<!-- Form -->
      <?php 
      $attributes = array('class' => 'login-form');
      echo form_open('users/login', $attributes);?>
		<h3 class="form-title">Login</h3>
			<?php if($error==1){?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>Invalid Username or Password</span>
		</div>
			<?php }?>
            <?php if($error==2){?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>Invalid Captcha</span>
		</div>
			<?php }?>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<div class="row">
                <div class="col-xs-12">
                  <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" name="username" value="<?php isset($username)?print $username: ""; ?>" class="form-control" placeholder="Username">
                  </div>
                </div>
			</div> 
                                      
		</div>
        
		<div class="form-group">
            
            <div class="row">
              <div class="col-xs-12">
                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" name="password" value="<?php isset($password)?print $password: ""; ?>" class="form-control" placeholder="Password">
                </div>
              </div>
            </div>
		</div>
		
		<div class="form-group">
            
            <div class="row">
			    <div id="captcha-wrap">
					<div class="captcha-box">
						<img src="" class="captcha" >
					</div>
					<div class="text-box">
						<label>Type the two words:</label>
						<input name="captcha" type="text" id="captcha-code">
					</div>
					<div class="captcha-action">
						<img src="<?php print base_url(); ?>files/images/refresh.jpg"  alt="" id="captcha-refresh" />
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-actions">
			<input type="submit" value="Login" class="btn btn-success btn-block">
		</div>
	</form>
	<!-- END LOGIN FORM -->
	
</div>


<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>files/style/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>files/style/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url(); ?>files/style/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>files/style/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script>
$(document).ready(function() { 
change_captcha();

 // refresh captcha
 $('img#captcha-refresh').click(function() {  
		
		change_captcha();
 });
 
 function change_captcha()
 {
	 $.ajax({
		url: "<?php print base_url(); ?>users/refresh_captcha",
		type: 'get',
		success: function (data) {
			data = JSON.parse(data);
			$('.captcha').attr('src',"../"+data.count);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
		 console.log(errorThrown);
		}
	});
 }
 
});
 	
</script>
</body>

</html>
