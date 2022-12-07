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
                                    Gallery Rasa, by Rakesh and Radhika Sahni, has made its presence felt since 1993. Situated in a three-storied building in New Alipore, Kolkata, it houses The Gallery Rasa Archives and collection of rare artworks of Indian modern and contemporary art, crafts and film memorabilia.
                                    </div>
                                    <div class="visual-content">
                                    We promote it an active space for art enthusiasts, collectors, research scholars and art historians to foster discourse and facilitate a deeper understanding and appreciation of art.
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
                        Gallery Rasa Archives is an ever evolving and ongoing effort to bridge the gap between knowledge and those who seek it. Initiated in 1993, GRA has grown to encompass a comprehensive collection of rare journals, books, newspaper articles, catalogues, and artist correspondences encompassing different art practices, classical Indian art, folk art, crafts and film studies.
                        </div>
                        <div class="about-text">
                        GRA functions through its two pillars: Visual Archives and Bibliography. The Bibliography section offers insights into diverse range of subjects spanning Indian Art, Crafts, Architecture, Film and Culture.
                        </div>
                        <div class="about-text">
                        The Visual Archives addresses the urgent need for a platform to study the art practice of individual artists, to analyze various movements in art history and to conduct in-depth research in specific mediums and artist initiatives.

                        </div>
                        <div class="about-text">
                            The two pillars compliment and strengthen each other and in cohesion will allow you to forge new ways of perceiving and interpreting. This, we hope, will give impetus to art aficionados, historians, archivists, students, academicians, professionals and even an enthusiast, to seek a broader understanding of art and culture in our nation.
                        </div>
                        <div class="about-action">
                             <div class="about-action-box">
                            <a href="<?php echo SITE_URL ?>visualarchive-search" class="explore-btn">
                                explore visual archives & Bibliography
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
                            Films apart from being a medium for entertainment and expression, are a reflection of the society that create and enjoy them. Films bring people together through their emotions and experiences and certain films and characters are immortalized in our minds gaining an extremely personal value. This value often instills a raging curiosity and lovers of films satiate this by collecting film memorabilia.
                        </div>
                        <div class="about-text">
                            In the Bengali Film Archives, we aspire to provide audiences a peek into the world behind the magic of the silver screen that it so ravenously desires. In line with our commitment to research and archiving, this section provides detailed bibliographic information on Bengali Cinema from the silent era till the year 2000.
                        </div>
                        
                        <div class="about-action">
                             <div class="about-action-box">
                            <a href="<?php echo SITE_URL ?>memorabilia-search" class="explore-btn">
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
                            Exhibitions form the core of any gallery. Over the past two decades Rakesh Sahni, Director, Gallery Rasa,  has curated landmark exhibitions.  Some of them include ‘Sculptures: The Bengal Connection’; ‘Ramendranath Chakravorty (1902-1955): A Retrospective of his Graphic Prints’ and ‘Jyoti Bhatt: Photographs 1959-1994.’
                        </div>
                        <div class="about-text">
                            Collaboration remains our key to the future and we at Gallery Rasa are always open to its rich possibilities. We have shared our exhaustive collection at the Satyajit Ray Centenary Show: Volumes I and II, held in collaboration with Kolkata Center for Creativity, Kolkata and Kerala Lalitha Kala Akademi ,Kochi.
                        </div>
                        <div class="about-text">
                            Our collection has been featured in curated exhibitions by Dr. Paula Sengupta and Camillla H. Chaudhary titled ‘Trajectories: 19th-21st Century Printmaking from India and Pakistan at Sharjah; as well as ‘Somnath Hore: A Centenary Exhibition’, curated by K. S. Radhakrishnan held at Arthshila, Santiniketan and Emami Art, Kolkata.
                        </div>
                        <div class="about-text">
                            We aim to build upon our efforts to showcase important works from our collection through various art institutions and host online exhibitions from GRA’s treasure trove.
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