<main>
    <div class="container">
        <div class="row justify-content-center arial">
            <div class="col-md-9">
                <form method="post" action="search" name="search_form" id="search_form" class="bibliography-search-form">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <select class="program-name" name="bibliography[]" multiple="multiple" data-placeholder="Search By Author/Artist/Topic"></select>
                        </div>
                        <div class="col-md-3 col-sm-3 ">
                            {subcategory_list}

                        </div>
                        <div class="col-md-3">
        <!--                <button type="submit" class="btn btn-default search-bttn" value="entryPoint" name="srchButtonEntryPoint"><span class="glyphicon glyphicon-search">Search</span>
                            </button>-->

                            <button type="submit" class="btn btn-default btn-block btn-red form-control" value="entry-point" name="bibliography-search-entry"><span class="glyphicon glyphicon-search">Search</span>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="catg" value="bibliography">
                    <input type="hidden" name="att[0]" value="author">
                    <input type="hidden" name="att[1]" value="artist">
                </form>
            </div>
            <div class="col-md-12">
                <p style="font-size: 14px;" class="text-center">
                    Refine your search with
                    <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal">
                        <strong>Advanced Search</strong>
                    </a>
                </p>
            </div>
        </div>
        <div class="row arial">

            <div class="col-md-4 col-xs-12">
                {leftFilter}
            </div>
            <div class="col-md-8">
                <div class="row search-keyword">
                    <div class="col-md-6 keyword">
                        <span>searched for: </span>
                        <span class="keyword-list">{searchedKeyword}</span>
                    </div>
                    <div class="col-md-6 count"> 
                        <span>total result found: </span>
                        <span class="result-count">{TotalResult}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="SearchResult">{searchList}</div>
                </div>
            </div>



            <!--CiteThis modal box-->
            <div class="modal fade" id="citethis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span class="badge" aria-hidden="true">×</span><span class="sr-only ">Close</span></button>
                            <h3 class="modal-title">Cite This</h3>
                        </div>
                        <div class="modal-body">
                            <div id="divCitethis" class="col-md-12 col-sm-12 col-xs-12 "></div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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

                    <form action="adv-search" method="POST" id="adv-search-bibliography">
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
                                    <select name="attr" class="form-control" id="select-attributes-biblio">
                                        <option value="">Select All</option>
                                        <option value="author">Author</option>
                                        <option value="contributor">Contributor</option>
                                        <option value="editor">Editor</option>
                                        <option value="artist">Artist</option>
                                        <option value="curator">Curator</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Classification</label>
                                    <select name="ref_type[]" id="adv-search-extract" multiple="multiple">
<!--                                                <select name="extract_type[]" id="adv-search-extract" multiple="multiple">-->
                                        {adv-search-options}
                                    </select>
                                </div>
                            </div>
                            <!--                                        <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Classification</label>
                                                                            <select name="ref_type" class="form-control">
                                                                                <option value="">Select All</option>
                                                                                <option value="Book">Books</option>
                                                                                <option value="Journal">Newspaper Article</option>
                                                                                <option value="Journal Article">Periodical Article</option>
                                                                                <option value="Book Section">Book Section</option>
                                                                                <option value="Catalogue">Catalogue</option>
                                                                                <option value="Catalogue Essay">Catalogue Essay</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Language</label>
                                    <select name="language" class="form-control">
                                        <option value="">Select</option>
                                        {languagelist}
                                    </select>
<!--                                                <input type="text" name="language" class="form-control"/>-->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Book</label>
                                    <input type="text" name="title1_of_parent[1]" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Journal</label>
                                    <select name="title1_of_parent[2]" class="form-control">
                                        <option value="">Select</option>
                                        {journallist}
                                    </select>
<!--                                                <input type="text" name="title1_of_parent[2]" class="form-control"/>-->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" name="gregorian_year" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Publisher</label>
                                    <input type="text" name="publisher" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Extract</label>
                                    <input type="text" name="extract" class="form-control"/>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Descriptive Tag</label>
                                    <input type="text" name="descriptive_tags" class="form-control"/>
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