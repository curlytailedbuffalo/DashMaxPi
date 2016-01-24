<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("includes/func/func.php");
    
    $logged_in = isLoggedIn();
    
    if(isset($_POST["newservice"])){
        addToServiceList($_POST["newservice"]);
    }
    
    if(isset($_POST["dropservice"])){
        removeFromServiceList($_POST["dropservice"]);
    }
    
    $service_list = getServiceList("includes");
    
    $google_ping_time = getGooglePing();
    
	$online_badge = "<span class='pull-right badge bg-green'>Online</span>";
	$offline_badge = "<span class='pull-right badge bg-red'>Offline</span>";
	
	if($google_ping_time < 20){
		$google_ping_badge = "<span class='pull-right badge bg-green'>Excellent! (<20ms)</span>";
		$google_ping_class = "progress-bar-success";
        }else if($google_ping_time >= 20 && $google_ping_time < 50){
		$google_ping_badge = "<span class='pull-right badge bg-blue'>Good (20-50ms)</span>";
		$google_ping_class = "progress-bar-info";
        }else if($google_ping_time >= 50 && $google_ping_time < 75){
		$google_ping_badge = "<span class='pull-right badge bg-yellow'>Moderate (50-75ms)</span>";
		$google_ping_class = "progress-bar-warning";
        }else if($google_ping_time >= 75 && $google_ping_time < 149){
		$google_ping_badge = "<span class='pull-right badge bg-red'>Slow (75-150ms)</span>";
		$google_ping_class = "progress-bar-danger";
        }else if($google_ping_time > 150){
		$google_ping_badge = "<span class='pull-right badge'>Turtle Speed - Check Connection (>150ms)</span>";
		$google_ping_class = "progress-bar-danger";
    }
	$google_ping_percentage = ($google_ping_time/150) * 100;
	
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Blank Page</title>
        <?php include("includes/head.php"); ?>
    </head>
    <style>
        .callout .callout-2{
            margin-left:80px;
                padding-bottom:10px;

        }
        .callout .icon{
            position:absolute;
            font-size:60px;
            color:rgba(255,255,255,0.7);
        }
        .progress .innerlabel{
            font-size: 10px;
            position: absolute;
            left: 45%;
            margin-top: -2px;
        }
        #box-add-service{
            display:none;
        }
        #box-remove-service{
            display:none;
        }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include("includes/header.php"); ?>
            <?php include("includes/sidebar.php"); ?>
			
            <div class="content-wrapper">
				<!--
                <section class="content-header">
                    <h1>Blank page<small>it all starts here</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>
                -->
                
                <!-- Main content -->
                <section class="content">
                    <div class="row">	
                        <div class="col-md-4 col-md-offset-4">
                        
                            <div class="box box-widget widget-user-2">
								<div class="widget-user-header bg-yellow">
                                    <div class="box-tools pull-right">
                                    
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-wrench"></i></button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li><a id="add-service" href="#" data-toggle="modal" data-target="#addServiceModal">Add Service</a></li>
                                            <li class="divider"></li>
                                            <li><a id="remove-service" href="#" data-toggle="modal" data-target="#dropServiceModal">Remove Service</a></li>
                                          </ul>
                                        </div>
                                        
                                    </div>
                                    <div class="widget-user-image">
                                        <span class="fa fa-dashboard fa-4x pull-left"></span>
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">Server Status</h3>
                                    <h5 class="widget-user-desc">View current status of the different servers.</h5>
                                    <div class="progress progress-sm active google-ping" style="background-color:#777777;">
                                        <span class="innerlabel">Google Ping (ms)</span>
                                        <div class="progress-bar <?php echo $google_ping_class; ?> progress-bar-striped" 
										role="progressbar" 
										aria-valuenow="<?php echo $google_ping_percentage; ?>" 
										aria-valuemin="0" 
										aria-valuemax="100" 
										style="width: <?php if ($google_ping_percentage > 100){ echo 100; }else{ echo $google_ping_percentage; } ?>%">
                                            <span class="sr-only"><?php echo $google_ping_percentage; ?></span>
                                        </div>
                                    </div>
                                </div>
								<div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Google Ping (ms) <?php echo $google_ping_badge; ?></a></li>
                                        
                                        <?php 
                                            foreach ($service_list as $b){
                                                $check = exec("ps ax | awk '/$b/ {print $5}' | wc -l");
                                                
                                                echo "<li>";
                                                echo "<a href='#'>" . ucfirst($b) . " ";
                                                if($check > 2){
                                                    echo $online_badge;
                                                }else{
                                                    echo $offline_badge;
                                                }
                                                echo "</a></li>";
                                            }
                                        ?>
                                    </ul>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box widget-statuses -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            
            
            
                                      
            <!-- Modal -->
            <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form role="form" action="index.php" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="addServiceModalLabel">Add Service</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="newservice">Service Name:</label>
                                    <input type="text" class="form-control" id="newservice" name="newservice" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Add Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="dropServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form role="form" action="index.php" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="addServiceModalLabel">Remove Service</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="dropservice">Service Name:</label>
                                    <input type="text" class="form-control" id="dropservice" name="dropservice" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Remove Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 0.1.0
                </div>
                <strong><a href="http://almsaeedstudio.com">DashMaxPi</a>.</strong> Open Source.
            </footer>
                       
            <?php include("includes/footer.php"); ?>
            
            <script>
                
                $("#add-service").on("click", function(){
                
                    if($("#box-add-service").hasClass("open")){
                        $("#box-add-service").slideUp();
                        $("#box-add-service").removeClass("open");

                    }else{
                        $("#box-remove-service").slideUp();
                        $("#box-remove-service").removeClass("open");
                        $("#box-add-service").slideDown();
                        $("#box-add-service").addClass(" open");
                    }
    
                });
                
                $("#remove-service").on("click", function(){
                
                    if($("#box-remove-service").hasClass("open")){
                        $("#box-remove-service").slideUp();
                        $("#box-remove-service").removeClass("open");

                    }else{
                        $("#box-add-service").slideUp();
                        $("#box-add-service").removeClass("open");
                        $("#box-remove-service").slideDown();
                        $("#box-remove-service").addClass(" open");
                    }
    
                });
         
            </script>
        </div><!-- /.wrapper-->
    </body>
</html>
