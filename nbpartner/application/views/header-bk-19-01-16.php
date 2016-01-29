<?php defined('BASEPATH') OR exit('No direct script access allowed');

	   if($this->session->userdata('Billing')) {
			//$user_type=$this->session->userdata('DealerPerm');
	   } else {
		 //If no session, redirect to login page
		 redirect('users/login', 'refresh');
	   }

			$query = $this->db->query("SELECT BalLimit,Balance FROM dealer WHERE Dlrname='". $this->session->userdata('username'). "'");
				$SiteConf = $query->row();

					$this->session->set_userdata('DlrLimit',$SiteConf->BalLimit);
					$this->session->set_userdata('DlrBalance',$SiteConf->Balance);
	   
function truncate($input, $maxWords, $maxChars)
{
    $words = preg_split('/\s+/', $input);
    $words = array_slice($words, 0, $maxWords);
    $words = array_reverse($words);

    $chars = 0;
    $truncated = array();

    while(count($words) > 0)
    {
        $fragment = trim(array_pop($words));
        $chars += strlen($fragment);

        if($chars > $maxChars) break;

        $truncated[] = $fragment;
    }

    $result = implode($truncated, ' ');

    return $result . ($input == $result ? '' : '...');
}	?>

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
<link href="<?php echo base_url(); ?>style/newdesign/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>style/newdesign/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>style/newdesign/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>style/newdesign/plugins/bootstrap/css/datepicker.css" rel="stylesheet" type="text/css">
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/newdesign/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link href="<?php echo base_url(); ?>style/newdesign/css/invoice.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url(); ?>style/newdesign/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>style/newdesign/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>style/newdesign/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url(); ?>style/newdesign/css/themes/light.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>style/newdesign/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url(); ?>">
			<img src="<?php echo base_url(),$this->session->userdata('DealerLogo'); ?>" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
								<?php 
      $attributes = array('class' => 'search-form');
      echo form_open('clients/index', $attributes);?>
				<div class="input-group">
					<input type="text" name="username" class="form-control input-sm" placeholder="Search..." name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide">
					</li>
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<li class="separator hide">
					</li>
					<!-- BEGIN Limit/Balance DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="fa fa-dollar"></i>
						<!--<span class="badge badge-danger">
						4 </span> -->
						</a>
						<ul class="dropdown-menu extended tasks">
							<li class="external">
								<h3>Limit: <span class="bold"><?php 	echo $SiteConf->BalLimit; ?></span></h3>
								<a href="#">Used: <?php 	echo $SiteConf->Balance; ?></a>
							</li>
						</ul>
					</li>
					<!-- END Limit/Balance DROPDOWN -->
					<li class="separator hide">
					</li>
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-envelope-open"></i>
						<!--<span class="badge badge-primary">
						3 </span> -->
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3>You have <span class="bold">4</span> Messages</h3>
								<a href="#">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<?php	$query = $this->db->query("SELECT * FROM dbadmin_msgs WHERE Active='1' ORDER BY MsgDate DESC LIMIT 0,8");
												foreach ($query->result() as $row) { ?>
									<li>
										<a href="<?php echo base_url(); ?>welcome/msg/<?php echo $row->Msgaly;	?>">
										<span class="photo">
										<img src="<?php echo base_url(); ?>style/newdesign/img/dbadmin.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										<?php echo $row->MsgBy;	?> </span>
										<span class="time"><?php echo date("d M Y", strtotime($row->MsgDate)); ?> </span>
										</span>
										<span class="message"><?php if(!empty($row->AdminMsg)) {
																		echo truncate($row->AdminMsg, 5, 42)." more..";
																	} else {
																		echo "Click To View Msg..";
																	}?>
													</span>
										</a>
									</li>
							<?php }	?>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						<?php echo $this->session->userdata('username');?> </span>
						<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
						<img alt="" class="img-circle" src="<?php echo base_url(); ?>style/newdesign/img/avatar9.jpg"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
									<li><a href="<?php echo base_url(); ?>welcome/profile"><i class="icon-user"></i>&nbsp;&nbsp;Profile </a></li>
									<li><a href="<?php echo base_url(); ?>welcome/password"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Settings</a></li>
							<li class="divider">
							</li><!--
							<li>
								<a href="#">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>-->
							<li>
								<a href="<?php echo base_url(); ?>users/logout">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="<?php echo (!$this->uri->segment(1) || $this->uri->segment(1)==='welcome')?'active open':''?>">
					<a href="<?php echo base_url(); ?>welcome">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='online')?'active open':''?>">
					<a href="<?php echo base_url(); ?>online">
					<i class="fa fa-cloud"></i>
					<span class="title">Online Users</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='badlogins')?'active open':''?>">
					<a href="<?php echo base_url(); ?>badlogins">
					<i class="fa fa-table"></i>
					<span class="title">Invalid Logins</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='clients')?'active open':''?>">
					<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">Users</span>
					<span class="arrow<?php echo ($this->uri->segment(1)==='clients')?' open':''?>"></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>clients">Users</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>clients/addnew">Add User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>clients/expirylist"> User Expiring</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>clients/userusage">Usage Details</a>
                                </li>
					</ul>
				</li>
<?php if($this->session->userdata('DealerPerm')){?>
				<li class="<?php echo ($this->uri->segment(1)==='dealers')?'active open':''?>">
					<a href="javascript:;">
					<i class="fa fa-sitemap"></i>
					<span class="title">Dealers</span>
					<span class="arrow<?php echo ($this->uri->segment(1)==='dealers')?' open':''?>"></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>dealers">Dealer list</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>dealers/addnew">Add Dealer</a>
                                </li>
					</ul>
				</li>
<?php }; ?>
				<li class="<?php echo ($this->uri->segment(1)==='reports')?'active open':''?>">
					<a href="<?php echo base_url(); ?>reports">
					<i class="fa fa-bar-chart-o"></i>
					<span class="title">Reports</span>
					</a>
				</li>
				<li class="last <?php echo ($this->uri->segment(1)==='payments')?'active open':''?>">
					<a href="javascript:;">
					<i class="fa fa-dollar"></i>
					<span class="title">Payments</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>payments">Dealer Payments</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>payments/getuserpayments"> User Payments</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>payments/addnew">Add User Payment</a>
                                </li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
