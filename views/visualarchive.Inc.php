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
                                                                                <!-- <button type="submit" class="btn btn-default form-control search-bttn" value="entry-point" name="bibliography-search-entry"><span class="material-icons"></span> Search
                                                                                </button> -->
                                                                                <button type="submit" value="entry-point" name="bibliography-search-entry" class="btn-search" type="submit"><span class="material-icons">search</span></button >
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
                    <div class="artist-pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link prev" href="#">Prev</a></li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link prev" href="#">Next</a></li>
                            </ul>
                        </nav>
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
                                        <form action="adv-search-va" id="adv-search-bibliography">
                                        <div class="form-group">
                                                <select class="program-name form-control" name="visualarchive1[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>
                                                <input type="hidden" name="catg" value="Visual Archive">
                                                <input type="hidden" name="att[0]" value="va_artist">
                                            </div>
                                            <input type="hidden" name="catg" value="Visual Archive">
                                            <input type="hidden" name="att[0]" value="va_artist">
                                            <div class="form-group">
                                                
                                                <div class="dropdown">
                                                <?php echo $select_py; ?>
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>year of publication<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button> -->
                                                    
                                                    <!-- <div class="dropdown-menu radio">
                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet" id="publicationyeardiv">
                                                            <i> </i>
                                                        </label>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>from year<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="fromartworkyr" id="fromtoart1">
                                                            <i><?php echo $artworkoptions ?></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                <?php echo $select_med ?>
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>medium<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" id="mediumdiv" type="radio" value="001" name="alphabet">
                                                            <i></i>
                                                        </label>
                                                    </div> -->
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">  
                                            <div class="form-group">
                                                <div class="dropdown">
                                                <?php echo $select_sub2; ?>
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>CLASSIFICATION<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">
                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                            <i> </i>
                                                        </label>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown" placeholder="abc">
                                                <?php echo $select_ay ?>
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>year of artwork<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                            <i></i>
                                                        </label>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>to year<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="toartworkyr" id="fromtoart2">
                                                            <i><?php echo $artworkoptions ?></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="descriptive_tag[]" multiple="multiple" placeholder="descriptive tags" id="adv-search-bibliography">
                                            </div>
                                            <input type="submit" name="adv_submit" class="search-box" value="Search"/>
                                            <button type="button" class="cancel-btn" data-dismiss="modal">CANCEL</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
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
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>