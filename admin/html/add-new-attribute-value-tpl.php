<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Attribute Value of <?php echo $alias ?> of <?php echo $productarr['prodname'] ?></h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <!--                <br>
                                <a class="btn btn-info" href="exhibition-paintings.php?artist_id=<?php echo $artistid; ?>">Back to Painting List</a>
                                <br>-->

                
                <!-- Nav tabs -->

                <!-- Tab panes -->

                <form id="add-new-form" role="form" action="db-add-new-attr-val.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id ?>">
                     <input type="hidden" class="form-control" name="alias" value="<?php echo $alias ?>">
                      <input type="hidden" class="form-control" name="attribute_id" value="<?php echo $attribute_id ?>">
                      <input type="hidden" class="form-control" name="type" value="<?php echo $type ?>">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

                            <?php
                            if ($attributetypearr['field_type'] == 'select-multiple') {
                                ?>
                                <div class="form-group">
                                    <label for="pname">Select Attribute Value </label>
                                    <select class="form-control" name="attrvalselect" id="attrvalselectid">
                                        <option value="">Select Attribute Value</option>
                                        <option value="new_val">New Attribute Value</option>
                                        <?php
                                        foreach ($attrvalue_list as $k4 => $v4) {
                                            ?>
                                            <option value="<?php echo $v4['attr_value_id'] ?>"><?php echo $v4['value'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="addval">
                                    <label for="tags">Attribute Value </label>
                                    <input type="text" class="form-control" name="attrvaltext">
                                </div>


                                <?php
                            } else {
                                ?>


                                <div class="form-group">
                                    <label for="tags">Attribute Value </label>
                                    <input type="text" class="form-control" name="attrval">
                                </div>


                                <?php
                            }
                            ?>
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


