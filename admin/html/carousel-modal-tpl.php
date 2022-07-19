<form action="upload-carousel.php" method="post" enctype="multipart/form-data" id="UploadForm">
    <div class="form-group">
        <label for="delivery">Title</label>
        <input class="form-control" type="text" id="p_title" name="p_title" value="{TITLE}">
    </div>
    <div class="form-group">
        <label for="delivery">Link</label>
        <input class="form-control" type="text" id="p_link" name="p_link" value="{LINK}">
    </div>
    <div class="form-group">
        <label for="delivery">Description</label>
        <textarea class="form-control" rows="3" id="desc_txt" name="desc_txt">{PDESC}</textarea>
    </div>
    <div class="form-group">
        <label for="delivery">Button Label</label>
        <input class="form-control" type="text" id="p_btn_lbl" name="p_btn_lbl" value="{BTN}">
        <input type="hidden" id="p_img" name="p_img" value="{IMG}">
        <input type="hidden" id="stat" name="stat" value="{STAT}">
    </div>

    <div class="progress" style="display:none">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>
    <div id="output"></div>
    <div class="row">
        <div class="col-xs-7"><input name="ImageFile" type="file" class="btn btn-success" multiple></div>
        <div class="col-xs-5"><input type="submit" id="SubmitButton" class="btn btn-primary" value="Upload"/>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-xs-5">
            <button type="submit" onclick="update_carousel(event,{ID})" class="btn btn-default">Update</button>
        </div>
        <div class="col-xs-7"><span id="msg" class="success" style="display:none">Updated</span></div>
    </div>
</form>