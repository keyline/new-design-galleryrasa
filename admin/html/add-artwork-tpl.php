<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add Artwork of &nbsp;&nbsp;<span>{peopleName}</span></h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <!--                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Artwork images</a></li>
                                                        <li role="presentation"><a href="#desc1" aria-controls="desc1" role="tab" data-toggle="tab">Synopsis</a></li>
                                                        <li role="presentation"><a href="#links" aria-controls="links" role="tab" data-toggle="tab">Cards</a></li>
                                </ul>-->
                <!-- Tab panes -->
                <div class="col-md-8 pdf-upload-ui">
                    <form id="artwork-images" role="form" action="artwork-images" method="post">
                        <input type="hidden" name="people" value="{peopleID}">
                        <div id="images-artwork" class="html5_uploader" style="width: 500px; height: 330px;">Your browser doesn't support native upload.</div>
                    </form>
                </div>
                <div class="col-md-4 pdf-preview">
                    <h3>Available Artworks</h3>
                    <div id="response-artwork" class="response">
                        <ul></ul>
                    </div>
                </div>

            </div>

        </div>
        <!--start add image details in modal-->
        <div class="modal fade" id="imageDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Add Image Details Here
                    </div>
                    <div class="modal-body">
                        <div class="message"></div>
                        <form id="addartwork-details" method="POST">
                            <input type="hidden" name="image_id" value="">
                            <input type="hidden" name="image_name" value="">
                            <input type="hidden" name="artwork" value="">
                            <input type="hidden" class="action" name="action" value="">
                            <div class="row print-original-sizes col-md-12">
                                <div class="col-md-6 sellOriginal">
                                    <!--                        <div class="for-group">
                                                                <label for="sellOriginal">Sell Original</label>
                                                                <input type="checkbox" class="input-box" id="sellOriginal" name="sellOriginal" value="1">
                                                            </div>-->
                                    <div class="sizeboxes-sellOriginal">
                                        <div class="row firstChoice">
                                            <h4>Fill UP the description</h4>
                                            <div class="form-group">
                                                <label for="pname">Title</label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Medium</label>
                                                <select name="medium" id="medium-id" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Acrylic">Acrylic</option>
                                                    <option value="Gouache">Gouache</option>
                                                    <option value="Oil">Oil</option>
                                                    <option value="Water Colour">Water Colour</option>
                                                    <option value="Mixed Media">Mixed Media</option>
                                                    <option value="Charcoal">Charcoal</option>
                                                    <option value="Metal">Metal</option>
                                                    <option value="Wood">Wood</option>
                                                    <option value="Others">Others</option>
                                                </select><br>
                                                <input type="text" class="form-control" id="title" name="medium2">
    <!--                                            <input type="text" class="form-control" id="medium" name="medium">-->
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Surface</label>
                                                <select name="surface" id="surface-id" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Paper">Paper</option>
                                                    <option value="Canvas">Canvas</option>
                                                    <option value="Board">Board</option>
                                                    <option value="Others">Others</option>
                                                </select><br>
                                                <input type="text" class="form-control" id="title" name="surface2">
    <!--                                            <input type="text" class="form-control" id="surface" name="surface">-->
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Year of Painting</label>
                                                <input type="text" class="form-control" id="year_painting" name="year_painting">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Size Width</label>
                                                <input type="text" class="form-control" id="size_width" name="size_width">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Size Height</label>
                                                <input type="text" class="form-control" id="size_height" name="size_height">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Place of Publication</label>
                                                <input type="text" class="form-control" id="size_height" name="place_publication">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Year of Publication</label>
                                                <input type="text" class="form-control" id="size_height" name="year_publication">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Location</label>
                                                <input type="text" class="form-control" id="size_height" name="location">
                                            </div>
                                            <div class="form-group">
                                                <label for="pname">Comment</label>
                                                <textarea class="form-control" id="artwork-comment" name="comment"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--Input bosex for print-->

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