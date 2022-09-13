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

        $sql = "SELECT * FROM photobook_tbl ORDER BY event_date DESC";
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $photo_list[] = array(
                'event_id' => $row['event_id'],
                'event_title' => $row['event_title'],
                'event_img' => $row['event_img'],
                'event_date' => $row['event_date']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'photobook-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
