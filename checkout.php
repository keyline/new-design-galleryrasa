<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<div class="container">
    <h1 style="text-align: center;">Checkout</h1>
    <form method="POST" action="checkout-function.php">
        <div class="col-md-6">

            <div class="col-md-4">
                <label for="card_number">First Name <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="fname" id="card_num" >
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="card_number">Last Name <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="lname" id="card_num" >
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="card_number">Phone Number <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="phone" id="card_num" >
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="email">Email <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="email" name="email" class="form-control" >
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="address">Address <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input name="street_address" class="form-control" id="street_address" type="text" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="city">City <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="city" id="city" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="city">State <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="state" id="state" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="city">Country <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="country" id="country" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="zip">Zip Code <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="zip" id="zip" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="zip">Landmark</label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" name="landmark" id="landmark"></textarea>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="zip">Order Note</label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" name="order_note" id="order_note"></textarea>
            </div>
            <div class="clearfix"></div>
            <br>
        </div>
        <div class="col-md-6">
            <?php
            if (isset($_SESSION["cart_item"])) {
                $item_total = 0;
                ?>	
                <table class="table">
                    <thead>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION["cart_item"] as $item) {
                            ?>
                            <tr>
                                <td>
                                    <img src="product_images/thumbs/<?php echo $item["image_name"]; ?>" style="width: 100px;">
                                </td>
                                <td><?php echo $item["quantity"]; ?></td>
                                <td><?php echo $item["price"] * $item["quantity"]; ?></td>

                            </tr>

                            <?php
                            $item_total += ($item["price"] * $item["quantity"]);
                        }
                        ?>
                    </tbody>
                </table>
                <h1>Total Price: Rs. <?php echo $item_total; ?></h1>
                <input type="hidden" class="form-control" name="total" id="total" value="<?php echo $item_total; ?>" >
                <input type="submit" class="btn btn-success" value="Place Order">
                <?php
            } else {
                ?>
                <h2>Cart is empty</h2>
                <?php
            }
            ?>
        </div>
    </form>
</div>
<?php
include(INC_FOLDER . "footerInc.php");
?>