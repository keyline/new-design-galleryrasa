<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

// $artist_id = $_GET['artist_id'];
$exibition_id = $_GET['exibition_id'];

// $artistarr = singleexhibitionartist($artist_id);
$exhibitionarr = singleexhibition($exibition_id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print "<pre>";
    print_r($_REQUEST);
} else {
    try {

        $sql = "SELECT exhibition_paintings.*, exhibition_artists.artist_name FROM `exhibition_paintings` LEFT JOIN exhibition_artists ON exhibition_paintings.artist_id = exhibition_artists.id WHERE exhibition_paintings.exhibition_id = $exibition_id ";
        $q = $conn->prepare($sql);
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $painting_list[] = array(
                'id' => $row['id'],
                'exhibition_id' => $row['exhibition_id'],
                'artist_name' => $row['artist_name'],
                'name' => $row['name'],
                'reference_no' => $row['reference_no'],
                'image' => $row['image'],
                'dimension' => $row['dimension'],
                'signature' => $row['signature'],
                'description' => $row['description'],
                'medium' => $row['medium'],
                'year' => $row['year'],
                // 'fulldate' => $row['fulldate'],
                'price' => $row['price'],
                // 'currently_available_at' => $row['currently_available_at'],
                // 'status' => $row['status'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                // 'medium_name' => $row['medium_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'exhibition-paintings-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
