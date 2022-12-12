<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();
$press_thumb_destination = '../' . PRESS_THUMB_IMGS;
$press_destination = '../' . PRESS_IMGS;

$press_id = $_POST['pressid'];
$img_id = $_POST['articleid'];
$title = $_POST['articlename'];

$create_at = $_POST['articledate'];

//  print_r($_POST);die;
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



    move_uploaded_file($imgFile["tmp_name"], $press_destination . $newImageNameFile);


    create_thumb($press_destination . $newImageNameFile, $press_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


    if (file_exists($press_destination . $newImageNameFile) && file_exists($press_thumb_destination . $newImageName)) {

        $fileuploadflag = true;
    } else {
        $fileuploadflag = false;
    }
} else {

    $fileuploadflag = true;
    $newImageName = $OldImageFile;
}

$datetime = date('Y-m-d H:i:s');
// echo $pressname;
// echo $pressdate;die;
if ($fileuploadflag == true) {


    try {
        $conn = dbconnect();
        $err = false;


        $query1 = "update press_img set "
                . "press_id = :press_id,title = :title,title_img = :title_img,create_at = :create_at,"
                . "updated_at = :updated_at "
                . " where img_id=:img_id";
        $bind1 = array(':press_id' => $press_id, ':title' => $title,
            ':title_img' => $newImageName, ':create_at' => $create_at,            
            ':updated_at' => $datetime, ':img_id' => $img_id);
        $stmt1 = $conn->prepare($query1);
// echo PdoDebugger::show($query1, $bind1);
// exit;
        if ($stmt1->execute($bind1)) {
            $_SESSION['succ'] = "Article is edited successfully";
            goto_location("edit-press-listing.php?img_id=" . $img_id . "&press_id=" . $press_id);
        } else {
            $_SESSION['fail'] = "Article is not edited";
            goto_location("edit-press-listing.php?img_id=" . $img_id . "&press_id=" . $press_id);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

        $_SESSION['fail'] = $er;
        goto_location("edit-press-listing.php?img_id=" . $img_id . "&press_id=" . $press_id);
    }
}
