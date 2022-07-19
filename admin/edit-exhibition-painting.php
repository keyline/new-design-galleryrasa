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
$exhibition_destination = '../../' . 'exhibition' . '/';

$artist_id = $_GET['artist_id'];

$painting_id = $_GET['painting_id'];

$artistarr = singleexhibitionartist($artist_id);


$paintingarr = singlepainting($painting_id);

$singlemediumarr = singlemedium($paintingarr['medium']);
$mediumarr = allmedium();


//$singleexhibitionarr = singleexhibition($paintingarr['exhibition_id']);


$exhibitionarr = allexhibition();


$existsexhibitionarr = allexhibitionofpaintings($painting_id);


$arrlength = count($existsexhibitionarr);
$j = 1;
$exhibitionnotinstr = '';        
if (!empty($existsexhibitionarr)) {
    foreach ($existsexhibitionarr as $k3 => $v3) {
        
        if($existsexhibitionarr == $j){
            $exhibitionnotinstr .= $v3['exhibition_id'];
        }else{
            $exhibitionnotinstr .= $v3['exhibition_id'].',';
        }
        
      $j++;  
    }
}


//echo allexhibitionnotin($exhibitionnotinstr);
//
//exit;

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "edit-exhibition-painting-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
?>

<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>