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

        $sql = "SELECT * FROM `photobook_img` inner join photobook_tbl on photobook_img.event_id=photobook_tbl.event_id;";
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $photobook_listing[] = array(
                'photo_id' => $row['photo_id'],
                'event_id' => $row['event_id'],
                'event_title' => $row['event_title'],
                'photo_title' => $row['photo_title'],
                'photo_img' => $row['photo_img'],
                'created_at' => $row['created_at']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'photobook-listing-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
