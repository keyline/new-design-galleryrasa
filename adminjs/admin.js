$(document).ready(function () {

        var max_fields = 10;
        var wrapper = $(".form-group");
        var add_button = $(".add_field_button");

        var x = 1;
        $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper).append(' <div><br /><input class="form-control" type="text" id="p_title" name="p_title[]" placeholder="Title" required=""><input class="form-control" type="text" id="p_link" name="p_link[]" placeholder="Link" ><textarea class="form-control" rows="3" id="p_desc" name="p_desc[]" placeholder="Description" ></textarea><input class="form-control" type="text" id="p_btn_lbl" name="p_btn_lbl[]" placeholder="Button label" ><input class="form-control" name="ImageFile[]" type="file"><a href="#" class="remove_field"><a href="#" class="remove_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a></div>'); //add input box
                }
            });

        $(wrapper).on("click", ".remove_field", function (e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })

        var last = $.cookie('activeAccordionGroup');

        if (last != null) {
            $("#accordion .panel-collapse").removeClass('in');
            $("#" + last).addClass("in");
        }

        $("#accordion").on('shown.bs.collapse', function () {
                var active = $("#accordion .in").attr('id');
                $.cookie('activeAccordionGroup', active)
            });

        $('a[name=cat-modal]').click(function (e) {
                e.preventDefault();
                $.get("fetch.php", {
                        cmd: 'cl'
                    }, function (data) {
                        obj = JSON.parse(data);
                        $('#cat-list').html(obj.m);

                    });
            });
        $('[data-toggle="tooltip"]').tooltip();
        $('a[name=order-modal]').click(function (e) {
                e.preventDefault();
                $('#order-details').html('');
                $('#loading-img').show();
                var id = $(this).attr('id');

                $.get("fetch.php", {
                        cmd: 'ov',
                        id: id
                    }, function (data) {
                        $('#order-details').html(data);
                        $('#loading-img').hide();

                    });
            });

        $('#page_content').summernote({
                height: 300
            });
        $('#datetimepicker1').datetimepicker();
        $(".output").on("click", "#del", function () {
                var id = $(this).data("id");

                if (confirm("Permanently delete this item?")) {
                	     $.get("fetch.php", {
                            cmd: 'pd',
                            id: id
                        }, function (data) {
                            if (data.length > 0) {
                                alert(data);
                            } else {
                                $('#delivery_options').val("");
                                $('#delivery_price').val("");
                                $("#rz" + id).fadeOut(200);
                                $("#rx" + id).fadeOut(250);
                                $("#ry" + id).fadeOut(300);
                            }

                        });
                }
            });

        $(".tab-pane").on("click", "#del", function () {
                var id = $(this).data("id");
                var img = $(this).data("img_name");
                var pid = $(this).data("pid");
                if (confirm("Permanently delete this item?")) {
                     $.post("fetch.php", {
                            cmd: 'di',
                            id: id,
                            im: img,
                            pid: pid
                        }, function (data) {
                            alert(data);

                        });
                    $(this).closest('div').fadeOut(450);
                }
            });

        $(".tab-pane").on("click", "span#del_attrib", function () {
                var id = $(this).data("id");
                var atr = $(this).data("attrib");
                $('#' + atr).empty();
                $('#lbl' + id).remove();
                $('#atr' + id).attr('value', '0');

            });

        $('span#del_product').click(function () {

                var id = $(this).data("id");
                var tr = $('#rw' + id).attr('id');

                if (confirm("Permanently delete this item?")) {
                    $.post("fetch.php", {
                            cmd: 'dp',
                            id: id
                        });
                    $(this).closest('tr').fadeOut(450);
                }
            });

        $('span#del_order').click(function () {
                var id = $(this).data("id");
                var tr = $('#rw' + id).attr('id');
                if (confirm("Permanently delete this item?")) {
                    $.post("fetch.php", {
                            cmd: 'do',
                            id: id
                        });
                    $(this).closest('tr').fadeOut(450);
                }
            })

        $('#page_id').bind('keyup blur', function () {
                $(this).val($(this).val().replace(/[^a-zA-Z0-9_-]+$/g, ''));
            });

        $(".tab-pane").on("click", "#img_upd", function () {
                var img = $(this).data("img");
                var id = $(this).data("id");
                $.post("fetch.php", {
                        cmd: 'ui',
                        id: id,
                        im: img
                    }, function (data) {
                        alert(data);
                    });
            })

        $('a[name=carousel-modal]').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                $.get("fetch.php", {
                        cmd: 'cf',
                        id: id
                    }, function (data) {
                        $('.modal-body').html(data);
                    });
            });

        $('.btn.btn-warning').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                if (typeof id === "undefined") {
                } else {
                    if (confirm("Permanently delete this item?")) {
                                 $.post("fetch.php", {
                                cmd: 'dc',
                                id: id
                            }, function (data) {
                                if (data === 'd') {
                                    $('div#well' + id).fadeOut(450, function () {
                                            $(this).remove();
                                        });
                                } else {
                                    alert(data)
                                }
                            });


                    } else {
                        return false;
                    }

                }

            });


        $('a[name=attrib-modal]').click(function (e) {
                e.preventDefault();
                $('#attrib-list').html('');
                $("div.refresh").empty()
                var aid = $(this).attr('id');
                $.get("fetch.php", {
                        cmd: 'an'
                    }, function (data) {
                        $('#attrib-list').html(data);
                        $("#fid").attr("value", aid);

                    });
            });


        $('#product_price').bind('keyup blur', function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            });
        $('#discount').bind('keyup blur', function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            });

        $('input[name="stat"]').bootstrapSwitch();
        $('input[name="stat"]').on('switchChange.bootstrapSwitch', function (o, v) {
                var id = $(this).attr('id');
                if (v) {
                    var st = 1;
                } else {
                    var st = 0;
                }
                $.post("fetch.php", {
                        cmd: 'cs',
                        st: st,
                        id: id
                    }, function (data) {

                    });

            });

        $('input[name="pstat"]').bootstrapSwitch();
        $('input[name="pstat"]').on('switchChange.bootstrapSwitch', function (o, v) {
                var id = $(this).attr('id');
                if (v) {
                    var st = 1;
                } else {
                    var st = 0;
                }
                $.post("fetch.php", {
                        cmd: 'ps',
                        st: st,
                        id: id
                    }, function (data) {
                    });

            })

        $('input[name="sstat"]').bootstrapSwitch();
        $('input[name="sstat"]').on('switchChange.bootstrapSwitch', function (o, v) {
                var id = $(this).attr('id');
                if (v) {
                    var st = 1;
                } else {
                    var st = 0;
                }
                $.post("fetch.php", {
                        cmd: 'st_s',
                        st: st,
                        id: id
                    }, function (data) {
                    });

            });
            $('input[name="cmstat"]').bootstrapSwitch();
        $('input[name="cmstat"]').on('switchChange.bootstrapSwitch', function (o, v) {
                var id = $(this).attr('id');
                if (v) {
                    var st = 1;
                } else {
                    var st = 0;
                }
                $.post("fetch.php", {
                        cmd: 'cm_s',
                        st: st,
                        id: id
                    }, function (data) {
                    });

            });
        $('input[name="tstat"]').bootstrapSwitch();
        $('input[name="tstat"]').on('switchChange.bootstrapSwitch', function (o, v) {
                var id = $(this).attr('id');
                if (v) {
                    var st = 1;
                } else {
                    var st = 0;
                }
                $.post("fetch.php", {
                        cmd: 'st_t',
                        st: st,
                        id: id
                    }, function (data) {
                    });

            });
        $("#editCarousel").on("click", function (event) {

                var progressbox = $('.progress');
                var progressbar = $('.progress-bar');
                var submitbutton = $("#SubmitButton");
                var myform = $("#UploadForm");
                var output = $("#output");
                var completed = '0%';

                $(myform).ajaxForm({

                        beforeSend: function () {
                            progressbox.show();
                            submitbutton.attr('disabled', ''); 
                            progressbox.show(); 
                            progressbar.width(completed); 
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            progressbar.width(percentComplete + '%') 

                        },
                        complete: function (response) {
                            output.html(response.responseText); 
                            myform.resetForm(); 
                            submitbutton.removeAttr('disabled'); 
                            progressbox.slideUp();
                        }
                    });
            });

        function blueBtnClicked(event) {
            event.preventDefault();

        };
        $('.swipebox').swipebox();
        $(".img-select").change(function(){
        var id = $(this).data("imgid");
        var ielem="#img-select"+id;
        var path = $('#img-path').val();
        var img= $( ielem +" option:selected" ).text(); 
         $("img[name=img-elem" + id +"]").attr("src",path+img);
     });
        


    });

function add_cat() {

    $.post("fetch.php", {
            cmd: 'ca',
            n: $("input[name=catname]").val()
        }, function (data) {
            obj = JSON.parse(data);
            $('#cat-list').html(obj.m);
            $('#catselect').html(obj.s);
        });

}

function add_attrib() {
    $.post("fetch.php", {
            cmd: 'aa',
            n: $("input[name=attrname]").val()
        }, function (data) {
            $('#attrib-list').html(data);
        });
}

function save_o_attrn_p(uid) {
    var txt = $('#o_attrn' + uid).val();
    var prc = $('#o_attrp' + uid).val();
    var stk = $('#o_attrs' + uid).val();
    $.post("fetch.php", {
            cmd: 'so',
            n: txt,
            id: uid,
            p: prc,
            s:stk
        }, function (data) {
            $('#spanattr_n_o' + uid).html(data);
        });

}

function add_attrib_options() {
    var fi = $("#attr_frm input[name=fid]").val();
    var id = $("input[name=oid]").val();
    var stk = $('#optn_stock').val();
    if ($("#optn_price").length > 0) {
        var fp = $('#optn_price').val();
    } else {
        var fp = '';
    }
    $.post("fetch.php", {
            cmd: 'ao',
            fp: fp,
            id: id,
            n: $('#optn_name').val(),
            fi: fi,
            s:stk
        }, function (data) {
            $('#rlist').html(data);
        });
}

function update_carousel(e,id) {
    e.preventDefault();
    var title = $("input[name=p_title]").val();
    var desc_txt = $('textarea#desc_txt').val();
    var lnk = $("input[name=p_link]").val();
    var lbl = $("input[name=p_btn_lbl]").val();
    var st = $("input[name=stat]").val();
    var img = $("input[name=p_img]").val();
    $.post("fetch.php", {
            cmd: 'uc',
            id: id,
            t: title,
            d: desc_txt,
            l: lnk,
            lb: lbl,
            st: st,
            img: img
        }, function (data) {
            $('#cdiv' + id).html(data);
            $("span#msg").show("slow").delay(5000).fadeOut("slow");
        });

}

function allow_digits(id) {

    $('#o_attrp' + id).bind('keyup blur', function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        });
    $('#o_attrs' + id).bind('keyup blur', function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        });
    $('#optn_price').bind('keyup blur', function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        });

}

function select_attrib(id) {
    var fi = $("#attr_frm input[name=fid]").val();
    $.post("fetch.php", {
            cmd: 'ss',
            id: id,
            fi: fi
        }, function (data) {
            $('#attrib' + fi).html(data);
            $('#attrib').modal('hide')

        });
}

function attrib_o_n_del(id) {
    var go = confirm("Permanently delete this option?");
    if (go == true) {
        $.post("fetch.php", {
                cmd: 'od',
                id: id
            }, function (data) {
                $('#rw' + id).fadeOut(900, function () {
                        $(this).remove();
                    });
            });
    } else {
        return false;
    }

}

function save_attrn(id) {
    $.post("fetch.php", {
            cmd: 'sa',
            n: $('#attrn' + id).val(),
            id: id
        }, function (data) {
            $('#spanattrn' + id).html(data);
        });

}

function save_cat(id) {
    $.post("fetch.php", {
            cmd: 'ce',
            n: $('#catn' + id).val(),
            id: id
        }, function (data) {
            obj = JSON.parse(data);
            $('#spancatn' + id).html(obj.o);
            $('#catselect').html(obj.s);
        });

}

function cat_del(id) {
    var go = confirm("Delete this category entry?");
    if (go == true) {
        $.post("fetch.php", {
                cmd: 'cd',
                n: id
            }, function (data) {
                obj = JSON.parse(data);
                $('#rw' + id).fadeOut(900, function () {
                        $(this).remove();
                    });
                $('#catselect').html(obj.s);
            });
    } else {
        return false;
    }


}

function options_list(id) {
    var fi = $("#attr_frm input[name=fid]").val();
    $.post("fetch.php", {
            cmd: 'ol',
            id: id,
            fi: fi
        }, function (data) {
            $('#attrib-options-list').html(data);

        });

}

function attrn_del(id) {
    var go = confirm("Deleting this option will also affect any products linked to it?");
    if (go == true) {
        $.post("fetch.php", {
                cmd: 'ad',
                n: id
            }, function (data) {
                $('#rw' + id).fadeOut(900, function () {
                        $(this).remove();
                    });

            });
    } else {
        return false;
    }

}