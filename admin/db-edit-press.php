<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

// print_r($_POST);die;

$press = $_POST['press'];
$pressname = $_POST['pressname'];
$pressdate = $_POST['pressdate'];


// echo $pressname;
// echo $pressdate;die;

 
    try {
        $conn = dbconnect();
        $err = false;


        $query1 = "update in_the_press set press_name=:press_name,press_date=:press_date where press_id=:pressid";
        $bind1 = array(':press_name' => $pressname, ':press_date' => $pressdate, ':press_date' => $pressdate, ':pressid' => $press);
        $stmt1 = $conn->prepare($query1);
        // echo PdoDebugger::show($query1, $bind1);
        // exit;
        if ($stmt1->execute($bind1)) {
            $_SESSION['succ'] = "Press is edited successfully";
            goto_location("edit-press.php?press_id=" . $press);
        } else {
            $_SESSION['fail'] = "Press is not edited";
            goto_location("edit-press.php?press_id=" . $press);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
        $_SESSION['fail'] = $er;
        goto_location("edit-press.php?press_id=" . $press);
    }


