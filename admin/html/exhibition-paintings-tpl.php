<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Painting</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <h2 class="sub-header">Painting List of <?php echo $artistarr['artist_name'] ?></h2>
                <a href="add-new-exhibition-painting.php?artistid=<?php echo $artist_id ?>" class="btn btn-info">Add New</a>

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
                                <th>Exhibition</th>
                                <th>Name of Painting</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Medium</th>
                                <th>Year</th>
                                <th>Fulldate</th>
                                <th>Price</th>
                                <th>Available At</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($painting_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($painting_list as $k => $v):



                                    $exhibitionarr = allexhibitionofpaintings($v['id']);
                                    ?>

                                    <tr id="rw">
                                        <td><?php echo $i ?></td>
                                        <td><?php
                                            if (!empty($exhibitionarr)) {

                                                $countarr = count($exhibitionarr);
                                                $k = 1;
                                                foreach ($exhibitionarr as $k1 => $v1) {

                                                    if ($v1['ex_status'] == '0') {
                                                        $stat = 'Archived';
                                                    } else if ($v1['ex_status'] == '1') {
                                                        $stat = 'Open';
                                                    } else if ($v1['ex_status'] == '2') {
                                                        $stat = 'Canceled';
                                                    }

                                                    if ($countarr == $k) {
                                                        echo $v1['exhibition_name'] . '(' . $stat . ')';
                                                    } else {
                                                        echo $v1['exhibition_name'] . '(' . $stat . '),<br>';
                                                    }
                                                    $k++;
                                                }
                                            }
                                            //echo $v['exhibition_name'];
                                            ?></td>
                                        <td><?php echo $v['name']; ?></td>
                                        <td><?php echo $v['description']; ?></td>
                                        <td>
                                            <?php
                                            //echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo'];
                                            if ($v['image'] != '') {
                                                ?>

                                                <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['image']; ?>">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $v['medium_name']; ?></td>
                                        <td><?php echo $v['year']; ?></td>
                                        <td><?php echo $v['fulldate']; ?></td>
                                        <td><?php echo $v['price']; ?></td>
                                        <td><?php echo $v['currently_available_at']; ?></td>


                                        <td><?php
                                            if ($v['status'] == '0') {
                                                echo 'Archived';
                                            } else if ($v['status'] == '1') {
                                                echo 'In Exhibition';
                                            }
                                            ?></td>

                                        <td><a href="edit-exhibition-painting.php?painting_id=<?php echo $v['id'] ?>&artist_id=<?php echo $artist_id ?>">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
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