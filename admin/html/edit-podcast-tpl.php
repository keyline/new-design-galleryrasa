<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Podcast</h3>
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

                <form id="add-new-form" role="form" action="db-edit-podcast.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>                            
                            <div class="form-group">
                                <label for="pname">Episode Name</label>
                                <input type="hidden" name="episode" value="<?php echo $episode['episode_id'] ?>">
                                <input type="text" class="form-control" id="epiname" name="epiname" required="" value="<?php echo $episode['episode_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Episode Image</label>
                                <input name="OldImageFile" type="hidden" value="<?php echo $episode['episode_image']; ?>"  class="btn btn-success">
                                <input name="ImageFile" type="file"  class="btn btn-success">
                                <?php
                                if ($episode['episode_image'] != '') {
                                    ?>
                                    <img src="<?php echo SITE_URL . '/' . PODCAST_THUMB_IMGS . $episode['episode_image']; ?>">
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="form-group">
                                <label for="pname">Featured Name</label>
                                <input type="text" class="form-control" id="fename" name="fename" required="" value="<?php echo $episode['featured_name']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="tags">Episode Description</label>
                                <textarea class="form-control" rows="3" name="desc"><?php echo $episode['episode_description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Episode Date</label>
                                <input type="date" class="form-control" id="epidate" name="epidate" value="<?php echo $episode['episode_date']; ?>">
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