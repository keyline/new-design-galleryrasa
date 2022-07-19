<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
include(ADMIN_HTML . "admin-headerInc.php");
check_auth_admin();
$conn = dbconnect();
$prod_id = $_GET['prod_id'];
//$attr_id = $_GET['att_id'];
$qry_sel = "select * from products_ecomc where prodid = '$prod_id'";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
$id = $row_sel['prodid'];
$name = $row_sel['prodname'];


if (isset($_GET['type'])) {
    if ($_GET['type'] == 'va') {
        $producttype = "Visual Archive Products";

        $backurl = "visual-archive.php";
        
        $inputvalue = "va";
        
    } else {
        $producttype = "Memorabilia Products";
        $backurl = "memorabilia-images.php";
        $inputvalue = "mb";
    }
} else {
    $producttype = "Memorabilia Products";
    $backurl = "memorabilia-images.php";
    $inputvalue = "mb";
}
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $producttype; ?></h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="db-edit-prod">
                    <h2 class="sub-header">Edit Product Name</h2>
                    <?php
                    if (isset($_SESSION['succes-edit-prod'])) {
                        ?>
                        <span class="success"><?php echo $_SESSION['succes-edit-prod'] ?></span>
                        <a href="<?php echo $backurl ?>" class="btn btn-sm btn-success">Back</a>
                        <?php
                        unset($_SESSION['succes-edit-prod']);
                    }
                    ?>
                    <br>
                    <input type="hidden" name="prod_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="type" value="<?php echo $inputvalue; ?>">
<!--                    <input type="hidden" name="value_id" value="<?php //echo $id;  ?>">-->
                    Value Name: <input type="text" name="prod_name" value="<?php echo $name ?>" required><br><br>
                    <input type="submit" name="edit_prod"  value="Edit" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include(ADMIN_HTML . "admin-footerInc.php");
