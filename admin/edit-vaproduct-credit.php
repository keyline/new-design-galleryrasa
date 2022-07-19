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



$qry_sel2 = "select * from va_product_credit where prodid = '$prod_id'";
$q_sel2 = $conn->prepare($qry_sel2);
$q_sel2->execute();
$q_sel2->setFetchMode(PDO::FETCH_ASSOC);
$row_sel2 = $q_sel2->fetch();


if (empty($row_sel2)) {

    $prodcreditid = '0';
    $credit = '0';
} else {


    $prodcreditid = $row_sel2['id'];
    $credit = $row_sel2['credit'];
}
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Visual Archive Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="db-edit-prodcredit">
                    <h2 class="sub-header">Edit Credit of Product <?php echo $name; ?></h2>
                    <?php
                    if (isset($_SESSION['succes-edit-prod'])) {
                        ?>
                        <span class="success"><?php echo $_SESSION['succes-edit-prod'] ?></span>
                        <a href="visual-archive.php" class="btn btn-sm btn-success">Back</a>
                        <?php
                        unset($_SESSION['succes-edit-prod']);
                    }
                    ?>
                        <?php
                    if (isset($_SESSION['fail-edit-prod'])) {
                        ?>
                        <span class="success"><?php echo $_SESSION['fail-edit-prod'] ?></span>
                        <a href="visual-archive.php" class="btn btn-sm btn-danger">Back</a>
                        <?php
                        unset($_SESSION['fail-edit-prod']);
                    }
                    ?>
                    <br>
                    <input type="hidden" name="prod_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="prodcredit_id" value="<?php echo $prodcreditid;   ?>">
                    Credit: <input type="text" name="credit" value="<?php echo $credit ?>" required><br><br>
                    <input type="submit" name="edit_prod"  value="Edit" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include(ADMIN_HTML . "admin-footerInc.php");
