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
$press_pdf_destination= '../' . PRESS_PDFS;

$press_id = $_POST['pressid'];
$img_id = $_POST['articleid'];
$title = $_POST['articlename'];

$create_at = $_POST['articledate'];

//  print_r($_POST);die;
$imgFile = $_FILES['ImageFile'];
$OldImageFile = $_POST['OldImageFile'];


$allowed = array(
    'gif'	=>	'image/gif',
    'jpeg'  => 'image/jpeg',
    'png'   => 'image/png',
    'jpg'   => 'image/jpg',
    'pdf'   => 'application/pdf'
);

$is_img_pdf=1;



try {
    //code...
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //if the file uploaded with any error encontered
        if (isset($_FILES['ImageFile']) && $_FILES['ImageFile']['error'] == 0) {
            $fileType= $_FILES['ImageFile']['type'];

            $RandomNum = rand(0, 9999999999);

            $ImageName = str_replace(' ', '-', strtolower($imgFile["name"]));

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);

            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;


            $orgname = $newImageName;

            $imgarr = explode(".", $orgname);

            //$ImageExt1 = end($imgarr);

            //verifying extension of the file
            $ImageExt1= pathinfo($orgname, PATHINFO_EXTENSION);

            if (! array_key_exists($ImageExt1, $allowed)) {
                throw new Exception("The file format is not acceptable", 1);
            }

            if (! in_array($fileType, $allowed)) {
                throw new Exception("Sorry a problem has occured during uploading the file", 1);
            }

            if ($ImageExt1 == 'pdf') {
                //detected pdf
                $is_img_pdf=2;
                $fileNameStored = base64_encode($imgarr[0]) . '.' . $ImageExt1;

                move_uploaded_file($imgFile["tmp_name"], $press_pdf_destination . $fileNameStored);

                if (file_exists($press_pdf_destination . $fileNameStored)) {
                    $fileuploadflag = true;
                } else {
                    $fileuploadflag = false;
                }
            } else {
                //detected image

                //$imgarrcnt = count($imgarr);

                //$imgorgcnt = $imgarrcnt - 1;
                //$orgnameexcptextnd = '';
                // for ($l = 0; $l < $imgorgcnt; $l++) {
                //     if ($l == ($imgorgcnt - 1)) {
                //         $orgnameexcptextnd .= $imgarr[$l];
                //     } else {
                //         $orgnameexcptextnd .= $imgarr[$l] . '.';
                //     }
                //     //$orgnameexcptextnd .= $imgarr[$l];
                // }

                $is_img_pdf=1;


                $fileNameStored = base64_encode($imgarr[0]) . '.' . $ImageExt1;


                move_uploaded_file($imgFile["tmp_name"], $press_destination . $fileNameStored);


                create_thumb($press_destination . $fileNameStored, $press_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


                if (file_exists($press_destination . $fileNameStored) && file_exists($press_thumb_destination . $newImageName)) {
                    $fileuploadflag = true;
                } else {
                    $fileuploadflag = false;
                }
            }
        } elseif (isset($OldImageFile)) {
            # code...

            $fileuploadflag = true;
            $newImageName = $OldImageFile;
            $ext= pathinfo($newImageName, PATHINFO_EXTENSION);
            if ($ext == 'pdf') {
                $is_img_pdf=2;
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }
} catch (\Exception $ex) {
    //throw $th;
    echo $ex->getMessage();
    exit();
}




$datetime = date('Y-m-d H:i:s');
// echo $pressname;
// echo $pressdate;die;
if ($fileuploadflag == true) {
    try {
        $conn = dbconnect();
        $err = false;


        $query1 = "update press_img set "
                . "press_id = :press_id,title = :title,title_img = :title_img,is_img_pdf=:img_flag,create_at = :create_at,"
                . "updated_at = :updated_at "
                . " where img_id=:img_id";
        $bind1 = array(':press_id' => $press_id, ':title' => $title,
            ':title_img'    => $newImageName,
            ':img_flag'     =>$is_img_pdf,
            ':create_at'    => $create_at,
            ':updated_at'   => $datetime, ':img_id' => $img_id);
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
