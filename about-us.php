<?php

require_once("require.php");    
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
$title = "About Us";
include(INC_FOLDER . "headerInc.php");


?>


<section class="start-body visual-page rasa-inner about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="about-top">
                                <div class="visual-info">
                                    <div class="visual-title">
                                        We’re glad and grateful you’re here!
                                    </div>
                                    <div class="visual-content">
                                    Promoted by Rakesh and Radhika Sahni, Gallery Rasa has had a presence in the art world since 1993. Situated in a three-storied building in Kolkata, it houses The Gallery Rasa archives and collection of rare artworks encompassing Indian modern and contemporary art, film memorabilia, crafts, and rare archival material. It is an active space for collectors, research scholars, art historians, and fosters discourse to facilitate a wider audience.
                                    </div>
                                </div>
                                <div class="about-img">
                                    <img class="img-fluid" src="images/about.jpg" alt="">
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="visual-artist about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 flex-v-cen pr-5 or-2">
                    <div class="about-info">
                        <div class="icon-box">
                            <div class="about-icon">
                                <span class="material-icons">burst_mode</span>
                            </div>
                            <div class="about-title">
                                The Gallery Rasa Archives
                            </div>
                        </div>
                        <div class="about-text">
                        Gallery Rasa Archives is a work in progress and shall continue to be so as it strives to bridge the gap. This initial thrust has been made possible by a modest effort initiated in 1993 of creating a collection of rare journals, books, newspaper articles, catalogues, and artist correspondences encompassing different art practices, classical Indian art, folk art, crafts and film studies.    
                        </div>
                        <div class="about-text">
                        The archives makes its presence felt through its two pillars - Visual Archives and Bibliography. While the bibliography section serves the need for sustaining research and stimulating breaking of new ground in various subjects encompassing Indian art, crafts, film and culture; the visual archives addresses the urgent need for a credible platform to study the art practice of individual artists, bolster the insight into various movements in art history, do in-depth research in specific mediums, artist initiatives and geographical areas.
                        </div>
                        <div class="about-text">
                        In fact the two pillars compliment and strengthen each other and in cohesion allows the explorer to forge new ways of viewing and  interpreting. This, we hope, will give impetus to art aficionados, historians, archivists, students, academicians and professionals towards a broader understanding of art in our nation and internationally.

                        </div>
                        <div class="about-action">
                             <div class="about-action-box">
                            <a href="<?php echo SITE_URL ?>visualarchive-search" class="explore-btn">
                                explore visual archives
                                <span class="material-icons">arrow_forward</span>
                            </a>
                            </div>
                                
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl-5 or-1">
                    <div class="right-box">
                        <div class="img-box">
                            <img class="img-fluid" src="images/photobook-6.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pr-5 or-3">
                    <div class="right-box">
                        <div class="img-box">
                            <img class="img-fluid" src="images/about-film.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 flex-v-cen pl-5 or-5">
                    <div class="about-info">
                        <div class="icon-box">
                            <div class="about-icon">
                                <span class="material-icons">movie_filter</span>
                            </div>
                            <div class="about-title">
                            Bengali Film Archives - Memorabilia and Bibliography
                            </div>
                        </div>
                        <div class="about-text">
                            Film is not just a medium for entertainment and individual expression. It is a reflection of society that portrays ideas we all relate to. Films bring people together in laughter, in sadness and in empathetic connect to the screen and its stories. Certain films throughout our lifetime, in the process of unifying us through our experiences become ingrained into our memories and gain an extremely personal value in our minds. This value comes with a raging curiosity and film buffs across the world satiate this by collecting film memorabilia. Visual literature advertises, summarizes and glorifies in posterity everything that film means to its audience. Film memorabilia allows the audience that slight peek into the world behind the magic of the silver screen that it so ravenously desires.
                        </div>
                        <div class="about-text">
                            Keeping in line with our commitment to research and archiving, this section provides both researchers and film buffs detailed bibliographic information on Bengali Cinema from the silent era till the year 2000. In the same breath it also provides collectors the unique opportunity of purchasing these gems of cinematic history.
                        </div>
                        <div class="about-text">Close in tow, will be the addition of our Hindi Film Memorabilia.
                        </div>
                        <div class="about-action">
                             <div class="about-action-box">
                            <a href="<?php echo SITE_URL ?>beforeSearch" class="explore-btn">
                                explore bengali film archives
                                <span class="material-icons">arrow_forward</span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 flex-v-cen pr-5 or-6">
                    <div class="about-info">
                            <div class="icon-box">
                            <div class="about-icon">
                                <span class="material-icons">photo_filter</span>
                            </div>
                            <div class="about-title">
                                Exhibitions
                            </div>
                        </div>
                        <div class="about-text">
                            Gallery Rasa Archives is a work in progress and shall continue to be so as it strives to bridge the gap. This initial thrust has been made possible by a modest effort initiated in 1993 of creating a collection of rare journals, books, newspaper articles, catalogues, and artist correspondences encompassing different art practices, classical Indian art, folk art, crafts and film studies.
                        </div>
                        <div class="about-text">
                            The archives makes its presence felt through its two pillars - Visual Archives and Bibliography. While the bibliography section serves the need for sustaining research and stimulating breaking of new ground in various subjects encompassing Indian art, crafts, film and culture; the visual archives addresses the urgent need for a credible platform to study the art practice of individual artists, bolster the insight into various movements in art history, do in-depth research in specific mediums, artist initiatives and geographical areas.
                        </div>
                        <div class="about-text">
                            In fact the two pillars compliment and strengthen each other and in cohesion allows the explorer to forge new ways of viewing and interpreting. This, we hope, will give impetus to art aficionados, historians, archivists, students, academicians and professionals towards a broader understanding of art in our nation and internationally.
                        </div>
                        <div class="about-action">
                             <div class="about-action-box">
                            <a href="<?php echo SITE_URL ?>exhibition-search" class="explore-btn">
                                view upcoming exhibitions
                                <span class="material-icons">arrow_forward</span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl-5 or-5">
                    <div class="right-box">
                        <div class="img-box">
                            <img class="img-fluid" src="images/about-exhibitions.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include(INC_FOLDER . "footerInc.php");
?>