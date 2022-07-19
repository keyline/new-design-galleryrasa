<?php
//session_start();
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
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
<div class="container arial cart">
    <h1 style="text-align: center;">Cart</h1>
    <div class="row">
    <?php
    if (isset($_SESSION["cart_item"])) {
        $total = 0;
        ?>	
        <div class="col-12 table-responsive">
        <table class="table">
            <thead>
            <th>Product</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Image Type</th>
            <th>Description</th>
            <th>Price</th>
            <th>Tax</th>
            <th>Delete</th>
            </thead>
            <tbody>
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

                        <td><?php
                    if ($item["taxable"] == '1') {
                        $tot_tax = $tot_pr * ($tax / 100);
                    } else {
                        $tot_tax = $tot_pr * (0 / 100);
                    }
                    echo $tot_tax;
                    if ($item["taxable"] == '1') {
                        echo '(' . $tax . '%)';
                    } else {
                        echo '(0%)';
                    }
                            ?> </td>
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
                <?php
//                if ($tax > 0) {
//                    $_SESSION['tax_percentage'] = $tax;
//                    //$_SESSION['tax_amount'] = $total * ($tax / 100);
//                    
                ?>
                <?php
//                    if ($conv_rate == '') {
//                        
                ?>
    <!--                        <h1>Tax: <?php // echo $tax . '%';   ?> / Tax Amount: Rs.<?php //echo ($total * ($tax / 100));   ?></h1>
                <?php //$item_total = $total + ($total * ($tax / 100));  ?>
                        <h1>Total Amount to Pay: //<?php //echo $item_total;   ?></h1>-->
                <?php
//                    } else {
//                        $tax_amt = ($total * ($tax / 100));
//                        $tax_amt_usd = $tax_amt / $conv_rate;
//                        $tax_amt_usd = round($tax_amt_usd, 2);
//                        $item_total = $total + ($total * ($tax / 100));
//                        $item_total_usd = $item_total / $conv_rate;
//                        $item_total_usd = round($item_total_usd, 2);
//                        
                ?>
    <!--                        <h1>Tax: //<?php //echo $tax . '%';   ?> - Tax Amount: INR: <?php //echo $tax_amt;   ?> / USD: <?php echo $tax_amt_usd; ?></h1>

                        <h1>Total Amount to Pay: INR: //<?php //echo $item_total;    ?> / USD: <?php //echo $item_total_usd;    ?></h1>-->
                <?php
//                    }
//                    
                ?>
                <?php
//                } else {
//                    if ($conv_rate == '') {
//
//                        $item_total = $total;
//                        
                ?>
    <!--                        <h1>Total Amount to Pay: //<?php // echo $item_total;    ?></h1>-->
                <?php
//                    } else {
//                        $item_total = $total;
//                        $item_total_usd = $item_total / $conv_rate;
//                        $item_total_usd = round($item_total_usd, 2);
//                        
                ?>

                <!--                        <h1>Total Amount to Pay: INR: //<?php //echo $item_total;    ?> / USD: <?php //echo $item_total_usd;    ?></h1>-->

                <?php
//                    }
//                }
//                
                ?>
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
        <div class="col-12 table-responsive">
            <table class="table">
                <thead>
                <th>Product</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Image Type</th>
                <th>Description</th>
                <th>Price</th>
                <th>Tax</th>
                <th>Delete</th>
                </thead>
                <tbody>
                    <?php
                    $cust_cart = get_user_cart($_SESSION['user-id']);
                    foreach ($cust_cart as $item) {
                        ?>
                    <form method="POST" action="<?php echo SITE_URL ?>/cart-checkout/update-cart.php">

                        <tr>
                            <td><?php
            $prod_name = get_prod_name($item["product_id"]);
            echo $prod_name['prodname'];
                        ?></td>
                            <td>
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
                            </td>
                            <td>
                                <?php echo $item["quantity"]; ?>  
                            </td>
                            <td><?php echo $item["imagetype"]; ?></td>
                            <td><?php echo $item["type"]; ?></td>
                            <td><?php
                                echo $item["price"] * $item["quantity"];
                                $tot_pr = $item["price"] * $item["quantity"];
                                ?></td>

                            <td><?php
                    if ($item["taxable"] == '1') {
                        $tot_tax = $tot_pr * ($tax / 100);
                    } else {
                        $tot_tax = $tot_pr * (0 / 100);
                    }
                    echo $tot_tax;
                    if ($item["taxable"] == '1') {
                        echo '(' . $tax . '%)';
                    } else {
                        echo '(0%)';
                    }
                                ?> </td>
                            <td><a href="<?php echo SITE_URL ?>/cart-checkout/remove-cart.php?count_id=<?php echo $item["id"]; ?>">X</a></td>
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


                    <?php
//                    if ($tax > 0) {
//                        $_SESSION['tax_percentage'] = $tax;
//                        $_SESSION['tax_amount'] = $total * ($tax / 100);
//                        
                    ?>


                    <?php
//                        if ($conv_rate == '') {
//                            
                    ?>
        <!--                            <h1>Tax: <?php // echo $tax . '%';  ?> / Tax Amount: Rs.<?php //echo ($total * ($tax / 100));  ?></h1>
                    <?php // $item_total = $total + ($total * ($tax / 100)); ?>
                                    <h1>Total Amount to Pay: //<?php //echo $item_total;  ?></h1>-->
                    <?php
//                        } else {
//                            $tax_amt = ($total * ($tax / 100));
//                            $tax_amt_usd = $tax_amt / $conv_rate;
//                            $tax_amt_usd = round($tax_amt_usd, 2);
//                            $item_total = $total + ($total * ($tax / 100));
//                            $item_total_usd = $item_total / $conv_rate;
//                            $item_total_usd = round($item_total_usd, 2);
//                            
                    ?>
        <!--                            <h1>Tax: <?php //echo $tax . '%';  ?> - Tax Amount: INR: <?php //echo $tax_amt;  ?> / USD: <?php //echo $tax_amt_usd;  ?></h1>

                                    <h1>Total Amount to Pay: INR: <?php //echo $item_total; ?> / USD: <?php //echo $item_total_usd; ?></h1>-->
                    <?php
//                        }
//                        
                    ?>


                    <?php
//                    } else {
//                        if ($conv_rate == '') {
//
//                            $item_total = $total;
//                            
                    ?>
        <!--                            <h1>Total Amount to Pay: <?php //echo $item_total; ?></h1>-->
                    <?php
//                        } else {
//                            $item_total = $total;
//                            $item_total_usd = $item_total / $conv_rate;
//                            $item_total_usd = round($item_total_usd, 2);
//                            
                    ?>

        <!--                            <h1>Total Amount to Pay: INR: <?php //echo $item_total; ?> / USD: <?php //echo $item_total_usd; ?></h1>-->

                    <?php
//                        }
//                    }
                    ?>
                    <?php $_SESSION['tot_price'] = $total; ?>
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