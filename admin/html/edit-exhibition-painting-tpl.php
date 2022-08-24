<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Artwork of Artist of <?php echo $artistarr['artist_name'] ?></h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <br>
                <a class="btn btn-info" href="exhibition-paintings.php?artist_id=<?php echo $artist_id; ?>">Back to Artwork List</a>
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
                <!-- Nav tabs -->

                <!-- Tab panes -->

                <form id="add-new-form" role="form" action="db-edit-exhibition-painting.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

<!--                            <div class="form-group">
                                <label for="pname">Exhibition </label>
                                <select class="form-control" name="exhibition">
                                    <option value="?php echo $singleexhibitionarr['id']; ?>"><?php echo $singleexhibitionarr['exhibition_name']; ?></option>
                                    <option value="">Select Exhibition</option>
                                    ?php
                                    foreach ($exhibitionarr as $k1 => $v1) {
                                        if ($v1['status'] == '0') {
                                            $status = 'Archived';
                                        } else if ($v1['status'] == '1') {
                                            $status = 'Open';
                                        } else if ($v1['status'] == '2') {
                                            $status = 'Canceled';
                                        }
                                        ?>
                                        <option value="?php echo $v1['id'] ?>">?php echo $v1['exhibition_name'] . '(' . $status . ')' ?></option>
                                        ?php
                                    }
                                    ?>
                                </select>
                            </div>-->




                            <div class="form-group">
                                <label for="pname">Exhibition </label>
                                <select class="form-control js-example-basic-multiple" name="exhibition[]" multiple="multiple">
                                    <?php
                                    if (!empty($existsexhibitionarr)) {
                                        foreach ($existsexhibitionarr as $k2 => $v2) {
                                            if ($v2['status'] == '0') {
                                                $status1 = 'Archived';
                                            } else if ($v2['status'] == '1') {
                                                $status1 = 'Open';
                                            } else if ($v2['status'] == '2') {
                                                $status1 = 'Canceled';
                                            }
                                            ?>

                                            <option selected value="<?php echo $v1['exhibition_id'] ?>"><?php echo $v2['exhibition_name'] . '(' . $status1 . ')' ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    $allexhibitionnotin = allexhibitionnotin($painting_id, $exhibitionnotinstr);
                                    foreach ($allexhibitionnotin as $k1 => $v1) {
                                        if ($v1['status'] == '0') {
                                            $status = 'Archived';
                                        } else if ($v1['status'] == '1') {
                                            $status = 'Open';
                                        } else if ($v1['status'] == '2') {
                                            $status = 'Canceled';
                                        }
                                        ?>
                                        <option value="<?php echo $v1['id'] ?>"><?php echo $v1['exhibition_name'] . '(' . $status . ')' ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="tags">Painting Name</label>
                                <input type="hidden" name="artistid" value="<?php echo $artist_id ?>">
                                <input type="hidden" name="paintingid" value="<?php echo $paintingarr['id'] ?>">
                                <input type="text" class="form-control" name="paintingname" required  value="<?php echo $paintingarr['name'] ?>">
                            </div>


                            <div class="form-group">
                                <label for="tags">Description</label>
                                <textarea class="form-control" rows="3" name="desc"><?php echo $paintingarr['description'] ?></textarea>
                            </div>



                            <div class="form-group">
                                <label for="tags">Image</label>
                                <input name="OldImageFile" type="hidden" value="<?php echo $paintingarr['image']; ?>" class="btn btn-success">
                                <input name="ImageFile" type="file"  class="btn btn-success">
                                <?php
                                if ($paintingarr['image'] != '') {
                                    ?>
                                    <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $paintingarr['image']; ?>">
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="form-group">
                                <label for="pname">Medium </label>
                                <select class="form-control" name="medium">
                                    <option value="<?php echo $singlemediumarr['id'] ?>"><?php echo $singlemediumarr['medium_name'] ?></option>
                                    <option value="">Select Medium</option>
                                    <?php
                                    foreach ($mediumarr as $k2 => $v2) {
                                        ?>
                                        <option value="<?php echo $v2['id'] ?>"><?php echo $v2['medium_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tags">Dimension</label>
                                <input type="text" class="form-control" name="dimension" value="<?php echo $paintingarr['dimension'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Year</label>
                                <input type="text" class="form-control" name="paintingyear" value="<?php echo $paintingarr['year']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Painting Full Date</label>
                                <input type="date" class="form-control" name="paintingdate" value="<?php echo $paintingarr['fulldate']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Price</label>
                                <input type="text" class="form-control" name="price" value="<?php echo $paintingarr['price']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Currently Available At</label>
                                <input type="text" class="form-control" name="available_at" value="<?php echo $paintingarr['currently_available_at']; ?>">
                            </div>


                            <div class="form-group">
                                <label for="stock">Status</label>
                                <select class="form-control" name="status">
                                    <option value="<?php echo $artistarr['status'] ?>">
                                        <?php
                                        if ($artistarr['status'] == '0') {
                                            echo 'Archived';
                                        } else if ($artistarr['status'] == '1') {
                                            echo 'In Exhibition';
                                        }
                                        ?>
                                    </option>
                                    <option value="0">Archived</option>
                                    <option value="1">In Exhibition</option>
                                </select>
                            </div>


                            <div class="row">
                                <div class="col-md-12 ">

                                    <input type="submit" value="Submit" class="btn btn-default">
                                </div> 

                            </div>
                        </div>

                    </div>
                </form> 
            </div>
        </div>
    </div>