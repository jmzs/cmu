<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Proctor - by Creligent </title>
	<link href="favicon1.html" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lib/bootstrap/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lib/perfectscrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lib/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lib/ionicons/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css" id="theme-css" />
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
						<img src="<?php echo base_url();?>assets/images/logo.png" alt="App logo" width="175">
					</a>
				</div>

			</div>
		</nav>
	</header>
	<div class="container form-container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				<div class="panel panel-default panel-more-shadow">
					<div class="panel-body">
						<div class="panel-desc">Sign in</div>
						<hr>
						<form role="form" action="" id="form_login">
							<div class="form-group">
								<input type="text" name="user" class="form-control input-lg" id="user" required placeholder="Usuario">
							</div>
							<div class="form-group">
								<input type="password" name="pass" class="form-control input-lg" id="pass" required placeholder="Contraseña">
							</div>
							<div class="checkbox m-bot15">
								<label>
									<input type="checkbox"> Keep me logged in.
								</label>
							</div>
							<button type="submit" class="btn btn-lg btn-primary btn-block btn_login">Sign in</button>
							<div class="form-group m-top15">
								<a href="app_signup.html">Create an account</a>
								<a href="app_forgot_password.html" class="pull-right">Recover password</a>
							</div>
						</form>
					</div>
					<div class="panel-footer text-center">
						<p>or Signin with:</p>
						<a class="btn btn-sm btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
						<a class="btn btn-sm btn-social-icon btn-google-plus m-left10"><i class="fa fa-google-plus"></i></a>
						<a class="btn btn-sm btn-social-icon btn-twitter m-left10"><i class="fa fa-twitter"></i></a>
						<a class="btn btn-sm btn-social-icon btn-linkedin m-left10"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url();?>assets/js/lib/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/lib/bootstrap/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/lib/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

	<script>
		$(".btn_login").on("click",function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?php echo site_url("loginController/loguearse") ?>',
				type: 'POST',
				dataType: 'json',
				data: $("#form_login").serialize(),
			})
			.done(function(json) {

				if(json.response == 'ok') {
					window.location = "<?php echo site_url('principalController'); ?>";
				} else {
					alert("Usuario o Contraseña Incorrectos");
				}

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		})
	</script>
</body>


</html>