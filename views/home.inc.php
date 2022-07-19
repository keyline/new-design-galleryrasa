<main>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-10">
                <h3>BIBLIOGRAPHY</h3>

                <p>A wealth of ever growing resources which can be refined to achieve effective research on various fields of Indian art, crafts and films by forming an invaluable source of information</p>


                <form method="post" action="search" name="search_form" id="search_form" role="form" class="bibliography-search-form">
                    <div class="row justify-content-center flex-md-nowrap flex-wrap">
<!--                            <input type="text" class="form-control" id="" placeholder="Enter Artist’s Name">-->
                        <div class="col-md-6 col-sm-6 ">
                            <select class="program-name form-control" name="bibliography[]" multiple="multiple"  data-placeholder="Search by Author / Artist / Editor / Topic"></select>
                        </div>
                        <div class="col-md-4 col-sm-6 arial">
                            {subcategory_list}
                        </div>



                        <!--                            <button type="submit" class="btn btn-primary form-control">Search</button>-->
                        <div class="col-md col-12">
                            <button type="submit" class="btn btn-primary form-control" value="entry-point" name="bibliography-search-entry">Search</button>
                        </div>
                        <input type="hidden" name="catg" value="bibliography">
                        <input type="hidden" name="att[0]" value="author">
                        <input type="hidden" name="att[1]" value="artist">
                        <input type="hidden" name="att[2]" value="editor">
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

            </div>
        </div>
    </div>
<!--    {cms}-->
    <div class="container mt-4">
        <div class="owl-carousel owl-theme">
<!--            <div class="item"><img src="http://placehold.it/50X50" alt="The Last of us"></div>-->
            {carousel_items}
        </div>
    </div>

</main>



















<!--<div class="container search-page-background">
    <h3 class="ct-h-big text-center text-uppercase search-heading">gallery rasa archives</h3>
    <p class="search-sub-heading text-center">This section provides art aficionados, historians, archivists, students, academicians and professionals<br>
        an easy and smart access to a pool of resources that we hope forms an invaluable asset.</p>
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">

        <div class="search-bar">
            <form method="post" action="search" name="search_form" id="search_form">
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 ">
                            <select class="program-name" name="bibliography[]" multiple="multiple"  data-placeholder="Search by Author / Artist / Editor / Topic"></select>

                        </div>

                        <div class="col-md-4 col-sm-4 ">
                            {subcategory_list}

                        </div>

                        <div class="col-md-2 col-sm-12 text-center">
                            <button type="submit" class="btn btn-default btn-block btn-red" value="entry-point" name="bibliography-search-entry">Search</button>
                        </div>
                        <input type="hidden" name="catg" value="bibliography">
                        <input type="hidden" name="att[0]" value="author">
                        <input type="hidden" name="att[1]" value="artist">
                        <input type="hidden" name="att[2]" value="editor">




                    </div>
            </form>
            <br>
            <p style="padding-top: 15px;" class="adv-search">  Refine your search with <a href="#" id="myBtn" data-toggle="modal" data-target="#myModal"><strong>
                        Advanced Search</strong></a></p>
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
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <label>Name</label>
                                <input type="text" name="author" class="form-control"/>

                            </div>
                            <div class="col-md-6">
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
                        <div class="clearfix"></div>
                        <br>     
                        <div class="col-md-12">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label>Language</label>
                                <input type="text" name="language" class="form-control"/>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br>     
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Book</label>
                                <input type="text" name="title1_of_parent[1]" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Journal</label>
                                <input type="text" name="title1_of_parent[2]" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Year</label>
                                <input type="text" name="gregorian_year" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Publisher</label>
                                <input type="text" name="publisher" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Extract</label>
                                <input type="text" name="extract" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Classification</label>
                                <select name="extract_type[]" id="adv-search-extract" multiple="multiple">
                                    {adv-search-options}
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>

                        <div class="clearfix"></div>
                        <br>



                        <div class="modal-footer">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <input type="submit" name="adv_submit" class="btn" value="Search"/>

                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <div class="owl-carousel owl-theme">
        {carousel_items}
    </div>
</div>-->