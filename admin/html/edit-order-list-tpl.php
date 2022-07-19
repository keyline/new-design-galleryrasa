<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Memorabilia Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <?php
                if (isset($_SESSION['status_change'])) {
                    ?>
                    <span class="success"><?php echo $_SESSION['status_change']; ?></span>
                    <?php
                    unset($_SESSION['status_change']);
                }
                ?>
                <h2 class="sub-header">Order</h2>
                <br>
                <p><strong>Order Id</strong>: <?php echo $order_org_id; ?><br></p>
                <p><strong>Invoice Id</strong>: <?php echo $order_id; ?><br></p>
                <h4>Customer Details</h4>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <?php if ($parent_id == 0) { ?>
                            <h4>Billing Address</h4>
                            <p>
                                <strong>Name:</strong> <?php echo $fname . ' ' . $lname; ?><br>
                                <strong>Email:</strong> <?php echo $email; ?><br>
                                <strong>Phone:</strong> <?php echo $phone; ?><br>
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
                                <strong>Name:</strong> <?php echo $fname . ' ' . $lname; ?><br>
                                <strong>Email:</strong> <?php echo $email; ?><br>
                                <strong>Phone:</strong> <?php echo $phone; ?><br>
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
                            <?php
                            if ($ship_cust_name != '') {
                                ?>
                                <strong>Name:</strong> <?php echo $ship_cust_name; ?><br>
                                <?php
                            }
                            if ($ship_cust_phone != '') {
                                ?>
                                <strong>Phone:</strong> <?php echo $ship_cust_phone; ?><br>
                                <?php
                            }
                            ?>
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
                        'image_name' => $row_prod['image_name'],
                        'price' => $row_prod['price'],
                        'tax_percentage' => $row_prod['tax_percentage'],
                        'tax_amount' => $row_prod['tax_amount']
                    );
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Details</th>
                                <th>Quantity</th>
                                <th>View</th>
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
                                        <td style="text-align: left;"><?php echo $v['product_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $v['imagetype']; ?></td>
                                        <td style="text-align: left;"><?php echo $v['details']; ?></td>
                                        <td style="text-align: left;"><?php echo $v['quantity']; ?></td>
                                        <td style="text-align: left;">
                                            <?php
                                            if (($v['imagetype'] == 'Poster') || ($v['imagetype'] == 'Synopsis') || ($v['imagetype'] == 'Card')) {
                                                ?>
                                                <a href="<?php echo SITE_URL . '/product_images/' . strtolower($v['imagetype']) . '/' . $v['image_name']; ?>" target="_blank">View</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: left;">Rs. <?php echo $v['price']; ?></td>
                                        <td style="text-align: left;">Rs. <?php echo $v['tax_amount'] . '(' . $v['tax_percentage'] . '%)'; ?></td>

                                    </tr>
                                    <?php
                                    $total +=($v['price'] + $v['tax_amount']);
                                endforeach;
                                ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <strong>Total: Rs.<?php echo $total; ?></strong><br>

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
                            $sql_stat = "select * from order_status where order_id = '$order_org_id'";
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
                <form method="POST" action="function-edit-order.php">
                    <input type="hidden" name="order_id" value="<?php echo $order_org_id; ?>">
                    <input type="hidden" name="orderpre_id" value="<?php echo $order_id; ?>">
                    <input type="hidden" name="customer_name" value="<?php echo $fname . ' ' . $lname; ?>">
                    <input type="hidden" name="customer_email" value="<?php echo $email; ?>">
                    <input type="hidden" name="order_date" value="<?php echo $order_date; ?>">
                    <div class="col-md-8">
                        <div class="col-md-4"> 
                            <label>Comment</label>
                        </div>
                        <div class="col-md-4">
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-4">
                            <label>Order Status</label>
                        </div>
                        <div class="col-md-4">
                            <select name="status">

                                <option value="initiated">Initiated</option>
                                <option value="placed">Placed</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-info" value="Submit">
                        </div>
                        <div class="clearfix"></div>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>