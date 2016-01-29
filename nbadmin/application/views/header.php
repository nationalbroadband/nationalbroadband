<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	  if($this->session->userdata('dNtAdmin')) {
			//$user_type=$this->session->userdata('DealerPerm');
	   } else {
        $this->load->helper('url');
        $this->session->set_userdata('last_page', current_url());
		 //If no session, redirect to login page
		 redirect('users/login');
		 //redirect('users/login', 'refresh');
	   }
/* 
    if($this->session->userdata('dNtAdmin')!=TRUE) {
        $this->load->helper('url');
        $this->session->set_userdata('last_page', current_url());
        redirect('users/login');
    }
*/
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
<meta name="generator" content="Codeply">
<meta content="StyleOfGlobal" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>files/style/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>files/style/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>files/style/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>files/style/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>files/style/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url(); ?>files/style/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>files/style/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>files/style/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url(); ?>files/style/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>files/style/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->

<?php if (!empty($base_url)) {?>
        <script type="text/javascript">
            function show(offset)
            {
                //alert("<?php echo $base_url;?>"+offset);
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("postlist").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","<?php echo $base_url;?>" + offset,true);
                xmlhttp.send();
            }
        </script> 
<?php }?>

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
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url(); ?>">
			<img src="<?php echo base_url(); ?>files/style/logo.png" alt="logo" class="logo-default"/>
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

			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
                <li>
                <?php $attributes = array('class' => 'search-form search-form-expanded');
      echo form_open('clients/index', $attributes);?>
				<div class="input-group">
					<input type="text" name="username" class="form-control" placeholder="Search..." name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
                </li>
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<!-- 
					<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-bell"></i>
						<span class="badge badge-default">
						7 </span>
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3><span class="bold">12 pending</span> notifications</h3>
								<a href="extra_profile.html">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
										<span class="time">just now</span>
										<span class="details">
										<span class="label label-sm label-icon label-success">
										<i class="fa fa-plus"></i>
										</span>
										New user registered. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">3 mins</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Server #12 overloaded. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">10 mins</span>
										<span class="details">
										<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
										</span>
										Server #2 not responding. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">14 hrs</span>
										<span class="details">
										<span class="label label-sm label-icon label-info">
										<i class="fa fa-bullhorn"></i>
										</span>
										Application error. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">2 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Database overloaded 68%. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">3 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										A user IP blocked. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">4 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
										</span>
										Storage Server #4 not responding dfdfdfd. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">5 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-info">
										<i class="fa fa-bullhorn"></i>
										</span>
										System Error. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">9 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Storage server failed. </span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img src="http://acp.laksol.com/files/style/clipart5.png" />
						<!--<span class="badge badge-primary">
						3 </span> -->
						</a>
						<ul class="dropdown-menu">
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 275px; margin-top:0px;" data-handle-color="#637283">
								<?php	$query = $this->db->query("SELECT * FROM dbadmin_msgs WHERE Active='1' ORDER BY MsgDate DESC LIMIT 0,4");
												foreach ($query->result() as $row) { ?>
									<li>
										<a href="<?php echo base_url(); ?>welcome/msg/<?php echo $row->Msgaly;	?>">
										<span class="photo">
										<img src="<?php echo base_url(); ?>files/images/dbadmin.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										<?php echo $row->MsgBy;	?> </span> - 
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
					<!-- BEGIN TODO DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<!--
					<li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-calendar"></i>
						<span class="badge badge-default">
						3 </span>
						</a>
						<ul class="dropdown-menu extended tasks">
							<li class="external">
								<h3>You have <span class="bold">12 pending</span> tasks</h3>
								<a href="page_todo.html">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">New release v1.2 </span>
										<span class="percent">30%</span>
										</span>
										<span class="progress">
										<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Application deployment</span>
										<span class="percent">65%</span>
										</span>
										<span class="progress">
										<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">65% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Mobile app release</span>
										<span class="percent">98%</span>
										</span>
										<span class="progress">
										<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">98% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Database migration</span>
										<span class="percent">10%</span>
										</span>
										<span class="progress">
										<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">10% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Web server upgrade</span>
										<span class="percent">58%</span>
										</span>
										<span class="progress">
										<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">58% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Mobile development</span>
										<span class="percent">85%</span>
										</span>
										<span class="progress">
										<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">85% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">New UI release</span>
										<span class="percent">38%</span>
										</span>
										<span class="progress progress-striped">
										<span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">38% Complete</span></span>
										</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END TODO DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						<?php echo $this->session->userdata('username');?> </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<!--
							<li>
								<a href="inbox.html">
								<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
								3 </span>
								</a>
							</li>-->
							<li class="divider">
							</li><!--
							<li>
								<a href="extra_lock.html">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>-->
							
                            <div class="text-center" style="margin-bottom:10px;"><a href="<?php echo base_url(); ?>users/logout"><button type="submit" class="btn btn-default">Logout</button></a></div>
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
                    <span class="fa fa-dashboard sidebar-icon"></span>
					<span class="title">Dashboard</span>
					</a>
				</li>
<?php if($this->session->userdata('user_type')=="author" || $this->session->userdata('user_type')=="admin"){?>
                <li class="<?php echo ($this->uri->segment(1)==='clients')?'active open':''?>">
					<a href="javascript:;">
                    <span class="fa fa-user sidebar-icon"></span>
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
                                    <a href="<?php echo base_url(); ?>clients/missing_info"> Users with Missing Info. </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>clients/userusage"> Usage Detail </a>
                                </li>
					</ul>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='online')?'active open':''?>">
					<a href="<?php echo base_url(); ?>online">
                    <span class="fa fa-cloud sidebar-icon"></span>
					<span class="title">Online Users</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='badlogins')?'active open':''?>">
					<a href="<?php echo base_url(); ?>badlogins">
                    <span class="fa fa-user-times sidebar-icon"></span>
					<span class="title">Invalid Logins </span>
					</a>
				</li>
				

				<li class="<?php echo ($this->uri->segment(1)==='dealers')?'active open':''?>">
					<a href="javascript:;">
                    <span class="fa fa-map-marker sidebar-icon"></span>
					<span class="title">Dealers</span>
					<span class="arrow<?php echo ($this->uri->segment(1)==='dealers')?' open':''?>"></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>dealers">Dealer List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>dealers/addnew">Add Dealer</a>
                                </li>
					</ul>
				</li>
                
                <li class="last <?php echo ($this->uri->segment(1)==='payments')?'active open':''?>">
					<a href="javascript:;">
                    <span class="fa fa-cc-mastercard sidebar-icon"></span>
					<span class="title">Payments</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>payments">Payments</a>
                                </li>
                                <!--<li>
                                    <a href="<?php echo base_url(); ?>payments/getuserpayments"> User Payments</a>
                                </li>-->
                                <li>
                                    <a href="<?php echo base_url(); ?>payments/addnew">Make Payment</a>
                                </li>
					</ul>
				</li>
                
                <li class="<?php echo ($this->uri->segment(1)==='reports')?'active open':''?>">
					<a href="<?php echo base_url(); ?>reports">
                    <span class="fa fa-newspaper-o sidebar-icon"></span>
					<span class="title">Reports</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>reports">Monthly Reports</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>reports/dreports">Dealers Payments Report</a>
                                </li>
                                <!--<li>
                                    <a href="<?php echo base_url(); ?>reports/usersreport">Users Unit Report</a>
                                </li>-->
					</ul>
				</li>
                
                <li class="<?php echo ($this->uri->segment(1)==='accounts')?'active open':''?>">
					<a href="<?php echo base_url(); ?>accounts">
                    <span class="fa fa-calculator sidebar-icon"></span>
					<span class="title">Accounts</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>accounts/monthlytrans">Previous Transactions </a>
                                </li>
                                <li><a href="<?php echo base_url(); ?>accounts/balance">Dealers Balances </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>accounts">Previous Payment Entries </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>accounts/limits">Dealer’s Limit</a>
                                </li>
					</ul>
				</li>
	<?php if($this->session->userdata('user_type')=="admin"){?>
                <li class="<?php echo ($this->uri->segment(1)==='users')?'active open':''?>">
					<a href="<?php echo base_url(); ?>admin">
                    <span class="fa fa-key sidebar-icon"></span>
					<span class="title">Admins</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>users/sendmsg">Send SMS</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>users">Admins</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>users/addnew">Add Application Admin</a>
                                </li>
					</ul>
				</li>
	<?php } ?>
                
<?php } else {?>
<li class="<?php echo ($this->uri->segment(1)==='clients')?'active open':''?>">
                <li class="<?php echo ($this->uri->segment(1)==='clients')?'active open':''?>">
					<a href="javascript:;">
                    <span class="fa fa-user sidebar-icon"></span>
					<span class="title">Users</span>
					<span class="arrow<?php echo ($this->uri->segment(1)==='clients')?' open':''?>"></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>clients">Users</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>clients/userusage">Usage Detail </a>
                                </li>
					</ul>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='dealers')?'active open':''?>">
					<a href="<?php echo base_url(); ?>dealers">
                    <span class="fa fa-cloud sidebar-icon"></span>
					<span class="title">Dealers List</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='online')?'active open':''?>">
					<a href="<?php echo base_url(); ?>online">
                    <span class="fa fa-cloud sidebar-icon"></span>
					<span class="title">Online Users</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='badlogins')?'active open':''?>">
					<a href="<?php echo base_url(); ?>badlogins">
                    <span class="fa fa-cloud sidebar-icon"></span>
					<span class="title">Invalid Logins</span>
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)==='reports')?'active open':''?>">
					<a href="<?php echo base_url(); ?>reports">
                    <span class="fa fa-cloud sidebar-icon"></span>
					<span class="title">Monthly Reports</span>
					</a>
				</li>
<?php } ?>

                <li class="<?php echo ($this->uri->segment(1)==='technoc')?'active open':''?>">
					<a href="<?php echo base_url(); ?>admin">
                    <span class="fa fa-key sidebar-icon"></span>
					<span class="title">Tech. Tools</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>technoc/debuguser">User Tech. Details</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>technoc">Online Users by RAS</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>technoc/dlrusersinfo">Online Users by Dealer</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>technoc/queryuserid">Usage Log by Users</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>technoc/queryip">Usage Log by IP</a>
                                </li>
					</ul>
				</li>

				
				
			</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
