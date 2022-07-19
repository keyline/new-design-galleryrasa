<?php 
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$destination = '../' . SITE_IMGS;
check_auth_admin();


if(empty($_FILES['file']))
{
	exit();	
}

$errorImgFile = $destination."img_upload_error.jpg";
if (in_array($_FILES['file']['type'], $allowedFiles)) {
	       
$newImageName = upload_name($_FILES['file']);
	
if(!move_uploaded_file($_FILES['file']['tmp_name'], $destination.$newImageName)){
	echo $errorImgFile;
}
else{
	echo SITE_URL.'/'.SITE_IMGS.$newImageName;
}

}
else {
	echo $errorImgFile;
}
?>