<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Memorabilia Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
<!--                <form method="post" action="<?php // echo $_SERVER["PHP_SELF"]  ?>">-->
                <h2 class="sub-header">Customer List</h2>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date of Registration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($customer_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($customer_list as $k => $v):
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v['fname']; ?></td>
                                        <td><?php echo $v['lname']; ?></td>
                                        <td><?php echo $v['email']; ?></td>
                                        <td><?php echo $v['phone']; ?></td>
                                        <td><?php echo $v['reg_date']; ?></td>
                                        <td>                
                                            <a href="edit_customer.php?cust_id=<?php echo $v['id'] ?>"><span
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