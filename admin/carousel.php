<?php
/* Project Name: Rasa Gallery
 * Author: Keylines
 * Author URI: http://www.keylines.net
 * Author e-mail: info@keylines.net
 * Created: Jan 2018
 * License: http://keylines.net/
 */
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
$title = "Image Slider";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    //cache_carousel($conn);
    goto_location('carousel');

} else {
    $category = (isset($_REQUEST['catg']) && ($_REQUEST['catg'] == 'bibliography')) ? 'B' : 'M';
    
    $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE `category`=:catg ORDER BY id desc";
    $q = $conn->prepare($sql);
    $q->bindParam(':catg', $category);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);

    $items = $c = '';
    if ($q->rowCount() > 0) {

        while ($row = $q->fetch()) {
            $c .= '<div class="well" id="well' . $row['id'] . '">';
            $c .= list_carousel($row['id'],$row['status'], $row['image_nm']);
            $c .= '</div>';
        }
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    $tpl = file_get_contents(ADMIN_HTML . 'carousel-tpl.php');
    $search = array('{IMAGE_SLIDES}', '{category}');
    $replace = array($c, $category);
    echo str_replace($search, $replace, $tpl);
    include(ADMIN_HTML . "admin-footerInc.php");
}

?>  