<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form method="post" action="memorabilia" name="search_form" id="search_form">
                    <div class="col-md-12">
                        <div class="col-md-8 col-md-offset-2 col-sm-4">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <select class="program-name" name="memorabilia[]" multiple="multiple" data-placeholder="Search By Film/Cast/Director"></select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-default search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search"> </span>Search
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="catg" value="Memorabilia">
                            <input type="hidden" name="att[0]" value="film">

                            <input type="hidden" name="att[1]" value="cast">
                            <input type="hidden" name="att[2]" value="director">

                        </div>
                    </div>
                </form>
                <div class="col-md-8 col-md-offset-2 col-sm-4 text-center">
                    <p style="padding-top: 15px;" class="adv-search"> Refine your search with <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal"><strong>
                                Advanced Search</strong></a></p>
                </div>
            </div>
            <div class="col-md-12">


                <div class="col-md-12 col-xs-12 pull-right">
                    <div class="col-md-12 search-keyword">
                        <div class="col-md-6 keyword" style="display:{isShow};"><span>Keyword searched for: </span><span class="keyword-list">{keywordSearched}</span></div>
                        <div class="col-md-6 count"> <span>Total result found: </span><span class="result-count">{countofRows}</span></div>
                        <!--<div class="col-md-4 pull-right"></div>-->
                    </div>
                    {rightPart}
                </div>
                <!--<div class="col-md-4 col-xs-12 pull-left">
            {leftPart}
        </div>--->
            </div>
        </div>
    </div>
</main> 
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
                            <input type="text" name="author" class="form-control" />

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
                            <input type="text" name="distributor" class="form-control" />

                        </div>
                        <div class="col-md-6">
                            <label>Film</label>
                            <input type="text" name="film" class="form-control" />

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-6">

                            <label>Producer</label>
                            <input type="hall" name="producer" class="form-control" />

                        </div>
                        <!--                            <div class="col-md-6">
                                                        <label>Reel</label>
                                                        <input type="text" name="reel" class="form-control"/>
                        
                                                    </div>-->
                        <div class="col-md-6">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control" />

                        </div>
                    </div>

                    <!--                        <div class="clearfix"></div>
                                            <br>
                    
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                    
                                                    <label>Hall</label>
                                                    <input type="text" name="hall" class="form-control"/>
                    
                                                </div>
                                                
                                            </div>-->

                    <div class="clearfix"></div>
                    <br>




                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <input type="submit" name="adv_submit" class="btn" value="Search" />

                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>

                        <!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>