<main>
    <div class="container">
        <div class="row justify-content-center arial">
            <div class="col-md-7">

                <form method="post" action="visualarchive-result" name="search_form" id="search_form" class="visualarchive-result">
                    <!--        <form method="post" action="visual-archive" name="search_form" id="search_form">-->
                    <div class="form-group row">
                        <div class="col-md-9">
                            <select class="program-name" name="visualarchive[]" multiple="multiple" data-placeholder="Search by Artist"></select>
<!--                            <select class="program-name" name="visual_archive[]" multiple="multiple" data-placeholder="Search By Artist"></select>-->
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-default form-control search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search"> </span>Search
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="catg" value="Visual Archive">
                    <input type="hidden" name="att[0]" value="va_artist">
<!--                    <input type="hidden" name="catg" value="visual_archive">
                <input type="hidden" name="att[0]" value="va_artist">-->
                </form>
                <div class="col-12 text-center">
                    <p style="font-size: 14px;">
                        Refine your search with 
                        <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal">
                            <strong>Advanced Search</strong>
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-12">


                <div class="row search-keyword text-center text-md-left" style="font-size: 16px;">
                    <!--                <div class="col-md-8" style="display: {isShow};">-->
                    <div class="col-md-8" style="display: <?php echo $styleDisplay; ?>;">    
                        <span>searched for:</span>
    <!--                    <span class="keyword-list">{keywordSearched}</span>-->
                        <span class="keyword-list"><?php echo $keyword; ?></span>
                    </div> 
                    <div class="col-md-4 count text-md-right">
                        <span>total result found:</span>
    <!--                    <span class="result-count">{countofRows}</span>-->
                        <span class="result-count"><?php echo $countofRows; ?></span>
                    </div>
                    <!--<div class="col-md-4 pull-right"></div>-->
                </div>
                <div class="row">
                    <?php echo $htmlRight; ?>
                    <!--                {rightPart}-->
                </div>
            </div>
            <!--		<div class="col-md-4 col-xs-12 pull-left">
                        {leftPart}
                    </div>-->
        </div>
    </div>    
</main>
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
                    <div class="row arial text-left">
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Back</button>
            </div>
        </div>
    </div>
</div>