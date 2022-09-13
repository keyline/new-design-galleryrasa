<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Upload photobook Images</h3>
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
                <form id="add-new-form" role="form" action="db_add_photobook.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>
                            <?php
                                $sql = "SELECT event_title,event_id FROM `photobook_tbl`";
                                $statement = $conn->query($sql);
                                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <div class="form-group">
                                <label for="pname">PhootBook List</label>
                                <select class="form-control" name="photo_id" id="photo_id">
                                <option  value="">-select-</option>
                                 <?php foreach ($data as $key) { ?>   
                                    <option  value="<?php echo $key['event_id'] ?>" ><?php echo $key['event_title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pname">Title</label>
                                <input type="text" placeholder="Enter Title" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="tags">PhotoBook Image</label>
                                <input name="photoBookImg" type="file"  class="btn btn-success">
                            </div>
                            <div class="form-group">
                                <label for="pname">Date</label>
                                <input type="date" class="form-control" id="eventdate" name="eventdate" required>
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


