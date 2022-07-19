<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
include(ADMIN_HTML . "admin-headerInc.php");
check_auth_admin();
$conn = dbconnect();
$val_id = $_GET['attr_value_id'];
$attr_id = $_GET['att_id'];
$qry_sel = "select * from attribute_value_ecomc where attr_value_id = '$val_id'";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
$id = $row_sel['attr_value_id'];
$value = $row_sel['value'];

?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Bibliograply Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="db-bib-edit-value">
                    <h2 class="sub-header">Edit Attribute Value</h2>
                    <?php
                    if(isset($_SESSION['succes-edit'])){
                    ?>
                    <span class="success"><?php echo $_SESSION['succes-edit'] ?></span>
                    <a href="bib-list-attr-value?attr_id=<?php echo $attr_id; ?>" class="btn btn-sm btn-success">Back</a>
                    <?php
                    unset($_SESSION['succes-edit']);
                    }
                    ?>
                    <br>
                    <input type="hidden" name="attr_id" value="<?php echo $attr_id; ?>">
                    <input type="hidden" name="value_id" value="<?php echo $id; ?>">
                    Value Name: <input type="text" name="value_name" value="<?php echo $value ?>" required><br><br>
                    <input type="submit" name="edit_value"  value="Edit" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</div>
