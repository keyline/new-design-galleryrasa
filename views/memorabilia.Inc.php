<main>
<section class="start-body visual-page visual-search-page films-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        Bengali Films Archive Search
                                    </div>
                                    <div class="left-body">
                                        <div class="hearder-options">
                                            <div class="user-options">
                                                <div class="search-wrap">
                                                    <div class="search">
                                                        <div class="top-search">
                                                            <div class="search-barOption">
                                                                <!-- <form action="product_search.php" class="search-input" method="post">
                                                                    <input class="form-control" type="search" placeholder="Search by film / cast / director" name="keyword" value="" id="mySearch" required>
                                                                    <button class="btn-search" type="submit"><i class="zmdi zmdi-search"></i></button>
                                                                </form> -->
                                                                <form method="post" action="memorabilia" name="search_form" id="search_form" role="form">
                                                                    <!-- <input class="form-control" type="search" placeholder="Search by film / cast / director" name="keyword" value="" id="mySearch" required>
                                                                    <a href="./bengali-film-archives-search.php" class="btn-search" type="submit"><span class="material-icons">search</span></a> -->
                                                                    <!-- <div class="row justify-content-center flex-nowrap"> -->
                                                                        <!-- <div class="col-md-8 col-lg-6 col-sm-9"> -->
                                                                            <select class="form-control program-name" name="memorabilia[]" multiple="multiple" data-placeholder="Search by Film / Cast / Director"></select>
                                                                                <button type="submit" class="btn-search" value="entryPoint" name="srchButtonEntryPoint"><span class="material-icons">search</span></button>
                                                                            <input type="hidden" name="catg" value="Memorabilia">
                                                                            <input type="hidden" name="att[0]" value="film">
                                                                            <input type="hidden" name="att[1]" value="cast">
                                                                            <input type="hidden" name="att[2]" value="director">
                                                                            <!-- <input type="hidden"  id="place" data-placeholder="Search by Cast/Film/Director"> -->
                                                                        <!-- </div> -->
                                                                    <!-- </div> -->
                                                                </form>
                                                            </div>
                                                            <div class="drop-form">                                                    
                                                                <a href="#" class="advanced-btn" id="myBtn" data-toggle="modal" data-target="#myModal">Advanced Search<span class="material-icons">manage_search</span>
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
        </div>
    </section>
    <section class="artist-search bibliography-search bengali-film-search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bibliography-total-box">
                        <div class="bibliography-left-box">
                            <div class="artist-inner">
                                <div class="artist-top artist-top-2">
                                    <p class="filters">FILTERS<span class="material-icons">filter_alt</span></p>
                                    <p class="reset">reset</p>
                                </div>
                            </div>
                            {leftPart}
                        </div>
                        <div class="bibliography-right-box">
                            <div class="artist-inner">
                                <div class="artist-top">
                                    <p>Search results for: <span>{keywordSearched}</span></p>
                                    <p>{countofRows} results found</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 p-0">
                                    <div class="artist-inner">
                                        <div class="artist-info">
                                            {rightPart}                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        </div>
    </section>

    <!-- Modal -->
    <div class="advance-modal">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                           
                                            <form method="POST" action="adv-search-mem.php" id="adv-search-mem">
                                            <div class="row">
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                                <div class="form-group">
                                                    <input type="text" name="author" class="form-control" placeholder="NAME">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="distributor" placeholder="distributor">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="producer" placeholder="producer">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                                <div class="form-group">
                                                <select name="attr" class="form-control" id="select-attributes">
                                                    <option value="-1">Select In/As</option>
                                                    <option value="cast">Cast</option>
                                                    <option value="director">Director</option>
                                                    <option value="beditor">Editor</option>
                                                    <option value="music">Music Director</option>
                                                    <option value="photography">Cinematographer</option>
                                                    <option value="story">Story</option>
                                                    <option value="lyrics">Lyrics</option>
                                                    <option value="playback">Playback Singer</option>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="film" placeholder="film">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="year" placeholder="year">
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
        pageSize = 9;
        incremSlide = 10;
        startPage = 0;
        numberPage = 0;
        // alert(contentCount);
        var pageCount =  contentCount / pageSize;
        var totalSlidepPage = Math.floor(pageCount / incremSlide);
            
        for(var i = 0 ; i<pageCount;i++){
            $("#pagin").append('<li class="page-item"><a class="page-link" href="javascript:void(0);">'+(i+1)+'</a></li> ');
            if(i>pageSize){
                $("#pagin li").eq(i).hide();
            }
        }
        //var prevIcon = '<a class="page-link" href="#" aria-label="Previous"><i class="zmdi zmdi-chevron-left"></i></a>';
        var prevIcon = '<i class="page-link prev"></i>';
        var prev = $("<li/>").addClass("prev page-item").html(prevIcon).click(function(){
            startPage-=10;
            incremSlide-=10;
            numberPage--;
            slide();
        });
        prev.hide();
        //var nextIcon = '<a class="page-link" href="#" aria-label="Next"><i class="zmdi zmdi-chevron-right"></i></a>';
        var nextIcon = '<i class="page-link prev"></i>';
        var next = $("<li/>").addClass("next page-item").html(nextIcon).click(function(){
            startPage+=10;
            incremSlide+=10;
            numberPage++;
            slide();
        });
        next.hide();

        $("#pagin").prepend(prev).append(next);

        $("#pagin li").first().find("a").addClass("active");

        slide = function(sens){
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
                next.show();
                prev.show();
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