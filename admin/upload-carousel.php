<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$destination = '../' . IMGSRC;
check_auth_admin();
$thumb_destination = '../' . THUMB_IMGS;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	 $uploaded = $status = '';
	if (empty($_FILES['ImageFile'])) {
	     echo '<b<span class="text-danger">Select Image</span>';
	     exit;
	     } 
	    $imgFile = $_FILES['ImageFile'];
	   
	    $conn = dbconnect();

    if (in_array($imgFile["type"], $allowedFiles)) {

        if (!is_uploaded_file($imgFile["tmp_name"])) {
            $status .= $imgFile["name"] . ': <b<span class="error">Failed</span></b>';
        }
	
        $newImageName = upload_name($imgFile);

        move_uploaded_file($imgFile["tmp_name"], $destination . $newImageName);
        create_thumb($destination . $newImageName, $thumb_destination . $newImageName, 150, 100, 98);
        if (file_exists($destination . $newImageName)) {
            $status = $imgFile["name"] . ': <b><span class="success">Success</span></b>';

        }


        $uploaded .= '<input name="img" type="hidden"  value="' . $newImageName . '">';
    } else {
        $status .= $imgFile["name"] . ': <b><span class="error">Failed:</span> Not an image</b>';
    }

    $_SESSION['cimg'] = $newImageName;
    echo $uploaded;
    echo $status;
    echo '<br /><img src="' . $thumb_destination . $newImageName . '"></a><br /><br />';


}
?>