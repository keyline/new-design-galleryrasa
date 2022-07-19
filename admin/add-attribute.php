<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
$alias = $_GET['alias'];
$prod_id = $_GET['prod_id'];
$attribute_id = $_GET['attribute_id'];
$attr_value_id = $_GET['attr_value_id'];


if (isset($_GET['type'])) {
    if ($_GET['type'] == 'va') {
        $producttype = "Visual Archive Products";

        $backurl = "visual-archive.php";

        $inputvalue = "va";
    } else if ($_GET['type'] == 'bib') {
        $producttype = "Bibliography Products";
        $backurl = "product-list.php";
        $inputvalue = "bib";
    } else {
        $producttype = "Memorabilia Products";
        $backurl = "product-list.php";
        $inputvalue = "mb";
    }
} else {
    $producttype = "Memorabilia Products";
    $backurl = "product-list.php";
    $inputvalue = "mb";
}

include(ADMIN_HTML . "admin-headerInc.php");
?>
<?php
$qry1 = "SELECT prodname from products_ecomc where prodid ='$prod_id'";
$q1 = $conn->prepare($qry1);
$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$row1 = $q1->fetch();
$product_name = $row1['prodname'];
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $producttype; ?></h3>
        </div>

        <h2 class="sub-header"><?php echo $product_name; ?>/<?php echo $alias; ?></h2>

        <?php
        $sql_attr = "select * from attribute_value_ecomc where attr_id = '$attribute_id' order by value";
        $q_attr = $conn->prepare($sql_attr);
        $q_attr->execute();
        $q_attr->setFetchMode(PDO::FETCH_ASSOC);
        $count_attr = $q_attr->rowCount();
        while ($row_attr = $q_attr->fetch()) {
            $attribute_value_list[] = array(
                'value_id' => $row_attr['attr_value_id'],
                'value' => $row_attr['value']
            );
        }

        if ($_GET['attribute_id'] == '140') {
            $paginationflag = 'yes';
        } else {
            $paginationflag = 'no';
        }
        ?>
        <form method="POST" action="db-add-atr-val">
            <input type="hidden" name="type" value="<?php echo $inputvalue; ?>">
            <input type="hidden" name="all_values" value="<?php echo $attr_value_id; ?>">
            <input type="hidden" name="attribute" value="<?php echo $_GET['attribute_id']; ?>">
            <input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
            <input type="hidden" name="pagflag" value="<?php echo $paginationflag; ?>">
            <?php
            if ($_GET['attribute_id'] == '140' || $_GET['attribute_id'] == '197') {
                ?>
                
                <input type="text" name="attr_valpag" class="form-control" value="">
                <?php
            } else {
                ?>
                <select name="attr_val">
                    <?php foreach ($attribute_value_list as $k_val => $v_val): ?>
                        <option value="<?php echo $v_val['value_id'] ?>"><?php echo $v_val['value'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php
            }
            ?>
            <input type="submit" class="btn btn-info" value="Add New Value">
        </form>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="table-responsive">

                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>Attribute Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $values = explode(",", $_REQUEST['attr_value']);

                                $ids = explode(",", $_REQUEST['attr_value_id']);
                                $count_values = count($values);
                                $count_ids = count($ids);
                                for ($i = 0, $j = 0; $i < $count_values, $j < $count_ids; $i++, $j++) {
                                    ?>
                                    <tr id="rw">
                                        <td style="text-align: left;">
                                            <?php
                                            echo $values[$i];
                                            ?>         
                                        </td>
                                        <td style="text-align: left;">
                                            <?php
                                            ?>
                                            <a href="del-attr-val.php?attr_val_id=<?php echo $ids[$j] ?>&prod_id=<?php echo $prod_id; ?>&type=<?php echo $_GET['type'] ?>">
                                                <span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include(ADMIN_HTML . "admin-footerInc.php");
//}