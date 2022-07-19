<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add Images&nbsp;&nbsp;<span>{ProductName}</span></h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Poster</a></li>
                    <li role="presentation"><a href="#desc1" aria-controls="desc1" role="tab" data-toggle="tab">Synopsis</a></li>
                    <li role="presentation"><a href="#links" aria-controls="links" role="tab" data-toggle="tab">Cards</a></li>
                </ul>
                <!-- Tab panes -->
                <form id="memorabilia-images" role="form" action="memorabilia-images" method="post">
                    <input type="hidden" name="product" value="{productID}">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>
                            <div class="col-md-12">
                                <div class="col-md-7">
                                    <div style="float: left; margin-right: 20px">
                                        <h3>Posters</h3>
                                        <div id="poster" class="html5_uploader" style="width: 500px; height: 330px;">Your browser doesn't support native upload.</div>
                                    </div>
                                </div>
                                <div class="col-md-5 pull-right parent-poster">
                                    <h3>Available Posters</h3>
                                    <div id="response-poster" class="response">
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="desc1">
                            <p>&nbsp;</p>
                            <div class="col-md-12">
                                <div class="col-md-7">
                                    <div style="float: left; margin-right: 20px">
                                        <h3>Synopsis</h3>
                                        <div id="synopsis" class="html5_uploader" style="width: 500px; height: 330px;">Your browser doesn't support native upload.</div>
                                    </div>
                                </div>
                                <div class="col-md-5 pull-right parent-synopsis">
                                    <h3>Available Synopsis</h3>
                                    <div id="response-synopsis" class="response">
                                        <ul></ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="links">
                            <p>&nbsp;</p>
                            <div class="col-md-12">
                                <div class="col-md-7">
                                    <div style="float: left; margin-right: 20px">
                                        <h3>Cards</h3>
                                        <div id="card" class="html5_uploader" style="width: 500px; height: 330px;">Your browser doesn't support native upload.</div>
                                    </div>
                                </div>
                                <div class="col-md-5 pull-right parent-card">
                                    <h3>Available Cards</h3>
                                    <div id="response-card" class="response">
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>



                        </div>

                </form>
            </div>
        </div>

    </div>
    <!--start add image details in modal-->
    <div class="modal fade" id="imageDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Image Details Here</h4>
                </div>
                <div class="modal-body">
                    <div class="message"></div>
                    <form id="addimage-details" method="POST">
                        <input type="hidden" name="image_id" value="">
                        <input type="hidden" name="image_name" value="">
                        <input type="hidden" name="product" value="">
                        <input type="hidden" class="action" name="action" value="">
                    <div class="row print-original-sizes col-md-12">
                        <div class="col-md-6 sellOriginal">
                        <div class="for-group">
                            <label for="sellOriginal">Sell Original</label>
                            <input type="checkbox" class="input-box" id="sellOriginal" name="sellOriginal" value="1">
                        </div>
                        <div class="sizeboxes-sellOriginal" style="display: none">
                            <div class="row firstChoice">
                                <h4>Original Image 1</h4>
                            <div class="form-group">
                            <label for="pname">Image Size Available</label>
                            <input type="text" class="form-control" id="size0" name="sellOriginal[0][size]">
                            </div>
                            <div class="form-group">
                            <label for="pname">Quantity</label>
                            <input type="text" class="form-control" id="quantity0" name="sellOriginal[0][quantity]">
                            </div>
                            <div class="form-group">
                            <label for="pname">price</label>
                            <input type="text" class="form-control" id="price0" name="sellOriginal[0][price]">
                            </div>
                            <div class="form-group">
                            <label for="taxable">IS Taxable</label>
                            <input type="checkbox" class="taxable" name="sellOriginal[0][taxable]" value="1" title="Please Check if your product is taxable.">
                            <!--<input type="hidden"  name="sellOriginal[0][taxable]" value="0">-->
                            </div>    
                            </div>
                            <div class="row secondChoice">
                                <h4>Original Image 2</h4>
                            <div class="form-group">
                            <label for="pname">Image Size Available</label>
                            <input type="text" class="form-control" id="size1" name="sellOriginal[1][size]">
                            </div>
                            <div class="form-group">
                            <label for="pname">Quantity</label>
                            <input type="text" class="form-control" id="quantity1" name="sellOriginal[1][quantity]">
                            </div>
                            <div class="form-group">
                            <label for="pname">price</label>
                            <input type="text" class="form-control" id="price1" name="sellOriginal[1][price]">
                            </div>
                            <div class="form-group">
                            <label for="taxable">IS Taxable</label>
                            <input type="checkbox" class="taxable" name="sellOriginal[1][taxable]" value="1" title="Please Check if your product is taxable.">
                            <!--<input type="hidden"  name="sellOriginal[1][taxable]" value="0">-->
                            </div> 
                            </div>
                        </div>
                        </div>
                        <!--Input bosex for print-->
                        <div class="col-md-6 sellPrint">
                                
                        <div class="form-group">
                            <label for="sellPrint">Sell Copy</label>
                            <input type="checkbox" class="input-box" id="sellPrint" name="sellPrint" value="1">
                        </div>
                        <div class="sizeboxes-sellPrint" style="display: none">
                            <div class="row firstChoice">
                                <h4>Option 1</h4>
                            <div class="form-group">
                            <label for="pname">Image Size/Label</label>
                            <input type="text" class="form-control" id="size0" name="sellPrint[0][size]">
                            </div>
                            
                            <div class="form-group">
                            <label for="pname">price</label>
                            <input type="text" class="form-control" id="price0" name="sellPrint[0][price]">
                            </div>
                            <div class="form-group">
                            <label for="taxable">IS Taxable</label>
                            <input type="checkbox" class="taxable" name="sellPrint[0][taxable]" value="1" title="Please Check if your product is taxable.">
                            <!--<input type="hidden" name="sellPrint[0][taxable]" value="0">-->
                            </div>     
                            </div>
                            <div class="row secondChoice">
                                <h4>Option 2</h4>
                            <div class="form-group">
                            <label for="pname">Image Size/Label</label>
                            <input type="text" class="form-control" id="size1" name="sellPrint[1][size]">
                            </div>
                            
                            <div class="form-group">
                            <label for="pname">price</label>
                            <input type="text" class="form-control" id="price1" name="sellPrint[1][price]">
                            </div>
                              <div class="form-group">
                            <label for="taxable">IS Taxable</label>
                            <input type="checkbox" class="taxable" name="sellPrint[1][taxable]" value="1" title="Please Check if your product is taxable.">
                            <!--<input type="hidden" name="sellPrint[1][taxable]" value="0">-->
                            </div>  
                            </div>
                            <div class="row thirdChoice">
                                <h4>Option 3</h4>
                            <div class="form-group">
                            <label for="pname">Image Size/Label</label>
                            <input type="text" class="form-control" id="size2" name="sellPrint[2][size]">
                            </div>
                            
                            <div class="form-group">
                            <label for="pname">price</label>
                            <input type="text" class="form-control" id="price2" name="sellPrint[2][price]">
                            </div>
                                <div class="form-group">
                            <label for="taxable">IS Taxable</label>
                            <input type="checkbox" class="taxable" name="sellPrint[2][taxable]" value="1" title="Please Check if your product is taxable.">
                            <!--<input type="hidden" name="sellPrint[2][taxable]" value="0">-->
                            </div>
                            </div>
                            <div class="row fourthChoice">
                                <h4>Option 4</h4>
                            <div class="form-group">
                            <label for="pname">Image Size/label</label>
                            <input type="text" class="form-control" id="size3" name="sellPrint[3][size]">
                            </div>
                            
                            <div class="form-group">
                            <label for="pname">price</label>
                            <input type="text" class="form-control" id="price3" name="sellPrint[3][price]">
                            </div>
                            <div class="form-group">
                            <label for="taxable">IS Taxable</label>
                            <input type="checkbox" class="taxable" name="sellPrint[3][taxable]" value="1" title="Please Check if your product is taxable.">
                            <!--<input type="hidden" name="sellPrint[3][taxable]" value="0">-->
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                        
                        <div class="row">
                            <div class="col-md-12 ">

                                <input type="submit" value="Submit" name="memo-image-details" class="btn btn-default">
                            </div> 

                        </div>
                    </form>

                </div>
                
            </div>
        </div>
    </div>
    <!--end add image details in modal-->