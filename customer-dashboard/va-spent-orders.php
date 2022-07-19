<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL.'/login-register');
    exit;
}
$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");

$cust_id = $_SESSION['user-id'];
$adminsettingarr = get_admin_setting();

try {



    $sql = "select ave.value artist,pe.prodid,TIMESTAMPDIFF(second,cch.credit_date,now()) timediff,pe.prodname,cch.* 
from customer_credit_history cch,products_ecomc pe, product_attribute_value pav,attribute_value_ecomc ave,attr_common_flds_ecomc acfe  
where 
cch.transaction_type = '1' and 
cch.prodid = pe.prodid and 
cch.customer_id = '$cust_id' and 

pe.prodid = pav.product_id and
pav.attribute_value_id = ave.attr_value_id and 
acfe.id = ave.attr_id and 
acfe.id = '187'

order by cch.credit_date desc";




    $q = $conn->prepare($sql);
    //$category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    while ($row = $q->fetch()) {
        $order_list[] = array(
            'artist' => $row['artist'],
            'prodid' => $row['prodid'],
            'timediff' => $row['timediff'],
            'prodname' => $row['prodname'],
            'id' => $row['id'],
            'customer_id' => $row['customer_id'],
            'credit_id' => $row['credit_id'],
            'transaction_type' => $row['transaction_type'],
            'credit' => $row['credit'],
            'credit_date' => $row['credit_date']
        );
    }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}
?>
<main>
<div class="container arial">
    <h2 class="client-admin-heading">Credit Spent</h2>
    <div class="row">
    <div class="col-md-3 client-admin-left-panel">
        <?php
        include("customer-menu.php");
        ?>
    </div>

    <div class="col-md-9 orderMemrobiliaList">

        <?php if (!empty($order_list)): ?>


            <?php
            ?>

            <table class="table table-striped">
                <thead>
                <th>Artist</th>
                <th>Artwork Name</th>
                <th>Spent Credit</th>
                <th>Downloaded On</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php if (!empty($order_list)): ?>
                        <?php
                        foreach ($order_list as $k_prod => $v_prod):


                            $timediffseconds = $v_prod['timediff'];

                            $sevendayssecondsdiff = (3600 * 24) * $adminsettingarr['credit_dayspan'];

                            $prodcreditrow = get_product_credit($v_prod['prodid']);
                            ?>
                            <tr>
                                <td><?php echo $v_prod['artist']; ?></td>
                                <td><?php echo $v_prod['prodname']; ?></td>
                                <td><?php echo $v_prod['credit']; ?></td>
                                <td><?php echo $v_prod['credit_date']; ?></td>

                                <td style="text-align: center;">
                                    <?php
                                    if ($timediffseconds < $sevendayssecondsdiff) {
                                        ?>

                                        <form method="post" action="../actiondownloadvapdf.php">
                                            <input type="hidden"  name="prodid" value="<?php echo $v_prod['prodid'] ?>">
                                            <input type="hidden" name="userid" value="<?php echo $_SESSION['user-id'] ?>">
                                            <input type="submit" class="btn form-control" value="Download">

                                        </form>

                                        <?php
                                    } else {

                                        if (empty($prodcreditrow) || $prodcreditrow['credit'] == '0') {
                                            ?>
                                            <a href="/visualarchive-details/<?php echo $v_prod['prodid'] ?>" class="btn btn-info form-control">Buy Again</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="/visualarchive-details/<?php echo $v_prod['prodid'] ?>" onclick="confirmFunction();" class="btn btn-info form-control">Buy Again</a>
                                            <?php
                                        }
                                    }
                                    ?>

                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    <?php endif; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>
    </div>
</div>
</main>

<script>
    function confirmFunction() {
        var txt;
        var r = confirm("Are you sure you want to spent credit to view this artwork!");
        if (r == true) {
            //txt = "You pressed OK!";
        } else {
            //txt = "You pressed Cancel!";
            event.preventDefault();
        }

    }
</script>

<?php
include("../" . INC_FOLDER . "footerInc.php");
?>

