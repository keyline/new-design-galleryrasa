<main>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-12">
                <h3>VISUAL ARCHIVES</h3>
                <p>
                    This repository of images from Gallery Rasa Archives helps form a more holistic idea and gaze into an artist's body of works. Our passionate endevour to document images from rare published sources and celebrate the unsung and  established has led to a foundation of credibility upon which this window into Indian art rests.
                </p>
                <form method="post" action="visualarchive-result" name="search_form" id="search_form" role="form">
                    <div class="row justify-content-center flex-nowrap">
                        <div class="col-md-8 col-lg-6 col-sm-9">
<!--                            <input type="text" class="form-control" id="" placeholder="Enter Artist’s Name">-->

                            <select class="program-name form-control" name="visualarchive[]" multiple="multiple" data-placeholder="Enter Artist’s Name"></select>


                            <!--                            <button type="submit" class="btn btn-primary form-control">Search</button>-->


                            <button type="submit" class="btn btn-primary form-control search-bttn" value="entryPoint" name="srchButtonEntryPoint">
                                Search</button>

                            <input type="hidden" name="catg" value="Visual Archive">
                            <input type="hidden" name="att[0]" value="va_artist">

                        </div>
                    </div>
                </form>
                <p class="arial mt-3" style="font-size: 14px;">
                    <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal">
                        <strong>Advanced Search</strong>
                    </a>
                </p>



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
                <!-- Modal -->
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
                                                    <?php //echo $select_py; ?>
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

            </div>
        </div>
    </div>
</main>












<!--<div class="container search-page-background-memoribilia text-center">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="ct-h-big text-center text-uppercase search-heading">Visual Archive</h3>
        <p class="search-sub-heading text-center">Content Coming Soon.....</p>
    </div>
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">

        <div class="search-bar">
            <form method="post" action="visualarchive-result" name="search_form" id="search_form">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <select class="program-name" name="visualarchive[]" multiple="multiple" data-placeholder="Search by Artist"></select>
                        </div>



                        <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                            <button type="submit" class="btn btn-default search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search" ></span> Search</button>
                        </div>
                        <input type="hidden" name="catg" value="Visual Archive">
                        <input type="hidden" name="att[0]" value="va_artist">

                    </div>
            </form>

            <p style="" class="adv-search">  Refine your search with <a href="#" id="myBtn" data-toggle="modal" data-target="#">
                    Advanced Search</a></p>
        </div>
    </div>



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Search</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" style="margin-bottom: 27px;">

                    <form method="POST" action="adv-search-mem.php" id="adv-search-mem">
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <label>Name</label>
                                <input type="text" name="author" class="form-control"/>

                            </div>
                            <div class="col-md-6">
                                <label>Select In/As</label>
                                <select name="attr" class="form-control" id="select-attributes">
                                    <option value="-1">Choose A Role</option>
                                    <option value="cast">Cast</option>
                                    <option value="director">Director</option>
                                    <option value="editor">Editor</option>
                                    <option value="music">Music Director</option>
                                    <option value="photography">Cinematographer</option>
                                    <option value="story">Story</option>
                                    <option value="lyrics">Lyrics</option>
                                    <option value="playback">Playback Singer</option>
                                </select>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <label>Distributor</label>
                                <input type="text" name="distributor" class="form-control"/>

                            </div>
                            <div class="col-md-6">
                                <label>Film</label>
                                <input type="text" name="film" class="form-control"/>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <label>Producer</label>
                                <input type="hall" name="producer" class="form-control"/>

                            </div>

                            <div class="col-md-6">
                                <label>Year</label>
                                <input type="text" name="year" class="form-control"/>

                            </div>
                        </div>


                        <div class="clearfix"></div>
                        <br>


                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-10">
                                        <input type="submit" name="adv_submit" class="btn" value="Search"/>

                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
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
<div class="clearfix"></div>
<br>
<br>
<div class="container">
    <div class="owl-carousel owl-theme wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">-->
<?php //echo $carouselHTML; ?>
<!--        {carousel_items}-->
<!--    </div>
</div>-->
