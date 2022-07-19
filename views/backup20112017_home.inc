
<div class="container search-page-background">
    <h3 class="ct-h-big text-center text-uppercase search-heading">Bibliography Search</h3>
    <p class="search-sub-heading text-center">This is some text here</p>
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">

        <div class="search-bar">
            <form method="post" action="search" name="search_form" id="search_form">
                <div class="col-md-12">
                    <div class="form-group">
                        <!--<input id="programme" name="programme" size="20" style="color: #000!important; background: rgba(255, 255, 255, 0.81);" placeholder="Type programme name" class="form-control"/>-->
                        <div class="col-md-6 col-sm-6 ">
                            <select class="program-name" name="bibliography[]" multiple="multiple"  data-placeholder="Search by Author / Artist / Topic"></select>

                        </div>

                        <div class="col-md-4 col-sm-4 ">
                            {subcategory_list}

                        </div>

                        <div class="col-md-2 col-sm-12 text-center">
                            <button type="submit" class="btn btn-default btn-block btn-red" value="entry-point" name="bibliography-search-entry">Search</button>
                            <!--<a class="adv-search" id="myBtn" data-toggle="modal" data-target="#myModal">Advanced Search</a>-->
                        </div>
                        <input type="hidden" name="catg" value="bibliography">
                        <input type="hidden" name="att[0]" value="author">
                        <input type="hidden" name="att[1]" value="artist">




                    </div>
            </form>
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

                    <form action="adv-search" method="POST" >
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <label>Person Name</label>
                                <input type="text" name="author" class="form-control"/>

                            </div>
                            <div class="col-md-6">
                                <label>Select In/As</label>
                                <select name="attr" class="form-control">
                                    <option value="">Select All</option>
                                    <option value="author">Author</option>
                                    <option value="contributor">Contributor</option>
                                    <option value="editor">Editor</option>
                                    <option value="artist_mentioned">Artist Mentioned</option>
                                    <option value="curator">curator</option>
                                </select>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>     
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Reference type</label>
                                <select name="ref_type" class="form-control">
                                    <option value="">Select All</option>
                                    <option value="Books">Books</option>
                                    <option value="Newspaper Article">Newspaper Article</option>
                                    <option value="Periodical Article">Periodical Article</option>
                                    <option value="Book Section">Book Section</option>
                                    <option value="Thesis">Thesis</option>
                                    <option value="Catalogue Essay">Catalogue Essay</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Edition</label>
                                <input type="text" name="edition" class="form-control"/>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br>     
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Language</label>
                                <input type="text" name="language" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Place of Publication</label>
                                <input type="text" name="place_of_publication" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Publisher</label>
                                <input type="text" name="publisher" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Title</label>
                                <input type="text" name="title_of_the_book" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Year</label>
                                <input type="text" name="date_year" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input type="submit" name="adv_submit" class="btn" value="Search"/>

                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>


</div>
</div>