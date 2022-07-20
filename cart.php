<?php
//session_start();
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<div class="container">
    <h1 style="text-align: center;">Cart</h1>
    <?php
    if (isset($_SESSION["cart_item"])) {
        $item_total = 0;
        ?>	

        <table class="table">
            <thead>
            <th>Product</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Type</th>
            <th>Size</th>
            <th>Price</th>
            <th>Delete</th>
            <th>Update</th>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION["cart_item"] as $item) {
                    ?>
                <form method="POST" action="update-cart.php">
                    <tr>
                        <td><?php echo $item["product_name"]; ?></td>
                        <td>
                            <?php // echo $item["image_name"]; ?>
                            <img src="product_images/thumbs/<?php echo $item["image_name"]; ?>" style="width: 100px;">
                        </td>
                        <td>
                            <?php if ($item["type"] == 'Original') {
                                ?>
                                <input type="hidden" name="image" value="<?php echo $item["image_id"]; ?>">
                                <input type="hidden" name="count" value="<?php echo $item["count"]; ?>">
                                <input type="text" name="edit_quantity" value="<?php echo $item["quantity"]; ?>" readonly>
                            <?php } else { ?>
                                <input type="hidden" name="image" value="<?php echo $item["image_id"]; ?>">
                                <input type="hidden" name="count" value="<?php echo $item["count"]; ?>">
                                <input type="text" name="edit_quantity" value="<?php echo $item["quantity"]; ?>">
                            <?php } ?>
                        </td>
                        <td><?php echo $item["type"]; ?></td>
                        <td><?php echo $item["size"]; ?></td>
                        <td><?php echo $item["price"] * $item["quantity"]; ?></td>
                        <td><a href="remove-cart.php?count=<?php echo $item["count"]; ?>">X</a></td>
                        <td><input type="submit" value="Update Cart" class="btn btn-info"></td>
                    </tr>
                </form>
                <?php
                $item_total += ($item["price"] * $item["quantity"]);
            }
            ?>
            </tbody>
        </table>
        <h1>Total Price: Rs. <?php echo $item_total ?></h1>
        <a class="btn btn-success" href="checkout.php">Checkout</a>
        <?php
    } else {
        ?>
        <h2>Cart is empty</h2>
        <?php
    }
    ?>
</div>
<?php
include(INC_FOLDER . "footerInc.php");
?>