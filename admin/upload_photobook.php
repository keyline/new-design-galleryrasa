<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . 'photobook-img-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");

