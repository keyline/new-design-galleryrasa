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
$press_thumb_destination = '../' . PRESS_THUMB_IMGS;
$press_destination = '../' . PRESS_IMGS;

$img_id = $_GET['img_id'];
$press_id = $_GET['press_id'];

// echo $press_id;die;

$img = singleArticle($img_id);

$allpress = all_in_the_press();

// print_r($press);
// exit();

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "edit-press-listing-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
