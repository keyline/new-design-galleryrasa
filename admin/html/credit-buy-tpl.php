<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Credit Buy List</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
<!--                <form method="post" action="<?php // echo $_SERVER["PHP_SELF"]     ?>">-->
                <h2 class="sub-header">Credit Buy List</h2>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Serial No</th>

                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Phone</th>
                                <th>Credit Added</th>
                                <th>Amount Spent(Rs)</th>
                                <th>Transaction Id</th>
                                <th>Payment Status</th>
                                <th>Credit Added On</th>

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

                                        <td><?php echo $v['fname'] . ' ' . $v['lname']; ?></td>
                                        <td><?php echo $v['email']; ?></td>
                                        <td><?php echo $v['phone']; ?></td>
                                        <td><?php echo $v['credit']; ?></td>
                                        <td><?php echo $v['amount']; ?></td>
                                        <td><?php echo $v['transactionid']; ?></td>
                                        <td><?php echo $v['payment_status']; ?></td>
                                        <td><?php echo $v['credit_date']; ?></td>



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