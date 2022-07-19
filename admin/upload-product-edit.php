<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$destination = '../' . IMGSRC;
check_auth_admin();
$thumb_destination = '../' . THUMB_IMGS;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (empty($_FILES['ImageFile'])) {
	     echo '<b<span class="text-danger">Select Image</span>';
	     exit;
	     }

    $imgFile = $_FILES['ImageFile'];
    $fileCount = count($imgFile["name"]);
    $uploaded = $status = '';
    $conn = dbconnect();
    for ($i = 0; $i < $fileCount; $i++) {
        if (in_array($imgFile["type"][$i], $allowedFiles)) {

            if (!is_uploaded_file($imgFile["tmp_name"][$i])) {
                $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed</span></b></li>';
            }

            $RandomNum = rand(0, 9999999999);

            $ImageName = str_replace(' ', '-', strtolower($imgFile["name"][$i]));

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);

            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;

            move_uploaded_file($imgFile["tmp_name"][$i], $destination . $newImageName);
            create_thumb($destination . $newImageName, $thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT,
                98);
            $qry = insert(IMAGES_TBL, array('id' => 'null', 'prodid' => ':id', 'img_name' => ':img'));
            $q = $conn->prepare($qry);
            $bind = array(':id' => $_POST['pid'], ':img' => $newImageName);
            $q->execute($bind);
            $id = $conn->lastInsertId();
            if (file_exists($destination . $newImageName) && file_exists($thumb_destination . $newImageName)) {
                $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="success">Uploaded</span></b></li>';
            }

            $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $thumb_destination . $newImageName . '"></a><span id="del" data-pid="' . $_POST['pid'] . '" data-id="' . $id . '" data-img_name="' . $newImageName . '" class="glyphicon glyphicon-remove" aria-hidden="true"></span> <a href="#" id="img_upd" data-id="' . $_POST['pid'] . '" data-img="' . $newImageName . '">set as main</a><br /></div>';
        } else {
            $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not an image</b></li>';
        }

    }
    echo ' <div class="row">' . $uploaded . '</div>';
    echo '<div class="row"><ul class="list-group">' . $status . '</ul></div>';


}
?>