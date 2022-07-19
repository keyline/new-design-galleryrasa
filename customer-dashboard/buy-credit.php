<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL . '/login-register');
    exit;
}

$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");
//$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$txnid = "TXN00001";
$custarr = customer_details($_SESSION['user-id']);

$adminsettingarr = get_admin_setting();

$credit_value = $adminsettingarr['credit_value'];
?>
<main>
<div class="container arial">
    <h2 class="client-admin-heading">Buy Credit</h2>
    <div class="row">
        <div class="col-md-3 client-admin-left-panel">
            <?php
            include("customer-menu.php");
            ?>
        </div>
        <div class="col-md-9">
            <?php
            if (isset($_SESSION['error-pass'])) {
                ?>
                <span class="label-danger"><?php echo $_SESSION['error-pass']; ?></span>
                <?php
                unset($_SESSION['error-pass']);
            }
            ?>
            <form method="POST" action="../cart-checkout/db-order-credit2.php" id="passwordForm">
                <?php
        //        $sql_user = "select * from customer_login where email = '" . $_SESSION['user-email'] . "'";
        //        $q_user = $conn->prepare($sql_user);
        //        $q_user->execute();
        //        $q_user->setFetchMode(PDO::FETCH_ASSOC);
        //        $row_user = $q_user->fetch();
                ?>
                
                    <div class="row">
                        <div class="col-md-3">
                            <label>Choose Credit:</label>
                        </div> 
                        <div class="col-md-9">
                            <input type="hidden" value="<?php echo $_SESSION['user-id'] ?>" >

                            <select name="credit" class="form-control" >
                                <option value="10">10(Rs. <?php echo $credit_value*10; ?>)</option>
                                <option value="30">30(Rs. <?php echo $credit_value*30 ?>)</option>
                                <option value="50">50(Rs. <?php echo $credit_value*50 ?>)</option>
                                <option value="100">100(Rs. <?php echo $credit_value*100 ?>)</option>
                                <option value="200">200(Rs. <?php echo $credit_value*200 ?>)</option>
                                <option value="500">500(Rs. <?php echo $credit_value*500 ?>)</option>
                                <option value="1000">1000(Rs. <?php echo $credit_value*1000 ?>)</option>
                                <option value="5000">5000(Rs. <?php echo $credit_value*5000 ?>)</option>
                                <option value="10000">10000(Rs. <?php echo $credit_value*10000 ?>)</option>
                            </select>

                        </div>  
                    </div>



                    <input type="hidden" name="key" value = "YdMFZwfh"/>
                    <input type="hidden" name="txnid" value = ""/>
        <!--            <input type="hidden" name="amount" value = "50.00"/>-->
                    <input type="hidden" name="productinfo" value ="GalleryRASA BUY Credit"/>
                    <input type="hidden" name="firstname" value = "<?php echo $custarr['fname'] . ' ' . $custarr['lname']; ?>"/>
                    <input type="hidden" name="email" value ="<?php echo $custarr['email']; ?>"/>
                    <input type="hidden" name="phone" value ="<?php echo $custarr['phone']; ?>"/>
                    <input type="hidden" name="service_provider" value ="payu_paisa"/>
                    <input type="hidden" name="udf1" value ="<?php echo $custarr['id'] ?>"/>

                    <input type="hidden" name="surl" value ="<?php echo "https://" . $_SERVER['SERVER_NAME']; ?>/payu-credit-return.php"/>
                    <input type="hidden" name="furl" value ="<?php echo "https://" . $_SERVER['SERVER_NAME']; ?>/payu-credit-return.php"/>


        <!--            <input type="text" id="key" name="key" placeholder="Merchant Key" value="" />
                    <input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="" />
                    <input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo "Txn" . rand(10000, 99999999) ?>" />
                    <input type="text" id="amount" name="amount" placeholder="Amount" value="6.00" />
                    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="Buy Credit" />

                    <input type="text" id="fname" name="fname" placeholder="First Name" value="" />
                    <input type="text" id="email" name="email" placeholder="Email ID" value="" />
                    <input type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="" />
                    <input type="text" id="hash" name="hash" placeholder="Hash" value="" />-->

                    <?php
        //            $get_arr = get_gateways();
        //            foreach ($get_arr as $get_item) {
                    ?>
                    <!--                <div class="col-md-4">
                    <?php echo $get_item['name']; ?>: 
                                    </div>
                                    <div class="col-md-8">
                                        <input type="radio" name="gateway" id="gateway" value="<?php echo $get_item['id']; ?>" required>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>-->
                    <?php
                    // }
                    ?>
                    <div class="row">
                        <div class="col-md-3">

                        </div>  
                        <div class="col-md-9">
                            <input type="submit" value="Buy Credit" class="btn form-control">
                        </div>  
                    </div>

            </form>
        </div>
    </div>
</div>
</main>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-1.11.3.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate2.js"></script>


<?php
include("../" . INC_FOLDER . "footerInc.php");
?>

