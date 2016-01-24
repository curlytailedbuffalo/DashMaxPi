<?php
include("includes/func/func.php");

if(isset($_POST["username"]) && isset($_POST["password"])){
	verifyUserPass($_POST["username"], $_POST["password"], "index.php");

}

?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>AdminLTE 2 | Blank Page</title>
			<?php include("includes/head.php"); ?>
		</head>
		
		<body class="hold-transition skin-blue sidebar-mini">
			<div class="wrapper">
				<?php include("includes/header.php"); ?>
				<?php include("includes/sidebar.php"); ?>
			
			
			
				<div class="content-wrapper">
					
					<!-- Main content -->
					<section class="content">

						 <div class="login-box">
							  <div class="login-logo">
								<a href="../../index2.html"><b>Admin Login</b></a>
							  </div><!-- /.login-logo -->
							  <div class="login-box-body">
							  <?php if ($_SESSION["loggedIn"] == true){ ?>
								<p class="login-box-msg">You have signed in successfully. Enjoy the rest of the site.</p>
							  <?php } else { ?>
								<p class="login-box-msg">Sign in to start your session</p>
								<form action="login.php" method="post">
								  <div class="form-group has-feedback">
									<input type="username" class="form-control" name="username" placeholder="Username">
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								  </div>
								  <div class="form-group has-feedback">
									<input type="password" class="form-control" name="password" placeholder="Password">
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								  </div>
								  <div class="row">
									<div class="col-xs-4">
									  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
									</div><!-- /.col -->
								  </div>
								</form>
							  <?php } ?>
							  </div><!-- /.login-box-body -->
							</div><!-- /.login-box -->

          
					</section><!-- /.content -->
					
					
				</div><!-- /.content-wrapper -->

				<?php include("includes/footer.php"); ?>
				
			<!-- /.wrapper ends in footer-->
		</body>
	</html>
