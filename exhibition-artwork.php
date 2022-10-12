<?php
$getid= $_REQUEST['id'];
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
unset($_SESSION['fParam']);
unset($_SESSION['append']);

 include(INC_FOLDER . "headerInc.php");
// dynamic start
$conn = dbconnect();
$sql2 = "SELECT exhibition_paintings.name, exhibition_artists.*, exhibition_paintings.description,exhibition_paintings.image FROM `exhibition_paintings` INNER JOIN exhibition_artists ON exhibition_artists.id = exhibition_paintings.artist_id WHERE exhibition_paintings.id = $getid";
 
$q2 = $conn->query($sql2);

$q2->execute();
$q2->setFetchMode(PDO::FETCH_ASSOC);
$exrow = $q2->fetchAll();

// print_r ($exrow); exit();

$sql1 = "SELECT * FROM `exhibition_paintings` WHERE exhibition_paintings.id = $getid";
 
$q1 = $conn->query($sql1);

$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$exartwork = $q1->fetchAll();

 // print_r ($exartwork); exit();

include(VIEWS_FOLDER . "home-exhibition-artwork.php");
 include(INC_FOLDER . "footerInc.php");