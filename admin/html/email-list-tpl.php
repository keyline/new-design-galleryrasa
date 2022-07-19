<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Memorabilia Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
<!--                <form method="post" action="<?php // echo $_SERVER["PHP_SELF"]    ?>">-->
                <h2 class="sub-header">Email Template List</h2>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($email_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($email_list as $k => $v):
                                    ?>

                                    <tr>
                                        <td style="text-align: left;"><?php echo $i; ?></td>
                                        <td style="text-align: left;"><?php echo $v['email_name']; ?></td>
                                        <td style="text-align: left;">                
                                            <a href="edit_email.php?email_id=<?php echo $v['id']; ?>"><span
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