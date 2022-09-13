<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // print_r($_POST);
    // die;

    $pressname = $_POST['pressname'];
    $pressdate = $_POST['pressdate'];

    // echo $pressname;
    // echo $pressdate;
    // die;
    
    // $epidate = date("l M d, Y",strtotime($epidate1));
    // $datetime = date('Y-m-d H:i:s');

        try {
            $conn = dbconnect();
            $err = false;
            // $time = ($epidate === false) ? NULL : $epidate;
            

            $query1 = "insert into in_the_press(press_name,press_date) "
                    . "values(:pressname,:pressdate)";
            $bind1 = array(':pressname' => $pressname, ':pressdate' => $pressdate);
            $stmt1 = $conn->prepare($query1);
            // echo PdoDebugger::show($query1, $bind1);
            // exit;
            if ($stmt1->execute($bind1)) {
                $_SESSION['succ'] = "Press is added successfully";
                
            } else {
                $_SESSION['fail'] = "Press is not added";
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
            
            $_SESSION['fail'] = $er;
            
            
        }
}


 include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "add-new-press-tpl.php");
 include(ADMIN_HTML . "admin-footerInc.php");
