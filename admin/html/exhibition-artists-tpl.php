<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Exhibition Artists</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">Artist List</h2>
                <a href="add-new-exhibition-artist" class="btn btn-info">Add New</a>

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
                                <th>Name of Artist</th>
                                <th>Description</th>
                                <th>Photo</th>                                
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Add Painting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($artists_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($artists_list as $k => $v):
                                    ?>

                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['artist_name']; ?></td>
                                        <td><?php echo $v['artist_description']; ?></td>
                                        <td>
                                            <?php
                                            //echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo'];
                                            if ($v['photograph'] != '') {
                                                ?>

                                                <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photograph']; ?>" width="100" height="100">
                                                <?php
                                            }
                                            ?>
                                        </td>                                        
                                        <td><?php
                                            if ($v['status'] == '0') {
                                                echo 'Inactive';
                                            } else if ($v['status'] == '1') {
                                                echo 'Active';
                                            }
                                            ?></td>

                                        <td><a href="edit-exhibition-artist.php?artist_id=<?php echo $v['id'] ?>"><span
                                                    class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>  
                                        <td><a href="exhibition-paintings.php?artist_id=<?php echo $v['id'] ?>"><span
                                                    class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></td>

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