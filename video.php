<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
include(INC_FOLDER . "headerInc.php");
$vdo_id = $_GET['vdo'];
$qry_sel = "select * from video where id = '$vdo_id'";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$count_sel = $q_sel->rowCount();
$row_sel = $q_sel->fetch();
$id = $row_sel['id'];
$product = $row_sel['product_id'];
$video = $row_sel['video_link'];

$product_tbl = get_prod_name($product);
$product_name = $product_tbl['prodname'];
?>

<div  class="container">
    <div class="row">
        <div class="col-md-12 film-heading">
            <h1 class="filmName"><?php echo $product_name; ?></h1>
        </div>
        <div class="col-md-12 film-heading">
            <?php   
            $vdo_url = trim($video);
            $whatIWant = substr($vdo_url, strpos($vdo_url, "?") + 3);
            if (strpos($whatIWant, '&') !== false) { 
            $substring_vdo = substr($whatIWant, 0, strpos($whatIWant, '&'));
            } else{
               $substring_vdo = $whatIWant;
            }
            ?>
            <div class="embed-responsive embed-responsive-16by9"> <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $substring_vdo; ?>?rel=0" allowfullscreen></iframe> </div>
            
        </div>

    </div>
</div>

<?php
include(INC_FOLDER . "footerInc.php");
