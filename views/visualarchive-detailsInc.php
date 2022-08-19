<section class="visual-search-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="back-action">
                            <a href="#" class="back-btn"><span class="material-icons">arrow_back</span>back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="details-info">
                        <div class="left-details">
                            {imageDetails}
                            <!-- <div class="details-img box target">
                                <img class="img-fluid" src="images/artist-1.jpg">
                            </div> -->
                            <div class="sticky-sec">
                                <div class="book">
                                    <a href="#" class="book-btn btn zoom">
                                        <span class="material-icons">zoom_in</span>
                                    </a>
                                    <div class="tooltip-in">
                                        <p>zoom in</p>
                                    </div>
                                </div>
                                <div class="book">
                                    <a href="#" class="book-btn btn zoom-out">
                                        <span class="material-icons">zoom_out</span>
                                    </a>
                                    <div class="tooltip-out">
                                        <p>zoom out</p>
                                    </div>
                                </div>
                                <div class="book">
                                    <a href="#" class="book-btn btn zoom-init">
                                        <span class="material-icons">undo</span>
                                    </a>
                                    <div class="tooltip-reset">
                                        <p>reset</p>
                                    </div>
                                </div>
                                <div class="book">
                                    <a href="#" class="book-btn arrow">
                                        <span class="material-icons">arrow_downward</span>
                                    </a>
                                    <div class="tooltip-download">
                                        <p>download</p>
                                    </div>
                                </div>
                                <div class="book">
                                    <a href="#" class="book-btn" data-toggle="modal" data-target="#enlargeModal">
                                        <span class="material-icons">zoom_out_map</span>
                                    </a>
                                    <div class="tooltip-enlarge">
                                        <p>enlarge</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="right-details">
                        <table class="table table-bordered">
                            <tbody>
                                {attributeList}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="press-modal">
        <div class="modal fade" id="enlargeModal" tabindex="-1" aria-labelledby="enlargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" class="downlode"><span class="material-icons">crop_free</span></a>
                        <a href="#" class="downlode"><span class="material-icons">save_alt</span></a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="light-part">
                            <img class="img-fluid" src="assets/img/artist-details.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>