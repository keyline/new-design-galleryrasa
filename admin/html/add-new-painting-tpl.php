<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Artwork of <?php echo $exhibitionarr['exhibition_name'] ?></h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <br>
                <a class="btn btn-info" href="#" onclick="history.go(-1)">Back to Artwork List</a>
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

                <form id="add-new-form" role="form" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="exhibitionid" value="<?php echo $exibition_id ?>">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

                            <div class="form-group">
                                <label for="pname">Artist's Name</label>
                                <select class="form-control" name="artist">
                                    <option value="">Select Artist</option>
                                    <?php

                                $sql = "SELECT artist_name,id FROM `exhibition_artists`";
                                $statement = $conn->query($sql);
                                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($data as $key) {                                    
                                        ?>
                                        <option value="<?php echo $key['id'] ?>"><?php echo $key['artist_name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Title of the Artwork</label>
                                <input type="text" class="form-control" name="paintingname">
                            </div>

                            <div class="form-group">
                                <label for="tags">Reference Number</label>
                                <input type="text" class="form-control" name="referenceno">
                            </div>

                            <div class="form-group">
                                <label for="tags">Description</label>
                                <textarea class="form-control" rows="3" name="desc"></textarea>
                            </div>



                            <div class="form-group">
                                <label for="tags">Image of the artwork</label>
                                <input name="ImageFile" type="file"  class="btn btn-success">
                            </div>

                            <div class="form-group">
                                <label for="tags">Dimension</label>
                                <input type="text" class="form-control" name="dimension">
                            </div>

                            <div class="form-group">
                                <label for="pname">Medium </label>
                                <input type="text" class="form-control" name="medium">
                                <!-- <select class="form-control" name="medium">
                                    <option value="">Select Medium</option>
                                    ?php
                                    foreach ($mediumarr as $k2 => $v2) {
                                        ?>
                                        <option value="?php echo $v2['id'] ?>">?php echo $v2['medium_name']; ?></option>
                                        ?php
                                    }
                                    ?>
                                </select> -->
                                <!-- <input type="text" placeholder="add medium" class="form-control" name="add_medium"> -->
                            </div>

                            <div class="form-group">
                                <label for="tags">Position of Signature</label>
                                <input type="text" class="form-control" name="signature">
                            </div>

                            <div class="form-group">
                                <label for="tags">Year</label>
                                <input type="text" class="form-control" name="paintingyear">
                            </div>

                            <!-- <div class="form-group">
                                <label for="tags">Painting Full Date</label>
                                <input type="date" class="form-control" name="paintingdate">
                            </div> -->

                            <div class="form-group">
                                <label for="tags">Price</label>
                                <input type="text" class="form-control" name="price">
                            </div>

                            <!-- <div class="form-group">
                                <label for="tags">Currently Available At</label>
                                <input type="text" class="form-control" name="available_at">
                            </div>

                            <div class="form-group">
                                <label for="stock">Status</label>
                                <select class="form-control" name="status">
                                    <option value="0">Archived</option>
                                    <option value="1">In Exhibition</option>
                                </select>
                            </div> -->


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


