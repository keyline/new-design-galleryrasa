<link href="<?php echo SITE_URL . CSS_FOLDER ?>select2.css" rel="stylesheet">
<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

$artistvalue = $_POST['artistvalue'];

$artistvaluearr = (explode(",", $artistvalue));

$cntartistvalue = count($artistvaluearr);

$i = 0;
$artistarr = [];
$i2 = 1;
$artiststr = "";

if (!isset($artistvalue) || $artistvalue == '') {
    $artiststr .= "";
} else {
    foreach ($artistvaluearr as $k => $v) {

        $artistvalue2arr = (explode(":", $v));

        $artistarr[$i] = $artistvalue2arr[1];


        if ($cntartistvalue == $i2) {
            $artiststr .= "'" . $artistarr[$i] . "'";
        } else {
            $artiststr .= "'" . $artistarr[$i] . "',";
        }

        $i2++;
        $i++;
    }
}


$classificationval = $_POST['classificationval'];

$classificationvalarr = (explode(",", $classificationval));

$cntclassificationval = count($classificationvalarr);
$j = 1;
$classificationstr = "";
if (!isset($classificationval) || $classificationval == '') {

    $classificationstr .= "";
} else {
    foreach ($classificationvalarr as $k2 => $v2) {
        if ($cntclassificationval == $j) {
            $classificationstr .= "'" . $v2 . "'";
        } else {
            $classificationstr .= "'" . $v2 . "',";
        }
        $j++;
    }
}

$publicationoptions2 = allpublicationyearsnew_optionsall($conn, $artiststr, $classificationstr);
?>
<option value="">Select Year</option>
<?php echo $publicationoptions2 ?>