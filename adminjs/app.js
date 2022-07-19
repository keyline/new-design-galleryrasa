/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {

    var select = $(".select-to-select2");
    

    $('.main-item').click(function () {
        if (isEmpty($('#response'))) {

            var category = ($(this).attr('itemname'));
            var item = ($(this).attr('mainitemid'));
            if (item != "" || item != 'undefined') {

                var data = {action: "attribute_list", value: item};
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "response.php", //Relative or absolute path to response.php file
                    data: data,
                    success: function (data) {
                        $('#response').html(data["c1"]);
                        $('#response').append(data["c2"]);
                        set_draggable();
                        
                        container2_dropable(category);
                        container1_dropable(category);

                    }
                });
                return false;
            }
        }



    });

    $(document).on('click', '#product-setting', function () {

        var select = $("select option:selected").val();
        //getSubcategory(select);
        var element = $(this).find('tree');

        $.ajax({

            type: 'POST',
            url: 'response.php',
            dataType: 'JSON',
            data: {
                setting: select,
                action: "add-new-product"
            },
            success: function (response) {

                if (response.flag)
                {

                    window.location.replace(response.redirectURL);
                }

            }
        });
        return false;
    });
    
    $(".select-to-select2").each(function () {
        initializeSelect2($(this));

    });

    
    $('#myModal').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget.id).selector;
        $('input[name="attr_id"]').val(id);
        
    });
    
   $('#btn_delete').click(function(){
            debugger;
			if(confirm("Are you sure you want to delete this?"))
		{
			var id = [];
   
		   $(':checkbox:checked').each(function(i){
			id[i] = $(this).val();
		   });
   
		   if(id.length === 0) //tell you if the array is empty
		   {
			alert("Please Select atleast one checkbox");
		   }
		   else
		   {
			$.ajax({
			 url:'response.php',
			 method:'POST',
			 data:{id:id, action:'delete_unused_attr'},
			 success:function()
			 {
			  for(var i=0; i<id.length; i++)
			  {
			   $('tr#rw'+id[i]+'').css('background-color', '#ccc');
			   $('tr#rw'+id[i]+'').fadeOut('slow');
			  }
			 }
			 
			});
			}
   
		}
		  else
		  {
		   return false;
		  }
		});

});

function set_draggable() {
    $('.box-item').draggable({
        cursor: 'move',
        helper: "clone",
        
        
        
        
    });
    $("#container1").sortable();
    
}


function container1_dropable(cat) {
    $("#container1").droppable({

        drop: function (event, ui) {

            var droppedOn = $(this);
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var dropped = ui.draggable;
            var add = (dropped.parent().attr("id"));
            $(dropped).detach().appendTo(droppedOn);
            //alert(droppedOn.attr('id') + "-container1Droppable");
            if(add == "container1"){
                
                return false;
            }
            if (droppedOn.attr('id') == 'container1') {
                var action = 'container2';
            } else {
                action = 'container1';
            }
            //alert(action + "container1()");
           save_to_Database(itemid, cat, action);
        }

    });
}

function container2_dropable(cat) {
    $("#container2").droppable({

        drop: function (event, ui) {
            var droppedOn = $(this);
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var dropped = ui.draggable;
            var add = (dropped.parent().attr("id"));
            $(dropped).detach().appendTo(droppedOn);
            //alert(droppedOn.attr('id') + "-Container2Droppable");
            if(add == "container2"){
                //alert(add + "No action");
                return false;
            }
            if (droppedOn.attr('id') == 'container1') {
                var action = 'container2';
            } else {
                action = 'container1';
            }
            //alert(action + "container2()");
            save_to_Database(itemid, cat, action);
        }

    });
}

function save_to_Database(id, category, action) {


    $.ajax({
        type: 'post',
        url: 'response.php',
        data: {
            attr_id: id,
            category: category,
            action: action
        },
        success: function (response) {
            if (response)
            {
                console.log(response);
            }

        }
    });

}



function isEmpty(el) {
    return !$.trim(el.html())
}

function add_cat() {

    $.post("fetch.php", {
        cmd: 'ca',
        n: $("input[name=catname]").val(),
        m: $("input[name=attr_id]").val()
    }, function (data) {
        //obj = JSON.parse(data);
       // console.log(obj);
        //$('#cat-list').html(obj.m);
        //$('#catselect').html(obj.s);
    });


}
    function initializeSelect2(selectElementObj) {
        $(selectElementObj).select2({
            width: '100%',
            //placeholder: 'search for ' + $(selectElementObj).attr("data-name"),
            minimumInputLength: 2,
            ajax: {
                url: 'response.php',
                dataType: 'json',
                delay: 250,
                type: 'POST',
                data: function (params) {
                    return  {
                        term: params.term,
                        action: 'selectData',
                        id: $(selectElementObj).attr('id')
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    var results = [];
                    $.each(data, function(index, item){
                       results.push({
                          id: item.id,
                          text: item.text
                       });
                    });
                    return {
                        results: results
                    };
                },
                noResults: function(term) {
      return 'No results matching: ' + term;
    }
            }
        });

    }

      