<main>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-12">
                <h3>BENGALI FILM ARCHIVES</h3>
                <p class="m-0">
                    A resource of detailed bibliographic information and visual content of Bengali Cinema 
                </p>

                <form method="post" action="memorabilia" name="search_form" id="search_form" role="form" style="margin-top:10px;">
                    <div class="row justify-content-center flex-nowrap">
                        <div class="col-md-8 col-lg-6 col-sm-9">
<!--                            <input type="text" class="form-control" id="" placeholder="Enter Artist’s Name">-->

                            <select class="form-control program-name" name="memorabilia[]" multiple="multiple" data-placeholder="Search by Film/Cast/Director"></select>


                            <!--                            <button type="submit" class="btn btn-primary form-control">Search</button>-->





                            <button type="submit" class="btn btn-primary form-control search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search" ></span> Search</button>

                            <input type="hidden" name="catg" value="Memorabilia">
                            <input type="hidden" name="att[0]" value="film">
                            <input type="hidden" name="att[1]" value="cast">
                            <input type="hidden" name="att[2]" value="director">
                            <input type="hidden"  id="place" data-placeholder="Search by Cast/Film/Director">
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
                                                    <option value="beditor">Editor</option>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Year</label>
                                                <input type="text" name="year" class="form-control"/>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="adv_submit" class="btn" value="Search"/>
<!--                                    <div class="modal-footer">
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

                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!--    <div class="container">
            <div class="owl-carousel owl-theme wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                {carousel_items}
            </div>
        </div>-->



</main>






<!--<div class="container search-page-background-memoribilia text-center">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="ct-h-big text-center text-uppercase search-heading">Film Memorabilia</h3>
        <p class="search-sub-heading text-center">For researchers and film buffs - Search for detailed bibliographic information and visual content on Bengali Cinema, to start with</p>
    </div>
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">

        <div class="search-bar">
            <form method="post" action="memorabilia" name="search_form" id="search_form">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <select class="program-name" name="memorabilia[]" multiple="multiple" data-placeholder="Search by Film/Cast/Director"></select>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                            <button type="submit" class="btn btn-default search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search" ></span> Search</button>
                        </div>
                        <input type="hidden" name="catg" value="Memorabilia">
                        <input type="hidden" name="att[0]" value="film">
                        <input type="hidden" name="att[1]" value="cast">
                        <input type="hidden" name="att[2]" value="director">
                        <input type="hidden"  id="place" data-placeholder="Search by Cast/Film/Director">
                    </div>
            </form>

            <p style="" class="adv-search">  Refine your search with <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal">
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
    <div class="owl-carousel owl-theme wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
        {carousel_items}
    </div>
</div>-->
