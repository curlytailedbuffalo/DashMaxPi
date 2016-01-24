<?php
include("includes/func/func.php");
$hashedPassword = '$2y$16$Y0YxGtRf08IFXSuRFpjppuM5yH1RS/l8BdlmpNJ2B0W3p0DXut2Da';
if(isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] == $_POST['password2']) {

    $newPassword = $_POST['password'];
    $hashedPassword =  passwordMaker($newPassword);
}

?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>AdminLTE 2 | Create Password Hash</title>
			<?php include("includes/head.php"); ?>
		</head>
		
		<body class="hold-transition skin-blue sidebar-mini">
			<div class="wrapper">
				<?php include("includes/header.php"); ?>
				<?php include("includes/sidebar.php"); ?>
			
			
			
				<div class="content-wrapper">
					
					<!-- Main content -->
					<section class="content">
                        <div class="row">
                            <div style="margin-top:7%;" class="col-md-5 col-md-offset-3">
                                <?php if(isset($newPassword)){ ?>
                                    <div class="login-logo">
                                        <a href="#"><b>Hashed Password</b></a>
                                    </div><!-- /.login-logo -->
                                    <div class="login-box-body">
                                        <p class="login-box-msg">Copy and paste the below password into your config.php file.</p>
                                        
                                        <h4 class="text-center"><b><?php echo $hashedPassword; ?></b></h4>
                                    </div>
                                <?php }else{ ?>
                                    <div class="login-logo">
                                        <a href="#"><b>Enter Password</b></a>
                                    </div><!-- /.login-logo -->
                                    <div class="login-box-body">
                                        <p class="login-box-msg">Enter a password and submit to create the password hash for your config file.</p>
                                        <form action="createPassword.php" method="post">
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" name="password" placeholder="Password">
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" name="password2" placeholder="Password Confirmation">
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>
                                            <div class="form-group ">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Create Password Hash</button>
                                            </div>
                                        </form>
                                    </div><!-- /.login-box-body -->
                                <?php } ?>
                                <div style="margin-top:50px;">
                                    <h3>Example</h3>
                                    <h4>&nbsp &nbsp &nbsp &nbsp of <em>/includes/config/config.php</em></h4>
                                    <div style="margin-top:10px;" class="well">
                                   
                                        <?php
                                            echo htmlspecialchars("<?php");
                                            echo "<br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                            echo htmlspecialchars("\$mainConfig = (object)[ ");
                                            echo "<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                            echo htmlspecialchars("'username' => 'admin', ");
                                            echo "<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                            echo "'password' => '". $hashedPassword ."'";
                                            echo "<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                            echo htmlspecialchars("];");
                                            echo "<br><br>";
                                            echo htmlspecialchars("?>");    
                                        ?>
                                   
                                    </div>
                                </div>
                            
                            </div><!-- /.login-box -->
                        </div>
          
					</section><!-- /.content -->
					
					
				</div><!-- /.content-wrapper -->

				<?php include("includes/footer.php"); ?>
				
			<!-- /.wrapper ends in footer-->
		</body>
	</html>
