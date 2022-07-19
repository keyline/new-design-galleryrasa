

</div>
</div>

<div class="container">
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?php echo date("Y") ?> Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</div>

<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-1.12.4.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-ui.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/select2.js"></script>
<!--<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/multiple-select.js"></script>-->
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>summernotes/summernote.js"></script>

<!-- <script src="<?php echo SITE_URL . JS_FOLDER ?>admin.js"></script>-->
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.form.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>upload.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap-switch.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>forms.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.cookie.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>moment.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap-datetimepicker.js"></script>

<script src="<?php echo SITE_URL . JS_FOLDER ?>treejs/treejs.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>plupload-master/moxie.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>plupload-master/plupload.full.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>plupload-master/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>plupload-master/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>

<script src="<?php echo SITE_URL . JS_FOLDER ?>app.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo SITE_URL . JS_FOLDER ?>ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var originalModal = $('#imageDetails').clone();

        //First calling ajax with default 
        getJSONdata($("[name='product']").val());

        //Load Visual Archive images on edit-va-product page
        var va_image = $('.nav-tabs .active > a').attr('aria-controls');
        getJSONdata($("[name='product']").val(), va_image);
        //Get bibliography data
        getPDFBibliography($("[name='product']").val());
        //Get artworks
        getArtwork($("[name='people']").val());
        //getArtwork($("[name='product']").val());
        $('.nav-tabs a').on('shown.bs.tab', function (e) {

            var id = $("[name='product']").val();
            var current_tab = $(e.target).attr('aria-controls');
            var previous_tab = $(e.relatedTarget).attr('aria-controls');

            switch (current_tab) {
                case 'home':
                    current_tab = 'poster';
                    break;
                case 'desc1':
                    current_tab = 'synopsis';
                    break;
                case 'links':
                    current_tab = 'card';
                    break;
                case 'va-artwork':
                    current_tab = 'va-artwork';
                    break;
                case 'va-artistphoto':
                    current_tab = 'va-artistphoto';
                    break;
                default:
                    current_tab = 'poster'
            }
            getJSONdata(id, current_tab);
        });


        $('#example').DataTable();
        var poster = {
            runtimes: 'html5',
            url: "plupload_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='product']").val(),
                        "type": "poster"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }
        };
        var synopsis = {
            runtimes: 'html5',
            url: "plupload_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='product']").val(),
                        "type": "synopsis"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }
        };
        var cards = {runtimes: 'html5',
            url: "plupload_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='product']").val(),
                        "type": "card"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }};
        var pdfs = {
            runtimes: 'html5',
            url: "plupload_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {

                // Maximum file size

                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                    {title: "PDF files", extensions: "pdf"}
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='product']").val(),
                        "type": "bibliography"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }};
        var artworks = {
            runtimes: 'html5',
            url: "artwork_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {

                // Maximum file size

                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png,jpeg"}
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='people']").val(),
                        "type": "artwork"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }};

        //For Carousel 
        var carousel = {runtimes: 'html5',
            url: "carousel_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='category']").val(),
                        "type": "carousel"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }};
        //For Visual Archives
        var va_artworkImages = {
            runtimes: 'html5',
            url: "plupload_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='product']").val(),
                        "type": "Art Work"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(response);
                }

            }
        };

        var va_artistPhotograph = {
            runtimes: 'html5',
            url: "plupload_upload",
            multipart: true,
            send_chunk_size: true,
            max_file_size: '1gb',
            max_file_count: 20,
            chunk_size: '1mb',
            rename: true,
            sortable: true,
            dragdrop: true,
            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                ]
            },
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
            init: {
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {

                        "marker": $("[name='product']").val(),
                        "type": "Artist Photograph"
                    };
                    console.log('Start up: ', file.loaded);
                    if (file.loaded) {
                        file.loaded = 3 * 1048576;
                        console.log('restarted');
                    }
                },
                ChunkUploaded: function (up, file, response) {
                    response = $.parseJSON(response.response || "null");
                    if (response.chunk == 3) {
                        up.stop();
                        up.start();
                    }
                    console.log(file.loaded);
                }

            }
        };
        $("#poster").pluploadQueue(poster);
        $("#synopsis").pluploadQueue(synopsis);
        $("#card").pluploadQueue(cards);
        $("#images-artwork").pluploadQueue(artworks);
        $("#pdf-bibliography").pluploadQueue(pdfs);
        $("#carousel-image").pluploadQueue(carousel);
        $("#va-artworkimages").pluploadQueue(va_artworkImages);
        $("#va_artistPhotograph").pluploadQueue(va_artistPhotograph);
        var selectedArr = [];
        $('.response').on('change', 'input:checkbox', function () {
            //$('input[type="checkbox"]').not(this).prop('checked', false);
            var action = 'false';
            var id = $(this).attr('id');
            if (this.checked) {
                action = 'update';
                selectedArr.push(this.id);
            } else {
                action = 'remove';
                selectedArr.splice(selectedArr.indexOf(this.id), 1);
            }

            var data = {cmd: action, image_nm: id, action: "featuredImage"};
            makeFeatured(data);
        });
        $(document).on("click", ".Poster-addDetails", function () {
            var id = $(this).attr('id');
            if (id) {
                getModalByid(id);
            }
            return false;
        });
        $(document).on("click", ".Synopsis-addDetails", function () {
            var id = $(this).attr('id');
            if (id) {
                getModalByid(id);
            }
            return false;
        });
        $(document).on("click", ".Card-addDetails", function () {
            var id = $(this).attr('id');
            if (id) {
                getModalByid(id);
            }
            return false;
        });
        $(document).on("click", ".Bibliography-addDetails", function () {
            var id = $(this).attr('id');
            if (id) {
                getModalByid(id);
            }
            return false;
        });
        $(document).on("click", ".artwork-addDetails", function () {
            var id = $(this).attr('id');
            if (id) {
                getArtModalByid(id);
            }
            return false;
        });
        $(document).on("click", ".delete-image", function () {
            var id = $(this).attr('id');
            // Confirm alert
            var confirmdelete = confirm("Do you really want to delete records?");
            if (id && confirmdelete) {
                imageDelete(id);
            }
            return false;
        });

        $(document).on("click", ".delete-artwork", function () {
            var id = $(this).attr('id');
            if (id) {
                artworkDelete(id);
            }
            return false;
        });



        $("form#addimage-details").submit(function (e) {
            e.preventDefault();
            var action = 'SETImageDetails';
            $(".action").prop("value", action);
            var data = $('#addimage-details').serializeArray();
            $.ajax({
                type: 'POST',
                url: 'response',
                data: data,
                dataType: 'JSON',
                beforeSend: function () {
                    $("input").prop("disabled", true);
                },
                success: function (response) {
                    if (response.result) {
                        $('.message').html("<h2>" + response.msg + "<h2>");
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        $("#imageDetails").hide();
                    }, 3000);
                    $("input").prop("disabled", false);
                }
            });
        });
        $("form#addartwork-details").submit(function (e) {
            e.preventDefault();
            var action = 'SETArtworkDetails';
            $(".action").prop("value", action);
            var data = $('#addartwork-details').serializeArray();
            $.ajax({
                type: 'POST',
                url: 'response',
                data: data,
                dataType: 'JSON',
                beforeSend: function () {
                    $("input").prop("disabled", true);
                },
                success: function (response) {
                    if (response.result) {
                        $('.message').html("<h2>" + response.msg + "<h2>");
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        $("#imageDetails").hide();
                    }, 3000);
                    $("input").prop("disabled", false);
                }});
        });
//        Images Size Modal Form
        $('#addimage-details :checkbox').not('.taxable').change(function () {
            // this represents the checkbox that was checked
            // do something with it

            var id = this.id;
            console.log(id);
            if ($('input[name=' + id + ']').is(':checked')) {

                $('.sizeboxes-' + id).show();
            } else {

                $('.sizeboxes-' + id).hide();
            }




        });
        //Delete unused attributes
        $(document).on("click", ".delete-unused", function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            if (id) {
                deleteUnused(id);
            }
            return false;
        });
        //Information showing Tooltip while adding image details
        $(".taxable").tooltip({
            position: {
                my: "center bottom",
                at: "center top-10",
                collision: "flip",
                using: function (position, feedback) {
                    $(this).addClass(feedback.vertical)
                            .css(position);
                }
            }
        });

        $('#imageDetails').on('hidden.bs.modal', function () {
            $(this).find("input[type='text']").val('').end()
                    .find("input[type='checkbox']")
                    .prop("checked", "")
                    .end();
        });

        //Carousel Status On/Off   
        $(document).on('change', 'input[name=stat]', function () {
            var id = this.id;
            var checked = false;
            if ($('input[id=' + id + ']').is(':checked')) {
                checked = true;
            }
            carousel_status_change(id, checked);

        });

        $('#btn_delete').click(function () {

            if (confirm("Are you sure you want to delete this?"))
            {
                var id = [];

                $(':checkbox:checked').each(function (i) {
                    id[i] = $(this).val();
                });

                if (id.length === 0) //tell you if the array is empty
                {
                    alert("Please Select atleast one checkbox");
                } else
                {
                    $.ajax({
                        url: 'response.php',
                        method: 'POST',
                        data: {id: id, action: 'Unused'},
                        success: function ()
                        {
                            for (var i = 0; i < id.length; i++)
                            {
                                $('tr#rw' + id[i] + '').css('background-color', '#ccc');
                                $('tr#rw' + id[i] + '').fadeOut('slow');
                            }
                        }

                    });
                }

            } else
            {
                return false;
            }
        });
    });





    function getJSONdata(id, type = 'poster') {


        var orgurl = window.location.href;
        
        var incStr = orgurl.includes("edit-va-product.php");
        //document.write("Is 'human' present in the string? : " + incStr);

        
        if(incStr==true){
            var $showData = $("#response-" + type);
          var url = '<?php echo SITE_URL . '/product_images/artwork_thumbs/' ?>';  
        }else{
            var $showData = $("#response-" + type);
            var url = '<?php echo SITE_URL . '/product_images/thumbs/' ?>';
            }


//        var $showData = $("#response-" + type);
//        var url = '<?php echo SITE_URL . '/product_images/thumbs/' ?>';



        var data = {
            "image_type": type,
            "product": id,
            "action": 'showImage'
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "response.php", //Relative or absolute path to response.php file
            data: data,
            success: function (data) {
                //data = JSON.parse(data);
                //console.log(data);
                //console.log();

                if (!jQuery.isEmptyObject(data.items)) {
                    $showData.find("ul").empty();
                    $.each(data.items, function (i, f) {
                        var checked = (f.is_featured == 1) ? "checked='checked'" : '';
                        $showData.find("ul").append('<div class="mem_img_edit_list"><img  src="' + url + f.m_image_name +
                                '" height="100" width="100"> ' +
                                '<div>' +
                                f.m_image_category_text
                                + ' <input name="' + f.m_image_category_text + '" class="' + f.m_image_category_text + '" type="checkbox" id="' + f.m_image_id + '" value="' + f.is_featured + '"' + checked + '/><label for="' + f.m_image_name + '">Make featured</label>\n' +
                                '</div>' +
                                '<div>' +
                                '<div class="btn btn-sm"><input type="button" id=' + f.m_image_category_text + '|' + f.m_image_id + ' class="' + f.m_image_category_text + '-addDetails" value="Add Details"></div>' +
                                '<div class="btn btn-sm"><input type="button" class="delete-image" id="Delete|' + f.m_image_id + '|' + f.m_image_category_text + '" value="Delete Image"></div> </li><div class="clearfix">' +
                                '</div></div>');
                        
                        
//                        $showData.find("ul").append("<div class='mem_img_edit_list'><img  src='" + url + f.m_image_name +
//                                "' height='100' width='100'> " +
//                                "<div>" +
//                                f.m_image_category_text
//                                + " <input name='" + f.m_image_category_text + "' class='" + f.m_image_category_text + "' type='checkbox' id='" + f.m_image_id + "' value='" + f.is_featured + "'" + checked + "/><label for='" + f.m_image_name + "'>Make featured</label>\n" +
//                                "</div>" +
//                                "<div>" +
//                                "<div class='btn btn-sm'><input type='button' id='" + f.m_image_category_text + "|" + f.m_image_id + "' class='" + f.m_image_category_text + "-addDetails' value='Add Details'></div>" +
//                                "<div class='btn btn-sm'><input type='button' class='delete-image' id='Delete|" + f.m_image_id + "|" + f.m_image_category_text + "' value='Delete Image'></div> </li><div class='clearfix'>" +
//                                "</div></div>");
                        
                        
                    });
                } else {
                    $showData.find("ul").html("<div>Image Not Available</div>");
                }

            }
        });
        return false;
    }

    function isEmpty(el) {
        return !$.trim(el.html())
    }

    function makeFeatured(data) {
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            beforeSend: function () {
                $("input").prop("disabled", true);
            },
            success: function (data) {
                if (data.err) {
                    alert(data.status);
                } else {
                    alert(data.status);
                }
            },
            complete: function () {
                $("input, select, button, textarea").removeAttr("disabled");
            }

        });
    }

    function getModalByid(id) {
        var data = {'image': id, 'action': 'additionalDetails-modal'};
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            cache: false,
            success: function (data) {
                //console.log(data);
                if (!jQuery.isEmptyObject(data.items)) {
                    $.each(data.items, function (key, value) {
                        $('input[name="image_id"]').val(value.id);
                        $('input[name="image_name"]').val(value.imageName);
                        $('input[name="product"]').val(value.pID);

//                            $('input[name="taxable"]').prop('checked', value.taxable == 1);


                        $.each(value.imageDetails, function (k, v) {
                            if ($.isArray(v)) {
                                if (k == 'sellOriginal') {
                                    for (var i = 0; i < v.length; i++) {
                                        if (v[i] != null) {
                                            $('input[name="sellOriginal"]').attr('checked');
                                            var org = v[i];
                                            $('input[name="' + k + '[' + i + '][size]"]').val(org.size);
                                            $('input[name="' + k + '[' + i + '][quantity]"]').val(org.quantity);
                                            $('input[name="' + k + '[' + i + '][price]"]').val(org.price);
                                            $('input[name="' + k + '[' + i + '][taxable]"]').val(org.taxable).prop('checked', org.taxable == 1);
                                        }


                                    }
                                }
                                if (k == 'sellPrint') {
                                    for (var i = 0; i < v.length; i++) {
                                        if (v[i] != null) {
                                            $('input[name="sellPrint"]').attr('checked');
                                            var prn = v[i];
                                            $('input[name="' + k + '[' + i + '][size]"]').val(prn.size);
                                            $('input[name="' + k + '[' + i + '][price]"]').val(prn.price);
                                            $('input[name="' + k + '[' + i + '][taxable]"]').val(prn.taxable).prop('checked', prn.taxable == 1);
                                        }


                                    }
                                }
                            }
                        });

                    });
                }

                $("input").prop("disabled", false);
            },
            complete: function () {
                $('#imageDetails').modal({'show': true});
            }
        });
    }




    function getArtModalByid(id) {
        var data = {'image': id, 'action': 'additionalartDetails-modal'};
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            cache: false,
            success: function (data) {
                //console.log(data);
                if (!jQuery.isEmptyObject(data.items)) {
                    $.each(data.items, function (key, value) {
                        $('input[name="image_id"]').val(value.id);
                        $('input[name="image_name"]').val(value.image);
                        $('input[name="artwork"]').val(value.artist_id);
                        $('input[name="title"]').val(value.title);
                        $("#medium-id option[value='" + value.medium1 + "']").attr("selected", "selected");
                        $('input[name="medium2"]').val(value.medium2);
                        $("#surface-id option[value='" + value.surface1 + "']").attr("selected", "selected");
                        $('input[name="surface2"]').val(value.surface2);
                        $('input[name="year_painting"]').val(value.painting_year);
                        $('input[name="size_width"]').val(value.size_width);
                        $('input[name="size_height"]').val(value.size_height);
                        $('input[name="place_publication"]').val(value.place_publication);
                        $('input[name="year_publication"]').val(value.year_publication);
                        $('input[name="location"]').val(value.location);
                        $('#artwork-comment').val(value.comment);
                    });
                }

                $("input").prop("disabled", false);
            },
            complete: function () {
                $('#imageDetails').modal({'show': true});
            }
        });
    }




    function imageDelete(id) {

        var data = {'image': id, 'action': 'Delete-image'};
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            cache: false,
            beforeSend: function () {
                $("input").prop("disabled", true);
            },
            success: function (data) {
               // console.log(data);
                if (data.err) {
                    alert(data.status);
                } else {
                    alert(data.status);
                }
            },
            complete: function () {
                $("input, select, button, textarea").removeAttr("disabled");
            }
        });
    }


    function artworkDelete(id) {

        var data = {'image': id, 'action': 'Delete-artwork'};
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            cache: false,
            beforeSend: function () {
                $("input").prop("disabled", true);
            },
            success: function (data) {
                if (data.err) {
                    alert(data.status);
                } else {
                    alert(data.status);
                }
            },
            complete: function () {
                $("input, select, button, textarea").removeAttr("disabled");
            }
        });
    }


    function deleteUnused(id) {
        var data = {'image': id, 'action': 'Delete-unused'};
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            cache: false,
            beforeSend: function () {
                $("input").prop("disabled", true);
            },
            success: function (data) {
                if (data.err) {
                    alert(data.status);
                } else {
                    alert(data.status);
                    window.location.href = window.location.href;
                }
            },
            complete: function () {
                $("input, select, button, textarea").removeAttr("disabled");
            }
        });
    }

    function getPDFBibliography(id, type = "bibliography") {
        var $showData = $("#response-" + type);
        var url = '<?php echo SITE_URL . '/product_images/bibliography/' ?>';
        var data = {
            "image_type": type,
            "product": id,
            "action": 'showImage'
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "response.php", //Relative or absolute path to response.php file
            data: data,
            success: function (data) {
                //data = JSON.parse(data);
                console.log(data);
                //console.log();

                if (!jQuery.isEmptyObject(data.items)) {
                    $showData.find("ul").empty();
                    $.each(data.items, function (i, f) {
                        var checked = (f.is_featured == 1) ? "checked='checked'" : '';
                        $showData.find("ul").append("<div class='biblio_img_edit_list'><img  src='" + url + f.m_image_name +
                                "' height='100' width='100'> " +
                                "<div>" +
                                f.m_image_category_text
                                + " <input name='" + f.m_image_category_text + "' class='" + f.m_image_category_text + "' type='checkbox' id='" + f.m_image_id + "' value='" + f.is_featured + "'" + checked + "/><label for='" + f.m_image_name + "'>Make featured</label>\n" +
                                "</div>" +
                                "<div>" +
                                "<div class='btn btn-sm'><input type='button' id='" + f.m_image_category_text + "|" + f.m_image_id + "' class='" + f.m_image_category_text + "-addDetails' value='Add Details'></div>" +
                                "<div class='btn btn-sm'><input type='button' class='delete-image' id='Delete|" + f.m_image_id + "' value='Delete Image'></div> </li><div class='clearfix'>" +
                                "</div></div>");
                    });
                } else {
                    $showData.find("ul").html("<div>Image Not Available</div>");
                }

            }
        });
        return false;
    }




    function getArtwork(id, type = "artwork") {
        var $showData = $("#response-va-" + type);
        //var url = '<?php echo SITE_URL . '/product_images/artwork/' ?>';
        var url = '<?php echo SITE_URL . '/product_images/artwork_thumbs/' ?>';
        var data = {
            "image_type": type,
            "artwork": id,
            "action": 'showImage_artwork'
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "response.php", //Relative or absolute path to response.php file
            data: data,
            success: function (data) {
                //data = JSON.parse(data);
                console.log(data);
                //console.log();

                if (!jQuery.isEmptyObject(data.items)) {
                    $showData.find("ul").empty();
                    $.each(data.items, function (i, f) {
                        // var checked = (f.is_featured == 1) ? "checked='checked'" : '';
                        $showData.find("ul").append("<div class='mem_img_edit_list'><img  src='" + url + f.image +
                                "' height='100' width='100'> " +
                                "<div>" +
                                "<div class='btn btn-sm'><input type='button' id='artwork|" + f.id + "' class='artwork-addDetails' value='Add Details'></div>" +
                                "<div class='btn btn-sm'><input type='button' class='delete-artwork' id='Delete|" + f.id + "' value='Delete Image'></div> </li><div class='clearfix'>" +
                                "</div></div>");
                    });
                } else {
                    $showData.find("ul").html("<div>Image Not Available</div>");
                }

            }
        });
        return false;
    }

    function carousel_status_change(id, status) {
        var data = {'image': id, 'action': 'carousel-statusChange', 'status': status};
        $.ajax({
            type: 'POST',
            url: 'response',
            data: data,
            dataType: 'JSON',
            cache: false,
            beforeSend: function () {
                $("input").prop("disabled", true);
            },
            success: function (data) {
                if (data.err) {
                    alert(data.status);
                } else {
                    alert(data.status);
                    window.location.href = window.location.href;
                }
            },
            complete: function () {
                $("input, select, button, textarea").removeAttr("disabled");
            }
        });

    }



</script>
</body>
</html>
