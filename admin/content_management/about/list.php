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
    
	<script language="javascript">
	function delete_item(Id)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href = "process.php?Action="+'Delete'+"&Id="+Id;
		}
	}
	</script>
	
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
						
<!--*********************************** start content *******************************-->

<div class="AddIcon">
	<!--<a href="add-edit.php?Action=Add New">Add New (+)</a>-->
</div>

<?php
	if($_SESSION['MESSAGE'] != "")  
	{
?>
		<div class="label_error">
<?php
		echo '<script>alert("'.$_SESSION['MESSAGE'].'");</script>'; 
		unset($_SESSION['MESSAGE']);
?>						   
		</div>
<?php
	}
?>

<table class="UserContainer">
	<thead>
		<tr>
			<th>Text</th><th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$SQL = mysqli_query($conn,"Select * from content_about");
	$num = mysqli_num_rows($SQL);
	
	if($num > 0)
	{
		while($FVAL = mysqli_fetch_assoc($SQL))
		{
		?>
		<tr>
			<td><?= $FVAL['Banner_Line1']; ?></td>
			<td>
				<a href="add-edit.php?Id=<?= $FVAL['ID']; ?>&Action=Update">
					<i class="fa fa-pencil-square-o"></i>
				</a>
				<!--<a href='#' title="Click Delete" onClick="delete_item(<?php echo $FVAL['ID'] ?>);">
					<i class="fa fa-trash"></i>
				</a>-->
			</td>
		</tr>
	<?php
		}
	}
	else
	{
	?>
		<tr><td colspan="3">No Data Available</td></tr>
	<?php
	}
	?>
	</tbody>
</table>

<!-- *********************************end content********************************* -->
						
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
	
	
    <!-- Custom Theme JavaScript -->
    <script src="../../dashboard/js/custom.min.js"></script>

    <!--Style Switcher -->
<script src="../../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>