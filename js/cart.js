$(document).ready(function () {
        $('#myCarousel').carousel({
                interval: 2000
            })
            
              $('div#timings').each(function(index,item){ 
                var id = $(this).data("index");
                var tm=$(item).data("time"); 
                       if(tm!='') {
                    theTime = new Date($(item).data("time")); 
                    $('.timer' +id).countdown({
                    	      until: theTime, expiryText: 'Ended', onExpiry: function() {
                            updateSale(id)} ,
                            alwaysExpire:true, compact: true, 
                            layout: 'Ends in <b> {dn} {dl}, {hnn}{sep}{mnn}{sep}{snn}</b>'
                        });
               }
            });

        $('#goback').click(function () {
                parent.history.back();
                return false;
            });

        $('#senditCancel').click(function (e) {
                $('#sendfrm').slideUp("slow");
            });
        $('#sendf').click(function (e) {
                e.preventDefault();
                if ($('#sendfrm').is(":hidden")) {
                    $('#sendfrm').slideDown("slow");

                }
                else {
                    $('#sendfrm').slideUp("slow");
                }

            });

        $('#qty').bind('keyup blur', function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            });

        $("#delivery").change(function () {

                var a = $(this).val().split("-");
                var a1 = a[1];
                var c_amt=$("input[name=c_total]").val();
                c_amtt = c_amt.replace(",", "");
                var c_amt = (parseFloat(c_amtt) > 0) ? parseFloat(c_amtt) : 0;
                var amt = (parseFloat(a1) > 0) ? parseFloat(a1) : 0;
                var gtotal = c_amt + amt;
                if (a[0] == 1) {
                    $('#paypal span').text('Complete').button("refresh");

                } else {
                    $('#paypal span').text('Continue to payment').button("refresh");
                }
                $('span.gtotal').text(gtotal.toFixed(2));
                $('span.shipping').text(amt.toFixed(2));
            });


        $('#attrib2-price').change(function () {
                var dp = parseFloat($('#dp').val());
                var cp = $('#attrib2-price option:selected').val();
                if (cp === '..select' || parseFloat(cp) == 0) {
                    var cp = $('#mprice').val();
                    var op = cp - (cp * dp / 100);
                    if (dp > 0) {
                        $('span.cur_price').html(op.toFixed(2));
                        $('span.original_price').html('<s>' + $('#mprice').val() + '</s>');
                    }
                    else {
                        $('span.original_price').html(cp);
                    }
                    return;
                }
                else {
                    var op = cp - (cp * dp / 100);
                    if (dp > 0) {
                        $('span.cur_price').html(op.toFixed(2));
                        $('span.original_price').html('<s>' + cp + '</s>');
                    } else {
                        $('span.original_price').html(cp);
                    }
                }
            });


        $('#addProduct').on('click', function (e) {
                e.preventDefault();
                var qty = $("#qty").val();
                var pid = $("#pid").val();
                var seloption2=seloption1=aid1=aid2=option1c='';
                var price1 = parseFloat($('#attrib1-price option:selected').val());
                var price2 = parseFloat($('#attrib2-price option:selected').val());

                if ($('#attrib1').length || $('#attrib1-price').length) {

                    var option1 = ($('#attrib1-price').attr("id")) ? $('#attrib1-price option:selected').val() : $('#attrib1 :selected').text();
                    var name1 = $('#attrib1attrib1').val();

                    if ($('#attrib1').length) {
                        var option1b = $('#attrib1 :selected').text();
                        var option1c=$('#attrib1 :selected').attr('id');
                    }
                    if ($('#attrib1-price').length) {
                        var option1b = $('#attrib1-price option:selected').text();
                        var option1c=$('#attrib1-price option:selected').attr('id');
                        var res1 = option1b.split("(");
                        aid1 = (price1 > 0) ? $('#attrib1-price option:selected').attr('id') : 0;
                        option1b = res1[0].trim();
                    } else {
                        option1b = option1.trim();
                        aid1 = 0;
                    }
                    optid= option1c;
                    if (option1 == '..select') {
                        $('#alertBox').modal('show');
                        return false;
                    }
                    seloption1 = '&o1=' + option1b + '&n1=' + name1 + '&aid1=' + aid1 + '&oid=' + optid;

                }

                if ($('#attrib2').length || $('#attrib2-price').length) {

                    var option2 = ($('#attrib2-price').attr("id")) ? $('#attrib2-price option:selected').val() : $('#attrib2 :selected').text();
                    var name2 = $('#attrib2attrib2').val();

                    if ($('#attrib2').length) {
                        var option2b = $('#attrib2 :selected').text();
                        var option2c=$('#attrib2 :selected').attr('id');
                    }
                    if ($('#attrib2-price').length) {
                        var option2b = $('#attrib2-price option:selected').text();
                        var option2c=$('#attrib2-price option:selected').attr('id');
                        var res = option2b.split("(");
                        option2b = res[0].trim();
                        aid2 = (price2 > 0) ? $('#attrib2-price option:selected').attr('id') : 0;
                    } else {
                        option2b = option2.trim();
                        aid2 = 0;
                    }
                    optid1= option2c;
                    if (option2 == '..select') {
                        $('#alertBox').modal('show');
                        return false;
                    }

                    seloption2 = '&o2=' + option2b + '&n2=' + name2 + '&aid2=' + aid2 + '&oid1=' + optid1;

                }

                dataString = 'cmd=add&qty=' + qty + '&pid=' + pid + seloption1 + seloption2;
                $.ajax({
                        type: "POST",
                        url: "../../cart.php",
                        data: dataString,
                        success: function (response) {
                            obj = JSON.parse(response);
                            var summary = cart_summary(obj.total, obj.plain_tot, obj.items, obj.currency);
                            $('span.cart_summary').html(' ' + summary).hide().delay(300).fadeIn(1000);
                            if ($('#minibasket').find('.list-group').length == 1) {
                                if ($("#p" + pid).length == 1) {
                                    $("#p" + pid).html(obj.info).hide().fadeIn(1400);

                                } else {
                                    var $newListItem = $('<li class="list-group-item" id="p' + obj.pid + '" >' + obj.info + '</li>').hide().delay(500).fadeIn(1400);
                                    $('#minibasket .list-group').prepend($newListItem);
                                }

                            } else {
                                $('#minibasket').append('<ul class="list-group"><li class="list-group-item" id="p' + obj.pid + '">' + obj.info + '</li></ul>');

                            }

                        }
                    });

            });

        if ($('#back-to-top').length) {
            var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
            backToTop();
            $(window).on('scroll', function () {
                    backToTop();
                });
            $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                            scrollTop: 0
                        }, 700);
                });
        }
    });

function cart_summary(total, tot, items, curr) {
    var itm = (items == 1) ? (' item') : (' items');
    if (tot > 0)
    basket_summary = items + itm + ' (' + curr + total + ')';
    else basket_summary = curr + '0';
    return basket_summary;
}

function updateSale(id) { 
$.get("end-sale.php", {
                        id: id
                    }, function (err) {
       
                     //   $('div#timer').html(err);

                    });
} 