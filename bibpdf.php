<?php

header("Content-type:application/". $_GET['ext']);

//header("Content-Disposition:attachment;filename=downloaded.".$_GET['ext']."");
header("Content-Disposition:attachment;filename=".$_GET['pdf'].".".$_GET['ext']."");

$_GET['pdf'];

$ext = $_GET['ext'];

$encode_str = base64_encode($_GET['pdf']);

$fileimage = $encode_str . '.' . $ext;

$realpath = realpath(__DIR__ . "/../bibliograply_pdf/" . $fileimage);

$contents = file_get_contents($realpath);

echo $contents;
//exit;