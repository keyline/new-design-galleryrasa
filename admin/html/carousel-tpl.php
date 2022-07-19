<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add Image Slide</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="carousel" method="post" enctype="multipart/form-data">
                <div class="form-group" style="padding:1.5em">

                    <div>
                        <input type="hidden" class="category" name="category" value="{category}">
                               
                      <div id="carousel-image" class="html5_uploader" style="width: 500px; height: 330px;">Your browser doesn't support native upload.</div>

                    </div>

                    
                </div>

               
            </form>
            <hr>
            {IMAGE_SLIDES}
        </div>
    </div>
</div>


<div class="modal fade" id="editCarousel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>