<?php
	session_start();
	include_once('../../includes/config.php');
	$page = $_SERVER['PHP_SELF'];
    error_reporting(0);
?>
<!DOCTYPE html>  
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" type="image/x-icon" href="../../plugins/images/favicon.ico">-->
	<title>Tamper ME | Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../dashboard/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- wysihtml5 CSS -->
	<link rel="stylesheet" href="../../plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
	<!-- Dropzone css -->
	<link href="../../plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- animation CSS -->
    <link href="../../dashboard/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dashboard/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../../dashboard/css/colors/default.css" id="theme" rel="stylesheet">
	<!-- admin folder css -->
	<link href="../admin_folder.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
	
<style>

</style>
</head>
<?php 
    include '../header.php';
    include '../left-sidebar.php';
	include '../../dashboard/php/breadcrumbs.php';
?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"> CMS -> About </h4> </div>
                <!--
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="https://themeforest.net/item/elite-admin-responsive-dashboard-web-app-kit-/16750820" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
                    <?php echo breadcrumbs(); ?>
                </div>
                -->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
						
<!--**************************** start content ***********************-->
<?php
$sq=mysqli_query($conn,"Select * from content_about where ID = '".$_REQUEST['Id']."'");
$fe=mysqli_fetch_assoc($sq);
?>
<form action="process.php" name="commentForm" class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" >     
    <div align="center">
		<h2 align="left"><?= $_REQUEST['Action'] ?> <b>About</b> </h2>

        <div class="FomHolder">
        
            <input type="hidden" value="<?=  $_REQUEST['Action'] ?>" name="UpdateADD" id="UpdateADD" />
            <input value="<?= $_REQUEST['Id'] ?>" name="Id" type="hidden"  /><br />  <br />  
			
			<div class="EachSectionForm">
                <label>Text</label><br>
				<input type="text" value="<?php echo $fe['Banner_Line1'] ?>" name="Banner_Line1">
            </div>
            
            <div class="EachSectionForm">
				<br><br>
                <label>Image</label>
				<br>
				<input type="hidden" name="hid_Image" value="<?= $fe['Banner_Image']; ?>" />
                <?php if($fe['Banner_Image'] != ""){ ?>
                	<img src="../images/<?php echo $fe['Banner_Image'] ?>"  style="width:100px; height:100px; border: 1px solid; padding: 7px; border-radius: 3px;" />
                <?php  } ?>                
                <input class="but-gallery" name="file" type="file" style="display: inline-block; width: auto;">
            </div>
            
            <div class="EachSectionForm">
				<br><br>
                <label>Content</label>
                <textarea class="textarea_editor2 form-control" rows="5" name="Banner_Line2" ><?php echo $fe['Banner_Line2'] ?></textarea>
            </div>
            
            
            <div class="EachSectionForm">
				<br><br>
                <label>Step 1</label>
                <textarea class="textarea_editor3 form-control" rows="5" name="Banner_Line3" ><?php echo $fe['Banner_Line3'] ?></textarea>
            </div>
            
            <div class="EachSectionForm">
				<br><br>
                <label>Step 2</label>
                <textarea class="textarea_editor4 form-control" rows="5" name="Banner_Line4" ><?php echo $fe['Banner_Line4'] ?></textarea>
            </div>
            
	    <div class="EachSectionForm">
				<br><br>
                <label>Step 3</label>
                <textarea class="textarea_editor5 form-control" rows="5" name="Banner_Line5" ><?php echo $fe['Banner_Line5'] ?></textarea>
            </div>
			
            <div class="new_each_section">
				<br><br>
                <input type="submit" class="submit" value="Submit">
            </div>
    
        </div>
    </div>
</form>

<!--********************************* end content *****************************-->
						
					</div>
				</div>
            </div>
            <!-- /.row -->
            <?php include '../../dashboard/php/right-sidebar.php';?>
        </div>
        <!-- /.container-fluid -->
        <?php include '../footer.php';?>
    </div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../dashboard/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="../../dashboard/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../dashboard/js/waves.js"></script>
	
	<script src="../../plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
	<script src="../../plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
	<script src="../../plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
	<script>
	$(document).ready(function () {
		$('.textarea_editor2').wysihtml5();
		$('.textarea_editor3').wysihtml5();
		$('.textarea_editor4').wysihtml5();
		$('.textarea_editor5').wysihtml5();
	});
	</script>
	
    <!-- Custom Theme JavaScript -->
    <script src="../../dashboard/js/custom.min.js"></script>

    <!--Style Switcher -->
<script src="../../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>