<?php
	session_start();
	include_once('../includes/config.php');
	$page = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>  
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Elite Admin - is a responsive admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="../eliteadmin-inverse-php/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- wysihtml5 CSS -->
	<link rel="stylesheet" href="../plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
	<!-- Dropzone css -->
	<link href="../plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- animation CSS -->
    <link href="../eliteadmin-inverse-php/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../eliteadmin-inverse-php/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../eliteadmin-inverse-php/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-19175540-9', 'auto');
        ga('send', 'pageview');
    </script>
<style>
#form_update {
	clear: both;
	overflow: hidden;
}
#form_submit {
	clear: both;
	overflow: hidden;
	display: none;
}
.success {
	text-align: center;
	padding: 20px 15px;
	border: 1px solid #ddd;
	background-color: #979797;
	width: 43%;
	float: none;
	border-radius: 6px;
	color: #fff;
	font-size: 17px;
	margin: 0 auto;
	margin-bottom: 10px;
}
.fa.fa-smile-o.text-primary {
	color: #fff;
}
</style>
</head>
<?php 
    include '../eliteadmin-inverse-php/php/header.php';
    include '../eliteadmin-inverse-php/php/left-sidebar.php'; include '../eliteadmin-inverse-php/php/breadcrumbs.php';
?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"> Content Management System -> About Us </h4> </div>
                <!--
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="https://themeforest.net/item/elite-admin-responsive-dashboard-web-app-kit-/16750820" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
                    <?php echo breadcrumbs(); ?>
                </div>
                -->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php
				if(isset($_POST['submit'])) {
					
					$about_text=$_POST['about_text'];
					if($about_text==""){
						$about_text=$_POST['hide_abt'];
					}
					
					$abc=basename($_FILES["img_file"]["name"]);
					if($abc=="" || $abc=="no upload"){
						$file_name=$_POST['hide_img'];
					}
					else{
						//file upload
						$target_dir = "../uploads/";
						$file_name = rand(00000,99999) .basename($_FILES["img_file"]["name"]);
						$target_file = $target_dir . $file_name;
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						//checking file type
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "JPG" ) {
							echo '
								<div class="success" role="alert">
									<strong><i class="fa fa-frown-o"></i> Oh snap!</strong> Sorry, file type not matched.
								</div>
							';
							$uploadOk = 0;
						}
						if ($uploadOk == 1) {
							move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file);							
						}
					}
					
					$sql="UPDATE aboutus SET image='$file_name', about='$about_text' WHERE ID=1";
					if($result = $conn->query($sql)){
						echo '
							<div class="success" role="alert">
								<strong><i class="fa fa-smile-o"></i> Well done!</strong> Changes successfully saved.
								<!--<div class="close"><i class="fa fa-times"></i></div>-->
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
							</div>
						';
					}
					
				}
				
				$sql2="SELECT * FROM `aboutus` WHERE ID=1";
				$result = $conn->query($sql2);
				while($row = $result->fetch_assoc()) {
					$img_result=$row['image'];
					$abt_result=$row['about'];
				}
			?>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
						<div id="form_update">
							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group" style="padding:20px">
								<img src="../uploads/<?= $img_result;?>" style="width:100%">								
							</div>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group" style="padding:20px; border: 1px solid #ddd; border-radius: 5px;">
								<p><?= $abt_result;?></p>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<input type="button" class="btn btn-primary" value="Edit Content" name="edit" id="edit">
							</div>
						</div>
						
						<div id="form_submit">
							<form action="" method="post" enctype="multipart/form-data">
								<h4> Image </h4>
								<div class="fallback">
									<input name="img_file" type="file" />
									<input type="hidden" value="<?= $img_result;?>" name="hide_img"><!--hidden image-->
								</div>
								<h4> About Us</h4>
								<div class="form-group">
				<textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..." name="about_text" value="<?= $abt_result;?>" ></textarea>
									<input type="hidden" value="<?= htmlentities($abt_result);?>" name="hide_abt"><!--hidden text-->
								</div>
								<input type="submit" class="btn btn-success" value="Submit" name="submit">
							</form>
						</div>
					</div>
				</div>
            </div>
            <!-- /.row -->
            <?php include '../eliteadmin-inverse-php/php/right-sidebar.php';?>
        </div>
        <!-- /.container-fluid -->
        <?php include '../eliteadmin-inverse-php/php/footer.php';?>
    </div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../eliteadmin-inverse-php/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="../eliteadmin-inverse-php/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../eliteadmin-inverse-php/js/waves.js"></script>
	
	<script src="../plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
	<script src="../plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
	<script src="../plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
	<script>
	$(document).ready(function () {
	   
		$('.textarea_editor').wysihtml5();
	  
		$('#edit').click(function(){
			$('#form_update').css("display", "none");
			$('#form_submit').css("display", "block");
		});
		
		$('.close').click(function(){
			$('.success').css("display", "none");
		});
		
	});
	</script>
	
    <!-- Custom Theme JavaScript -->
    <script src="../eliteadmin-inverse-php/js/custom.min.js"></script>

    <!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>