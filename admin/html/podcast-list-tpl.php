<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Podcast</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">Podcast List</h2>
                <a href="add-new-podcast" class="btn btn-info">Add New</a>

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
                                <th>Episode Name</th>
                                <th>Episode Image</th>
                                <th>Featured Name</th>
                                <th>Episode Description</th>                                
                                <th>Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($episode_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($episode_list as $k => $v):
                                    ?>

                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['episode_name']; ?></td>
                                        <td>
                                            <?php                                             
                                            if ($v['episode_image'] != '') { ?>

                                                <img src="<?php echo SITE_URL . '/' . PODCAST_THUMB_IMGS . $v['episode_image']; ?>" width="100" height="100">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $v['featured_name']; ?></td>
                                        <td><?php echo $v['episode_description']; ?></td>
                                        <td><?php
                                            echo $v['episode_date'];
                                            ?>
                                        </td>                                        
                                        <td><a href="edit-podcast.php?episode_id=<?php echo $v['episode_id'] ?>"><span
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
            </div>
        </div>
    </div>
</div>