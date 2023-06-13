<?php include_once "inc/functions.php";
if (isset($_COOKIE['user_login'])) {
	header('location:index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
	<link href="portal_assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="portal_assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="portal_assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="portal_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="portal_assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="portal_assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="portal_assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="portal_assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<!-- END THEME GLOBAL STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="portal_assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME LAYOUT STYLES -->
	<!-- END THEME LAYOUT STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class=" login">
	<!-- BEGIN : LOGIN PAGE 5-1 -->
	<div class="user-login-5">
		<div class="row bs-reset">
			<div class="col-md-7 bs-reset mt-login-5-bsfix" style="background-image:url('portal_assets/bg1.jpg')">
				<div class="login-bg" style="margin-top:30%;padding:3%">

				</div>
			</div>
			<div class="col-md-5 login-container bs-reset mt-login-5-bsfix">
				<div class="col-md-12 text-center">
					<h1 style="margin-top:7%">Dossier Portal </h1>
				</div>
				<div class="login-content">
					<h1> Login Panel</h1>
					<form action="api/index.php" method="post" class="ajax-form">
						<div class="row">
							<div class="col-md-12">
								<span class="response"></span>
							</div>
							<div class="col-xs-12">
								<input type="hidden" name="action" value="login">
								<input type="hidden" name="platform" value="web">
								<input class="form-control form-control-solid placeholder-no-fix form-group" type="text" name="user_email" required placeholder="Email" value="<?= @$_REQUEST['email'] ?>" />
							</div>
							<div class="col-xs-12">
								<input class="form-control form-control-solid placeholder-no-fix form-group password_fld" type="password" placeholder="Password" name="user_password" required value="<?= @$_REQUEST['password'] ?>" />

								<label style="font-weight: 100"> <input type="checkbox" onclick="togglePassword()"> Show Password</label>

							</div>

						</div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<button class="btn green" type="submit">Sign In</button>
							</div>
							<div class="col-sm-12 text-right">
								<br>
								<a class="modal-action" href="#modal-id" data-toggle="modal" title="load_forget_password_module|user_email|"> Forgot your password ?</a>
							</div>
						</div>

					</form>

				</div>
				<div class="login-footer">
					<div class="row bs-reset">
						<div class="col-xs-5 bs-reset">
							<ul class="login-social">
								<li>
									<a href="javascript:;">
										<i class="icon-social-facebook"></i>
									</a>
								</li>
								<li>
									<a href="javascript:;">
										<i class="icon-social-twitter"></i>
									</a>
								</li>
								<li>
									<a href="javascript:;">
										<i class="icon-social-dribbble"></i>
									</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once "inc/foot.php" ?>
	<script>
		function togglePassword() {
			var x = $(".password_fld")
			if ($(".password_fld").attr('type') === "password") {
				$(".password_fld").attr('type', 'text')
			} else {
				$(".password_fld").attr('type', 'password')
			}
		}
	</script>

</body>

</html>