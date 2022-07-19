<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Exhibitions</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">Exhibition List</h2>
                <a href="add-new-exhibition" class="btn btn-info">Add New</a>

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
                                <th>#</th>
                                <th>Name of Exhibition</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($exhibition_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($exhibition_list as $k => $v):
                                    ?>

                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['exhibition_name']; ?></td>
                                        <td><?php echo $v['description']; ?></td>
                                        <td>
                                            <?php 
                                            //echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo'];
                                            if ($v['photo'] != '') { ?>

                                                <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo']; ?>">
                                                <?php
                                            }
                                            ?>
                                        </td>

                                        <td><?php
                                            echo $v['exhibition_date'] != '0000-00-00' ? $v['exhibition_date'] : '';
                                            ?></td>

                                        <td><?php
                                            if ($v['status'] == '0') {
                                                echo 'Archived';
                                            } else if ($v['status'] == '1') {
                                                echo 'Open';
                                            } else if ($v['status'] == '2') {
                                                echo 'Canceled';
                                            }
                                            ?></td>

                                        <td><a href="edit-exhibition.php?exibition_id=<?php echo $v['id'] ?>"><span
                                                    class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>           




                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            <?php endif; ?>



                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>