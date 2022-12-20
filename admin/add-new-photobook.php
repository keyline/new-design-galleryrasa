<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


$photobook_thumb_destination = '../' . PHOTOBOOK_THUMB_IMGS;
$photobook_destination = '../' . PHOTOBOOK_IMGS;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // print_r($_POST);die;

    // $event_id = $_POST['event_id'];
    $eventtitle = $_POST['eventtitle'];
    $eventdetails = $_POST['eventdetails'];
    $imgFile = $_FILES['eventImg'];
    $eventdate = $_POST['eventdate'];
    // $epidate = date("l M d, Y",strtotime($epidate1));



    if ($imgFile["name"] != '') {

        $RandomNum = rand(0, 9999999999);

        $ImageName = str_replace(' ', '-', strtolower($imgFile["name"]));

        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);

        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;


        $orgname = $newImageName;

        $imgarr = explode(".", $orgname);

        $ImageExt1 = end($imgarr);

        $imgarrcnt = count($imgarr);

        $imgorgcnt = $imgarrcnt - 1;
        $orgnameexcptextnd = '';
        for ($l = 0; $l < $imgorgcnt; $l++) {
            if ($l == ($imgorgcnt - 1)) {

                $orgnameexcptextnd .= $imgarr[$l];
            } else {
                $orgnameexcptextnd .= $imgarr[$l] . '.';
            }
            //$orgnameexcptextnd .= $imgarr[$l];
        }

        $newImageNameFile = base64_encode($orgnameexcptextnd) . '.' . $ImageExt1;
        // print_r($imgFile);
        // var_dump($exhibition_destination . $newImageNameFile);

        move_uploaded_file($imgFile["tmp_name"], $photobook_destination . $newImageNameFile);


        create_thumb($photobook_destination . $newImageNameFile, $photobook_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


        if (file_exists($photobook_destination . $newImageNameFile) && file_exists($photobook_thumb_destination . $newImageName)) {

            $fileuploadflag = true;
        } else {
            $fileuploadflag = false;
        }
    } else {

        $fileuploadflag = true;
        $newImageName = '';
    }


    if ($fileuploadflag == true) {
        try {
            $conn = dbconnect();
            $err = false;
            $query1 = "insert into photobook_tbl(event_title,event_details,event_img,event_date) " . "values(:event_title,:event_details,:event_img,:event_date)";
            $bind1 = array(':event_title' => $eventtitle,':event_details' => $eventdetails,  ':event_img' => $newImageName, ':event_date' => $eventdate);
            $stmt1 = $conn->prepare($query1);
            // echo PdoDebugger::show($query1, $bind1);
            // exit;
            if ($stmt1->execute($bind1)) {
                $_SESSION['succ'] = "Image is added successfully";
                goto_location("add-new-photobook.php");
                
            } else {
                $_SESSION['fail'] = "Image is not added";
                goto_location("add-new-photobook.php");
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
            $_SESSION['fail'] = $er;
        }
    }else{
        $_SESSION['fail'] = "Image photo is not added";
    }
}
include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "add-new-photobook-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
