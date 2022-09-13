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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // print_r($_POST);die;

    $photo_id = $_POST['photo_id'];
    $imgFile = $_FILES['photoBookImg'];
    $title = $_POST['title'];
    $eventdate = $_POST['eventdate'];

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

        move_uploaded_file($imgFile["tmp_name"], $upPhoto_destination . $newImageNameFile);


        create_thumb($upPhoto_destination . $newImageNameFile, $upPhoto_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


        if (file_exists($upPhoto_destination . $newImageNameFile) && file_exists($upPhoto_thumb_destination . $newImageName)) {

            $fileuploadflag = true;
        } else {
            $fileuploadflag = false;
        }
    } else {

        $fileuploadflag = true;
        $newImageName = '';
    }

    $datetime = date('Y-m-d H:i:s');


    if ($fileuploadflag == true) {
        try {
            $conn = dbconnect();
            $err = false;
            // $time = ($epidate === false) ? NULL : $epidate;
            $query1 = "insert into photobook_img(event_id,photo_title,photo_img,created_at) " . "values(:event_id,:photo_title,:photo_img,:created_at)";
            $bind1 = array(':event_id' => $photo_id, ':photo_title' => $title, ':photo_img' => $newImageName, ':created_at' => $eventdate);
            $stmt1 = $conn->prepare($query1);
            // echo PdoDebugger::show($query1, $bind1);
            // exit;
            if ($stmt1->execute($bind1)) {
                $_SESSION['succ'] = "Image is added successfully";
                goto_location("upload_photobook.php");
                
            } else {
                $_SESSION['fail'] = "Image is not added";
                goto_location("upload_photobook.php");
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
