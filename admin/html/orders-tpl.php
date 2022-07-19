<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Orders</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Order Date</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if (!empty($order_list)): ?>
                            <?php foreach ($order_list as $k => $v): ?>
                                <tr id="rw<?php echo $v['orderid'] ?>">
                                    <td><?php echo $v['orderid'] ?></td>
                                    <td><?php echo $v['date'] ?></td>
                                    <td><?php echo $v['name'] ?></td>
                                    <td><?php echo CURRENCY_CODE ?><?php echo $v['total'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <span
                                                class="label label-<?php echo $v['colour'] ?>"><?php echo $v['status'] ?></span>
                                            <br/><?php echo $v['stat_date'] ?>
                                            <br/>
                                            <button class="btn btn-default dropdown-toggle" type="button"
                                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="true">

                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li>
                                                    <a href="orders.php?st=1&oi=<?php echo $v['orderid'] ?>&page=<?php echo $_GET['page'] ?>"><?php echo ORDER_PENDING ?></a>
                                                </li>
                                                <li>
                                                    <a href="orders.php?st=2&oi=<?php echo $v['orderid'] ?>&page=<?php echo $_GET['page'] ?>"><?php echo ORDER_COMPLETED ?></a>
                                                </li>
                                                <li>
                                                    <a href="orders.php?st=3&oi=<?php echo $v['orderid'] ?>&page=<?php echo $_GET['page'] ?>"><?php echo ORDER_DESPATCHED ?></a>
                                                </li>
                                                <li>
                                                    <a href="orders.php?st=0&oi=<?php echo $v['orderid'] ?>&page=<?php echo $_GET['page'] ?>"><?php echo ORDER_CANCELLED ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" name="order-modal"
                                           id="<?php echo $v['orderid'] ?>" data-target="#viewOrder"><span
                                                class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                        &nbsp;
                                        <span id="del_order" data-id="<?php echo $v['orderid'] ?>"
                                              class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </div><?php echo $pages['nav'] ?></div>
        </div>
        <div class="modal fade" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Order Details</h4>
                    </div>
                    <div class="modal-body">
                        <div id="loading-img"><img src="../images/loading-mini2.gif"/></div>
                        <div id="order-details"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>