<?php
//session_start();
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL . '/login-register');
    exit;
}
if (!$_SESSION['user-id']) {
    if (!isset($_SESSION["cart_item"])) {
        goto_location('cart.php');
    }
} 
// else {
//     if (!check_cart_exists($_SESSION['user-id'])) {
//         goto_location('cart.php');
//     }
// }
$cust_id = $_SESSION['user-id'];

//check_auth_user();
$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");
$conv_rate_row = get_conv_rate();
$conv_rate = trim($conv_rate_row['conv_rate']);
$qry_sel = "SELECT tax from admin_ecomc";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
$tax = $row_sel['tax'];
$_SESSION['tax_percentage'] = $tax;
?>
<main>
<section class="visual-search-details-page exhibition-details-page cart-page">
        <div class="container">
            
            <div class="row">

                <div class="col-lg-12">
                    <div class="right-details">
                        <div class="cart-top">
                            <div class="cart-img">
                                <span class="material-icons">shopping_bag</span>
                            </div>
                            <div class="exhibition-search-title">
                                Your Cart
                            </div>
                        </div>
                        
    <?php
    if (isset($_SESSION["cart_item"])) {
        $total = 0;
        ?>
            
                    <?php
                            foreach ($_SESSION["cart_item"] as $item) {
                    ?>
                     
                <form method="POST" action="<?php echo SITE_URL ?>/cart-checkout/update-cart.php">
                    <tr>
                        <td><?php echo $item["product_name"]; ?></td>
                        <td>
                            <?php if ($item["imagetype"] != 'Bibliography') { ?>

                                <img src="<?php echo SITE_URL ?>/product_images/thumbs/<?php echo $item["image_name"]; ?>" style="width: 100px;">
                                <?php
                            } else {
                                echo $item["image_name"];
                            }
                            ?>
                        </td>
                        <td>

                            <?php echo $item["quantity"]; ?>   
                        </td>
                        <td><?php echo $item["imagetype"]; ?></td>
                        <td><?php echo (!empty($item["type"])) ? $item["type"] : 'NA'; ?></td>
                        <td><?php
                            echo $item["price"] * $item["quantity"];
                            $tot_pr = $item["price"] * $item["quantity"];
                            ?></td>

                        
                        <td><a href="<?php echo SITE_URL ?>/cart-checkout/remove-cart.php?count=<?php echo $item["count"]; ?>">X</a></td>
                    </tr>
                </form>
                <?php
                $total += (($item["price"] + $tot_tax) * $item["quantity"]);
            }
            ?>


            </tbody>
        </table>
        </div> 
            <div class="col-md-6">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <h5 class="mr-5 mb-0">
                    <?php
                    if ($conv_rate == '') {
                        ?>
                        Total Price: Rs. <?php echo $total; ?>
                        <?php
                    } else {
                        $total_usd = $total / $conv_rate;
                        $total_usd = round($total_usd, 2);
                        ?>
                        Total Price: INR: <?php echo $total; ?> / USD: <?php echo $total_usd; ?>
                        <?php
                    }
                    ?>
                </h5>
                <?php if (isset($_SESSION['user-email'])) { ?>
                    <a class="btn form-control" href="checkout.php">Checkout</a>
                    <?php
                } else {
                    ?>
                    <a class="btn form-control" href="<?php echo SITE_URL ?>/login-register.php">Checkout</a>
                    <?php
                }
                ?>
            </div>

        <?php
    } if (isset($_SESSION['user-id'])) {
        $total = 0;
        if (check_cart_exists($_SESSION['user-id'])) {
            ?>
         
         <?php
                    $cust_cart = get_user_cart($_SESSION['user-id']);
                    foreach ($cust_cart as $item) {
                        ?>

                        <div class="cart-box">
                            <div class="cart-left">
                                <form method="POST" action="<?php echo SITE_URL ?>/cart-checkout/update-cart.php">
                            <?php
                                $img_name = get_image_name($item["image_id"]);
                                if ($item["imagetype"] != 'Bibliography') {
                                    ?>
                                    <img src="<?php echo SITE_URL ?>/product_images/thumbs/<?php echo $img_name["m_image_name"]; ?>" style="width: 100px;">
                                    <?php
                                } else {
                                    echo $img_name["m_image_name"];
                                }
                                ?>
                            </div>
                            <div class="cart-right">
                                <div class="cart-name">
                                    <?php
                                        $prod_name = get_prod_name($item["product_id"]);
                                        echo $prod_name['prodname'];
                                    ?>
                                </div>
                                <div class="cart-content">
                                    <?php echo $item["type"]; ?>
                                </div>
                                <div class="cart-bill">
                                <?php
                                    if ($conv_rate == '') {
                                        ?>
                                        <?php echo $item["price"]; ?>
                                        <?php
                                    } else {
                                        $total_usd = $item["price"] / $conv_rate;
                                        $total_usd = round($total_usd, 2);
                                        ?>
                                        ₹ <?php echo $item["price"]; ?> / $ <?php echo $total_usd; ?>
                                        <?php
                                    }
                                ?>
                                <!-- ₹ <?php // echo $item["price"]; ?> --> 
                                </div>
                                <div class="buy-cart">
                                    <div class="buy-box">
                                        <div class="qun-box">
                                            <div class="quantity buttons_added">
                                                <input type="button" value="-" class="minus" onclick="decrement()" ><input type="number" step="1" min="1" max="" name="quantity" value="<?php echo $item["quantity"]; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus" onclick="increment()" >
                                            </div>
                                        </div>
                                    </div>
                                   <div class="cart-del">
                                        <a href="<?php echo SITE_URL ?>/cart-checkout/remove-cart.php?count_id=<?php echo $item["id"]; ?>">Delete</a>
                                   </div>
                                </div>
                            </div>
                        </div>    
                    </form>
                    <?php
                    $total += (($item["price"]) * $item["quantity"]);
                }
                ?>
                <div class="subtotal-inner">
                        <div class="subtotal-info">
                            <div class="subtotal-left">
                                Subtotal
                            </div>
                            <div class="subtotal-right">
                                <?php
                                    if ($conv_rate == '') {
                                        ?>
                                        Total Price: Rs. <?php echo $total; ?>
                                        <?php
                                    } else {
                                        $total_usd = $total / $conv_rate;
                                        $total_usd = round($total_usd, 2);
                                        ?>
                                        <?php
                                    }
                                ?>
                                <h4> ₹ <?php echo $total; ?> / $ <?php echo $total_usd; ?></h4>
                            </div>
                        </div>
                        <div class="subtotal-info">
                            <div class="subtotal-left">
                                Shipping & Delivery
                            </div>
                            <div class="subtotal-right">
                                <h4> ₹ 00 / $ 0.00</h4>
                            </div>
                        </div>
                        <div class="subtotal-info">
                            <div class="subtotal-left">
                               Shipping Address
                            </div>
                            <?php
                                $bill_addr = get_user_bill_addr($cust_id);
                            ?>
                            <div class="subtotal-right">
                                <p><?php echo $bill_addr['shipping_address']; ?>,<br> <?php echo $bill_addr['shipping_state']; ?>,<?php echo $bill_addr['shipping_country']; ?> <?php echo $bill_addr['shipping_city']; ?> - <?php echo $bill_addr['shipping_zip']; ?></p>
                                <a href="<?php echo SITE_URL ?>/customer-dashboard/customer-dashboard"><h5>Change Address</h5></a>
                            </div>
                        </div>
                        <div class="subtotal-info">
                            <div class="subtotal-left">
                                Select Payment Method
                            </div>
                            <div class="subtotal-right redio-info">
                                <div class="redio-box">
                                <form method="POST" action="order.php">
                                <input type="hidden" name="shipping_addr" id="shipping_addr" value="<?php echo $bill_addr['shipping_address']; ?>">
                                <?php
                                $get_arr = get_gateways();
                                foreach ($get_arr as $get_item) {
                                    ?>
                                    <label for="<?php echo $get_item['name']; ?>">
                                        <?php echo $get_item['name']; ?>: 
                                    </label>
                                    <!-- <div class="col-md-8"> -->
                                        <input type="radio" name="gateway" id="gateway" value="<?php echo $get_item['id']; ?>" required>
                                    <!-- </div> -->
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>
                                <div class="payment-action">
                                    <input type="submit" class="payment-btn" name="submit_order" value="proceed to payment" >
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
        } else {
            ?>  
            <h2>Cart is empty</h2>
            <?php
        }
        ?>
        <?php
    } if (!isset($_SESSION['user-id']) && !isset($_SESSION["cart_item"])) {
        ?>
        <h2>Cart is empty</h2>
    <?php
}
?>
    </div>
</div>
</main>
<?php
include("../" . INC_FOLDER . "footerInc.php");
?>

<script>
    function increment(){
        // alert();
    }
</script>