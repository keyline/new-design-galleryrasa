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


//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    print "<pre>";
//    print_r($_REQUEST);
//} else {
$order_id = $_GET['ord_id'];
try {
    $sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name,c_add.street_address,c_add.city,c_add.state,c_add.country,c_add.zip,c_add.landmark,c_add.parent_id from "
            . "tbl_order ord,customer_login cust,gateway,customer_address c_add"
            . " where ord.customer_id=cust.id and ord.gateway_id=gateway.id and ord.address_id=c_add.id and ord.order_id = '$order_id' order by ord.order_id desc";
    $q = $conn->prepare($sql);
    //$category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    $row = $q->fetch();

//        while ($row = $q->fetch()) {
//            $order_list[] = array(
    $order_id = $row['order_id'];
    $order_org_id = $row['order_org_id'];
    $customer_id = $row['customer_id'];
    $gateway_id = $row['gateway_id'];
    $address_id = $row['address_id'];
    $note = $row['note'];
    $price = $row['price'];

    $order_date = $row['date'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $gateway_name = $row['gateway_name'];
    $street_address = $row['street_address'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $zip = $row['zip'];
    $landmark = $row['landmark'];
    $parent_id = $row['parent_id'];
//            );
//        }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}

//    include(ADMIN_HTML . "admin-headerInc.php");
//    include(ADMIN_HTML . 'edit-order-list-tpl.php');
?>

<div class="container">
    <h2 class="client-admin-heading">Order Details</h2>

    <div class="col-md-3 client-admin-left-panel">
        <?php
        include("customer-menu.php");
        ?>
    </div>

    <div class="col-md-8 col-md-offset-1">
        <div class="alert alert-info">
            <strong>Order Id: <?php echo $order_org_id; ?></strong>
        </div>
        <h4 >Customer Details</h4>
        <p>
            <strong>Name:</strong> <?php echo $fname . ' ' . $lname; ?><br>
            <strong>Email:</strong> <?php echo $email; ?><br>
            <strong>Phone:</strong> <?php echo $phone; ?><br>
        </p>
        <div class="col-md-12">
            <div class="col-md-6">
                <?php if ($parent_id == 0) { ?>
                    <h4>Billing Address</h4>
                    <p>
                        <strong>Street Address:</strong> <?php echo $street_address; ?><br>
                        <strong>City:</strong> <?php echo $city; ?><br>
                        <strong>State:</strong> <?php echo $state; ?><br>
                        <strong>Country:</strong> <?php echo $country; ?><br>
                        <strong>Zipcode:</strong> <?php echo $zip; ?><br>
                        <strong>Landmark:</strong> <?php echo $landmark; ?><br>
                    </p>
                    <?php
                } else {
                    $sql_addr = "select * from customer_address where id = '$parent_id'";
                    $q_addr = $conn->prepare($sql_addr);
                    $q_addr->execute();
                    $q_addr->setFetchMode(PDO::FETCH_ASSOC);
                    $row_addr = $q_addr->fetch();
                    ?>
                    <h4>Billing Address</h4>
                    <p>
                        <strong>Street Address:</strong> <?php echo $row_addr['street_address']; ?><br>
                        <strong>City:</strong> <?php echo $row_addr['city']; ?><br>
                        <strong>State:</strong> <?php echo $row_addr['state']; ?><br>
                        <strong>Country:</strong> <?php echo $row_addr['country']; ?><br>
                        <strong>Zipcode:</strong> <?php echo $row_addr['zip']; ?><br>
                        <strong>Landmark:</strong> <?php echo $row_addr['landmark']; ?><br>
                    </p>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-6">
                <h4>Shipping Address</h4>
                <p>
                    <strong>Street Address:</strong> <?php echo $street_address; ?><br>
                    <strong>City:</strong> <?php echo $city; ?><br>
                    <strong>State:</strong> <?php echo $state; ?><br>
                    <strong>Country:</strong> <?php echo $country; ?><br>
                    <strong>Zipcode:</strong> <?php echo $zip; ?><br>
                    <strong>Landmark:</strong> <?php echo $landmark; ?><br>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <p>
            <strong>Date of Purchase:</strong> <?php echo $order_date; ?><br>
            <strong>Payment Method:</strong> <?php echo $gateway_name; ?><br>
            <strong>Order Note:</strong> <?php echo $note; ?><br>
        </p>
        <h4>Product Details</h4>
        <?php
        $sql_prod = "select * from order_products where order_id = '$order_id'";
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
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>View Product</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Tax</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($prod_list)): ?>
                        <?php
                        $total = 0;
                        foreach ($prod_list as $k => $v):
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    if (($v['imagetype'] == 'Poster') || ($v['imagetype'] == 'Synopsis') || ($v['imagetype'] == 'Card')) {
                                        ?>
                                        <img src="<?php echo SITE_URL . '/product_images/' . strtolower($v['imagetype']) . '/' . $v['image_name']; ?>" style="height: 80px; width: 80px;">
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="text-align: left;"><?php echo $v['product_name']; ?></td>
                                <td style="text-align: left;"><?php echo $v['imagetype']; ?></td>
                                <td style="text-align: left;"><?php echo $v['details']; ?></td>
                                <td style="text-align: left;"><?php echo $v['quantity']; ?></td>
                                <td style="text-align: left;">Rs. <?php echo $v['price']; ?></td>
                                <td style="text-align: center;">Rs. <?php echo $v['tax_amount'].'('.$v['tax_percentage'].'%)'; ?></td>
                            </tr>
                            <?php
                            $total+=($v['price'] + $v['tax_amount']);
                        endforeach;
                        ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <strong>Total Price: </strong><?php echo $total; ?><br>

        <h4>Order Status</h4>
        <div class="table-responsive">
            <table class="table table-striped" style="width: 50%;">
                <thead>
                    <tr>
                        <th>Status Date</th>
                        <th>Order Status</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_stat = "select * from order_status where order_org_id = '$order_org_id'";
                    $q_stat = $conn->prepare($sql_stat);
                    $q_stat->execute();
                    $q_stat->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row_prod = $q_stat->fetch()) {
                        $prod_stat[] = array(
                            'status' => $row_prod['status'],
                            'comment' => $row_prod['comment'],
                            'status_date' => $row_prod['date']
                        );
                    }
                    if (!empty($prod_stat)):
                        foreach ($prod_stat as $k_stat => $v_stat):
                            ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $v_stat['status_date']; ?></td>
                                <td style="text-align: left;"><?php echo $v_stat['status']; ?></td>
                                <td style="text-align: left;"><?php echo $v_stat['comment']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>

    </div>
</div>
<?php
include("../" . INC_FOLDER . "footerInc.php");
?>
