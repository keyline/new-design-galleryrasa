<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Artwork </h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <br>
                <a class="btn btn-info" onclick="history.go(-1)" href="#">Back to Artwork List</a>
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
                            <div class="form-group">
                                <label for="pname">Aritst's Name</label>
                                <select class="form-control js-example-basic-multiple" name="artists">  
                                    <?php                                                      foreach ($allartist as $k1 => $v1) {?>                

                                            <option value="<?php echo $v1['id'] ?>"<?php echo $v1['id'] == $paintingarr['artist_id'] ? 'selected' : '';?>><?php echo $v1['artist_name'] ?></option>
                                            <?php
                                        }
                                    
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="tags">Painting Name</label>
                                <input type="hidden" name="exhibitionid" value="<?php echo $exibition_id ?>">
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
                                <label for="tags">Reference Number</label>
                                <input type="text" class="form-control" name="referenceno" value="<?php echo $paintingarr['reference_no'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="pname">Medium </label>
                                <!-- <select class="form-control" name="medium">
                                    <option value="?php echo $singlemediumarr['id'] ?>">?php echo $singlemediumarr['medium_name'] ?></option>
                                    <option value="">Select Medium</option>
                                    ?php
                                    foreach ($mediumarr as $k2 => $v2) {
                                        ?>
                                        <option value="?php echo $v2['id'] ?>">?php echo $v2['medium_name']; ?></option>
                                        ?php
                                    }
                                    ?>
                                </select> -->
                                <input type="text" class="form-control" name="medium" value="<?php echo $paintingarr['medium'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Dimension</label>
                                <input type="text" class="form-control" name="dimension" value="<?php echo $paintingarr['dimension'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Position of Signature</label>
                                <input type="text" class="form-control" name="signature" value="<?php echo $paintingarr['signature'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Year</label>
                                <input type="text" class="form-control" name="paintingyear" value="<?php echo $paintingarr['year']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Price</label>
                                <input type="text" class="form-control" name="price" value="<?php echo $paintingarr['price']; ?>">
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