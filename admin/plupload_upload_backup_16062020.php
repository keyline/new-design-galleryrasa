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
check_auth_admin();
$thumb_destination = '../' . THUMB_IMGS;



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
    if (empty($_FILES['file'])) {
        echo '<b<span class="text-danger">Select Image</span>';
        exit;
    }

    $imgFile = $_FILES['file'];
    $fileCount = count($imgFile["name"]);
    $uploaded = $status = '';
    
    if ($_REQUEST['type'] == 'va-images') {
        //For visual Archive
        
        for ($i = 0; $i < $fileCount; $i++) {
        
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
                    'va_image_id'        => 'null',
                    'va_product_id'        => ':productID',
                    'va_image_name'      => ':imageName',
                    'va_status'               => ':flag' ,
                    'va_date_created'          => 'now()'
                    
                );
                $bind = array(
                    ':productID' => stripslashes($_POST['marker']),
                    ':imageName'    => $newImageName,
                    ':flag'         => 1,
                    
                );
                try{
                    $conn = dbconnect();
                    $err = false;
                    $qry = insert("visual_archive_images", $columns);
//                   echo PdoDebugger::show($qry, $bind);
                    $q = $conn->prepare($qry);
                    
                    $q->execute($bind);
                    $id = $conn->lastInsertId();
                } catch (PDOException $pe){
                    $err = true;
                    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
                }
            }

            $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $thumb_destination . $newImageName . '"></a></div>';
        } else {
            $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not Image</b></li>';
        }
    }
        
        
    }elseif($_REQUEST['type'] != 'bibliography'){
        
        for ($i = 0; $i < $fileCount; $i++) {
        
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
                    'm_image_id'        => 'null',
                    'product_id'        => ':productID',
                    'm_image_name'      => ':imageName',
                    'm_image_category'  => ':imageCategory',
                    'm_image_category_text'=> ':categoryText',
                    'status'               => ':flag' ,
                    'date_created'          => 'now()'
                    
                );
                $bind = array(
                    ':productID' => stripslashes($_POST['marker']),
                    ':imageName'    => $newImageName,
                    ':imageCategory'=> uppercasewords(substr($_POST['type'], 0, 1)),
                    ':categoryText' => uppercasefirstword($_POST['type']),
                    ':flag'         => 1,
                    
                );
                try{
                    $conn = dbconnect();
                    $err = false;
                    $qry = insert(MEMORIBILA_IMAGES_TBL, $columns);
//                   echo PdoDebugger::show($qry, $bind);
                    $q = $conn->prepare($qry);
                    
                    $q->execute($bind);
                    $id = $conn->lastInsertId();
                } catch (PDOException $pe){
                    $err = true;
                    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
                }
            }

            $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $thumb_destination . $newImageName . '"></a></div>';
        } else {
            $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not Image</b></li>';
        }
    }
    }else{
                
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
                    'm_image_id'        => 'null',
                    'product_id'        => ':productID',
                    'm_image_name'      => ':imageName',
                    'm_image_category'  => ':imageCategory',
                    'm_image_category_text'=> ':categoryText',
                    'status'               => ':flag' ,
                    'date_created'          => 'now()'
                    
                );
                $bind = array(
                    ':productID' => stripslashes($_POST['marker']),
                    ':imageName'    => $newImageName,
                    ':imageCategory'=> uppercasewords(substr($_POST['type'], 0, 1)),
                    ':categoryText' => uppercasefirstword($_POST['type']),
                    ':flag'         => 1,
                    
                );
                try{
                    $conn = dbconnect();
                    $err = false;
                    $qry = insert(MEMORIBILA_IMAGES_TBL, $columns);
//                   echo PdoDebugger::show($qry, $bind);
                    $q = $conn->prepare($qry);
                    
                    $q->execute($bind);
                    $id = $conn->lastInsertId();
                } catch (PDOException $pe){
                    $err = true;
                    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
                }
            }
           $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $newImageName . '"></a></div>';
    }

    
}

