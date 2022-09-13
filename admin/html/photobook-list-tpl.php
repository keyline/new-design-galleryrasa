<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Photo Book</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">All Photo Book</h2>
                <a href="add-new-photobook" class="btn btn-info">Add New</a>

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
                                <th>Image</th>                               
                                <th>Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($photo_list)): ?>
                                <?php $i = 1; foreach ($photo_list as $k => $v): ?>
                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['event_title']; ?></td>
                                        <td>
                                        <?php                                             
                                            if ($v['event_img'] != '') { ?>

                                                <img src="<?php echo SITE_URL . '/' . PHOTOBOOK_THUMB_IMGS . $v['event_img']; ?>" width="100" height="100">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $v['event_date']; ?></td>                                        
                                        <td><a href="edit-photobook.php?photo_id=<?php echo $v['event_id'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
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