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

        $sql = "SELECT * FROM exhibition ORDER BY exhibition_date DESC";
        $q = $conn->prepare($sql);
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $exhibition_list[] = array(
                'id' => $row['id'],
                'exhibition_name' => $row['exhibition_name'],
                'description' => $row['description'],
                'photo' => $row['photo'],
                'exhibition_date' => $row['exhibition_date'],
                'status' => $row['status'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'exhibition-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
