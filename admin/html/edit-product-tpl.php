<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Product</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Info</a></li>
                    <li role="presentation"><a href="#desc1" aria-controls="desc1" role="tab" data-toggle="tab">Descriptions</a>
                    </li>
                    <li role="presentation"><a href="#images" aria-controls="images" role="tab"
                                               data-toggle="tab">Images</a></li>
                    <li role="presentation"><a href="#links" aria-controls="links" role="tab"
                                               data-toggle="tab">Links</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Status</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <form id="checkout-form" role="form" action="edit-product" method="post">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

                            <div class="form-group">
                                <label for="delivery">Category &nbsp; &nbsp;
                                    <small><a href="#" data-toggle="modal" name="cat-modal"
                                              data-target="#myModal">edit</a></small>
                                </label>

                                <div id="cat-select">
                                    {CATEGORY}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pname">Product Name</label>
                                <input type="text" class="form-control" id="pname" name="pname" value="{PNAME}">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags &nbsp; &nbsp; (separate keywords with spaces)</label>
                                <input type="text" class="form-control" id="tags" name="tags" value="{TAGS}">
                            </div>
			    <div class="form-group">
                                <label for="stock">Total Stock Available </label>
                                <input type="text" class="form-control" id="stock" name="stock" value="{STOCK}">
                            </div>
				   <div class="row">
        <div class='col-sm-12'>
            <div class="form-group">
	   <label for="timer">Timer Expiry Date </label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="timer" value="{TIMER}" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
           </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price <span>*</span></label>
                                        <input class="form-control" id="product_price" name="product_price" type="text"
                                               value="{PRICE}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">Discount <span>%</span></label>
                                        <input class="form-control" type="text" id="discount" name="discount"
                                               value="{DISCOUNT}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div id="attrib1">
                                        {ATTRIB1}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div id="attrib2">
                                        {ATTRIB2}
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Update" class="btn btn-default" >
                        </div>
                        <div role="tabpanel" class="tab-pane" id="desc1">
                            <br/>

                            <div class="form-group">
                                <label for="delivery">Tab 1</label>
                                <input type="text" class="form-control" id="desc_title1" name="desc_title1"
                                       value="{P_DESC_TITLE}">
                                <textarea class="form-control" rows="3" name="desc1">{PRO_DESC}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="delivery">Tab 2</label>
                                <input type="text" class="form-control" id="desc_title2" name="desc_title2"
                                       value="{P_DESC_TITLE2}">
                                <textarea class="form-control" rows="3" name="desc2">{PRO_DESC2}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="delivery">Tab 3</label>
                                <input type="text" class="form-control" id="desc_title3" name="desc_title3"
                                       value="{P_DESC_TITLE3}">
                                <textarea class="form-control" rows="3" name="desc3">{PRO_DESC3}</textarea>
                            </div>
                            <input name="pid2" type="hidden" value="{PROD_ID}">
                            <input type="submit" value="Update" class="btn btn-default" >
                        </div>

                </form>
                <div role="tabpanel" class="tab-pane" id="images">

                    <br/>
                    {P_IMAGES}
                    <br>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                             aria-valuemax="100">
                        </div>
                    </div>

                    <div id="output"></div>
                    <form action="upload-product-edit.php" method="post" enctype="multipart/form-data" id="UploadForm">
                        <div class="row">
                            <div class="col-xs-6"><input name="ImageFile[]" type="file" class="btn btn-success"
                                                         multiple>

                            </div>
                            <div class="col-xs-6"><input type="submit" id="SubmitButton" class="btn btn-default" value="Upload" />
                                <input name="pid" type="hidden" value="{PROD_ID}">
                            </div>
                        </div>
                    </form>

                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <br/>

                    <dl class="dl-horizontal">
                        <dt>Product stat</dt>
                        <dd><input id="{PROD_ID}" name="pstat" type="checkbox" data-on-text="Live" data-size="mini"
                                   data-off-color="warning" data-on-color="success" {P_STATUS}></dd>

                        <dt>Views:</dt>
                        <dd>{P_VIEWS}</dd>


                        <dt>Edited:</dt>
                        <dd>{P_EDITED}</dd>

                        <dt>Created:</dt>
                        <dd>{P_CREATED}</dd>

                        {LINK_CLICKS}
                    </dl>
                </div>

                <div role="tabpanel" class="tab-pane" id="links">
                    <br>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="price">Item Button</label>
                                <input class="form-control" id="item_btn1" name="item_btn1" type="text"
                                       value="{ITEM_BTN1}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="discount">Item Link</label>
                                <input class="form-control" type="text" id="item_lnk1" name="item_lnk1"
                                       value="{ITEM_LNK1}">
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="price">Item Button</label>
                                <input class="form-control" id="item_btn2" name="item_btn2" type="text"
                                       value="{ITEM_BTN2}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="discount">Item Button</label>
                                <input class="form-control" type="text" id="item_lnk2" value="{ITEM_LNK2}"
                                       name="item_lnk2">
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-default" >
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Category</h4>
            </div>
            <div class="modal-body scrolldiv">
                <div id="newcatform">
                    <div class="row">
                        <div class="col-md-8"><input type="text" class="form-control" name="catname" id="catname"
                                                     placeholder="Add category"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success" onclick="add_cat()"> Add New</button>
                        </div>
                    </div>
                    <br/>
                </div>
                <div id="cat-list"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="attrib" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Product Attributes</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 scrolldiv">
                        <div id="attr_frm">
                            <div class="row">
                                <div class="col-md-8"><input type="text" class="form-control" name="attrname"
                                                             id="attrname" placeholder="Attribute Name"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success" onclick="add_attrib()"> Add New
                                    </button>
                                </div>
                                <input type="hidden" name="fid" id="fid">
                            </div>
                            <br/>
                        </div>
                        <div id="attrib-list"></div>
                    </div>
                    <div class="col-md-6 scrolldiv">
                        <div id="attrib-options-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>