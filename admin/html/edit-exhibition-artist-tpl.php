<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Exhibition Artist</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

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

                <form id="add-new-form" role="form" action="db-edit-exhibition-artist.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

                            <div class="form-group">
                                <label for="pname">Exhibition Name</label>
                                <input type="hidden" name="artistid" value="<?php echo $artistarr['id'] ?>">
                                <label for="pname">Artist Name</label>
                                <input type="text" class="form-control" id="exname" name="artistname" required="" value="<?php echo $artistarr['artist_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Year of birth</label>
                                <input type="text" class="form-control" name="birth" value="<?php echo $artistarr['artist_birth'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Year of death</label>
                                <input type="text" class="form-control" name="death" value="<?php echo $artistarr['artist_death'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Description</label>
                                <textarea class="form-control" rows="3" name="desc"><?php echo $artistarr['artist_description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Description2</label>
                                <textarea class="form-control" rows="3" name="desc2"><?php echo $artistarr['artist_description2'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Description3</label>
                                <textarea class="form-control" rows="3" name="desc3"><?php echo $artistarr['artist_description3'] ?></textarea>
                            </div>



                            <div class="form-group">
                                <label for="tags">Photo</label>
                                <input name="OldImageFile" type="hidden" value="<?php echo $artistarr['photograph']; ?>" class="btn btn-success">
                                <input name="ImageFile" type="file"  class="btn btn-success">
                                <?php
                                if ($artistarr['photograph'] != '') {
                                    ?>
                                    <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $artistarr['photograph']; ?>">
                                    <?php
                                }
                                ?>
                            </div>




                            <div class="form-group">
                                <label for="stock">Status</label>
                                <select class="form-control" name="status">
                                    <option value="<?php echo $artistarr['status'] ?>">
                                        <?php
                                        if ($artistarr['status'] == '0') {
                                            echo 'Inactive';
                                        } else if ($artistarr['status'] == '1') {
                                            echo 'Active';
                                        }
                                        ?>
                                    </option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
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