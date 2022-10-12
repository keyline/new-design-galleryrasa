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




$artistid = $_POST['artistid'];

$artistname = $_POST['artistname'];
$desc = $_POST['desc'];
$birth = $_POST['birth'];
$death = $_POST['death'];
$status = $_POST['status'];
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


        $query1 = "update exhibition_artists set artist_name=:artist_name,artist_birth=:artist_birth,artist_death=:artist_death,artist_description=:artist_description,"
                . "photograph=:photograph,status=:status,updated_at=:updated_at "
                . " where id=:artistid";
        $bind1 = array(':artist_name' => $artistname, ':artist_birth' => $birth, ':artist_death' => $death, ':artist_description' => $desc, 
            ':photograph' => $newImageName,
            ':status' => $status, 
            ':updated_at' => $datetime, ':artistid' => $artistid);
        $stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
        if ($stmt1->execute($bind1)) {


            $_SESSION['succ'] = "Artist is edited successfully";
            goto_location("edit-exhibition-artist.php?artist_id=" . $artistid);
        } else {
            $_SESSION['fail'] = "Artist is not edited";
            goto_location("edit-exhibition-artist.php?artist_id=" . $artistid);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

        $_SESSION['fail'] = $er;
        goto_location("edit-exhibition-artist.php?artist_id=" . $artistid);
    }
} else {

    $_SESSION['fail'] = "Artist photo is not added";
    goto_location("edit-exhibition-artist.php?artist_id=" . $artistid);
}

