<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
include(INC_FOLDER . "headerInc.php");
$image_id = $_GET['image_id'];
$image_type = $_GET['image_type'];

count_click('memoribilia_image',$image_id);

$qry_sel = "SELECT * from memorabilia_images where m_image_id = '$image_id'";

$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
$prod_id = $row_sel['product_id'];
$image_name = $row_sel['m_image_name'];
$image_details = $row_sel['m_image_details'];
//$taxable = $row_sel['is_taxable'];
$image_folder = strtolower($image_type);
?>
<main>
<div class="container arial">
    <h1 style="text-align: center; font-size: 2rem; margin-bottom: 30px;">Item Details</h1> 
    <div class="row">
        <div class="col-md-6 text-center mb-3">
            <img src="<?php echo SITE_URL.'/product_images/'.$image_folder.'/'.$image_name; ?>" class="img-fluid"> 
        </div>
        <div class="col-md-6">
            <?php
            $imageDetails = '';
            $imageDetails .= get_html_from_JSON($image_details, $image_type, $prod_id);
            //$imageDetails .= get_add_to_cart_button($image_details, $image_type);
            echo $imageDetails;     
            ?>
        </div>
    </div>
</div>
</main>
</div>
<?php
include(INC_FOLDER . "footerInc.php");