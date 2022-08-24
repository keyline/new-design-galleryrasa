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

        $sql = "SELECT * FROM podcast ORDER BY created_at DESC";
        $q = $conn->prepare($sql);
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $episode_list[] = array(
                'episode_id' => $row['episode_id'],
                'episode_name' => $row['episode_name'],
                'episode_image' => $row['episode_image'],
                'featured_name' => $row['featured_name'],
                'episode_description' => $row['episode_description'],
                'episode_date' => $row['episode_date'],                
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'podcast-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
