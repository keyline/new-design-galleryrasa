<main>
<section class="start-body visual-page rasa-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-lg-9 flex-height">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        Visual Archives
                                    </div>
                                    <!-- <div class="visual-content">
                                        This repository of images from Gallery Rasa Archives helps form a more holistic idea and gaze into an artist's body of works. Our passionate endevour to document images from rare published sources and celebrate the unsung and established has led to a foundation of credibility upon which this window into Indian art rests.
                                    </div> -->
                                    <div class="visual-content">
                                        A storehouse of images from rare and published sources to provide a deeper understanding into artists’ body of works
                                    </div>
                                    <div class="left-body">
                                        <div class="hearder-options visual-search">
                                            <div class="user-options">
                                                <div class="search-wrap">
                                                    <div class="search">
                                                        <div class="top-search">
                                                            <div class="search-barOption">
                                                                <form method="post" action="visualarchive-result" class="search-input"  name="search_form" id="search_form" role="form">
                                                                        <div class="col-lg-10 col-md-11 col-sm-11 p-0">
                                                                            <select class="program-name form-control" name="visualarchive[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>
                                                                        </div>
                                                                        <button type="submit" class="btn-search" value="entryPoint" name="srchButtonEntryPoint">
                                                                            <span class="material-icons">search</span>
                                                                        </button>
                                                                        <input type="hidden" name="catg" value="Visual Archive">
                                                                        <input type="hidden" name="att[0]" value="va_artist">
                                                                </form>
                                                            </div>
                                                            <div class="drop-form">
                                                                <!-- #myModal -->
                                                                <a href="#" class="advanced-btn" data-toggle="modal" id="myBtn" data-target="">Advanced Search<span class="material-icons">manage_search</span>
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

                        <div id="visual-artist" class="owl-carousel owl-theme owl-loaded owl-drag">

                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="<?php echo SITE_URL ?>/images/artist-1.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="<?php echo SITE_URL ?>/images/artist-2.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="<?php echo SITE_URL ?>/images/artist-3.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="<?php echo SITE_URL ?>/images/artist-4.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="<?php echo SITE_URL ?>/images/artist-5.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="<?php echo SITE_URL ?>/images/artist-3.jpg">
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
                                        <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                            <input type="hidden" name="catg" value="Visual Archive">
                                            <input type="hidden" name="att[0]" value="va_artist">
                                            <div class="form-group">
                                                <div class="dropdown">
                                                <select class="program-name form-control" name="visualarchive1[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>
                                                </div>
                                            </div>
                                            <div class="form-group">                                            
                                                <div class="dropdown">
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
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
                                                    </div> -->
                                                    <?php echo $select_py; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
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
                                                    </div> -->
                                                    <select name="fromartworkyr" class="form-control" id="fromtoart1" >
                                                    <option value="">Select Year (From)</option>
                                                    <?php echo $artworkoptions ?>
                                                    <!--                                        {artworkoption}-->
                                                </select>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
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
                                                    </div> -->
                                                    <?php echo $select_med;?>
                                                </div>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">
                                        <!-- <form> -->
                                            <div class="form-group">
                                                <?php echo $select_sub1;?>
                                                <!-- <div class="dropdown">
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
                                                </div> -->
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
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
                                                    </div> -->
                                                    <?php echo $select_ay;?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <!-- <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
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
                                                    </div> -->
                                                    <select name="toartworkyr" class="form-control"  id="fromtoart2">
                                                    <option value="">Select Year (To)</option>
                                                    <?php echo $artworkoptions ?>
                                                    <!--                                        {artworkoption}-->
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- <input type="email" class="form-control" placeholder="descriptive tags"> -->
                                                <select class="desc-tag form-control" name="descriptive_tag[]" multiple="multiple" data-placeholder="Enter Descriptive Tag"></select>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="right-part">
                                            <button type="submit" class="search-box">Search</button>
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