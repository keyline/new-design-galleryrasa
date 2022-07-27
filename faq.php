<?php

require_once("require.php");    
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

include(INC_FOLDER . "homeheaderInc.php");

?>


<section class="artist-search bibliography-search bengali-film-search faq">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="visual-info">
                            <div class="visual-title">
                                FAQs
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="menu">
                            <div class="menu-sec">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                What does 'Type for Complete Search' mean in the home page?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="faq-inner">
                                                While the user can independently search through the three verticals, the 'Type for Complete Search' in the home page allows the user to access information across the three verticals in a composite manner.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                What are the features of the Bibliography?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            The bibliography section showcases detailed information of published material, which is available physically at the archive either in soft or hard copies. The essence is not only to provide credible bibliographic information but also make it available.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                What are the features of the Visual Archives?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            The visual archives display published images with detailed information along with the facility to zoom in and download the same.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    What are the features of the Bengali Film Archives?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            This section allows the viewer access to comprehensive information on Bengali films, complementing it with images of film memorabilia.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFive">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                What are the features of the Bengali Film Archives?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            This section allows the viewer access to comprehensive information on Bengali films, complementing it with images of film memorabilia.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingSix">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                How are vernacular publications presented in the archives?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            As most vernacular literary material does not provide translation of the titles, the practice followed is to transliterate the title along with a rough translation of the same, to afford the researcher a fair idea of the presented material.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingSeven">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                What are the features of the search options?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            The Gallery Rasa Archives currently offers:
                                                    A composite search comprising the three verticals of Bibliography, Visual Archives and Bengali Film Archives.
                                                    Each vertical also has a dedicated search section to maximize the results.
                                                    Entering names in ‘Bibliography’ and ‘Bengali Film Archives’ enables the interface to suggest roles of selected names.
                                                    The initials of the names follow the format of ‘Space after Dot’ e.g. K. G. Subramanyan
                                                    Individual search option for each vertical have a left panel to facilitate refining of the search.
                                                    Each section has an ‘Advanced Search’ to narrow down the search further.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="card">
                                        <div class="card-header" id="headingEight">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                What is the difference between plate and illustration in ‘Pagination’?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            Any image regardless of size if accompanied with text is considered an illustration, whereas a standalone image/s is considered a plate/s.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="card">
                                        <div class="card-header" id="headingNine">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                What does text in ‘box brackets’ denote?
                                                    <i class="zmdi zmdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="faq-inner">
                                            Any text in box brackets has been added by the archivist.
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                        <div class="card">
                                    <div class="card-header" id="headingTen">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                            How are names treated in the archives?
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <div class="faq-inner">
                                          Through the process of archiving over a decade, we have come across numerous spellings for the same name. For purposes of achieving tangible search results we have tried our best to maintain a singular spelling of the said name. Any change in spelling has been duly mentioned in the archivist’s comments. The initials of the names follow the format of ‘Space after Dot’ e.g. K. G. Subramanyan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="card">
                                    <div class="card-header" id="headingEleven">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                            How are images treated in the visual archives?
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <div class="faq-inner">
                                          The archives present the best image available of the artwork which may have been published later. In that case the bibliographic information is of the earlier publication and is kept intact with the archivist comments elucidating the change. The archive does its best to inform the number of publications the artwork is published in. The archive presents images published during the life time of the artist. If there is a deviation the same is mentioned in the archivist comments. The archive also makes an exception to this only in the case of institutional collections and publications.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="card">
                                    <div class="card-header" id="headingTwelve">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                            How do I give credit for source of information from Gallery Rasa Archives?
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <div class="faq-inner">
                                            Credit to both:
                                                iterary/Artistic Work License Courtesy of Respective Copyright Owner/Holder
                                                Literary/Artistic Work: Courtesy of Gallery Rasa Archives
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="card">
                                    <div class="card-header" id="headingThirteen">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                            How to contribute to the Gallery Rasa Archives?
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <div class="faq-inner">
                                          The Archive is a work in progress and collaboration is the key to enrich it. If you feel that you would want to contribute in any way please feel free to write to us at rs@galleryrasa.com. It is our standard protocol to give credit to the contributor.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="card">
                                    <div class="card-header" id="headingFourteen">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                            How to communicate errors in the listings?
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <div class="faq-inner">
                                          In spite of our best efforts errors might creep in. Please write in to us at radhika@galleryrasa.com giving details of the listing and corrections thereof. Thank you for your support.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingFourteen">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                            How to communicate for unanswered questions?
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <div class="faq-inner">
                                          For any further questions do get in touch with us at info@galleryrasa.com
                                            </div>
                                        </div>
                                    </div>
                                </div>
                      


                            </div>
<!--
                            <div class="apply-action">
                                <a href="#" class="apply-btn">apply filters</a>
                            </div>
-->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include(INC_FOLDER . "footerInc.php");
?>