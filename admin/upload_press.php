<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     print "<pre>";
//     print_r($_REQUEST);
// } else {
//     try {

//         $sql = "SELECT * FROM in_the_press ORDER BY press_date DESC";
//         $q = $conn->prepare($sql);
       
//         $q->execute();
//         $q->setFetchMode(PDO::FETCH_ASSOC);
//         $count = $q->rowCount();
//         while ($row = $q->fetch()) {
            
//             $press_list[] = array(
//                 'press_id' => $row['press_id'],
//                 'press_name' => $row['press_name'],
//                 'press_date' => $row['press_date']
//             );
//         }
//     } catch (PDOException $pe) {
//         echo db_error($pe->getMessage());
//     }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'press-img-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
// }
