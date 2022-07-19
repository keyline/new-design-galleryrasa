<?php
/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */
// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");

$destination = '../' . IMGSRC . $_POST['type'] . '/';
$artwork_destination = '../../' . 'Art Work' . '/';

check_auth_admin();
$va_destination = '../' . IMGSRC . VARCHIVE;
$thumb_destination = '../' . THUMB_IMGS;
$va_thumb_destination = '../' . VA_THUMB_IMGS;
$destination_medium = '../' . VA_MEDIUM_URL;



/*
  // Support CORS
  header("Access-Control-Allow-Origin: *");
  // other CORS headers if any...
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  exit; // finish preflight CORS requests here
  }
 */
print "<pre>";
print_r($_POST);
print_r($_FILES);

print "</pre>";
//exit;


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Create target dir
    if (!file_exists($destination)) {
        @mkdir($destination);
    }

    if (empty($_FILES) || $_FILES['file']['error']) {
        die('{"OK": 0, "info": "Failed to move uploaded file."}');
    }

    $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;

    $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

    if ($_REQUEST['type'] === 'Art Work') {
        //For visual Archive

        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];

        $filePath = $artwork_destination . $fileName;

        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (in_array($ext, $allowedFiles_artwork)) {


            if (!is_uploaded_file($_FILES['file']["tmp_name"])) {
                die('{"OK": 0, "info": "Some kind of phishing is present"}');
            }
            
            /*  PROCESSING THE CHUNKS/bytes of stream   */
            
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            
            if($out)
            {
                // Read binary input stream and append it to temp file
                $in = @fopen($_FILES['file']['tmp_name'], "rb");
                
                if ($in) {
		while ($buff = fread($in, 4096))
			fwrite($out, $buff);
                } else{
		die('{"OK": 0, "info": "Failed to open input stream."}');
                }
                
               @fclose($in);
               
               @fclose($out); 
               
               @unlink($_FILES['file']['tmp_name']);
               
               
            }else{
            die('{"OK": 0, "info": "Failed to open output stream."}'); }   


            $RandomNum = rand(0, 9999999999);

            $ImageName = str_replace(' ', '-', strtolower($_REQUEST["name"]));

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);

            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;




//                $orgname = $newImageName;
//
//                $imgarr = explode(".", $orgname);
//
//                $ImageExt1 = end($imgarr);
//
//                $imgarrcnt = count($imgarr);
//
//                $imgorgcnt = $imgarrcnt - 1;
//                $orgnameexcptextnd = '';
//                for ($l = 0; $l < $imgorgcnt; $l++) {
//
//                    if ($l == ($imgorgcnt - 1)) {
//
//                        $orgnameexcptextnd .= $imgarr[$l];
//                    } else {
//                        $orgnameexcptextnd .= $imgarr[$l] . '.';
//                    }
//                    
//                }
//
//                $newImageNameFile = base64_encode($orgnameexcptextnd) . '.' . $ImageExt1;



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

            /*  RENAMING THE PART FILE TO ORGINAL FILE NAME */
            // Check if file has been uploaded
            if (!$chunks || $chunk == $chunks - 1) {
                    // Strip the temp .part suffix off 
                    rename("{$filePath}.part", $artwork_destination.$newImageNameFile);
                    
                    create_thumb($artwork_destination . $newImageNameFile, $va_thumb_destination . $newImageName, VA_THUMB_WIDTH, VA_THUMB_HEIGHT, 98);
            }


            //$newMediumImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '-medium' .'.' . $ImageExt;

            //move_uploaded_file($imgFile["tmp_name"], $artwork_destination . $newImageNameFile);


            

            //medium size image
            //create_thumb($artwork_destination . $newImageNameFile, $destination_medium . $newImageName, VA_MEDIUM_WIDTH, VA_MEDIUM_HEIGHT, 98);
            //if (file_exists($destination . $newImageName) && file_exists($thumb_destination . $newImageName)) {
            if (file_exists($artwork_destination . $newImageNameFile) && file_exists($va_thumb_destination . $newImageName)) {
                //$status .= '<li class="list-group-item">' . $imgFile["name"] . ': <b><span class="success">Success</span></b></li>';
                //$arr['imgs'][$i] = $newImageName;
                $columns = array(
                    'va_image_id' => 'null',
                    'va_product_id' => ':productID',
                    'va_image_name' => ':imageName',
                    'va_image_category' => ':va_img_cat',
                    'va_image_category_text' => ':va_img_catText',
                    'va_status' => ':flag',
                    'va_date_created' => 'now()'
                );
                $bind = array(
                    ':productID' => stripslashes($_POST['marker']),
                    ':imageName' => $newImageName,
                    ':va_img_cat' => "AW",
                    ':va_img_catText' => "Art Work",
                    ':flag' => 1
                );
                try {
                    $conn = dbconnect();
                    $err = false;
                    $qry = insert("visual_archive_images", $columns);
                    echo PdoDebugger::show($qry, $bind);
                    $q = $conn->prepare($qry);

                    $q->execute($bind);
                    $id = $conn->lastInsertId();
                } catch (PDOException $pe) {
                    $err = true;
                    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
                }
            }

            //$uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $va_thumb_destination . $newImageName . '"></a></div>';
        } else {
            //$status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not Image</b></li>';
        }
    } elseif ($_REQUEST['type'] === 'Artist Photograph') {
        
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];

        $filePath = $artwork_destination . $fileName;

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);

            if (in_array($ext, $allowedFiles_artwork)) {


                if (!is_uploaded_file($_FILES['file']["tmp_name"])) {
                    die('{"OK": 0, "info": "Some kind of phishing is present"}');
                }
            /*  Processing of chunks    */    
                // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            
            if($out)
            {
                // Read binary input stream and append it to temp file
                $in = @fopen($_FILES['file']['tmp_name'], "rb");
                
                if ($in) {
		while ($buff = fread($in, 4096))
			fwrite($out, $buff);
                } else{
		die('{"OK": 0, "info": "Failed to open input stream."}');
                }
                
               @fclose($in);
               
               @fclose($out); 
               
               @unlink($_FILES['file']['tmp_name']);
               
               
            }else{
            die('{"OK": 0, "info": "Failed to open output stream."}'); }   

                $RandomNum = rand(0, 9999999999);

                $ImageName = str_replace(' ', '-', strtolower($_REQUEST["name"]));

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
                
                /*  RENAMING THE PART FILE TO ORGINAL FILE NAME */
            // Check if file has been uploaded
            if (!$chunks || $chunk == $chunks - 1) {
                    // Strip the temp .part suffix off 
                    rename("{$filePath}.part", $artwork_destination.$newImageNameFile);
            }






                //$newMediumImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '-medium' .'.' . $ImageExt;
                //move_uploaded_file($imgFile["tmp_name"], $destination . $newImageName);


                //move_uploaded_file($imgFile["tmp_name"], $artwork_destination . $newImageNameFile);

                //create_thumb($destination . $newImageName, $thumb_destination . $newImageName, VA_THUMB_WIDTH, VA_THUMB_HEIGHT, 98);
                create_thumb($artwork_destination . $newImageNameFile, $va_thumb_destination . $newImageName, VA_THUMB_WIDTH, VA_THUMB_HEIGHT, 98);

                //medium size image
                //create_thumb($destination . $newImageName, $destination_medium . $newMediumImageName, VA_MEDIUM_WIDTH, VA_MEDIUM_HEIGHT, 98);



                if (file_exists($artwork_destination . $newImageNameFile) && file_exists($va_thumb_destination . $newImageName)) {
                    //$status .= '<li class="list-group-item">' . $imgFile["name"] . ': <b><span class="success">Success</span></b></li>';
                    //$arr['imgs'][$i] = $newImageName;
                    $columns = array(
                        'va_image_id' => 'null',
                        'va_product_id' => ':productID',
                        'va_image_name' => ':imageName',
                        'va_image_category' => ':va_img_cat',
                        'va_image_category_text' => ':va_img_catText',
                        'va_status' => ':flag',
                        'va_date_created' => 'now()'
                    );
                    $bind = array(
                        ':productID' => stripslashes($_POST['marker']),
                        ':imageName' => $newImageName,
                        ':va_img_cat' => "PA",
                        ':va_img_catText' => "Artist Photograph",
                        ':flag' => 1
                    );
                    try {
                        $conn = dbconnect();
                        $err = false;
                        $qry = insert("visual_archive_images", $columns);
//                   echo PdoDebugger::show($qry, $bind);
                        $q = $conn->prepare($qry);

                        $q->execute($bind);
                        $id = $conn->lastInsertId();
                    } catch (PDOException $pe) {
                        $err = true;
                        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
                    }
                }

                //$uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $va_thumb_destination . $newImageName . '"></a></div>';
            } else {
                //$status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not Image</b></li>';
            }
        
    } elseif ($_REQUEST['type'] != 'bibliography') {
        $imgFile= (!empty($_FILES['file'])) ? $_FILES['file'] : $imgFile;

        for ($i = 0; $i < count($imgFile); $i++) {

            if (in_array($imgFile["type"], $allowedFiles)) {


                if (!is_uploaded_file($imgFile["tmp_name"])) {
                    $status .= '<li class="list-group-item">' . $imgFile["name"] . ': <b><span class="error">Failed</span></b></li>';
                }

                $RandomNum = rand(0, 9999999999);

                $ImageName = str_replace(' ', '-', strtolower($imgFile["name"]));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;


                move_uploaded_file($imgFile["tmp_name"], $destination . $newImageName);


                create_thumb($destination . $newImageName, $thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);

                if (file_exists($destination . $newImageName) && file_exists($thumb_destination . $newImageName)) {
                    $status .= '<li class="list-group-item">' . $imgFile["name"] . ': <b><span class="success">Success</span></b></li>';
                    //$arr['imgs'][$i] = $newImageName;
                    $columns = array(
                        'm_image_id' => 'null',
                        'product_id' => ':productID',
                        'm_image_name' => ':imageName',
                        'm_image_category' => ':imageCategory',
                        'm_image_category_text' => ':categoryText',
                        'status' => ':flag',
                        'date_created' => 'now()'
                    );
                    $bind = array(
                        ':productID' => stripslashes($_POST['marker']),
                        ':imageName' => $newImageName,
                        ':imageCategory' => uppercasewords(substr($_POST['type'], 0, 1)),
                        ':categoryText' => uppercasefirstword($_POST['type']),
                        ':flag' => 1,
                    );
                    try {
                        $conn = dbconnect();
                        $err = false;
                        $qry = insert(MEMORIBILA_IMAGES_TBL, $columns);
//                   echo PdoDebugger::show($qry, $bind);
                        $q = $conn->prepare($qry);

                        $q->execute($bind);
                        $id = $conn->lastInsertId();
                    } catch (PDOException $pe) {
                        $err = true;
                        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
                    }
                }

                $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $thumb_destination . $newImageName . '"></a></div>';
            } else {
                $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not Image</b></li>';
            }
        }
    } else {
        $imgFile= (!empty($_FILES['file'])) ? $_FILES['file'] : $imgFile;

        if (!is_uploaded_file($imgFile["tmp_name"])) {
            $status .= '<li class="list-group-item">' . $imgFile["name"] . ': <b><span class="error">Failed</span></b></li>';
        }

        $RandomNum = rand(0, 9999999999);

        $ImageName = str_replace(' ', '-', strtolower($imgFile["name"]));

        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);

        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;


        move_uploaded_file($imgFile["tmp_name"], $destination . $newImageName);
        create_thumb($destination . $newImageName, $thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT, 98);
        if (file_exists($destination . $newImageName)) {
            $status .= '<li class="list-group-item">' . $imgFile["name"] . ': <b><span class="success">Success</span></b></li>';
            //$arr['imgs'][$i] = $newImageName;
            $columns = array(
                'm_image_id' => 'null',
                'product_id' => ':productID',
                'm_image_name' => ':imageName',
                'm_image_category' => ':imageCategory',
                'm_image_category_text' => ':categoryText',
                'status' => ':flag',
                'date_created' => 'now()'
            );
            $bind = array(
                ':productID' => stripslashes($_POST['marker']),
                ':imageName' => $newImageName,
                ':imageCategory' => uppercasewords(substr($_POST['type'], 0, 1)),
                ':categoryText' => uppercasefirstword($_POST['type']),
                ':flag' => 1,
            );
            try {
                $conn = dbconnect();
                $err = false;
                $qry = insert(MEMORIBILA_IMAGES_TBL, $columns);
//                   echo PdoDebugger::show($qry, $bind);
                $q = $conn->prepare($qry);

                $q->execute($bind);
                $id = $conn->lastInsertId();
            } catch (PDOException $pe) {
                $err = true;
                $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
            }
        }
        $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $newImageName . '"></a></div>';
    }
}

