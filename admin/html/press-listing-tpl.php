<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">In the Press</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">Article List</h2>
                <a href="upload_press.php" class="btn btn-info">Add New</a>

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
                                <th>Event Name</th>                               
                                <th>Press Name</th>
                                <th>Press Image/PDF</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($press_listing)): ?>
                                <?php $i = 1;
                                foreach ($press_listing as $k => $v): ?>
                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['press_name']; ?></td>
                                        <td><?php echo $v['title']; ?></td>
                                        <td>
                                        <?php
                                            if ($v['title_img'] != '' && $v['is_img_pdf'] == '1') { ?>

                                                <img src="<?php echo SITE_URL . '/' . PRESS_THUMB_IMGS . $v['title_img']; ?>" width="100" height="100">
                                                <?php
                                            } else {
                                                echo "<span>{$v['title_img']}</span>";
                                            }
                                    ?>
                                        </td>       
                                        <td><a href="edit-press-listing.php?img_id=<?php echo $v['img_id'] ?>&press_id=<?php echo $v['press_id']?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>                                 
                                        <td><a href="delete-pressImg.php?img_id=<?php echo $v['img_id'] ?>" onclick="return confirm('Are you sure you want to delete this item?')"><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></a></td>
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