<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

$upPhoto_thumb_destination = '../' . PHOTOBOOK_THUMB_IMGS;
$upPhoto_destination = '../' . 'photobook' . '/';


// print_r($_POST);die;

$photoid = $_POST['photo'];

$photoname = $_POST['photoname'];
$photodate = $_POST['photodate'];
$photodetails = $_POST['photodetails'];
$imgFile = $_FILES['ImageFile'];

$OldImageFile = $_POST['OldImageFile'];




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



    move_uploaded_file($imgFile["tmp_name"], $upPhoto_destination . $newImageNameFile);


    create_thumb($upPhoto_destination . $newImageNameFile, $upPhoto_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


    if (file_exists($upPhoto_destination . $newImageNameFile) && file_exists($upPhoto_thumb_destination . $newImageName)) {
        $fileuploadflag = true;
    } else {
        $fileuploadflag = false;
    }
} else {
    $fileuploadflag = true;
    $newImageName = $OldImageFile;
}
// $datetime = date('Y-m-d H:i:s');
if ($fileuploadflag == true) {
    try {
        $conn = dbconnect();
        $err = false;
        $query1 = "update  photobook_tbl set event_title=:event_title,event_details=:event_details,event_img=:event_img, event_date=:event_date "
                . " where event_id=:photoid";
        $bind1 = array(':event_title' => $photoname,':event_details' => $photodetails, ':event_img' => $newImageName,':event_date' => $photodate, ':photoid' => $photoid);
        $stmt1 = $conn->prepare($query1);
        // echo PdoDebugger::show($query1, $bind1);
        // exit;
        if ($stmt1->execute($bind1)) {
            $_SESSION['succ'] = "Photo is edited successfully";
            goto_location("edit-photobook.php?photo_id=" . $photoid);
        } else {
            $_SESSION['fail'] = "Photo is not edited";
            goto_location("edit-photobook.php?photo_id=" . $photoid);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
        $_SESSION['fail'] = $er;
        goto_location("edit-photobook.php?photo_id=" . $photoid);
    }
} else {
    $_SESSION['fail'] = "Photo is not added";
    goto_location("edit-photobook.php?photo_id=" . $photoid);
}