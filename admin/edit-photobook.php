<?php
// error_reporting(-1);

// ini_set('display_errors', 'On');

// set_error_handler("var_dump");
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


$upPhoto_thumb_destination = '../' . PHOTOBOOK_THUMB_IMGS;
$upPhoto_destination = '../' . 'photobook' . '/';

$photo_id = $_GET['photo_id'];

// echo $photo_id;die;

$photo = singlePhoto($photo_id);

// print_r($photo);
// exit();

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "edit-photo-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
