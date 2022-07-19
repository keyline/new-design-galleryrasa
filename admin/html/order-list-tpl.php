<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Order List</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
<!--                <form method="post" action="<?php // echo $_SERVER["PHP_SELF"]   ?>">-->
                <h2 class="sub-header">Order List</h2>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Order ID</th>
                                <th>Invoice ID</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Amount</th>
                                <th>Gateway name</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Edit</th>
                                <th>Invoice</th>
                                <th>Packing Slip</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($order_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($order_list as $k => $v):
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v['order_org_id']; ?></td>
                                        <td><?php echo $v['order_id']; ?></td>
                                        <td><?php echo $v['fname'] . ' ' . $v['lname']; ?></td>
                                        <td><?php echo $v['email']; ?></td>
                                        <td><?php echo $v['price']; ?></td>
                                        <td><?php echo $v['gateway_name']; ?></td>
                                        <?php
                                        $sql_stat = "select * from order_status where id = (select max(id) from order_status where order_id = '" . $v['order_org_id'] . "')";
                                        $q_stat = $conn->prepare($sql_stat);
                                        $q_stat->execute();
                                        $q_stat->setFetchMode(PDO::FETCH_ASSOC);
                                        $row_stat = $q_stat->fetch();
                                        ?>
                                        <td><?php echo $row_stat['status']; ?></td>
                                        <td><?php echo $v['order_date']; ?></td>

                                        <td>                
                                            <a href="edit_order.php?ord_id=<?php echo $v['order_id'] ?>"><span
                                                    class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> </td>
                                        <td>   <a href="actionpdf.php?ord_id=<?php echo $v['order_id'] ?>" target="_blank"><span
                                                    class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> </td>
                                        <td>         <a href="actionpdf_packingslip.php?ord_id=<?php echo $v['order_id'] ?>" target="_blank"><span
                                                    class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                        </td>

                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!--                </form>-->
            </div>
        </div>
    </div>
</div>