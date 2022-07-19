<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
include(ADMIN_HTML . "admin-headerInc.php");
check_auth_admin();
$conn = dbconnect();
$prod_id = $_GET['prod_id'];
$productarr = singleproducts($prod_id);
$va_archivistremarksarr = archivistremarks($prod_id);
$va_noofpublicationsarr = noofpublications($prod_id);
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Bibliography Products 
            </h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="db-edit-bibliograply-archivist-remarks">
                    <h2 class="sub-header">Edit Archivist Remarks of <?php echo $productarr['prodname'] . '(' . $productarr['prodid'] . ')' ?></h2>
                    <?php
                    if (isset($_SESSION['succes-edit'])) {
                        ?>
                        <span class="success"><?php echo $_SESSION['succes-edit'] ?></span>

                        <?php
                        unset($_SESSION['succes-edit']);
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['fail-edit'])) {
                        ?>
                        <span class="fail"><?php echo $_SESSION['fail-edit'] ?></span>

                        <?php
                        unset($_SESSION['fail-edit']);
                    }
                    ?>
                    <br>

                    <input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
                    Archivist Remarks: <textarea name="archivist-remarks" required><?php
                        if (!empty($va_archivistremarksarr['value'])) {
                            echo $va_archivistremarksarr['value'];
                        }
                        ?></textarea><br><br>
                    No of Publications: <select name="no_of_publication">

                        <?php if (!empty($va_noofpublicationsarr['value'])) {
                            ?>
                            <option value="<?php echo $va_noofpublicationsarr['value'] ?>"><?php echo $va_noofpublicationsarr['value'] ?></option>

                            <?php
                        }
                        ?>

                        <option value="">Select</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>


                    </select><br><br>
                    <input type="submit" name="edit_value"  value="Edit" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include(ADMIN_HTML . "admin-footerInc.php");
?>