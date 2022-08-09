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
                                                                        <div class="col-md-9">
                                                                            <select class="program-name" name="visualarchive[]" multiple="multiple" data-placeholder="Search by Artist"></select>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <button type="submit" class="btn btn-default form-control search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search"> </span>Search
                                                                            </button>
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
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="right-part">
                                        <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                            <div class="form-group">
                                                <select class="program-name form-control" name="visualarchive1[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>
                                                <input type="hidden" name="catg" value="Visual Archive">
                                                <input type="hidden" name="att[0]" value="va_artist">
                                            </div>
                                            <div class="form-group">                                             
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>year of publication<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">
                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                            <i><?php echo $select_py; ?></i>
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
                                                            <i><?php echo $artworkoptions ?></i>
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
                                                            <i><?php echo $select_med ?></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>CLASSIFICATION<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                            <i><?php echo $select_sub1; ?></i>
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
                                                            <!-- <input class="jRadioDropdown" type="radio" value="001" name="alphabet"> -->
                                                            <?php echo $select_ay ?>
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
                                                            <i><?php echo $artworkoptions ?></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="descriptive tags">
                                            </div>
                                        </div>
                                    </div>                                                        
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="right-part">
                                            <button type="button" class="search-box">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-lg-6">
                                                    <div class="right-part">
                                            <button type="button" class="cancel-btn" data-dismiss="modal">CANCEL</button>
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