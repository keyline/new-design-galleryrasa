<main>
    <section class="start-body visual-page rasa-inner bibliography-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-lg-12 flex-height">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        Bibliography
                                    </div>
                                    <div class="visual-content">
                                        A wealth of ever growing resources which can be refined to achieve effective research on various fields of Indian art, crafts and films by forming an invaluable source of information
                                    </div>
                                    <div class="left-body">
                                        <div class="hearder-options">
                                            <div class="user-options">
                                                <div class="search-wrap">
                                                    <div class="search">
                                                        <div class="top-search">
                                                            <div class="search-barOption">
                                                                <form method="post" action="search" name="search_form" id="search_form" role="form" class="bibliography-search-form" class="search-input">
                                                                    <div class="row flex-md-nowrap flex-wrap">
                                                                        <!-- <div class="col-md-8 col-sm-12 pr-0"> -->
                                                                            <div class="search-new-namrata">
                                                                            <select class="program-name form-control" name="bibliography[]" multiple="multiple"  data-placeholder="Search by Author / Artist / Editor / Topic"></select>
                                                                            <button type="submit" value="entry-point" name="bibliography-search-entry" class="btn-search" type="submit"><span class="material-icons">search</span></button >        
                                                                            </div>
                                                                        <!-- </div> -->
                                                                       
                                                                        <!-- <div class="col-md-4 col-sm-12 arial"> -->
                                                                        <!-- <span class="material-icons">keyboard_arrow_down</span> -->
                                                                            {subcategory_list}
                                                                        <!-- </div> -->
                                                                        <input type="hidden" name="catg" value="bibliography">
                                                                        <input type="hidden" name="att[0]" value="author">
                                                                        <input type="hidden" name="att[1]" value="artist">
                                                                        <input type="hidden" name="att[2]" value="editor">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="drop-form">                                                                
                                                                <a href="#" class="advanced-btn" id="myBtn" data-toggle="modal" data-target="#myModal">Advanced Search<span class="material-icons">manage_search</span>
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
                        <div id=bibliography class="owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/Bibliography.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/Bibliography-2.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/Bibliography-3.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/Bibliography-4.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/Bibliography-5.jpg">
                                </div>
                            </div>
                            <div class="item">
                                <div class="artist-img">
                                    <img class="img-fluid" src="images/Bibliography-3.jpg">
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <form action="adv-search" method="POST" id="adv-search-bibliography">
                                            <div class="form-group">
                                                <input type="text" name="author" class="form-control" placeholder="NAME">
                                            </div>
                                            <div class="form-group">
                                                <select name="ref_type[]" id="adv-search-extract" multiple="multiple" data-placeholder="Classification">
                                                    {adv-search-options}
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="title1_of_parent[1]" class="form-control" placeholder="BOOK">                       
                                            </div>                                            
                                            <div class="form-group">
                                                <input type="text" name="gregorian_year" class="form-control" placeholder="YEAR">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="extract" class="form-control" placeholder="EXTRACT">
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">
                                            <div class="form-group">                                             
                                                <!-- <label>Select In/As</label> -->
                                                <select name="attr" class="form-control" id="select-attributes-biblio">
                                                    <option value="">Select In/As</option>
                                                    <option value="author">Author</option>
                                                    <option value="contributor">Contributor</option>
                                                    <option value="editor">Editor</option>
                                                    <option value="artist">Artist</option>
                                                    <option value="curator">Curator</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <!-- <label>Language</label> -->
                                                <select name="language" class="form-control">
                                                    <option value="">Language</option>
                                                    {languagelist}
                                                </select>                                              
                                            </div>
                                            <div class="form-group">
                                            <!-- <label>Journal</label> -->
                                                <select name="title1_of_parent[2]" class="form-control">
                                                    <option value="">Journal</option>
                                                    {journallist}
                                                </select>                                             
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="publisher" class="form-control" placeholder="PUBLISHER">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="descriptive_tags" class="form-control" placeholder="TAGS">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="right-part">
                                                <input type="submit" name="adv_submit" class="search-box" value="Search"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="right-part">
                                                    <button type="button" class="cancel-btn" data-dismiss="modal">CANCEL</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>