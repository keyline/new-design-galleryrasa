<main>
<div class="container">
    <div class="row justify-content-center arial">
        <div class="col-md-9">
        <form method="post" action="memorabilia" name="search_form" id="search_form" class="bibliography-search-form">
            <div class="form-group row">
                <div class="col-md-9">
                    <select class="program-name" name="memorabilia[]" multiple="multiple" data-placeholder="Search By Film/Cast/Director"></select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-default search-bttn form-control" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search"> </span>Search
                    </button>
                </div>
            </div>
            <input type="hidden" name="catg" value="Memorabilia">
            <input type="hidden" name="att[0]" value="film">

            <input type="hidden" name="att[1]" value="cast">
            <input type="hidden" name="att[2]" value="director">
        </form>
        </div>
        
        <div class="col-md-12 text-center">
            <p style="font-size: 14px;" class="text-center">
                Refine your search with
                <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal">
                    <strong>Advanced Search</strong>
                </a>
            </p>
        </div>
    </div>
    <div class="row arial">
		<div class="col-md-4 col-xs-12 mb-md-0 mb-5">
            {leftPart}
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="row search-keyword">
                <div class="col-lg-6 keyword" style="display:{isShow};"><span>searched for: </span><span class="keyword-list">{keywordSearched}</span></div> 
                <div class="col-lg-6 count text-lg-right text-left"> <span>total result found: </span><span class="result-count">{countofRows}</span></div>
                <!--<div class="col-md-4 pull-right"></div>-->
            </div>
            <div class="row">
                {rightPart}
            </div>
        </div>
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
                    <div class="row arial text-left">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="author" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Distributor</label>
                                <input type="text" name="distributor" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Film</label>
                                <input type="text" name="film" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Producer</label>
                                <input type="hall" name="producer" class="form-control"/>
                            </div>
                        </div>
                        <!--                            <div class="col-md-6">
                                                        <label>Reel</label>
                                                        <input type="text" name="reel" class="form-control"/>
                        
                                                    </div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" name="year" class="form-control"/>
                            </div>
                        </div>
                    </div>
                        <input type="submit" name="adv_submit" class="btn form-control" value="Search"/>
            </form>
                </div>
        </div>
    </div>
</div>
</main>