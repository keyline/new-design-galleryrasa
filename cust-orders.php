<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
check_auth_user();
include(INC_FOLDER . "headerInc.php");
$conn = dbconnect();
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

<div class="container">
    <a href="customer-dashboard.php"><h3>Dashboard</h3></a>
    <a href="cust-orders.php"><h3>List of Orders</h3></a>
    <a href="cust-address.php"><h3>Customer Address</h3></a>
    <h2>Order List</h2>

    <?php if (!empty($order_list)): ?>
        <?php foreach ($order_list as $k => $v): ?>
    <strong>Order Id: </strong><a href="customer-order-details.php?ord_id=<?php echo $v['order_id'] ?>"><?php echo $v['order_id']; ?></a><br>
            <strong>Order Date: </strong><?php echo $v['date']; ?><br>
            <?php
            $sql_stat = "select * from order_status where id = (select max(id) from order_status where order_id = '" . $v['order_id'] . "')";
            $q_stat = $conn->prepare($sql_stat);
            $q_stat->execute();
            $q_stat->setFetchMode(PDO::FETCH_ASSOC);
            $row_stat = $q_stat->fetch();
            ?>
            <strong>Order Status: </strong><?php echo $row_stat['status']; ?><br>
            <?php
            $sql_prod = "select * from order_products where order_id = '" . $v['order_id'] . "'";
            $q_prod = $conn->prepare($sql_prod);
            $q_prod->execute();
            $q_prod->setFetchMode(PDO::FETCH_ASSOC);
            while ($row_prod = $q_prod->fetch()) {
                $prod_list[] = array(
                    'product_name' => $row_prod['product_name'],
                    'imagetype' => $row_prod['imagetype'],
                    'details' => $row_prod['details'],
                    'quantity' => $row_prod['quantity'],
                    'price' => $row_prod['price']
                );
            }
            ?>
            <table class="table table-striped">
                <thead>
                <th>Product Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price/per Product</th>
                </thead>
                <tbody>
                    <?php if (!empty($prod_list)): ?>
                        <?php
                        foreach ($prod_list as $k_prod => $v_prod):
                            ?>
                            <tr>
                                <td><?php echo $v_prod['product_name']; ?></td>
                                <td><?php echo $v_prod['imagetype']; ?></td>
                                <td><?php echo $v_prod['details']; ?></td>
                                <td><?php echo $v_prod['quantity']; ?></td>
                                <td>Rs. <?php echo $v_prod['price']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
            <strong>Total Amount Paid: </strong><?php echo $v['price']; ?><br>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php
include(INC_FOLDER . "footerInc.php");
?>