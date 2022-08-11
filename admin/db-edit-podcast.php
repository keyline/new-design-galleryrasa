<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

$podcast_thumb_destination = '../' . PODCAST_THUMB_IMGS;
$podcast_destination = '../' . 'podcast' . '/';

$episodeid = $_POST['episode'];

$epiname = $_POST['epiname'];
$imgFile = $_FILES['ImageFile'];
$fename = $_POST['fename'];
$epidate1 = $_POST['epidate'];
$epidate = date("l M d, Y",strtotime($epidate1));
$desc = $_POST['desc'];

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



    move_uploaded_file($imgFile["tmp_name"], $podcast_destination . $newImageNameFile);


    create_thumb($podcast_destination . $newImageNameFile, $podcast_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


    if (file_exists($podcast_destination . $newImageNameFile) && file_exists($podcast_thumb_destination . $newImageName)) {

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


        $query1 = "update podcast set episode_name=:episode_name,episode_image=:episode_image,featured_name=:featured_name,episode_date=:episode_date,episode_description=:episode_description,updated_at=:updated_at where episode_id=:episodeid";
        $bind1 = array(':episode_name' => $epiname, ':episode_image' => $newImageName, ':featured_name' => $fename, ':episode_date' => $epidate, ':episode_description' => $desc,
            ':updated_at' => $datetime, ':episodeid' => $episodeid);
        $stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
        if ($stmt1->execute($bind1)) {


            $_SESSION['succ'] = "Episode is edited successfully";
            goto_location("edit-podcast.php?episode_id=" . $episodeid);
        } else {
            $_SESSION['fail'] = "Episode is not edited";
            goto_location("edit-podcast.php?episode_id=" . $episodeid);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

        $_SESSION['fail'] = $er;
        goto_location("edit-podcast.php?episode_id=" . $episodeid);
    }
} else {

    $_SESSION['fail'] = "Episode photo is not added";
    goto_location("edit-podcast.php?episode_id=" . $episodeid);
}

