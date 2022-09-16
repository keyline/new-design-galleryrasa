<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print "<pre>";
    print_r($_REQUEST);
} else {
    try {

        $sql = "SELECT * FROM `press_img` inner join in_the_press on press_img.press_id=in_the_press.press_id";
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $press_listing[] = array(
                'img_id' => $row['img_id'],
                'press_id' => $row['press_id'],
                'title' => $row['title'],
                'press_name' => $row['press_name'],
                'title_img' => $row['title_img'],
                'create_at' => $row['create_at']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'press-listing-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
