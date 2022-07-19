<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
    }else{
        $category = get_parent_category($conn);
        $select_category = $category['s'];
        include(ADMIN_HTML . "admin-headerInc.php");
        include(ADMIN_HTML . "product-settings-tpl.php");
        include(ADMIN_HTML . "admin-footerInc.php");
        
    }