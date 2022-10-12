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

// $artistid = $_GET['artistid'];
$exibition_id = $_GET['exibition_id'];

// $artistarr = singleexhibitionartist($artistid);
$exhibitionarr = singleexhibition($exibition_id);

 $artistarr = allartist();
 // print_r($artistarr);exit();

$mediumarr = allmedium();
// print_r($mediumarr);exit();

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $exhibitionid = $_POST['exhibitionid'];
    $artist = $_POST['artist'];
    $paintingname = $_POST['paintingname'];
    $referenceno = $_POST['referenceno'];
    $dimension = $_POST['dimension'];
    $signature = $_POST['signature'];
    $desc = $_POST['desc'];
    $medium = $_POST['medium'];
    $paintingyear = $_POST['paintingyear'];
    // $paintingdate = $_POST['paintingdate'];
    $price = $_POST['price'];
    // $available_at = $_POST['available_at'];
    // $status = $_POST['status'];


    //$exhibitionarr = $_POST['exhibition'];
     // print_r($exhibition);exit();

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


            $query1 = "insert into exhibition_paintings(exhibition_id,artist_id,name,reference_no,image,dimension,signature,description,medium,year,price,created_at,updated_at) values(:exhibition_id,:artist_id,:name,:reference_no,:image,:dimension,:signature,:description,:medium,:year,:price,:created_at,:updated_at)";
            $bind1 = array(':exhibition_id' => $exhibitionid, ':artist_id' => $artist, ':name' => $paintingname, ':reference_no' => $referenceno, ':image' => $newImageName, ':dimension' => $dimension, ':signature' => $signature, ':description' => $desc, ':medium' => $medium, ':year' => $paintingyear, ':price' => $price, ':created_at' => $datetime, ':updated_at' => $datetime);
            $stmt1 = $conn->prepare($query1);
// echo PdoDebugger::show($query1, $bind1);
// exit;
            if ($stmt1->execute($bind1)) {

                $lastenteredarr = last_entered_painting($exhibitionid);
                    // print_r($lastenteredarr);exit();

                if (!empty($artistarr)) {

                      // print_r($artistarr);exit();

                    foreach ($artistarr as $k1 => $v1) {



                        $query2 = "insert into exhibition_paintings_relation(painting_id,exhibition_id,artist_id,"
                                . "status,created_at,updated_at"
                                . ") "
                                . "values(:painting_id,:exhibition_id,:artist_id,"
                                . ":status,:created_at,:updated_at)";
                        $bind2 = array(':painting_id' => $lastenteredarr['id'], ':exhibition_id' => $lastenteredarr['exhibition_id'], ':artist_id' => $v1['id'], ':status' => 1, ':created_at' => $datetime, ':updated_at' => $datetime);
                        $stmt2 = $conn->prepare($query2);
                        // echo PdoDebugger::show($query2, $bind2);
                        // exit();
                        
                        if ($stmt2->execute($bind2)) {
                            $addflag = true;
                        }
                    }
                }




                $_SESSION['succ'] = "Painting is added successfully";
            } else {
                $_SESSION['fail'] = "Painting is not added";
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

            $_SESSION['fail'] = $er;
        }
    } else {

        $_SESSION['fail'] = "Painting photo is not added";
    }
}


include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "add-new-painting-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
?>

<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>