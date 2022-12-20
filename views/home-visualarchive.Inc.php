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
                                                                <a href="#" class="advanced-btn" data-toggle="modal" id="myBtn" data-target="#myModal">Advanced Search<span class="material-icons">manage_search</span>
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
    <!-- Begin as per old UI -->
    <div class="advance-modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Advanced Search</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                            </div>
                            <div class="modal-body" style="margin-bottom: 27px;">
                                <ul>
                                    <li>
                                        <h4>
                                            <a href="#!" data-toggle="modal" data-target="#form-one" data-dismiss="modal">
                                                Form 1
                                                <small>Search with Artist Name and Classification</small>
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="#!" data-toggle="modal" data-target="#form-two" data-dismiss="modal">
                                                Form 2
                                                <small>Search with Artist Name with year of publication and year range</small>
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="#!" data-toggle="modal" data-target="#form-three" data-dismiss="modal">
                                                Form 3
                                                <small>Search with Artist Name with year of artwork and year range</small>
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="#!" data-toggle="modal" data-target="#form-four" data-dismiss="modal">
                                                Form 4
                                                <small>Search with Artist Name with Medium</small>
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="#!" data-toggle="modal" data-target="#form-five" data-dismiss="modal">
                                                Form 5
                                                <small>Search with descriptive tag</small>
                                            </a>
                                        </h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal 1 -->
                <div class="modal fade" id="form-one" tabindex="-1" aria-labelledby="form-oneLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form 1</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                    <div class="row arial text-left align-items-end">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <!-- <label>Name</label> -->
                                                <select class="program-name form-control" name="visualarchive1[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>

                                            </div>
                                        </div>
                                        <input type="hidden" name="catg" value="Visual Archive">
                                        <input type="hidden" name="att[0]" value="va_artist">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Classification</label>

                                                <?php echo $select_sub1; ?>

                                                <!--                                        {adv-search-options1}-->


                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" name="adv_submit_form1" class="btn form-control" value="Search"/>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button type="button" class="btn form-control" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="form-two" tabindex="-1" aria-labelledby="form-twoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form 2</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                    <div class="row arial text-left">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <!--                                                <label>Name</label>-->
                                                <select class="program-name form-control" id="artistform2" name="visualarchive2[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>

                                            </div>
                                        </div>
                                        <input type="hidden" name="catg" value="Visual Archive">
                                        <input type="hidden" name="att[0]" value="va_artist">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Classification</label>
                                                <?php echo $select_sub2; ?>
        <!--                                                <select name="extract_type[]" id="adv-search-extract" multiple="multiple">-->
                                                <!--                                        {adv-search-options2}-->
                                                <!--                                                </select>-->

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" id="publicationyeardiv">
                                                <label>Year of Publication</label>
<!--                                                <select id="publicationyear" name="publicationyear[]" multiple="multiple">
                                                    <?php //echo $select_py;?>
                                                </select>-->
                                                  <?php echo $select_py; ?>  
                                                
        <!--                                        <select id="publicationyear" name="publicationyear[]" multiple="multiple" >
                                                    
                                                </select>-->
                                                <!--                                        {publicationyears}-->
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Year Range</label>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>From</label>
                                                <select name="frompublication" id="fromtopub1" class="form-control fromtopub" >
                                                    <option value="">Select Year</option>
                                                    
                                                    <?php echo $publicationoptions; ?>
                                                    <!--                                        {publicationoption}-->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>To</label>
                                                <select name="topublication" id="fromtopub2" class="form-control fromtopub">
                                                    <option value="">Select Year</option>
                                                    <?php echo $publicationoptions; ?>
                                                    <!--                                        {publicationoption}-->
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <input type="submit" name="adv_submit_form2" class="btn form-control" value="Search"/>
                                        </div>

                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button type="button" class="btn form-control" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="form-three" tabindex="-1" aria-labelledby="form-threeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form 3</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                    <div class="row arial text-left">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <!--                                                <label>Name</label>-->
                                                <select class="program-name form-control" id="artistform3" name="visualarchive3[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>

                                            </div>
                                        </div>
                                        <input type="hidden" name="catg" value="Visual Archive">
                                        <input type="hidden" name="att[0]" value="va_artist">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Classification</label>
                                                <?php echo $select_sub3; ?>
        <!--                                                <select name="extract_type[]" id="adv-search-extract" multiple="multiple">-->
                                                <!--                                        {adv-search-options3}-->
                                                <!--                                                </select>-->

                                            </div>
                                        </div>

                                       
                                        
                                        
                                        

                                        <div class="col-md-6">
                                            <div class="form-group" id="artworkyeardiv">
                                                <label>Year of Artwork</label>
                                                <?php echo $select_ay ?>
                                                <!--                                        {artworkyears}-->
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <label>Year Range</label>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>From</label>
                                                <select name="fromartworkyr" class="form-control" id="fromtoart1" >
                                                    <option value="">Select Year</option>
                                                    <?php echo $artworkoptions ?>
                                                    <!--                                        {artworkoption}-->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>To</label>
                                                <select name="toartworkyr" class="form-control"  id="fromtoart2">
                                                    <option value="">Select Year</option>
                                                    <?php echo $artworkoptions ?>
                                                    <!--                                        {artworkoption}-->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" name="adv_submit_form3" class="btn form-control" value="Search"/>
                                        </div>

                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button type="button" class="btn form-control" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="form-four" tabindex="-1" aria-labelledby="form-fourLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form 4</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                    <div class="row arial text-left">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <!--                                                <label>Name</label>-->
                                                <select class="program-name form-control"  id="artistform4" name="visualarchive4[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>

                                            </div>
                                        </div>
                                        <input type="hidden" name="catg" value="Visual Archive">
                                        <input type="hidden" name="att[0]" value="va_artist">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Classification</label>
                                                <?php echo $select_sub4; ?>
        <!--                                                <select name="extract_type[]" id="adv-search-extract" multiple="multiple">-->
<!--                                                {adv-search-options4}-->
                                                <!--                                                </select>-->

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" id="mediumdiv">
                                                <label>Medium</label>
                                                <?php echo $select_med ?>
<!--                                                {medium}-->
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" name="adv_submit_form4" class="btn form-control" value="Search"/>
                                        </div>


                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button type="button" class="btn form-control" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="form-five" tabindex="-1" aria-labelledby="form-fiveLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form 5</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="adv-search-va" method="POST" id="adv-search-bibliography">
                                    <div class="row arial text-left">


                                        <!--                                                <div class="col-md-12">
                                                                            <div class="form-group">
                                        
                                                                                                                                <label>Name</label>
                                                                                <select class="program-name form-control" name="visualarchive5[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>
                                        
                                                                            </div>
                                                                        </div>-->
                                        <input type="hidden" name="catg" value="Visual Archive">
                                        <input type="hidden" name="att[0]" value="va_artist">

                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <!--                                                <label>Name</label>-->
                                                <select class="desc-tag form-control" name="descriptive_tag[]" multiple="multiple" data-placeholder="Enter Descriptive Tag"></select>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" name="adv_submit_form5" class="btn form-control" value="Search"/>
                                        </div>


                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button type="button" class="btn form-control" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- End as per old UI -->
    <?php
    /**


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
     */
                                    ?>
    </div>
</main>