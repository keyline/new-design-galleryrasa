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
if (!$_SESSION['user-id']) {
    if (!isset($_SESSION["cart_item"])) {
        goto_location('cart.php');
    }
} else {
    if (!check_cart_exists($_SESSION['user-id'])) {
        goto_location('cart.php');
    }
}
//include(APPS_BASE_PATH . 'includes/'. "headerInc.php");
require_once("../" . INCLUDED_FILES . "headerInc.php");

//print '<pre>';
//var_dump($_SESSION["bill_address"]);
//print '<pre>';
//var_dump($_SESSION["ship_address"]);
?>
<div class="container">
    <h1 style="text-align: center;">Payment Gateways</h1>
    <form method="POST" action="order.php">
        <div class="col-md-6">

            <div class="col-md-4">
                <label>Order Note</label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" name="order_note" id="order_note"></textarea>
            </div>
            <div class="clearfix"></div>
            <br>

            <?php
            $get_arr = get_gateways();
            foreach ($get_arr as $get_item) {
                ?>
                <div class="col-md-4">
                    <?php echo $get_item['name']; ?>: 
                </div>
                <div class="col-md-8">
                    <input type="radio" name="gateway" id="gateway" value="<?php echo $get_item['id']; ?>" required>
                </div>
                <div class="clearfix"></div>
                <br>
                <?php
            }
            ?>
            <div class="col-md-4">
                <input type="submit" name="submit_order" value="Place Order" class="btn btn-info">
            </div>
        </div>
    </form>
</div>


<?php
require_once("../" . INCLUDED_FILES . "footerInc.php");
//include(APPS_BASE_PATH . 'includes/'. "footerInc.php");
?>