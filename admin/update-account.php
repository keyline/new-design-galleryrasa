<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();
    $title = "Update your account";
    $email = get_email_address($conn);
    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . "update-passwd-tpl.php");
    include(ADMIN_HTML . "admin-footerInc.php");

?>  