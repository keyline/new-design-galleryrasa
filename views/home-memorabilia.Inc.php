<main>
    <section class="start-body visual-page rasa-inner bengali-film-archives">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-xl-9 col-lg-12 flex-height">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        Bengali Film Archives
                                    </div>
                                    <div class="visual-content">
                                        A wealth of ever growing resources which can be refined to achieve effective research on various fields of Indian art, crafts and films by forming an invaluable source of information
                                    </div>
                                    <div class="left-body">
                                        <div class="hearder-options">
                                            <div class="user-options">
                                                <div class="search-wrap">
                                                    <div class="search">
                                                        <div class="top-search">
                                                            <div class="search-barOption">

                                                                <form method="post" action="memorabilia" name="search_form" id="search_form" role="form">
                                                                        <!-- <div class="col-md-11 p-0"> -->
                                                                            <select class="form-control program-name" name="memorabilia[]" multiple="multiple" data-placeholder="Search by Film / Cast / Director"></select>
                                                                        <!-- </div> -->
                                                                        <!-- <div class="col-md-1 p-0"> -->
                                                                                <button type="submit" class="btn-search" value="entryPoint" name="srchButtonEntryPoint"><span class="material-icons">search</span></button>
                                                                            <!-- </div> -->
                                                                            <input type="hidden" name="catg" value="Memorabilia">
                                                                            <input type="hidden" name="att[0]" value="film">
                                                                            <input type="hidden" name="att[1]" value="cast">
                                                                            <input type="hidden" name="att[2]" value="director">                                                                  
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
    <section class="visual-artist">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-1">
                    <div class="artist-inner">
                        <div id=bengali-film class="owl-carousel owl-theme owl-loaded owl-drag">

                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/film-1.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                   <img class="img-fluid" src="images/film-2.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/film-3.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/film-4.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/film-5.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/film-3.jpg">
                                </div>
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
                                                    <!-- <option value="cast">Cast</option> -->
                                                    <!-- <option value="director">Director</option> -->
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