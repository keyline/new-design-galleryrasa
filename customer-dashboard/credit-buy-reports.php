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



//    $qry_credit_header = "SELECT credit from customer_credit where customer_id = '" . $_SESSION['user-id'] . "'";
//    $q_credit_header = $conn->prepare($qry_credit_header);
//    $q_credit_header->execute();
//    $q_credit_header->setFetchMode(PDO::FETCH_ASSOC);
//    $row_credit_header = $q_credit_header->fetch();
//
//    if (empty($row_credit_header)) {
//        $credit_header = '0';
//    } else {
//        $credit_header = $row_credit_header['credit'];
//    }



    $sql = "select cch.* , tcp.transactionid,tcp.payment_status
from customer_credit_history cch,tbl_credit_payment tcp  
where 
cch.id = tcp.credit_history_id and 
cch.transaction_type = '0' and 
cch.customer_id = '$cust_id'  
order by cch.credit_date desc";




    $q = $conn->prepare($sql);
    //$category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    while ($row = $q->fetch()) {
        $order_list[] = array(
            'credit_id' => $row['credit_id'],
            'credit' => $row['credit'],
            'amount' => $row['amount'],
            'credit_date' => $row['credit_date'],
            'transactionid' => $row['transactionid'],
            'payment_status' => $row['payment_status']
        );
    }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}
?>
<main>
<div class="container arial">
    <h2 class="client-admin-heading">Credit Buy</h2>
    <h2 class="client-admin-heading">Balance Credit: <?php echo $credit_header; ?></h2>
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
                <th>Credit Added</th>
                <th>Amount Spent(Rs)</th>
                <th>Transaction Id</th>
                <th>Payment Status</th>
                <th>Credit Added On</th>

                </thead>
                <tbody>
                    <?php if (!empty($order_list)): ?>
                        <?php
                        foreach ($order_list as $k_prod => $v_prod):
                            ?>
                            <tr>
                                <td><?php echo $v_prod['credit']; ?></td>
                                <td><?php echo $v_prod['amount']; ?></td>
                                <td><?php echo $v_prod['transactionid']; ?></td>
                                <td><?php echo $v_prod['payment_status']; ?></td>
                                <td><?php echo $v_prod['credit_date']; ?></td>


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



<?php
include("../" . INC_FOLDER . "footerInc.php");
?>

