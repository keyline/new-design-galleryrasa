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


 // $artistid = $_POST['artistid'];
$exibition_id = $_POST['exhibitionid'];


$paintingid = $_POST['paintingid'];

$artists = $_POST['artists'];
$paintingname = $_POST['paintingname'];
$desc = $_POST['desc'];
$medium = $_POST['medium'];
$paintingyear = $_POST['paintingyear'];
$referenceno = $_POST['referenceno'];
$price = $_POST['price'];
$signature = $_POST['signature'];
$dimension = $_POST['dimension'];

// $exhibitionarr = $_POST['exhibition'];

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


        $query1 = "update exhibition_paintings set "
                . "artist_id = :artist_id,name = :name,image = :image,reference_no = :reference_no,signature = :signature,dimension = :dimension,description = :description,medium = :medium,"
                . "year= :year,price = :price,"
                . "updated_at = :updated_at "
                . " where id=:paintingid";
        $bind1 = array(':artist_id' => $artists, ':name' => $paintingname,
            ':image' => $newImageName, ':reference_no' => $referenceno, ':dimension' => $dimension, ':signature' => $signature, ':description' => $desc, ':medium' => $medium,
            ':year' => $paintingyear, ':price' => $price,            
            ':updated_at' => $datetime, ':paintingid' => $paintingid);
        $stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
        if ($stmt1->execute($bind1)) {




            $query3 = "delete from exhibition_paintings_relation where painting_id = :painting_id";
            $bind3 = array(':painting_id' => $paintingid);
            $stmt3 = $conn->prepare($query3);

            if ($stmt3->execute($bind3)) {



                if (!empty($exhibitionarr)) {

                    foreach ($exhibitionarr as $k1 => $v1) {



                        $query2 = "insert into exhibition_paintings_relation(painting_id,exhibition_id,"
                                . "status,created_at,updated_at"
                                . ") "
                                . "values(:painting_id,:exhibition_id,"
                                . ":status,:created_at,:updated_at)";
                        $bind2 = array(':painting_id' => $paintingid, ':exhibition_id' => $v1,
                            ':status' => '1', ':created_at' => $datetime,
                            ':updated_at' => $datetime);
                        $stmt2 = $conn->prepare($query2);

                        if ($stmt2->execute($bind2)) {
                            $addflag = true;
                        }
                    }
                }
            }



            $_SESSION['succ'] = "Painting is edited successfully";
            goto_location("edit-exhibition-painting.php?painting_id=" . $paintingid . "&exibition_id=" . $exibition_id);
        } else {
            $_SESSION['fail'] = "Painting is not edited";
            goto_location("edit-exhibition-painting.php?painting_id=" . $paintingid . "&exibition_id=" . $exibition_id);
        }
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

        $_SESSION['fail'] = $er;
        goto_location("edit-exhibition-painting.php?painting_id=" . $paintingid . "&exibition_id=" . $exibition_id);
    }
} else {

    $_SESSION['fail'] = "Artist photo is not added";
    goto_location("edit-exhibition-artist.php?exibition_id=" . $exibition_id);
}

