<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

$exhibition_thumb_destination = '../' . EXHIBITION_THUMB_IMGS;
$exhibition_destination = '../' . 'exhibition' . '/';




$exhibitionid = $_POST['exhibition'];

$exname = $_POST['exname'];
$desc = $_POST['desc'];
$desc2 = $_POST['desc2'];
$desc3 = $_POST['desc3'];
$start_exdate = $_POST['start_exdate'];
$end_exdate = $_POST['end_exdate'];
$excity = $_POST['excity'];
$exfull_address = $_POST['exfull_address'];
// $status = $_POST['status'];
$imgFile = $_FILES['ImageFile'];

$OldImageFile = $_POST['OldImageFile'];

// print_r($_POST);
// exit();


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



    move_uploaded_file($imgFile["tmp_name"], $exhibition_destination . $newImageNameFile);


    create_thumb($exhibition_destination . $newImageNameFile, $exhibition_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


    if (file_exists($exhibition_destination . $newImageNameFile) && file_exists($exhibition_thumb_destination . $newImageName)) {

        $fileuploadflag = true;
    } else {
        $fileuploadflag = false;
    }
} else {

    $fileuploadflag = true;
    $newImageName = $OldImageFile;
}

$datetime = date('Y-m-d H:i:s');


if ($fileuploadflag == true) {


    try {
        $conn = dbconnect();
        $err = false;


        $query1 = "update exhibition set exhibition_name=:exhibition_name,description=:description,essay_2=:essay_2,essay_3=:essay_3,"
                . "photo=:photo,from_exhibition_date=:from_exhibition_date,"
                ."end_exhibition_date=:end_exhibition_date,city=:city,full_address=:full_address,updated_at=:updated_at "
                . " where id=:exhibitionid";
        $bind1 = array(':exhibition_name' => $exname, ':description' => $desc, ':essay_2' => $desc2, ':essay_3' => $desc3, ':photo' => $newImageName,
            ':from_exhibition_date' => $start_exdate, ':end_exhibition_date' => $end_exdate, ':city' => $excity, ':full_address' => $exfull_address, 
            ':updated_at' => $datetime, ':exhibitionid' => $exhibitionid);
        $stmt1 = $conn->prepare($query1);
// echo PdoDebugger::show($query1, $bind1);
// exit;
        if ($stmt1->execute($bind1)) {


            $_SESSION['succ'] = "Exhibirion is edited successfully";
            goto_location("edit-exhibition.php?exibition_id=" . $exhibitionid);
        } else {
            $_SESSION['fail'] = "Exhibirion is not edited";
            goto_location("edit-exhibition.php?exibition_id=" . $exhibitionid);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

        $_SESSION['fail'] = $er;
        goto_location("edit-exhibition.php?exibition_id=" . $exhibitionid);
    }
} else {

    $_SESSION['fail'] = "Exhibirion photo is not added";
    goto_location("edit-exhibition.php?exibition_id=" . $exhibitionid);
}

