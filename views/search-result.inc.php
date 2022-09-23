<main>
    <section class="start-body visual-page visual-search-page bibliography-search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        Bibliography Search
                                    </div>
                                    <div class="left-body">
                                        <div class="hearder-options">
                                            <div class="user-options">
                                                <div class="search-wrap">
                                                    <div class="search">
                                                        <div class="top-search">
                                                            <div class="search-barOption">
                                                                <form method="post" action="search" name="search_form" id="search_form" class="bibliography-search-form">

                                                                        <!-- <div class="form-group row">
                                                                            <div class="col-md-11 p-0">
                                                                                <select class="program-name" name="bibliography[]" multiple="multiple" data-placeholder="Search By Author / Artist / Editor / Topic"></select>
                                                                            </div>                     
                                                                            <div class="col-md-1 p-0">
                                                                                
                                                                                <button type="submit" value="entry-point" name="bibliography-search-entry" class="btn-search" type="submit"><span class="material-icons">search</span></button >
                                                                            </div>
                                                                            </div> -->

                                                                        <div class="form-group-new-part">
                                                                                <select class="program-name" name="bibliography[]" multiple="multiple" data-placeholder="Search By Author / Artist / Editor / Topic"></select>
                                                                        
                                                                        <button type="submit" class="btn btn-default form-control search-bttn" value="entry-point" name="bibliography-search-entry"><span class="glyphicon glyphicon-search"></span> <span class="material-icons">search</span>
                                                                                </button>
                                                                     

                                                                        </div>
                                                                        <input type="hidden" name="catg" value="bibliography">
                                                                        <input type="hidden" name="att[0]" value="author">
                                                                        <input type="hidden" name="att[1]" value="artist">
                                                                        <input type="hidden" name="att[2]" value="editor">
                                                                </form>
                                                               
                                                            
                                                            
                                                        </div>
                                                        <div class="drop-form">
                                                                <a href="#" class="advanced-btn" data-toggle="modal" data-target="#advancedModal">Advanced Search<span class="material-icons">manage_search</span>
                                                                </a>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="artist-search bibliography-search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bibliography-total-box">
                        <div class="bibliography-left-box">
                            
                            {leftFilter}
            
                        </div>
                        <div class="bibliography-right-box">
                            <div class="artist-inner">
                                <div class="artist-top">
                                    <p>Search results for: <span>{searchedKeyword}</span></p>
                                    <p> {TotalResult} results found</p>
                                </div>
                            </div>
                            <!-- <div class="row"> -->
                                <!-- <div class="SearchResult">{searchList}</div> -->
                                {searchList}
                            <!-- </div> -->
                            <div class="artist-pagination" id="pagination-section">
                                <div class="col-lg-12">
                                    <div class="artist-pagination">
                                        <nav aria-label="Page navigation example">
                                            <ul id="pagin" class="pagination">
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- pagination -->                       
                    </div>
                </div>
        </div>
    </section>
    <div class="modal fade rasa-new-modal" id="citethis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cite This</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="divCitethis" class="col-md-12 col-sm-12 col-xs-12 "></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="advance-modal">
        <div class="modal fade" id="advancedModal" tabindex="-1" aria-labelledby="advancedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="advanced-search">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="search-title">
                                        Advanced Search
                                    </div>
                                </div>
                            </div>
                            
                                        <form action="adv-search" method="POST" id="adv-search-bibliography">
                                        <div class="row">
                                <div class="col-lg-6">
                                    <div class="right-part">
                                            <div class="form-group">
                                                <input type="text" name="author" class="form-control" placeholder="NAME">
                                            </div>
                                            <div class="form-group">
                                                <select name="ref_type[]" id="adv-search-extract" multiple="multiple" data-placeholder="Classification">
                                                    {adv-search-options}
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="title1_of_parent[1]" class="form-control" placeholder="BOOK">                       
                                            </div>                                            
                                            <div class="form-group">
                                                <input type="text" name="gregorian_year" class="form-control" placeholder="YEAR">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="extract" class="form-control" placeholder="EXTRACT">
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">
                                            <div class="form-group">                                             
                                                <!-- <label>Select In/As</label> -->
                                                <select name="attr" class="form-control" id="select-attributes-biblio">
                                                    <option value="">Select In/As</option>
                                                    <option value="author">Author</option>
                                                    <option value="contributor">Contributor</option>
                                                    <option value="editor">Editor</option>
                                                    <option value="artist">Artist</option>
                                                    <option value="curator">Curator</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <!-- <label>Language</label> -->
                                                <select name="language" class="form-control">
                                                    <option value="">Language</option>
                                                    {languagelist}
                                                </select>                                              
                                            </div>
                                            <div class="form-group">
                                            <!-- <label>Journal</label> -->
                                                <select name="title1_of_parent[2]" class="form-control">
                                                    <option value="">Journal</option>
                                                    {journallist}
                                                </select>                                             
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="publisher" class="form-control" placeholder="PUBLISHER">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="descriptive_tags" class="form-control" placeholder="TAGS">
                                            </div>
                                          
                                            </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">
                                    <input type="submit" name="adv_submit" class="search-box" value="Search"/>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="right-part">
                                    <button type="button" class="cancel-btn" data-dismiss="modal">CANCEL</button>
                            </div>
                            </div>
                            </div>
                                        </form>
                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $( document ).ready(function() {
    // alert();
    $('.pagination').empty();
    var contentCount = $(".line-content").length;
    // alert(contentCount);
    ajaxPagination(contentCount);
})
</script>

<script type="text/javascript">
    function ajaxPagination(contentCount){
        //Pagination
        pageSize = 10;
        incremSlide = 10;
        startPage = 0;
        numberPage = 0;
        // alert(contentCount);
        var pageCount =  contentCount / pageSize;
        // alert(pageCount);
        var totalSlidepPage = Math.floor(pageCount / incremSlide);
        // alert(totalSlidepPage);
            
        for(var i = 0 ; i<pageCount;i++){
            $("#pagin").append('<li><a class="page-link" href="javascript:void(0);">'+(i+1)+'</a></li> ');
            if(i>pageSize){
                $("#pagin li").eq(i).hide();
            }
        }
        //var prevIcon = '<a class="page-link" href="#" aria-label="Previous"><i class="zmdi zmdi-chevron-left"></i></a>';
        var prevIcon = '<i>Prev</i>';
        var prev = $("<li/>").addClass("page-link prev").html(prevIcon).click(function(){
            startPage-=10;
            incremSlide-=10;
            numberPage--;
            slide();
        });
        //prev.hide();

        //var nextIcon = '<a class="page-link" href="#" aria-label="Next"><i class="zmdi zmdi-chevron-right"></i></a>';
        var nextIcon = '<i>Next</i>';
        var next = $("<li/>").addClass("page-link prev").html(nextIcon).click(function(){
            startPage+=10;
            incremSlide+=10;
            numberPage++;
            slide();
            // alert('avijit');
        });
        //next.hide();

        $("#pagin").prepend(prev).append(next);

        $("#pagin li").first().find("a").addClass("active");

        // alert(startPage);

        slide = function(sens){
            //alert(startPage);
            //alert(numberPage);
            //alert(totalSlidepPage);
            $("#pagin li").hide();
            for(t=startPage;t<incremSlide;t++){
                $("#pagin li").eq(t+1).show();
            }
            if(startPage == 0){
                next.show();
                prev.hide();
            }else if(numberPage == totalSlidepPage ){
                next.hide();
                prev.show();
            }else{
                //alert('avijit');
                prev.show();
                next.show();
            }
        }

        showPage = function(page) {
                $(".line-content").hide();
                $(".line-content").each(function(n) {
                    if (n >= pageSize * (page - 1) && n < pageSize * page)
                        $(this).show();
                });        
        }
        showPage(1);
        $("#pagin li a").eq(0).addClass("active");
        $("#pagin li a").click(function() {
                $("#pagin li a").removeClass("active");
                $(this).addClass("active");
                showPage(parseInt($(this).text()));
        });
    }
</script>
<script type="text/javascript">
    $('#example-multiple-selected').multiselect();
</script>