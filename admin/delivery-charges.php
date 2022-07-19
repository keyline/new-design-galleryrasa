<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
include(ADMIN_HTML . "admin-headerInc.php");
check_auth_admin();
$conn = dbconnect();
$shipping = list_delivery_options($conn);
include(ADMIN_HTML . 'delivery-charges-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");
?>  