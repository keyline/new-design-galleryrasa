<?php
// Turn off error reporting
error_reporting(0);
session_start();
include_once('config.php')or die(mysql_error());


if(!isset($_SESSION ["userid"])){
header("location:../eliteadmin-inverse-php/login.php");
}else{

$user = $_SESSION ["user"];
//$userid = $_SESSION["userid"];
//$uname = $_SESSION["uname"];
//$agencyid = $_SESSION["agencyid"];
}

?>