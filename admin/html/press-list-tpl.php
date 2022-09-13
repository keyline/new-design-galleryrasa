<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">In the Press</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">Press List</h2>
                <a href="add-new-press" class="btn btn-info">Add New</a>

                <?php
                if (isset($_SESSION['succ'])) {
                    ?>
                    <span class="label label-success"><?php echo $_SESSION['succ'] ?></span>
                    <?php
                    unset($_SESSION['succ']);
                }
                ?>
                <?php
                if (isset($_SESSION['fail'])) {
                    ?>
                    <span class="label label-danger"><?php echo $_SESSION['fail'] ?></span>
                    <?php
                    unset($_SESSION['fail']);
                }
                ?>
                <div class="table-responsive">

                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>                               
                                <th>Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($press_list)): ?>
                                <?php $i = 1; foreach ($press_list as $k => $v): ?>
                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['press_name']; ?></td>
                                        <td><?php echo $v['press_date']; ?></td>                                        
                                        <td><a href="edit-press.php?press_id=<?php echo $v['press_id'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>