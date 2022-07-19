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

try {
    $sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name from "
            . "tbl_order ord,customer_login cust,gateway where ord.customer_id=cust.id and ord.gateway_id=gateway.id and ord.customer_id = '$cust_id' order by ord.order_id desc";
    $q = $conn->prepare($sql);
    //$category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    while ($row = $q->fetch()) {
        $order_list[] = array(
            'order_id' => $row['order_id'],
            'order_org_id' => $row['order_org_id'],
            'date' => $row['date'],
            'customer_id' => $row['customer_id'],
            'gateway_id' => $row['gateway_id'],
            'note' => $row['note'],
            'price' => $row['price'],
            
            'order_date' => $row['date'],
            'fname' => $row['fname'],
            'lname' => $row['lname'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'gateway_name' => $row['gateway_name']
        );
    }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}
?>
<main>
<div class="container arial">
    <h2 class="client-admin-heading">Order List</h2>
    <div class="row">
    <div class="col-md-3 client-admin-left-panel">
        <?php
        include("customer-menu.php");
        ?>
    </div>

    <div class="col-md-9 orderMemrobiliaList">

        <?php if (!empty($order_list)): ?>
            <?php foreach ($order_list as $k => $v): ?>
                <div class="col-md-12 orderMemrobilia" style="background: #ececec; padding: 15px;">
                    <ul class="d-flex justify-content-around p-0 m-0">
                        <li>
                            <strong>Order Id: <a href="customer-order-details.php?ord_id=<?php echo $v['order_id'] ?>"><?php echo $v['order_org_id']; ?></a></strong>
                        </li>
                        <li>
                            <strong>Order Date: </strong><?php echo $v['date']; ?><br>
                        </li>
                        <li>
                            <?php
                                $sql_stat = "select * from order_status where id = (select max(id) from order_status where order_id = '" . $v['order_org_id'] . "')";
                                $q_stat = $conn->prepare($sql_stat);
                                $q_stat->execute();
                                $q_stat->setFetchMode(PDO::FETCH_ASSOC);
                                $row_stat = $q_stat->fetch();
                            ?>
                            <strong>Order Status: </strong><?php echo $row_stat['status']; ?>
                        </li>
                    </ul>
                </div>
                <?php
                
                $sql_prod = "select * from order_products where order_id = '" . $v['order_id'] . "'";
                $q_prod = $conn->prepare($sql_prod);
                $q_prod->execute();
                $q_prod->setFetchMode(PDO::FETCH_ASSOC);
                while ($row_prod = $q_prod->fetch()) {
                    $prod_list[] = array(
                        'product_name' => $row_prod['product_name'],
                        'image_name' => $row_prod['image_name'],
                        'imagetype' => $row_prod['imagetype'],
                        'details' => $row_prod['details'],
                        'quantity' => $row_prod['quantity'],
                        'price' => $row_prod['price'],
                        'tax_percentage' => $row_prod['tax_percentage'],
                        'tax_amount' => $row_prod['tax_amount']
                    );
                }
                
                
                
                ?>

                <table class="table table-striped">
                    <thead>
                    <th>View Product</th>
                    <th>Product Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price/per Product</th>
                    <th>Tax</th>
                    </thead>
                    <tbody>
                        <?php if (!empty($prod_list)): ?>
                            <?php
                            $total = 0;
                            foreach ($prod_list as $k_prod => $v_prod):
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if(($v_prod['imagetype'] == 'Poster') || ($v_prod['imagetype'] == 'Synopsis') || ($v_prod['imagetype'] == 'Card')){
                                            ?>
                                        <img src="<?php echo SITE_URL.'/product_images/'.strtolower($v_prod['imagetype']).'/'.$v_prod['image_name']; ?>" style="height: 80px; width: 80px;">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $v_prod['product_name']; ?></td>
                                    <td><?php echo $v_prod['imagetype']; ?></td>
                                    <td><?php echo $v_prod['details']; ?></td>
                                    <td style="text-align: center;"><?php echo $v_prod['quantity']; ?></td>
                                    <td style="text-align: center;">Rs. <?php echo $v_prod['price']; ?></td>
                                    <td style="text-align: center;">Rs. <?php echo $v_prod['tax_amount'].'('.$v_prod['tax_percentage'].'%)'; ?></td>
                                </tr>
                                <?php
                                $total+=($v_prod['price'] + $v_prod['tax_amount']);
                                unset($prod_list); 
                            endforeach;
                            ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="7">
                                <strong>Total Price: </strong><?php echo $total; ?><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    </div>
</div>
</main>

<?php
include("../" . INC_FOLDER . "footerInc.php");
?>