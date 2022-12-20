<?php

//echo  realpath(__DIR__."/../../Art Work/4oCmYW5kLWZvci10aGlzLXdlLWVyZWN0LXRoZS1tLTc0MzM0MDQ3Nw==.jpg");
//exit;
header('content-type: image/' . $_GET['ext']);

//$url = GetUrl('../../Art Work/falling-figure,-p.38-1457264809.jpg');
$_GET['img'];


$ext = $_GET['ext'];


$encode_str = base64_encode($_GET['img']);

$fileimage = $encode_str . '.' . $ext;

$realpath = realpath(__DIR__ . "/../../Art Work/" . $fileimage);

$contents = file_get_contents($realpath);

echo $contents;
