<?php
session_start();
include_once('../../includes/config.php');

//update****************************************

if(isset($_REQUEST['UpdateADD']) && $_REQUEST['UpdateADD'] == 'Update')
{
	
	$file_name = basename($_FILES['file']['name']);
	if($file_name == "")
	{
		$file_name = $_REQUEST['hid_Image'];
	}
	else
	{
		$target_dir = "../images/";
		$file_name = rand(00000,99999) .basename($_FILES["file"]["name"]);
		$target_file = $target_dir . $file_name;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "JPG" )
		{
			$_SESSION['MESSAGE'] = $msg = "Oh snap! Sorry, file type not matched!!!";
			$uploadOk = 0;
		}
		if ($uploadOk == 1) {
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);							
		}
	}
	
	$flds = "`Banner_Line1`									= '".mysqli_real_escape_string($conn,$_REQUEST['Banner_Line1'])."',
			 `Banner_Line2`									= '".mysqli_real_escape_string($conn,$_REQUEST['Banner_Line2'])."',			 
			 `Banner_Line3`									= '".mysqli_real_escape_string($conn,$_REQUEST['Banner_Line3'])."',
			 `Banner_Image`									= '".$file_name."'";
			
	$sql="UPDATE content_cafes SET $flds where ID = '".$_REQUEST['Id']."';" or die(mysqli_error($conn));
	
	if (mysqli_query($conn,$sql)) 
	{
		$msg = "Content update successfully."; 
	}
	else 
	{ 
		$msg = "Problem arised in Content updation."; 
	}
	$_SESSION['MESSAGE'] = $msg;
	header('location:list.php');
	exit();
}

// delete*************************************************

if(isset($_REQUEST['Action']) && $_REQUEST['Action'] == 'Delete')
{
	$sql="Delete  from content_cafes where ID = '".$_REQUEST['Id']."';" or die(mysql_error($conn));
	if(mysqli_query($conn,$sql))
	{
		$msg = "Content  deleted successfully.";
	}
	else
	{
		$msg = "Problem arised in Content deletion.";
	}
	$_SESSION['MESSAGE'] = $msg;
	header('location:list.php');
	exit();
}

// insert***********************************************

if(isset($_REQUEST['UpdateADD']) && $_REQUEST['UpdateADD'] == 'Add New')
{
	
	$file_name = basename($_FILES['file']['name']);
	if($file_name == "")
	{
		$file_name = $_REQUEST['hid_Image'];
	}
	else
	{
		$target_dir = "../images/";
		$file_name = rand(00000,99999) .basename($_FILES["file"]["name"]);
		$target_file = $target_dir . $file_name;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "JPG" )
		{
			$_SESSION['MESSAGE'] = $msg = "Oh snap! Sorry, file type not matched!!!";
			$uploadOk = 0;
		}
		if ($uploadOk == 1) {
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);							
		}
	}
	
	$flds = "`Banner_Line1`									= '".mysqli_real_escape_string($conn,$_REQUEST['Banner_Line1'])."',
			 `Banner_Line2`									= '".mysqli_real_escape_string($conn,$_REQUEST['Banner_Line2'])."',			 
			 `Banner_Line3`									= '".mysqli_real_escape_string($conn,$_REQUEST['Banner_Line3'])."',
			 `Banner_Image`									= '".$file_name."'";
		
	$sql="INSERT INTO content_cafes SET $flds;" or die(mysqli_error($conn));
	
	if (mysqli_query($conn,$sql))
	{
		$msg = "Content create successfully.";
	}
	else
	{
		$msg = "Problem arised in Content Creation.";
	}
	$_SESSION['MESSAGE'] = $msg;
	header('location:list.php');
	exit();
	
}
?>