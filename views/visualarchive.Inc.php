<section class="start-body visual-page visual-search-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        Visual Archive Search
                                    </div>
                                    <di v class="left-body">
                                        <div class="hearder-options">
                                            <div class="user-options">
                                                <div class="search-wrap">
                                                    <div class="search">
                                                        <div class="top-search">
                                                            <div class="search-barOption">
                                                                <form method="post" action="visualarchive-result" name="search_form" id="search_form" class="visualarchive-result">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-11 p-0">
                                                                            <select class="program-name" name="visualarchive[]" multiple="multiple" data-placeholder="Search by Artist"></select>
                                                                        </div>
                                                                        <div class="col-md-1 p-0">
                                                                                <button type="submit" value="entryPoint" name="srchButtonEntryPoint" class="btn-search" type="submit"><span class="material-icons">search</span></button >
                                                                            </div>
                                                                    </div>
                                                                        <input type="hidden" name="catg" value="Visual Archive">
                                                                        <input type="hidden" name="att[0]" value="va_artist">
                                                                </form>
                                                            </div>

                                                            <div class="drop-form">
                                                                <a href="#" class="advanced-btn" id="myBtn" aria-labelledby="myModalLabel" data-toggle="modal" data-target="#myModal">Advanced Search<span class="material-icons">manage_search</span>
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
    <section class="artist-search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="artist-inner">
                        <div class="artist-top">
                            <p>Search results for: <span><?php echo $keyword; ?></span></p>
                            <p><?php echo $countofRows; ?> results found</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12 p-0">
                    <div class="artist-inner">
                        <div class="artist-info">
                            <?php echo $htmlRight; ?>
                        </div>
                    </div>
                </div>  
                
                <div class="col-lg-12">
                    <div class="artist-pagination" id="pagination-section">
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
    </section>
   
        <!-- Modal -->
    <div class="advance-modal">
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="advancedModalLabel" aria-hidden="true">
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="NAME">
                                                </div>
                                                <div class="form-group">                                            
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                            <p>year of publication<span class="material-icons">keyboard_arrow_down</span></p>
                                                        </button>
                                                        <div class="dropdown-menu radio">
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                                <i>year of publication</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                                <i>year of publication 2</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                                <i>year of publication 3</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                            <p>from year<span class="material-icons">keyboard_arrow_down</span></p>
                                                        </button>
                                                        <div class="dropdown-menu radio">
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                                <i>from year</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                                <i>from year 2</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                                <i>from year 3</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                            <p>medium<span class="material-icons">keyboard_arrow_down</span></p>
                                                        </button>
                                                        <div class="dropdown-menu radio">
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                                <i>medium</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                                <i>medium 2</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                                <i>medium 3</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                            <form>
                                                <div class="form-group">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                            <p>CLASSIFICATION<span class="material-icons">keyboard_arrow_down</span></p>
                                                        </button>
                                                        <div class="dropdown-menu radio">
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                                <i>CLASSIFICATION</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                                <i>CLASSIFICATION 2</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                                <i>CLASSIFICATION 3</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                            <p>year of artwork<span class="material-icons">keyboard_arrow_down</span></p>
                                                        </button>
                                                        <div class="dropdown-menu radio">
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                                <i>year of artwork</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                                <i>year of artwork 2</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                                <i>year of artwork 3</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                            <p>to year<span class="material-icons">keyboard_arrow_down</span></p>
                                                        </button>
                                                        <div class="dropdown-menu radio">
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                                <i>to year</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                                <i>to year 2</i>
                                                            </label>
                                                            <label class="dropdown-item">
                                                                <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                                <i>to year 3</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="descriptive tags">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                                <button type="button" class="search-box">Search</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                                <button type="button" class="cancel-btn" data-dismiss="modal">CANCEL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

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
            $("#pagin").append('<li class="page-item"><a class="page-link" href="javascript:void(0);">'+(i+1)+'</a></li> ');
            if(i>pageSize){
                $("#pagin li").eq(i).hide();
            }
        }
        //var prevIcon = '<a class="page-link" href="#" aria-label="Previous"><i class="zmdi zmdi-chevron-left"></i></a>';
        var prevIcon = '<li class="page-item">Prev</li>';
        var prev = $("<li/>").addClass("page-link prev").html(prevIcon).click(function(){
            startPage-=10;
            incremSlide-=10;
            numberPage--;
            slide();
        });
        // prev.hide();
        //var nextIcon = '<a class="page-link" href="#" aria-label="Next"><i class="zmdi zmdi-chevron-right"></i></a>';
        var nextIcon = '<i class="page-item">Next</i>';
        var next = $("<li/>").addClass("page-link prev").html(nextIcon).click(function(){
            startPage+=10;
            incremSlide+=10;
            numberPage++;
            slide();
        });
        // next.hide();

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

<script type="text/javascript">
    $('#example-multiple-selected').multiselect();
</script>