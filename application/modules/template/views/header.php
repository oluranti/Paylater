<?php $this->load->module('template'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8" />
	<title>Paylater<?php echo " | ".$title; ?></title>
	<meta name="description" content="Paylater is a service by One Credit that allows you buy now and pay later on selected websites. Shop Now, Buy Now and Pay Later with One Credit Paylater." />
	<meta name="author" content="Olanipekun Olufemi, KVP Africa" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- CSS
  ================================================== -->
	<link href="<?php echo $this->template->get_asset(); ?>/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo $this->template->get_asset(); ?>/css/layout.css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo $this->template->get_asset(); ?>/images/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php echo $this->template->get_asset(); ?>/images/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->template->get_asset(); ?>/images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->template->get_asset(); ?>/images/apple-touch-icon-114x114.png" />
    
    <!-- Jquery Link
    ================================================== -->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<div class="container bg">
		<header>
            <div class="row">
            <div class="col-md-4 col-md-offset-8"><a href="<?php echo base_url(); ?>"><img src="<?php echo $this->template->get_asset(); ?>/images/logo.png" width="232" height="146" class="pull-right logo" /></a></div>
            </div>
        </header>