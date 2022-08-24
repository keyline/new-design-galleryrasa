<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
// $destination = '../' . IMGSRC;
$destination = '../images/exibition';
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

            move_uploaded_file($imgFile["tmp_name"], $destination . $newImageName);
            
            create_thumb($destination . $newImageName, $thumb_destination . $newImageName, THUMB_WIDTH, THUMB_HEIGHT,
                98);

            if (file_exists($destination . $newImageName) && file_exists($thumb_destination . $newImageName)) {
                $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="success">Success</span></b></li>';
                $arr['imgs'][$i] = $newImageName;
            }

            $uploaded .= '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="' . $thumb_destination . $newImageName . '"></a></div>';
        } else {
            $status .= '<li class="list-group-item">' . $imgFile["name"][$i] . ': <b><span class="error">Failed:</span> Not Image</b></li>';
        }

    }
    echo ' <div class="row">' . $uploaded . '</div>';
    echo '<div class="row"><ul class="list-group">' . $status . '</ul></div>';
    $_SESSION['imgs'] = $arr['imgs'];

}
?>