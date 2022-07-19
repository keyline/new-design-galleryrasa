<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Email Log</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
<!--                <form method="post" action="<?php // echo $_SERVER["PHP_SELF"]   ?>">-->
                <h2 class="sub-header">Email Log</h2>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Email ID</th>
                                <th>Email Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>View Content</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($elog_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($elog_list as $k => $v):
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v['email']; ?></td>
                                        <td><?php echo $v['email_name']; ?></td>
                                        <td><?php echo $v['subject']; ?></td>
                                        <td><?php echo $v['date']; ?></td>
                                        <td>         <a href="emaillog_content.php?log_id=<?php echo $v['id'] ?>"><span
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