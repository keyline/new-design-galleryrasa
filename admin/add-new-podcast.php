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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $epiname = $_POST['epiname'];
    $imgFile = $_FILES['ImageFile'];
    $fename = $_POST['fename'];
    $desc = $_POST['desc'];
    $epidate1 = $_POST['epidate'];
    $epidate = date("l M d, Y",strtotime($epidate1));



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

        move_uploaded_file($imgFile["tmp_name"], $podcast_destination . $newImageNameFile);


        create_thumb($podcast_destination . $newImageNameFile, $podcast_thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);


        if (file_exists($podcast_destination . $newImageNameFile) && file_exists($podcast_thumb_destination . $newImageName)) {

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


            $query1 = "insert into podcast(episode_name,episode_image,featured_name,episode_date,episode_description,created_at,updated_at) "
                    . "values(:episode_name,:episode_image,:featured_name,:episode_date,:episode_description,:created_at,:updated_at)";
            $bind1 = array(':episode_name' => $epiname, ':episode_image' => $newImageName, ':featured_name' => $fename, ':episode_date' => $epidate, ':episode_description' => $desc, ':created_at' => $datetime,
                ':updated_at' => $datetime);
            $stmt1 = $conn->prepare($query1);
// echo PdoDebugger::show($query1, $bind1);
// exit;


            if ($stmt1->execute($bind1)) {
                
                
                $_SESSION['succ'] = "Episode is added successfully";
                
            } else {
                $_SESSION['fail'] = "Episode is not added";
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
            
            $_SESSION['fail'] = $er;
            
            
        }
    }else{
        
        $_SESSION['fail'] = "Episode photo is not added";
    }
}


 include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "add-new-podcast-tpl.php");
 include(ADMIN_HTML . "admin-footerInc.php");
