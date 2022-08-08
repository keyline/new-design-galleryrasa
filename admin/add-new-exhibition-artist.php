<?php

/* Project Name: Rasa
 * Author: Keyline
 * Author URI: http://www.keylines.net
 * Author e-mail: info@keylines.net
 * Version: 1.0
 * Created: July 2017
 * License: http://keylines.net/
 */
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

$exhibition_thumb_destination = '../' . EXHIBITION_THUMB_IMGS;
$exhibition_destination = '../' . 'exhibition' . '/';

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $artistname = $_POST['artistname'];
    $desc = $_POST['desc'];
    
    $imgFile = $_FILES['ImageFile'];



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
        $newImageName = '';
    }

    $datetime = date('Y-m-d H:i:s');


    if ($fileuploadflag == true) {
        try {
            $conn = dbconnect();
            $err = false;


            $query1 = "insert into exhibition_artists(artist_name,artist_description,photograph,status,created_at,updated_at) "
                    . "values(:artist_name,:artist_description,:photograph,:status,:created_at,:updated_at)";
            $bind1 = array(':artist_name' => $artistname, ':artist_description' => $desc, ':photograph' => $newImageName,
                 ':status' => '1', ':created_at' => $datetime,
                ':updated_at' => $datetime);
            $stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
            if ($stmt1->execute($bind1)) {
                
                
                $_SESSION['succ'] = "Exhibition Artist is added successfully";
                
            } else {
                $_SESSION['fail'] = "Exhibition Artist is not added";
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
            
            $_SESSION['fail'] = $er;
            
            
        }
    }else{
        
        $_SESSION['fail'] = "Artist photo is not added";
    }
}


include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "add-new-exhibition-artist-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
