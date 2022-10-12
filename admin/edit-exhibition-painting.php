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
$exhibition_destination = '../' . 'exhibition' . '/';

$exibition_id = $_GET['exibition_id'];

$painting_id = $_GET['painting_id'];

$paintingarr = singlepainting($painting_id);
 // print_r($paintingarr);exit();

$allartist = allartist();
// print_r($allartist);

 $singlemediumarr = singlemedium($paintingarr['medium']);
 $mediumarr = allmedium();


 $existsexhibitionarr = allexhibitionofpaintings($painting_id);



include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "edit-exhibition-painting-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
?>

<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>