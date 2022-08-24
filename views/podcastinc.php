<main>
	<section class="start-body podcast-page artist-search">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="podcast-body">
                        <div class="podcast-micro">
                            <!--                            <i class="fa fa-microphone" aria-hidden="true"></i>-->
                            <span class="material-icons">mic</span>
                        </div>
                        <div class="podcast-title">
                            The Gallery Rasa Podcast
                        </div>
                        <div class="podcast-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in magna ultrices, tincidunt dolor sit amet, placerat lorem. Cras lorem sem, pulvinar eget nunc vel, posuere consequat nibh. Quisque vel ex elementum ligula accumsan gravida.
                        </div>
                        <div class="podcast-platform">
                            Available on these platforms
                        </div>
                        <div class="podcast-icon">
                            <ul>
                                <li><img class="img-fluid" src="assets/img/podcast-1.png"></li>
                                <li><img class="img-fluid" src="assets/img/podcast-2.png"></li>
                                <li><img class="img-fluid" src="assets/img/podcast-3.png"></li>
                                <li><img class="img-fluid" src="assets/img/podcast-4.png"></li>
                                <li><img class="img-fluid" src="assets/img/podcast-5.png"></li>
                                <li><img class="img-fluid" src="assets/img/podcast-6.png"></li>
                            </ul>

                        </div>
                    </div>
                </div>
                <?php 
                // echo "<pre>";
                // print_r($epirow); exit();
                foreach($epirow as $v)
                    { ?>
                                        
                <div class="col-lg-6">
                     <div class="line-content">   
                        <button class="podcast-inner" data-toggle="modal" data-target="#podcastModal<?php echo $v['episode_id']  ?>">
                            <div class="podcast-img">
                                <img class="img-fluid" src="<?php echo SITE_URL . '/' . PODCAST_THUMB_IMGS . $v['episode_image']; ?>">
                            </div>
                            <div class="podcast-info">
                                <div class="podcast-top">
                                    <div class="featured-box">
                                        <div class="featured-info-left">
                                            <div class="featured-action">
                                                <a href="#" class="featured-btn">FEATURED</a>
                                            </div>
                                            <div class="new-action">
                                                <a href="#" class="new-btn">NEW</a>
                                            </div>
                                        </div>
                                        <div class="featured-info-right">
                                            <a href="#" class="play-btn">
                                                <span class="material-icons">play_arrow</span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="episode-name"><?php echo $v['episode_name']; ?></div>
                                    <div class="episode-title">EP<?php echo $v['episode_id']; ?>: Featuring <?php echo $v['featured_name']; ?></div>
                                    <div class="episode-time">
                                    <?php 
                                    $date = $v['episode_date'];
                                    $date = strtotime(str_replace(',', '', $date));
                                    $d = date('l M j, Y',$date);
                                    echo $d; ?></div>
                                    <div class="episode-content"><?php echo $v['episode_description']; ?></div>
                                    <div class="read-action">
                                        <a href="#" class="read-btn">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <?php } ?>
                
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
    </section>
    <!-- Modal -->
    <?php 
    foreach($epirow as $k){ ?>
    <div class="podcast-modal">
        <div class="modal fade" id="podcastModal<?php echo $k['episode_id']  ?>" tabindex="-1" aria-labelledby="podcastModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
-->
                    <div class="modal-body">
                        <div class="advanced-search">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="podcast-inner">
                                        <div class="podcast-img">
                                            <img class="img-fluid" src="<?php echo SITE_URL . '/' . PODCAST_THUMB_IMGS . $k['episode_image']; ?>">
                                        </div>
                                        <div class="podcast-info">
                                            <div class="podcast-top">
                                                <div class="featured-info-left">
                                                    <div class="featured-action">
                                                        <a href="#" class="featured-btn">FEATURED</a>
                                                    </div>
                                                    <div class="new-action">
                                                        <a href="#" class="new-btn">NEW</a>
                                                    </div>
                                                </div>
                                                <div class="episode-name"><?php echo $k['episode_name']; ?></div>
                                                <div class="episode-title">EP<?php echo $k['episode_id']; ?>: Featuring <?php echo $k['featured_name']; ?></div>
                                                <div class="episode-time"><?php echo $k['episode_date']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="episode-content">
                                        <?php echo $k['episode_description']; ?>
                                    </div>
                                    <div class="episode-action">
                                        <div class="play-part">play on spotify<img class="img-fluid" src="assets/img/podcast-1-white.png"></div>
                                        <div class="close-action"><button type="button" class="close-btn" data-dismiss="modal">Close</button></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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
        pageSize = 4;
        incremSlide = 3;
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
        var prevIcon = '<i class="page-link prev">Prev</i>';
        var prev = $("<li/>").addClass("prev page-item").html(prevIcon).click(function(){
            startPage-=10;
            incremSlide-=10;
            numberPage--;
            slide();
        });
        prev.hide();
        //var nextIcon = '<a class="page-link" href="#" aria-label="Next"><i class="zmdi zmdi-chevron-right"></i></a>';
        var nextIcon = '<i class="page-link prev">Next</i>';
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