<main>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6 col-sm-9">
                <!--                <h3>EXHIBITION</h3>-->
                <!--            <p>
                                    Welcome to this repository of images from Gallery Rasa Archives designed to help you form a more holistic idea and gaze into an artist's body of works. Our passionate endevour to document and celebrate the unsung and the established has led to a foundation of credibility upon which this window into Indian art rests.
                                </p>
                                <p>
                                    Our effort in bringing to light images from rare published sources, we feel will broaden the study and appreciation of art in the Indian subcontinent.
                                </p>-->
               
<!--                temporary disable search field for satyajit ray exhibition 3rd feb 2022

                <form method="post" action="exhibition-search" name="search_form" id="search_form" role="form">
                    <div class="row justify-content-center flex-md-nowrap flex-wrap mb-5">
                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" id="" placeholder="Enter Artist’s Name">

                            <select class="exhibition-name form-control" name="exhibition"  data-placeholder="Enter Exhibition’s Name">
                                <?php
                                foreach ($exrow as $k => $v) {

                                    if ($v['status'] == '0') {
                                        $stat = 'Archived';
                                    } else if ($v['status'] == '1') {
                                        $stat = 'Open';
                                    }
                                    ?>
                                    <option value="<?php echo $v['id'] ?>"><?php echo $v['exhibition_name'] . '(' . $stat . ')' ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-3 col-12">
                            <button type="submit" class="btn btn-primary form-control search-bttn" value="entryPoint" name="srchButtonEntryPoint">Search</button>
                        </div>

                    </div>
                </form>
                temporary disable for satyajit ray exhibition 3rd feb 2022-->

            </div>
        </div>

        <h3 class="mb-0">
            <?php // echo $exhibition_name; ?>

        </h3>  
     
            <div class="row">

                <div class="col-md-12 text-center">
                    <img style="width: 350px; margin: 0px auto" src="images/ray_exhibition.jpeg">
                </div>
               
                <div class="col-md-12" style="text-align: center">
                       <br>
                    <h3>The Satyajit Ray Centenary Show</h3>
<!--                    <h5>13th February to 14th March,
                        <br>
                        11.00 HRS to 18.00 HRS IST
                        <br>
                        Venue: KCC, 1st floor.
                    </h5>-->
                    <p>
                        Gallery Rasa is delighted to pay homage to the iconic filmmaker Satyajit Ray on his centenary year, in collaboration with Kolkata Centre for Creativity. This exhibition showcases our collection of rare film memorabilia, costumes & props, book covers & archival material along with Nemai Ghosh's photographs giving a glimpse into the filmmaking process of the maestro. 
                    </p>
                </div>
            </div>
       
        <!--
                <div class="row arial">
        
        <?php
        foreach ($paintingrow as $k2 => $v2) {

            if ($v2['status'] == '0') {
                $stat = 'Archived';
            } else if ($v2['status'] == '1') {
                $stat = 'Open';
            }
            ?>
                                        <div class="col-md-4 product-outerBorder exhibition-box">
                                            <div class="product-imageBox">
                                                <img src="<?php echo 'https://galleryrasa.com/' . EXHIBITION_THUMB_IMGS . $v2['image'] ?>" class="img-responsive product-image">
                                            </div>
                                            <div class="product-caption">
                                                <h4>
            <?php echo $v2['name'] ?>
                                                </h4>
                                                <h4>
                                                Artist: <?php echo $v2['artist_name'] ?>
                                                </h4>
                                                <h4>
                                                Medium: <?php echo $v2['mediumname'] ?>
                                                </h4>
                                            </div>
                                        </div>
            <?php
        }
        ?>
                </div>
        -->
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
    <div class="owl-carousel owl-theme wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
        {carousel_items}
    </div>
</div>-->
