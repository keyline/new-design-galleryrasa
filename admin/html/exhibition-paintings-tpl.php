<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Artwork</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <h2 class="sub-header">Artwork List of <?php echo $exhibitionarr['exhibition_name'] ?></h2>
                <a href="add-new-exhibition-painting.php?exibition_id=<?php echo $exibition_id ?>" class="btn btn-info">Add New</a>
                <a class="btn btn-info" href="exhibition-list.php">Back to Exhibiiton List</a>
                <br>

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
                                <th>Artist Name</th>
                                <th>Name of Painting</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Dimension</th>
                                <th>Medium</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($painting_list)): ?>
                                <?php
                                $i = 1;
                                   // print_r($painting_list);exit();
                                foreach ($painting_list as $k => $v):
                                     // $artistarr = allexhibitionofpaintings($v['id']);
                                    ?>

                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $v['artist_name']; ?> </td>
                                        <td><?php echo $v['name']; ?></td>
                                        <td><?php
                                         $desc = substr($v['description'], 0,60);
                                         echo $desc; ?></td>
                                        <td>
                                            <?php
                                            //echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo'];
                                            if ($v['image'] != '') {
                                                ?>

                                                <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['image']; ?>" width="100" height="100">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $v['dimension']; ?></td>
                                        <td><?php echo $v['medium']; ?></td>
                                        <td><?php echo $v['year']; ?></td>
                                        <!-- <td>?php echo $v['fulldate']; ?></td> -->
                                        <td><?php echo $v['price']; ?></td>
                                        <!-- <td>?php echo $v['currently_available_at']; ?></td> 


                                        <td>?php
                                            if ($v['status'] == '0') {
                                                echo 'Archived';
                                            } else if ($v['status'] == '1') {
                                                echo 'In Exhibition';
                                            }
                                            ?></td>-->

                                        <td><a href="edit-exhibition-painting.php?painting_id=<?php echo $v['id'] ?>&exibition_id=<?php echo $exhibitionarr['id']?>">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                        </td>

                                        <td><a href="delete-painting.php?id=<?php echo $v['id'] ?>&exibition_id=<?php echo $exhibitionarr['id']?>" onclick="return confirm('Are you sure you want to delete this item?')"><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></a></td>
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