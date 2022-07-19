<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Product(<?php echo $_SESSION['attribute']; ?>)</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Info</a></li>
                    <li role="presentation"><a href="#desc1" aria-controls="desc1" role="tab" data-toggle="tab">Attributes</a></li>
                    <li role="presentation"><a href="#links" aria-controls="links" role="tab" data-toggle="tab">Categories</a></li>
                    <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Images</a></li>

                </ul>
                <!-- Tab panes -->

                <form id="add-new-form" role="form" action="add-new" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>
                            <input type="hidden" name="attr" value="<?php echo $_SESSION['attribute'] ?>">
                            <div class="form-group">
                                <label for="pname">Product Name</label>
                                <input type="text" class="form-control" id="pname" name="pname" required="">
                            </div>
                            <div class="form-group">
                                <label for="tags">Description</label>
                                <textarea class="form-control" rows="3" name="desc1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Short Description</label>
                                <textarea class="form-control" rows="2" name="short_desc1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags &nbsp; &nbsp;  (separate keywords with spaces)</label>
                                <input type="text" class="form-control"  id="tags" name="tags">
                            </div>
                            <?php if ($_SESSION['attribute'] == 'Visual Archive') {
                                ?>

                                <div class="form-group">
                                    <label for="tags">Credit</label>
                                    <input type="number" class="form-control"  id="credit" name="credit">
                                </div>
                                <?php
                            }
                            ?>
                            <?php if ($_SESSION['attribute'] != 'Visual Archive') {
                                ?>


                                <div class="form-group">
                                    <label for="stock">Total Stock Available </label>
                                    <input type="text" class="form-control" id="stock" name="stock" >
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price <span>*</span></label>
                                            <input class="form-control" id="product_price" name="product_price" type="text"  required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount">Discount <span>%</span></label>
                                            <input class="form-control" type="text" id="discount" name="discount">
                                        </div>
                                    </div>
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
                        <div role="tabpanel" class="tab-pane" id="desc1">


                            <?php
                            $html = array_filter(array_map('array_filter', $html));
                            $num_rows = count($html);

                            foreach ($html AS $val) {
                                if (is_array($val)) {
                                    foreach ($val AS $k => $v) {
                                        echo '<div class="form-group">' . $v . '</div>';
                                    }
                                }
                            }
                            ?>


                        </div>
                        <div role="tabpanel" class="tab-pane" id="links">
                            <div id="tree" class="tree">
                                <!-- Dynamic Content -->
                                <p>this is dynamic content</p>
                            </div>
                        </div>
                </form> 

                <div role="tabpanel" class="tab-pane" id="images">
                    <br>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>

                    <div id="output"></div>
                    <!--<div class="add-more-cont"><a id="add_more"><img src="img/add_icon.jpg">Add More</a></div>-->
                    <form action="upload.php" method="post" enctype="multipart/form-data" id="UploadForm">  
                        <div class="row input-files">
                            <div class="col-xs-6"><input name="ImageFile[]" type="file"  class="btn btn-success" multiple></div>
                            <div class="col-xs-6"><input type="submit"  id="SubmitButton" class="btn btn-default" value="Upload" /></div>
                        </div>

                    </form>
                </div>

                <!--	 <div role="tabpanel" class="tab-pane" id="links">
                            <br>
                          <div class="row">
                                        <div class="col-md-5">
                                           <div class="form-group">
                                              <label for="price">Item Button</label>
                                              <input class="form-control" id="item_btn1" name="item_btn1" type="text">
                                           </div>
                                        </div>
                                        <div class="col-md-5">
                                           <div class="form-group">
                                              <label for="discount">Item Link</label>
                                              <input class="form-control" type="text" id="item_lnk1" name="item_lnk1">
                                           </div>
                                        </div>
                                         <div class="col-md-2">
                                         
                                        </div>
                                     </div>
                                   
                                   <div class="row">
                                        <div class="col-md-5">
                                           <div class="form-group">
                                              <label for="price">Item Button</label>
                                              <input class="form-control" id="item_btn2" name="item_btn2" type="text"  required="">
                                           </div>
                                        </div>
                                        <div class="col-md-5">
                                           <div class="form-group">
                                              <label for="discount">Item Button</label>
                                              <input class="form-control" type="text" id="item_lnk2" name="item_lnk2">
                                           </div>
                                        </div>
                                          <div class="col-md-2">
                                
                                        </div>
                                     </div><input type="submit" value="Submit" class="btn btn-default">
                            </div>-->

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Category</h4>
            </div>
            <div class="modal-body scrolldiv">
                <div id="newcatform">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" name="attr_id" value="">
                            <input type="text" class="form-control" name="catname" id="catname" placeholder="Add category"></div>
                        <div class="col-md-4"><button type="submit" class="btn btn-success save-attribute" onclick="add_cat();"> Add New</button></div>
                    </div>
                    <br />
                </div>
                <!--<div id="cat-list"></div>-->
            </div>
        </div>
    </div>
</div>
