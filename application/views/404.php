<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Proctor - by Creligent </title>
	<link href="favicon1.html" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/bootstrap/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/perfectscrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/ionicons/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css" id="theme-css" />
</head>
<body>
	<header>
		<nav class="navbar navbar-default navbar-transparent">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" data-target="#top-navbar" data-toggle="collapse" type="button">
						<span class="sr-only">Toggle navigation</span>
						<i class="ion ion-ios7-gear-outline"></i>
					</button>
					<a class="navbar-brand logo" href="#">
						<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="App logo" width="175">
					</a>
				</div>
				<div class="collapse navbar-collapse" id="top-navbar">
					<!-- <ul class="nav navbar-nav navbar-right">
						<li><a href="#"><i class="fa fa-angle-left"></i> Back to Home</a></li>
					</ul> -->
				</div>
			</div>
		</nav>
	</header>
	<div class="container err-container">
		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<i class="fa fa-bug fa-10x text-danger"></i>
					<h1>The 404 bug ate this page.</h1>
					<p class="lead">The page you are trying to access couldn't be found. It got eaten by the nasty 404 bug.</p>
					<p class="lead">You may start with our home page.</p>
					<a href="<?php echo base_url(); ?>" class="btn btn-primary"><i class="icon-home"></i> &nbsp;Home Page</a>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/lib/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/scripts.min.js" type="text/javascript"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-45950338-1', 'creligent.com');
		ga('send', 'pageview');

	</script>
</body>


</html>