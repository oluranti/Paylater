<?php $this->load->module('admintemplate'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Free HTML5 Bootstrap Admin Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Paylater Admin">
	<meta name="author" content="Olanipekun Olufemi, KVPAfrica">

	<!-- The styles -->
	<link id="bs-csss" href="<?php echo $this->admintemplate->get_asset(); ?>/css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo $this->admintemplate->get_asset(); ?>/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo $this->admintemplate->get_asset(); ?>/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo $this->admintemplate->get_asset(); ?>/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/chosen.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo $this->admintemplate->get_asset(); ?>/css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo $this->admintemplate->get_asset(); ?>/img/favicon.ico">
		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html">PayLater</a>
				
				
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">

						<li><a href="<?php echo base_url('adminusers/logout') ?>">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="<?php echo base_url(); ?>">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left" action="<?php echo base_url('users/searchuser') ?>" method="post">
								<input placeholder="Search" class="search-query span2" name="usersearch" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Admin Menu</li>
						<li><a class="ajax-link" href="<?php echo base_url('users'); ?>"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url('adminusers'); ?>"><i class="icon-star"></i><span class="hidden-tablet"> Admin Users</span></a></li>
					<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>
