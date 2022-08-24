<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

$artist_id = $_GET['artist_id'];

$artistarr = singleexhibitionartist($artist_id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print "<pre>";
    print_r($_REQUEST);
} else {
    try {

        $sql = "SELECT exhibition_paintings.*,exhibition_medium.medium_name medium_name "
                . "FROM exhibition_paintings,exhibition_medium "
                . "where "
                . ""
                . "exhibition_paintings.medium = exhibition_medium.id and "
                . "exhibition_paintings.artist_id= '$artist_id' ORDER BY exhibition_paintings.year";
        $q = $conn->prepare($sql);
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $painting_list[] = array(
                'id' => $row['id'],
                'artist_id' => $row['artist_id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'dimension' => $row['dimension'],
                'description' => $row['description'],
                'medium' => $row['medium'],
                'year' => $row['year'],
                'fulldate' => $row['fulldate'],
                'price' => $row['price'],
                'currently_available_at' => $row['currently_available_at'],
                'status' => $row['status'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'medium_name' => $row['medium_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'exhibition-paintings-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
