<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
try {

    $sql = "select * from "
            . "admin_ecomc";
    $q = $conn->prepare($sql);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    $row = $q->fetch();
    $id = $row['id'];
    $arc_anim = $row['arc_anim'];
} catch (PDOException $pe) {
    $items = db_error($pe->getMessage());
}

include(INC_FOLDER . "homeheaderInc.php");
$home = file_get_contents(VIEWS_FOLDER . 'home1.Inc.php');
$searchall = file_get_contents(VIEWS_FOLDER . 'searchallInc.php');
$search = array('{arcAnim}');
$replace = array($arc_anim);
echo $detailsView = $searchall, $home;
//$options = get_subCategory_options($conn);
//$select_sub = $options['s'];
//echo str_replace('{subcategory_list}', $select_sub, $home);
$count = 1;



if ($count == 0) {
    $items = NO_PRODUCT_FOUND_MSG;
    include(VIEWS_FOLDER . "no-results-index.php");
} else {
    include(VIEWS_FOLDER . "index.php");
}
include(INC_FOLDER . "footerInc.php");
