<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
include(ADMIN_HTML . "admin-headerInc.php");
check_auth_admin();
$conn = dbconnect();
$prod_id = $_GET['prod_id'];

$qry_mem = "select * from products_ecomc where prodid = '$prod_id'";
$q_mem = $conn->prepare($qry_mem);
$q_mem->execute();
$q_mem->setFetchMode(PDO::FETCH_ASSOC);
$row_mem = $q_mem->fetch();
$prodname = $row_mem['prodname'];

$qry_sel = "select * from video where product_id = '$prod_id'";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$count_sel = $q_sel->rowCount();
$row_sel = $q_sel->fetch();
$id = $row_sel['id'];
$product = $row_sel['product_id'];
$video = $row_sel['video_link'];
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Memoribilia products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="add-video">
                    <h2 class="sub-header">Video of <?php echo $prodname; ?></h2>
                    <?php
                    if (isset($_SESSION['succ-pr-vdo'])) {
                        ?>
                        <span class="success"><?php echo $_SESSION['succ-pr-vdo'] ?></span>
                        <a href="memorabilia-images.php" class="btn btn-sm btn-success">Back</a>
                        <?php
                        unset($_SESSION['succ-pr-vdo']);
                    }
                    ?>
                    <br>
                    <input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Video Link: </label>
                        </div>
                        <div class="col-md-9">
                            <textarea name='vdo_link' class="form-control"><?php echo $count_sel > 0 ? $video : ''; ?></textarea>
                        </div>
                    </div>    
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <input type="submit" name="edit_vdo"  value="Edit" class="btn btn-info">
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <?php
                    
                    if (($count_sel > 0) && (trim($video) != '')) {
                        $whatIWant = substr($video, strpos($video, "?") + 3);
                        if (strpos($whatIWant, '&') !== false) {
                            $substring_vdo = substr($whatIWant, 0, strpos($whatIWant, '&'));
                        } else {
                            $substring_vdo = $whatIWant;
                        }
                        ?>
                        <div class="embed-responsive embed-responsive-16by9"> <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $substring_vdo; ?>?rel=0" allowfullscreen></iframe> </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(ADMIN_HTML . "admin-footerInc.php");
?>