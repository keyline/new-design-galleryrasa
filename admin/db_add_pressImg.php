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


$allowed = array(
    'gif'	=>	'image/gif',
    'jpeg'  => 'image/jpeg',
    'png'   => 'image/png',
    'jpg'   => 'image/jpg',
    'pdf'   => 'application/pdf'
);

$is_img_pdf=1;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $press_id = $_POST['press_id'];
    $imgFile = $_FILES['titleImg'];
    $title = $_POST['title'];
    $pressdate = $_POST['pressdate'];
    // $epidate = date("l M d, Y",strtotime($epidate1));



    if ($imgFile["name"] != '') {
        $RandomNum = rand(0, 9999999999);

        $fileType= $_FILES['titleImg']['type'];


        $ImageName = str_replace(' ', '-', strtolower($imgFile["name"]));

        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);

        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;


        $orgname = $newImageName;

        $imgarr = explode(".", $orgname);

        //$ImageExt1 = end($imgarr);
        $ImageExt1= pathinfo($orgname, PATHINFO_EXTENSION);

        //security Code

        if (! array_key_exists($ImageExt1, $allowed)) {
            die("The file format is not acceptable");
        }

        if (! in_array($fileType, $allowed)) {
            die("Sorry a problem has occured during uploading the file");
        }

        if ($ImageExt1 == 'pdf') {
            $is_img_pdf=2;
            $fileNameStored = base64_encode($imgarr[0]) . '.' . $ImageExt1;

            move_uploaded_file($imgFile["tmp_name"], $press_pdf_destination . $fileNameStored);

            if (file_exists($press_pdf_destination . $fileNameStored)) {
                $fileuploadflag = true;
            } else {
                $fileuploadflag = false;
            }
        } else {
            //Image upload

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

            move_uploaded_file($imgFile["tmp_name"], $press_destination . $newImageNameFile);


            create_thumb($press_destination . $newImageNameFile, $press_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


            if (file_exists($press_destination . $newImageNameFile) && file_exists($press_thumb_destination . $newImageName)) {
                $fileuploadflag = true;
            } else {
                $fileuploadflag = false;
            }
        }
    } else {
        $fileuploadflag = false;
        $newImageName = '';
    }

    $datetime = date('Y-m-d H:i:s');


    if ($fileuploadflag == true) {
        try {
            $conn = dbconnect();
            $err = false;
            // $time = ($epidate === false) ? NULL : $epidate;


            $query1 = "insert into press_img(press_id,title,title_img,is_img_pdf,create_at) "
                    . "values(:press_id,:title,:title_img,:img_flag,:create_at)";
            $bind1 = array(':press_id' => $press_id, ':title' => $title, ':title_img' => $newImageName, ':img_flag'=> $is_img_pdf,':create_at' => $pressdate);
            $stmt1 = $conn->prepare($query1);
            // echo PdoDebugger::show($query1, $bind1);
            // exit;
            if ($stmt1->execute($bind1)) {
                $_SESSION['succ'] = "Image is added successfully";
                goto_location("upload_press.php");
            } else {
                $_SESSION['fail'] = "Image is not added";
                goto_location("upload_press.php");
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

            $_SESSION['fail'] = $er;
        }
    } else {
        $_SESSION['fail'] = "Image photo is not added";
    }
}


//  include(ADMIN_HTML . "admin-headerInc.php");
// include(ADMIN_HTML . "add-new-podcast-tpl.php");
//  include(ADMIN_HTML . "admin-footerInc.php");
