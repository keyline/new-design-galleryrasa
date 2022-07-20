<?php

session_start();
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();


$prodid = $_POST['prodid'];
$userid = $_POST['userid'];


$prodimagearr = vaprodimages($prodid);



foreach ($prodimagearr as $k => $v) {

    $dbimage = $v['va_image_name'];

    $imgarr = explode(".", $dbimage);

    $ext = end($imgarr);

    $imgarrcnt = count($imgarr);

    $orgnameexcptextnd = '';
    $imgorgcnt = $imgarrcnt - 1;
    for ($l = 0; $l < $imgorgcnt; $l++) {

        if ($l == ($imgorgcnt - 1)) {

            $orgnameexcptextnd .= $imgarr[$l];
        } else {
            $orgnameexcptextnd .= $imgarr[$l] . '.';
        }
    }

//    $encode_str = base64_encode($orgnameexcptextnd);
//    
//    $fileimage = $encode_str . '.' . $ext;

    echo '<img  class="img-responsive" src="' . '../artworkimage/' . $orgnameexcptextnd . '/' . $ext . '">';
}