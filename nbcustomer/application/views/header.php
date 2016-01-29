<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Billing System</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>files/theme/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
	<link href="<?php echo base_url(); ?>files/style/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>files/theme/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url(); ?>files/theme/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>files/theme/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>files/theme/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php print base_url(); ?>files/style/logo.png" /></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="<?php echo base_url(); ?>billpanel"><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('UserID');?></a>
                        </li>-->
                        <li><a href="<?php echo base_url(); ?>billpanel/PWChange"><i class="fa fa-gear fa-fw"></i>Change Password </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>billpanel/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
                            <a class="<?php echo (!$this->uri->segment(2))?'active':''?>" href="<?php echo base_url(); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
						<li>
                            <a class="<?php echo ($this->uri->segment(2)==='PWChange')?'active':''?>"  href="<?php echo base_url('billpanel/PWChange'); ?>"><i class="fa fa-key fa-fw"></i> Change Password</a>
                        </li>
						<li>
                            <a class="<?php echo ($this->uri->segment(2)==='usage')?'active':''?>"  href="<?php echo base_url('billpanel/usage'); ?>"><i class="fa fa-key fa-fw"></i> Usage Details</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
